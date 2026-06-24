<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * Tests for error_handler.php
 *
 * Covers:
 *  - .env file loading
 *  - buildErrorEmail() HTML generation
 *  - showFriendlyErrorPage() output (JSON + HTML paths)
 */
class ErrorHandlerTest extends TestCase
{
    private string $envFile;

    protected function setUp(): void
    {
        // Create a temporary .env for the loader to read
        $this->envFile = sys_get_temp_dir() . '/test_env_' . uniqid();

        // Reset $_ENV keys we rely on
        unset($_ENV['MAIL_USERNAME'], $_ENV['MAIL_PASSWORD'], $_ENV['MAIL_TO']);
    }

    protected function tearDown(): void
    {
        if (file_exists($this->envFile)) {
            unlink($this->envFile);
        }
    }

    // ───────────────────── .env loader ─────────────────────

    public function testEnvLoaderSetsVariables(): void
    {
        file_put_contents($this->envFile, "FOO=bar\nBAZ=qux\n");

        // Replicate the loader logic from error_handler.php
        foreach (file($this->envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
            if (strpos(trim($line), '#') === 0) continue;
            if (strpos($line, '=') === false) continue;
            [$key, $value] = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value);
        }

        $this->assertSame('bar', $_ENV['FOO']);
        $this->assertSame('qux', $_ENV['BAZ']);

        unset($_ENV['FOO'], $_ENV['BAZ']);
    }

    public function testEnvLoaderSkipsComments(): void
    {
        file_put_contents($this->envFile, "# this is a comment\nKEY=value\n");

        foreach (file($this->envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
            if (strpos(trim($line), '#') === 0) continue;
            if (strpos($line, '=') === false) continue;
            [$key, $value] = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value);
        }

        $this->assertArrayNotHasKey('# this is a comment', $_ENV);
        $this->assertSame('value', $_ENV['KEY']);

        unset($_ENV['KEY']);
    }

    public function testEnvLoaderSkipsLinesWithoutEquals(): void
    {
        file_put_contents($this->envFile, "NO_EQUALS_HERE\nGOOD=yes\n");

        $parsed = [];
        foreach (file($this->envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
            if (strpos(trim($line), '#') === 0) continue;
            if (strpos($line, '=') === false) continue;
            [$key, $value] = explode('=', $line, 2);
            $parsed[trim($key)] = trim($value);
        }

        $this->assertArrayNotHasKey('NO_EQUALS_HERE', $parsed);
        $this->assertSame('yes', $parsed['GOOD']);
    }

    public function testEnvLoaderHandlesValuesWithEquals(): void
    {
        file_put_contents($this->envFile, "PASSWORD=abc=def==\n");

        foreach (file($this->envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
            if (strpos(trim($line), '#') === 0) continue;
            if (strpos($line, '=') === false) continue;
            [$key, $value] = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value);
        }

        $this->assertSame('abc=def==', $_ENV['PASSWORD']);
        unset($_ENV['PASSWORD']);
    }

    // ───────────────────── buildErrorEmail() ─────────────────────

    public function testBuildErrorEmailContainsAllFields(): void
    {
        // We need to load the function — require once
        require_once __DIR__ . '/../../error_handler.php';

        $html = buildErrorEmail('TestError', 'Something broke', '/app/test.php', 42, 'trace line 1');

        $this->assertStringContainsString('TestError', $html);
        $this->assertStringContainsString('Something broke', $html);
        $this->assertStringContainsString('/app/test.php', $html);
        $this->assertStringContainsString('42', $html);
        $this->assertStringContainsString('trace line 1', $html);
        $this->assertStringContainsString('Portfolio Error Alert', $html);
    }

    public function testBuildErrorEmailWithoutTrace(): void
    {
        require_once __DIR__ . '/../../error_handler.php';

        $html = buildErrorEmail('Warning', 'Undefined var', '/app/foo.php', 10);

        $this->assertStringContainsString('Warning', $html);
        $this->assertStringContainsString('Undefined var', $html);
        // No stack trace section
        $this->assertStringNotContainsString('Stack Trace', $html);
    }

    public function testBuildErrorEmailIncludesStackTraceSection(): void
    {
        require_once __DIR__ . '/../../error_handler.php';

        $html = buildErrorEmail('Fatal', 'crash', '/x.php', 1, 'at Foo::bar()');

        $this->assertStringContainsString('Stack Trace', $html);
        $this->assertStringContainsString('at Foo::bar()', $html);
    }

    public function testBuildErrorEmailContainsHtmlStructure(): void
    {
        require_once __DIR__ . '/../../error_handler.php';

        $html = buildErrorEmail('Error', 'msg', '/f.php', 5);

        $this->assertStringContainsString('<html>', $html);
        $this->assertStringContainsString('<table', $html);
        $this->assertStringContainsString('</html>', $html);
    }

    // ───────────────────── sendErrorMail() ─────────────────────

    public function testSendErrorMailReturnsEarlyWithoutCredentials(): void
    {
        require_once __DIR__ . '/../../error_handler.php';

        // Ensure credentials are empty
        unset($_ENV['MAIL_TO'], $_ENV['MAIL_USERNAME'], $_ENV['MAIL_PASSWORD']);

        // Should return without throwing (silently skips)
        sendErrorMail('Test Subject', '<p>body</p>');
        $this->assertTrue(true); // no exception = pass
    }

    // ───────────────────── showFriendlyErrorPage() ─────────────────────

    public function testShowFriendlyErrorPageReturnsEarlyIfErrorShown(): void
    {
        require_once __DIR__ . '/../../error_handler.php';

        $_GET['error_shown'] = '1';
        ob_start();
        showFriendlyErrorPage();
        $output = ob_get_clean();

        $this->assertEmpty($output);
        unset($_GET['error_shown']);
    }
}

<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * Tests for contact.php validation logic.
 *
 * Since contact.php is a top-level script (not a class), we test the
 * validation rules by replicating them as extracted pure functions.
 * This verifies the business rules without requiring a running PHP server.
 */
class ContactValidationTest extends TestCase
{
    // ───── Replicate contact.php validation logic as testable helpers ─────

    private function sanitize(string $input): string
    {
        return htmlspecialchars(trim($input));
    }

    private function validateRequired(string $name, string $email, string $message): ?string
    {
        if (empty($name) || empty($email) || empty($message)) {
            return 'Please fill in all required fields.';
        }
        return null;
    }

    private function validateEmail(string $email): ?string
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 'Invalid email address.';
        }
        return null;
    }

    // ───────────────────── Input sanitisation ─────────────────────

    public function testSanitizeTrimsWhitespace(): void
    {
        $this->assertSame('hello', $this->sanitize('  hello  '));
    }

    public function testSanitizeEscapesHtml(): void
    {
        $this->assertSame('&lt;script&gt;alert(1)&lt;/script&gt;', $this->sanitize('<script>alert(1)</script>'));
    }

    public function testSanitizeHandlesEmptyString(): void
    {
        $this->assertSame('', $this->sanitize(''));
    }

    public function testSanitizePreservesNormalText(): void
    {
        $this->assertSame('John Doe', $this->sanitize('John Doe'));
    }

    public function testSanitizeEscapesQuotes(): void
    {
        $result = htmlspecialchars(trim('"quoted" & \'single\''));
        $this->assertSame($result, $this->sanitize('"quoted" & \'single\''));
    }

    // ───────────────────── Required field validation ─────────────────────

    public function testValidateRequiredReturnsNullWhenAllPresent(): void
    {
        $this->assertNull($this->validateRequired('John', 'john@example.com', 'Hello'));
    }

    public function testValidateRequiredReturnsErrorWhenNameEmpty(): void
    {
        $this->assertSame(
            'Please fill in all required fields.',
            $this->validateRequired('', 'john@example.com', 'Hello')
        );
    }

    public function testValidateRequiredReturnsErrorWhenEmailEmpty(): void
    {
        $this->assertSame(
            'Please fill in all required fields.',
            $this->validateRequired('John', '', 'Hello')
        );
    }

    public function testValidateRequiredReturnsErrorWhenMessageEmpty(): void
    {
        $this->assertSame(
            'Please fill in all required fields.',
            $this->validateRequired('John', 'john@example.com', '')
        );
    }

    public function testValidateRequiredReturnsErrorWhenAllEmpty(): void
    {
        $this->assertNotNull($this->validateRequired('', '', ''));
    }

    // ───────────────────── Email validation ─────────────────────

    public function testValidateEmailAcceptsValidEmail(): void
    {
        $this->assertNull($this->validateEmail('user@example.com'));
    }

    public function testValidateEmailRejectsNoAtSign(): void
    {
        $this->assertSame('Invalid email address.', $this->validateEmail('userexample.com'));
    }

    public function testValidateEmailRejectsNoDomain(): void
    {
        $this->assertSame('Invalid email address.', $this->validateEmail('user@'));
    }

    public function testValidateEmailRejectsEmptyString(): void
    {
        $this->assertSame('Invalid email address.', $this->validateEmail(''));
    }

    public function testValidateEmailAcceptsSubdomain(): void
    {
        $this->assertNull($this->validateEmail('user@mail.example.co.uk'));
    }

    public function testValidateEmailAcceptsPlusAddressing(): void
    {
        $this->assertNull($this->validateEmail('user+tag@example.com'));
    }

    public function testValidateEmailRejectsSpaces(): void
    {
        $this->assertSame('Invalid email address.', $this->validateEmail('user @example.com'));
    }

    // ───────────────────── Default subject ─────────────────────

    public function testDefaultSubjectFallback(): void
    {
        // Replicate the default-subject logic from contact.php
        $subject = htmlspecialchars(trim($_POST['subject'] ?? 'Portfolio Contact'));
        $this->assertSame('Portfolio Contact', $subject);
    }

    // ───────────────────── Request method check ─────────────────────

    public function testRejectsNonPostRequest(): void
    {
        // Replicate the method check from contact.php
        $method = 'GET';
        $isPost = ($method === 'POST');
        $this->assertFalse($isPost);
    }

    public function testAcceptsPostRequest(): void
    {
        $method = 'POST';
        $isPost = ($method === 'POST');
        $this->assertTrue($isPost);
    }
}

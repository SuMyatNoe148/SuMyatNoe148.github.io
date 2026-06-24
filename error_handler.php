<?php

// Load .env
$envFile = __DIR__ . '/.env';
if (file_exists($envFile)) {
    foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        if (strpos($line, '=') === false) continue;
        [$key, $value] = explode('=', $line, 2);
        $_ENV[trim($key)] = trim($value);
    }
}

// Hide PHP errors from users
ini_set('display_errors', 0);
error_reporting(E_ALL);

function sendErrorMail(string $subject, string $body): void
{
    require_once __DIR__ . '/includes/mailer.php';

    $creds = getMailCredentials();
    if (empty($creds['to']) || empty($creds['username']) || empty($creds['password'])) return;

    try {
        $mail = createMailer();
        $mail->setFrom($creds['username'], 'Portfolio Error Monitor');
        $mail->addAddress($creds['to'], 'Su Myat Noe');
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->send();
    } catch (\Throwable $e) {
        // Silently fail
    }
}

function buildErrorEmail(string $type, string $message, string $file, int $line, string $trace = ''): string
{
    $time    = date('Y-m-d H:i:s');
    $url     = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . ($_SERVER['REQUEST_URI'] ?? '/');
    $ip      = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $agent   = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';

    return "
    <html>
    <body style='font-family:Arial,sans-serif;color:#1e293b;max-width:700px;margin:auto;'>
        <div style='background:#ef4444;padding:20px 30px;border-radius:12px 12px 0 0;'>
            <h2 style='color:#fff;margin:0;'>Portfolio Error Alert</h2>
            <p style='color:rgba(255,255,255,0.85);margin:5px 0 0;'>$time</p>
        </div>
        <div style='background:#f8fafc;padding:30px;border:1px solid #e2e8f0;border-top:none;border-radius:0 0 12px 12px;'>
            <table style='width:100%;border-collapse:collapse;'>
                <tr><td style='padding:10px;font-weight:bold;width:140px;color:#64748b;'>Type</td><td style='padding:10px;color:#ef4444;font-weight:700;'>$type</td></tr>
                <tr style='background:#fff;'><td style='padding:10px;font-weight:bold;color:#64748b;'>Message</td><td style='padding:10px;'>$message</td></tr>
                <tr><td style='padding:10px;font-weight:bold;color:#64748b;'>File</td><td style='padding:10px;font-family:monospace;font-size:0.9rem;'>$file</td></tr>
                <tr style='background:#fff;'><td style='padding:10px;font-weight:bold;color:#64748b;'>Line</td><td style='padding:10px;'>$line</td></tr>
                <tr><td style='padding:10px;font-weight:bold;color:#64748b;'>URL</td><td style='padding:10px;'><a href='$url'>$url</a></td></tr>
                <tr style='background:#fff;'><td style='padding:10px;font-weight:bold;color:#64748b;'>User IP</td><td style='padding:10px;'>$ip</td></tr>
                <tr><td style='padding:10px;font-weight:bold;color:#64748b;'>Browser</td><td style='padding:10px;font-size:0.85rem;'>$agent</td></tr>
            </table>
            " . ($trace ? "<h4 style='margin-top:25px;color:#1e293b;'>Stack Trace</h4><pre style='background:#1e293b;color:#a5b4fc;padding:20px;border-radius:8px;font-size:0.8rem;overflow-x:auto;'>$trace</pre>" : '') . "
        </div>
    </body>
    </html>
    ";
}

function showFriendlyErrorPage(): void
{
    if (isset($_GET['error_shown'])) return;
    if (headers_sent()) return;

    $isJson = isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false;
    if ($isJson) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'An unexpected error occurred. Please try again later.']);
        return;
    }

    http_response_code(500);
    echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oops! Something went wrong</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; font-family: "Inter", sans-serif; }
        .error-card { background: rgba(255,255,255,0.05); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.1); border-radius: 28px; padding: 60px 50px; text-align: center; max-width: 520px; width: 90%; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5); }
        .error-icon { width: 90px; height: 90px; background: linear-gradient(135deg, #4f46e5, #ec4899); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 30px; font-size: 2.2rem; color: #fff; }
        h1 { font-family: "Playfair Display", serif; color: #f1f5f9; font-size: 2.2rem; margin-bottom: 15px; }
        p { color: rgba(255,255,255,0.65); font-size: 1.05rem; line-height: 1.7; margin-bottom: 35px; }
        .btn-home { background: linear-gradient(135deg, #4f46e5, #7c3aed); color: #fff; padding: 14px 36px; border-radius: 9999px; text-decoration: none; font-weight: 600; display: inline-block; transition: all 0.3s; border: none; }
        .btn-home:hover { transform: translateY(-3px); box-shadow: 0 0 30px rgba(79,70,229,0.5); color: #fff; }
        .error-code { font-size: 0.8rem; color: rgba(255,255,255,0.25); margin-top: 30px; letter-spacing: 2px; text-transform: uppercase; }
    </style>
</head>
<body>
    <div class="error-card">
        <div class="error-icon"><i class="fas fa-triangle-exclamation"></i></div>
        <h1>Oops! Something went wrong.</h1>
        <p>An unexpected error occurred on this page. Don\'t worry — it\'s not your fault. The issue has been reported and will be fixed shortly.</p>
        <a href="/" class="btn-home"><i class="fas fa-house me-2"></i>Back to Home</a>
        <p class="error-code">Error code: 500 &nbsp;·&nbsp; Su Myat Noe Portfolio</p>
    </div>
</body>
</html>';
}

// Global exception handler
set_exception_handler(function (\Throwable $e) {
    $trace = htmlspecialchars($e->getTraceAsString());
    $body  = buildErrorEmail(
        get_class($e),
        htmlspecialchars($e->getMessage()),
        htmlspecialchars($e->getFile()),
        $e->getLine(),
        $trace
    );
    sendErrorMail('[Portfolio] Uncaught Exception: ' . get_class($e), $body);
    showFriendlyErrorPage();
    exit;
});

// Global error handler
set_error_handler(function (int $errno, string $errstr, string $errfile, int $errline) {
    $types = [
        E_ERROR => 'Fatal Error', E_WARNING => 'Warning', E_PARSE => 'Parse Error',
        E_NOTICE => 'Notice', E_USER_ERROR => 'User Error', E_USER_WARNING => 'User Warning',
    ];
    $type = $types[$errno] ?? "Error ($errno)";
    $body = buildErrorEmail($type, htmlspecialchars($errstr), htmlspecialchars($errfile), $errline);
    sendErrorMail("[Portfolio] PHP $type", $body);

    if (in_array($errno, [E_ERROR, E_PARSE, E_USER_ERROR])) {
        showFriendlyErrorPage();
        exit;
    }
    return true;
});

// Catch fatal errors on shutdown
register_shutdown_function(function () {
    $error = error_get_last();
    if ($error && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
        $body = buildErrorEmail(
            'Fatal Shutdown Error',
            htmlspecialchars($error['message']),
            htmlspecialchars($error['file']),
            $error['line']
        );
        sendErrorMail('[Portfolio] Fatal Error on Shutdown', $body);
        showFriendlyErrorPage();
    }
});

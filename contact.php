<?php
require_once __DIR__ . '/error_handler.php';

header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('Referrer-Policy: strict-origin-when-cross-origin');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/vendor/autoload.php';

$mailUsername = $_ENV['MAIL_USERNAME'] ?? '';
$mailPassword = $_ENV['MAIL_PASSWORD'] ?? '';
$mailTo       = $_ENV['MAIL_TO'] ?? '';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
    exit;
}

// CSRF token validation
session_start();
$csrfToken = $_POST['csrf_token'] ?? '';
if (empty($csrfToken) || !hash_equals($_SESSION['csrf_token'] ?? '', $csrfToken)) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Invalid or expired form token. Please refresh and try again.']);
    exit;
}

// Rate limiting: max 5 submissions per IP per hour
$rateLimitDir = sys_get_temp_dir() . '/portfolio_rate_limit';
if (!is_dir($rateLimitDir)) {
    mkdir($rateLimitDir, 0700, true);
}
$clientIp = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$rateLimitFile = $rateLimitDir . '/' . md5($clientIp) . '.json';
$maxAttempts = 5;
$windowSeconds = 3600;

$attempts = [];
if (file_exists($rateLimitFile)) {
    $attempts = json_decode(file_get_contents($rateLimitFile), true) ?: [];
    $attempts = array_filter($attempts, fn($t) => $t > time() - $windowSeconds);
}

if (count($attempts) >= $maxAttempts) {
    http_response_code(429);
    echo json_encode(['success' => false, 'message' => 'Too many messages sent. Please try again later.']);
    exit;
}

$attempts[] = time();
file_put_contents($rateLimitFile, json_encode(array_values($attempts)));

// Input validation and sanitization
$name    = htmlspecialchars(trim($_POST['name'] ?? ''), ENT_QUOTES, 'UTF-8');
$email   = htmlspecialchars(trim($_POST['email'] ?? ''), ENT_QUOTES, 'UTF-8');
$subject = htmlspecialchars(trim($_POST['subject'] ?? 'Portfolio Contact'), ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars(trim($_POST['message'] ?? ''), ENT_QUOTES, 'UTF-8');

// Length limits to prevent abuse
if (mb_strlen($name) > 100 || mb_strlen($email) > 254 || mb_strlen($subject) > 200 || mb_strlen($message) > 5000) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Input exceeds maximum allowed length.']);
    exit;
}

if (empty($name) || empty($email) || empty($message)) {
    echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email address.']);
    exit;
}

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = $mailUsername;
    $mail->Password   = $mailPassword;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom($mailUsername, 'Portfolio Contact');
    $mail->addAddress($mailTo, 'Su Myat Noe');
    $mail->addReplyTo($email, $name);

    $mail->isHTML(true);
    $mail->Subject = "Portfolio Contact: $subject";
    $mail->Body    = "
    <html>
    <body style='font-family: Arial, sans-serif; color: #1e293b;'>
        <h2 style='color: #4f46e5;'>New Message from Portfolio</h2>
        <table style='width:100%; border-collapse:collapse;'>
            <tr><td style='padding:8px; font-weight:bold;'>Name:</td><td style='padding:8px;'>$name</td></tr>
            <tr><td style='padding:8px; font-weight:bold;'>Email:</td><td style='padding:8px;'>$email</td></tr>
            <tr><td style='padding:8px; font-weight:bold;'>Subject:</td><td style='padding:8px;'>$subject</td></tr>
            <tr><td style='padding:8px; font-weight:bold; vertical-align:top;'>Message:</td><td style='padding:8px;'>$message</td></tr>
        </table>
    </body>
    </html>
    ";
    $mail->AltBody = "Name: $name\nEmail: $email\nSubject: $subject\nMessage: $message";

    $mail->send();
    echo json_encode(['success' => true, 'message' => "Your message has been sent! I'll get back to you soon."]);
} catch (Exception $e) {
    error_log('Contact form mail error: ' . $mail->ErrorInfo);
    echo json_encode(['success' => false, 'message' => 'Failed to send message. Please try again later.']);
}
?>

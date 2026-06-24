<?php

require_once __DIR__ . '/../error_handler.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function loadPhpMailer(): void
{
    static $loaded = false;
    if ($loaded) return;

    $basePath = getenv('PHPMAILER_PATH')
        ?: (__DIR__ . '/../vendor/phpmailer/phpmailer/src');

    require_once $basePath . '/Exception.php';
    require_once $basePath . '/PHPMailer.php';
    require_once $basePath . '/SMTP.php';

    $loaded = true;
}

function createMailer(): PHPMailer
{
    loadPhpMailer();

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = $_ENV['MAIL_USERNAME'] ?? '';
    $mail->Password   = $_ENV['MAIL_PASSWORD'] ?? '';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    return $mail;
}

function getMailCredentials(): array
{
    return [
        'username' => $_ENV['MAIL_USERNAME'] ?? '',
        'password' => $_ENV['MAIL_PASSWORD'] ?? '',
        'to'       => $_ENV['MAIL_TO'] ?? '',
    ];
}

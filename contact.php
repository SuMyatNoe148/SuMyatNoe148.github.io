<?php
require_once __DIR__ . '/includes/mailer.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
    exit;
}

$name    = htmlspecialchars(trim($_POST['name'] ?? ''));
$email   = htmlspecialchars(trim($_POST['email'] ?? ''));
$subject = htmlspecialchars(trim($_POST['subject'] ?? 'Portfolio Contact'));
$message = htmlspecialchars(trim($_POST['message'] ?? ''));

if (empty($name) || empty($email) || empty($message)) {
    echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email address.']);
    exit;
}

$creds = getMailCredentials();

try {
    $mail = createMailer();
    $mail->setFrom($creds['username'], 'Portfolio Contact');
    $mail->addAddress($creds['to'], 'Su Myat Noe');
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
    echo json_encode(['success' => false, 'message' => 'Failed to send message: ' . $mail->ErrorInfo]);
}
?>

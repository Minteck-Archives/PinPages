<?php

require './email/Exception.php';
require './email/PHPMailer.php';
require './email/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendEmail ($recipient, $subject, $body, $altbody) {
    $mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'in-v3.mailjet.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = '5cc8c4eff737360997275f4cd9e3e863';                     // SMTP username
    $mail->Password   = '06b47c6cb1ff7055d8125feb2728d0ec';                               // SMTP password
    $mail->SMTPSecure = 'none';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('pinpages@minteck-projects.rf.gd', 'PinPages');
    $mail->addAddress($recipient);

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->CharSet = 'UTF-8';
    $mail->Body    = $body;
    $mail->AltBody = $altbody;

    // PHP 5.6+ fix
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    $mail->send();
    echo 'ok';
} catch (Exception $e) {
    echo "err: {$mail->ErrorInfo}";
}
}

function sendEmail_quiet ($recipient, $subject, $body, $altbody) {
    $mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'in-v3.mailjet.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = '5cc8c4eff737360997275f4cd9e3e863';                     // SMTP username
    $mail->Password   = '06b47c6cb1ff7055d8125feb2728d0ec';                               // SMTP password
    $mail->SMTPSecure = 'none';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('pinpages@minteck-projects.rf.gd', 'PinPages');
    $mail->addAddress($recipient);

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->CharSet = 'UTF-8';
    $mail->Body    = $body;
    $mail->AltBody = $altbody;

    // PHP 5.6+ fix
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    $mail->send();
} catch (Exception $e) {
}
}
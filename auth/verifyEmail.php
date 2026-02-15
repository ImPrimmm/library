<?php

            session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include '../Include/database.php';
require '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

function verifyingEmail($username, $email, $verifyToken, $from)
{
    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $_ENV['MAILUSERNAME'];                     //SMTP username
        $mail->Password   = $_ENV['MAILPASSWORD'];                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = $_ENV['MAILPORT'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom($_ENV['MAILUSERNAME'], "philibrary");
        $mail->addAddress($email, $username);     //Add a recipient
        $mail->addReplyTo('no-reply@example.com', 'Information');

        //Content
        $url = "http://localhost/philib/auth/mail.php?token=" . urlencode($verifyToken) . "&email=" . urlencode($email);

        $mail->isHTML(true);                                  //Set email format to HTML
        $email_template = "
        <h2>You have Registered your account</h2>
        <h4>Verify your email address to login with the below given link</h4></br>
        <a href='$url'>[klik disini]</a>
    ";
        $mail->Subject = 'Email verification from PhiLib';
        $mail->Body    = $email_template;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();

        if ($from === 'SignIn') {
            $_SESSION['alert'] = 'wrongVerification';
            header("Location: ../p/SignIn/index.php");
            exit;
        } else if ($from === 'SignUp') {
            $_SESSION['alert'] = 'verif';
            header("Location: ../p/SignUp/index.php");
            exit;
        }

        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

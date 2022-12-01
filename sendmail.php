<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once('vendor/autoload.php');
require_once './vendor/phpmailer/phpmailer/src/Exception.php';
require_once './vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once './vendor/phpmailer/phpmailer/src/SMTP.php';

$mail = new PHPMailer;
$mail->CharSet = 'utf-8';

// $user_name = $email = $theme = $problem = $course ='';
// $name = 'Aldar';
// $phone = '123154353';
// $email = 'aldirane@gmail.com';

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->SMTPDebug = 0;
$mail->Host = 'ssl://smtp.mail.ru';
$mail->SMTPOptions = array(
	'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
	)
);												// Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'kirubush@mail.ru'; // Ваш логин от почты с которой будут отправляться письма
$mail->Password = 'kjjDNLx6tYMx7Ys4aT6k'; // Ваш пароль от почты с которой будут отправляться письма
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = '465'; // TCP port to connect to / этот порт может отличаться у других провайдеров
$mail->CharSet = 'UTF-8';
$mail->setFrom('kirubush@mail.ru'); // от кого будет уходить письмо?
$mail->FromName = 'Алдар Манджиев';
// $mail->addAddress('kirubush@mail.ru', "симтек");               //Кому будет уходить письмо  Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
// $mail->isHTML(true);                                  // Set email format to HTML

// $mail->Subject = 'Новая запись по форме обратной связи';
// $mail->Body    = '' .$user_name . ' оставил вопрос по форме: <br> Курс: '.$course .'<br> Тема: '.$theme.'<br> Проблема: ' . $problem.'<br>';
// $mail->AltBody = '';

// if(!$mail->send()) {
//     echo $mail->ErrorInfo;
// } else {
//     echo 'Отправленно';
// }
?>
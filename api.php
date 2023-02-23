<?php 

	//Import PHPMailer classes into the global namespace
	//These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	//Load Composer's autoloader
	require 'vendor/autoload.php';

	// mail gönderilecek hostname: mail.tetayazilim.com
	// mail gönderilecek username: mailsender@tetayazilim.com
	// mail gönderilecek password: &Guo4)f9@wxw
	// mail gönderilecek port: 587

	$allowSecret=['x1231x','vvas432'];

	if ($_POST) {

		if (in_array($_POST['data']['secret'], $allowSecret)) {
		

			//Create an instance; passing `true` enables exceptions
			$mail = new PHPMailer(true);

			try {
			    //Server settings
			    $mail->SMTPDebug = 0;                      //Enable verbose debug output
			    $mail->isSMTP();                                            //Send using SMTP
			    $mail->Host       = $_POST['data']['serverInfo']['hostname'];                     //Set the SMTP server to send through
			    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			    $mail->CharSet = "UTF-8";
			    $mail->Username   = $_POST['data']['serverInfo']['username'];                     //SMTP username
			    $mail->Password   = $_POST['data']['serverInfo']['password'];                               //SMTP password
			    $mail->Port       = $_POST['data']['serverInfo']['port'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

			    //Recipients
			    $mail->setFrom($_POST['data']['serverInfo']['username']);


			    foreach ($_POST['data']['address'] as $m) {
			    	$mail->addAddress($m);
			    }

			    $mail->addReplyTo($_POST['data']['reply']);


			    foreach ($_POST['data']['cc'] as $c) {
			    	$mail->addCC($c);
			    }


			    foreach ($_POST['data']['bcc'] as $bc) {
			    	$mail->addBCC($bc);
			    }


			    //Content
			    $mail->isHTML(true);                                  //Set email format to HTML
			    $mail->Subject = $_POST['data']['subject'];
			    $mail->Body    = $_POST['data']['body'];
			    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			    $mail->send();
			    echo 'Message has been sent';
			} catch (Exception $e) {
			    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}
		}



	}else{

		echo "paramatre gönderilmedi, lütfen post ile bir parametre gönderin.";
	}


 ?>
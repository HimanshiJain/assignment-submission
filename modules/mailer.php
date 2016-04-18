<?php
	require("config.php");
	require("phpmailer/class.phpmailer.php");
	$mail = new PHPMailer();
	$mail->IsSMTP();                                      // set mailer to use SMTP
	
	$mail->SMTPAuth = true;     // turn on SMTP authentication
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	
	$mail->Port = 587;                                    // TCP port to connect to
	$mail->Host = 'smtp.gmail.com';  // specify main and backup server
	/********** CREDENTIALS *********/
	$mail->Username = $MAILER_FROM ;  // SMTP username
	$mail->Password = $MAILER_FROM_PASSWORD; // SMTP password
	/********************************/
	$mail->From = $MAILER_FROM ;
	$mail->FromName = "Assignment Admin";
	$mail->WordWrap = 400;
	$mail->IsHTML(true); // set email format to HTML
	$mail->AddReplyTo("samsam10012016@gmail.com", "ContactAssignment");
?>
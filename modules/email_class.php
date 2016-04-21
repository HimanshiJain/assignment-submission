<?php
class Email
{
	private $mail;
	public function __construct()
	{	
		global $MAILER_FROM,$MAILER_FROM_PASSWORD;

		$this->mail = new PHPMailer();
		$this->mail->IsSMTP();                                     // set mailer to use SMTP
		
		$this->mail->SMTPAuth = true;     // turn on SMTP authentication
		$this->mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		
		$this->mail->Port = 587;                                    // TCP port to connect to
		$this->mail->Host = 'smtp.gmail.com';  // specify main and backup server
		/********** CREDENTIALS *********/
		$this->mail->Username = $MAILER_FROM ;  // SMTP username
		$this->mail->Password = $MAILER_FROM_PASSWORD; // SMTP password
		/********************************/
		$this->mail->From = $MAILER_FROM ;
		$this->mail->FromName = "Assignment Admin";
		$this->mail->WordWrap = 400;
		$this->mail->IsHTML(true); // set email format to HTML
		$this->mail->AddReplyTo($MAILER_FROM, "ContactAssignment");
	}
	public function send_password_email($email,$password)
	{
		try
		{
			$this->mail->Subject = "Password for Assignment Submission System";
			$this->mail->Body    = "Password for your email id for Assignment Submission System is " . $password;
			$this->mail->AltBody = "Your Password : ".$password;
			$this->mail->AddAddress($email);
			$flag = $this->mail->Send();
		}
		catch(Exception $e)
		{
			return -1;
		}
		return 1;
	}
}

?>
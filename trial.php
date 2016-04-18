 <?php
	// require("modules/config.php");
	// $conn = new PDO("mysql:host=$SERVER;dbname=$DBNAME", $USER, $PASSWORD);
 //        // set the PDO error mode to exception
 //    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 //    $stmt=$conn->prepare("SELECT count(*) FROM user");
	// //set and execute			
	// $stmt->execute();			
	// $result = $stmt->fetchAll();
	// if(count($result)>0) 
	// { 
	// 	echo "got some result";
 //    }
	require("modules/mailer.php");
	$mail->Subject = "Password for Assignment Submission Systems";
	$mail->Body    = "Hi!";
	$mail->AltBody = "Your Password : ";
	$mail->AddAddress("ferozrockstar@gmail.com");
	$flag = $mail->Send();
?>
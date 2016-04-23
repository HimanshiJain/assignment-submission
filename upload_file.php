<?php
	require_once("modules/connection.php");
	require_once("modules/teacher.php");
	require_once("phpmailer/class.phpmailer.php");
	require_once("modules/email_class.php");
	$db=new Teacher();
	$assignment_name=$_POST['name'];
	$max_marks=$_POST['max_marks'];
	$due_date=$_POST['due_date'];
	$description=$_POST['description'];
	$reference=$_POST['references'];
	$name=$_FILES['aFile']['name'];
	$course_code=$_POST['coursecode'];
	//FIND COURSE ID
	$sql = '(SELECT course_id FROM courses WHERE course_code = ?)';
	$stmt= $conn->prepare($sql);
	$stmt->bindParam(1, $course_code);
	$stmt->execute();
	$result=$stmt->fetchAll();
	$course_id = $result[0][0];
	
	$uploadOk=1;
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES['aFile']['name']);
	$imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);

	if($imageFileType != "pdf" && $imageFileType != "txt" )
	{
	    header('Location: '.$DOCROOT.'/T1.php?uploaded='.urlencode("Only pdf and txt files are allowed"));
	    die();
	    $uploadOk = 0;
	}
	if($uploadOk==1)
	{
		if(move_uploaded_file($_FILES['aFile']['tmp_name'], $target_file))
		{
			
		}else
		{
			header('Location: '.$DOCROOT.'/T1.php?uploaded='.urlencode("Error uploading file"));
			die();
		}
	}
	//STARTING A TRANSACTION
	$conn->beginTransaction();
	$lastInsertId=$db->upload_assignment($assignment_name,$max_marks,$due_date,$description,$reference,$course_id,$target_file);
	$db->initialise_marks($lastInsertId, $course_id);
	
	// MAIL NOTIFICATION TO ALL
	$mail = new Email();
	$flag = $mail->send_notification_all($course_id,$course_code,$description,$due_date);
	if($flag == 1)//MAIL SENT EVERYONE NOTIFIED
	{
		$conn->commit();
		header('Location: '.$DOCROOT.'/T1.php?uploaded=successful');
	}
	else
	{
		$conn->rollBack();
		header('Location: '.$DOCROOT.'/T1.php?uploaded=mailnotsent');
	}
?>
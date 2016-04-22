<?php
	require_once("modules/connection.php");
	require_once("modules/student.php");
	$db=new Student();
	$student_id=$_GET['student_id'];
	$assignment_id=$_GET['assignment_id'];
	$uploadOk=1;
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES['aFile']['name']);
	$imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);

if($imageFileType != "pdf" && $imageFileType != "txt" ) {
    echo "Sorry, only pdf and txt files are allowed.";
    $uploadOk = 0;
}
if($uploadOk==1){
	if(move_uploaded_file($_FILES['aFile']['tmp_name'], $target_file)){
		echo "File successfully uploaded.";
	}else{
		echo "error uploading file";
	}
}
$db->upload_assignment($student_id,$assignment_id,$target_file);
header('Location: S2.php?uploaded=successful&assignment_id='.$assignment_id);

?>
<?php
	require_once("modules/connection.php");
	require_once("modules/teacher.php");
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
print_r($_FILES);

$lastInsertId=$db->upload_assignment($assignment_name,$max_marks,$due_date,$description,$reference,$course_id,$target_file);
echo $lastInsertId;
$db->initialise_marks($lastInsertId, $course_id);

header('Location: T1.php?uploaded=successful');

?>
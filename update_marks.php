<?php
require_once("modules/connection.php");
require_once("modules/teacher.php");
$db=new Teacher();
if(isset($_POST['student_id'])&& isset($_POST['assignment_id'])){
	
	$student_id=$_POST['student_id'];
	$assignment_id=$_POST['assignment_id'];
	$marks=$_POST['marks'];
	
	$db->mark_student($student_id,$assignment_id,$marks);
	header("Location: evaluate_assignment.php?assignment_id=".$assignment_id);
}
?>
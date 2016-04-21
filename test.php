<?php require_once("modules/connection.php");
require_once("modules/teacher.php");
$db=new Teacher();
$result=array();
$result=$db->view_marks_all_students(1);
//print_r($result);

foreach($result as $key=>$student){
	$total=0;
	echo "</br>".$student[0]['roll_no'];
	echo "&nbsp &nbsp &nbsp".$student[0]['name'];
	foreach($student as $single){
	echo "&nbsp &nbsp &nbsp".$single['assignment_name'];
	echo "&nbsp &nbsp &nbsp".$single['marks'];
	$total+=$single['marks'];
	}
	echo "&nbsp &nbsp &nbsp &nbsp total==".$total;
}




?>
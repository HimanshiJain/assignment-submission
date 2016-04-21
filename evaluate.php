<html>
<body>
<?php 
	session_start();
	require_once("modules/functions.php");
	require_once("modules/connection.php");
	require_once("modules/teacher.php");
    security_redirect_teacher();
$db=new Teacher();
$result=array();
if(isset($_GET['course_id'])) 
{
	$course_id=$_GET['course_id'];
	$teacher_id=$_SESSION['teacher_id'];
	$result=$db->get_assignments_course($course_id,$teacher_id);
	//print_r($result);
}
echo "</br></br></br></br></br>";
foreach($result as $key => $assignment){
	//echo $assignment['assignment_id'];
	?>
	</br>&nbsp <a href="evaluate_assignment.php?assignment_id=<?php echo $assignment['assignment_id']?>" >
			<?php echo $assignment['assignment_name']?></a>;
	
	&nbsp &nbsp <a href="<?php echo $assignment['filepath']?>" target="_blank">View File</a>
	<?php
	echo "&nbsp &nbsp".$assignment['due_date']."</br>";
 }

	



?>
</body>
</html>
<html>
<body>
<?php 
require_once("modules/connection.php");
require_once("modules/teacher.php");
$db=new Teacher();
$result=array();
if(isset($_GET['course_id'])&& isset($_GET['teacher_id'])){
	$course_id=$_GET['course_id'];
	$teacher_id=$_GET['teacher_id'];
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
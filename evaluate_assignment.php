<html>
<body>
<?php
require_once("modules/connection.php");
require_once("modules/teacher.php");
$db=new Teacher();
$result=array();

if(isset($_GET['assignment_id'])&& $_GET['assignment_id']!=""){
	$assignment_id=$_GET['assignment_id'];
}else {
	header("Location: upload_form.php");
}

$result=$db->get_students_for_marking($assignment_id);
echo "</br></br></br></br></br>";
foreach($result as $key => $student){
	
	?>
	</br>&nbsp <?php echo $student['roll_no']?>
	</br>&nbsp <?php echo $student['name']?>
	
	&nbsp &nbsp <a href="uploads/config.txt" target="_blank">Submitted File</a>;
	<form method="post" action="update_marks.php">
		<input type="number" name="marks" value="<?php echo $student['marks'] ?>">
		<input type="hidden" name="student_id" value="<?php echo $student['student_id']?>">
		<input type="hidden" name="assignment_id" value="<?php echo $assignment_id?>">
		<input type="submit">
	</form>
	<?php
	
 }
?>



</body>
</html>
<html>
<body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js"></script>
 <script type="text/javascript" src="js/validate_upload.js" ></script>
 
<?php 
if(isset($_GET['uploaded'])){
	echo "Upload  ".$_GET['uploaded'];
}
$course_id=1;
$teacher_id=1;
?>
	<form action="upload_file.php" method="post" enctype="multipart/form-data" id="upload_form" name="upload_form" >
		Assignment Name: <input type="text" name="name"><br>
		Maximum Marks    <input type="number" name="max_marks"><br>
		Due Date:        <input type="date" name="date"><br>
		Description:     <textarea name="description" rows="5" cols="40"></textarea><br>
		References(if any): <textarea name="references" rows="5" cols="40"></textarea><br>
		<input type="file" name="aFile" id="assignment_file"><br>
		<input type="hidden" name="course_id" value="<?php echo $course_id;?>">
		<input type="submit" name="submit">
		
	</form>
	</br>
	</br>
	</br>
	<a href="evaluate.php?course_id=<?php echo $course_id?>&teacher_id=<?php echo $teacher_id?>">Evaluate</a>

</body>
</html>
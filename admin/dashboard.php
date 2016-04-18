<?php
	session_start();
	require("../modules/functions.php");
	require("../modules/connection.php");
    security_redirect_admin();
	//OUTPUT HTML
	require("../modules/header.php");
?>
	<div id="error-box">
        <?php
            if(isset($_GET["error"]))
            {
                echo $_GET["error"];
            }
        ?>
    </div>
    <div id="message-box">
        <?php
            if(isset($_GET["msg"]))
            {
                echo $_GET["msg"];
            }
        ?>
    </div>
	<div>
		<form method="POST" action="addstudent.php">
		<fieldset>
    	<legend>Add Student</legend>
			<label for="user-name">Name</label>
            	<input name="name" id="user-name" maxlength="50" type="text">
            <label for="user-roll">Roll No.</label>
            	<input name="roll" id="user-roll" maxlength="11" type="text" placeholder="eg: 2K14/CO/111">
			<label for="user-email">Email</label>
            	<input name="email" id="user-email" maxlength="60" placeholder="Email" size="35" type="email">
            <input type="submit" name="student" value="Add Student">
		</fieldset>
		</form>
	</div>		
	<div>
		<form method="POST" action="addinstructor.php">
		<fieldset>
    	<legend>Add Instructor</legend>
			<label for="user-name">Name</label>
            	<input name="name" id="user-name" maxlength="50" type="text">
            <label for="user-code">Teacher Code</label>
            	<input name="code" id="user-code" maxlength="12" type="text" placeholder="eg: 2K14/TCO/111">
			<label for="user-email">Email</label>
            	<input name="email" id="user-email" maxlength="60" placeholder="Email" size="35" type="email">
            <input type="submit" name="instructor" value="Add Instructor">
		</fieldset>
		</form>
	</div>		
	<div>
		<form method="POST" action="addcourse.php">
		<fieldset>
    	<legend>Add Course</legend>
			<label for="course-name">Name</label>
            	<input name="name" id="course-name" maxlength="50" type="text">
            <label for="course-code">Course Code</label>
            	<input name="code" id="course-code" maxlength="12" type="text" placeholder="eg: C0-201">
            <input type="submit" name="course" value="Add Course">
		</fieldset>
		</form>
	</div>		
	<div>
		<form method="POST" action="deletecourse.php">
		<fieldset>
    	<legend>Delete Course</legend>
            <label for="course-code">Course Code</label>
            	<input name="code" id="course-code" maxlength="12" type="text" placeholder="eg: CO-201">
            <input type="submit" name="course" value="Delete Course">
		</fieldset>
		</form>
	</div>
</body>
</html>
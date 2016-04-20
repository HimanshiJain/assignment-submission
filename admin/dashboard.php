<?php
	session_start();
	require("../modules/functions.php");
	require("../modules/connection.php");
    security_redirect_admin();
	//OUTPUT HTML
	require("../modules/header.php");
?>


<div class="container">	
    <div class="row">
        <h2>Admin Panel</h2>
    </div><br>
    <?php
        if(isset($_GET["error"]))
        {
            echo "<div class=\"alert alert-danger alert-dismissible\" role=\"alert\" id=\"error-box\">".$_GET["error"]."</div>";
        }
    ?>    
    <?php
        if(isset($_GET["msg"]))
        {
            echo "<div class=\"alert alert-success alert-dismissible\" role=\"alert\" id=\"msg-box\">".$_GET["msg"]."</div>";
        }
    ?>
    <div class="row">
        <form method="POST" action="addstudent.php" class="form-inline">
        <fieldset>
        <legend>Add Student</legend>
            <label for="user-name">Name</label>
        	<input name="name" class="form-control" id="user-name" maxlength="50" type="text" required>
            <label for="user-roll">Roll No.</label>
        	<input name="roll" class="form-control" id="user-roll" maxlength="11" type="text" placeholder="eg: 2K14/CO/111" required>  
            <label for="user-email">Email</label>
        	<input name="email" class="form-control" id="user-email" maxlength="60" placeholder="Email" size="35" type="email" required>
            <input type="submit" class="btn btn-primary" name="student" value="Add Student">
        </form>
	</div>
    <br>	
	<div class="row">
		<form method="POST" action="addinstructor.php" class="form-inline">
		<fieldset>
    	<legend>Add Instructor</legend>
			<label for="user-name">Name</label>
            <input name="name" class="form-control" id="user-name" maxlength="50" type="text" required>
            <label for="user-code">Teacher Code</label>
            <input name="code" class="form-control" id="user-code" maxlength="12" type="text" placeholder="eg: 2K14/TCO/111" required>
			<label for="user-email">Email</label>
            <input name="email" class="form-control" id="user-email" maxlength="60" placeholder="Email" size="35" type="email" required >
            <input type="submit" class="btn btn-primary" name="instructor" value="Add Instructor">
		</fieldset>
		</form>
	</div>
    <br>	
	<div class="row">
		<form method="POST" action="addcourse.php" class="form-inline">
		<fieldset>
    	<legend>Add Course</legend>
			<label for="course-name">Name</label>
            <input name="name" class="form-control" id="course-name" maxlength="50" type="text" required>
            <label for="course-code">Course Code</label>
            <input name="code" class="form-control" id="course-code" maxlength="12" type="text" placeholder="eg: C0-201" required>
            <input type="submit" class="btn btn-primary" name="course" value="Add Course">
		</fieldset>
		</form>
	</div>
    <br>	
	<div class="row">
		<form method="POST" action="deletecourse.php" class="form-inline">
		<fieldset>
    	<legend>Delete Course</legend>
            <label for="course-code">Course Code</label>
            <input name="code" class="form-control" id="course-code" maxlength="12" type="text" placeholder="eg: CO-201" required>
            <input type="submit" class="btn btn-primary" name="course" value="Delete Course" >
		</fieldset>
		</form>
	</div>
</div>
</body>
</html>

<?php
    $conn = null;
?>
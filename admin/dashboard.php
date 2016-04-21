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
        <div class="col-md-11">
           <h2>Admin Panel</h2>
        </div>
        <div class="col-md-1">
            <br>
           <a href="../logout.php"><button type="button" class="btn btn-warning">Logout</button></a>
        </div>
    </div>
    <div>
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
    </div>
    <div class="row">
        <form method="POST" action="addstudent.php" class="form-inline">
        <fieldset>
        <legend>Add Student</legend>
            <div class="col-md-10">
            <label for="user-name">Name</label>
        	<input name="name" class="form-control" id="user-name" maxlength="50" type="text" required>
            <label for="user-roll">Roll No.</label>
        	<input name="roll" class="form-control" id="user-roll" maxlength="11" type="text" placeholder="eg: 2K14/CO/111" required>  
            <label for="user-email">Email</label>
        	<input name="email" class="form-control" id="user-email" maxlength="60" placeholder="Email" size="35" type="email" required>
            </div>
            <div class="col-md-2">
            <input type="submit" class="btn btn-primary" name="student" value="Add Student">
            </div>
        </form>
	</div>
    <br>	
	<div class="row">
		<form method="POST" action="addinstructor.php" class="form-inline">
		<fieldset>
    	<legend>Add Instructor</legend>
			<div class="col-md-10">
            <label for="user-name">Name</label>
            <input name="name" class="form-control" id="user-name" maxlength="50" type="text" required>
            <label for="user-code">Teacher Code</label>
            <input name="code" class="form-control" id="user-code" maxlength="12" type="text" placeholder="eg: 2K14/TCO/111" required>
			<label for="user-email">Email</label>
            <input name="email" class="form-control" id="user-email" maxlength="60" placeholder="Email" size="35" type="email" required >
            </div>
            <div class="col-md-2">
            <input type="submit" class="btn btn-primary" name="instructor" value="Add Instructor">
            </div>
		</fieldset>
		</form>
	</div>
    <br>	
	<div class="row">
		<form method="POST" action="addcourse.php" class="form-inline">
		<fieldset>
    	<legend>Add Course</legend>
			<div class="col-md-10">
            <label for="course-name">Name</label>
            <input name="name" class="form-control" id="course-name" maxlength="50" type="text" required>
            <label for="course-code">Course Code</label>
            <input name="code" class="form-control" id="course-code" maxlength="12" type="text" placeholder="eg: C0-201" required>
            </div>
            <div class="col-md-2">
            <input type="submit" class="btn btn-primary" name="course" value="Add Course">
            </div>
		</fieldset>
		</form>
	</div>
    <br>	
	<div class="row">
		<form method="POST" action="deletecourse.php" class="form-inline">
		<fieldset>
    	<legend>Delete Course</legend>
            <div class="col-md-10">
            <label for="course-code">Course Code</label>
            <input name="code" class="form-control" id="course-code" maxlength="12" type="text" placeholder="eg: CO-201" required>
            </div>
            <div class="col-md-2">
            <input type="submit" class="btn btn-primary" name="course" value="Delete Course" >
            </div>
		</fieldset>
		</form>
	</div>
</div>
</body>
</html>

<?php
    $conn = null;
?>
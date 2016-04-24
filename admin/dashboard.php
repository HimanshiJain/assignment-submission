<?php
	session_start();
	require_once("../modules/functions.php");
	require_once("../modules/connection.php");
    require_once("../modules/admin_class.php");
    security_redirect_admin();
	//GENERATING COUSRE LIST FOR ADD STUDENT
    
    $db = new Admin();
    $all_courses = $db->getallcourse();
    $html_student_course_form = '';
    $i = 1;
    foreach ($all_courses as $course)
    {
        $html_student_course_form .='<tr>';
        $html_student_course_form .='<td>'.$i.'</td>';
        $html_student_course_form .='<td>'.$course["course_code"] .'</td>';
        $html_student_course_form .='<td>'.$course["name"].'</td>';
        $html_student_course_form .='<td class="text-center">&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="course_applied[]" value="'.$course["course_id"].'" ></td></tr>';
        $i += 1;
    }
    //OUTPUT HTML
?>
<?php 
    require("../modules/admin_header.php"); 
?>
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

    <div id="content2" class="span" style="margin-left: 0px;">
        <div class="row sortable">        
            <div class="box span12">
                <div class="box-header" data-original-title>
                    <h2><span class="break"></span>Add Student</h2>
                </div>
                
                <div class="box-content">
                    <form method="POST" action="addstudent.php" class="form-inline">
                    
                        <div class="col-md-10">
                        <label for="user-name">Name</label>
                        <input name="name" class="form-control" id="user-name" maxlength="50" type="text" required>
                        <label for="user-roll">Roll No.</label>
                        <input name="roll" class="form-control" id="user-roll" maxlength="11" type="text" placeholder="eg: 2K14/CO/111" required>  
                        <label for="user-email">Email</label>
                        <input name="email" class="form-control" id="user-email" maxlength="60" placeholder="Email" size="35" type="email" required>
                        </div>
                                                    
                        <h3>Add the courses for the student</h3>
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                            <thead>
                              <tr>
                                  <th>S. No.</th>
                                  <th>Course Code</th>
                                  <th>Course Name</th>
                                  <th>Action</th>
                              </tr>
                            </thead>   
                            <tbody>
                            <?php echo $html_student_course_form; ?>        
                            </tbody>
                        </table>
                        <div class="col-md-2">
                            <input type="submit" class="btn btn-primary" name="student" value="Add Student">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row sortable">        
            <div class="box span12">
                <div class="box-header" data-original-title>
                    <h2><span class="break"></span>Add Teacher</h2>
                </div>
                <div class="box-content">
                    <form method="POST" action="addinstructor.php" class="form-inline">
                    
                        <div class="col-md-10">
                        <label for="user-name">Name</label>
                        <input name="name" class="form-control" id="user-name" maxlength="50" type="text" required>
                        <label for="user-code">Teacher Code</label>
                        <input name="code" class="form-control" id="user-code" maxlength="12" type="text" placeholder="eg: 2K14/TCO/111" required>
                        <label for="user-email">Email</label>
                        <input name="email" class="form-control" id="user-email" maxlength="60" placeholder="Email" size="35" type="email" required >
                        </div><br>
                        <div class="col-md-2">
                        <input type="submit" class="btn btn-primary" name="instructor" value="Add Instructor">
                        </div>
                    
                    </form> 
                </div>
            </div>
        </div>
        <div class="row-fluid">        
            <div class="box span6">
                <div class="box-header" data-original-title>
                    <h2><span class="break"></span>Add Course</h2>
                </div>
                
                <div class="box-content">
                    <form method="POST" action="addcourse.php" class="form-inline">
                    
                        <div class="col-md-10">
                        <label for="course-name">Name</label>
                        <input name="name" class="form-control" id="course-name" maxlength="50" type="text" required><br><br>
                        <label for="course-code">Course Code</label>
                        <input name="code" class="form-control" id="course-code" maxlength="12" type="text" placeholder="eg: C0-201" required>
                        </div><br>
                        <div class="col-md-2">
                        <input type="submit" class="btn btn-primary" name="course" value="Add Course">
                        </div>
                    
                    </form>
                </div>
            </div>
            
            <div class="box span6">
                <div class="box-header" data-original-title>
                    <h2><span class="break"></span>Delete Courses</h2>
                </div>
                
                <div class="box-content">
                    <form method="POST" action="deletecourse.php" class="form-inline">
                
                        <div class="col-md-10">
                        <label for="course-code">Course Code</label>
                        <input name="code" class="form-control" id="course-code" maxlength="12" type="text" placeholder="eg: CO-201" required>
                        </div><br><br><br>
                        <div class="col-md-2">
                        <input type="submit" class="btn btn-primary" name="course" value="Delete Course" >
                        </div>                    
                    </form>
                </div>
            </div>
        </div>  
    </div>
<?php 
    require("../modules/admin_footer.php"); 
?>
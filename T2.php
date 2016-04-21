<?php
	session_start();
	require_once("modules/functions.php");
	require_once("modules/connection.php");
	require_once("modules/teacher.php");
    security_redirect_teacher();
    if(!isset($_SESSION["course_code"]))
    {
    	$db = new Teacher();
		$db->initialise_courseid();
    }
    $course_id = $_SESSION["course_code"];
	$teacher_id = $_SESSION["teacher_id"];
?>

<?php
	//INCLUDING HEADER
	require("modules/teacher_header.php");
?>
        <!-- start: Content -->
			<div id="content" class="span10">
			<div class="row-fluid">
				
				<div class="span3 statbox yellow" onTablet="span6" onDesktop="span3">
					<div class="new"> <a href="T1.php"> UPLOAD ASSIGNMENT </a></div>
	           
                </div>
				<div class="span3 statbox green" onTablet="span6" onDesktop="span3">
				    <div class="new"> <a href="T2.php"> EVALUATE ASSIGNMENT </a></div>
	            </div>
				<div class="span3 statbox blue noMargin" onTablet="span6" onDesktop="span3">
				    <div class="new"> <a href="T4.html"> VIEW MARKS </a></div>
	            </div>
			</div>		
                
        			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><span class="break"></span>Assignments</h2>
				    </div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
                                  <th>Assignment Name</th>
								  <th>File</th>
								  <th>Due Date</th>
							  </tr>
						  </thead>   
						  <tbody>
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
							<tr>
                                <td> <a href="evaluate_assignment.php?assignment_id=<?php echo $assignment['assignment_id']?>" >
			<?php echo $assignment['assignment_name']?></a></td>
                                <td class="center"><a href="<?php echo $assignment['filepath']?>" target="_blank">View File</a></td>
								<td class="center"><?php echo $assignment['due_date'];?></td>
				            </tr>
							<?php
								
							 }
							?>
                            </tbody>
                        </table>
                    </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    <!--/INCLUDING FOOTER-->	
<?php
	require("modules/teacher_footer.php");
?>
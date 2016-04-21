<?php
	session_start();
	require_once("modules/functions.php");
	require_once("modules/connection.php");
	require_once("modules/teacher.php");
    security_redirect_teacher();
    $db = new Teacher();
	$courses_taught = $db->get_courses_taught($_SESSION["teacher_id"]);
    $html_courses_already = "";
    $i = 1;
    foreach ($courses_taught as $course)
    {
    	$html_courses_already .= '	
		<tr>
            <td>'. (string)$i .'</td>
            <td class="center">'.$course["course_code"].'</td>
			<td class="center">'.$course["name"].'</td>
            <td class="center">
            <a href="addremovecourse.php?delete='.urlencode($course["course_code"]).'">
            <button type="button" class="btn btn-danger">Delete '.$course["course_code"].'</button>
            </a>
            </td>
		</tr>';
		$i += 1;
    }
    $courses_not_taught = $db->get_courses_not_taught($_SESSION["teacher_id"]);
    $html_courses_not_taken = "";
    $i = 1;
    foreach ($courses_not_taught as $course)
    {
    	$html_courses_not_taken .= '	
		<tr>
            <td>'. (string)$i .'</td>
            <td class="center">'.$course["course_code"].'</td>
			<td class="center">'.$course["name"].'</td>
            <td class="center">
            <a href="addremovecourse.php?add='.urlencode($course["course_code"]).'">
            <button type="button" class="btn btn-success">Add '.$course["course_code"].'</button>
            </a>
            </td>
		</tr>';
		$i += 1;
    }
?>

<?php
	//INCLUDING HEADER
	require("modules/teacher_header.php");
?>
        <!-- start: Content -->
			<div id="content" class="span10">
			   	<div class="row-fluid sortable">		
					<div class="box span12">
						<div class="box-header" data-original-title>
							<h2><span class="break"></span>Courses Assigned</h2>
					    </div>
					    <?php 
							if(isset($_GET['deleted']) && $_GET['deleted'] =="1")
								echo 
								'<div class="alert alert-success">
						  			<strong>Successfully removed!</strong> 
								</div>';
							else if(isset($_GET['deleted']) && $_GET['deleted'] =="0")
								echo 
								'<div class="alert alert-info">
									<strong>Error!</strong>
								</div>';
							else {}
						?>
						<div class="box-content">
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
								<?php echo $html_courses_already;?>				
	 		                    </tbody>
	                        </table>
	                    </div>
	                </div>
	            </div>
		        <div class="row-fluid sortable">		
					<div class="box span12">
						<div class="box-header" data-original-title>
							<h2><span class="break"></span>Courses that are currently not taken by you</h2>
					    </div>
				    	<?php 
							if(isset($_GET['added']) && $_GET['added'] =="1")
								echo 
								'<div class="alert alert-success">
						  			<strong>Successfully added!</strong> 
								</div>';
							else if(isset($_GET['added']) && $_GET['added'] =="0")
								echo 
								'<div class="alert alert-info">
									<strong>Error!</strong>
								</div>';
							else {}
						?>
						<div class="box-content">
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
								<?php echo $html_courses_not_taken;?>				
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
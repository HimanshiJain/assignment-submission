<?php
	session_start();
	require_once("modules/functions.php");
	require_once("modules/connection.php");
	require_once("modules/student.php");
	security_redirect_student();
	$st = new Student();
	$student_id = $_SESSION["student_id"];

?>
	<?php 
		require("modules/student_header.php"); 
	?>
    <br> <br> <br> 
    	<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><span class="break"></span>Assignments List</h2>
				    </div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
                                  <th>Course Name</th>
                                  <th>Assignment Name</th>
                                  <th>Due Date</th>
							  </tr>
						  </thead>   
						  <tbody>
							  <?php 
							  
								$result=$st->get_dasboard_assignments($student_id);
								foreach($result as $key=>$student){
									?>
								
							<tr>
                                <td class="center"><?php echo $student['course_code'];?></td>
								<td class="center"><a href="s2.php?assignment_id=<?php echo $student['assignment_id']?>"><?php echo $student['assignment_name'];?></td>
                                <td class="center"><?php echo $student['due_date'];?></td>
                            </tr>
                           <?php };
							  ?>
                            </tbody>
                        </table>
                    </div>
            	</div>
    	</div>
<?php 
	require("modules/student_footer.php"); 
?>
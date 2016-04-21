<?php
	session_start();
	require_once("modules/functions.php");
	require_once("modules/connection.php");
	require_once("modules/student.php");
	security_redirect_student();
	$st=new Student();
	$student_id = $_SESSION["student_id"];
	$assignment_id = $_GET['assignment_id'];
?>
	<?php 
		require("modules/student_header.php"); 
	?>
    <br> <br> <br> 
        <div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Assignment Submission : ABC-001</h2>
				<!--		<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div> -->
					</div>
					<div class="box-content">
					<?php 
							  
								$result=$st->get_assignment_details($assignment_id);
								foreach($result as $key){
									?>
                        <p class="new3"> 
                            Assignment Name : <?php echo $key['assignment_name'];?> <br> <br>
                            Assignment Link: <a href="<?php echo $key['filepath'];?>" target="_blank">View</a> <br> <br>
                            Description : <?php echo $key['description'];?> <br> <br>
                            References : <?php echo $key['reference'];?> <br> <br>
                            Maximum Marks : <?php echo $key['max_marks'];?> <br> <br>
                            Due Date : <?php echo $key['due_date'];?> <br> <br>
                            
                        </p>
								<?php };?>
						<form class="form-horizontal">
                            <fieldset>
							<div class="control-group">
							  <label class="control-label" for="fileInput">File Path </label>
							  <div class="controls">
								<input class="input-file uniform_on" id="fileInput" type="file">
							  </div>
							</div>
                    		<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Submit Assignment</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>
					</div>
				</div>
			</div>
<?php 
	require("modules/student_footer.php"); 
?>
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
                       <ul class="messagesList">
						
						<li>
							<span class="from">Assignment Name : </span><span class="title"><?php echo $key['assignment_name'];?></span>
						</li>
                        <li>
							<span class="from">Assignment : </span><span class="title"><a href="<?php echo $key['filepath'];?>" target="_blank"><u>View</u></a></span>
						</li>
				        <li>
							<span class="from">Description : </span><span class="title"><?php echo $key['description'];?></span>
						</li>
                        <li>
							<span class="from">References : </span><span class="title"><?php echo $key['reference'];?></span>
						</li>
                        <li>
							<span class="from">Maximum Marks : </span><span class="title"><?php echo $key['max_marks'];?></span>
						</li>
                        <li>
							<span class="from">Due Date : </span><span class="title"><?php echo $key['due_date'];?></span>
						</li>
						</ul>
								<?php };
								if(!$st->uploaded($student_id,$assignment_id)){
								?>
						<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="upload_student_file.php?student_id=<?php echo $student_id?>&assignment_id=<?php echo $assignment_id?>">
                            <fieldset>
							<div class="control-group">
							  <label class="control-label" for="fileInput">File Path </label>
							  <div class="controls">
								<input class="input-file uniform_on" id="fileInput" type="file" name="aFile">
							  </div>
							</div>
                    		<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Submit Assignment</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>
						<?php
								}else {
									$result=$st->get_uploaded_file($student_id,$assignment_id);
									if(isset($_GET['uploaded']) && $_GET['uploaded']=="successful"){
									
									?>
								<div class="alert alert-success">
									<strong>Successfully uploaded!</strong> 
								</div>
								<span class="from">Uploaded Solution : </span><span class="title"><a href="<?php echo $result[0][0];?>" target="_blank"><u>View</u></a></span>
								
								<?php
								}else{?>
								<div class="alert alert-success">
									<strong>Already Submitted!</strong> 
								</div>
								<span class="from">Uploaded Solution : </span><span class="title"><a href="<?php echo $result[0][0];?>" target="_blank"><u>View</u></a></span>
									<?php
								}
								}?>
					</div>
				</div>
			</div>
<?php 
	require("modules/student_footer.php"); 
?>
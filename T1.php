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
    if(isset($_GET["coursecode"]))
    {
    	$_SESSION["course_code"] = urldecode($_GET["coursecode"]);
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
				    <div class="new"> <a href="T2.php?course_id=<?php echo $course_id?>&teacher_id=<?php echo $teacher_id?>"> EVALUATE ASSIGNMENT </a></div>
	            </div>
				<div class="span3 statbox blue noMargin" onTablet="span6" onDesktop="span3">
				    <div class="new"> <a href="T4.php"> VIEW MARKS </a></div>
	            </div>
			</div>		

            <div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Assignment Details</h2>
				<!--		<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div> -->
					</div>
					
					
						<?php 
						if(isset($_GET['uploaded'])&&$_GET['uploaded']=="successful" ){?>
						<div class="alert alert-success">
						  <strong>Successfully uploaded!</strong> 
						</div>
						<?php	
						}else if(isset($_GET['uploaded'])){
							?>
							<div class="alert alert-info">
								  <strong>Error Uploading!</strong>
								</div>
							<?php
						}
						
						?>
						
					
					
					<div class="box-content" >
						<form class="form-horizontal" action="upload_file.php" method="post" enctype="multipart/form-data" id="upload_form" name="upload_form">
						  <fieldset>
						  	<div class="form-group">
							    <label class="col-sm-2 control-label" for="course-code">For Course</label>
							    <div class="controls">
							    <input class="form-control" name="coursecode" id="course" type="text" placeholder="<?php echo $_SESSION['course_code']; ?>" disabled>
							    </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Assignment Name </label>
				                <div class="controls">
				                <input type="text" name="name" class="span6 typeahead" id="typeahead" >
				                </div>
							</div>
							<!--div class="control-group">
							  <label class="control-label" for="typeahead">Assignment ID </label>
				                <div class="controls">
				                <input type="text" class="span6 typeahead" id="typeahead">
				                </div>
							</div-->
							<div class="control-group">
							  <label class="control-label" for="typeahead">Description </label>
				                <div class="controls">
                                    <textarea rows="3" name="description" class="span6 typeahead" id="typeahead"></textarea>
				                </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="fileInput">File Path </label>
							  <div class="controls">
								<input class="input-file uniform_on" id="fileInput" type="file" name="aFile">
							  </div>
							</div>
                            <div class="control-group">
							  <label class="control-label" for="typeahead">References </label>
				                <div class="controls">
                                    <textarea rows="3" name="references" class="span6 typeahead" id="typeahead"></textarea>
				                </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Maximum Marks </label>
				                <div class="controls">
				                <input type="number" name="max_marks" class="span6 typeahead" id="typeahead">
				                </div>
							</div>
							<!-- <input type="hidden" name="course_id" value="<?php echo $course_id;?>"> -->
							  <div class="control-group">
							  <label class="control-label" for="date01">Due Date </label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date01" name="due_date" >
							  </div>
							</div>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Upload Assignment</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>		                
                    </div>
                    </div>
                </div>
                
            </div>
            
			<!-- end: Content -->
		</div><!--/#content.span10-->
	</div><!--/fluid-row-->	
<!--/INCLUDING FOOTER-->	
<?php
	require("modules/teacher_footer.php");
?>

<?php
		
		session_start();
	require_once("modules/functions.php");
	require_once("modules/connection.php");
	require_once("modules/teacher.php");
    security_redirect_teacher();
		$db=new Teacher();
		$result=array();

		if(isset($_GET['assignment_id'])&& $_GET['assignment_id']!=""){
			$assignment_id=$_GET['assignment_id'];
		}else {
			header("Location: T1.php");
			
		}
		$course_id = $_SESSION["course_code"];
	$teacher_id = $_SESSION["teacher_id"];
					
		?>
		
<?php
	//INCLUDING HEADER
	require("modules/teacher_header.php");
?>
			<div id="content" class="span10">
			

			<div class="row-fluid">
				
				<div class="span3 statbox yellow" onTablet="span6" onDesktop="span3">
					<div class="new"> <a href="T1.php"> UPLOAD ASSIGNMENT </a></div>
	           
                </div>
				<div class="span3 statbox green" onTablet="span6" onDesktop="span3">
				    <div class="new"> <a href="T2.php"> EVALUATE ASSIGNMENT </a></div>
	            </div>
				<div class="span3 statbox blue noMargin" onTablet="span6" onDesktop="span3">
				    <div class="new"> <a href="T4.php"> VIEW MARKS </a></div>
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
                                  <th>Roll No.</th>
								  <th>Name</th>
								  <th>Assignment</th>
                                  <th>Marks</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php


							$result=$db->get_students_for_marking($assignment_id);
							foreach($result as $key => $student){
								
						   ?>
							<tr>
                                <td class="center"><?php echo $student['roll_no']?></td>
								<td class="center"><?php echo $student['name']?></td>
                                <td class="center"><a href="<?php echo $student['filepath'];?>" target="_blank">Submitted File</a></td>
								<td class="center"><form method="post" action="update_marks.php">
									<input type="number" name="marks" value="<?php echo $student['marks'] ?>">
									<input type="hidden" name="student_id" value="<?php echo $student['student_id']?>">
									<input type="hidden" name="assignment_id" value="<?php echo $assignment_id?>">
									<input type="submit">
								</form></td>
				            </tr>
							<?php
							};
							?>
                            </tbody>
                        </table>
                    </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    	<!-- start: JavaScript-->
        <script src="js/jquery-1.9.1.min.js"></script>
        <script src="js/jquery-migrate-1.0.0.min.js"></script>
	    <script src="js/jquery-ui-1.10.0.custom.min.js"></script>
		<script src="js/jquery.ui.touch-punch.js"></script>
		<script src="js/modernizr.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.cookie.js"></script>
		<script src='js/fullcalendar.min.js'></script>
		<script src='js/jquery.dataTables.min.js'></script>
		<script src="js/excanvas.js"></script>
        <script src="js/jquery.flot.js"></script>
        <script src="js/jquery.flot.pie.js"></script>
	    <script src="js/jquery.flot.stack.js"></script>
        <script src="js/jquery.flot.resize.min.js"></script>
		<script src="js/jquery.chosen.min.js"></script>
		<script src="js/jquery.uniform.min.js"></script>
		<script src="js/jquery.cleditor.min.js"></script>
		<script src="js/jquery.noty.js"></script>
		<script src="js/jquery.elfinder.min.js"></script>
		<script src="js/jquery.raty.min.js"></script>
		<script src="js/jquery.iphone.toggle.js"></script>
		<script src="js/jquery.uploadify-3.1.min.js"></script>
		<script src="js/jquery.gritter.min.js"></script>
		<script src="js/jquery.imagesloaded.js"></script>
		<script src="js/jquery.masonry.min.js"></script>
		<script src="js/jquery.knob.modified.js"></script>
		<script src="js/jquery.sparkline.min.js"></script>
		<script src="js/counter.js"></script>
		<script src="js/retina.js"></script>
		<script src="js/custom.js"></script>
	    <!-- end: JavaScript-->

    </body>
</html>
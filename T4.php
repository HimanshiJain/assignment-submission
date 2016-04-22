<?php

	session_start();
	require_once("modules/functions.php");
	require_once("modules/connection.php");
	require_once("modules/teacher.php");
    security_redirect_teacher();
    
    $course_code = $_SESSION["course_code"];
	$teacher_id = $_SESSION["teacher_id"];
								$result=array();
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
                                  <th>Roll Number</th>
								  <th>Name</th>
								  <?php 
								  $res=$db->get_no_of_assignments_view($course_code);
								  
								  for($i=0;$i<$res[0][0];$i+=1){?>
                                  <th>A<?php echo $i+1?></th>
								  <?php
								  }?>
                                  <th>Cummulative</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
						  $result=$db->view_marks_all_students($course_code);
						  foreach($result as $key=>$student){
							$total=0;
							?>
							<tr>
                                <td><?php echo $student[0]['roll_no']?></td>
								<td><?php echo $student[0]['name']?></td>
							<?php
							foreach($student as $single){
								$total+=$single['marks'];
								?>
								<td class="center"><?php echo $single['marks']?></td>
							<!--echo "&nbsp &nbsp &nbsp".$single['assignment_name'];-->
							<?php
							
							}
							?>
							<td class="center"><?php echo $total?></td>
							<?php
							
						}
						  ?>
							
                                
								
				            </tr>
                            
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
<?php
	session_start();
	require_once("modules/functions.php");
	require_once("modules/connection.php");
	require_once("modules/teacher.php");
    security_redirect_teacher();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Bootstrap Metro Dashboard by Dennis Ji for ARM demo</title>
	<meta name="description" content="Bootstrap Metro Dashboard">
	<meta name="author" content="Dennis Ji">
	<meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->		
</head>

<body>
<?php 
$course_id=1;
$teacher_id=1;?>
<!-- start: Header -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index.html"><span>WECLOME XYZ</span></a>
								
				<!-- start: Header Menu -->
				<div class="nav-no-collapse header-nav">
					<ul class="nav pull-right">
						
						<!-- start: User Dropdown -->
						<li class="dropdown">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white user"></i> 
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								
								<li class="dropdown-menu-title">
 									<span>Account Settings</span>
								</li>
								<li><a href="modifycoursetaught.php"><i class="halflings-icon off"></i> Modify Courses</a></li>
								<li><a href="logout.php"><i class="halflings-icon off"></i> Logout</a></li>
							</ul>
						</li>
						<!-- end: User Dropdown -->
					</ul>
				</div>
				<!-- end: Header Menu -->
				
			</div>
		</div>
	</div>
    
<!-- start: Header -->
	
    <div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
			<?php
				require("modules/fetchcourses.php");
			?>
			<!-- end: Main Menu -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
	
        <!-- start: Content -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="T1.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
        		<li>
					<i class="icon-edit"></i>
					<a href="#">Upload</a>
				</li>
		
            </ul>

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
							<input type="hidden" name="course_id" value="<?php echo $course_id;?>">
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
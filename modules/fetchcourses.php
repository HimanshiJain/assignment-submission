<?php
	$db = new Teacher();
	$courses_taught = $db->get_courses_taught($_SESSION["teacher_id"]);
    $html_courses = "";
	$html_courses .= 
	'<div id="sidebar-left" class="span2">
		<div class="nav-collapse sidebar-nav">
			<ul class="nav nav-tabs nav-stacked main-menu">';
	foreach ($courses_taught as $course) 
	{
    	$html_courses .= '<li><a href=""><span class="hidden-tablet">'.$course["course_code"]." : ".$course["name"].'</span></a></li>';
	}
	$html_courses .=
			'</ul>
		</div>
	</div>';
	echo $html_courses;
?>
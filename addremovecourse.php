<?php
	session_start();
	require_once("modules/functions.php");
	require_once("modules/connection.php");
	require_once("modules/teacher.php");
    security_redirect_teacher();
    $db = new Teacher();
    $redirect_url = $DOCROOT.'/modifycoursetaught.php';
    if(isset($_GET["add"]))
    {
    	$course_code = urldecode($_GET["add"]);
    	$teacher_id = $_SESSION["teacher_id"];
    	$flag = $db->add_course($teacher_id,$course_code);
    	header('Location: '.$redirect_url.'?added='.$flag);    		
    }
    else if(isset($_GET["delete"]))
    {
    	$course_code = urldecode($_GET["delete"]);
    	$teacher_id = $_SESSION["teacher_id"];
    	$flag = $db->delete_course($teacher_id,$course_code);
    	header('Location: '.$redirect_url.'?deleted='.$flag);  
    }
    else
    {
    	//nothing
    	header('Location: '.$redirect_url);
    }
?>
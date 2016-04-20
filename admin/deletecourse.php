<?php
	session_start();
	require_once("../modules/functions.php");
	require_once("../modules/connection.php");
	require_once("../phpmailer/class.phpmailer.php");
	require_once("../modules/email_class.php");
	require_once("../modules/admin_class.php");
	security_redirect_admin();
	$admin = new Admin();
	$flag = $admin->deletecourse($_POST["code"]);
	if($flag == 1)
	{
		header('Location: dashboard.php?msg='.urlencode("Course deleted successfully"));
	}
	elseif($flag == -2)
	{
		header('Location: dashboard.php?error='.urlencode("Course code does not exist"));
	}
	else
	{
		header('Location: dashboard.php?error='.urlencode("Unexpected Error, Try After sometime"));
	}
?>
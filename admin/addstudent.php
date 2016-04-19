<?php
	session_start();
	require_once("../modules/functions.php");
	require_once("../modules/connection.php");
	require_once("../phpmailer/class.phpmailer.php");
	require_once("../modules/email_class.php");
	require_once("../modules/admin_class.php");
	security_redirect_admin();
	$admin = new Admin();
	$flag = $admin->addstudent($_POST["name"],$_POST["roll"],$_POST["email"]);
	if($flag == 1)
	{
		header('Location: dashboard.php?msg='.urlencode("Student Successfully Added"));
	}
	elseif($flag == -2)
	{
		header('Location: dashboard.php?error='.urlencode($_POST["email"] . "already exists"));
	}
	elseif($flag == -3)
	{
		header('Location: dashboard.php?error='.urlencode("Student with roll no" . $_POST["roll"] . "already exists"));
	}
	else
	{
		header('Location: dashboard.php?error='.urlencode("Unexpected Error, Try After sometime"));
	}
?>
<?php
	session_start();
	require_once("../modules/functions.php");
	require_once("../modules/connection.php");
	require_once("../phpmailer/class.phpmailer.php");
	require_once("../modules/email_class.php");
	require_once("../modules/admin_class.php");
	security_redirect_admin();
	$admin = new Admin();
	echo "ADDING INSTRUCTOR";
	$flag = $admin->addinstructor($_POST["name"],$_POST["code"],$_POST["email"]);
	echo $flag;
	/*
	if($flag == 1)
	{
		header('Location: dashboard.php?msg='.urlencode("Instructor added Successfully"));
	}
	elseif($flag == -2)
	{
		header('Location: dashboard.php?error='.urlencode($_POST["email"] . "already exists"));
	}
	elseif($flag == -3)
	{
		header('Location: dashboard.php?error='.urlencode("Instructor with code " . $_POST["code"] . "already exists"));
	}
	else
	{
		header('Location: dashboard.php?error='.urlencode("Unexpected Error, Try After sometime"));
	}*/
?>
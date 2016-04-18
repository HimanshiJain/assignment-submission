<?php
	session_start();
	require("../modules/functions.php");
	require("../modules/connection.php");
	require("../modules/admin_class.php");
	security_redirect_admin();
	$admin = new Admin();
	$flag = $admin->addstudent($_POST["name"],$_POST["code"],$_POST["email"]);
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
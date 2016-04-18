<?php
	session_start();
	require("../modules/functions.php");
	require("../modules/connection.php");
	require("../modules/admin_class.php");
	security_redirect_admin();
	$admin = new Admin();
	$flag = $admin->addinstructor($_POST["name"],$_POST["roll"],$_POST["email"]);
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
	}
?>
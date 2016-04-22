<?php
function redirect()
{
	global $DOCROOT;
	if(isset($_SESSION["logged_in"]))
	{
		if($_SESSION["logged_in"] == 0)
		{
			header('Location: '.$DOCROOT.'/admin/dashboard.php');
		}
		elseif($_SESSION["logged_in"] == 1)
		{
			//header('Location: '.$DOCROOT.'/instructor/dashboard.php');
			header('Location: '.$DOCROOT.'/T1.php');
		}
		elseif($_SESSION["logged_in"] == 2)
		{
			header('Location: '.$DOCROOT.'/s1.php');
		}
		else
		{
			//report bug to dev message, invalid redirect call
			header('Location: '.$DOCROOT.'/index.php?error');
		}
	}
	else
	{
		//you need to login first
		header('Location: '.$DOCROOT.'/index.php?error=Please login first');
	}
}
function security_redirect_admin()
{
	if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == 0)
	{
		//do nothing
	}
	else
	{
		redirect();
	}
}
function security_redirect_student()
{
	if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == 2)
	{
		//do nothing
	}
	else
	{
		redirect();
	}
}
function security_redirect_teacher()
{
	if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == 1)
	{
		//do nothing
	}
	else
	{
		redirect();
	}
}

?>
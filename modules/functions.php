<?php
function redirect()
{
	if(isset($_SESSION["logged_in"]))
	{
		if($_SESSION["logged_in"] == 0)
		{
			header('Location: admin/dashboard.php');
		}
		elseif($_SESSION["logged_in"] == 1)
		{
			header('Location: instructor/dashboard.php');
		}
		elseif($_SESSION["logged_in"] == 2)
		{
			header('Location: student/dashboard.php');
		}
		else
		{
			//report bug to dev message, invalid redirect call
			header('Location: index.php?error');
		}
	}
	else
	{
		//you need to login first
		header('Location: index.php?error');
	}
}


?>
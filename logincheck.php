<?php
    session_start();
    if(isset($_SESSION["logged_in"]) &&  $_SESSION["logged_in"]== 1)
    {
    	//redirect to dashboard

    }
    else if(isset($_SESSION["formid"]))
    {
    	if($_POST["formid"]==$_SESSION["formid"])
    	{ //request came from login page

    	}
    	else
    	{
    		//some unusual activity
    		//redirect to login page
    	}
    }
    else
    {


    }
?>
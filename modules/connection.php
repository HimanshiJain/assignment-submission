<?php
	require("config.php");
	try
	{
		$conn = new PDO("mysql:host=$SERVER;dbname=$DBNAME", $USER, $PASSWORD);
        // set the PDO error mode to exception
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (Exception $e)
	{
		//send $e message
		header('Location: '.$DOCROOT.'/index.php?error=dbconn');
	}
?>
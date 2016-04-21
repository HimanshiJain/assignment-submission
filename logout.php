<?php
    session_start();
    require("modules/config.php");
    require("modules/functions.php");
	session_destroy();
	header('Location: '.$DOCROOT);
?>
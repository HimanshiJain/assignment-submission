<?php
    session_start();
    require("modules/connection.php");// we get $conn  as connection to DB object.
    require("modules/functions.php");
    if(isset($_SESSION["logged_in"]))//already logged in
    {
    	//redirect to dashboard
    	redirect();//takes care on the bases of $_SESSION["logged_in"]
    }
    else if(isset($_SESSION["formid"]))
    {

    	if($_POST["formid"]==$_SESSION["formid"])
    	{ 
    		unset($_SESSION["formid"]);
    		//request came from login page
    		$stmt=$conn->prepare("SELECT password,type FROM user Where email LIKE :em ;");
		    //bind
			$stmt->bindParam(':em',$_POST["email"]);
			//set and execute			
			$stmt->execute();			
			$result = $stmt->fetchAll();
			if(count($result)>0) 
			{ 
				$encrypt_password = $_POST["password"];
				if($result[0]["password"] == $encrypt_password)
				{
					//login successful
					//logged_in =0 for admin
					//			=1 for instructor
					//			=2 for student
					$_SESSION["logged_in"] = $result[0]["type"];
					redirect();
				}
				else
				{
					//wrong password
					header('Location: index.php');
				}
		    }
		    else
		    {
		    	//redirect to login
		    	//wrong email
		    	header('Location: index.php');
		    }
    	}
    	else
    	{	//wrong form id
    		//some unusual activity
    		unset($_SESSION["formid"]);
    		//redirect to login page
    		header('Location: index.php');
    	}
    }
    else
    {
    	//means someone tried to open logincheck.php directly and he is not logged in
    	header('Location: index.php');
    }
?>
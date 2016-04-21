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
    		$stmt=$conn->prepare("SELECT password,type,user_id FROM user Where email LIKE :em ;");
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
					$_SESSION["user_id"] = $result[0]["user_id"];
					switch($_SESSION["logged_in"])
					{
						case 0 :$stmt=$conn->prepare("SELECT admin_id FROM admin Where user_id = :uid ;");
								$stmt->bindParam(':uid',$_SESSION["user_id"]);	
								$stmt->execute();		
								$result = $stmt->fetchAll();
								if(count($result) > 0)
								{
									$_SESSION["admin_id"] = $result[0][0];
								}
								else
								{
									header('Location: index.php?error='.urlencode("User id exists but special id does not"));
								}	
								break;
						case 1 :$stmt=$conn->prepare("SELECT teacher_id FROM teacher Where user_id = :uid ;");
								$stmt->bindParam(':uid',$_SESSION["user_id"]);	
								$stmt->execute();		
								$result = $stmt->fetchAll();
								if(count($result) > 0)
								{
									$_SESSION["teacher_id"] = $result[0][0];
								}
								else
								{
									header('Location: index.php?error='.urlencode("User id exists but special id does not"));
								}
								break;
						case 2 :$stmt=$conn->prepare("SELECT student_id FROM student Where user_id = :uid ;");
								$stmt->bindParam(':uid',$_SESSION["user_id"]);	
								$stmt->execute();		
								$result = $stmt->fetchAll();
								if(count($result) > 0)
								{
									$_SESSION["student_id"] = $result[0][0];
								}
								else
								{
									header('Location: index.php?error='.urlencode("User id exists but special id does not"));
								}
								break; 
					}
					redirect();
				}
				else
				{
					//wrong password
					header('Location: index.php?error='.urlencode("Incorrect Password"));
				}
		    }
		    else
		    {
		    	//redirect to login
		    	//wrong email
		    	header('Location: index.php?error='.urlencode("Incorrect Email"));
		    }
    	}
    	else
    	{	//wrong form id
    		//some unusual activity
    		unset($_SESSION["formid"]);
    		//redirect to login page
    		header('Location: index.php?error='.urlencode("Please login first"));
    	}
    }
    else
    {
    	//means someone tried to open logincheck.php directly and he is not logged in
    	header('Location: index.php?error='.urlencode("Please login first"));
    }
?>
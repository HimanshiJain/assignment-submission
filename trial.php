 <?php
 	require_once("modules/functions.php");
	require_once("modules/connection.php");
	require_once("phpmailer/class.phpmailer.php");
	require_once("modules/email_class.php");
	require_once("modules/admin_class.php");

	$course_code = "CO-201";
	$course_name = "DBMS";


	//check availability
		try
		{		
			$availability = 1;
			//by email
				$conn->beginTransaction();
				$stmt=$conn->prepare("SELECT count(*) FROM courses WHERE course_code LIKE :cc ");
				$stmt->bindParam(':cc',$course_code);
				//set and execute			
				$stmt->execute();			
				$result = $stmt->fetchAll();
				if($result[0][0]>0) 
				{ 
					$availability = 0;
					echo -2;
			    }
			if($availability == 1)
			{
				
				$sqlq = "INSERT INTO courses (course_code,name)";
		    	$sqlq .= " VALUES (?,?);";
			    $stmt = $conn->prepare($sqlq);
			    $stmt->bindParam(1,$course_code); $stmt->bindParam(2,$course_name);
				$stmt->execute();
				$conn->commit();
				//$conn->rollBack();
			}
		}
		catch(Exception $e)
		{
			echo $e;
		}

?>
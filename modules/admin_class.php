<?php

class Admin
{
	public function addstudent($name,$roll_no,$email)
	{
		global $conn;
		try
		{
			//check availability
			$availability = True;
			//by email
				$stmt=$conn->prepare("SELECT count(*) FROM user WHERE email LIKE :em ");
				$stmt->bindParam(':em',$email);
				//set and execute			
				$stmt->execute();			
				$result = $stmt->fetchAll();
				if($result[0][0]>0) 
				{ 
					$availability = 0;
					return -2;
			    }
			if($availability == 1)
			{
				//by roll no
				$stmt=$conn->prepare("SELECT count(*) FROM student WHERE roll_no LIKE :rn ");
				$stmt->bindParam(':rn',$roll_no);
				//set and execute			
				$stmt->execute();			
				$result = $stmt->fetchAll();
				if($result[0][0]>0) 
				{ 
					$availability = 0;
					return -3;
			    }
			}
			if($availability == 1)
			{
				//create new user and student
				$type = 2;
				$password_length= 8;
				$password = hash('sha256', time());
				$password = substr($password, rand(0,250),8);
				$sqlq = "INSERT INTO user (email,password,type)";
		    	$sqlq .= " VALUES (?,?,?);";
			    $stmt = $conn->prepare($sqlq);
			    $stmt->bindParam(1,$email); $stmt->bindParam(2,$password);$stmt->bindParam(3,$type);
			    //type = 2, for student 
				//set and execute
				$stmt->execute();

				//create student
				$sqlq = "INSERT INTO student (name,roll_no,user_id)";
		    	$sqlq .= " VALUES (?,?,(SELECT user_id FROM user WHERE email = ?));";
			    $stmt = $conn->prepare($sqlq);
			    $stmt->bindParam(1,$name); $stmt->bindParam(2,$roll_no);$stmt->bindParam(3,$email);
				//set and execute
				$stmt->execute();
				return 1;
			}
		}
		catch(Exception $e)
		{
			return -1;
		}
	}
	public function addinstructor($token)
	{
		
	}
	public function addcourse($token)
	{
		
	}
	public function delete($token)
	{
		
	}	
}

?>
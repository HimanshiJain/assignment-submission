<?php

class Admin
{
	public function addstudent($name,$roll_no,$email)
	{
		global $conn;
		$roll_no = (string)$roll_no;
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
				$password = hash('sha256', time()+rand(7,29));
				$password = substr($password, rand(0,50),8);
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
				$mail = new Email();
				$flag = $mail->send_password_email($email,$password);
				return $flag;
			}
		}
		catch(Exception $e)
		{
			echo $e;
			return $e;
		}
	}
	public function addinstructor($name,$code,$email)
	{
		global $conn;
		$code = (string)$code;
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
				//by code
				$stmt=$conn->prepare("SELECT count(*) FROM teacher WHERE teacher_code LIKE :cd ");
				$stmt->bindParam(':cd',$code);
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
				//create new user and teacher
				$type = 1;
				$password_length= 8;
				$password = hash('sha256', time()+rand(7,29));
				$password = substr($password, rand(0,50),8);
				$sqlq = "INSERT INTO user (email,password,type)";
		    	$sqlq .= " VALUES (?,?,?);";
			    $stmt = $conn->prepare($sqlq);
			    $stmt->bindParam(1,$email); $stmt->bindParam(2,$password);$stmt->bindParam(3,$type);
			    //type = 2, for student 
				//set and execute
				$stmt->execute();

				//create student
				$sqlq = "INSERT INTO teacher (name,teacher_code,user_id)";
		    	$sqlq .= " VALUES (?,?,(SELECT user_id FROM user WHERE email = ?));";
			    $stmt = $conn->prepare($sqlq);
			    $stmt->bindParam(1,$name); $stmt->bindParam(2,$code);$stmt->bindParam(3,$email);
				//set and execute
				$stmt->execute();		
				$mail = new Email();
				$flag = $mail->send_password_email($email,$password);
				return $flag;
			}
		}
		catch(Exception $e)
		{
			echo $e;
			return $e;
		}
	}
	public function addcourse($token)
	{
		
	}
	public function delete($token)
	{
		
	}	
}

?>
<?php

class Admin
{
	public function addstudent($name,$roll_no,$email,$courses_applied)
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
		    	//BEGIN TRANSACTION

		    	//CREATE USER
				$conn->beginTransaction();
			    $stmt = $conn->prepare($sqlq);
			    $stmt->bindParam(1,$email); $stmt->bindParam(2,$password);$stmt->bindParam(3,$type);
			    //type = 2, for student 
				$stmt->execute();

				//CREATE STUDENT
				$sqlq = "INSERT INTO student (name,roll_no,user_id)";
		    	$sqlq .= " VALUES (?,?,(SELECT user_id FROM user WHERE email = ?));";
			    $stmt = $conn->prepare($sqlq);
			    $stmt->bindParam(1,$name); $stmt->bindParam(2,$roll_no);$stmt->bindParam(3,$email);
				$stmt->execute();
				$student_id = $conn->lastInsertId();
				//ADD COURSES
				foreach($courses_applied as $course_id)
				{
					$course_id =(int)$course_id;
					$sqlq = "INSERT INTO enrolls (student_id,course_id)";
			    	$sqlq .= " VALUES (?,?);";
				    $stmt = $conn->prepare($sqlq);
				    $stmt->bindParam(1,$student_id); $stmt->bindParam(2,$course_id);
					$stmt->execute();	
				}
				$mail = new Email();
				$flag = $mail->send_password_email($email,$password);
				if($flag==1)
					$conn->commit();
				else
					$conn->rollBack();
				return $flag;
			}
		}
		catch(Exception $e)
		{
			return -1;
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
		    	//BEGIN TRANSACTION
				$conn->beginTransaction();
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
				if($flag==1)
					$conn->commit();
				else
					$conn->rollBack();
				return $flag;
			}
		}
		catch(Exception $e)
		{
			return -1;
		}
	}
	public function addcourse($course_name,$course_code)
	{
		global $conn;
		$course_code = (string)$course_code;
		//check duplicacy
		try
		{		
			$availability = 1;
			//by email				
				$stmt=$conn->prepare("SELECT count(*) FROM courses WHERE course_code = :cc");
				$stmt->bindParam(':cc',$course_code);
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
				$conn->beginTransaction();
				$sqlq = "INSERT INTO courses (course_code,name)";
		    	$sqlq .= " VALUES (?,?);";
			    $stmt = $conn->prepare($sqlq);
			    $stmt->bindParam(1,$course_code); $stmt->bindParam(2,$course_name);
				$stmt->execute();
				$conn->commit();
				return 1;
			}
			return -1;
		}
		catch(Exception $e)
		{
			return -1;
		}
	}
	public function deletecourse($course_code)
	{
		global $conn;
		$course_code = (string)$course_code;
		//check if exists
		try
		{		
			$exists = 0;
			//by email
				$stmt=$conn->prepare("SELECT count(*) FROM courses WHERE course_code = :cc");
				$stmt->bindParam(':cc',$course_code);
				//set and execute			
				$stmt->execute();			
				$result = $stmt->fetchAll();							
				if($result[0][0] > 0)  
				{
					$exists = 1;
				}
				else
				{
					return -2;			    
				}
			if($exists == 1)
			{
				$conn->beginTransaction();
				$sqlq = "DELETE FROM courses ";
		    	$sqlq .= " WHERE course_code = :cc;";
			    $stmt = $conn->prepare($sqlq);
			    $stmt->bindParam(':cc',$course_code);
				$stmt->execute();
				$conn->commit();
				return 1;
			}
			return -1;
		}
		catch(Exception $e)
		{
			return -1;
		}
	}
	public function getallcourse()
	{
		global $conn;
		try
		{		
			$stmt=$conn->prepare("SELECT * FROM courses");		
			$stmt->execute();			
			$result = $stmt->fetchAll();
			return $result;
		}
		catch(Exception $e)
		{
			return -1;
		}
	}
}
?>
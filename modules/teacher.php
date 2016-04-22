<?php
class Teacher
{
	public function upload_assignment($assignment_name,$max_marks,$due_date,$description,$reference,$course_id,$filepath){
		
		global $conn;
		//received information after submitting uploaded form by teacher
		$sql = "INSERT INTO assignment (assignment_name, due_date, description, reference, max_marks,
		course_id, filepath,upload_date) VALUES (?,?,?,?,?,?,?,NOW())";
		$stmt= $conn->prepare($sql);
		$stmt->bindparam(1, $assignment_name);
		$stmt->bindparam(2, $due_date);
		$stmt->bindparam(3, $description);
		$stmt->bindparam(4, $reference);
		$stmt->bindparam(5, $max_marks);
		$stmt->bindparam(6, $course_id);
		$stmt->bindparam(7, $filepath);
		
		$stmt->execute();
		return $conn->lastInsertId();
		
	}
	
	public function initialise_marks($assignment_id, $course_id){
		//for each assignment created, new empty records are initialised for students 
		//enrolled with the course for which the assignment is uploaded
		
		global $conn;
		$sql = "SELECT student_id FROM enrolls where course_id=?";
		$stmt= $conn->prepare($sql);
		$stmt->bindParam(1, $course_id);
		$stmt->execute();
		$result=$stmt->fetchAll();
		//print_r($result);
		//echo $result[2]['student_id'];
		
		foreach($result as $key){
			$sql = "INSERT INTO marks(assignment_id,student_id) VALUES(?,?)";
			$stmt= $conn->prepare($sql);
			$stmt->bindParam(1, $assignment_id);
			$stmt->bindParam(2, $key['student_id']);
			$stmt->execute();
		}
		
	}
	
	public function get_assignments_course($course_code,$teacher_id){
		global $conn;
		$sql = '(SELECT course_id FROM courses WHERE course_code = ?)';
		$stmt= $conn->prepare($sql);
		$stmt->bindParam(1, $course_code);
		$stmt->execute();
		$result=$stmt->fetchAll();
		$course_id = $result[0][0];
		//get assignments for that specific course_id and the specific logged in teacher
		$sql = "SELECT assignment_id,assignment_name,due_date,filepath FROM assignment,courses_taught where 
		assignment.course_id=? AND courses_taught.teacher_id=? AND assignment.course_id=courses_taught.course_id order by due_date";
		$stmt= $conn->prepare($sql);
		$stmt->bindParam(1, $course_id);
		$stmt->bindParam(2, $teacher_id);
		$stmt->execute();
		$result=$stmt->fetchAll();
		//print_r($result);
		return $result;
		
	}
	
	public function get_students_for_marking($assignment_id){
			//get list of students associated with that course and thus assignment for marking
			global $conn;
			$sql = "SELECT student.student_id,roll_no,name,marks,filepath FROM student,marks,submits where marks.assignment_id=? and
					student.student_id=marks.student_id  AND student.student_id=submits.student_id AND marks.assignment_id=submits.assignment_id";
			$stmt= $conn->prepare($sql);
			$stmt->bindParam(1, $assignment_id);
			$stmt->execute();
			$result=$stmt->fetchAll();
			return $result;
		
	}
	
	public function mark_student($student_id,$assignment_id,$marks){
		//mark a particular student
		global $conn;
			$sql = "UPDATE marks SET marks=? WHERE student_id=? AND assignment_id=?";
			$stmt= $conn->prepare($sql);
			$stmt->bindParam(1, $marks);
			$stmt->bindParam(2, $student_id);
			$stmt->bindParam(3, $assignment_id);
			$stmt->execute();
		
	}
	
	public function view_marks_single_student($student_id,$course_id){
		//view marks of a single student subscribed  to that course for 
		//all the assignments given and the cumulative marks
		global $conn;
			$sql = "SELECT name,marks,roll_no,assignment_name FROM student,marks,assignment where 
			marks.student_id=? AND marks.student_id=student.student_id AND
			assignment.course_id=? AND assignment.assignment_id=marks.assignment_id";
			$stmt= $conn->prepare($sql);
			$stmt->bindParam(1, $student_id);
			$stmt->bindParam(2, $course_id);
			$stmt->execute();
			$result=$stmt->fetchAll();
			return $result;
		
	}
	
	public function view_marks_all_students($course_code){
		//view marks of all the students subscribed to that course
		global $conn;
			$sql = '(SELECT course_id FROM courses WHERE course_code = ?)';
			$stmt= $conn->prepare($sql);
			$stmt->bindParam(1, $course_code);
			$stmt->execute();
			$result=$stmt->fetchAll();
			$course_id = $result[0][0];
			$sql = "SELECT student_id FROM enrolls where course_id=?";
			$stmt= $conn->prepare($sql);
			$stmt->bindParam(1, $course_id);
			$stmt->execute();
			$result=$stmt->fetchAll();
			$complete_array=array();
			foreach($result as $key){
				//echo "</br>".$key['student_id']."</br>";
				$complete_array[]=$this->view_marks_single_student($key['student_id'],$course_id);
			}
			//echo "</br>".$complete_array[0][0][0]."</br>";
			return $complete_array;
	}
	
	public function get_no_of_assignments_view($course_code){
		global $conn;
		$sql = '(SELECT course_id FROM courses WHERE course_code = ?)';
		$stmt= $conn->prepare($sql);
		$stmt->bindParam(1, $course_code);
		$stmt->execute();
		$result=$stmt->fetchAll();
		$course_id = $result[0][0];
			$sql = "SELECT count(assignment_id) FROM assignment where course_id=?";
			$stmt= $conn->prepare($sql);
			$stmt->bindParam(1, $course_id);
			$stmt->execute();
			$result=$stmt->fetchAll();
			return $result;
	}

	public function get_courses_taught($teacher_id)
	{
		$teacher_id = (int)$teacher_id;
		//view all courses of the teacher
		global $conn;
			$sql = "SELECT * FROM courses_taught JOIN courses ON courses.course_id = courses_taught.course_id WHERE teacher_id = ?";
			$stmt= $conn->prepare($sql);
			$stmt->bindParam(1, $teacher_id);
			$stmt->execute();
			$result=$stmt->fetchAll();
			return $result;
	}
	public function get_courses_not_taught($teacher_id)
	{
		$teacher_id = (int)$teacher_id;
		global $conn;
			$sql = "SELECT name,course_code FROM courses WHERE course_code NOT IN (SELECT courses.course_code as course_code FROM courses_taught JOIN courses ON courses.course_id = courses_taught.course_id WHERE teacher_id = ?)	";
			$stmt= $conn->prepare($sql);
			$stmt->bindParam(1, $teacher_id);
			$stmt->execute();
			$result=$stmt->fetchAll();
			return $result;
	}
	public function add_course($teacher_id,$course_code)
	{
		$teacher_id = (int)$teacher_id;
		global $conn;
		try
		{
			$sqlq = "INSERT INTO courses_taught (course_id,teacher_id)";
		    $sqlq .= " VALUES ((SELECT course_id FROM courses WHERE course_code = ?),?);";
			$stmt= $conn->prepare($sqlq);
			$stmt->bindParam(1, $course_code);
			$stmt->bindParam(2, $teacher_id);
			$stmt->execute();
			return 1;
		}
		catch(Exception $e)
		{
			return 0;
		}	
	}
	public function delete_course($teacher_id,$course_code)
	{
		$teacher_id = (int)$teacher_id;
		global $conn;
		try
		{
			$sql = "DELETE FROM courses_taught WHERE teacher_id = ? AND course_id = (SELECT course_id FROM courses WHERE course_code = ?);";
			$stmt= $conn->prepare($sql);
			$stmt->bindParam(1, $teacher_id);
			$stmt->bindParam(2, $course_code);
			$stmt->execute();
			return 1;
		}
		catch(Exception $e)
		{
			return 0;
		}
	}
	public function initialise_courseid()
	{
		$teacher_id = $_SESSION["teacher_id"];
		global $conn;
		try
		{
			$sql = "SELECT * FROM courses_taught JOIN courses ON courses.course_id = courses_taught.course_id WHERE teacher_id = ?";
			$stmt= $conn->prepare($sql);
			$stmt->bindParam(1, $teacher_id);
			$stmt->execute();
			$result=$stmt->fetchAll();
			$_SESSION["course_code"] = $result[0]["course_code"];
		}
		catch(Exception $e)
		{
			//do nothing
		}
	}
}
?>
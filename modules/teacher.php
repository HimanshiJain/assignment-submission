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
	
	public function get_assignments_course($course_id,$teacher_id){
		global $conn;
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
			$sql = "SELECT student.student_id,roll_no,name,marks FROM student,marks where assignment_id=? and
					student.student_id=marks.student_id";
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
	
	public function view_marks_all_students($course_id){
		//view marks of all the students subscribed to that course
		global $conn;
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
	
	
	
}

?>
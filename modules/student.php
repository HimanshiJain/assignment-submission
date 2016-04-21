<?php
class Student{
	
	public function get_dasboard_assignments($student_id){
		//gets all the assignments for that particular student enrolled in corresponding courses
		global $conn;
		$sql="SELECT assignment_id,course_code,assignment_name,due_date FROM courses,assignment,enrolls where 
		enrolls.student_id=? AND assignment.course_id=enrolls.course_id AND courses.course_id=enrolls.course_id
		order by due_date ASC";
		$stmt=$conn->prepare($sql);
		$stmt->bindparam(1,$student_id);
		$stmt->execute();
		$result=$stmt->fetchAll();
		return $result;
	}
	
	public function get_assignment_details($assignment_id){
		//get the details of the assignment clicked
		global $conn;
		$sql="SELECT assignment_name,assignment_id,description,reference,max_marks,due_date,filepath from assignment
				where assignment_id=?";
		$stmt=$conn->prepare($sql);
		$stmt->bindparam(1,$assignment_id);
		$stmt->execute();
		$result=$stmt->fetchAll();
		return $result;
		
	}
}
?>
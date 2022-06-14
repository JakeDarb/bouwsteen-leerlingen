<?php

include_once(__DIR__ . "/Db.php");

class Assignments{
    public static function countClaimable($username){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT COUNT(*) AS 'amount'
        FROM students_assignments
        INNER JOIN students
        ON students_assignments.students_id = students.id
        WHERE students.username = :username
        AND students_assignments.finished = 1
        AND students_assignments.claimed = 0");
        $statement->bindValue(":username", $username);
        $statement->execute();
        $amount = $statement->fetch();
        return intval($amount["amount"]);
    }
    public static function getFinishedAssignments($username){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT subjects.name as 'subject', assignments.name, assignments.reward, assignments.id
        FROM students_assignments
        INNER JOIN students 
        ON students_assignments.students_id = students.id
        INNER JOIN assignments 
        ON students_assignments.assignments_id = assignments.id
        INNER JOIN subjects
        on assignments.subjects_id = subjects.id
        WHERE students.username = :username
        AND students_assignments.claimed = 0
        AND students_assignments.finished = 1
        ORDER BY subjects.name");
        $statement->bindValue(":username", $username);
        $statement->execute();
        $finishedAssignments = $statement->fetchAll();
        return $finishedAssignments;
    }
    public static function getAssignments($username, $subject){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT assignments.id, assignments.name, assignments.description, assignments.reward, assignments.due_date
        FROM students_assignments
        INNER JOIN students 
        ON students_assignments.students_id = students.id
        INNER JOIN assignments 
        ON students_assignments.assignments_id = assignments.id
        INNER JOIN subjects
        on assignments.subjects_id = subjects.id
        WHERE students.username = :username
        AND students_assignments.claimed = 0
        AND students_assignments.finished = 0
        AND subjects.name = :sub
        ORDER BY assignments.due_date");
        $statement->bindValue(":username", $username);
        $statement->bindValue(":sub", $subject);
        $statement->execute();
        $assignments = $statement->fetchAll();
        return $assignments;
    }
    public static function getStudentClasses($classId){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT *
        FROM subjects
        WHERE classes_id = :class_id");
        $statement->bindValue(":class_id", $classId);
        $statement->execute();
        $classes = $statement->fetchAll();
        return $classes;
    }
    public static function addPoints($reward, $studentUsername){
        $conn = Db::getConnection();
        $statement = $conn->prepare("UPDATE students
        SET students.points = students.points + :reward
        WHERE students.username = :studentUsername");
        $statement->bindValue(":reward", $reward);
        $statement->bindValue(":studentUsername", $studentUsername);
        $statement->execute();
    }
    public static function claimAssignmentReward($assignment, $studentUsername){
        $conn = Db::getConnection();
        $statement = $conn->prepare("UPDATE students_assignments
        INNER JOIN students
        ON students_assignments.students_id = students.id
        INNER JOIN assignments
        ON students_assignments.assignments_id = assignments.id
        SET claimed = '1' 
        WHERE assignments.id = :assignmentId
        AND students.username = :studentUsername");
        $statement->bindValue(":assignmentId", $assignment);
        $statement->bindValue(":studentUsername", $studentUsername);
        $statement->execute();
    }
}
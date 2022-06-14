<?php

include_once(__DIR__ . "/Db.php");

class Student{
    public static function login($username, $password){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT s.*, s.id AS studentId
        FROM students s
        WHERE s.username = :username");
        $statement->bindValue(":username", $username);
        $statement->execute();
        // get user connected with username
        $user = $statement->fetch();
        if(!$user){
            throw new Exception('Deze gebruiker bestaat niet');
        }

        //verify password
        $hash = $user["password"];
        if(password_verify($password, $hash)){
            // login
            session_start();
            $_SESSION["student"] = $user['username'];
            $_SESSION["studentId"] = $user['studentId'];
            $_SESSION["class"] = $user['classes_id'];
            $_SESSION["studentWalletAmount"] = $user['points'];
            header("Location: index.php?p=wardrobe");
        }else{
            throw new Exception('Verkeerd wachtwoord');
        }

    }
    public static function getUserId($username){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT id
        FROM students
        WHERE username = :username");
        $statement->bindValue(":username", $username);
        $statement->execute();
        $id = $statement->fetch();
        return $id["id"];
    }
    public static function insertSmiley($studentId){
        $conn = Db::getConnection();
        $statement = $conn->prepare("INSERT INTO students_smileys (description, students_id, smileys_id) 
        VALUES ('', :studentsId, '4');");
        $statement->bindValue(":studentsId", $studentId);
        $statement->execute();
    }
    public static function getLastSmileyDate($username){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT date(date) AS date
        FROM students_smileys 
        INNER JOIN students
        ON students_smileys.students_id = students.id
        WHERE students.username = :username");
        $statement->bindValue(":username", $username);
        $statement->execute();
        $oldDate = $statement->fetch();
        return $oldDate["date"];
    }
}
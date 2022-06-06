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
            header("Location: index.php?p=wardrobe");
        }else{
            throw new Exception('Verkeerd wachtwoord');
        }

    }
}
<?php

include_once(__DIR__ . "/Db.php");

class Smileys{
    public static function getSmileys(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT *
        FROM smileys");
        $statement->execute();
        $smileys = $statement->fetchAll();
        return $smileys;
    }
    public static function updateSmileys($smileyDescription, $smileyId, $student){
        $conn = Db::getConnection();
        $statement = $conn->prepare("UPDATE students_smileys
        INNER JOIN students
        ON students_smileys.students_id = students.id
        SET description = :smileyDescription, date = :currentDate, smileys_id = :smileyId 
        WHERE students.username = :student");
        $statement->bindValue(":smileyDescription", $smileyDescription);
        $statement->bindValue(":currentDate", date(date("Y-m-d h:i:s")));
        $statement->bindValue(":smileyId", $smileyId);
        $statement->bindValue(":student", $student);
        $statement->execute();
    }
}
<?php 
include_once(__DIR__ . "/Db.php");

class Inventory{
    public static function get_categories(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM `accessories_type`");
        $statement->execute();
        $categories = $statement->fetchAll();
        if (!$categories) {
            throw new Exception('There are no categories found');
        }
        //$allCategories = array();
        return $categories;
    }
    public static function get_shopItems($accessories_type, $studentId){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT accessories.id, accessories.name, accessories.path, accessories.thumbnail
        FROM accessories
        INNER JOIN accessories_type ON accessories.accessories_type_id = accessories_type.id
        WHERE accessories_type.name = :accessories_type
        AND NOT EXISTS(
        SELECT *
        FROM students_accessories
        JOIN accessories
        ON students_accessories.accessories_id = accessories.id
        WHERE students_accessories.students_id = :studentId)");
        $statement->bindValue(":accessories_type", $accessories_type);
        $statement->bindValue(":studentId", $studentId);
        $statement->execute();
        $shopItems = $statement->fetchAll();
        return $shopItems;
    }
    public static function get_wardrobeItems($studentId, $accessories_type){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT accessories.id, accessories.name, accessories.path, accessories.thumbnail, students_accessories.is_wearing
        FROM students_accessories
        INNER JOIN accessories ON students_accessories.accessories_id = accessories.id
        INNER JOIN accessories_type on accessories.accessories_type_id = accessories_type.id
        WHERE students_accessories.students_id=:studentId
        AND accessories_type.name = :accessories_type");
        $statement->bindValue(":studentId", $studentId);
        $statement->bindValue(":accessories_type", $accessories_type);
        $statement->execute();
        $wardrobeItems = $statement->fetchAll();
        return $wardrobeItems;
    }
}
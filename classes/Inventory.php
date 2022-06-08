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
        $statement = $conn->prepare("SELECT accessories.id, accessories.name, accessories.price, accessories.path, accessories.thumbnail
        FROM accessories
        INNER JOIN accessories_type ON accessories.accessories_type_id = accessories_type.id
        WHERE accessories_type.name = :accessories_type
        AND accessories.id NOT IN (
          SELECT students_accessories.accessories_id
          FROM students_accessories
          WHERE students_accessories.students_id = :studentId
        )");
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
    public static function buyItem($studentUsername, $accessoriesId){
        $conn = Db::getConnection();
        $statement = $conn->prepare("INSERT INTO `students_accessories` (`id`, `is_wearing`, `students_id`, `accessories_id`)
        VALUES (NULL, '0', (SELECT students.id FROM students WHERE students.username = :studentUsername), :accessoriesId)");
        $statement->bindValue(":studentUsername", $studentUsername);
        $statement->bindValue(":accessoriesId", $accessoriesId);
        $statement->execute();
    }
    public static function deductPoints($itemPrice, $studentUsername){
        $conn = Db::getConnection();
        $statement = $conn->prepare("UPDATE students
        SET students.points = students.points - :itemPrice
        WHERE students.username = :studentUsername");
        $statement->bindValue(":itemPrice", $itemPrice);
        $statement->bindValue(":studentUsername", $studentUsername);
        $statement->execute();
    }
    public static function changeClothes($oldAccessoriesId, $accessoriesId){
        $conn = Db::getConnection();
        $statement = $conn->prepare("UPDATE students_accessories
        SET is_wearing = '0' 
        WHERE students_accessories.accessories_id = :oldAccessoriesId;
        UPDATE students_accessories
        SET is_wearing = '1' 
        WHERE students_accessories.accessories_id = :accessoriesId;");
        $statement->bindValue(":oldAccessoriesId", $oldAccessoriesId);
        $statement->bindValue(":accessoriesId", $accessoriesId);
        $statement->execute();
    }
    public static function getOutfit($studentUsername){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT accessories_type.name, accessories.path
        FROM accessories
        INNER JOIN students_accessories
        INNER JOIN accessories_type
        INNER JOIN students
        WHERE accessories.id = students_accessories.accessories_id
        AND students_accessories.students_id = students.id
        AND accessories.accessories_type_id = accessories_type.id
        AND students_accessories.is_wearing = 1
        AND students.username = :studentUsername");
        $statement->bindValue(":studentUsername", $studentUsername);
        $statement->execute();
        $outfitItems = $statement->fetchAll();
        return $outfitItems;
    }
}
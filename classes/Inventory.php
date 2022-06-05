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
}
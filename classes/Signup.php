<?php

include_once(__DIR__ . "/Db.php");

class Signup{
    private $id;
    private $name;
    private $surname;
    private $username;
    private $password;
    private $classNumber;
    private $classId;
    
    //constructor
    public function __construct($id = null, $name = null, $surname = null, $username = null, $password = null, $classNumber = null, $classId = null)
    {
        $this->setId($id);
        $this->setName($name);
        $this->setSurname($surname);
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setClassNumber($classNumber);
        $this->setClassId($classId);
    }

    //getters
    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getSurname(){
        return $this->surname;
    }
    public function getUsername(){
        return $this->username;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getClassNumber(){
        return $this->classNumber;
    }
    public function getClassId(){
        return $this->classId;
    }

    //setters
    private function setId($id): void
    {
        $this->id = $id;
    }
    private function setName($name): void
    {
        $this->name = $name;
    }
    private function setSurname($surname): void
    {
        $this->surname = $surname;
    }
    private function setUsername($username): void
    {
        $this->username = $username;
    }
    private function setPassword($password): void
    {
        $this->password = $password;
    }
    private function setClassNumber($classNumber): void
    {
        $this->classNumber = $classNumber;
    }
    private function setClassId($classId): void
    {
        $this->classId = $classId;
    }

    public function register() {
        $conn = Db::getConnection();
        $name = $this->getName();
        $surname = $this->getSurname();
        $username = $this->getUsername();
        $password = $this->getPassword();
        $classNumber = $this->getClassNumber();
        $classId = $this->getClassId();
        
    
        if($this->checkIfUserExists($username) == 0) {
            $statement = $conn->prepare("INSERT INTO students (name, surname, username, password, class_number, points, classes_id) VALUES (:name, :surname, :username, :password, :class_number, '100', :classes_id)");
            $options = [
                'cost' => 12,
            ];
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT, $options);
            
            $statement->bindValue(":name", $name);
            $statement->bindValue(":surname", $surname);
            $statement->bindValue(":username", $username);
            $statement->bindValue(":password", $hashedPassword);
            $statement->bindValue(":class_number", $classNumber);
            $statement->bindValue(":classes_id", $classId);
    
            $result = $statement->execute();
            return $result;
        } else {
            throw new Exception("User already exists");
        }
    }

    public function checkIfUserExists($username)
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT COUNT(*) FROM students WHERE username = :username");
        $statement->bindValue(":username", $username);
        $statement->execute();
        $check = $statement->fetch()['COUNT(*)'];
        return $check;
    }

    public static function fetchClasses(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM `classes`");
        $statement->execute();
        $classes = $statement->fetchAll();
        if (!$classes) {
            throw new Exception('There are no classes found');
        }
        return $classes;
    }
}
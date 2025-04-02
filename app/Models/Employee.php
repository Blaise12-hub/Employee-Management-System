<?php

namespace App\Models;

use Config\Database;
use PDO;

class Employee{
    private $conn;
    private $table='employee';

    public function __construct(){
        $database=new Database();
        $this->conn = $database->connect();
    }

    public function getAllEmployees() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addEmployee($name, $email, $department) {
        $query = "INSERT INTO " . $this->table . " (name, email, department) VALUES (:name, :email, :department)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':department', $department);
        return $stmt->execute();
    }

}








?>
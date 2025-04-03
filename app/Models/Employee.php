<?php

namespace App\Models;

use App\Config\Database;
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

    public function getEmployeeById($id) {
        $query="SELECT * FROM " . $this->table . " WHERE id = ?";
        $stmt=$this->conn->prepare($query);
        // $stmt = $this->prepare("SELECT * FROM emp WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addEmployee($name, $email, $department) {
        $query = "INSERT INTO " . $this->table . " (name, email, department) VALUES (:name, :email, :department)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':department', $department);
        return $stmt->execute();
    }

    public function deleteEmployee($id) {
        $stmt = $this->conn->prepare("DELETE FROM " .$this->table ." WHERE id = ?");
        return $stmt->execute([$id]);
    }

}








?>
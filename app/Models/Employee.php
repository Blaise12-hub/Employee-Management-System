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
        $query="SELECT * FROM " . $this->table . " WHERE emp_id = ?";
        $stmt=$this->conn->prepare($query);
        // $stmt->bindValue(':id',$id,PDO::PARAM_INT);
        $stmt->execute([$id]);
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            error_log("No employee found with ID: " . $id);
            return false;
        }
        var_dump($result);
        return $result;

        // return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addEmployee($name, $email, $department) {
        $query = "INSERT INTO " . $this->table . " (emp_name, emp_email, department) VALUES (:name, :email, :department)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':department', $department);
        return $stmt->execute();
    }

    public function deleteEmployee($id) {
        $stmt = $this->conn->prepare("DELETE FROM " .$this->table ." WHERE emp_id = ?");
        return $stmt->execute([$id]);
    }
    public function updateEmployee($id,$name,$email,$department){
        if(!$id){
            return false;
        }
        $query = "UPDATE " . $this->table . " SET emp_name=:name, emp_email=:email,department=:department WHERE emp_id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id',$id, PDO::PARAM_INT);
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':department',$department);
        return $stmt->execute();

    }

}








?>
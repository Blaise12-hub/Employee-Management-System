<?php
namespace App\Models;

use Config\Database;
use PDO;

class Attendance{
    private $conn;
    private $table = 'attendance';

    public function __construct(){
        $database= new Database();
        $this->conn = $database->connect();

    }
    public function markAttendance($employee_id,$date,$status){
        $query="INSERT INTO" . $this->table . "(employee_id,date,status) VALUES (:employee_id,:date,:status)";
        $stmt=$this->conn->prepare($query);
        $stmt->bindParam(':employee_id',$employee_id);
        $stmt->bindParam(':date',$date);
        $stmt->bindParam(':status',$status);

        return $stmt->execute();
    }
    public function getAttendanceByDate($date){
        $query="SELECT employee.name,attendance.status FROM " . $this->table ."INNER JOIN employee ON attendance.employee_id=employee.id WHERE date=:date";
        $stmt=$this->conn->prepare($query);
        $stmt ->bindParam(':date',$date);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}









?>
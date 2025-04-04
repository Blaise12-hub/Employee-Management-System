<?php
namespace App\Models;

use App\Config\Database;
use PDO;

class Attendance {
    private $conn;
    private $table = 'attendance';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function markAttendance($employee_id, $date, $status) {
        // already marked
        $checkQuery = "SELECT COUNT(*) FROM " . $this->table . " WHERE employee_id = :employee_id AND date = :date";
        $stmt = $this->conn->prepare($checkQuery);
        $stmt->bindParam(':employee_id', $employee_id);
        $stmt->bindParam(':date', $date);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            return false; // already marked
        }

        error_log("Marking Attendance: Employee ID: $employee_id, Date: $date, Status: $status");

        $query = "INSERT INTO " . $this->table . " (employee_id, date, status,created_at) VALUES (:employee_id, :date, :status,NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':employee_id', $employee_id);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':status', $status);

        return $stmt->execute();
    }

    public function getAttendanceByDate($date) {
        // $query = "SELECT employee.emp_name,attendance.status, attendance.date,attendance.created_at 
        //           FROM " . $this->table . " 
        //           INNER JOIN employee ON attendance.employee_id = employee_id 
        //           WHERE attendance.date = :date";
           $query="SELECT e.emp_name,a.status,a.date,a.created_at 
                   FROM " . $this->table . " a INNER JOIN employee e ON a.employee_id = employee_id
                   WHERE a.date = :date";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':date', $date);
        $stmt->execute();

        // return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

        
    // Debugging output to check fetched data
    error_log("Fetched Records: " . print_r($records, true));

    return $records;
    }
}
?>

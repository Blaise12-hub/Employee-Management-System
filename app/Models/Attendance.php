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
        $checkQuery = "SELECT COUNT(*) FROM " . $this->table . " WHERE employee_id = :employee_id AND date = CURDATE()";
        $stmt = $this->conn->prepare($checkQuery);
        $stmt->bindParam(':employee_id', $employee_id);
        $stmt->bindParam(':date', $date);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            return false; // already marked
        }

        $query = "INSERT INTO " . $this->table . " (employee_id, date, status) VALUES (:employee_id, :date, :status)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':employee_id', $employee_id);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':status', $status);

        return $stmt->execute();
    }

    public function getAttendanceByDate($date) {
        $query = "SELECT employee.emp_name,attendance.status, attendance.date,attendance.created_at 
                  FROM " . $this->table . " 
                  INNER JOIN employee ON attendance.employee_id = employee_id 
                  WHERE attendance.date = :date";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':date', $date);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

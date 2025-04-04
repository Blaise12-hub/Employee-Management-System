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

    public function getAttendanceByDateRange($start_date,$end_date) {

           $query="SELECT e.emp_name,a.status,a.date,a.created_at 
                   FROM " . $this->table . " a INNER JOIN employee e ON a.employee_id = e.emp_id
                   WHERE a.date BETWEEN :start_date AND :end_date ORDER BY a.date ASC";

        $stmt = $this->conn->prepare($query);

        error_log("Start Date: " . $start_date);
        error_log("End Date: " .  $end_date);

        $success = $stmt->execute([
            ':start_date' => $start_date,
            ':end_date' => $end_date
        ]);
        if (!$success) {
            die("Query Execution Error: " . implode(" ", $stmt->errorInfo()));
        }
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($records === false) {
            die("Fetch Error: " . implode(" ", $stmt->errorInfo()));
        }

    return $records;
    }
}
?>

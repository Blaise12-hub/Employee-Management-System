<?php
namespace App\Controllers;
use App\Models\Attendance;


class AttendanceController {
    public function mark() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $employee_id = $_POST['employee_id'];
            $date = $_POST['date'];
            $status = $_POST['status'];
            
            $attendance = new Attendance();
            if ($attendance->markAttendance($employee_id, $date, $status)) {
                header("Location: /attendance");
                exit();
            }
        }
    }

    public function report() {
        $date = $_GET['date'] ?? date('Y-m-d');
        $attendance = new Attendance();
        $records = $attendance->getAttendanceByDate($date);
        
        include __DIR__ . '/../Views/attendanceReport.php';
    }
}
?>
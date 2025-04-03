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
                // header("Location: /mark-attendance");
                echo "<script>alert('Attendance Marked Successfully, You are marked present'); window.location.href='/mark-attendance';</script>";
                exit();
            }else{
                echo "<script>alert('Attendance already marked for today!'); window.location.href='/mark-attendance';</script>";
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
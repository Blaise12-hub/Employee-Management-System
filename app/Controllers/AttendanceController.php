<?php
namespace App\Controllers;
use App\Models\Attendance;



class AttendanceController {
    public function mark() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $employee_id = $_POST['employee_id'] ?? null;
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
            exit();
        }
    }

    public function report() {
        $start_date = $_GET['start_date'] ?? date('Y-m-d');
        $end_date = $_GET['end_date'] ?? date('Y-m-d');

        if (!strtotime($start_date) || !strtotime($end_date)) {
            die("Invalid date format. Please use YYYY-MM-DD");
        }

        $attendance = new Attendance();

        // Debugging output to ensure parameters are being bound
        error_log("Bound Params - Start Date: $start_date, End Date: $end_date");

        $records = $attendance->getAttendanceByDateRange($start_date,$end_date);
        // var_dump($records);
        
        include __DIR__ . '/../Views/attendanceReport.php';
    }
}
?>
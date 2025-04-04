<?php

namespace App\Controllers;
use App\Models\Employee;

class EmployeeController{
    private $employeeModel;


    public function __construct(){
        $this->employeeModel = new Employee();
    }
    public function index(){
        $employees=$this->employeeModel->getAllEmployees();
        include __DIR__ . '/../Views/employee.php';
    }

    public function addEmployee(){
        header('Content-Type: application/json');

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            var_dump($_POST);
            $name = $_POST['emp_name'];
            $email = $_POST['emp_email'];
            $department=$_POST['department'];

            if (empty($name) || empty($email) || empty($department)) {
                echo json_encode(['success' => false, 'error' => 'All fields are required']);
                exit;
            }
            $result = $this->employeeModel->addEmployee($name, $email, $department);

            if ($result) {
                echo json_encode(['success' => true,'data'=>$result]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Failed to add employee']);
            }
            exit;
        }
    }
    public function getEmployee() {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *'); 


        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $employee = $this->employeeModel->getEmployeeById($id);
            
            if ($employee) {
                ob_clean();
                // error_log("Employee Data: " . json_encode($employee));
                echo json_encode([
                    'success' => true,
                    'data' => $employee
                ]);
                // echo json_encode($employee);
                exit;
            } else {
                error_log("Error: Employee not found for ID " . $id);
                echo json_encode([
                    'success' => false,
                    'error' => 'Employee not found'
                ]);
            }
            exit;
        }
    }
    public function deleteEmployee(){
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            die("Invalid request. Employee ID is required.");
        }

        $id = $_GET['id'];

        if ($this->employeeModel->deleteEmployee($id)) {
            echo "<script>alert('Employee deleted successfully.'); window.location.href='/employees';</script>";
        } else {
            echo "<script>alert('Failed to delete employee. Please try again.'); window.location.href='/employees';</script>";
        }

    }
    public function updateEmployee() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

         var_dump($_POST);

            $id = $_POST['emp_id'];
            $name = $_POST['emp_name'];
            $email = $_POST['emp_email'];
            $department = $_POST['department'];

            if (empty($id)) { 
                echo json_encode(['success' => false, 'error' => 'Employee ID is required']);
                exit;
            }
            
            $result = $this->employeeModel->updateEmployee($id, $name, $email, $department);
            
            
            if ($result) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Failed to update employee']);
            }
            exit;
        }
    }
}








?>
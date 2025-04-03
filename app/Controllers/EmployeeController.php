<?php

namespace App\Controllers;
use App\Models\Employee;

class EmployeeController{
    public function index(){
        $employeeModel=new Employee;
        $employees=$employeeModel->getAllEmployees();
        include __DIR__ . '/../Views/employee.php';
    }

    public function addEmployee(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $department=$_POST['department'];
            // $role=$_POST['role']; role

            $employee = new Employee();
            if($employee->addEmployee($name,$email,$department)){
                header("Location:/employees");
                exit();
            }
        }
    }
    public function getEmployee(){
        
    }
    public function deleteEmployee(){

    }
}








?>
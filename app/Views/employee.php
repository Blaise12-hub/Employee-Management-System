
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

</head>
<style>
 .container{
    margin-right:0px;
 }
 .add{
    margin-left:140vh;
    background:blue;
    color:white;
    height:40px;
    border-radius:10px;
    border-color:blue;
 }
 .table{
    margin-top:10px;
 }
 .employee-details {
    padding: 15px;
 }
.detail-row {
    margin-bottom: 10px;
    display: flex;
}
.detail-label {
    font-weight: bold;
    width: 120px;
}
.detail-value {
    flex: 1;
}

</style>
 <?php require VIEW_PATH . "/layouts/sidebar.php"; ?> 

<body class="container mt-4 p-4">

 <h2>Employees Management</h2>

 <button class="add add-employee">+ Add Employee</button>

<?php if(!empty($employees)):  ?>
   <table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Department</th>
        <th>Actions</th>
     </tr>
     <?php foreach ($employees as $employee): ?>  
            <tr>
                <td><?= htmlspecialchars($employee['emp_id']) ?></td>
                <td><?= htmlspecialchars($employee['emp_name']) ?></td>
                <td><?= htmlspecialchars($employee['emp_email']) ?></td>
                <td><?= htmlspecialchars($employee['department']) ?></td>
                <td>
                    <button class="btn btn-info view-employee" data-emp_id="<?= $employee['emp_id'] ?>">View</button>
                    <button class="btn btn-primary edit-employee"
                     data-emp_id="<?= $employee['emp_id'] ?>" 
                     data-emp_name="<?= htmlspecialchars($employee['emp_name']) ?>"
                     data-emp_email="<?= htmlspecialchars($employee['emp_email']) ?>"
                     data-department="<?= htmlspecialchars($employee['department']) ?>">Edit</button>
                     
                    <button class="btn btn-danger delete-employee"><a href="/employees/delete?id=<?= $employee['emp_id']; ?>" onclick="return confirm('Are you sure?')">Delete</a></button>
                </td>
            </tr>
        <?php endforeach; ?>

   </table>

   <?php else: ?>
    <p class="alert alert-warning">No Employees found</p>
  
    <?php endif; ?>

    <!-- edit modal -->
<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEmployeeModalLabel">Edit Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editEmployeeForm">

                    <input type="number" id="editEmployeeId" name="emp_id">
                    
                    <div class="mb-3">
                        <label for="editName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="editName" name="emp_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="emp_email" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDepartment" class="form-label">Department</label>
                        <input type="text" class="form-control" id="editDepartment" name="department" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                <button type="button" class="btn btn-primary" id="saveEmployeeChanges">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- add new modal -->
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEmployeeModalLabel">Edit Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addEmployeeForm">

                    <input type="hidden" id="addEmployeeId" name="emp_id">
                    
                    <div class="mb-3">
                        <label for="addName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="addName" name="emp_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="addEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="addEmail" name="emp_email" required>
                    </div>
                    <div class="mb-3">
                        <label for="addDepartment" class="form-label">Department</label>
                        <input type="text" class="form-control" id="addDepartment" name="department" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                <button type="button" class="btn btn-primary" id="saveNewEmployee">Save Employee</button>
            </div>
        </div>
    </div>
</div>
<!-- view modal  -->
<div class="modal fade" id="viewEmployeeModal" tabindex="-1" aria-labelledby="viewEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewEmployeeModalLabel">Employee Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="employee-details">
                    <div class="detail-row">
                        <span class="detail-label">Employee ID:</span>
                        <span class="detail-value" id="viewEmpId"></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Name:</span>
                        <span class="detail-value" id="viewEmpName"></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Email:</span>
                        <span class="detail-value" id="viewEmpEmail"></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Department:</span>
                        <span class="detail-value" id="viewEmpDepartment"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
 


<!-- scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
//edit scripts
$(document).ready(function() {
   try{
    const editModal = new bootstrap.Modal(document.getElementById('editEmployeeModal'));
    console.log('modal initialised');


    // edit btn clicked
    $(document).on('click', '.edit-employee', function() {
        console.log('edit button clicked');
        
        const id = $(this).data('emp_id');
        const name = $(this).data('emp_name');
        const email = $(this).data('emp_email');
        const department = $(this).data('department');
        
        $('#editEmployeeId').val(id);
        $('#editName').val(name);
        $('#editEmail').val(email);
        $('#editDepartment').val(department);
        
        
        editModal.show();
    });
    
    // onsave
    $('#saveEmployeeChanges').click(function() {
        const formData = {
            emp_id: $('#editEmployeeId').val(),
            emp_name: $('#editName').val(),
            emp_email: $('#editEmail').val(),
            department: $('#editDepartment').val()
        };
        console.log("Sending data",formData);
        
        
        
        $.ajax({
            url: '/employees/update',
            method: 'POST',
            data: formData,
            success: function(response) {
            console.log("response",response);
              if(response.success){
                alert('Employee updated successfully!');   
                 // auto refresh
                 location.reload();
              }else{
                alert('error updating employee:' + response.error);
              }
            
                editModal.hide();
                
               
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:",xhr.responseText);        
                alert('Error updating employee: ' + error);
            }
        });
    });
}catch(e){
    console.error('error initializing modal',e)
}
});

//add scripts
$(document).ready(function() {
   try{
    const addModal = new bootstrap.Modal(document.getElementById('addEmployeeModal'));
    console.log('modal initialised');


    // edit btn clicked
    $(document).on('click', '.add-employee', function() {
        console.log('edit button clicked');
        
        // const id = $(this).data('emp_id');
        const name = $(this).data('emp_name');
        const email = $(this).data('emp_email');
        const department = $(this).data('department');
        
        // $('#addEmployeeId').val(id);
        $('#addName').val(name);
        $('#addEmail').val(email);
        $('#addDepartment').val(department);
        
        
        addModal.show();
    });
    
    // onsave
    $('#saveNewEmployee').click(function() {
        const formData = {
            // emp_id: $('#editEmployeeId').val(),
            emp_name: $('#addName').val(),
            emp_email: $('#addEmail').val(),
            department: $('#addDepartment').val()
        };
        console.log("Sending data",formData);
        
        
        
        $.ajax({
            url: '/employees/add',
            method: 'POST',
            data: formData,
            success: function(response) {
            console.log("response",response);
              if(response.success){
                alert('Employee added successfully!');   
                $(`#addEmployeeModal`).modal('hide');
                refreshEmployeeModal();
              }else{
                alert('error adding employee:' + response.error);
              }
            
                addModal.hide();
                
               
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:",xhr.responseText);        
                alert('Error adding employee: ' + error);
            }
        });
        function refreshEmployeeTable() {
    $.ajax({
        url: '/employees',
        method: 'GET',
        success: function(response) {
            let employeeTable = $(response).find('.table').html();
            $('.table').html(employeeTable);
        },
        error: function(xhr, status, error) {
            alert('Error refreshing table: ' + error);
        }
    });
}
 });
}catch(e){
    console.error('error initializing modal',e)
}
});
// view scripts

$(document).ready(function() {
    
    $(document).on('click', '.view-employee', function() {
        var empId = $(this).data('emp_id');
        const viewModal = new bootstrap.Modal(document.getElementById('viewEmployeeModal'));
        console.log('Modal initialised');
        $('#viewEmpId, #viewEmpName, #viewEmpEmail, #viewEmpDepartment').text('Loading...');
    
        $.ajax({
            url: '/employees/view?id=' + empId,
            method: 'GET',
            datatype:'JSON',
            success: function(response) {
                console.log('ajax sucess',response);
                
                if (response && response.success) {
                    console.log('setting employee data');
                    
                    const employee = response.data;
                    $('#viewEmpId').text(employee.emp_id);
                    $('#viewEmpName').text(employee.emp_name);
                    $('#viewEmpEmail').text(employee.emp_email);
                    $('#viewEmpDepartment').text(employee.department);
                    // viewModal.show();
                    console.log('modal should be showing soon');
                    $('#viewEmployeeModal').modal('show');

                } else {
                    alert('Error loading employee: ' + (response.error || 'Unknown error'));
                }
            },
            error: function(xhr, status, error) {
                // $('#viewEmployeeModal .modal-body').html(`
                // <div class="alert alert-danger">
                //     Error: ${xhr.status} ${xhr.statusText}
                //     ${xhr.responseText ? '<br>' + xhr.responseText : ''}
                // </div>`);
                console.error('ajax request failed');
                
                console.error('AJAX Error,Status:',status,error);
                console.error('Response text:',xhr.responseText);
                
                alert('Error fetching employee details: ' + error);
            }
        });
        
    });
});

</script>
</body>
</html>
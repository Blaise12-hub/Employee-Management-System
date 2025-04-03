
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

</style>
 <?php require VIEW_PATH . "/layouts/sidebar.php"; ?> 

<body class="container mt-4 p-4">

 <h2>Employees Management</h2>

 <button class="add">+ Add Employee</button>

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
                    <button><a href="/employees/view?id=<?= $employee['emp_id']; ?>">View</a></button>
                    <button><a href="/employees/edit?id=<?= $employee['emp_id']; ?>">Edit</a></button>
                    <button><a href="/employees/delete?id=<?= $employee['emp_id']; ?>" onclick="return confirm('Are you sure?')">Delete</a></button>
                </td>
            </tr>
        <?php endforeach; ?>

   </table>

   <?php else: ?>
    <p class="alert alert-warning">No Employees found</p>
  
    <?php endif; ?>

 



</body>
</html>
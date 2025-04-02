
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

</head>
<body class="container mt-5">

 <h2>Employees</h2>

<?php if(!empty($employees)):  ?>
   <table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Department</th>
     </tr>
     <?php foreach ($employees as $employee): ?>  
            <tr>
                <td><?= htmlspecialchars($employee['id']) ?></td>
                <td><?= htmlspecialchars($employee['name']) ?></td>
                <td><?= htmlspecialchars($employee['email']) ?></td>
                <td><?= htmlspecialchars($employee['department']) ?></td>
            </tr>
        <?php endforeach; ?>

   </table>

   <?php else: ?>
    <p class="alert alert-warning">No Employees found</p>
  
    <?php endif; ?>




</body>
</html>
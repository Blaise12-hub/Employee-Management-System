<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Report</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<style>
    /* .mt-5{
        background: gray;
    } */
    .mb-3{
        width: 30%;
    }
</style>
<body class="container mt-5">
    <h2 class="text-center">Attendance Report</h2>
    <form method="GET" class="mb-3">
        <label for="date">Select Date:</label>
        <input type="date" name="date" id="date" class="form-control" required>
        <button type="submit" class="btn btn-primary mt-2">Filter</button>
    </form>

    <?php if(!empty($records)): ?>
    <table class="table table-bordered">
        <tr>
            <th>Employee Name</th>
            <th>Status</th>
        </tr>
        <?php foreach ($records as $record): ?>
            <tr>
                <td><?= $record['name'] ?></td>
                <td><?= $record['status'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php else: ?>
    <p class="alert alert-warning">No Employees found</p>

    <?php endif; ?>

</body>
</html>

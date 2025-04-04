<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .attendance-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            width: 100%;
            max-width: 500px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .text-center{
            color:rgb(1, 73, 7);;
        }
        .btn{
            background:rgb(1, 73, 7);
            color:white;
        }
    </style>
</head>
<body>

    <div class="container attendance-container">
        <div class="card">
            <h3 class="text-center">Mark Attendance</h3>
            <form action="/attendance/mark" method="POST">
                <div class="mb-3">
                    <label for="employee_id" class="form-label">Employee ID</label>
                    <input type="number" class="form-control" id="employee_id" name="employee_id" required>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="Present">Present</option>
                        <option value="Absent">Absent</option>
                        <option value="Late">Late</option>
                    </select>
                </div>
                <button type="submit" class="btn w-100">Submit</button>
            </form>
        </div>
    </div>

</body>
</html>

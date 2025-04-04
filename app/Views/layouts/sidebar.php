<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .sidebar{
        width: 200px;
        height:100vh;
        position:fixed;
        left:0;
        top:0;
        background:rgb(1, 73, 7) ;
        color:white;
        padding-top: 20px;

    }
    .sidebar ul{
        list-style:none;
        padding:0;
    }
    .sidebar ul li{
        padding:10px; 
        margin-left:10px;  
    }
    .sidebar ul li a{
        color:white;
        text-decoration:none;
    }
    .sidebar h2{
        margin-left:20px;

    }
</style>
<body>
    <div class="sidebar">
    <h2>E.M.S</h2>

        <ul>
            <li><a href="/employees">Employees</a></li>
            <li><a href="/attendance">Attendance</a></li>
            <li><a href="">Profile</a></li>
            <li><a href="">Logout</a></li>

        </ul>

    </div>
</body>
</html>
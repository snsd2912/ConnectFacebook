<?php
    session_start();
    include("../User.php");
    include("../connect.php");
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="teacher.css">
    <script src="https://kit.fontawesome.com/50e4937a61.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- side bar  -->
    <div class="sidebar" >
        <ul class="menu">
            <li>
               <a href="#"> <i class="fas fa-user"></i> <?php echo "<span>".$_SESSION["username"]."</span>"; ?> </a> 
            </li>
            <li>
                <a href="student_show.php">Students</a>
            </li>
            <li>
                <a href="user.php">Users</a>
            </li>
            <li>
                <a href="assignment.php">Assignment</a>
            </li>
            <li>
                <a href="challenge.php">Challenge</a>
            </li>
            <li>
                <a href="../logout.php">Log out</a>
            </li>
        </ul>

    </div>

    <!-- home form -->
    <div class="content" id="home">
        <div style="position:absolute;top:50%;left:50%;transform:transfer(-50%,-50%);">
            <p style="font-size:30px;font-style:bold;">YOU ARE A TEACHER</p>
        </div>
    </div>

</body>
</html> 
<?php
    session_start();
    include("../User.php");
    include("../connect.php");
    $assignment_list = "";
    $id = $_SESSION["id"];
    
    if(isset($_GET["action"])){
        if($_GET["action"]=="show"){
            $id_assign = $_GET["id"];
            $sql = "SELECT tblsubmit.filename, tbluser.name, tblsubmit.updateon FROM tblsubmit, tbluser 
                    WHERE tbluser.id = tblsubmit.id_stu AND tblsubmit.id_assign = '$id_assign'";
            $result = $conn->query($sql);
            while($row = $result->fetch_array(MYSQLI_NUM)) { 
                // process each row
                $assignment_list .= "<tr>";
                $assignment_list .= "<th>".$row[1]."</th>";
                $assignment_list .= "<th>".$row[2]."</th>";
                $assignment_list .= "<th> <a href='../uploads/".$row[0]."' download> Download </a> </th>";
                $assignment_list .= "</tr>";
            }
        }
    }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="teacher.css">
    <script src="https://kit.fontawesome.com/50e4937a61.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- side bar  -->
    <div class="sidebar" >
        <ul class="menu">
            <li>
               <a href="index.php"> <i class="fas fa-user"></i> <?php echo "<span>".$_SESSION["username"]."</span>"; ?> </a> 
            </li>
            <li>
                <a href="student_show.php">Students</a>
            </li>
            <li>
                <a href="user.php">Users</a>
            </li>
            <li>
                <a href="#" class="darkblue">Assignment</a>
            </li>
            <li>
                <a href="#">Challenge</a>
            </li>
            <li>
                <a href="../logout.php">Log out</a>
            </li>
        </ul>

    </div>

    <!-- assignment tab -->
    <div class="content" id="assignment">
        <a href="assignment.php" class="add">Back</a>
        <div class="assignment-list">
            <table>
                <tr>
                    <th>Tên </th>
                    <th>Ngày nộp</th>
                    <th>Bài làm</th>
                </tr>
                <?php 
                    echo $assignment_list;
                ?>
            </table>
        </div>
    </div>

</body>
</html>
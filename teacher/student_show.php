<?php
    session_start();
    include("../User.php");
    include("../connect.php");
    $student_list = "";
    $pos = 2;
    $username = $password = $name = $phonenumber = $email = "";

    if(isset($_GET["action"])){
        if($_GET["action"] == "delete"){
            $id = $_GET["id"];
            $sql = "DELETE FROM tbluser WHERE id = '$id'";
            if($conn->query($sql) == true){     
                $message = "Delete sucessfully";
            }else $message = "Failed to delete";
        }
    }


    // get students list
    $sql = "SELECT * FROM tbluser WHERE pos = '$pos'";
    $result = $conn->query($sql);
            
    while($row = $result->fetch_array(MYSQLI_NUM)) { 
        // process each row
        $student_list .= "<tr>";
        $student_list .= "<th>".$row[4]."</th>";
        $student_list .= "<th>".$row[5]."</th>";
        $student_list .= "<th>".$row[6]."</th>";
        $student_list .= "<th> <a href='student_edit.php?action=edit&id=".$row[0]."'> Edit </a> </th>";
        $student_list .= "<th> <a href='student_show.php?action=delete&id=".$row[0]."'> Delete </a> </th>";
        $student_list .= "</tr>";
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
                    <a href="index.php" class="first-child"> <i class="fas fa-user"></i> <?php echo "<span>".$_SESSION["username"]."</span>"; ?> </a> 
                </li>
                <li>
                    <a href="#" class="darkblue">Students</a>
                </li>
                <li>
                    <a href="user.php">Users</a>
                </li>
                <li>
                    <a href="assignment.php">Assignment</a>
                </li>
                <li>
                    <a href="challenge.php" >Challenge</a>
                </li>
                <li>
                    <a href="../logout.php">Log out</a>
                </li>
            </ul>

    </div>

    <!-- student form -->
    <div class="content">
        <a href="student_add.php" class="add">Add</a>
        <div class="students-list">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone number</th>
					<th></th>
					<th></th>
                </tr>
                <?php 
                    echo $student_list;
                ?>
            </table>
        </div>
    </div>


</body>
</html>
<?php
    session_start();
    include("../User.php");
    include("../connect.php");
    $assignment_list = "";
    
    // show assignment list
    $sql = "SELECT * FROM tblassignment";
    $result = $conn->query($sql);
    while($row = $result->fetch_array(MYSQLI_NUM)) { 
        // process each row
        $assignment_list .= "<tr>";
        $assignment_list .= "<th>".$row[1]."</th>";
        $assignment_list .= "<th> <a href='../uploads/".$row[3]."' download> Download </a> </th>";
        $assignment_list .= "<th> <a href='assignment_upload.php?id=".$row[0]."'> Submit </a> </th>";
        $assignment_list .= "</tr>";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="student.css">
    <script src="https://kit.fontawesome.com/50e4937a61.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- side bar  -->
    <!-- side bar  -->
    <div class="sidebar" >
        <ul class="menu">
			<li>
               <a href="index.php" > <i class="fas fa-user"></i> <?php echo "<span>".$_SESSION["username"]."</span>"; ?> </a> 
            </li>
            <li>
                <a href="user.php">Users</a>
            </li>
            <li>
                <a href="assignment_show.php" class="darkblue">Assignments</a>
            </li>
            <li>
                <a href="challenge.php" >Challenges</a>
            </li>
			<li>
                <a href="changeinfo.php" >Change info</a>
            </li>
			<li>
                <a href="changepwd.php" >Change password</a>
			</li>
			<li>
                <a href="../logout.php">Log out</a>
            </li>
        </ul>
	</div>

    <!-- assignment tab -->
    <div class="content" id="assignment">
        <div class="assignment-list">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Download</th>
                    <th></th>
                </tr>
                <?php 
                    echo $assignment_list;
                ?>
            </table>
        </div>
    </div>

</body>
</html>
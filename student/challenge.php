<?php
    session_start();
    include("../User.php");
    include("../connect.php");
    $challenge_list = "";
    
    // show assignment list
    $sql = "SELECT * FROM tblchallenge";
    $result = $conn->query($sql);
    while($row = $result->fetch_array(MYSQLI_NUM)) { 
        // process each row
        $challenge_list .= "<tr>";
        $challenge_list .= "<th>".$row[2]."</th>";
        $challenge_list .= "<th> <a href='challenge_detail.php?id=".$row[0]."'> More detail </a> </th>";
        $challenge_list .= "</tr>";
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
    <div class="sidebar" >
        <ul class="menu">
			<li>
               <a href="index.php" > <i class="fas fa-user"></i> <?php echo "<span>".$_SESSION["username"]."</span>"; ?> </a> 
            </li>
            <li>
                <a href="user.php">Users</a>
            </li>
            <li>
                <a href="assignment_show.php">Assignments</a>
            </li>
            <li>
                <a href="challenge.php" class="darkblue">Challenges</a>
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
                    <th>Challenge's Name</th>
                    <th></th>
                </tr>
                <?php 
                    echo $challenge_list;
                ?>
            </table>
        </div>
    </div>

</body>
</html>
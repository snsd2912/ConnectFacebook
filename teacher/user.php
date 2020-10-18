<?php
    session_start();
    include("../User.php");
	include("../connect.php");
	$id = $_SESSION["id"];
	
	$sql = "SELECT * FROM tbluser WHERE NOT id = '$id' ";
	$result = $conn->query($sql);
	$userlist = "";
	while($row = $result->fetch_array(MYSQLI_NUM)){
		$userlist .= "<tr>";
		$userlist .= "<th> ".$row[4]." </th>";
		$userlist .= "<th> <a href='message.php?idguest=".$row[0]."'>Watch more detail</a></th>";
		$userlist .= "</tr>";
	}
			
		
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="teacher.css">
    <script src="https://kit.fontawesome.com/50e4937a61.js" crossorigin="anonymous"></script>
</head>
</head>
<body>
    <div class="sidebar" >
            <ul class="menu">
                <li>
                    <a href="index.php" class="first-child"> <i class="fas fa-user"></i> <?php echo "<span>".$_SESSION["username"]."</span>"; ?> </a> 
                </li>
                <li>
                    <a href="student_show.php" >Students</a>
                </li>
                <li>
                    <a href="#" class="darkblue">Users</a>
                </li>
                <li>
                    <a href="assignment.php">Assignment</a>
                </li>
                <li>
                    <a href="challenge.php" id="bchallenge">Challenge</a>
                </li>
                <li>
                    <a href="../logout.php">Log out</a>
                </li>
            </ul>

    </div>
 
	<div class="content" style="padding: 50px!important;">
		<table style="width:100%!important;">
			<tr>
				<th> Username </th>
				<th> </th>
			</tr>
			<?php
				echo $userlist;
			?>
		</table>
	</div>
	   

</body>
</html> 
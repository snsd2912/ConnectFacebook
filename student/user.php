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
    <link rel="stylesheet" href="student.css">
    <script src="https://kit.fontawesome.com/50e4937a61.js" crossorigin="anonymous"></script>
</head>
</head>
<body>
    <div class="sidebar" >
        <ul class="menu">
			<li>
               <a href="index.php" > <i class="fas fa-user"></i> <?php echo "<span>".$_SESSION["username"]."</span>"; ?> </a> 
            </li>
            <li>
                <a href="user.php" class="darkblue">Users</a>
            </li>
            <li>
                <a href="assignment_show.php">Assignments</a>
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
 
	<div class="content" id="user">
		<table>
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
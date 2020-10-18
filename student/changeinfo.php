<?php
    session_start();
    include("../User.php");
    include("../connect.php");
    
    $id = $_SESSION["id"];
    $sql = "SELECT * FROM tbluser WHERE id = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_array(MYSQLI_NUM);
    $name = $row["4"];
    $phonenumber = $row["5"];
    $email = $row["6"];
	// click change info
	if(isset($_POST["chinfo"])){
		$email = $_POST["email"];
		$phonenumber = $_POST["phonenumber"];
		
		// check if information is in the right format
        if(empty($phonenumber) or empty($email)){
            $err = "*Fill all the fields";
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $err = "*Invalid email format";
        } elseif(!preg_match("/^[0]{1}[0-9]{9}$/", $phonenumber)){
            $err = "*Phone number must have ten numbers and starts with 0.";
        } else {
			$sql = "UPDATE tbluser SET email = '$email', pnumber = '$phonenumber' WHERE id = '$id'";
			if($conn->query($sql) == true){
					$err = "Sucess";
			}else $err = "Change info failed. Try again";
		}	
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
                <a href="user.php">Users</a>
            </li>
            <li>
                <a href="assignment_show.php">Assignments</a>
            </li>
            <li>
                <a href="challenge.php" >Challenges</a>
            </li>
			<li>
                <a href="changeinfo.php" class="darkblue" >Change info</a>
            </li>
			<li>
                <a href="changepwd.php"  >Change password</a>
			</li>
			<li>
                <a href="../logout.php">Log out</a>
            </li>
        </ul>
	</div>

    <div class="content">
        <form action="" method="post">
            <span class="err"> <?php echo $err; ?> </span><br><br>
			<p>Name: <?php echo $name ?> </p>	
			<label for="email">Email:</label><br>
			<input type="text" name="email" value="<?php echo $email?>"><br>
			<label for="phonenumber">Phone number:</label><br>
			<input type="text" name="phonenumber" value="<?php echo $phonenumber?>"><br>
			<input type="submit" value="Save" name="chinfo">
		</form>
    </div>

</body>
</html> 
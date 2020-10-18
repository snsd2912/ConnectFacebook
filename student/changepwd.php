<?php
    session_start();
    include("../User.php");
    include("../connect.php");

    $id = $_SESSION["id"];
    // click change password
	if(isset($_POST["chpwd"])){
		$oldpwd = $_POST["oldpwd"];
        $newpwd = $_POST["newpwd"];
        
        if(empty($oldpwd) || empty($newpwd)){
            $err = "*Fill out the blanks";
        }else{
            $encrypt_oldpwd = md5($oldpwd);
            $encrypt_newpwd = md5($newpwd);
            $sql = "SELECT * FROM tbluser WHERE id = '$id' AND password = '$encrypt_oldpwd'";
            $result = $conn->query($sql);
            $count = $result->num_rows;
            
            if($count>0){
                $sql = "UPDATE tbluser SET password = '$encrypt_newpwd' WHERE id = '$id'";
                if($conn->query($sql) == true){
                    $err = "Sucess";
                }else $err = "Change password failed. Try again";
            }else{
                $err = "Old password is wrong";
            }
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
                <a href="changeinfo.php" >Change info</a>
            </li>
			<li>
                <a href="changepwd.php" class="darkblue" >Change password</a>
			</li>
			<li>
                <a href="../logout.php">Log out</a>
            </li>
        </ul>
	</div>

            
        
    </div>

    <div class="content">
        <form action="" method="post">
			<span class="err"> <?php echo $err; ?> </span> <br><br>
			<label for="oldpwd">Old password:</label><br>
			<input type="password" name="oldpwd"><br>
			<label for="newpwd">New Password</label><br>
			<input type="password" name="newpwd"><br>
			<input type="submit" value="Save" name="chpwd">
		</form>
    </div>

</body>
</html> 
<?php
    session_start();
    include("../User.php");
    include("../connect.php");
    
    $username = $password = $name = $phonenumber = $email = "";

    if(isset($_GET["action"])){
        if($_GET["action"] == "edit"){
            $id = $_GET["id"];
            $_SESSION["stu-id"] = $id;
            $sql = "SELECT * FROM tbluser WHERE id = '$id'";
            $result = $conn->query($sql);
            $row = $result->fetch_array(MYSQLI_NUM);
            $username = $row[1];
            $password = $row[2];
            $name = $row[4];
            $phonenumber = $row[5];
            $email = $row[6];
        }

        if($_GET["action"] == "delete"){
            $id = $_GET["id"];
            $sql = "DELETE FROM tbluser WHERE id = '$id'";
            if($conn->query($sql) == true){     
                $message = "Delete sucessfully";
            }

            $pageName = "student";
        }
    }


    // click on edit
    if(isset($_POST["modification"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $name = $_POST["name"];
        $phonenumber = $_POST["phonenumber"];
        $email = $_POST["email"];
        $encrypt_pwd = md5($password);

        // check if information is in the right format
        if(empty($username) or empty($password) or empty($name) or empty($phonenumber) or empty($email)){
            $err = "*Fill all the fields";
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $err = "*Invalid email format";
        } elseif(!preg_match("/^[0]{1}[0-9]{9}$/", $phonenumber)){
            $err = "*Phone number must have ten numbers and starts with 0.";
        } else{
            $id = $_SESSION["stu-id"];
            $sql = "UPDATE tbluser SET username='$username',password='$encrypt_pwd',name='$name',pnumber='$phonenumber',
            email='$email' WHERE id = '$id'";
            if($conn->query($sql) == true){
                $err = "Modify sucessfully";
            }else{
                $err = "Failed";
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
                    <a href="challenge.php" id="bchallenge">Challenge</a>
                </li>
                <li>
                    <a href="../logout.php">Log out</a>
                </li>
            </ul>

    </div>

    <!-- modifying students'information form -->
    <div class="content displaynone" id="stu-modification">
        <a href="student_show.php" class="add">Back</a>
        <form method="post" action=""  class="addition">
			<p>Modification Form</p>
            <span  class="err"> <?php echo $err ?> </span>
			<input type="text" name="username"  placeholder="Username" value="<?php echo $username?>" >
			<input type="password" name="password"  placeholder="Password" value="<?php echo $password?>" >
			<input type="text" name="name"  placeholder="Name" value="<?php echo $name?>" >
			<input type="text" name="email"  placeholder="Email" value="<?php echo $email?>" >
			<input type="text" name="phonenumber"  placeholder="Phone number" value="<?php echo $phonenumber?>" >
			<input type="submit" value="Save" name="modification">
        </form>
    </div>


</body>
</html>
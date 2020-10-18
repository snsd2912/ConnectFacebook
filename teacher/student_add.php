<?php
    session_start();
    include("../User.php");
    include("../connect.php");
    $student_list = "";
    $pos = 2;
    $pageName = "";
    $username = $password = $name = $phonenumber = $email = "";

    // click add in the addition form
    if(isset($_POST["addition"])){
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
            //check whether username is used or not
            $sql = "SELECT * FROM tbluser WHERE username = '$username'";
            $result = $conn->query($sql);
            $count = $result->num_rows;
            if($count==0){
                // insert to database
                $sql = "INSERT INTO tbluser(username, password, pos, name, pnumber, email) VALUES (
                    '$username', '$encrypt_pwd', '$pos', '$name', '$phonenumber', '$email'
                )";
                if($conn->query($sql) == true){
                    $err = "*Sucess";
                }
            }else{
                $err = "*Username is used already.";
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

    <!-- adding student form -->
    <div class="content " id="stu-addition">
        <a href="student_show.php" class="add">Back</a>
        <form method="post" action=""  class="addition">
			<p>Addition Form</p>
            <span class="err"> <?php echo $err ?> </span>
			<input type="text" name="username"  placeholder="Username" value="<?php echo $username?>" >
			<input type="password" name="password"  placeholder="Password" value="<?php echo $password?>" >
			<input type="text" name="name"  placeholder="Name" value="<?php echo $name?>" >
			<input type="text" name="email"  placeholder="Email" value="<?php echo $email?>" >
			<input type="text" name="phonenumber"  placeholder="Phone number" value="<?php echo $phonenumber?>" >
			<input type="submit" value="Add" name="addition">
        </form>
    </div>


</body>
</html>
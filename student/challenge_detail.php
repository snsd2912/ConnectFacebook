<?php
    session_start();
    include("../User.php");
    include("../connect.php");
    $title = $hint ="";

    // get information of the challenge
    if(isset($_GET["id"])){
        $chal_id = $_GET["id"];
        $sql = "SELECT * FROM tblchallenge WHERE id = '$chal_id'";
        $result = $conn->query($sql);
        while($row = $result->fetch_array(MYSQLI_NUM)){
            $title = $row[2];
            $hint = $row[3];
        }
    }

    if(isset($_POST["submit"])){
        $result = $_POST["result"];
        $folder = "../challenge/";
        $list = scandir($folder);
        $len = count($list);
        for ($i=0 ; $i < $len ; $i++ ) { 
            //echo $list[$i];
            $arr = explode('.',$list[$i]);
            if($title == $arr[0] && $arr[1] == $result){
                header("location: ./challenge_result.php?challenge-id=".$id."&file-name=".$list[$i]."");
                exit();
            }else{
                $err = "*Wrong answer";
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
    <link rel="stylesheet" href="student.css">
    <script src="https://kit.fontawesome.com/50e4937a61.js" crossorigin="anonymous"></script>
</head>
<body>
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
    <div class="content">
        
        <a href="challenge.php" class="add">Back</a>

        <form action="" method="post" enctype="multipart/form-data">
            <p style="text-align:center;">Challenge's Name: <?php echo $title;?></p>
            <span style="text-align:center;display:block;">Hint: <?php echo $hint;?> </span> <br><br>
            <span style="text-align:center;display:block;">Type your result below:</span><br>
            <input style="position: relative;left: 50%; transform: translateX(-50%);" type="input" id="result" name="result"><br><br>
			<input type="submit" value="Submit" name="submit"><br><br>
            <span class="err"> <?php echo $err ?> </span>
        </form>    
    </div>

</body>
</html>
<?php
    session_start();
    include("../User.php");
    include("../connect.php");
    // get information of the challenge
    if(isset($_GET["file-name"])){
        $file_name = $_GET["file-name"];
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

        <div>
            <p>Your answer is correct! Here is the file content: </p>
            <?php
                $file = fopen("../challenge/".$file_name,"r");

                while(! feof($file))
                {
                    echo fgets($file). "<br />";
                }
                
                fclose($file);
            ?>
        </div>  
    </div>

</body>
</html>
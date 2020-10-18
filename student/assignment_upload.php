<?php
    session_start();
    include("../User.php");
    include("../connect.php");
    
    $assign_name = "";
    if(isset($_GET["id"])){
        $id_assign = $_GET["id"];
        $sql = "SELECT * FROM tblassignment WHERE id='$id_assign'";
        $result = $conn->query($sql);
        $row = $result->fetch_array(MYSQLI_NUM);
        $assign_name = $row[1];
    }

    // click submit assignment 
    if(isset($_POST["submit"])){
        // check whether chose file yet
        if(!empty($_FILES["file"]["name"])){
            $targetDir = "../uploads/";
            $fileName = basename($_FILES["file"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            $allowTypes = array('doc','docx','pdf');
            // check format
            //if(in_array($fileType, $allowTypes)){

                if($_FILES["file"]["size"] > 2097152){
                    $err = "*Your file is too large";
                }else{
                    // upload file to server
                    if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                        $id_stu = $_SESSION["id"];
                        $sql = "INSERT INTO tblsubmit (id_assign,id_stu, filename, updateon) VALUES('$id_assign','$id_stu','$fileName',NOW())";
                        if($conn->query($sql)==true){
                            $err = "Upload sucessfully";
                        }else{
                            $err = "File uploaded fail, please try again";
                        }
                    }else{
                        $err = "There was an error uploading your file";
                    }
                }
                
            // }else{
            //     $err = "Only DOC, DOCX, PDF files are allowed to upload.";
            // }
        }else{
            $err = "Please select a file to upload";
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
    <div class="content">
        <a href="assignment_show.php" class="add">Back</a>
        <form action="" method="post" enctype="multipart/form-data" >
            <p style="text-align:center;"> Assignment:  <?php echo $assign_name; ?> </p>
            <input style="position: relative;left: 50%; transform: translateX(-50%);" type="file" id="myfile" name="file"><br><br>
			<input type="submit" value="Upload" name="submit"><br><br>
            <span class="err"> <?php echo $err ?> </span>
		</form>
    </div>

</body>
</html>
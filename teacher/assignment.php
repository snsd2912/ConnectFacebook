<?php
    session_start();
    include("../User.php");
    include("../connect.php");
    $assignment_list = "";
    $id = $_SESSION["id"];
    // click submit assignment 
    if(isset($_POST["submit"])){
        // check whether chose file yet
        if(!empty($_FILES["file"]["name"])){
            $targetDir = "../uploads/";
            $fileName = basename($_FILES["file"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            $title = $_POST["title"];
            $allowTypes = array('doc','docx','pdf');
            // check format
            //if(in_array($fileType, $allowTypes)){

                if($_FILES["file"]["size"] > 2097152){
                    $err = "*Your file is too large";
                }elseif(empty($title)){
                    $err = "*Title can not be empty";
                }else{
                    // upload file to server
                    if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                        $id = $_SESSION["id"];
                        $sql = "INSERT INTO tblassignment (title,idteacher, filename, updateon) VALUES('$title','$id','$fileName',NOW())";
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

    // show assignment list
    $sql = "SELECT * FROM tblassignment WHERE idteacher='$id'";
    $result = $conn->query($sql);
    while($row = $result->fetch_array(MYSQLI_NUM)) { 
        // process each row
        $assignment_list .= "<tr>";
        $assignment_list .= "<th>".$row[1]."</th>";
        $assignment_list .= "<th> <a href='assignment_show.php?action=show&id=".$row[0]."'> Xem danh sach bai lam </a> </th>";
        $assignment_list .= "</tr>";
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
               <a href="index.php"> <i class="fas fa-user"></i> <?php echo "<span>".$_SESSION["username"]."</span>"; ?> </a> 
            </li>
            <li>
                <a href="student_show.php">Students</a>
            </li>
            <li>
                <a href="user.php">Users</a>
            </li>
            <li>
                <a href="#" class="darkblue">Assignment</a>
            </li>
            <li>
                <a href="challenge.php">Challenge</a>
            </li>
            <li>
                <a href="../logout.php">Log out</a>
            </li>
        </ul>

    </div>

    <!-- assignment tab -->
    <div class="content" id="assignment">
        <form action="" method="post" enctype="multipart/form-data" class="assignment">
            <label for="title">Title:</label> 
            <input type="text" id="title" name="title"><br><br>
            <label for="myfile">Select file:</label> 
            <input type="file" id="myfile" name="file"><br><br>
			<input type="submit" value="Upload" name="submit"><br><br>
            <span class="err"> <?php echo $err ?> </span>
		</form>

        <div class="assignment-list">
            <table>
                <tr>
                    <th>Name</th>
                    <th>List</th>
                </tr>
                <?php 
                    echo $assignment_list;
                ?>
            </table>
        </div>
    </div>

</body>
</html>
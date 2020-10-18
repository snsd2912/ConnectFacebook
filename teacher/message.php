<?php
    session_start();
    include("../User.php");
    include("../connect.php");
    $id = $_SESSION["id"];
    $username = $_SESSION["username"];
    $id_guest = "";
    $name = $username_guest = $email = $phonenumber = "";
    $messagelist = "";
    // get guest id
        if(isset($_GET["idguest"])){
            $id_guest = $_GET["idguest"];
    
            $sql = "SELECT * FROM tbluser WHERE id = '$id_guest'";
            $result = $conn->query($sql);
            $row = $result->fetch_array(MYSQLI_NUM);
            $username_guest = $row[1];
            $name = $row[4];
            $phonenumber = $row[5];
            $email = $row[6];
    
    
            $sql2 = "";
            $sql2 .= "SELECT * FROM message WHERE id_sender='$id' AND id_reciever='$id_guest' UNION
                        SELECT * FROM message WHERE id_sender='$id_guest' AND id_reciever='$id'
                        ORDER BY id";
            $result = $conn->query($sql2);
            $row = $result->num_rows;
            while($row = $result->fetch_array(MYSQLI_NUM)){
                if($row[1]==$id){
                    $messagelist .= "<form action='' method='POST'>";
                    $messagelist .= "<span>".$username."</span><br>";
                    $messagelist .= "<input type='text' name='message' value='".$row[3]."' >";
                    $messagelist .= "<input type='hidden' name='id' value='".$row[0]."' />";
                    $messagelist .= "<input type='submit' name='edit' value='Edit'>";
                    $messagelist .= "<input type='submit' name='delete' value='Delete'>";
                    $messagelist .= "</form>";
                }elseif($row[1]==$id_guest){
                    $messagelist .= "<form action='' method='POST'>";
                    $messagelist .= "<span>".$username_guest."</span><br>";
                    $messagelist .= "<input type='text' name='message' value='".$row[3]."' disabled>";
                    $messagelist .= "</form>";
                }
            }	
        }
    

    
    // click send new message
    if(isset($_POST["send"])){
        $content = $_POST["newmessage"];
        $sql = "INSERT INTO message(id_sender,id_reciever,content) VALUES ('$id','$id_guest','$content')";
        //$sql = "UPDATE message SET content='$content' WHERE id='";
        if($result = $conn->query($sql)){
            header("location: ./message.php?idguest=".$id_guest."");
        }else $err="*Failed to send";
    }

    // click send new message
    if(isset($_POST["edit"])){
        $id_sender = $_POST["id"];
        $content = $_POST["message"];
        $sql = "UPDATE message SET content='$content' WHERE id='$id_sender'";
        if($result = $conn->query($sql)){
            header("location: ./message.php?idguest=".$id_guest."");
        }else $err="*Failed to edit";
    }

    // click send new message
    if(isset($_POST["delete"])){
        $id_sender = $_POST["id"];
        $sql = "DELETE FROM message WHERE id='$id_sender'";
        if($result = $conn->query($sql)){
            header("location: ./message.php?idguest=".$id_guest."");
        }else $err="*Failed to delete";
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
 
 
	<div class="container">
		<div class="row">
			<a href="user.php" class="add" style="float:right;">Back</a>
		</div>
		<div class="row"> 
			<p> Name: <?php echo $name;?></p>
			<p> Phonenumber: <?php echo $phonenumber;?></p>
			<p> Email: <?php echo $email;?></p>
		</div>
		<div class="row" style="height:550px;overflow: scroll;">
            <?php
                echo $messagelist;
            ?>
		</div>
        <div class="row">
            <form action="" method="POST">
                <span class="err"> <?php echo $err; ?> </span>
                <input type="text" name="newmessage">
                <input type="submit" name="send" value="Send">
            </form> 
        </div>	
	</div>

</body>
</html> 
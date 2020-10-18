<?php
    session_start();
    include("../User.php");
	include("../connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
	<link rel="stylesheet" href="student.css">
    <script src="https://kit.fontawesome.com/50e4937a61.js" crossorigin="anonymous"></script>
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
                <a href="changepwd.php" >Change password</a>
			</li>
			<li>
                <a href="../logout.php">Log out</a>
            </li>
        </ul>
	</div>

	 <!-- home form -->
	 <div class="content" id="home">
        <div style="position:absolute;top:50%;left:50%;transform:transfer(-50%,-50%);">
            <p style="font-size:30px;font-style:bold;">YOU ARE A STUDENT</p>
        </div>
    </div>
	
<!-- 
	
	<script>
			function changePage(evt, pageName){
				var i, tabcontent, tablink;
				
				tabcontent = document.getElementsByClassName("content");
				for (i = 0; i < tabcontent.length; i++) {
					tabcontent[i].style.display = "none";
				}

				tablinks = document.getElementsByClassName("bar");
				for (i = 0; i < tablinks.length; i++) {
					if(tablinks[i].classList.contains("darkblue")){
						tablinks[i].classList.remove("darkblue");
					}
				}

				document.getElementById(pageName).style.display = "block";
				evt.currentTarget.classList.add("darkblue");
			}
	</script> -->

</body>
</html> 
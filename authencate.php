<?php
    session_start();
    include("connect.php");

    require 'vendor/autoload.php';
    use Twilio\Rest\Client;

    $err = "";
    $sid = "AC12370c3c8d30ce618377c411d26e0a3e";
    $token = "b2b7a259a03ce84fbf4b063a18d4e595";

    if($_SESSION["is_sent"]==false){
        $code = rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
        //echo $code;
        $sql = "UPDATE tbluser SET code = '$code' WHERE id = '".$_SESSION['id']."'";
        $res = $conn->query($sql);

        $sql = "SELECT * FROM tbluser";
        $res = $conn->query($sql);
        $row = $res->fetch_array(MYSQLI_NUM);
        //send code to your phone
        $client = new Client($sid,$token);
        $client->messages->create(
            "+84377824869", array(
                "from" => "+17205133451",
                "body" => "Your verified code is: ". $code
            )
        );

        $_SESSION["is_sent"] = true;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty(trim($_POST["OTP"]))){
            $err = "*Please enter your code";
        }else {
            $otp = trim($_POST["OTP"]);
            $sql = "SELECT * FROM tbluser WHERE id = '".$_SESSION['id']."' ";
            $res = $conn->query($sql);
            $row = $res->fetch_array(MYSQLI_NUM);

            if($row[10]==$otp){
                header("location: ./student/index.php");
            }else{
                $err = "Don't match";
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
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form" method="post">
        <p>Verified code has been sent to your phone.</p>
        <?php echo "<span class='err'>".$err."</span>" ?><br>
        <input type="text" name="OTP" placeholder="Enter code here">
        <input type="submit" value="Submit">
        <a href="./index.php">Back</a>
    </form>
</body>
</html>
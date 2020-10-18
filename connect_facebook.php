<?php
	include("connect.php");

	require 'vendor/autoload.php';

	$facebook = new Facebook\Facebook([
		'app_id' => '681907136071268',
		'app_secret' => 'f2538036c09cee4a04ff09908cab3679',
		'default_graph_version' => 'v2.5',
	]);

	$facebook_helper = $facebook->getRedirectLoginHelper();

    if(isset($_GET['code'])){

		if(isset($_SESSION['access_token'])){
            $access_token = $_SESSION['access_token'];
        }else{
            // try {
			// 	$access_token = $facebook_helper->getAccessToken();
			// } catch (\Facebook\Exceptions\FacebookResponseException $e) {
			// 	echo "Response Exception: " . $e->getMessage();
			// 	exit();
			// } catch (\Facebook\Exceptions\FacebookSDKException $e) {
			// 	echo "SDK Exception: " . $e->getMessage();
			// 	exit();
			// }
			$access_token = $facebook_helper->getAccessToken();
 
            $_SESSION['access_token'] = $access_token;

            $facebook->setDefaultAccessToken($_SESSION['access_token']);
        }

        $graph_response = $facebook->get("/me?fields=name,email", $access_token);

		$fbuserData = $graph_response->getGraphUser();
		$oauthpro = "facebook";
		$oauthid = $fbuserData['id'] ?? '';
		$name = $fbuserData['name'] ?? '';
		$email = $fbuserData['email'] ?? '';
		$username = explode('@',$email);
		
		//echo $oauthid;
		$sql = "SELECT * FROM tbluser WHERE oauthid = '$oauthid'";
		//echo $sql;	
		$res = $conn->query($sql);
		$count = $res->num_rows;
		//echo $count;

		if ($res->num_rows > 0) {
			//$conn->query("UPDATE tbluser SET username='".$f_name."' where id='".$row[0]."' ");
			$row = $res->fetch_array(MYSQLI_NUM);

			$_SESSION["id"] = $row[0];
			$_SESSION["username"] = $row[1];
			$_SESSION["is_sent"] = false;
			//echo $row[1];
			header("location: ./student/index.php");
		} else {
			$insert = "INSERT INTO tbluser (username,password,pos,name,email,oauthpro,oauthid) VALUES ('".$username[0]."', '".$username[0]."', '2', '".$name."', '".$email."','".$oauthpro."','".$oauthid."')";

			//echo $insert;
			$conn->query($insert);  
			$res = $conn->query($sql);
			$row = $res->fetch_array(MYSQLI_NUM);

			$_SESSION["id"] = $row[0];
			$_SESSION["username"] = $row[1];
			$_SESSION["is_sent"] = false;
			echo $row[1];
			header("location: ./student/index.php");
		}
		

    }else{
        $facebook_permissions = ['email'];

        $facebook_login_url = $facebook_helper->getLoginUrl(
            'http://localhost/sanglv11/',$facebook_permissions
		);
    }
?>
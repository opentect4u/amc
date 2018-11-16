
<?php

//ad user 
	if($_SERVER["REQUEST_METHOD"]=="POST" && $_SESSION['username']!= "" && !empty($_SESSION['username']) && isset($_SESSION['username']) && $_SESSION['access_type']== 'AD'){
		$user_id=trim_data($_POST["user_id"]);
		$user_password=$_POST["user_password"];
		$user_type=trim_data($_POST["user_type"]);

		
			$sql = "INSERT INTO `mm_login_master`(`user_id`, `user_password`,`user_type`) VALUES ('".$user_id."','".$user_password."','".$user_type."')";
			$result = mysqli_query($conn, $sql);
				if($result){
					echo '<script>alert("Added Successfully");</script>';
				}
		unset($user_id);
		unset($user_password);
		unset($user_type);

    }

    function trim_data($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		$data = strtoupper($data);
		return $data;
	}
?>
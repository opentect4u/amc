<?php require '../lib/connection.php';?>
<?
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['username']!= "" && !empty($_SESSION['username']) && isset($_SESSION['username']) && $_SESSION['access_type']=='A') {
				$login_user = $_POST["login_code"];
				$user_id =  trim_data($_POST["user_id"]);
				$user_password = $_POST["user_password"];
				$user_type = trim_data($_POST["user_type"]);
				

				$sqlupdate="UPDATE `login_master` SET `user_id`='".$user_id."',`user_password`='".$user_password."',`user_type`='".$user_type."' WHERE login_code='".$login_user."'";

			$localIP = $_SERVER['HTTP_HOST'];//getHostByName(getHostName());
			$resultupdate = mysqli_query($conn,$sqlupdate);
			
			$_SESSION['update_flag']=1;
			//header('Location:'.$l_dds_view_user.'');
			header("Location: http://".$localIP."/dds/admin_view_user.php");
			


}

function trim_data($data) {
					$data = trim($data);
					$data = strtoupper($data);
					return $data;
					}
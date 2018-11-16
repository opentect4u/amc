<?php
require '../../lib/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['username']!= "" && !empty($_SESSION['username']) && isset($_SESSION['username']) && $_SESSION['insert_flag']=="" && !empty($_SESSION['login_flag']) && isset($_SESSION['login_flag'])) {
				$new_password=trim_data($_POST["new_password"]);
				$old_password=trim_data($_POST["old_password"]);
				

				$sqlupdate="UPDATE `mm_login_master` SET `user_password`='".$new_password."' WHERE user_id='".$_SESSION['username']."' and user_password= '".$old_password."'";
				

			//$localIP = $_SERVER['HTTP_HOST'];//getHostByName(getHostName());
			$resultupdate = mysqli_query($conn,$sqlupdate);
			if($resultupdate){
						$_SESSION['insert_flag']="password";
						header('Location:'.$l_softek_change_pass.'');
			
			}
			
			
			


}
				function trim_data($data) {
					$data = trim($data);
					return $data;
					}
?>
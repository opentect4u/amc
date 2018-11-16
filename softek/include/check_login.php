<?php
	if($_SERVER["REQUEST_METHOD"]=="POST" && empty($_SESSION['username'])){
			$login_user=trim_data($_POST["login_user"]);
			$login_pass=$_POST["login_pass"];

			$login_sql="SELECT * FROM `mm_login_master` WHERE `user_id` = '".$login_user."' AND `user_password` = '".$login_pass."'";
			$login_result = mysqli_query($conn, $login_sql);
			if($login_result){
				if (mysqli_num_rows($login_result) > 0) {
					$login_data = mysqli_fetch_assoc($login_result);
					$_SESSION['username'] = $login_data['user_id'];
					$_SESSION['access_type'] = $login_data['user_type'];
					$login_date_sql="UPDATE `mm_login_master` SET `login_time`= now() WHERE `user_id` = '".$login_data['user_id']."' AND `user_password` = '".$login_pass."'";
					$login_date_result = mysqli_query($conn, $login_date_sql);
					$_SESSION['login_flag']="softek";
					$_SESSION['insert_flag']="";
					$_SESSION['update_flag']="";
					$_SESSION['update_flag1']="";
					$_SESSION['delete_flag']="";
					$_SESSION['count_flag']="";
					$_SESSION['invoice_flag']="";
					$_SESSION['serial_flag']="";
					$_SESSION['rdata']="";
					$_SESSION['client_id_flag']="";
					$_SESSION['check_order_flag']="";
					mysqli_close($conn);
				}
			}


	}
	function trim_data($data) {
		$data = trim($data);
		$data = strtoupper($data);
		return $data;
	}
?>

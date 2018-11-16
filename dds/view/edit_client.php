<?php
require '../../lib/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['username']!= "" && !empty($_SESSION['username']) && isset($_SESSION['username']) && $_SESSION['update_flag']=="" && !empty($_SESSION['login_flag']) && isset($_SESSION['login_flag'])) {

				$customer_code =  trim_data($_POST["customer_code"]);
				$customer_address =	 trim_data($_POST["customer_address"]);
				$customer_name = trim_data($_POST["customer_name"]);
				$customer_phone = trim_data($_POST["customer_phone"]);
				$customer_email = trim_data($_POST["customer_email"]);
				

				$sqlupdate="UPDATE `client_master` SET `client_name`='".$customer_name."',`client_address`='".$customer_address."',`client_phone`='".$customer_phone."',`client_email`='".$customer_email."',`updated_by`='".$_SESSION['username']."',`date_time`=now() WHERE `client_code`='".$customer_code."'";
				
				$resultupdate = mysqli_query($conn,$sqlupdate);
				if($resultupdate){
						$description_concat="".$customer_code.", ".$customer_name.", ".$customer_address.", ".$customer_phone.", ".$customer_email."";
						$sql_log_insert="insert into mm_log_master(description,department,table_name,operation,user_id) values ('".$description_concat."','DDS','CLIENT_MASTER','UPDATE','".$_SESSION['username']."')";
						$result_log_insert=mysqli_query($conn,$sql_log_insert);
						if($result_log_insert){
							$_SESSION['update_flag']="client";
							//$localIP = $_SERVER['HTTP_HOST'];
							header('Location:'.$l_dds_view_client.'');
						}
			  }

}
				function trim_data($data) {
					$data = trim($data);
					$data = strtoupper($data);
					return $data;
					}

?>
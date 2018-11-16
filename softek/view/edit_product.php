<?php
require '../../lib/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['username']!= "" && !empty($_SESSION['username']) && isset($_SESSION['username']) && $_SESSION['update_flag']=="" && !empty($_SESSION['login_flag']) && isset($_SESSION['login_flag'])) {
				$product_id=trim_data($_POST["product_code"]);
				$product_type=trim_data($_POST["product_type"]);
				

				$sqlupdate="UPDATE `mm_product_master` SET `product_type`='".$product_type."', `updated_by`='".$_SESSION['username']."',`date_time`=now() WHERE product_id='".$product_id."'";
				

			//$localIP = $_SERVER['HTTP_HOST'];//getHostByName(getHostName());
			$resultupdate = mysqli_query($conn,$sqlupdate);
			if($resultupdate){
					$description_concat="".$product_id.", ".$product_type."";
					$sql_log_update="insert into mm_log_master(description,department,table_name,operation,user_id) values ('".$description_concat."','SOFTEK','MM_PRODUCT_MASTER','UPDATE','".$_SESSION['username']."')";
					$result_log_insert=mysqli_query($conn,$sql_log_update);
					if($result_log_insert){
						$_SESSION['update_flag']="product";
						header('Location:'.$l_softek_view_product.'');
					}
			
			}
			
			
			


}
				function trim_data($data) {
					$data = trim($data);
					$data = strtoupper($data);
					return $data;
					}

?>
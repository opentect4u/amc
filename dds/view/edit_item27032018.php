<?php
require '../../lib/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['username']!= "" && !empty($_SESSION['username']) && isset($_SESSION['username']) && $_SESSION['update_flag']=="" && !empty($_SESSION['login_flag']) && isset($_SESSION['login_flag'])) {

				$item_code =  trim_data($_POST["item_code"]);
				$item_type =  trim_data($_POST["item_type"]);
				$item_name = trim_data($_POST["item_name"]);
				$item_application = trim_data($_POST["item_application"]);
				
				
				$sql = "SELECT COUNT(*) a FROM `item_master` WHERE `item_type` = '$item_type' AND `item_application` LIKE '%$item_application'";

				$result = mysqli_query($conn,$sql);
				if ($result) {
					if(mysqli_num_rows($result) > 0){
						while($data = mysqli_fetch_array($result,MYSQLI_NUM)){
							if ($data[0] > 0) {
								$_SESSION['update_flag']="wrongItem";
							 	header('Location:'.$l_dds_view_item.'');	

						 	} else{

								$sqlupdate="UPDATE `item_master` SET `item_name`='".$item_name."',`item_type`='".$item_type."',`item_application`='".$item_application."',`updated_by`='".$_SESSION['username']."',`date_time`=now() WHERE item_code='".$item_code."'";
				

								//$localIP = $_SERVER['HTTP_HOST'];//getHostByName(getHostName());
								$resultupdate = mysqli_query($conn,$sqlupdate);
								
								if($resultupdate){
										$description_concat="".$item_code.", ".$item_name.", ".$item_type.", ".$item_application."";
										$sql_log_update="insert into mm_log_master(description,department,table_name,operation,user_id) values ('".$description_concat."','DDS','ITEM_MASTER','UPDATE','".$_SESSION['username']."')";
										$result_log_insert=mysqli_query($conn,$sql_log_update);
										if($result_log_insert){
											$_SESSION['update_flag']="item";
											header('Location:'.$l_dds_view_item.'');
										}
								}
						 	}
						}
					
					}
				}


}
				function trim_data($data) {
					$data = trim($data);
					$data = strtoupper($data);
					return $data;
					}

?>
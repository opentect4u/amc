<?php
require '../../lib/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['username']!= "" && !empty($_SESSION['username']) && isset($_SESSION['username']) && $_SESSION['update_flag1']==""  && !empty($_SESSION['login_flag']) && isset($_SESSION['login_flag'])) {
				$serial_code=trim_data($_POST["serial_code"]);
				$serial_no=trim_data($_POST["serial_no"]);
				
				
				$saleupdate="UPDATE `serial_master` SET `serial_no`='".$serial_no."' WHERE serial_code = '".$serial_code."'";
				$resultupdate = mysqli_query($conn,$saleupdate);
				if($resultupdate){
					$sale_code_sql="select sale_code from serial_master where serial_code= '".$serial_code."'";
					$sale_code_result=mysqli_query($conn,$sale_code_sql);
					$sale_code=mysqli_fetch_array($sale_code_result,MYSQLI_NUM);
					$description_concat="".$serial_code.", ".$sale_code.", ".$serial_no."";
					$sql_log_insert="insert into mm_log_master(description,department,table_name,operation,user_id) values ('".$description_concat."','DDS','SERIAL_MASTER','UPDATE','".$_SESSION['username']."')";
					$result_log_insert=mysqli_query($conn,$sql_log_insert);
						if($result_log_insert){	
							//$localIP = $_SERVER['HTTP_HOST'];//getHostByName(getHostName());`serial_code`, `sale_code`, `serial_no`
							$_SESSION['update_flag1']="serial";
							header('location:'.$l_dds_view_sales.'');
						}
				}
			


}
				function trim_data($data) {
					$data = trim($data);
					$data = strtoupper($data);
					return $data;
					}

?>
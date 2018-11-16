<?php
require '../../lib/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['username']!= "" && !empty($_SESSION['username']) && isset($_SESSION['username']) && $_SESSION['update_flag']=="" && !empty($_SESSION['login_flag']) && isset($_SESSION['login_flag'])) {
				$sale_code=trim_data($_POST["sale_code"]);
				$item_code=trim_data($_POST["item_code"]);
				$client_name=trim_data($_POST["client_name"]);
				$item_qty=trim_data($_POST["item_qty"]);
				$warranty=trim_data($_POST["item_warr"]);
				$item_date=convert_date(trim_data($_POST["item_date"]));
				$invoice_no=trim_data($_POST["invoice_no"]);
				$remarks=trim_data($_POST["remarks"]);
				

				
				$saleupdate="UPDATE sales_master SET item_code='".$item_code."',client_code='".$client_name."',warranty_period='".$warranty."',purchase_date='".$item_date."',invoice_no='".$invoice_no."',remarks='".$remarks."',updated_by='".$_SESSION['username']."',date_time=now() WHERE sale_code='".$sale_code."'";
					
			//$localIP = $_SERVER['HTTP_HOST'];//getHostByName(getHostName());
			$resultupdate = mysqli_query($conn,$saleupdate);
			if($resultupdate){
				$description_concat="".$sale_code.", ".$item_code.", ".$client_name.", ".$item_qty.", ".$warranty.", ".$item_date.", ".$item_serial.", ".$invoice_no.", ".$remarks."";
							$sql_log_insert="insert into mm_log_master(description,department,table_name,operation,user_id) values ('".$description_concat."','DDS','SALES_MASTER','UPDATE','".$_SESSION['username']."')";
							$result_log_insert=mysqli_query($conn,$sql_log_insert);
							if($result_log_insert){
								$_SESSION['update_flag']="sale";
								header('Location:'.$l_dds_view_sales.'');
							}
			
			}

}
				function trim_data($data) {
					$data = trim($data);
					$data = strtoupper($data);
					return $data;
					}
                              function convert_date($data){
                                    $data=date('Y-m-d',strtotime($data));
                                        return $data;
}
?>
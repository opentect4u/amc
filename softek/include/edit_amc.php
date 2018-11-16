<?php
//include '../../lib/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['username']!= "" && !empty($_SESSION['username']) && isset($_SESSION['username']) && $_SESSION['update_flag']=="" && !empty($_SESSION['login_flag']) && isset($_SESSION['login_flag'])) {
		$amc_id =  trim_data($_POST["amc_id"]);
		$order_id =	 trim_data($_POST["order_id"]);
		$invoice_no = trim_data($_POST["invoice_no"]);
		$invoice_type = trim_data($_POST["invoice_type"]);
		$invoice_date = trim_data(convert_date2($_POST["invoice_date"]));
		$starting_date = trim_data(convert_date2($_POST["starting_date"]));
		$duration = trim_data($_POST["duration"]);
		$end_date = trim_data(convert_date2($_POST["end_date"]));
		$amount = trim_data($_POST["amount"]);
		$tax = trim_data($_POST["tax"]);
		$total_amount = trim_data($_POST["total_amount"]);
		

			if($_SESSION['client_id_flag']==""){
				$saleupdate="UPDATE `mm_amc_master` 
							SET 	`order_id`='".$order_id."',
									`invoice_no`='".$invoice_no."',
									`invoice_type`='".$invoice_type."',
									`invoice_date`='".$invoice_date."',
									`starting_date`='".$starting_date."',
									`duration`='".$duration."',
									`end_date`='".$end_date."',
									`amount`='".$amount."',
									`tax`='".$tax."',
									`total_amount`='".$total_amount."',
									 updated_by='".$_SESSION['username']."',
									 date_time=now() 
									 WHERE amc_id='".$amc_id."'";
					
			//$localIP = $_SERVER['HTTP_HOST'];//getHostByName(getHostName());
			$resultupdate = mysqli_query($conn,$saleupdate);
		}
			if($resultupdate){
				$description_concat="".$order_id.", ".$invoice_no.", ".$invoice_type.", ".$invoice_date.", ".$starting_date.", ".$duration.", ".$end_date."";
				$sql_log_insert="insert into mm_log_master(description,department,table_name,operation,user_id) values ('".$description_concat."','SOFTEK','MM_AMC_MASTER','UPDATE','".$_SESSION['username']."')";
							$result_log_insert=mysqli_query($conn,$sql_log_insert);
							if($result_log_insert){
								$_SESSION['update_flag']="amc";
								$URL = $l_softek_view_amc;
								echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
								
							}
			}
			

}
				/*function trim_data($data) {
					$data = trim($data);
					$data = strtoupper($data);
					return $data;
					}*/
                              function convert_date2($data){
                                    $data=date('Y-m-d',strtotime($data));
                                        return $data;
}
?>
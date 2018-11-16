<?php
require '../../lib/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['username']!= "" && !empty($_SESSION['username']) && isset($_SESSION['username']) && $_SESSION['update_flag']=="" && !empty($_SESSION['login_flag']) && isset($_SESSION['login_flag'])) {
		$order_id=trim_data($_POST["order_id"]);
		$client_id=trim_data($_POST["client_id"]);
		$order_value=trim_data($_POST["order_value"]);
		$payment=trim_data($_POST["payment"]);
		$remarks=trim_data($_POST["remarks"]);
		$exe_status=trim_data($_POST["exe_status"]);
		$order_date=convert_date(trim_data($_POST["order_date"]));
		
		$check_client_sql="SELECT CLIENT_ID FROM MM_CLIENT_MASTER WHERE CLIENT_ID=".$client_id."";
		$check_client_result=mysqli_query($conn,$check_client_sql);
			if(mysqli_num_rows($check_client_result) != 1){
				$_SESSION['client_id_flag']="true";//client not exists
				$URL = $l_softek_order;
				echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
			}

			if($_SESSION['client_id_flag']==""){
				$saleupdate="UPDATE mm_order_master SET client_id='".$client_id."',order_value='".$order_value."',payment='".$payment."',remarks='".$remarks."',exe_status='".$exe_status."',order_date='".$order_date."',updated_by='".$_SESSION['username']."',date_time=now() WHERE order_id='".$order_id."'";
					
			//$localIP = $_SERVER['HTTP_HOST'];//getHostByName(getHostName());
			$resultupdate = mysqli_query($conn,$saleupdate);
			if($resultupdate){
				$description_concat="".$order_id.", ".$client_id.", ".$order_value.", ".$payment.", ".$remarks.", ".$exe_status.", ".$order_date."";
				$sql_log_insert="insert into mm_log_master(description,department,table_name,operation,user_id) values ('".$description_concat."','SOFTEK','MM_ORDER_MASTER','UPDATE','".$_SESSION['username']."')";
							$result_log_insert=mysqli_query($conn,$sql_log_insert);
							if($result_log_insert){
								$_SESSION['update_flag']="order";
								header('Location:'.$l_softek_view_order.'');
							}
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
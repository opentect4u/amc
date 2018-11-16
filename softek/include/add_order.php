<?php 
// add order 
if($_SERVER["REQUEST_METHOD"]=="POST" && $_SESSION['username']!= "" && !empty($_SESSION['username']) && isset($_SESSION['username']) && $_SESSION['insert_flag']=="" && !empty($_SESSION['login_flag']) && isset($_SESSION['login_flag'])){
		$client_id=trim_data($_POST["client_id"]);
		$order_value=trim_data($_POST["order_value"]);
		$payment=trim_data($_POST["payment"]);
		$remarks=trim_data($_POST["remarks"]);
		$exe_status=trim_data($_POST["exe_status"]);
		$order_date=convert_date(trim_data($_POST["order_date"]));
		
		$check_client_sql="SELECT * FROM `mm_client_master` WHERE client_id = ".$client_id."";
		$check_client_result=mysqli_query($conn,$check_client_sql);
			if(mysqli_num_rows($check_client_result) < 1){
				$_SESSION['client_id_flag']="true";//client not exists
				$URL = $l_softek_order;
				echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
		       }
		
		if($client_id!="" && $order_date!="" && $_SESSION['client_id_flag']==""){
			$sql = "INSERT INTO `mm_order_master`(`client_id`, `order_value`, `payment`, `remarks`, `exe_status`, `order_date`, `updated_by`) VALUES ('".$client_id."','".$order_value."','".$payment."','".$remarks."','".$exe_status."','".$order_date."','".$_SESSION['username']."')";
			$result = mysqli_query($conn, $sql);
		}

	}
		
				if($result){
					$sql_log_max="select max(order_id) from mm_order_master where updated_by= '".$_SESSION['username']."'";
						$result_log_max=mysqli_query($conn,$sql_log_max);
						$result_log_max_data=mysqli_fetch_array($result_log_max,MYSQLI_NUM);
						$description_concat="".$result_log_max_data[0].", ".$client_id.", ".$order_value.", ".$payment.", ".$remarks.", ".$exe_status.", ".$order_date."";
						$sql_log_insert="insert into mm_log_master(description,department,table_name,operation,user_id) values ('".$description_concat."','SOFTEK','MM_ORDER_MASTER','INSERT','".$_SESSION['username']."')";
						$result_log_insert=mysqli_query($conn,$sql_log_insert);
						if($result_log_insert){
							$_SESSION['insert_flag']="order";
							$URL = $l_softek_order;
								echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
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
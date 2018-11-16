<?php
//add client
	if($_SERVER["REQUEST_METHOD"]=="POST" && $_SESSION['username']!= "" && !empty($_SESSION['username']) && isset($_SESSION['username']) && $_SESSION['insert_flag']=="" && !empty($_SESSION['login_flag']) && isset($_SESSION['login_flag'])){
		$customer_name=trim_data($_POST["customer_name"]);
		$customer_address=trim_data($_POST["customer_address"]);
		$customer_phone=trim_data($_POST["customer_phone"]);
		$customer_email=trim_data($_POST["customer_email"]);
	
		if($customer_name!="" && $customer_phone!=""){
			$sql = "INSERT INTO `client_master`(`client_name`, `client_address`, `client_phone`, `client_email`,`updated_by`) VALUES ('".$customer_name."','".$customer_address."','".$customer_phone."','".$customer_email."','".$_SESSION['username']."')";
			$result = mysqli_query($conn, $sql);
				if($result){
						$sql_log_max="select max(client_code) from client_master where updated_by= '".$_SESSION['username']."'";
						$result_log_max=mysqli_query($conn,$sql_log_max);
						$result_log_max_data=mysqli_fetch_array($result_log_max,MYSQLI_NUM);
						$description_concat="".$result_log_max_data[0].", ".$customer_name.", ".$customer_address.", ".$customer_phone.", ".$customer_email."";
						$sql_log_insert="insert into mm_log_master(description,department,table_name,operation,user_id) values ('".$description_concat."','DDS','CLIENT_MASTER','INSERT','".$_SESSION['username']."')";
						$result_log_insert=mysqli_query($conn,$sql_log_insert);
						if($result_log_insert){
							$_SESSION['insert_flag']="client";
							//header('location:'.$l_dds_client.'');
							$URL = $l_dds_client;
								echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
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
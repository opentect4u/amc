<?php
//add client
	if($_SERVER["REQUEST_METHOD"]=="POST" && $_SESSION['username']!= "" && !empty($_SESSION['username']) && isset($_SESSION['username']) && $_SESSION['insert_flag']=="" && !empty($_SESSION['login_flag']) && isset($_SESSION['login_flag'])){
		$client_name=trim_data($_POST["client_name"]);
		$client_type=trim_data($_POST["client_type"]);
		$contact_person=trim_data($_POST["contact_person"]);
		$designation=trim_data($_POST["designation"]);
		$client_phone=trim_data($_POST["client_phone"]);
		$sss_man=trim_data($_POST["sss_man"]);
		$state=trim_data($_POST["state"]);
		$district=trim_data($_POST["district"]);
		$client_address=trim_data($_POST["client_address"]);
		$pin_code=trim_data($_POST["pin_code"]);
		$client_email=trim_data($_POST["client_email"]);
		$remarks=trim_data($_POST["remarks"]);
		
	
		if($client_name!="" && $client_type!=""){
			$sql = "INSERT INTO `mm_client_master`(`client_name`, `client_type`, `contact_person`, `designation`, `contact_no`, `sss_man`, `state`, `district`, `address`, `pin_code`, `email`, `remarks`,`client_status`, `updated_by`) VALUES ('".$client_name."','".$client_type."','".$contact_person."','".$designation."','".$client_phone."','".$sss_man."','".$state."','".$district."','".$client_address."','".$pin_code."','".$client_email."','".$remarks."','ACTIVE','".$_SESSION['username']."')";
			$result = mysqli_query($conn, $sql);
		}
				if($result){
					$sql_log_max="select max(client_id) from mm_client_master where updated_by= '".$_SESSION['username']."'";
						$result_log_max=mysqli_query($conn,$sql_log_max);
						$result_log_max_data=mysqli_fetch_array($result_log_max,MYSQLI_NUM);
						$description_concat="".$result_log_max_data[0].", ".$client_name.", ".$client_type.", ".$contact_person.", ".$designation.", ".$client_phone.", ".$sss_man.", ".$state.", ".$district.", ".$client_address.", ".$pin_code.", ".$client_email.", ".$remarks."";
						$sql_log_insert="insert into mm_log_master(description,department,table_name,operation,user_id) values ('".$description_concat."','SOFTEK','MM_CLIENT_MASTER','INSERT','".$_SESSION['username']."')";

						$result_log_insert=mysqli_query($conn,$sql_log_insert);
						if($result_log_insert){
							$_SESSION['insert_flag']="client";
							$URL = $l_softek_client;
								echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
						}
					}
					
			}
	
    function trim_data($data) {
		$data = trim($data);
		$data = strtoupper($data);
		return $data;
	}
?>
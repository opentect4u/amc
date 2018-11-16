<?php
	require '../../lib/connection.php';

	if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['username']!= "" && !empty($_SESSION['username']) && isset($_SESSION['username']) && $_SESSION['update_flag']=="" && !empty($_SESSION['login_flag']) && isset($_SESSION['login_flag'])) {
		$client_id = trim_data($_POST["client_id"]);
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
		$client_status=trim_data($_POST["client_status"]);
				
		
		
		$sqlupdate="UPDATE `mm_client_master` SET `client_name`='".$client_name."',`client_type`='".$client_type."',`contact_person`='".$contact_person."',`designation`='".$designation."',`contact_no`='".$client_phone."',`sss_man`='".$sss_man."',`state`='".$state."',`district`='".$district."',`address`='".$client_address."',`pin_code`='".$pin_code."',`email`='".$client_email."',`remarks`='".$remarks."',`client_status`='".$client_status."',`updated_by`='".$_SESSION['username']."',`date_time`=now() WHERE `client_id`='".$client_id."'";
				
		$resultupdate = mysqli_query($conn,$sqlupdate);
		if($resultupdate){
			$description_concat="".$client_id.", ".$client_name.", ".$client_type.", ".$contact_person.", ".$designation.", ".$client_phone.", ".$sss_man.", ".$state.", ".$district.", ".$client_address.", ".$pin_code.", ".$client_email.", ".$remarks."";
			$sql_log_insert="insert into mm_log_master(description,department,table_name,operation,user_id) values ('".$description_concat."','SOFTEK','MM_CLIENT_MASTER','UPDATE','".$_SESSION['username']."')";
						$result_log_insert=mysqli_query($conn,$sql_log_insert);
						if($result_log_insert){
							$_SESSION['update_flag']="client";
							//$localIP = $_SERVER['HTTP_HOST'];
							
							if($_SESSION["view"]=="1"){
							$URL =$l_softek_view_client;
							echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
							}
							else if($_SESSION["view"]=="0"){
								$URL =$l_softek_view_all_client;
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
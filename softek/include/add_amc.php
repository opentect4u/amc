<?php
//add amc
	if($_SERVER["REQUEST_METHOD"]=="POST" && $_SESSION['username']!= "" && !empty($_SESSION['username']) && isset($_SESSION['username']) && $_SESSION['insert_flag']=="" && !empty($_SESSION['login_flag']) && isset($_SESSION['login_flag'])){
		
		$order_id=trim_data($_POST["order_id"]);
		$invoice_no=trim_data($_POST["invoice_no"]);
		$invoice_date=convert_date(trim_data($_POST["invoice_date"]));
		$starting_date=convert_date(trim_data($_POST["starting_date"]));
		$invoice_type=trim_data($_POST["invoice_type"]);
		$duration=trim_data($_POST["duration"]);
		$end_date=convert_date(trim_data($_POST["end_date"]));
		$amount=trim_data($_POST["amount"]);
		$tax=trim_data($_POST["tax"]);
		$total_amount=trim_data($_POST["total_amount"]);
		$paid_amount=trim_data($_POST["paid_amount"]);
		$due_amount=trim_data($_POST["due_amount"]);
		
		//code for serial//
		$_SESSION['rdata']="true";
		if($order_id!="" && $amount!="" && $end_date!="" && $duration!="" && $invoice_no!=""){
			$check_invoice_sql="select invoice_no from mm_amc_master where invoice_no = '".$invoice_no."'";
			$check_invoice_result=mysqli_query($conn,$check_invoice_sql);
			if(mysqli_num_rows($check_invoice_result) > 0){
				$_SESSION['invoice_flag']="true";//invoice number exists
				$URL = $l_softek_amc;
				echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
			}
		if($order_id!="" && $amount!="" && $end_date!="" && $duration!="" && $invoice_no!=""){
			$check_invoice_sql="select order_id from mm_order_master where order_id = '".$order_id."'";
			$check_invoice_result=mysqli_query($conn,$check_invoice_sql);
			if(mysqli_num_rows($check_invoice_result) != 1){
				$_SESSION['check_order_flag']="true";//order not exists
				$URL = $l_softek_amc;
				echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
			}
		}
					
		if($_SESSION['invoice_flag']=="" && $_SESSION['serial_flag']=="" && $_SESSION['check_order_flag']==""){
			$amc_sql="INSERT INTO `mm_amc_master`(`order_id`, `invoice_no`, `invoice_type`, `invoice_date`, `starting_date`, `duration`, `end_date`, `amount`, `tax`, `total_amount`, `updated_by`) VALUES ('".$order_id."','".$invoice_no."','".$invoice_type."','".$invoice_date."','".$starting_date."','".$duration."','".$end_date."','".$amount."','".$tax."','".$total_amount."','".$_SESSION['username']."')";
					$amc_result = mysqli_query($conn, $amc_sql);
			$amc_payment_sql="INSERT INTO `mm_payment_master`( `invoice_no`, `payment_date`, `total_amount`, `paid_amount`, `due_amount`, `updated_by`) VALUES ('".$invoice_no."','".$invoice_date."','".$total_amount."','".$paid_amount."','".$due_amount."','".$_SESSION['username']."')";
					$amc_payment_result = mysqli_query($conn, $amc_payment_sql);
		if($amc_payment_result){
			$sql_log_max="select max(amc_id) from mm_amc_master where updated_by= '".$_SESSION['username']."'";
			$result_log_max=mysqli_query($conn,$sql_log_max);
			$result_log_max_data=mysqli_fetch_array($result_log_max,MYSQLI_NUM);
			$description_concat="".$result_log_max_data[0].", ".$order_id.", ".$invoice_no.", ".$invoice_type.", ".$invoice_date.", ".$starting_date.", ".$duration.", ".$end_date.", ".$amount.", ".$tax.", ".$total_amount.", ".$paid_amount.", ".$due_amount."";
			$sql_log_insert="insert into mm_log_master(description,department,table_name,operation,user_id) values ('".$description_concat."','SOFTEK','MM_AMC_MASTER','INSERT','".$_SESSION['username']."')";
			$result_log_insert=mysqli_query($conn,$sql_log_insert);
			if($result_log_insert){
				$_SESSION['insert_flag']="amc";
				$URL = $l_softek_amc;
				echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
			}										
		}
	}
		else{
			$URL = $l_softek_amc;
			echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
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
<?php
require '../../lib/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['username']!= "" && !empty($_SESSION['username']) && isset($_SESSION['username'])) {
				$serial_code=trim_data($_POST["serial_code"]);
				$serial_no=trim_data($_POST["serial_no"]);
				$invoice_no=trim_data($_POST["invoice_no"]);
				$payment_date=convert_date(trim_data($_POST["payment_date"]));
				$total_amount=trim_data($_POST["total_amount"]);
				$paid_amount=trim_data($_POST["paid_amount"]);
				$due_amount=trim_data($_POST["due_amount"]);
				
				$amc_payment_sql="INSERT INTO `mm_payment_master`( `invoice_no`, `payment_date`, `total_amount`, `paid_amount`, `due_amount`, `updated_by`) VALUES ('".$invoice_no."','".$payment_date."','".$total_amount."','".$paid_amount."','".$due_amount."','".$_SESSION['username']."')";
				$amc_payment_result = mysqli_query($conn, $amc_payment_sql);

				if($amc_payment_result){
			$sql_log_max="select max(payment_id) from mm_payment_master where updated_by= '".$_SESSION['username']."' and invoice_no = '".$invoice_no."'";
			
			$result_log_max=mysqli_query($conn,$sql_log_max);
			$result_log_max_data=mysqli_fetch_array($result_log_max,MYSQLI_NUM);
			$description_concat="".$result_log_max_data[0].", ".$invoice_no.", ".$payment_date.", ".$total_amount.", ".$paid_amount.", ".$due_amount."";
			$sql_log_insert="insert into mm_log_master(description,department,table_name,operation,user_id) values ('".$description_concat."','SOFTEK','MM_PAYMENT_MASTER','INSERT','".$_SESSION['username']."')";
			$result_log_insert=mysqli_query($conn,$sql_log_insert);
			if($result_log_insert){
				$_SESSION['insert_flag']="payment";
				$URL = $l_softek_view_amc;
				echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
			}										
		}			
		else{
			$URL = $l_softek_view_amc;
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
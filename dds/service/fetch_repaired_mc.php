<?
	$sql = "SELECT invoice_no FROM td_reprd_mc_out WHERE approval_status IS NULL";
	$invoice_no = mysqli_query($conn, $sql);
?>
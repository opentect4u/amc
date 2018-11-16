<?
	$sql = "SELECT invoice_no, mc_type FROM td_new_machine_out WHERE approval_status <> 1";
	$invoice_no = mysqli_query($conn, $sql);

	?>
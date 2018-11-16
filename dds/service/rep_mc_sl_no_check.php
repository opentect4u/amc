<?php
	require '../../lib/connection.php';
	
	$tkt_no = $_GET['tkt_no'];
	
	$serial_no = [];

	$sql = "SELECT mc_st_no FROM td_mc WHERE tkt_no = $tkt_no AND status = 'R' AND invoice_no IS NULL";
	$result = mysqli_query($conn, $sql);

	while ($dta_item = mysqli_fetch_assoc($result)) {
		array_push($serial_no, $dta_item['mc_st_no']);
	}

	//$_SESSION['tkt_no'] = $tkt_no;
	echo json_encode($serial_no);


	
?>
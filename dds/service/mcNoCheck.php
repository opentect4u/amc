<?php
	require '../../lib/connection.php';

	$mc_type = $_GET['mc_type'];
	$batch_no = [];
	$serial_no = [];

	$sql = "SELECT batch_no FROM td_new_machine WHERE mc_type = '$mc_type' AND approval_status = 1";
	$result = mysqli_query($conn, $sql);

	while ($dta_item = mysqli_fetch_assoc($result)) {
		array_push($batch_no, $dta_item['batch_no']);
	}

	for ($i=0; $i < sizeof($batch_no); $i++) {

		$sql = "SELECT mc_no FROM td_mc_sl WHERE batch_no = $batch_no[$i] AND invoice_no IS NULL";
		$result = mysqli_query($conn, $sql);

		while ($dta_item = mysqli_fetch_assoc($result)) {
			array_push($serial_no, $dta_item['mc_no']);
		}
	}

	$_SESSION['batch_no'] = $batch_no;
	echo json_encode($serial_no);

?>

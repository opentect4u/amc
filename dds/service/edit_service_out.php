<?php
	
	require '../../lib/connection.php';

	if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SESSION['username']) {

		$serial_no = $_GET["sl_no"];
		$mc_no = $_GET["mc_no"];
		$prob = $_GET["prob"];
		$qty = $_GET['qty'];
		$srv_by = $_GET['sev'];

		if (isset($prob) && !isset($qty) && !isset($srv_by)) {
			$sql = "UPDATE td_service_out SET prob = '$prob'
									  WHERE mc_sl_no = '$mc_no'";


			mysqli_query($conn, $sql);
		}
		elseif (!isset($prob) && isset($qty) && !isset($srv_by)) {
			$sql = "UPDATE td_service_out SET qty = $qty
									  WHERE mc_sl_no = '$mc_no'
									  AND sl_no = $serial_no";


			mysqli_query($conn, $sql);
		}

		elseif (!isset($prob) && !isset($qty) && isset($srv_by)) {
			$sql = "UPDATE td_service_out SET serv_by = '$srv_by'
									  WHERE mc_sl_no = '$mc_no'";


			mysqli_query($conn, $sql);
		}

		

		echo $mc_no;
	}
	

?>
<?php
	require '../../lib/connection.php';
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$sys_date = date('Y-m-d');
		$tkt_no = $_POST['tkt_no'];
		$out_dt = $_POST['out_dt'];
		$mc_qty = $_POST['mc_qty'];
		$serviceBy = $_POST['serviceBy'];
		$comp_no = implode(',', $_POST['comp_no']);
		$comp_no = explode(',', $comp_no);
		$qty = implode(',', $_POST['qty']);
		$qty = explode(',', $qty);
		$out_no = $_POST['out_no'];
		$modified_by = $_SESSION['username'];
		$count = 0;

		$sql = "DELETE FROM td_service WHERE out_no = $out_no";
		mysqli_query($conn, $sql);

		for ($i = 0; $i < sizeof($comp_no); $i++) {
			$sql = "INSERT INTO td_service (out_dt, out_no, tkt_no, cmp_no, cmp_qty) VALUES('$out_dt', $out_no, $tkt_no, $comp_no[$i], $qty[$i])";

			echo $sql.'<br>';
			mysqli_query($conn, $sql);
			$count++;
		}

		$sql = "UPDATE td_stock_out SET mc_qty = $mc_qty, total_cmp = $count, service_by = '$serviceBy', modified_by = '$modified_by', modified_dt = '$sys_date' WHERE out_no = $out_no";

		mysqli_query($conn, $sql);

		$_SESSION['update_flag'] = "item";

		header('Location: view_service_out.php');
	}

?>

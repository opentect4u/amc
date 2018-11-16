<?php
	require '../../lib/connection.php';

	$comp_no = $_GET['comp_no'];
	$servArea = $_GET['serv_area'];
	$mm_parts = "SELECT parts_desc FROM mm_parts WHERE sl_no = $comp_no";
	$parts_result = mysqli_query($conn, $mm_parts);
	$stk_quantity = 0;
	$result = mysqli_fetch_assoc($parts_result);
	$comp_name = $result['parts_desc'];

	//echo $parts_desc;

	$sql = "SELECT a.stk_quantity FROM (SELECT comp_name, stk_quantity, MAX(balance_dt) balance_dt, MAX(trf_no) FROM `gm_stock_balance` WHERE comp_name = '$comp_name' AND serv_area = '$servArea' GROUP BY comp_name, stk_quantity
			ORDER BY balance_dt DESC LIMIT 1) a";

	$result = mysqli_query($conn, $sql);

	if ($result) {
		$data = mysqli_fetch_assoc($result);
		$stk_quantity = $data['stk_quantity'];
	}

	echo $stk_quantity;
?>

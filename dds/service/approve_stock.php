<?php
require '../../lib/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SESSION['username']) {

	$bill_no = $_GET['item_code'];
	$approved_by = $_SESSION['username'];
	$approved_dt = date('Y-m-d');

	$sql = "SELECT in_no, comp_sl_no, comp_qty, serv_area FROM `td_stock_in` WHERE bill_no = '$bill_no' ORDER BY comp_sl_no";
	$result = mysqli_query($conn,$sql);

	while ($itemData = mysqli_fetch_assoc($result)) {
	 $stk_quantity = 0;
	 $trf_no = 0;
	 require 'fetch_parts.php';
	  while($item_data1 = mysqli_fetch_array($parts_result, MYSQLI_NUM)) {
		if ($item_data1[0] == $itemData['comp_sl_no']) {
			$servArea = $itemData["serv_area"];
			$inNo = $itemData["in_no"];
			$comp_qty = $itemData["comp_qty"];
			unset($sql);

			$sql = "SELECT stk_quantity,
						   trf_no FROM gm_stock_balance
						          WHERE comp_name = '$item_data1[1]' 
						          AND serv_area = '$servArea'
						          AND balance_dt = (SELECT MAX(balance_dt) 
  								  										  FROM gm_stock_balance 
  								  										  WHERE comp_name = '$item_data1[1]') 
						          AND trf_no = (SELECT max(trf_no)
						          								  FROM gm_stock_balance 
						          								  WHERE comp_name = '$item_data1[1]' 
						          								  AND serv_area = '$servArea' 
						          								  AND balance_dt = (SELECT MAX(balance_dt) 
						          								  										  FROM gm_stock_balance 
						          								  										  WHERE comp_name = '$item_data1[1]'))";
			$result1 = mysqli_query($conn, $sql);

			if($result1) {
				while ($stkCount = mysqli_fetch_assoc($result1)) {
			    	$stk_quantity = $stkCount["stk_quantity"];
			    	$trf_no = $stkCount["trf_no"];
		    	}
			}
			

			if($stk_quantity <> 0) {
	   		  $count =  $stk_quantity + $itemData["comp_qty"];
	   		  $trf_no++;
		      $sql2 = "INSERT INTO gm_stock_balance VALUES ('$approved_dt', '$bill_no', $trf_no, '$item_data1[1]', '$servArea', 'I', $comp_qty, $count)";
		      $result2 = mysqli_query($conn, $sql2);
		    }
	        else {
	        	$trf_no++;
		    	$sql3 = "INSERT INTO gm_stock_balance VALUES ('$approved_dt', '$bill_no', $trf_no, '$item_data1[1]', '$servArea', 'I', $comp_qty, $comp_qty)";
		    	$result3 = mysqli_query($conn, $sql3);
	        }
		}

	  }
			unset($sql);
			$sql = "UPDATE td_stock_in SET approval_status = 1,
									 approved_dt = '$approved_dt' WHERE bill_no = '$bill_no'
										AND in_no = $inNo";
			mysqli_query($conn, $sql);
	}
	$_SESSION['update_flag'] = "approved";
	header("Location: view_stock.php");
}

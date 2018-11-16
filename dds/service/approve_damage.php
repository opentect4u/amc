<?php
require '../../lib/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SESSION['username']) {

	$memoNo = $_GET['item_code'];
	$approved_by = $_SESSION['username'];
	$approved_dt = date('Y-m-d');

	$sql = "SELECT comp_sl_no, 
				   comp_qty, 
				   center_name FROM `td_damage_out` 
							   WHERE memo_no = '$memoNo' 
							   ORDER BY comp_sl_no";
	$result = mysqli_query($conn, $sql);
	while ($itemData = mysqli_fetch_assoc($result)) {
	 $stk_quantity = 0;
	 $trf_no = 0;
	 require 'fetch_parts.php';
	  while($item_data1 = mysqli_fetch_array($parts_result, MYSQLI_NUM)) {
		if ($item_data1[0] == $itemData['comp_sl_no']) {
			$servArea = $itemData["center_name"];
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
			echo $sql.'<br>';
			if($result1) {
				while ($stkCount = mysqli_fetch_assoc($result1)) {
			    	$stk_quantity = $stkCount["stk_quantity"];
			    	$trf_no = $stkCount["trf_no"];
		    	}
			}
			

			if($stk_quantity >= $comp_qty) {
	   		  $count =  $stk_quantity - $itemData["comp_qty"];
	   		  $trf_no++;
		      $sql2 = "INSERT INTO gm_stock_balance VALUES ('$approved_dt',
		      												'$memoNo', 
		      												$trf_no, 
		      												'$item_data1[1]', 
		      												'$servArea', 
		      												'D', 
		      												$comp_qty, 
		      												$count)";
		      echo $sql2.'<br>';
		      $result2 = mysqli_query($conn, $sql2);

		      unset($sql);
			  $sql = "UPDATE td_damage_out SET approval_status = 1,
										 	   approved_by = '$approved_by',
										 	   approved_dt = '$approved_dt' WHERE memo_no = '$memoNo'
																			AND comp_sl_no = ".$itemData['comp_sl_no']."";
				echo $sql.'<br>';
			  mysqli_query($conn, $sql);
		    }
		}

	  }
			
	}
	$_SESSION['update_flag'] = "approved";
	header("Location: view_damage_stock.php");
}


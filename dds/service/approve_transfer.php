<?php
require '../../lib/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SESSION['username']) {

	$trfNo = $_GET['item_code'];
	$approved_by = $_SESSION['username'];
	$approved_dt = date('Y-m-d');

	$sql = "SELECT comp_sl_no, 
				   comp_qty, 
				   from_place FROM `td_transfer` 
							  WHERE trf_no = '$trfNo'
							  AND 	approval_status IS NULL 
							  ORDER BY comp_sl_no";
							  
	$result = mysqli_query($conn, $sql);

	while ($itemData = mysqli_fetch_assoc($result)) {
	 $stk_quantity = 0;
	 $trf_no = 0;
	 require 'fetch_parts.php';
	  while($item_data1 = mysqli_fetch_array($parts_result, MYSQLI_NUM)) {

		if ($item_data1[0] == $itemData['comp_sl_no']) {
			$servArea = $itemData["from_place"];
			$comp_qty = $itemData["comp_qty"];
			unset($sql);

			$sql = "SELECT a.stk_quantity,
						   a.trf_no 
									FROM (SELECT comp_name, 
												 stk_quantity, 
												 MAX(balance_dt) balance_dt,
												 MAX(trf_no) trf_no
																			FROM `gm_stock_balance` 
																			WHERE comp_name = '$item_data1[1]'
																			AND serv_area = '$servArea' 
																			GROUP BY comp_name, stk_quantity
																			ORDER BY balance_dt DESC, trf_no DESC LIMIT 1) a";
			
			$result1 = mysqli_query($conn, $sql);
			
			if($result1) {

				while ($stkCount = mysqli_fetch_assoc($result1)) {

					$stk_quantity = $stkCount["stk_quantity"];
					
					$trf_no = $stkCount["trf_no"];
					
		    	}
			}
			
			
			if($stk_quantity >= $comp_qty) {
	   		  $count =  $stk_quantity - $itemData["comp_qty"];
	   		  ++$trf_no;
		      $sql2 = "INSERT INTO gm_stock_balance VALUES ('$approved_dt',
		      												'$trfNo', 
		      												$trf_no, 
		      												'$item_data1[1]', 
		      												'$servArea', 
		      												'O', 
		      												$comp_qty, 
		      												$count)";
		      
		      $result2 = mysqli_query($conn, $sql2);

		      unset($sql);
			  $sql = "UPDATE td_transfer SET approval_status = 1,
										 	   approved_by = '$approved_by',
										 	   approved_dt = '$approved_dt' WHERE trf_no = '$trfNo'
																			AND comp_sl_no = '".$itemData['comp_sl_no']."'";
			  
			  mysqli_query($conn, $sql);
			  
			}
			
		}

	  }
			
	}
	$_SESSION['update_flag'] = "approved";
	header("Location: view_transfer.php");
}


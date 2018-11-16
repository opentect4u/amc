<?php
	require '../../lib/connection.php';


		$approved_dt = date('Y-m-d');
		$item_code = $_GET['item_code'];
		$serv_area = $_GET['serv_area'];
		$mc_type = $_GET['mc_type'];
		$approved_by = $_SESSION['username'];
		$comp_no = [];
		$qty = [];
		$counter = 0;
		$servArea = '';

		$sqlMc = "SELECT DISTINCT mc_sl_no FROM td_service_out
										   WHERE tkt_no = $item_code
										   AND approval_status IS NULL";

		$mc_result = mysqli_query($conn, $sqlMc);

		$totMc = "SELECT COUNT(DISTINCT mc_sl_no) total_mc FROM td_service_out
														   WHERE tkt_no = $item_code
														   AND approval_status IS NULL";

		$mc_result_tot = mysqli_query($conn, $totMc);

		$tot = mysqli_fetch_assoc($mc_result_tot);

		$tot_data = $tot['total_mc'];


		$sql = "SELECT comp_sl_no,serv_area, sum(qty) qty FROM td_service_out
															WHERE tkt_no = $item_code
															AND approval_status IS NULL
													 		GROUP BY comp_sl_no, serv_area";
		//echo $sql.'<br>';								 		  
		$result = mysqli_query($conn, $sql);


// Stock Maintainence Of Parts

		while ($itemData = mysqli_fetch_assoc($result)) {

		 $stk_quantity = 0;
		 $trf_no = 0;
		 require 'fetch_parts.php';
		  while($item_data1 = mysqli_fetch_array($parts_result, MYSQLI_NUM)) {
			if ($item_data1[0] == $itemData['comp_sl_no']) {
				$servArea = $itemData["serv_area"];
				$comp_qty = $itemData["qty"];
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
				//echo $sql.'<br>';
				if($result1) {
					while ($stkCount = mysqli_fetch_assoc($result1)) {
				    	$stk_quantity = $stkCount["stk_quantity"];
				    	$trf_no = $stkCount["trf_no"];
			    	}
				}
				

				if($stk_quantity >= $comp_qty) {
		   		  $count =  $stk_quantity - $comp_qty;
		   		  $trf_no++;
			      $sql2 = "INSERT INTO gm_stock_balance VALUES ('$approved_dt',
			      												'$item_code', 
			      												 $trf_no, 
			      												'$item_data1[1]', 
			      												'$servArea', 
			      												'R', 
			      												$comp_qty, 
			      												$count)";
			      //echo $sql2.'<br>';
			      $result2 = mysqli_query($conn, $sql2);

			      
			    }
			}

		  }
		}

	  	while ($itemData = mysqli_fetch_assoc($mc_result)) {
	  	  unset($sql);
	  	  $counter++;
		  $sql = "UPDATE td_service_out SET approval_status = 1,
		  									approved_by = '$approved_by',
		  									approved_dt = '$approved_dt'
		  																 WHERE tkt_no = $item_code
		  																 AND mc_sl_no = '".$itemData['mc_sl_no']."'";

		  mysqli_query($conn, $sql);

		  unset($sql);
	  	  $sql = "UPDATE td_mc SET out_dt = '$approved_dt' WHERE tkt_no = $item_code
	  	 												   AND mc_st_no = '".$itemData['mc_sl_no']."'";

		  //echo $sql.'<br>';
		  mysqli_query($conn, $sql);
	  	}  
	  	  
	  	
// Stock Maintainence Of Machine
	  	unset($sql);

		$sql = "select max(balance_dt) balance_dt
				from   gm_mc_stock
				where  mc_type = '$mc_type'
				and    serv_area = '$serv_area'";
		$result = mysqli_query($conn, $sql);
//echo $sql."<br>";
		$date_data = mysqli_fetch_assoc($result);
		$date = $date_data['balance_dt'];
		unset($sql);
		unset($result);
		unset($data);

		$sql = "select max(sl_no) sl_no
				from   gm_mc_stock
				where  mc_type = '$mc_type'
				and    serv_area = '$serv_area'
				and    balance_dt = '$date'";

		$result = mysqli_query($conn, $sql);

		$sl_data = mysqli_fetch_assoc($result);

		$sl_no = $sl_data['sl_no'];

		
		unset($sql);
		unset($result);
		//unset($data);
		
		$sql = "select total_stock
				from   gm_mc_stock
				where  mc_type = '$mc_type'
				and    serv_area = '$serv_area'
				and    balance_dt = '$date'
				and    sl_no= $sl_no";

		
		$result = mysqli_query($conn, $sql);

		$data1 = mysqli_fetch_assoc($result);		
		
		$total_stock = $data1['total_stock'];
		
		var_dump($total_stock);

		if($total_stock > 0) {

			$count = $total_stock - $tot_data;
		    $sql = "INSERT INTO gm_mc_stock (`balance_dt`,
		    								 `tkt_no`, 
		    								 `qty`, 
		    								 `serv_area`, 
		    								 `status`, 
		    								 `mc_type`, 
		    								 `total_stock`) VALUES ('$approved_dt',
						    										'$item_code',
						    										$counter,
						    										'$serv_area',
						    										'RO',
						    										'$mc_type',
						    										$count)";
		    /*echo $count;
		    echo $sql;*/

		    
		    $result = mysqli_query($conn, $sql);
	    }


	    $_SESSION['update_flag'] = "approved";
		header("Location: view_service_out.php");
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	require '../../lib/connection.php';

	$tkt_no = $_GET['item_code'];
	$serv_area = $_SESSION['serv_area'];
	$machine_qty = $_SESSION['mc_qty'];
	$approved_by = $_SESSION['username'];
	$mc_type = $_SESSION['mc_type'];
	$qty = 0;
	$date = date('Y-m-d');


	$sql = "SELECT total_stock FROM gm_mc_stock
							   WHERE balance_dt = (SELECT MAX(balance_dt) FROM gm_mc_stock 
							   											  WHERE mc_type = '$mc_type'
							   											  AND serv_area = '$serv_area')
							   AND sl_no = (SELECT MAX(sl_no) FROM gm_mc_stock 
				   											  WHERE mc_type = '$mc_type'
							   								  AND serv_area = '$serv_area'
				   											  AND balance_dt = (SELECT MAX(balance_dt) FROM gm_mc_stock 
							   											  							   WHERE serv_area = '$serv_area'))							   											  
							   AND mc_type = '$mc_type'
							   AND serv_area = '$serv_area'";

	$result = mysqli_query($conn, $sql);

	
	$data = mysqli_fetch_assoc($result);
	$total_stock = $data['total_stock'];


    if($total_stock > 0) {

		$count = $total_stock + $machine_qty;
	    $sql = "INSERT INTO gm_mc_stock (`balance_dt`,
	    								 `tkt_no`, 
	    								 `qty`, 
	    								 `serv_area`, 
	    								 `status`,
	    								 `mc_type`, 
	    								 `total_stock`) VALUES ('$date',
					    										'$tkt_no',
					    										$machine_qty,
					    										'$serv_area',
					    										'R',
					    										'$mc_type',
					    										$count)";
	    echo $count;
	    echo $sql;

	        $result = mysqli_query($conn,$sql);
    }

    else {
    	$sql = "INSERT INTO gm_mc_stock (`balance_dt`,
    									 `tkt_no`, 
    									 `qty`, 
    									 `serv_area`, 
    									 `status`, 
    									 `mc_type`,
    									 `total_stock`) VALUES ('$date',
				    											'$tkt_no',
				    											$machine_qty,
				    											'$serv_area',
				    											'R',
				    											'$mc_type',
				    											$machine_qty)";

    	$result = mysqli_query($conn,$sql);
    }

		$sql = "UPDATE td_mc SET status = 'R' WHERE tkt_no = $tkt_no";

		$result = mysqli_query($conn, $sql);

		$sql = "UPDATE td_customer_tkt SET approve_flag = 1, approved_by = '$approved_by', approved_dt = '$date' WHERE tkt_no = $tkt_no";

		$result = mysqli_query($conn, $sql);

		if ($result) {
		 	$_SESSION['update_flag'] = "approved";
		 	header("Location: view_service.php");
		 }

	}

?>

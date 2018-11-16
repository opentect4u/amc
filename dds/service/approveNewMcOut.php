<?php

require '../../lib/connection.php';


	$entry_date = date('Y-m-d',strtotime($_SESSION['entry_date']));
	$invoice_no = $_GET['item_code'];
	$mc_type = $_GET['mc_type'];
	$qty = $_GET['mc_qty'];
	$approved_by = $_SESSION['username'];
	$approved_dt = date('Y-m-d');
	$count = 0;
	

	$sql = "SELECT total_stock FROM gm_mc_stock
							   WHERE balance_dt = (SELECT MAX(balance_dt) FROM gm_mc_stock 
							   											  WHERE serv_area = '$serv_area')
							   AND sl_no = (SELECT MAX(sl_no) FROM gm_mc_stock 
				   											  WHERE serv_area = '$serv_area'
				   											  AND balance_dt = (SELECT MAX(balance_dt) FROM gm_mc_stock 
							   											  							   WHERE serv_area = '$serv_area'))							   											  
							   AND serv_area = '$serv_area'";

	$result = mysqli_query($conn, $sql);

	
	$data = mysqli_fetch_assoc($result);
	$total_stock = $data['total_stock'];
	
// "ON" => Out New

	if($total_stock > 0) {

		$count = $total_stock - $qty;
		
	    $sql = "INSERT INTO gm_mc_stock VALUES ('$approved_dt', '$invoice_no', $qty, 'ON', '$mc_type', $count)";
	    
	    $result = mysqli_query($conn, $sql);
    }
    else{
    	$sql = "INSERT INTO gm_mc_stock VALUES ('$approved_dt', '$invoice_no', $qty, 'ON', '$mc_type', $qty)";
    
    $result = mysqli_query($conn,$sql);
    }


	$sql = "UPDATE td_mc_sl SET status = 'ON', out_date = '$approved_dt' WHERE invoice_no = '$invoice_no'";
	echo $sql.'<br>';
	$result = mysqli_query($conn, $sql);   


	$sql = "UPDATE td_new_machine_out SET approval_status = 1, approved_by = '$approved_by', approved_dt = '$approved_dt' WHERE invoice_no = '$invoice_no'";
	echo $sql.'<br>';
	$result = mysqli_query($conn, $sql);   

	$_SESSION['update_flag'] = "approved";
	header("Location: view_mc_out.php");

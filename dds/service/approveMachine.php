<?php

require '../../lib/connection.php';


	$entry_date = date('Y-m-d',strtotime($_SESSION['entry_date']));
	$batch_no = $_SESSION['batch_no'];
	$mc_type = $_SESSION['mc_type'];
	$qty = $_SESSION['qty'];
	$serv_area = $_SESSION['serv_area'];
	$approved_by = $_SESSION['username'];
	$approved_dt = date('Y-m-d');
	$count = 0;
	
	unset($_SESSION['batch_no']);
	unset($_SESSION['mc_type']);
	unset($_SESSION['qty']);
	unset($_SESSION['serv_area']);

    $sql = "SELECT total_stock FROM gm_mc_stock
							   WHERE balance_dt = (SELECT MAX(balance_dt) FROM gm_mc_stock 
							   											  WHERE mc_type = '$mc_type'
							   											  AND serv_area = '$serv_area')
							   AND sl_no = (SELECT MAX(sl_no) FROM gm_mc_stock 
				   											  WHERE mc_type = '$mc_type'
							   								  AND serv_area = '$serv_area'
				   											  AND balance_dt = (SELECT MAX(balance_dt) FROM gm_mc_stock 
							   											  							   WHERE mc_type = '$mc_type'
							   											  							   AND serv_area = '$serv_area'))							   											  
							   AND mc_type = '$mc_type'
							   AND serv_area = '$serv_area'";
	
	$result = mysqli_query($conn, $sql);

	$data = mysqli_fetch_assoc($result);
	$total_stock = $data['total_stock'];
	

    if($total_stock > 0) {

    		$count = $total_stock + $qty;
    		
		    $sql = "INSERT INTO gm_mc_stock (balance_dt,
	    									 tkt_no,
	    									 qty,
	    									 serv_area,
	    									 status,
	    									 mc_type,
	    									 total_stock ) VALUES ('$approved_dt', '$batch_no', $qty, '$serv_area', 'N', '$mc_type', $count)";

		      	        
		        $result = mysqli_query($conn,$sql);
		    }
		        
		    else {
		    	$sql = "INSERT INTO gm_mc_stock (balance_dt,
		    									 tkt_no,
		    									 qty,
		    									 serv_area,
		    									 status,
		    									 mc_type,
		    									 total_stock ) VALUES ('$approved_dt', '$batch_no', $qty, '$serv_area', 'N', '$mc_type', $qty)";
		    		        
		    	$result = mysqli_query($conn,$sql);
		   } 
	$sql = "UPDATE td_new_machine set approval_status = 1, approved_by = '$approved_by', approved_dt = '$approved_dt' where batch_no = $batch_no";

	$result = mysqli_query($conn,$sql);   

	$_SESSION['update_flag'] = "approved";
	header("Location: view_machine.php");

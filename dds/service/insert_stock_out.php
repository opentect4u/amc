<?php
	require '../../lib/connection.php';
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['username']) {

		$sys_date = date('Y-m-d');
		$mc_sl_no = $_POST['mc_sl_no'];
		$center_name = $_POST['center_name'];
		$prob = $_POST['prob'];
		$comp_no = $_POST['comp_no'];
		$qty = $_POST['qty'];
		$tkt_no = $_POST['tkt_no'];
		$serviceBy = $_POST['serviceBy'];
		$created_by = $_SESSION['username'];
		$mc_type = $_POST['mc_type'];
		
		$count = 0;

		for ($i = 0; $i < sizeof($mc_sl_no); $i++) { 

			for ($j = 0; $j < sizeof($comp_no[$i]); $j++) { 
				$count++;
				$sql = "INSERT INTO td_service_out ( out_dt,
													 tkt_no,
													 sl_no,
													 mc_sl_no,
													 prob,
													 comp_sl_no,
													 qty,
													 mc_type,
													 serv_by,
													 serv_area,
													 created_by,
													 created_dt ) VALUES ( '$sys_date',
													 						$tkt_no,
													 					   $count,
													 					   '$mc_sl_no[$i]',
													 					   '$prob[$i]',
													 					   ".$comp_no[$i][$j].",
													 					   ".$qty[$i][$j].",
													 					   '$mc_type',
													 					   '$serviceBy[$i]',
													 					   '$center_name',
													 						'$created_by',
													 						'$sys_date' )";

				mysqli_query($conn, $sql);													 						 
			}

			
		}

		//var_dump($prob);
		
		$_SESSION['update_flag'] = "insert";
		header("Location: service_out_entry.php");
	}
?>

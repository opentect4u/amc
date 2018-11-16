<?php


	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		require '../../lib/connection.php';

		$tkt_no = $_POST['tkt_no'];
		$mc_type = $_POST['mc_type'];
		$mc_qty = $_POST['mc_qty'];
		$sub_by = $_POST['sub_by'];
		$ph_no = $_POST['ph_no'];
		$servCenName = $_POST['servCenName'];
		$rcv_by = $_POST['rcv_by'];
		$count = 0;
		$stk_no = implode('*/*',$_POST['stk_no']);
		$prb = implode('*/*',$_POST['prb']);
		$warranty = implode('*/*',$_POST['warranty']);


		$stk_no = explode('*/*', $stk_no);
		$prb = explode('*/*', $prb);
    	$warranty = explode('*/*', $warranty);



			$sql1 = "DELETE FROM td_mc WHERE tkt_no = $tkt_no";

	    	mysqli_query($conn, $sql1);

	    	for ($i=0; $i < sizeof($stk_no); $i++) {
	    		if($stk_no[$i] == ''){
					continue;
				}
				else{
					$sql = "INSERT INTO td_mc (tkt_no, mc_st_no, mc_prob, warr_flg) VALUES ('$tkt_no','$stk_no[$i]','$prb[$i]','$warranty[$i]')";

	        	mysqli_query($conn, $sql);
	        	echo $sql;
	        	$count += 1;
				}

	         }

		$sql = "UPDATE td_customer_tkt SET mc_type = '$mc_type',
										   mc_qty = $count,
										   submit_by = '$sub_by', 
										   sub_phn_no = '$ph_no',
										   serv_area = '$servCenName',
										   rcv_by = '$rcv_by'  WHERE tkt_no = $tkt_no";

		$result = mysqli_query($conn, $sql);

         $_SESSION['update_flag'] = "item";
         header("Location: view_service.php");

	}
	else{
		echo '<script type="text/javascript">alert("Opps Something went Wrong! Failed to Insert");</script>';
		header("Location: add_service.php");
	}

?>

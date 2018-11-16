<?
	 require '../../lib/connection.php';
	$tkt_no = $_POST['tkt_no'];
	$invoice_no = $_POST['invoice_no'];
	$mc_type = $_POST['mc_type'];
	$mc_qty = $_POST['mc_qty'];
	$modified_by = $_SESSION['username'];
	$sys_date = date('Y-m-d');
	$mc_no = implode(',', $_POST['mc_no']);
	$mc_no = explode(',', $mc_no);


	for ($j=0; $j < sizeof($mc_no); $j++) { 
			
			$sql = "UPDATE td_mc SET invoice_no = '$invoice_no' WHERE tkt_no = $tkt_no AND mc_st_no = '$mc_no[$j]'";
			
			mysqli_query($conn, $sql);
			echo $sql.'<br>';
			$count = $j+1;
		}

	$sql = "UPDATE td_reprd_mc_out SET qty = $count, modified_by = '$modified_by', modified_dt = '$sys_date' WHERE invoice_no = '$invoice_no'";	
	echo $sql.'<br>';
	mysqli_query($conn, $sql);
	$_SESSION['update_flag'] = "item";
	header("Location: view_rep_mc_out.php");
?>
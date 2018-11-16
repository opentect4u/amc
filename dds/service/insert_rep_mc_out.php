<?

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['username']) {
		require '../../lib/connection.php';

		$tkt_no = $_POST['tkt_no'];
		$mc_type = $_POST['mc_type'];
		$invoice_no = $_POST['invoice_no'];
		$machine_qty = $_POST['mc_qty'];
		$created_by = $_SESSION['username'];
		$client_name = $_POST['c_name'];
		$mc_no = implode(',', $_POST['mc_no']);
		$mc_no = explode(',', $mc_no);
		$date = date('Y-m-d');

		
		$sql = "INSERT INTO td_reprd_mc_out (out_dt, tkt_no, invoice_no, mc_type, qty, client_name, created_by, created_dt) VALUES('$date', $tkt_no, '$invoice_no', '$mc_type', $machine_qty, '$client_name', '$created_by', '$date')";
		
	
		$result = mysqli_query($conn, $sql);
		
		
		for ($j=0; $j < sizeof($mc_no); $j++) { 
			
			$sql = "UPDATE td_mc SET invoice_no = '$invoice_no' WHERE tkt_no = $tkt_no AND mc_st_no = '$mc_no[$j]'";
			
			mysqli_query($conn, $sql);
		}
		
		$_SESSION['update_flag'] = "added";
		header("Location: rep_mc_out.php");
	}
?>	
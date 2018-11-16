<?

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['username']) {
		
		$batch_no = $_SESSION['batch_no'];
		$mc_type = $_POST['mc_type'];
		$invoice_no = $_POST['invoice_no'];
		$machine_qty = $_POST['machine_qty'];
		$purpose = $_POST['purpose'];
		$created_by = $_SESSION['username'];
		$client_name = $_POST['c_name'];
		$mc_no = implode(',', $_POST['mc_no']);
		$mc_no = explode(',', $mc_no);
		$date = date('Y-m-d');

		$sql = "INSERT INTO td_new_machine_out (entry_date, invoice_no, mc_type, purpose, qty, client_name, created_by, created_dt) VALUES('$date', '$invoice_no', '$mc_type', '$purpose', $machine_qty, '$client_name', '$created_by', '$date')";
		
		$result = mysqli_query($conn, $sql);
		
		for ($i=0; $i < sizeof($batch_no); $i++) { 
			for ($j=0; $j < sizeof($mc_no); $j++) { 
				
				$sql = "UPDATE td_mc_sl SET invoice_no = '$invoice_no' WHERE batch_no = $batch_no[$i] AND mc_no = '$mc_no[$j]'";
				
				mysqli_query($conn, $sql);
			}
		}
		
		echo "<script>alert('Successfully Inserted')</script>";
	}
?>	
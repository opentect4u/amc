<?php
require '../../lib/connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
				$invoice_no = trim_data($_POST["invoice_no"]);
				$c_name = trim_data($_POST["c_name"]);
				$mc_type = trim_data($_POST["mc_type"]);
				$mc_qty = trim_data($_POST["mc_qty"]);
				$purpose = trim_data($_POST["purpose"]);
				$modifiedBy = $_SESSION['username'];
				$modifiedDt = date('Y-m-d');
				$batch_no = [];
				$mc_no = implode('*/*',$_POST['mc_no']);
				
				$mc_no = explode('*/*', $mc_no);
				$count = 0;

			$sql = "SELECT batch_no, status FROM td_mc_sl WHERE invoice_no = '$invoice_no'";
			$result = mysqli_query($conn, $sql);
			while($fetch_data = mysqli_fetch_assoc($result)){
				$batch_no[$count] = $fetch_data['batch_no'];
				$count++;
			}
			$count = 0;
			
			for ($j = 0; $j < sizeof($batch_no); $j++) {
				for ($i = 0; $i < sizeof($mc_no); $i++) { 
					$sql = "UPDATE td_mc_sl SET  invoice_no = '$invoice_no' WHERE batch_no = $batch_no[$j] AND mc_no = '$mc_no[$i]'";
						$count = $i+1;
		        		mysqli_query($conn, $sql);
		         }
			}
			
			$sqlupdate = "UPDATE `td_new_machine_out` SET purpose = '$purpose', qty = $count, client_name = '$c_name', modified_by = '$modifiedBy', modified_dt = '$modifiedDt' WHERE invoice_no = '$invoice_no'";


			$resultupdate = mysqli_query($conn, $sqlupdate);

			
			if ($resultupdate) {
				$_SESSION['update_flag'] = "item";
				header('Location: view_mc_out.php');
			}
		}

		function trim_data($data) {
			$data = trim($data);
			$data = strtoupper($data);
			return $data;
		}
?>
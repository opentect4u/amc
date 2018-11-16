<?php
require '../../lib/connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
				$batch_no = trim_data($_POST["batch_no"]);
				$mc_type = trim_data($_POST["mc_type"]);
				$mc_qty = trim_data($_POST["mc_qty"]);
				$servCenName = trim_data($_POST['servCenName']);
				$modifiedBy = $_SESSION['username'];
				$modifiedDt = date('Y-m-d');
				$mc_no = implode('*/*',$_POST['mc_no']);
			
				$mc_no = explode('*/*', $mc_no);
				$count = 0;

				var_dump($mc_type);

			$sql = "DELETE FROM td_mc_sl WHERE batch_no = $batch_no";
			mysqli_query($conn, $sql);
			for ($i=0; $i < sizeof($mc_no); $i++) { 

				if($mc_no[$i] == ''){
					continue;
				}
				else{
					$sql = "INSERT INTO td_mc_sl (`batch_no`, `mc_no`) VALUES ($batch_no,'$mc_no[$i]')";
					$count = $i+1;
	        		mysqli_query($conn, $sql);
				}
	         }
			
			$sqlupdate = "UPDATE `td_new_machine` SET `mc_type`='$mc_type', qty = $count, serv_area = '$servCenName', modified_by = '$modifiedBy', modified_dt = '$modifiedDt' WHERE batch_no = $batch_no";

			$resultupdate = mysqli_query($conn, $sqlupdate);
			echo $sqlupdate;
			
			if ($resultupdate) {
				$_SESSION['update_flag'] = "item";
				header('Location: view_machine.php');
			}
		}

				function trim_data($data) {
					$data = trim($data);
					$data = strtoupper($data);
					return $data;
					}
?>
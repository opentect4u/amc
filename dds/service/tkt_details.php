<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		$tkt_no = $_POST['tkt_no'];

		$sql = "SELECT recvd_dt,
					   tkt_no,
					   cust_code,
					   mc_type,
					   mc_qty,
					   submit_by,
					   sub_phn_no,
					   rcv_by,
					   serv_area,
					   remarks FROM td_customer_tkt WHERE tkt_no = $tkt_no
					   								AND approve_flag = 1";

		$query = mysqli_query($conn, $sql);

		if ($query) {
			while($data = mysqli_fetch_assoc($query)) {
				require '../include/fetch_client.php';
					while($client_data = mysqli_fetch_assoc($client_result)) {
						if ($client_data["client_code"] == $data["cust_code"]) {
							$recvd_dt = $data['recvd_dt'];
							$tkt_no = $data['tkt_no'];
							$center_name = $data['serv_area'];
							$client_name = $client_data['client_name'];
							$mc_type = $data['mc_type'];
							$mc_qty = $data['mc_qty'];
							$submit_by = $data['submit_by'];
							$sub_phn_no = $data['sub_phn_no'];
							$rcv_by = $data['rcv_by'];
							$remarks = $data['remarks'];
						}
				
					}
			}

			/*$sql = "SELECT * FROM `td_mc` WHERE tkt_no = $tkt_no";
			$query = mysqli_query($conn, $sql);
			while($data = mysqli_fetch_assoc($query)) {
				$sl_no[] = $data['mc_st_no'];
				$prob[] = $data['mc_prob'];
			}*/

			$sql1 = "SELECT IFNULL(count(DISTINCT mc_sl_no), 0) mc_qty FROM `td_service_out` WHERE tkt_no = $tkt_no";

			$result = mysqli_query($conn, $sql1);

			$data1 = mysqli_fetch_assoc($result);

			$mc_qty -= $data1['mc_qty'];
		}
		else{
			echo "<h3 style='text-align:center;'>Sorry! No Details Found.</h3>";
			exit;
		}

		
	}

?>
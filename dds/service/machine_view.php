
<div class="report_result">

		
<?php

		if($_SERVER["REQUEST_METHOD"] == "POST"){
			

			$item_code = trim_data($_POST["item_code"]);

			$retrieve_data = "SELECT `entry_date`, `batch_no`, `mc_type`, `qty`,`serv_area`, `approval_status` FROM td_new_machine WHERE batch_no = $item_code";

			$retrieve_data1 = "SELECT * from td_mc_sl WHERE batch_no = $item_code";

			$report_result = mysqli_query($conn,$retrieve_data);
			$report_result1 = mysqli_query($conn,$retrieve_data1);

			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
							
							while($report_data = mysqli_fetch_array($report_result, MYSQLI_NUM)) {

								echo '<table><tr><th>Entry Date</th><th>Batch No</th><th>Type of Machine</th><th>Machine Quantity</th><th>Service Area</th>';
									if($report_data[4]!= 1 ){
											echo '<th>Options</th></tr>';
										} else{
											echo '</tr>';
										};
								echo '<tr><td>'.$report_data[0].'</td><td>'.$report_data[1].'</td><td>'.$report_data[2].'</td><td>'.$report_data[3].'</td><td>'.$report_data[4].'</td>';

								if($report_data[4]!= 1){
											echo '<td><a href="machine_edit.php?item_code='.$item_code.'" class = "edit_delete">EDIT</a>';
									if($_SESSION['access_type'] == 'A')
											echo '<a href="javascript:delete_machine_stock('.$item_code.')" class ="edit_delete">DELETE</a><a href="approveMachine.php?item_code='.$item_code.'" class="edit_delete">Approve</a></td></tr>';
										} else{
											echo '</tr>';
										};

								$_SESSION['entry_date'] = $report_data[0];
								$_SESSION['batch_no'] = $report_data[1];
								$_SESSION['mc_type'] = $report_data[2];
								$_SESSION['qty'] = $report_data[3];
								$_SESSION['serv_area'] = $report_data[4];

							}

					echo '</table>';							

					echo '<br><table><tr><th>Bacth No</th><th>Machine Serial No</th>';
					$i = 1;
					while($item_data1 = mysqli_fetch_assoc($report_result1)) {?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $item_data1["mc_no"];?></td>
						</tr>
							<?php
						$i++;							
					}
					echo '</table>';
						}
					}
					
				}
			function trim_data($data) {
				$data = trim($data);
				$data = strtoupper($data);
				return $data;
		}
?>	
</div>
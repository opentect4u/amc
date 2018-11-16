
<div class="report_result">

		
<?php
	require '../../lib/connection.php';

		if($_SERVER["REQUEST_METHOD"]=="POST"){
			

			$item_code = trim_data($_POST["item_code"]);

			$retrieve_data = "SELECT `entry_date`, `invoice_no`, `mc_type`,`purpose`, `qty`,`client_name` FROM td_new_machine_out WHERE invoice_no = '$item_code'";

			$retrieve_data1 = "SELECT * from td_mc_sl WHERE invoice_no = '$item_code'";

			$report_result = mysqli_query($conn,$retrieve_data);
			$report_result1 = mysqli_query($conn,$retrieve_data1);

			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
							
					while($report_data = mysqli_fetch_array($report_result,MYSQLI_NUM)) {

						echo '<table><tr><th>Entry Date</th><th>Invoice No</th><th>Type of Machine</th><th>Purpose</th><th>Machine Quantity</th><th>Client Name</th><th>Options</th></tr>';
							
						echo '<tr><td>'.$report_data[0].'</td><td>'.$report_data[1].'</td><td>'.$report_data[2].'</td><td>'.$report_data[3].'</td><td>'.$report_data[4].'</td><td>'.$report_data[5].'</td>';

						
						echo '<td><a href="machine_out_edit.php?item_code='.$item_code.'&mc_type='.$report_data[2].'&purpose='.$report_data[3].'&mc_qty='.$report_data[4].'&cl_name='.$report_data[5].'" class = "edit_delete">EDIT</a>';
						
						echo '<a href="javascript:delete_invoice(\''.$item_code.'\')" class ="edit_delete">DELETE</a><a href="approveNewMcOut.php?item_code='.$item_code.'&entry_date='.$report_data[0].'&mc_type='.$report_data[2].'&mc_qty='.$report_data[4].'" class="edit_delete">Approve</a></td></tr>';
						echo '</table>';
					}

					echo '<br><table><tr><th>Bacth No</th><th>Machine Serial No</th>';
					
					while($item_data1 = mysqli_fetch_assoc($report_result1)) {?>
						<tr>
							<td><?php echo $item_data1["batch_no"];?></td>
							<td><?php echo $item_data1["mc_no"];?></td>
						</tr>
					<?
					}
						}
					}
					echo '</table>';
				}

			function trim_data($data) {
				$data = trim($data);
				$data = strtoupper($data);
				return $data;
			}
?>	
</div>




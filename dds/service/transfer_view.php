
<div class="report_result">

<?php
	if($_SERVER["REQUEST_METHOD"]=="POST"){

			$item_code = $_POST["item_code"];

			$sql = "SELECT `trf_date`,
                      	   `trf_no`,
	                       `trf_mode`,
	                       `from_place`,
	                       `to_place`,
	                       `remarks`,
	                       `created_by`,
	                       `created_dt` FROM td_transfer
						 			    WHERE trf_no = '$item_code'
									    LIMIT 1";

			$report_result = mysqli_query($conn, $sql);

			$sql = "SELECT `comp_sl_no`,
                      	   `comp_qty` FROM td_transfer
								 WHERE trf_no = '$item_code'
								 AND approval_status IS NULL";
			$report_result1 = mysqli_query($conn, $sql);

			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
				while($report_data = mysqli_fetch_array($report_result, MYSQLI_NUM)) {
								echo '<table style="padding: 6px;">
										<tr>
										<th>Transfer Date</th>
										<th>Transfer No.</th>
										<th>Transfer<br>Mode</th>
										<th>Transfer<br>From</th>
										<th>Transfer<br>To</th>
										<th>Remarks</th>';
								if($report_data[8]!= 1 || $_SESSION['access_type'] == 'AD'){
											echo '<th>Options</th></tr>';
										} else{
											echo '</tr>';
										}
									echo '<tr>
									<td>'.date('d-m-Y',strtotime($report_data[0])).'</td>
									<td>'.$report_data[1].'</td>
									<td>'.$report_data[2].'</td>
									<td>'.$report_data[3].'</td>
									<td>'.$report_data[4].'</td>
                  <td>'.$report_data[5].'</td>';
								if($report_data[8]!= 1 || $_SESSION['access_type'] == 'AD'){
									echo '<td><a href="transfer_edit.php?trf_no='.$item_code.'" class = "edit_delete">EDIT</a>
														<a href="javascript:delete_transfer(\''.$item_code.'\')" class ="edit_delete">DELETE</a>
														<a href="approve_transfer.php?item_code='.$item_code.'" class = "edit_delete">Approve</a></td></tr>';
								}else{
									echo '</tr>';
								}
								echo '</table>';
					}

					if (mysqli_num_rows($report_result1) > 0) {
						echo '<br><table>
								<tr>
								<th>Component Name</th>
								<th>Quantity</th>
								</tr>';
								while($report_data = mysqli_fetch_array($report_result1, MYSQLI_NUM)) {
									require 'fetch_parts.php';
										while($item_data1 = mysqli_fetch_array($parts_result, MYSQLI_NUM)) {
											if ($item_data1[0] == $report_data[0]) {
												echo '<tr>
															<td>'.$item_data1[1].'</td>
															<td>'.$report_data[1].'</td>
															</tr>';
											}
										}
							 }
							 echo "</table>";
				  }
			 }
		 }
	 }
?>
</div>
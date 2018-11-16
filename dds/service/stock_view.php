
<div class="report_result">

<?php

	if($_SERVER["REQUEST_METHOD"]=="POST" && $_SESSION['username']){

			$item_code = $_POST["item_code"];

			$sql = "SELECT 	in_date,
							bill_no,
							comp_arrived_dt,
							serv_area,
							created_by,
							created_dt,
							approval_status FROM td_stock_in
		 													WHERE bill_no = '$item_code'
															LIMIT 1";

			$report_result = mysqli_query($conn, $sql);

			$sql = "SELECT 	in_no,
							comp_sl_no,
							comp_qty  FROM td_stock_in
												WHERE bill_no = '$item_code'";
			$report_result1 = mysqli_query($conn, $sql);

			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
				while($report_data = mysqli_fetch_array($report_result, MYSQLI_NUM)) {
								echo '<table>
										<tr>
										<th>In Date</th>
										<th>Bill No.</th>
										<th>Component<br>Arrival Date</th>
										<th>Service Center</th>
										<th>Created By</th>
										<th>Created Date</th>';
								if($report_data[6]!= 1 || $_SESSION['access_type'] == 'AD'){
											echo '<th>Options</th></tr>';
										} else{
											echo '</tr>';
										}
									echo '<tr>
									<td>'.date('d-m-Y',strtotime($report_data[0])).'</td>
									<td>'.$report_data[1].'</td>
									<td>'.date('d-m-Y',strtotime($report_data[2])).'</td>
									<td>'.$report_data[3].'</td>
									<td>'.$report_data[4].'</td>
									<td>'.date('d-m-Y',strtotime($report_data[5])).'</td>';
								if($report_data[6]!= 1 || $_SESSION['access_type'] == 'AD'){
									echo '<td><a href="stock_edit.php?bill_no='.$item_code.'" class = "edit_delete">EDIT</a>
														<a href="javascript:delete_stock(\''.$item_code.'\')" class ="edit_delete">DELETE</a>
														<a href="approve_stock.php?item_code='.$item_code.'" class = "edit_delete">Approve</a></td></tr>';
								}else{
									echo '</tr>';
								}
								echo '</table>';
					}

					if (mysqli_num_rows($report_result1) > 0) {
						echo '<br><table>
								<tr>
								<th>Sl No</th>
								<th>Component Name</th>
								<th>Quantity</th>
								</tr>';
								while($report_data = mysqli_fetch_array($report_result1, MYSQLI_NUM)) {
									require 'fetch_parts.php';
										while($item_data1 = mysqli_fetch_array($parts_result, MYSQLI_NUM)) {
											if ($item_data1[0] == $report_data[1]) {
												echo '<tr>
															<td>'.$report_data[0].'</td>
															<td>'.$item_data1[1].'</td>
															<td>'.$report_data[2].'</td>
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

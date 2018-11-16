<div class="report_result">		
<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		echo '<table>
				<tr><th>Repaired Machine<br>Out</th><th>Ticket No</th><th>Invoice Name</th><th>Machine Type</th><th>Quantity</th><th>Client Name</th><th>Option</th></tr>';

		$item_code = trim_data($_POST["item_code"]);
		$retrieve_data = "SELECT `out_dt`, `tkt_no`, `invoice_no`, `mc_type`, `qty`, `client_name` FROM td_reprd_mc_out WHERE invoice_no = '$item_code'";

			$report_result = mysqli_query($conn,$retrieve_data);


		$retrieve_data1 = "SELECT * from td_mc WHERE invoice_no = '$item_code'";

			$report_result1 = mysqli_query($conn,$retrieve_data1);

		if (mysqli_num_rows($report_result) > 0) {
					
			while($report_data = mysqli_fetch_assoc($report_result)) {
				
							
				echo '<tr><td>'.date('d-m-Y', strtotime($report_data['out_dt'])).'</td><td>'.$report_data['tkt_no'].'</td><td>'.$report_data['invoice_no'].'</td><td>'.$report_data['mc_type'].'</td><td>'.$report_data['qty'].'</td><td>'.$report_data['client_name'].'</td><td><a href="repaire_mc_edit.php?out_dt='.$report_data['out_dt'].'&tkt_no='.$report_data["tkt_no"].'&invoice_no='.$report_data["invoice_no"].'&mc_type='.$report_data["mc_type"].'&qty='.$report_data["qty"].'" class = "edit_delete" id="$item_code">EDIT</a>                 			<a href="approveRepairing.php?invoice_no='.$report_data['invoice_no'].'&mc_type='.$report_data["mc_type"].'&comp_qty='.$report_data["qty"].'" class = "edit_delete" id="$item_code">Approve</a></td></tr>';				
					}
			}
			echo '</table>';

			echo '<br><table><tr><th>Machine Serial No</th><th>Problem</th><th>Warrenty</th>';

					while($item_data1 = mysqli_fetch_assoc($report_result1)) {?>
						<tr>
							<td><?php echo $item_data1["mc_st_no"];?></td>
							<td><?php echo $item_data1["mc_prob"];?></td>
							<td><?php if($item_data1["warr_flg"]){
										echo '<span style=color:red>Out of Warrenty </span>';
									  }else{
										echo '<span style=color:green>In Warrenty </span>';
									  }
							?></td></tr>
							<?
					}
		}
	function trim_data($data) {
		$data = trim($data);
		$data = strtoupper($data);
		return $data;
	}
?>	
</div>
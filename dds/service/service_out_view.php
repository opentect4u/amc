<div class="report_result">

<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$item_code = $_POST["item_code"];

		$sql = "SELECT mm.client_name 
				FROM td_customer_tkt td, client_master mm
				WHERE td.tkt_no = $item_code
				AND td.cust_code = mm.client_code";


		$result = mysqli_query($conn, $sql);
		
		$data = mysqli_fetch_assoc($result);

		?>
		<div id="divToPrint">

		<?php		
			echo '<div style="text-align: center">Out Receipt</div>
				  <div style="text-align: center">'.$data["client_name"].'</div>
				  <table width="100%">
					<tr><th>Stock Out<br>Date</th><th>Ticket No</th><th>Service Area</th><th>Machine<br>Type</th><th>Machine Quantity</th><th class="hidden">Option</th></tr>';

				$count = -1;

				$retrieve_data = "SELECT out_dt,
										 tkt_no,
										 serv_area,
										 mc_type,
										 created_by FROM td_service_out 
										 			WHERE tkt_no = $item_code LIMIT 1";

				$retrieve_data1 = "SELECT sl_no,
										  mc_sl_no,
										  prob,
										  comp_sl_no,
										  qty,
										  serv_by FROM td_service_out
										  		  WHERE tkt_no = $item_code
										  		  AND approval_status IS NULL";

				$retrieve_data2 = "SELECT tkt_no, MAX(sl_no) sl_no FROM td_service_out WHERE tkt_no = $item_code GROUP BY tkt_no";

				$report_result = mysqli_query($conn,$retrieve_data);
				$report_result1 = mysqli_query($conn,$retrieve_data1);

				$report_result2 = mysqli_query($conn,$retrieve_data2);
				$report_data2 = mysqli_fetch_assoc($report_result2);

				
				unset($sql);

				$sql = "SELECT count(tkt_no) tot_mc_qty FROM td_service_out
													    WHERE tkt_no = $item_code
										  		  	    AND approval_status IS NULL";
		        $res = mysqli_query($conn, $sql);
		        $datmc = mysqli_fetch_assoc($res);

		        if (mysqli_num_rows($report_result) > 0) {

					while($report_data = mysqli_fetch_assoc($report_result)) {

								$tkt_no = $report_data['tkt_no'];
								$serv_area = $report_data['serv_area'];
								$mc_type = $report_data['mc_type'];
								$mc_qty = $datmc['tot_mc_qty'];

						echo '<tr>
								<td>'.date('d-m-Y', strtotime($report_data['out_dt'])).'</td>
								<td>'.$report_data['tkt_no'].'</td>
								<td>'.$report_data['serv_area'].'</td>
								<td>'.$report_data['mc_type'].'</td>
								<td style="text-align: center;">'.$datmc['tot_mc_qty'].'</td>
								<td class="hidden"><button type="button" class="edit_delete" id="click">Edit</button>
									<button class="edit_delete print" id="$item_code">Approve</button>
								</td>
							  </tr>';
					}
				}

				echo '</table>';

				echo '<br><table width="100%" style="padding: 6px;"><tr><th>Sl No.</th><th>Machine Sl. No.</th><th>Problem</th><th>Component Name </th><th>Qty</th><th class="hidden">Service By</th></tr>';
					
				$mc_sl_nos = [];

				while($item_data1 = mysqli_fetch_assoc($report_result1)) {

				 $count++;
						
					require 'fetch_parts.php';

					while($parts = mysqli_fetch_assoc($parts_result)) {

						if ($parts["sl_no"] == $item_data1["comp_sl_no"]) {

							array_push($mc_sl_nos, $item_data1["mc_sl_no"]);
						?>
						<tr>
							<td><input type="hidden" id="rowCount<?php echo $count;?>" value="<?php echo $item_data1["sl_no"];?>" /><?php echo $item_data1["sl_no"];?></td>
							<td><input type="hidden" id="mc_no<?php echo $count;?>" value="<?php echo $item_data1["mc_sl_no"];?>" /><?php echo $item_data1["mc_sl_no"];?></td>
							<td><?php require 'fetch_problem.php';?><select class="input_text hidn prob" style="width: 150px;" required><?php while($pdata = mysqli_fetch_assoc($problem_result)){ ?><option value="<?php echo $pdata['problem_desc'];?>" <?php echo ($item_data1["prob"] == $pdata['problem_desc'])?"selected":""; ?>><?php echo $pdata['problem_desc'];?></option><?php } ?></select><p><?php echo $item_data1["prob"];?></p></td>
							<td><?php echo $parts["parts_desc"];?></td>
							<td><input type="hidden" class="input_text hidn qty" value="<?php echo $item_data1["qty"];?>" required style="width: 50px;"/><p><?php echo $item_data1["qty"];?></p></td>
							<td class="hidden"><input type="hidden" class="input_text hidn sev" value="<?php echo $item_data1['serv_by'];?>" required style="width: 50px;"/><p><?php echo $item_data1["serv_by"];?></p></td>
						</tr>
							<?php
						}
					}
				}

		echo '</div>';

	}

	
?>

</div>


<script>
  
$(document).ready(function(){

  	$(".print").click(function(){
  		
  		var status	=	confirm("Do you want to print?");
  		
		if(status){
			
  			printDiv();

  		}

  		document.location.href='./approveStockOut.php?item_code=<?php echo $tkt_no; ?>&serv_area=<?php echo $serv_area;?>&mc_type=<?php echo $mc_type;?>&mc_qty=<?php echo $mc_qty;?>';
  		
  	});

});
  
function printDiv() {

        var divToPrint = document.getElementById('divToPrint');

        var WindowObject = window.open('', 'Print-Window');
			WindowObject.document.open();
			WindowObject.document.writeln('<!DOCTYPE html>');
			WindowObject.document.writeln('<html><head><title></title><style type="text/css">');


			WindowObject.document.writeln('@media print { .center { text-align: center;}' +
				'                                         .inline { display: inline; }' +
				'                                         .underline { text-decoration: underline; }' +
				'                                         .hidden { display: none; }' +
				'                                         .left { margin-left: 315px;} ' +
				'                                         .right { margin-right: 375px; display: inline; }' +
				'                                          table { border-collapse: collapse; }' +
				'                                          th, td { border: 1px solid black; border-collapse: collapse; padding: 10px;}' +
				'                                           th, td { }' +
				'                                         .border { border: 1px solid black; } ' +
				'                                         .bottom { bottom: 5px; width: 100%; position: fixed ' +
				'                                       ' +
				'                                   } } </style>');
			WindowObject.document.writeln('</head><body onload="window.print()">');
			WindowObject.document.writeln(divToPrint.innerHTML);
			WindowObject.document.writeln('</body></html>');
			WindowObject.document.close();
        setTimeout(function () {
            WindowObject.close();
        }, 10);

  }
  
</script>
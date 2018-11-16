<div class="report_result">


<?php

if($_SERVER["REQUEST_METHOD"]=="POST" && $_SESSION['username']){

			$item_code = trim_data($_POST["item_code"]);

			$retrieve_data = "SELECT * from td_customer_tkt WHERE tkt_no = $item_code";
			$retrieve_data1 = "SELECT * from td_mc WHERE tkt_no = $item_code";

			$report_result = mysqli_query($conn,$retrieve_data);
			$report_result1 = mysqli_query($conn,$retrieve_data1);

				if (mysqli_num_rows($report_result) > 0) {

					while($item_data = mysqli_fetch_assoc($report_result)) {
					  require '../include/fetch_client.php';
						while($client_data = mysqli_fetch_assoc($client_result)) {
							if ($client_data["client_code"] == $item_data["cust_code"]) {
								 echo '<div id="divToPrint">
								 		<div style="text-align: left;">In Receipt</div>
								 <table><tr><th>Date</th><th>Ticket No</th><th class="hidden">Customer Name</th><th class="hidden">M/C Type</th><th>Machine<br>Quantity</th><th>Submit By</th><th class="hidden">Phone No</th><th class="hidden">Service Center<br>Name</th><th class="hidden">Received By</th>';
								 if($item_data['approve_flag']!= 1 || $_SESSION['access_type'] == 'AD'){
								 	//$_SESSION['tkt_no'] = $item_data["tkt_no"];
											echo '<th class="hidden">Options</th></tr>';
										} else{
											echo '</tr>';
										};
								 echo '<tr><td>'.date('d-m-Y',strtotime($item_data["recvd_dt"])).'</td><td>'.$item_data["tkt_no"].'</td><td class="hidden">'.$client_data["client_name"].'</td><td class="hidden">'.$item_data["mc_type"].'</td><td>'.$item_data["mc_qty"].'</td><td>'.$item_data["submit_by"].'</td><td class="hidden">'.$item_data["sub_phn_no"].'</td><td class="hidden">'.$item_data["serv_area"].'</td><td class="hidden">'.$item_data["rcv_by"].'</td>';
								 if($item_data['approve_flag']!= 1 || $_SESSION['access_type'] == 'AD'){

								 $_SESSION['serv_area'] = $item_data["serv_area"];	
								 $_SESSION['mc_qty'] = $item_data["mc_qty"];
								 $_SESSION['mc_type'] = $item_data["mc_type"];


								 echo '<td class="hidden"><a href="service_edit.php?item_code='.$item_code.'" class = "edit_delete">EDIT</a><button  class="edit_delete" id="print">Approve</button></td></tr>';
								 }else{
									echo '</tr>';
								}
								 echo '</table></div>';
							}

						}
					}

					echo '<br><table><tr><th>Machine Sl<br> Number</th><th>Problem</th><th>Warrenty</th>';

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
							<?php
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

<script>
  
  $(document).ready(function(){

  	$("#print").click(function(){
  		
  		var status	=	confirm("Do you want to print?");
  		if(status){
  			printDiv();
  		}
  		document.location.href="approveService.php?item_code=<?php echo $item_code; ?>";
  		
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

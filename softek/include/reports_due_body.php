<div class="report_result">
<h1>DUE AMOUNT</h1>
<?php
	require '../lib/connection.php';
	


			echo '<table >
		<tr><th>INVOICE NO</th><th>CLIENT NAME</th><th>STARTING DATE</th><th>DURATION</th><th>END DATE</th><th>LAST DUE AMOUNT</th><th>OPTIONS</th></tr>';

			$month=trim_data($_POST["month"]);
			$year=trim_data($_POST["year"]);
			$date=$year.'-'.$month.'-%';
			$retrieve_data="select am.invoice_no, cli.client_name, am.starting_date, am.duration, am.end_date, pm.due_amount FROM mm_amc_master am, mm_client_master cli, mm_order_master od, mm_payment_master pm WHERE od.client_id = cli.client_id and od.order_id = am.order_id and am.invoice_no = pm.invoice_no and pm.due_amount > 0 and pm.payment_id in (SELECT max(payment_id) from mm_payment_master group by invoice_no)";
			$report_result = mysqli_query($conn,$retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
							
							while($report_data = mysqli_fetch_array($report_result,MYSQLI_NUM)) {
								echo '<tr><td>'.$report_data[0].'</td><td>'.$report_data[1].'</td><td>'.$report_data[2].'</td><td>'.$report_data[3].'</td><td>'.convert_date($report_data[4]).'</td><td>'.$report_data[5].'</td><td><a href="payment_edit.php?invoice_no='.$report_data[0].'" class ="edit_delete">EDIT PAYMENT</a></td></tr>';

							}
						}
					}
					echo '</table>';
				
					function trim_data($data) {
							$data = trim($data);
							$data = strtoupper($data);
							return $data;
					}
                                        function convert_date($data){
                                         $data=date('d-m-Y',strtotime($data));
                                         return $data;
}
?>	
</div>
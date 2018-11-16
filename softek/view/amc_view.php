<div class="report_result">
		
<?php
	require '../lib/connection.php';
	

		if($_SERVER["REQUEST_METHOD"]=="POST"){
			echo '<h1>INSTALLATION/AMC DETAILS</h1>';
			echo '<br>';
			echo '<table >';
		/*<tr><th>AMC CODE</th><th>ORDER CODE</th><th>INVOICE NO</th><th>INVOICE DATE</th><th>STARTING DATE</th><th>DURATION</th><th>END DATE</th><th>AMOUNT</th><th>TAX(%)</th><th>TOTAL AMOUNT</th><th>LAST PAYMENT DATE</th><th>LAST PAID AMOUNT</th><th>LAST DUE AMOUNT</th><th>UPDATED BY</th><th>UPDATE TIME</th><th>OPTION</th></tr>';*/

			$invoice_no=trim_data($_POST["invoice_no"]);
			$retrieve_data="SELECT am.amc_id, am.order_id, am.invoice_no, am.invoice_type, am.invoice_date, am.starting_date, am.duration, am.end_date, am.amount, am.tax, am.total_amount, pm.payment_date, pm.paid_amount, pm.due_amount, pm.updated_by, pm.date_time FROM mm_amc_master am , mm_payment_master pm WHERE am.invoice_no = pm.invoice_no and pm.payment_id = (select max(payment_id) from mm_payment_master where invoice_no = '".$invoice_no."')";
			$report_result = mysqli_query($conn,$retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
							while($report_data = mysqli_fetch_array($report_result,MYSQLI_NUM)) {
								echo '<tr><th>AMC CODE</th><td>'.$report_data[0].'</td></tr>
								<tr><th>ORDER CODE</th><td>'.$report_data[1].'</td></tr>
								<tr><th>INVOICE NO</th><td>'.$report_data[2].'</td></tr>
								<tr><th>INVOICE TYPE</th><td>'.$report_data[3].'</td></tr>
								<tr><th>INVOICE DATE</th><td>'.convert_date($report_data[4]).'</td></tr>
								<tr><th>STARTING DATE</th><td>'.convert_date($report_data[5]).'</td></tr>
								<tr><th>DURATION(Months)</th><td>'.$report_data[6].'</td></tr>
								<tr><th>END DATE</th><td>'.convert_date($report_data[7]).'</td></tr>
								<tr><th>AMOUNT</th><td>'.$report_data[8].'</td></tr>
								<tr><th>TAX(%)</th><td>'.$report_data[9].'</td></tr>
								<tr><th>TOTAL AMOUNT</th><td>'.$report_data[10].'</td></tr>
								<tr><th>LAST PAYMENT DATE</th><td>'.convert_date($report_data[11]).'</td></tr>
								<tr><th>LAST PAID AMOUNT</th><td>'.$report_data[12].'</td></tr>
								<tr><th>LAST DUE AMOUNT</th><td>'.$report_data[13].'</td></tr>
								<tr><th>UPDATED BY</th><td>'.$report_data[14].'</td></tr>
								<tr><th>UPDATE TIME</th><td>'.$report_data[15].'</td></tr>';
						if($_SESSION['access_type']=="AD"){
							echo	'<tr><td colspan = "2"><a href="amc_edit.php?amc_code='.$report_data[0].'" class ="edit_delete">EDIT INVOICE</a><a href="payment_edit.php?invoice_no='.$report_data[2].'" class ="edit_delete">EDIT PAYMENT</a></td></tr>';

						}		
								
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
                                        function convert_date($data){
                                         $data=date('d-m-Y',strtotime($data));
                                         return $data;
}
?>	
</div>
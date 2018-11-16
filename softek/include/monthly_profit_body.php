
<?php
	require '../lib/connection.php';
	
		if($_SERVER["REQUEST_METHOD"]=="POST"){
			$count1=0;
			$count2=0;
			$count3=0;
			$year=trim_data($_POST["year"]);
			$date=$year.'-%';

			echo '<table >
		<tr><th>INVOICE DATE</th><th>INVOICE NO</th><th>TOTAL AMOUNT</th><th>PAID AMOUNT</th><th>DUE AMOUNT</th></tr>';

			
			$retrieve_data="select am.invoice_date,pm.invoice_no,pm.total_amount,sum(pm.paid_amount),(pm.total_amount-sum(pm.paid_amount)) as due from mm_payment_master pm,mm_amc_master am where am.invoice_no=pm.invoice_no and am.invoice_date like '".$date."' GROUP BY invoice_no";
			$report_result = mysqli_query($conn,$retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
							
							while($report_data = mysqli_fetch_array($report_result,MYSQLI_NUM)) {
								echo '<tr><td>'.convert_date($report_data[0]).'</td><td>'.$report_data[1].'</td><td>'.$report_data[2].'</td><td>'.$report_data[3].'</td><td>'.$report_data[4].'</td></tr>';
								$count1=$count1+$report_data[2];
								$count2=$count2+$report_data[3];
								$count3=$count3+$report_data[4];
							}
						}
					}
					echo '<tr><td></td><th>TOTAL</th><td>'.$count1.'</td><td>'.$count2.'</td><td>'.$count3.'</td></tr>';
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

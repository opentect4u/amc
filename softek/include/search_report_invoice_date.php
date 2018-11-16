	
<?php
	include '../lib/connection.php';
	

		if($_SERVER["REQUEST_METHOD"]=="POST"){
                $count=0;
			echo '<table >
		<tr><th>Serial No.</th><th>CLIENT NAME</th><th>INVOICE NO.</th><th>INVOICE TYPE</th><th>INVOICE DATE</th><th>AMOUNT</th></tr>';
	 
			$start_date	=convert_date1($_POST["starting_date"]);
			$end_date  	=convert_date1($_POST["end_date"]);
			$invoiceType	=$_POST["invoice_type"];
			//$date=$year.'-'.$month.'-%';
			$retrieve_data="select mm_client_master.client_name,mm_amc_master.invoice_no,mm_amc_master.invoice_type,mm_amc_master.invoice_date,mm_amc_master.amount from mm_client_master,mm_amc_master,mm_order_master where
			mm_amc_master.invoice_date BETWEEN '".$start_date."' AND '".$end_date."'
			AND mm_amc_master.order_id=mm_order_master.order_id
			and mm_order_master.client_id=mm_client_master.client_id
                        AND mm_amc_master.invoice_type = '".$invoiceType."'
			ORDER BY mm_amc_master.invoice_date ";

			$report_result = mysqli_query($conn,$retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
							
							while($report_data = mysqli_fetch_array($report_result,MYSQLI_NUM)) {
                                                                $count+=1;
								echo '<tr><td>'.$count.'</td><td>'.$report_data[0].'</td><td>'.$report_data[1].'</td><td>'.$report_data[2].'</td><td>'.convert_date($report_data[3]).'</td><td>'.$report_data[4].'</td></tr>';

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

	function convert_date1($data){
          $data=date('Y-m-d',strtotime($data));
          return $data;
	}

?>	
</div>


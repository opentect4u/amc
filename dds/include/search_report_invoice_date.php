	
<?php
	include '../lib/connection.php';
	

		if($_SERVER["REQUEST_METHOD"]=="POST"){

			echo '<table >
		<tr><th>INVOICE NO.</th><th>SALE DATE</th><th>CLIENT NAME</th><th>ITEM DETAILS</th><th>ITEM QUANTITY</th></tr>';
	 
			$start_date=convert_date1($_POST["starting_date"]);
			$end_date=convert_date1($_POST["end_date"]);
			//$date=$year.'-'.$month.'-%';
			$retrieve_data="SELECT sa.invoice_no,sa.purchase_date,ca.client_name,concat(itm.item_type,' ',itm.item_application),sa.quantity FROM sales_master sa, client_master ca, item_master itm where sa.purchase_date BETWEEN '".$start_date."' and '".$end_date."' and sa.client_code = ca.client_code and sa.item_code=itm.item_code ORDER BY sa.purchase_date ASC ";
			$report_result = mysqli_query($conn,$retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
							
							while($report_data = mysqli_fetch_array($report_result,MYSQLI_NUM)) {
								echo '<tr><td>'.$report_data[0].'</td><td>'.convert_date($report_data[1]).'</td><td>'.$report_data[2].'</td><td>'.$report_data[3].'</td><td>'.$report_data[4].'</td></tr>';

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


<div class="report_result">
		
<?php
	require '../lib/connection.php';
	

		if($_SERVER["REQUEST_METHOD"]=="POST"){

			echo '<table >
		<tr><th>SALE CODE</th><th>INVOICE NO.</th><th>ITEM CODE</th><th>CLIENT CODE</th><th>QUANTITY</th><th>WARRANTY PERIOD</th><th>SALE DATE</th><th>REMARKS</th><th>SERIAL NO.</th><th>UPDATED BY</th><th>UPDATE TIME</th><th>OPTIONS</th></tr>';

			$invoice_no=trim_data($_POST["invoice_no"]);
			$retrieve_data="SELECT s.sale_code, s.invoice_no,s.item_code,s.client_code,s.quantity,s.warranty_period,s.purchase_date,s.remarks,ser.serial_no,s.updated_by,s.date_time,ser.serial_code FROM sales_master s, serial_master ser WHERE s.sale_code = ser.sale_code AND s.invoice_no='".$invoice_no."'";
			$report_result = mysqli_query($conn,$retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
							
							while($report_data = mysqli_fetch_array($report_result,MYSQLI_NUM)) {
								echo '<tr><td>'.$report_data[0].'</td><td>'.$report_data[1].'</td><td>'.$report_data[2].'</td><td>'.$report_data[3].'</td><td>'.$report_data[4].'</td><td>'.$report_data[5].'</td><td>'.convert_date($report_data[6]).'</td><td>'.$report_data[7].'</td><td>'.$report_data[8].'</td><td>'.$report_data[9].'</td><td>'.$report_data[10].'</td><td><a href="sales_edit.php?sale_code='.$report_data[0].'" class ="edit_delete">EDIT SALE</a><a href="serial_edit.php?serial_code='.$report_data[11].'" class ="edit_delete">EDIT SERIAL</a><a href="javascript:delete_serial('.$report_data[11].','.$report_data[0].')" class = "edit_delete">DELETE ROW</a><a href="javascript:delete_sales('.$report_data[0].')" class = "edit_delete">DELETE ALL</a></td></tr>';

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
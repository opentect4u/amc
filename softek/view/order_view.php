<div class="report_result">
		
<?php
	require '../lib/connection.php';
	

		if($_SERVER["REQUEST_METHOD"]=="POST"){

			echo '<table >
		<tr><th>ORDER CODE</th><th>CLIENT CODE</th><th>ORDER AMOUNT</th><th>PAYMENT DETAILS</th><th>REMARKS</th><th>EXECUTION STATUS</th><th>ORDER DATE</th><th>UPDATED BY</th><th>UPDATE TIME</th>';
							if($_SESSION['access_type']=="AD"){
								echo	'<th>OPTIONS</th></tr>';}

			$order_id=trim_data($_POST["order_id"]);
			$retrieve_data="SELECT `order_id`, `client_id`, `order_value`, `payment`, `remarks`, `exe_status`, `order_date`, `updated_by`, `date_time` FROM `mm_order_master` WHERE order_id='".$order_id."'";
			$report_result = mysqli_query($conn,$retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
							
							while($report_data = mysqli_fetch_array($report_result,MYSQLI_NUM)) {
								echo '<tr><td>'.$report_data[0].'</td><td>'.$report_data[1].'</td><td>'.$report_data[2].'</td><td>'.$report_data[3].'</td><td>'.$report_data[4].'</td><td>'.$report_data[5].'</td><td>'.convert_date($report_data[6]).'</td><td>'.$report_data[7].'</td><td>'.$report_data[8].'</td>';
							if($_SESSION['access_type']=="AD"){
								echo	'<td><a href="order_edit.php?order_id='.$report_data[0].'" class ="edit_delete">EDIT</a><a href="javascript:delete_sales('.$report_data[0].')" class = "edit_delete">DELETE</a></td></tr>';
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
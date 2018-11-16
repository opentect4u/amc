<div class="report_result">
		
<?php
	require '../lib/connection.php';
	

	if($_SERVER["REQUEST_METHOD"]=="POST" && $_SESSION['username']!= "" && !empty($_SESSION['username']) && isset($_SESSION['username']) && $_SESSION['insert_flag']==""){
		echo '<h1>Client Wise Report</h1>';
		echo '<table class = "new_report_table">';
		
		$client_code=trim_data($_POST["client_code"]);
		$retrieve_data="SELECT `mm_client_master`.`client_id`,
							`mm_client_master`.`client_name`,
							`mm_product_master`.`product_type`, 
							`mm_client_master`.`contact_person`, 
							`mm_client_master`.`designation`, 
							`mm_client_master`.`contact_no`, 
							`mm_client_master`.`sss_man`, 
							`mm_client_master`.`state`, 
							`mm_client_master`.`district`, 
							`mm_client_master`.`address`, 
							`mm_client_master`.`pin_code`, 
							`mm_client_master`.`email`, 
							`mm_client_master`.`remarks`, 
							`mm_client_master`.`client_status`,
							`mm_order_master`.`order_id`,
							`mm_amc_master`.`invoice_no`,
							`mm_amc_master`.`invoice_type`,
							`mm_amc_master`.`invoice_date`,
							`mm_amc_master`.`starting_date`,
							`mm_amc_master`.`duration`,
							`mm_amc_master`.`end_date`,
							`mm_amc_master`.`updated_by`, 
							`mm_amc_master`.`date_time`
	 
						FROM `mm_client_master`, `mm_product_master`, `mm_amc_master`, `mm_order_master` 
						WHERE `mm_client_master`.`client_type` = `mm_product_master`.`product_id`
						AND  `mm_order_master`.`client_id` = `mm_client_master`.`client_id`
						AND `mm_order_master`.`order_id` = `mm_amc_master`.`order_id`
						AND `mm_amc_master`.`amc_id` = (select max(`amc_id`) 
														from `mm_amc_master` 
														where `order_id` = (select `order_id` 
																			from `mm_order_master` 
																			where `client_id` = '".$client_code."'))
						AND `mm_client_master`.`client_id`= '".$client_code."'";
							
			$report_result = mysqli_query($conn,$retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
					while($report_data = mysqli_fetch_array($report_result,MYSQLI_NUM)) {
						echo '<tr><th>AMC STATUS</th>';
						$date = new DateTime($report_data[18]);
						$interval = new DateInterval('P'.$report_data[19].'M');
						$date->add($interval);
						$date2=date_create(date("Y-m-d"));					
						$diff=date_diff($date2,$date);				
						if((int)$diff->format("%R%a") < 0){
							echo '<td style="background-color: red; color: white;">NOT IN AMC</td></tr>';
						}
						else{
							echo '<td style="background-color: green; color: white;">IN AMC</td></tr>';
						}
						echo '<tr><th>CLIENT CODE</th><td>'.$report_data[0].'</td></tr>
							<tr><th>CLIENT NAME</th><td>'.$report_data[1].'</td></tr>
							<tr><th>CLIENT TYPE</th><td>'.$report_data[2].'</td></tr>
							<tr><th>CONTACT PERSON</th><td>'.$report_data[3].'</td></tr>
							<tr><th>DESIGNATION</th><td>'.$report_data[4].'</td></tr>
							<tr><th>CLIENT PHONE NO</th><td>'.$report_data[5].'</td></tr>
							<tr><th>SSS MARKETING PERSON</th><td>'.$report_data[6].'</td></tr>
							<tr><th>STATE</th><td>'.$report_data[7].'</td></tr>
							<tr><th>DISTRICT</th><td>'.$report_data[8].'</td></tr>
							<tr><th>CLIENT ADDRESS</th><td>'.$report_data[9].'</td></tr>
							<tr><th>PIN CODE</th><td>'.$report_data[10].'</td></tr>
							<tr><th>CLIENT EMAIL</th><td>'.$report_data[11].'</td></tr>
							<tr><th>REMARKS</th><td>'.$report_data[12].'</td></tr>
							<tr><th>STATUS</th><td>'.$report_data[13].'</td></tr>
							<tr><th>ORDER ID</th><td>'.$report_data[14].'</td></tr>
							<tr><th>LAST INVOICE NO.</th><td>'.$report_data[15].'</td></tr>
							<tr><th>LAST INVOICE TYPE</th><td>'.$report_data[16].'</td></tr>
							<tr><th>LAST INVOICE DATE</th><td>'.convert_date($report_data[17]).'</td></tr>
							<tr><th>STARTING DATE</th><td>'.convert_date($report_data[18]).'</td></tr>
							<tr><th>DURATION(Months)</th><td>'.$report_data[19].'</td></tr>
							<tr><th>END DATE</th><td>'.convert_date($report_data[20]).'</td></tr>
							<tr><th>UPDATED BY</th><td>'.$report_data[21].'</td></tr>
							<tr><th>UPDATED TIME</th><td>'.$report_data[22].'</td></tr>';
					}
				}
				else{
					echo '<h4>No Data Found!</h4>';
				}
			}
			else{
					echo '<h4>No Data Found!</h4>';
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




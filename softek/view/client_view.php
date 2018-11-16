<div class="report_result">
		
<?php
	require '../lib/connection.php';
	

		if($_SERVER["REQUEST_METHOD"]=="POST" && $_SESSION['username']!= "" && !empty($_SESSION['username']) && isset($_SESSION['username']) && $_SESSION['insert_flag']==""){
			echo '<table>';
			/*echo '<table>
		<tr><th>CLIENT CODE</th><th>CLIENT NAME</th><th>CLIENT TYPE</th><th>CONTACT PERSON</th><th>DESIGNATION</th><th>CLIENT PHONE NO</th><th>SSS MARKETING PERSON</th><th>STATE</th><th>DISTRICT</th><th>CLIENT ADDRESS</th><th>PIN CODE</th><th>CLIENT EMAIL</th><th>REMARKS</th><th>UPDATED BY</th><th>UPDATE TIME</th><th>OPTIONS</th></tr>';*/

			$client_code=trim_data($_POST["client_code"]);
			$retrieve_data="SELECT `mm_client_master`.`client_id`, `mm_client_master`.`client_name`, `mm_product_master`.`product_type`, `mm_client_master`.`contact_person`, `mm_client_master`.`designation`, `mm_client_master`.`contact_no`, `mm_client_master`.`sss_man`, `mm_client_master`.`state`, `mm_client_master`.`district`, `mm_client_master`.`address`, `mm_client_master`.`pin_code`, `mm_client_master`.`email`, `mm_client_master`.`remarks`, `mm_client_master`.`client_status`, `mm_client_master`.`updated_by`, `mm_client_master`.`date_time` FROM `mm_client_master`, `mm_product_master` WHERE `mm_client_master`.`client_type` = `mm_product_master`.`product_id` and client_id='".$client_code."'";
			$report_result = mysqli_query($conn,$retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
						
							while($report_data = mysqli_fetch_array($report_result,MYSQLI_NUM)) {
					
								echo '<tr><th>CLIENT CODE</th><td>'.$report_data[0].'</td></tr><tr><th>CLIENT NAME</th><td>'.$report_data[1].'</td></tr><tr><th>CLIENT TYPE</th><td>'.$report_data[2].'</td></tr><tr><th>CONTACT PERSON</th><td>'.$report_data[3].'</td></tr><tr><th>DESIGNATION</th><td>'.$report_data[4].'</td></tr><tr><th>CLIENT PHONE NO</th><td>'.$report_data[5].'</td></tr><tr><th>SSS MARKETING PERSON</th><td>'.$report_data[6].'</td></tr><tr><th>STATE</th><td>'.$report_data[7].'</td></tr><tr><th>DISTRICT</th><td>'.$report_data[8].'</td></tr><tr><th>CLIENT ADDRESS</th><td>'.$report_data[9].'</td></tr><tr><th>PIN CODE</th><td>'.$report_data[10].'</td></tr><tr><th>CLIENT EMAIL</th><td>'.$report_data[11].'</td></tr><tr><th>REMARKS</th><td>'.$report_data[12].'</td></tr><tr><th>STATUS</th><td>'.$report_data[13].'</td></tr><tr><th>UPDATED BY</th><td>'.$report_data[14].'</td></tr><tr><th>UPDATED TIME</th><td>'.$report_data[15].'</td></tr>';
							if($_SESSION['access_type']=="AD"){
								echo	'<tr><th>OPTIONS</th><td><a href="client_edit.php?client_code='.$report_data[0].'" class ="edit_delete">EDIT</a><a href="javascript:delete_customer('.$report_data[0].')" class = "edit_delete">DELETE</a></td></tr>';
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
?>	
</div>




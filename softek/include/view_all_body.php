<div class="report_result">
		
<?php
	require '../lib/connection.php';
	
			echo '<table >
		<tr><th>CLIENT CODE</th><th>CLIENT NAME</th><th>CLIENT TYPE</th><th>CONTACT PERSON</th><th>DESIGNATION</th><th>CLIENT PHONE NO</th><th>SSS MARKETING PERSON</th><th>STATE</th><th>DISTRICT</th><th>CLIENT ADDRESS</th><th>PIN CODE</th><th>CLIENT EMAIL</th><th>REMARKS</th><th>STATUS</th><th>UPDATED BY</th><th>UPDATE TIME</th>';
							if($_SESSION['access_type']=="AD"){
								echo	'<th>OPTIONS</th></tr>';
							}

			$retrieve_data="SELECT `client_id`, `client_name`, `client_type`, `contact_person`, `designation`, `contact_no`, `sss_man`, `state`, `district`, `address`, `pin_code`, `email`, `remarks`, `client_status`, `updated_by`, `date_time` FROM `mm_client_master`";
			$report_result = mysqli_query($conn,$retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
						
							while($report_data = mysqli_fetch_array($report_result,MYSQLI_NUM)) {
					
								echo '<tr><td>'.$report_data[0].'</td><td>'.$report_data[1].'</td><td>'.$report_data[2].'</td><td>'.$report_data[3].'</td><td>'.$report_data[4].'</td><td>'.$report_data[5].'</td><td>'.$report_data[6].'</td><td>'.$report_data[7].'</td><td>'.$report_data[8].'</td><td>'.$report_data[9].'</td><td>'.$report_data[10].'</td><td>'.$report_data[11].'</td><td>'.$report_data[12].'</td><td>'.$report_data[13].'</td><td>'.$report_data[14].'</td><td>'.$report_data[15].'</td>';
							if($_SESSION['access_type']=="AD"){
								echo	'<td><a href="client_edit.php?client_code='.$report_data[0].'" class ="edit_delete">EDIT</a><a href="javascript:delete_customer('.$report_data[0].')" class = "edit_delete">DELETE</a></td></tr>';}

							}
						}
					}
					echo '</table>';
					function trim_data($data) {
							$data = trim($data);
							$data = strtoupper($data);
							return $data;
					}
?>	
</div>




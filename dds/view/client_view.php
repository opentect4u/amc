<div class="report_result">
		
<?php
	require '../lib/connection.php';
	

		if($_SERVER["REQUEST_METHOD"]=="POST" && $_SESSION['username']!= "" && !empty($_SESSION['username']) && isset($_SESSION['username']) && $_SESSION['insert_flag']==""){

			echo '<table >
		<tr><th>CLIENT CODE</th><th>CLIENT NAME</th><th>CLIENT ADDRESS</th><th>CLIENT PHONE</th><th>CLIENT EMAIL</th><th>UPDATED BY</th><th>UPDATE TIME</th><th>OPTIONS</th></tr>';

			$client_code=trim_data($_POST["client_code"]);
			$retrieve_data="SELECT `client_code`, `client_name`, `client_address`, `client_phone`, `client_email`, `updated_by`, `date_time` FROM `client_master` WHERE client_code='".$client_code."'";
			$report_result = mysqli_query($conn,$retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
							
							while($report_data = mysqli_fetch_array($report_result,MYSQLI_NUM)) {
								echo '<tr><td>'.$report_data[0].'</td><td>'.$report_data[1].'</td><td>'.$report_data[2].'</td><td>'.$report_data[3].'</td><td>'.$report_data[4].'</td><td>'.$report_data[5].'</td><td>'.$report_data[6].'</td><td><a href="client_edit.php?client_code='.$report_data[0].'" class ="edit_delete">EDIT</a><a href="javascript:delete_customer('.$report_data[0].')" class = "edit_delete">DELETE</a></td></tr>';

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




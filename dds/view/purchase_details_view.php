<div class="report_result">
		
<?php
	require '../lib/connection.php';
	

		if($_SERVER["REQUEST_METHOD"]=="POST" && $_SESSION['username']!= "" && !empty($_SESSION['username']) && isset($_SESSION['username']) && $_SESSION['insert_flag']==""){
			$count=0;
			echo '<table >
		<tr><th>CLIENT CODE</th><th>CLIENT NAME</th><th>INVOICE NO</th><th>ITEM TYPE</th><th>ITEM APPLICATION</th><th>QUANTITY</th></tr>';

			$client_code=trim_data($_POST["client_code"]);
			$retrieve_data="SELECT cli.client_code,cli.client_name,sa.invoice_no,it.item_type,it.item_application,sa.quantity FROM client_master cli, sales_master sa, item_master it WHERE cli.client_code = sa.client_code and it.item_code = sa.item_code and cli.client_code = '".$client_code."'";
			$report_result = mysqli_query($conn,$retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
							
							while($report_data = mysqli_fetch_array($report_result,MYSQLI_NUM)) {
								echo '<tr><td>'.$report_data[0].'</td><td>'.$report_data[1].'</td><td>'.$report_data[2].'</td><td>'.$report_data[3].'</td><td>'.$report_data[4].'</td><td>'.$report_data[5].'</td></tr>';
								$count=$count+$report_data[5];

							}
						}
					}
					echo '<tr><td></td><td></td><td></td><td></td><th>TOTAL QUANTITY</th><td>'.$count.'</td></tr>';
					echo '</table>';
					

				}
					function trim_data($data) {
							$data = trim($data);
							$data = strtoupper($data);
							return $data;
					}
?>	
</div>




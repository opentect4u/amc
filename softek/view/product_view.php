
<div class="report_result">

		
<?php
	require '../lib/connection.php';

		if($_SERVER["REQUEST_METHOD"]=="POST"){
			echo '<table >
		<tr><th>CLIENT TYPE CODE</th><th>CLIENT TYPE</th><th>UPDATED BY</th><th>UPDATE TIME</th>';
							if($_SESSION['access_type']=="AD"){
								echo	'<th>OPTIONS</th></tr>';}

			$product_code=trim_data($_POST["product_code"]);
			$retrieve_data="SELECT `product_id`, `product_type`, `updated_by`, `date_time` FROM `mm_product_master` WHERE product_id='".$product_code."'";
			$report_result = mysqli_query($conn,$retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
							while($report_data = mysqli_fetch_array($report_result,MYSQLI_NUM)) {
								echo '<tr><td>'.$report_data[0].'</td><td>'.$report_data[1].'</td><td>'.$report_data[2].'</td><td>'.$report_data[3].'</td>';
							if($_SESSION['access_type']=="AD"){
								echo	'<td><a href="product_edit.php?product_code='.$product_code.'" class = "edit_delete">EDIT</a><a href="javascript:delete_item('.$report_data[0].')" class = "edit_delete">DELETE</a></td></tr>';
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




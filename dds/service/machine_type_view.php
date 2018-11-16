
<div class="report_result">

		
<?php
	require '../../lib/connection.php';

		echo '<table>
		<tr><th>Serial No.</th><th>Machine Name</th></tr>';

			$item_code = trim_data($_POST["item_code"]);
			$retrieve_data = "SELECT `mc_id`,`mc_type` from mm_mc_type";
			$report_result = mysqli_query($conn,$retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
							
							while($report_data = mysqli_fetch_array($report_result,MYSQLI_NUM)) {

								echo '<tr><td>'.$report_data[0].'</td><td>'.$report_data[1].'</td></tr>';//<td><a href="machine_type_edit.php?item_code='.$report_data[0].'" class = "edit_delete" id="$item_code">EDIT</a></td></tr>';

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
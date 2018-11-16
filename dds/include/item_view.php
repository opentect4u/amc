
<div class="report_result">

		
<?php
	require 'lib/connection.php';

		if($_SERVER["REQUEST_METHOD"]=="POST"){
			echo '<table >
		<tr><th>ITEM CODE</th><th>ITEM TYPE</th><th>ITEM NAME</th><th>ITEM APPLICATION</th><th>UPDATED BY</th><th>UPDATE TIME</th><th>OPTIONS</th></tr>';

			$item_code=trim_data($_POST["item_code"]);
			$retrieve_data="SELECT `item_code`, `item_type`,`item_name`, `item_application`, `updated_by`, `date_time` FROM `item_master` WHERE item_code='".$item_code."'";
			$report_result = mysqli_query($conn,$retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
							
							while($report_data = mysqli_fetch_array($report_result,MYSQLI_NUM)) {
								echo '<tr><td>'.$report_data[0].'</td><td>'.$report_data[2].'</td><td>'.$report_data[1].'</td><td>'.$report_data[3].'</td><td>'.$report_data[4].'</td><td>'.$report_data[5].'</td><td><a href="view/item_edit.php?item_code='.$item_code.'" class = "edit_delete">EDIT</a><a href="javascript:delete_item('.$report_data[0].')" class = "edit_delete">DELETE</a></td></tr>';

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




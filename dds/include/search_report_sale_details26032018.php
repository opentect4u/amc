	
<?php
	include '../lib/connection.php';
	

		if($_SERVER["REQUEST_METHOD"]=="POST"){

			echo '<table >
		<tr><th>ITEM CODE</th><th>ITEM TYPE</th><th>ITEM NAME</th><th>TOTAL QUANTITY</th></tr>';
	 
			$start_date=convert_date1($_POST["starting_date"]);
			$end_date=convert_date1($_POST["end_date"]);
			//$date=$year.'-'.$month.'-%';
			$retrieve_data="SELECT item_master.item_code,item_master.item_type,item_master.item_application,sum(sales_master.quantity) FROM item_master, sales_master WHERE item_master.item_code = sales_master.item_code and sales_master.purchase_date BETWEEN '".$start_date."' and '".$end_date."' GROUP BY sales_master.item_code ";
			$report_result = mysqli_query($conn,$retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
							
							while($report_data = mysqli_fetch_array($report_result,MYSQLI_NUM)) {
								echo '<tr><td>'.$report_data[0].'</td><td>'.$report_data[1].'</td><td>'.$report_data[2].'</td><td>'.$report_data[3].'</td></tr>';

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

	function convert_date1($data){
          $data=date('Y-m-d',strtotime($data));
          return $data;
	}

?>	
</div>


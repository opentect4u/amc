
<script type="text/javascript">
	function printClaimDtls() {    
	  var divToPrint = document.getElementById('divToPrint');

	  var WindowObject = window.open('','Print-Window');
        WindowObject.document.open();
        WindowObject.document.writeln('<!DOCTYPE html>');
        WindowObject.document.writeln('<html><head><title></title>');

        WindowObject.document.writeln('<style type="text/css">@media print { .center { text-align: center;} table, th, td {border: 1px solid black; border-collapse: collapse; } } </style>');
       // WindowObject.document.writeln('<style type="text/css">@media print{p { color: blue; }}');
        WindowObject.document.writeln('</head><body onload="window.print()">');
        WindowObject.document.writeln(divToPrint.innerHTML);
        WindowObject.document.writeln('</body></html>');
        WindowObject.document.close();
        setTimeout(function(){WindowObject.close();},10);
    }
	</script>



<?php
	include '../lib/connection.php';
	

		if($_SERVER["REQUEST_METHOD"]=="POST"){
			echo "<div id='divToPrint'>";
			echo '<table class="border">
		<tr><th>ITEM CODE</th><th>ITEM TYPE</th><th>ITEM NAME</th><th>ITEM APPLICATION</th><th>TOTAL QUANTITY</th></tr>';
	 
			$start_date=convert_date1($_POST["starting_date"]);
			$end_date=convert_date1($_POST["end_date"]);
			//$date=$year.'-'.$month.'-%';
			$retrieve_data="SELECT item_master.item_code,item_master.item_type,item_master.item_name,item_master.item_application,sum(sales_master.quantity) FROM item_master, sales_master WHERE item_master.item_code = sales_master.item_code and sales_master.purchase_date BETWEEN '".$start_date."' and '".$end_date."' GROUP BY sales_master.item_code ";
			$report_result = mysqli_query($conn,$retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
							
							while($report_data = mysqli_fetch_array($report_result,MYSQLI_NUM)) {
								echo '<tr><td class="center">'.$report_data[0].'</td><td class="center">'.$report_data[1].'</td><td class="center">'.$report_data[2].'</td><td class="center">'.$report_data[3].'</td><td class="center">'.$report_data[4].'</td></tr>';

							}
						}
					}
					echo '</table>';
					echo "</div>";

					echo '<button class="edit_delete" onclick="printClaimDtls();">Print Report</button>';
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
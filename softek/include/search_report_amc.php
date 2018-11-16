	
<?php
	require '../lib/connection.php';
		$filter_string = "";
		$COUNT=0;
		$TOTAL_AMT=0;
		if($_SERVER["REQUEST_METHOD"]=="POST"){
			$f_search_based = $_POST["search_based"];
			$f_client_type = $_POST["client_type"];
			$f_district = $_POST["district"]; 
			$f_sss_man = $_POST["sss_man"]; 
			$f_invoice_type = $_POST["invoice_type"]; 
			$f_client_status = $_POST["client_status"]; 
 			
			$filter_string = filter_string($f_client_type, $f_district, $f_sss_man, $f_invoice_type, $f_client_status, $f_search_based);
			echo '<table class="new_report_table" >
		<tr><th>SRL NO.</th><th>CLIENT NAME</th><th>CLIENT TYPE</th><th>DISTRICT</th><th>PHONE NO.</th><th>SALES PRESON</th><th>BASIC AMOUNT</th><th>INV NO</th><th>TYPE</th><th>INV DT</th><th>START DT</th><th>END DT</th></tr>';
	 
			$start_date=convert_date1($_POST["starting_date"]);
			$end_date=convert_date1($_POST["end_date"]);
			//$date=$year.'-'.$month.'-%';
			$retrieve_data="select cli.client_name, 
									pro.product_type, 
									cli.district, 
									cli.contact_no, 
									cli.sss_man, 
									am.amount, 
									am.invoice_no,
									am.invoice_type, 
									am.invoice_date, 
									am.starting_date, 
									am.end_date 
							from mm_client_master cli, mm_order_master od, mm_amc_master am, mm_product_master pro 
							WHERE od.client_id = cli.client_id 
							and od.order_id = am.order_id 
							and cli.client_type = pro.product_id ".$filter_string."
							BETWEEN '".$start_date."'and '".$end_date."' 
							and am.amc_id in(SELECT max(am.amc_id) from mm_amc_master am group by am.order_id) 
							order by am.end_date ASC";
			$report_result = mysqli_query($conn,$retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
							
							while($report_data = mysqli_fetch_array($report_result,MYSQLI_NUM)) {
								$COUNT+=1;
								echo '<tr><td>'.$COUNT.'</td><td>'.$report_data[0].'</td><td>'.$report_data[1].'</td><td>'.$report_data[2].'</td><td>'.$report_data[3].'</td><td>'.$report_data[4].'</td><td>'.$report_data[5].'</td><td>'.$report_data[6].'</td><td>'.$report_data[7].'</td><td>'.convert_date($report_data[8]).'</td><td>'.convert_date($report_data[9]).'</td><td>'.convert_date($report_data[10]).'</td></tr>';
								$TOTAL_AMT+=$report_data[5];
							}
						}
					}
		echo '<tr><td></td><td></td><td></td><td></td><td></td><th>TOTAL AMOUNT:</th><td>'.$TOTAL_AMT.'</td><td></td><td></td><td></td><td></td><td></td></tr>';
					echo '</table>';
					echo'<form name="export_php" action="include/xl_report_amc.php" method="POST">
					<input type="hidden" name="starting_date" value="'.$start_date.'"/>
					<input type="hidden" name="end_date" value="'.$end_date.'"/> 
					<input type="hidden" name="client_type" value="'.$f_client_type.'"/> 
					<input type="hidden" name="district" value="'.$f_district.'"/> 
					<input type="hidden" name="sss_man" value="'.$f_sss_man.'"/> 
					<input type="hidden" name="invoice_type" value="'.$f_invoice_type.'"/>
					<input type="hidden" name="client_status" value="'.$f_client_status.'"/> 
					<input type="hidden" name="search_based" value="'.$f_search_based.'"/>  
					<input type="submit" name="pdf" value="Export To Excel" class = "submit">
					</form>';
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

function filter_string($f_client_type, $f_district, $f_sss_man, $f_invoice_type, $f_client_status, $f_search_based){
	$temp_string = "";
	if ($f_client_type != "ALL"){
		$temp_string .= " AND pro.product_id = ".$f_client_type; 	
	}
	if ($f_district != "ALL"){
		$temp_string .= " AND cli.district LIKE '".$f_district."'"; 	
	}
	if ($f_sss_man != "ALL"){
		$temp_string .= " AND cli.sss_man LIKE '".$f_sss_man."'"; 	
	}
	if ($f_invoice_type != "ALL"){
		$temp_string .= " AND am.invoice_type LIKE '".$f_invoice_type."'"; 	
	}
	if ($f_client_status != "ALL"){
		$temp_string .= " AND cli.client_status LIKE '".$f_client_status."'"; 	
	}
	if ($f_search_based == "START"){
		$temp_string .= " AND am.starting_date ";
	}else{
		$temp_string .= " AND am.end_date ";
	}
	return $temp_string;
}

?>	
</div>


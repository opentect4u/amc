<?php
include '../../lib/connection.php';
if($_SERVER["REQUEST_METHOD"]=="POST" && $_POST["pdf"]=="Export To Excel"){
	$COUNTpdf=0;
	$TOTAL_AMTpdf=0;
	$filter_string = "";
	$f_client_type = $_POST["client_type"];
	$f_district = $_POST["district"]; 
	$f_sss_man = $_POST["sss_man"]; 
	$f_invoice_type = $_POST["invoice_type"]; 
	$f_client_status = $_POST["client_status"];
	$f_search_based = $_POST["search_based"];
	$serial_array=array("SRL NO,CLIENT NAME,CLIENT TYPE,DISTRICT,PHONE NO.,SALES PRESON,BASIC AMOUNT,INV NO,TYPE,INV DT,START DT,END DT");
	$start_date=convert_date1($_POST["starting_date"]);
	$end_date=convert_date1($_POST["end_date"]);
	//$date=$year.'-'.$month.'-%';
	$filter_string = filter_string($f_client_type, $f_district, $f_sss_man, $f_invoice_type, $f_client_status, $f_search_based);
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
								$COUNTpdf+=1;
								array_push($serial_array,$COUNTpdf.",".$report_data[0].",".$report_data[1].",".$report_data[2].",".$report_data[3].",".$report_data[4].",".$report_data[5].",".$report_data[6].",".$report_data[7].",".convert_date($report_data[8]).",".convert_date($report_data[9]).",".convert_date($report_data[10]).",");
								$TOTAL_AMTpdf+=$report_data[5];
			}
			
		}
	}
	$filename = "amc_report" . date('dmY') . ".csv";
			header("Content-Disposition: attachment; filename=\"$filename\"");
  			header("Content-Type: text/csv");
			$out = fopen("php://output", 'w');
			
  foreach($serial_array as $array_data) {
      // display field/column names as first row
      fputcsv($out, explode(",",$array_data));
    }
	fclose($out);
  exit;

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
<table>
	<tr><th>INVOICE NO<th>ITEM TYPE</th><th>ITEM NAME</th></th><th>ITEM APPLICATION</th><th>CLIENT NAME</th><th>SERIAL NUMBER</th><th>PURCHASE DATE</th><th>WARRANTY PERIOD</th><th>REMARKS</th><th>WARRANTY STATUS</th></tr>
	<?php   
		if($_SERVER["REQUEST_METHOD"]=="POST" && $_SESSION['username']!= "" && !empty($_SESSION['username']) && isset($_SESSION['username']) && $_SESSION['login_flag']=="dds"){
		$item_code=trim_data($_POST["item_code"]);
		$serial_no=trim_data($_POST["item_serial"]);
		$retrieve_data="select i.item_code,i.item_type,c.client_name,ser.serial_no,s.purchase_date,s.warranty_period,s.remarks,s.invoice_no,i.item_name,i.item_application from item_master i,client_master c,sales_master s,serial_master ser where i.item_code=s.item_code and c.client_code=s.client_code and ser.sale_code=s.sale_code and i.item_code='".$item_code."' and ser.serial_no='".$serial_no."'";
		
		$report_result = mysqli_query($conn,$retrieve_data);
		if($report_result){
			while($report_data = mysqli_fetch_array($report_result,MYSQLI_NUM)) {
				echo '<tr><td>'.$report_data[7].'</td><td>'.$report_data[1].'</td><td>'.$report_data[8].'</td><td>'.$report_data[9].'</td><td>'.$report_data[2].'</td><td>'.$report_data[3].'</td><td>'.convert_date($report_data[4]).'</td><td>'.$report_data[5].'</td><td>'.$report_data[6].'</td>';
				$date = new DateTime($report_data[4]);
				$interval = new DateInterval('P'.$report_data[5].'M');
				$date->add($interval);
				$date2=date_create(date("Y-m-d"));					
				$diff=date_diff($date2,$date);				
				if((int)$diff->format("%R%a")<0){
					echo '<td style="color: red;">NOT IN WARRANTY</td></tr>';
				}
				else
					echo '<td style="color: green;">IN WARRANTY</td></tr>';
			}
		}
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
?>

</table>
	
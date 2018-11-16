
<?php 
	require '../lib/connection.php';
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$serial_code=trim_data($_GET["serial_code"]);
			$retrieve_data="SELECT `serial_code`, `sale_code`, `serial_no` FROM `serial_master` WHERE serial_code='".$serial_code."'";
			$report_result = mysqli_query($conn,$retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
							
							while($report_data = mysqli_fetch_array($report_result,MYSQLI_NUM)) {
								$serial_code =  $report_data[0];
								$sale_code =	 $report_data[1];
								$serial_no = $report_data[2];
							}
						}
					}
				
			}


		function trim_data($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		$data = strtoupper($data);
		return $data;
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>SYNERGIC ETIM SERIAL EDIT</title>
<link rel="stylesheet" type="text/css" href="style/style.css">
<script type="text/javascript">
	function valid_form(){
		
		var e= document.sales_form.serial_no.value;
		
		if (e.trim() == ""){
			document.getElementById('sales_epsno').innerHTML="Please Input Serial No";
			return false;
		}
		else
			return true;
	}
	
	function clr_psn(){
		document.getElementById('sales_epsno').innerHTML="";
	}
	
</script>

</head>
<body>
<div class="header">
		<?php require 'include/header.php';?>
	</div>
	<div class="nav_holder">
		<?php require 'include/nav.php';?>
	</div>
	<div>
<div class="sales_body">
<div class="sales_page">
	<h1>ETIM UPDATE SERIAL</h1>
	<form name="sales_form" method="POST" action="view/edit_serial.php" onsubmit="return valid_form()">
	<table>
		<tr>
		<td>Serial Code</td>
		<td><input type="text" name="serial_code" class="input_text" value="<?php echo $serial_code; ?>" readonly></td>
		<td id ="sales_serial" <span style='color: red;'></span></td>
		</tr>
		<tr>
		<td>Sales Code</td>
		<td><input type="text" name="sale_code" class="input_text" value="<?php echo $sale_code; ?>" readonly></td>
		<td id ="sales_einvoice" <span style='color: red;'></span></td>
		</tr>
		<tr>
		<td>Serial No</td>
		<td><input type="text" name="serial_no" class="input_text" onKeyDown= "clr_psn()" value="<?php echo $serial_no; ?>"></td>
		<td id ="sales_epsno" <span style='color: red;'></span></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" value="UPDATE" class="submit"/></td>
		</tr>
	</table>
	</form>
</div>
</div>
<div class = "footer" style="clear: both;">
		<?php require 'include/footer.php';?>
	</div>
</body>
</html>
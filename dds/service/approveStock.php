<?php
	require '../../lib/connection.php';
	if($_SERVER["REQUEST_METHOD"]=="GET"){
		$item_code = trim_data($_GET["item_code"]);
			$retrieve_data="SELECT * FROM `td_stock_in` WHERE bill_no = '$item_code' AND approval_status != 1";
			$report_result = mysqli_query($conn,$retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
					while($report_data = mysqli_fetch_array($report_result,MYSQLI_NUM)) {
							$in_date =	$report_data["0"];
							$in_no =	$report_data["1"];
							$comp_arrived_dt = $report_data["2"];
							$comp_sl_no =	$report_data["3"];
							$comp_qty = $report_data["4"];
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
<html>
<head>
<link rel="stylesheet" type="text/css" href="style/style.css">
<title>SYNERGIC EDIT STOCK</title>
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>
<script>

	$(document).ready(function($){
   		$("#date1").mask('99-99-9999');
});
	$(document).ready(function($){
   		$("#date1").css({"placeholder":"opacity:0.4"});
});


$(document).ready(function($){
$('#c_qty').on("change", function() {
	var qty = $(this).val()

	if(qty < 1){
		alert('Quantity must be grater than 1');
		$(this).val('');
		return false;
	}
	else{
		return true;
	}
});
});

</script>

</head>
<body>
<div class="header">
		<?php require 'header.php';?>
	</div>
	<div class="nav_holder">
		<?php require 'service_nav.php';?>
	</div>
<div class="item_body_container">
	<div class="item_body">
	<h1>STOCK</h1>
	<form name="add_user_form" method="POST" action="approve_stock.php">
		<table>
			<tr>
				<td>In No.</td>
				<td><input type="text" name="in_no" value="<?php echo $in_no;?>" id="date" class="input_text" readonly></td>
				<td id ="sales_epurchase" ><span style='color: red;'></span></td>
			</tr>
			<tr>
				<td>Date</td>
				<td><input type="text" value="<?php echo date('d-m-Y',strtotime($in_date));?>" id="date" class="input_text" readonly></td>
				<td id ="sales_epurchase" ><span style='color: red;'></span></td>
			</tr>
			<tr>
				<td>Component<br> Arrival Date</td>
				<td><input type="text" name="arrival_date" value="<?php echo date('d-m-Y',strtotime($comp_arrived_dt));?>" id="date1" placeholder="DD-MM-YYYY" class="input_text" required></td>
			</tr>
			<tr>
				<td>Component<br>Name</td>
				<td><?php
						require 'fetch_parts.php';
							echo '<select name="comp_name" class="input_select">';
							if (mysqli_num_rows($parts_result) > 0) {
								while($item_data = mysqli_fetch_assoc($parts_result)) {
									var_dump($item_data["sl_no"]);
									var_dump($comp_sl_no);?>
									<option value="<?php echo $item_data['sl_no']?>" <?php echo ($item_data["sl_no"] == $comp_sl_no)?"selected":""; ?>> <?php echo $item_data["sl_no"].' '.$item_data["parts_desc"];?></option>;
									<?php
								}
							}
						echo '</select>';
					?>
				</td>
			</tr>
			<tr>
				<td>Quantity</td>
				<td><input type="number" min="1" value="<?php echo $comp_qty; ?>" name="c_qty" id="c_qty" placeholder="Quantity of the Component" class="input_text" required></td>
				<td id ="sales_epurchase"><span style='color: red;'></span></td>
			</tr>
			<tr>
		         <td><input type="hidden" value="1" name="approved"></td>
		         <td><input type="submit" value="Approve" class="submit"></td>
			</tr>
		</table>
	</form>
</div>
</div>
</body>
</html>

<?php
	require '../../lib/connection.php';
	if($_SERVER["REQUEST_METHOD"]=="GET" && $_SESSION['username']){
		$bill_no = trim_data($_GET["bill_no"]);
			$retrieve_data="SELECT * FROM `td_stock_in`
			                         WHERE bill_no = '$bill_no'";
			$report_result = mysqli_query($conn, $retrieve_data);
			$report_result1 = mysqli_query($conn, $retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
					while($report_data = mysqli_fetch_array($report_result, MYSQLI_NUM)) {
								$in_date = $report_data["0"];
								$billNo =	$report_data["1"];
								$comp_arrived_dt = $report_data["3"];
								$center_name = $report_data["6"];
								break;
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
	<link rel="icon" href="../../favicon.ico">
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
	<script type="text/javascript">
	$(document).ready(function(){
		$('#date1').on("change", function() {
	      var today = new Date();

	      var to_date = $('#date1').val().split("-");
	      var mydate = new Date(to_date[2], to_date[1] - 1, to_date[0]);

	      if (mydate > today) {
	        alert("Arrival date can't be grater than system date!");
	        $('#date1').val('');
	        return false;
	      }
	     });

		$('#addRow').click(function(){

			 $('#addAnother').append('<tr><td><?php	require "fetch_parts.php";?> <select name="comp_sl_no[]" class="input_select blkSelected" style="width:250px;"><option>Select</option><?php while($item_data = mysqli_fetch_assoc($parts_result)) {$sl_no = $item_data["sl_no"];$parts_desc = $item_data["parts_desc"];	?><option value="<?php echo $sl_no; ?>"><?php echo $sl_no.' '.$parts_desc;?></option> <?php	}?>	</select></td><td><input type="number" min="1" name="qty[]" id="c_qty" class="input_text" style="width:75px;" required></td><td ><button class="removeRow" type="button" style="background-color: #f44336; border: none;color: white;padding: 5px 2px; text-align: center;text-decoration: none; display: inline-block; font-size: 16px;">Remove Row</button></td></tr>');
			 $('.blkSelected').change();
	  });

		$('#addAnother').on('click', '.removeRow', function(){
			 $(this).parent().parent().remove();
		});

		$('#addAnother').on('change', '.blkSelected', function(){
			$('.blkSelected').each(function(){
				$('.blkSelected').find('option[value ="' + this.value + '"]').attr("disabled", true);
			});
		});

		$('#submit').click( function(){

			$('.blkSelected').each(function(){
				$('.blkSelected').find('option[value ="' + this.value + '"]').attr("disabled", false);
			});
			$('#submit').prop('type', 'submit');
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
				<form method="POST" action="edit_stock.php">
					<table>
						<tr>
							<td>Bill No.</td>
							<td><input type="text" name="billNo" value="<?php echo $billNo;?>" id="date" class="input_text" readonly></td>
							<td id ="sales_epurchase" ><span style='color: red;'></span></td>
						</tr>
						<tr>
							<td>Date</td>
							<td><input type="text" name="in_date" value="<?php echo date('d-m-Y',strtotime($in_date));?>" id="date" class="input_text" readonly></td>
							<td id ="sales_epurchase" ><span style='color: red;'></span></td>
						</tr>
						<tr>
							<td>Component<br> Arrival Date</td>
							<td><input type="text" name="arrival_date" value="<?php echo date('d-m-Y',strtotime($comp_arrived_dt));?>" id="date1" placeholder="DD-MM-YYYY" class="input_text" required></td>
						</tr>
						<tr>
							<td>Service Center<br> Name</td>
							<td><?php
								require 'fetch_service_center.php';
									echo '<select name="servCenName" class="input_select" >';
									if (mysqli_num_rows($result) > 0) {
										while($item_data = mysqli_fetch_assoc($result)) {
											?>
											<option value="<?php echo $item_data['center_name'];?>" <?php echo ($center_name == $item_data['center_name'])? 'selected':'';?>><?php echo $item_data['center_name'];?></option>
							<?php
										}
									}
								echo '</select>';
							?></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="button" id="addRow" value="Add Row" class="submit" style="background-color:green"></td>
						</tr>
					</table>

					<table id="addAnother" style="margin-left: 115px;">
						<tr>
							<th style="text-align: center;">
								Component Name
							</th>
							<th>
								Quantity
							</th>
						</tr>
						<?php $i=0;
						 while($report_data1 = mysqli_fetch_array($report_result1, MYSQLI_NUM)) { $i++;
							echo '<tr><td>';
												require 'fetch_parts.php';
													echo '<select name="comp_sl_no[]" class="input_select blkSelected" style="width:250px;">
																	<option value="0">Select</option>';
																		while($item_data = mysqli_fetch_array($parts_result, MYSQLI_NUM)) {?>
																			<option value="<?php echo $item_data[0]; ?>"
																						<?php echo ($item_data[0] == $report_data1[4])? 'selected':''?>><?php echo $item_data[0].' '.$item_data[1];?> </option>;
					  <?php
																		}
													echo '</select>';

								echo '</td>
											<td><input type="number" min="1" name="qty[]" id="c_qty" value="'.$report_data1[5].'" class="input_text" style="width:75px;" required></td>';
										if ($i > 1) {
											echo '</td><td ><button class="removeRow" type="button" style="background-color: #f44336; border: none;color: white;padding: 5px 2px; text-align: center;text-decoration: none; display: inline-block; font-size: 16px;">Remove Row</button></td></tr>';
										}else{
											echo '</tr>';
										}
						}
						?>
					</table>

					<table style="margin-left:225px;">
						<tr>
							<td></td>
					    <td><input id="submit" type="button" value="Submit" class="submit"></td>

						</tr>
					</table>
				</form>
			</div>
		</div>
	</body>
</html>

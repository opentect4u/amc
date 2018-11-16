<script type="text/javascript">
	//var global_var = 0;
</script>
<?php
	require '../../lib/connection.php';
	if($_SERVER["REQUEST_METHOD"]=="GET"){
		$memo_no = trim_data($_GET["memo_no"]);
			$retrieve_data = "SELECT * FROM `td_damage_out`
			                           WHERE memo_no = '$memo_no'";
			$report_result = mysqli_query($conn, $retrieve_data);
			$report_result1 = mysqli_query($conn, $retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
					while($report_data = mysqli_fetch_array($report_result, MYSQLI_NUM)) {
								$trf_date = $report_data["0"];
								$memo_no =	$report_data["1"];
								$order_by = $report_data["2"];
								$centerName = $report_data["3"];
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
				<form method="POST" action="edit_damage.php">
					<table>
            			<tr>
							<td>Date</td>
							<td><input type="text" name="in_date" value="<?php echo date('d-m-Y',strtotime($trf_date));?>" id="date" class="input_text" readonly></td>
							<td id ="sales_epurchase" ><span style='color: red;'></span></td>
						</tr>
						<tr>
							<td>Memo No.</td>
							<td><input type="text" name="memoNo" id="memoNo" value="<?php echo $memo_no;?>" class="input_text"></td>
						</tr>
            			<tr>
		        			<td>Order By</td>
		        			<td><input type="text" name="orederBy" id="orederBy" placeholder="Ordered By" value="<?php echo $order_by;?>" class="input_text"></td>
	        			</tr>
	        			<tr>
							<td>Service Center<br> Name</td>
							<td><?php
								require 'fetch_service_center.php';

									echo '<select name="servCenName" id="centerName" class="input_select">';
									if (mysqli_num_rows($result) > 0) {
										while($item_data = mysqli_fetch_assoc($result)) {
											?>
											<option value="<?php echo $item_data['center_name'];?>" <?php echo ($centerName == $item_data['center_name'])?'selected':'';?>><?php echo $item_data['center_name'];?></option>
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

					<table id="addAnother">
						<tr>
							<th style="text-align: center;">
								Component Name
							</th>
							<th>
								Quantity
							</th>
							<th>
								Remarks
							</th>
						</tr>
						<?php $count = 0;
						 while($report_data1 = mysqli_fetch_array($report_result1, MYSQLI_NUM)) { $count++;
							echo '<tr><td>';
									require 'fetch_parts.php';
										echo '<select name="comp_sl_no[]" class="input_select blkSelected" id="compNo'.$count.'" style="width:250px;">
														<option value="0">Select</option>';
															while($item_data = mysqli_fetch_array($parts_result, MYSQLI_NUM)) {?>
																<option value="<?php echo $item_data[0]; ?>"
																			<?php echo ($item_data[0] == $report_data1[4])? 'selected':''?>><?php echo $item_data[0].' '.$item_data[1];?> </option>;
					  <?php
																		}
										echo '</select>';

								echo '</td>
									  <td><input type="number" min="1" name="qty[]" id="'.$count.'" value="'.$report_data1[4].'" class="input_text qty" style="width:75px;" required></td><td><textarea type="text" class="input_text" name="remarks[]" style="width:255px;" required>'.$report_data1[6].'</textarea></td>';
										if ($count > 1) {
											echo '</td><td><button class="removeRow" type="button" style="background-color: #f44336; border: none;color: white;padding: 5px 2px; text-align: center;text-decoration: none; display: inline-block; font-size: 16px;">Remove Row</button><td class="cnt" id="w'.$count.'"></td></tr>';
										}else{
											echo '<td class="cnt" id="w'.$count.'"></td></tr>';
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

<script type="text/javascript">
		var count = <?php echo $count;?> ;
		  $(document).ready(function(){
			    $('#addRow').click(function(){
			    	count++;
					$('#addAnother').append('<tr><td><?php require "fetch_parts.php";?> <select name="comp_sl_no[]" class="input_select blkSelected" id="compNo'+count+'" style="width:250px;"><option>Select</option><?php while($item_data = mysqli_fetch_assoc($parts_result)) {$sl_no = $item_data["sl_no"];$parts_desc = $item_data["parts_desc"];	?><option value="<?php echo $sl_no; ?>"><?php echo $sl_no.' '.$parts_desc;?></option> <?php	}?>	</select></td><td><input type="number" min="1" name="qty[]" id="'+count+'" class="input_text qty" style="width:75px;" required></td><td><textarea type="text" class="input_text" name="remarks[]" style="width:255px;" required></textarea></td><td><button class="removeRow" type="button" style="background-color: #f44336; border: none;color: white;padding: 5px 2px; text-align: center;text-decoration: none; display: inline-block; font-size: 16px;">Remove Row</button></td><td class="cnt" id="w'+count+'"></td></tr>');
					$('.blkSelected').change();
				});

				$('#addAnother').on('click', '.removeRow', function(){
					 $(this).parent().parent().remove();
				});

				$('#addAnother').on('change', '.blkSelected', function(){
					
					$('.blkSelected').each(function(){
						$('.blkSelected').find('option[value ="' + this.value + '"]').toggle(false);
					});
				});

				$('#addAnother').on('change', '.qty',function(){
					
					var comp_qty = $(this).val(),
						id = $(this).attr('id'),
						comp_no = $('#compNo' + id).val(),
						serv_area = $('#centerName').val();
						
					$.get("<?php echo $l_dds_check_stock_qty ?>", {comp_no: comp_no, serv_area: serv_area}).done(function(data){
						if (!data) {
							data = 0;
						}
						if (parseInt(data) < comp_qty) {
							
						   $('#' + id).val('');
						   $('#w' + id).show();
						   $('#w' + id).html('<span style="color: red;">Quantity exceeded</span>');
						}
						else{
							$('#w' + id).hide();
						}
					});
				});

				$('#submit').click( function(){
					$('#submit').prop('type', 'submit');
				});

				$('.blkSelected').change();
		   });
	  	</script>
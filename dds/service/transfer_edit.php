<?php
	require '../../lib/connection.php';
	if($_SERVER["REQUEST_METHOD"]=="GET"){
		$trf_no = trim_data($_GET["trf_no"]);
			$retrieve_data="SELECT * FROM `td_transfer`
			                         WHERE trf_no = '$trf_no'";
			$report_result = mysqli_query($conn, $retrieve_data);
			$report_result1 = mysqli_query($conn, $retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
					while($report_data = mysqli_fetch_array($report_result, MYSQLI_NUM)) {
								$trf_date = $report_data["0"];
								$trf_no =	$report_data["1"];
								$trf_mode = $report_data["2"];
								$from_place = $report_data["3"];
                $to_place = $report_data["4"];
								$remarks =	$report_data["7"];
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
  <script type="text/javascript">
  $(document).ready(function(){
    if($(this).val() == 'SILIGURI'){
      $('#trnsTo').val('KOLKATA (HO)');
    }
    else{
      $('#trnsTo').val('SILIGURI');
    }

  	$('#trnsFrom').change(function(){
       if($(this).val() == 'SILIGURI'){
         $('#trnsTo').val('KOLKATA (HO)');
       }
       else{
         $('#trnsTo').val('SILIGURI');
       }
    });

    $('#addRow').click(function(){
			 $('#addAnother').append('<tr><td><?php	require "fetch_parts.php";?> <select name="comp_sl_no[]" class="input_select blkSelected" style="width:250px;"><option>Select</option><?php while($item_data = mysqli_fetch_assoc($parts_result)) {$sl_no = $item_data["sl_no"];$parts_desc = $item_data["parts_desc"];	?><option value="<?php echo $sl_no; ?>"><?php echo $sl_no.' '.$parts_desc;?></option> <?php	}?></select></td><td><input type="number" min="1" name="qty[]" id="c_qty" class="input_text" style="width:75px;" required></td><td><button class="removeRow" type="button" style="background-color: #f44336; border: none;color: white;padding: 5px 2px; text-align: center;text-decoration: none; display: inline-block; font-size: 16px;">Remove Row</button></td></tr>');
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
				<form method="POST" action="edit_transfer.php">
					<table>
            <tr>
							<td>Date</td>
							<td><input type="text" name="in_date" value="<?php echo date('d-m-Y',strtotime($trf_date));?>" id="date" class="input_text" readonly></td>
							<td id ="sales_epurchase" ><span style='color: red;'></span></td>
						</tr>
						<tr>
							<td>Transfer No.</td>
							<td><input type="text" name="trfNo" value="<?php echo $trf_no;?>" id="date" class="input_text" readonly></td>
							<td id ="sales_epurchase" ><span style='color: red;'></span></td>
						</tr>
            <tr>
        			<td>Transfer<br>Mode</td>
        			<td><select type="text" name="trfMode" id="trfMode" class="input_select">
                    <option value="Courier" <?php echo ($trf_mode == 'Courier')?'selected':'';?>>Courier</option>
                    <option value="Transport" <?php echo ($trf_mode == 'Transport')?'selected':'';?>>Transport</option>
                    <option value="Manually" <?php echo ($trf_mode == 'Manually')?'selected':'';?>>Manually</option>
                  </select>
              </td>
        		</tr>
            <tr>
        			<td>Transfer<br>From</td>
        			<td><?php
        				require 'fetch_service_center.php';
        					echo '<select name="trnsFrom" id="trnsFrom" class="input_select" >';
        					if (mysqli_num_rows($result) > 0) {
        						while($item_data = mysqli_fetch_assoc($result)) {
        							?>
        							<option value="<?php echo $item_data['center_name'];?>" <?php echo ($item_data['center_name'] == $from_place)?'selected':'';?>><?php echo $item_data['center_name'];?></option>
        			<?php
        						}
        					}
        				echo '</select>';
        			?>
              </td>
        		</tr>
        		<tr>
        			<td>Transfer To</td>
        			<td><input type="text" name="trnsTo" id="trnsTo" class="input_text" readonly></td>
        		</tr>
            <tr>
              <td>Remarks</td>
              <td><textarea type="text" class="input_textarea" name="remarks" required><?php echo $remarks;?></textarea></td>
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
																						<?php echo ($item_data[0] == $report_data1[5])? 'selected':''?>><?php echo $item_data[0].' '.$item_data[1];?> </option>;
					  <?php
																		}
													echo '</select>';

								echo '</td>
											<td><input type="number" min="1" name="qty[]" id="c_qty" value="'.$report_data1[6].'" class="input_text" style="width:75px;" required></td>';
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

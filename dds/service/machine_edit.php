

<?php require '../../lib/connection.php';

	$item_code = $_GET['item_code'];
	
		$sql = "SELECT * FROM td_new_machine WHERE batch_no = $item_code";


		$query = mysqli_query($conn,$sql);

		if ($query) {
			while($data = mysqli_fetch_assoc($query)) {
				
				$entry_date = $data['entry_date'];

				$batch_no = $data['batch_no'];
				$cust_code = $data['cust_code'];
				$mc_type = $data['mc_type'];
				$mc_qty = $data['qty'];
				$serv_area = $data['serv_area'];
			}
		}


		$sql = "SELECT * FROM td_mc_sl WHERE batch_no = $item_code";


		$query = mysqli_query($conn,$sql);

		if ($query) {
			$i = 0;
			while($data = mysqli_fetch_assoc($query)) {
				$mc_no[$i] = $data['mc_no'];
				$i++;
				
			}
		}

?>
<!DOCTYPE html>
<html>
<head>
	<title>SYNERGIC EDIT MACHINE</title>
	<link rel="icon" href="../../favicon.ico">
<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>
<script type="text/javascript">
 $(document).ready(function(){
 	$("#mc_qty").change( function(){
    	var b = $('.count').attr('id');
    	var x = document.getElementById("mc_qty").value;
    			
    			document.getElementById("addrow").style.display = "none";
    	var c = x-b;

    	for(var i=0; i < c; i++) {
    		
    		$("#intro").append('<tr><td style="margin-left:50px;"><input type="text" name="mc_no[]" class="input_select"></td></tr>');
    	}

    	$("#intro").append('<tr><td><input type="submit" id="addrow" value="Update" class="submit"></td></tr>');

    	$('#mc_qty').attr('readonly', true);

      });
  });
	
	
</script>
<body>
	<div class="header">
		<?php require 'header.php';?>
	</div>
	<div class="nav_holder">
		<?php require 'service_nav.php';?>
	</div>
	<?
	//echo($recvd_dt);die;?>
	<div class= "item_body_container">
		<div class="item_body">
		
		<form method="POST" action="edit_machine.php">
			<input type="hidden" id="cust_id" name="cust_id"/>
			<table>
				<tr>
					<td>Entry Date</td>
					<td><input type="text" class="input_select" value="<?php echo date('d-m-Y',strtotime($entry_date));?>" readonly></td>
				</tr>
				<tr>
					<td>Batch Number</td>
					<td><input type="text" id="batch_no" class="input_select" value="<?php echo $batch_no;?>" name="batch_no" readonly></td>
				</tr>
			  	<tr>
					<td>Machine Type</td>
					<td>
					<?php require 'fetch_machine_type.php';
					if(mysqli_num_rows($machine_result) > 0) {
							echo '<select name="mc_type" class="input_select">';
							while($item_data = mysqli_fetch_assoc($machine_result)) {
								?>
								<option value="<?php echo $item_data['mc_type']; ?>" <?php echo ($item_data['mc_type'] == $mc_type)? 'selected':'';?> ><?php echo $item_data['mc_type'];?></option>
						<?php
							}
						echo "</select>";
						}
						?>
					</td>
				</tr>
				<tr>
					<td>Service Center<br> Name</td>
					<td><?php
						require 'fetch_service_center.php';

							echo '<select name="servCenName" class="input_select" >';
							if (mysqli_num_rows($result) > 0) {
								while($item_data = mysqli_fetch_assoc($result)) {
									?>
									<option value="<?php echo $item_data['center_name'];?>" <?php echo ($serv_area == $item_data['center_name'])? 'selected':'';?>><?php echo $item_data['center_name'];?></option>
					<?php
								}
							}
						echo '</select>';
					?></td>
				</tr>
				<tr>
					<td>Machine<br>Quantity</td>
					<td><input type="number" id="mc_qty" class="input_select" value="<?php echo $mc_qty;?>" name="mc_qty"></td>
				</tr>
			</table>

			<table style="margin-left: 120px;">
				<tr><th>Machine Serial No</th></tr>
				<tbody id="intro">
					<?php
					$count = 0;
						for ($i=0; $i < sizeof($mc_no); $i++) {?>
							<tr>
								<td><input type="text" name="mc_no[]" class="input_select" value="<?php echo $mc_no[$i]; ?>"></td>					
							</tr>

							
							
					<?php
						$count = $i+1;
						}


					?>
					<div class="count" id="<?php echo $count; ?>" value=""></div>
					<tr><td><input type="submit" id="addrow" value="Update" class="submit"></td></tr>
				</tbody>
			</table>
		</form>	
		</div>
	</div>
</body>

<?php include '../../lib/connection.php'; ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style/style.css">
<title>SYNERGIC ETIM EDIT ITEM
</title>
	<link rel="icon" href="../favicon.ico">
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/jquery.maskedinput.js" type="text/javascript"></script>
	<script>
	$(document).ready(function($){
   		$("#date").mask("99-99-9999");
	});
		$(document).ready(function($){
	   		$("#date").css({"placeholder":"opacity:0.4"});
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
			

			<?php

			if($_SERVER['REQUEST_METHOD'] == "GET"){
			?>

			<div class="item_body">

				<h1>ITEM REPORT</h1>
				<form name="add_item_form" method="POST" action="" onsubmit="return valid_form()">
				<table>
					<tr>
						<td>Till Date</td>
						<td><input type="text" name="item_date" id="date" value="<?php echo date('d-m-Y');?>" placeholder="DD-MM-YYYY" class="input_text" onKeyUp="prchsedate_chk()" onKeyDown="clr_pdate()"></td>
						<td id ="sales_epurchase" ><span style='color: red;'></span></td>
					</tr>
					<tr>
						<td>Item</td>
						<td>
							<select name="item_code" class="input_select">

								<option>Select Item</option>

								<option value='1'>Parts</option>

								<option value='2'>Machine</option>

							</select>	
						</td>
					</tr>
					<tr>
						<td>Service<br>Center</td>
						<td><?php
							require 'fetch_service_center.php';

								echo '<select name="srv_cen" id="trnsFrom" class="input_select" >';
								if (mysqli_num_rows($result) > 0) {
									while($item_data = mysqli_fetch_assoc($result)) {
										?>
										<option value="<?php echo $item_data['center_name'];?>"><?php echo $item_data['center_name'];?></option>
						<?php
									}
								}
							echo '</select>';
						?>
			      		</td>
					</tr>
					<tr>
			         <td></td>
			         <td><input type="submit" value="Proceed" class="submit"></td>
					</tr>
				</table>
				</form>

			</div>
				
				<?php

				}

				else if ($_SERVER['REQUEST_METHOD'] == "POST"){

					if($_POST['item_code'] == 1) {

						$date = date("Y-m-d", strtotime($_POST['item_date']));
						$srv_cen = $_POST['srv_cen'];

						$res_data1['comp_name'] =
						$res_data1['balance_dt'] =
						$res_data1['stk_quantity'] = array();

						$sql = "SELECT comp_name, 
									   MAX(balance_dt) balance_dt 
									   FROM gm_stock_balance
									   				WHERE balance_dt <= '$date'
									   				AND serv_area = '$srv_cen' 
									   				GROUP BY comp_name";
						

						$result = mysqli_query($conn, $sql);

						while ($data = mysqli_fetch_assoc($result)) {

							$comp_name  = $data['comp_name'];
							$balance_dt = $data['balance_dt'];
							$trf_no		= $data['trf_no'];

							$sql1 = "SELECT comp_name, 
										   balance_dt, 
										   MAX(trf_no) trf_no,
										   flag,
										   stock,
										   stk_quantity FROM gm_stock_balance
														   WHERE comp_name = '$comp_name' AND balance_dt = '$balance_dt' AND serv_area = '$srv_cen'
														   GROUP BY comp_name, balance_dt, flag, stock, stk_quantity";
							$result1 = mysqli_query($conn, $sql1);

							$data1 = mysqli_fetch_assoc($result1);

							array_push($res_data1['comp_name'], $data1['comp_name']);
							array_push($res_data1['balance_dt'], $data1['balance_dt']);
							array_push($res_data1['stk_quantity'], $data1['stk_quantity']);
						}
							
				?>

				<div class="report_result">

					<h1>Parts Stocks</h1>

					<table width="100%">

						<tr>

							<th>Sl No.</th>
							<th>Name.</th>
							<th>Till Date</th>
							<th>Quantity</th>
							
						</tr>

						<?php		
						
						for ($i = 0; $i < count($res_data1['comp_name']); $i++) {

						?>
						
							<tr>
								
								<td><?php echo $i+1; ?></td>

								<td><?php echo $res_data1['comp_name'][$i]; ?></td>

								<td><?php echo date("d-m-Y", strtotime($res_data1['balance_dt'][$i]));?></td>

								<td><?php echo $res_data1['stk_quantity'][$i]; ?></td>

							</tr>

						<?php		
							
						}

						?>

					</table>
				

				</div>

				<?php

					}

					else if($_POST['item_code'] == 2) {

					$date = date("Y-m-d", strtotime($_POST['item_date']));
					$serv_area = $_POST['srv_cen'];

						$res_data2['mc_type'] =
						$res_data2['balance_dt'] =
						$res_data2['total_stock'] = array();

						$sql = "SELECT mc_type, 
									   MAX(balance_dt) balance_dt,
									   MAX(sl_no) sl_no
									   FROM gm_mc_stock
									   				WHERE balance_dt <= '$date' 
									   				AND serv_area = '$serv_area'
									   				GROUP BY mc_type";
						
						$result = mysqli_query($conn, $sql);
						
						while ($data = mysqli_fetch_assoc($result)) {

							$mc_type  = $data['mc_type'];
							$balance_dt = $data['balance_dt'];
							$sl_no = $data['sl_no'];

							$sql1 = "SELECT mc_type, 
										   balance_dt, 
										   total_stock FROM gm_mc_stock
									   				   WHERE mc_type = '$mc_type' AND balance_dt = '$balance_dt' AND sl_no = $sl_no AND serv_area = '$serv_area'";
							$result1 = mysqli_query($conn, $sql1);
							
							$data1 = mysqli_fetch_assoc($result1);

							array_push($res_data2['mc_type'], $data1['mc_type']);
							array_push($res_data2['balance_dt'], $data1['balance_dt']);
							array_push($res_data2['total_stock'], $data1['total_stock']);
							
						}

						
							
				?>

				<div class="report_result">

					<h1>Machine Stocks</h1>

					<table width="100%">

						<tr>

							<th>Sl No.</th>
							<th>Name.</th>
							<th>Till Date</th>
							<th>Quantity</th>
							
						</tr>

						<?php		
						
						for ($i = 0; $i < count($res_data2['mc_type']); $i++) {

						?>
						
							<tr>
								
								<td><?php echo $i+1; ?></td>

								<td><?php echo $res_data2['mc_type'][$i]; ?></td>

								<td><?php echo date("d-m-Y", strtotime($res_data2['balance_dt'][$i]));?></td>

								<td><?php echo $res_data2['total_stock'][$i]; ?></td>

							</tr>

						<?php		
							
						}

						?>

					</table>

				</div>

				<?php
					}

				}
				?>
			
		</div>
	</body>
</html>

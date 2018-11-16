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

<style type="text/css">

	td {border: none}

	p {
		display: inline;
	}
</style>

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

				<h1>SERVICE DETAILS REPORT</h1>
				<form name="add_item_form" method="POST" action="" onsubmit="return valid_form()">
				<table>
					<tr>
						<td>Till Date</td>
						<td><input type="text" name="item_date" id="date" placeholder="DD-MM-YYYY" value="<?php echo date('d-m-Y');?>" class="input_text" onKeyUp="prchsedate_chk()" onKeyDown="clr_pdate()"></td>
						<td id ="sales_epurchase" ><span style='color: red;'></span></td>
					</tr>
					<tr>
						<td>Service Center</td>
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

				else if ($_SERVER['REQUEST_METHOD'] == "POST") { 

					$array['cust_name'] = 
					$array['mc_type'] = 
					$array['tot_stock'] = [];
					$count = 0;
					$recvd_dt = date('Y-m-d',strtotime($_POST['item_date']));;
					$srv_cen = $_POST['srv_cen'];

					$sql = "SELECT DISTINCT cust_code 
								   					  FROM td_customer_tkt 
													  WHERE approve_flag = 1
											   		  AND recvd_dt <= '$recvd_dt'
											   		  AND serv_area = '$srv_cen' 
											   		  ";
											   		  

					$result = mysqli_query($conn, $sql);

					//echo $sql."<br>";

					while ($data = mysqli_fetch_assoc($result)) {
						
						$count;
						
						//For Customer Name
						$cNameSql = "SELECT client_name FROM client_master 
													    WHERE client_code = ".$data['cust_code']."";


						$res = mysqli_query($conn, $cNameSql);

						$name = mysqli_fetch_assoc($res);

						array_push($array['cust_name'], $name['client_name']);
						
						$sql4 = "SELECT tkt_no FROM td_customer_tkt 
											   WHERE cust_code = ".$data['cust_code']."
											   AND serv_area = '$srv_cen'";

													  
						$result4 = mysqli_query($conn, $sql4);

						$flag1 = 0;
						while ($data1 = mysqli_fetch_assoc($result4)) {


							
							$sql = "SELECT mc_type, sum(qty) qty FROM gm_mc_stock
													    		 WHERE tkt_no = ".$data1['tkt_no']."
													    		 AND status = 'R'
													    		 AND serv_area = '$srv_cen' 
													    		 GROUP BY mc_type";

							
							$result5 = mysqli_query($conn, $sql);

							$data   = mysqli_fetch_assoc($result5);

							

							$sql2 = "SELECT mc_type, sum(qty) qty FROM gm_mc_stock
													    		 WHERE tkt_no = ".$data1['tkt_no']."
													    		 AND status = 'RO'
													    		 AND serv_area = '$srv_cen' 
													    		 GROUP BY mc_type";

							
							$result2 = mysqli_query($conn, $sql2);

							$data2   = mysqli_fetch_assoc($result2);
							

							if($flag1 == 0) {

								array_push($array['mc_type'], $data['mc_type']);
								array_push($array['tot_stock'], $data['qty'] - $data2['qty']);
								
							}
							else{

								$array['tot_stock'][$count] = $array['tot_stock'][$count] + $data['qty'] - $data2['qty'];
								
							}
							
							$flag1++;

						}

						$count ++;
					}
					
			?>
			<div class="report_result">

				<table width="100%">

					<tr>
						<th>Sl No.</th>
						<th>Customer Name</th>
						<th>Application Name</th>
						<th>Balance</th>
					</tr>

					<?php

						for ($i=0; $i < count($array['cust_name']); $i++) {

							if ($array['tot_stock'][$i] == '0') {
								continue;								
							}
						 ?>

							<tr>
								<td><?php echo $i+1;?></td>
								<td><?php echo $array['cust_name'][$i];?></td>
								<td><?php echo $array['mc_type'][$i];?></td>
								<td><?php echo $array['tot_stock'][$i];?></td>
							</tr>

					<?php		
							
						}
					?>
					
				</table>
			</div>
			<?php		
				}

			?>


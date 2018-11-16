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
						<td>From Date</td>
						<td><input type="text" name="from_date" id="date" placeholder="DD-MM-YYYY" value="<?php echo date('d-m-Y');?>" class="input_text" onKeyUp="prchsedate_chk()" onKeyDown="clr_pdate()"></td>
						<td id ="sales_epurchase" ><span style='color: red;'></span></td>

                    </tr>

                    <tr>    
                        <td>To Date</td>
						<td><input type="text" name="to_date" id="date" placeholder="DD-MM-YYYY" value="<?php echo date('d-m-Y');?>" class="input_text" onKeyUp="prchsedate_chk()" onKeyDown="clr_pdate()"></td>
						<td id ="sales_epurchase" ><span style='color: red;'></span></td>
					</tr>
					<tr>
						<td>Service Engineer</td>
						<td><?php
							require 'fetch_service_engineer.php';

								echo '<select name="srv_eng" id="trnsFrom" class="input_select" >';
								if (mysqli_num_rows($result) > 0) {
									while($item_data = mysqli_fetch_assoc($result)) {
										?>
										<option value="<?php echo $item_data['serv_by'];?>"><?php echo $item_data['serv_by'];?></option>
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

					$count = 1;

					$sql = "SELECT DISTINCT t1.tkt_no, t1.mc_sl_no, t1.mc_type, t1.prob, t2.cust_code
                                                                                                        FROM `td_service_out` t1, `td_customer_tkt` t2
                                                                                                        WHERE t1.tkt_no = t2.tkt_no
                                                                                                        AND t1.serv_by = '".$_POST['srv_eng']."'
                                                                                                        AND t1.out_dt BETWEEN '".date('Y-m-d',strtotime($_POST['from_date']))."' AND '".date('Y-m-d',strtotime($_POST['to_date']))."'";

					$result = mysqli_query($conn, $sql);

										
			?>
			<div class="report_result">
                <h3>Service Engineer Name: <?php echo $_POST['srv_eng'];?></h3>
                <br>
				<table width="100%">

					<tr>
						<th>Sl No.</th>
                        <th>Application Type</th>
						<th>Customer Name</th>
						<th>M/C Serial No.</th>
                        <th>Problem</th>
                        <th>Component Name</th>
					</tr>

					<?php

                        while ($data = mysqli_fetch_assoc($result)) {
                            
                            //For Customer Name
                            $cNameSql = "SELECT client_name FROM client_master 
                                                            WHERE client_code = ".$data['cust_code']."";


                            $res = mysqli_query($conn, $cNameSql);

                            $name = mysqli_fetch_assoc($res);

                            unset($sql);

                            $sql    =   "SELECT t2.parts_desc FROM td_service_out t1, mm_parts t2
                                                              WHERE t1.mc_sl_no = '".$data['mc_sl_no']."'
                                                              AND   t1.comp_sl_no = t2.sl_no
                                                              AND   t1.out_dt BETWEEN '".date('Y-m-d',strtotime($_POST['from_date']))."' AND '".date('Y-m-d',strtotime($_POST['to_date']))."'";
                            
                            $dta    =   mysqli_query($conn, $sql);


						 ?>

							<tr>

								<td><?php echo $count++;?></td>
								<td><?php echo $data['mc_type'];?></td>
                                <td><?php echo $name['client_name'];?></td>
                                <td><?php echo $data['mc_sl_no'];?></td>
								<td><?php echo $data['prob'];?></td>
                                <td><?php 
                                    $i = 0;
                                    while($parts = mysqli_fetch_assoc($dta)){
                                        
                                        if($i == 0) {
                                            
                                            echo $parts['parts_desc'];

                                        }else{

                                            echo ", ".$parts['parts_desc'];

                                        }

                                        $i++;
                                    }
                                ?></td>

							</tr>

					<?php		
							
						}
					?>
                            <tr>
                                    <td colspan="3">Total</td>
                                    <td><?php echo --$count;?></td>
                            </tr>
				</table>
			</div>
			<?php		
				}

			?>
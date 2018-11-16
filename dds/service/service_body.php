<script type="text/javascript">
	var globalVar = 0,
		globalVar1 = 0;
	$(document).ready(function(){
		

		$("#mc_qty").change(function(){

			if (globalVar > 0) {

				var x = document.getElementById("mc_qty").value;

				globalVar1 = x;

				x = x - globalVar;

		    	while(x > 0) {

		    		$("#intro").append('<tr><td><input type="text" name="stk_no[]" class="input_select" style="width: 150px;" required></td><td><?php require 'fetch_problem.php';?><select name="prb[]" class="input_select" style="width: 400px; height: 38px;" required><?php while($pdata = mysqli_fetch_assoc($problem_result)){ ?><option value="<?php echo $pdata['problem_desc'];?>"><?php echo $pdata['problem_desc'];?></option><?php } ?></select></td><td><select name="warranty[]" class="input_select" style="width: 190px;" required><option value="0">In Warranty</option><option value="1">Out Of Warranty</option></select></td></tr>');
		    		x--;
		    	}

		    	globalVar = globalVar1;

	    	}

		});
		
		

    $("#addrow").click(function(){
    	var a = 1;
    	var x = document.getElementById("mc_qty").value;
    			document.getElementById("addrow").style.display = "none";

    	globalVar = x;

    	$("#intro").append('<tr><th>Machine Serial No</th><th>Problem</th><th>Warranty</th></tr>');

    	while(x > 0) {

    		$("#intro").append('<tr><td><input type="text" name="stk_no[]" class="input_select" style="width: 150px;" required></td><td><?php require 'fetch_problem.php';?><select name="prb[]" class="input_select" style="width: 400px; height: 38px;" required><?php while($pdata = mysqli_fetch_assoc($problem_result)){ ?><option value="<?php echo $pdata['problem_desc'];?>"><?php echo $pdata['problem_desc'];?></option><?php } ?></select></td><td><select name="warranty[]" class="input_select" style="width: 190px;" required><option value="0">In Warranty</option><option value="1">Out Of Warranty</option></select></td></tr>');
    		x--;
    	}

    	$("#foot").append('<tr><td><input type="submit" id="addrow" value="Save" class="submit"></td></tr>');

    	document.getElementById("cust_id").value = document.getElementById("cid").value;

      });
  });


</script>

<div class="item_body">
	<h1>CUSTOMER DETAILS</h1>
	<hr>
	<br>
		<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
		<table>
			<tr>
			<input id="cid" type="hidden" value="<?php echo $client_code;?>">
			</tr>
			<tr><td>Client Name</td>
				<td><input class="input_select" value="<?php echo $client_name;?>" readonly></td>
			</tr>
			<tr><td>Address</td>
				<td><input class="input_select" value="<?php echo $client_address;?>" readonly></td>
			</tr>
			<tr>
				<td>Phone</td>
				<td><input class="input_select" value="<?php echo $client_phone;?>" readonly></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input class="input_select" value="<?php echo $client_email;?>" readonly></td>
			</tr>
		</table>


		<h1>SERVICE ENTRY ON <?php echo date('d-m-Y');?></h1>
		<hr><br>

			<form method="POST" action="add_tkt.php">
				<input type="hidden" id="cust_id" name="cust_id">
				<table>
				  	<tr>
						<td>Machine Type</td>
						<td>
							<?php require 'fetch_machine_type.php';
							if(mysqli_num_rows($machine_result) > 0) {
									echo '<select name="mc_type" class="input_select">';
									while($item_data = mysqli_fetch_assoc($machine_result)) {
										?>
										<option value="<?php echo $item_data['mc_type'];?>"><?php echo $item_data['mc_type'];?></option>
								<?php
									}
								echo "</select>";
								}
								?>
						</td>
					</tr>
					<tr>
						<td>Machine<br>Quantity</td>
						<td><input type="number" id="mc_qty" class="input_select" name="mc_qty" required></td>
					</tr>
					<tr>
						<td>Submit By</td>
						<td><input type="text" class="input_select" name="sub_by" required></td>
					</tr>
					<tr>
						<td>Phone No</td>
						<td><input type="text" class="input_select" id="phone" name="ph_no" onkeyup="phn_no_chk()" required></td>
					</tr>
					<tr>
						<td>Received By</td>
						<td><input type="text" class="input_select" name="rcv_by" required></td>
					</tr>
					<tr>
						<td>Service Center<br>Name</td>
						<td><?php
							require 'fetch_service_center.php';

								echo '<select name="servCenName" class="input_select">';
								if (mysqli_num_rows($result) > 0) {
									while($item_data = mysqli_fetch_assoc($result)) {
										?>
										<option value="<?php echo $item_data['center_name'];?>"><?php echo $item_data['center_name'];?></option>
						<?php
									}
								}
							echo '</select>';
						?></td>
					</tr>
					<tr>
						<td>Remarks</td>
						<td><textarea type="text" class="input_textarea" name="remarks" required></textarea></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="button" id="addrow" value="Okay" style="background-color: green;" class="submit"></td>
					</tr>
				</table>


				<table>

					<tbody id="intro">

				  	</tbody>

				  	<tfoot id="foot"></tfoot>

				</table>

			</form>

		<?php
			}
		else if($_SERVER['REQUEST_METHOD'] == 'GET'){
		?>
		<table>
			<form name="add_user_form" method="POST" action="">
				<tr>
					<td>Customer Code</td>
					<td><?php
							require '../include/fetch_client.php';
								echo '<input name="client_code" list="client" class="input_select">';
								echo '<datalist id="client">';
								if (mysqli_num_rows($client_result) > 0) {
									while($client_data = mysqli_fetch_assoc($client_result)) {?>
										<option value="<?php echo $client_data["client_code"]?>"><?php echo $client_data['client_name'];?></option>
								<?php
									}
								}
							echo '</datalist>';
						?>
					</td>
				</tr>
				<tr>
		         <td></td>
		         <td><input type="submit" id="selected" value="Get Details" class="submit"></td>
				</tr>
			</form>
		</table>
		<?php
			}
		?>

</div>

	<script type="text/javascript">

		function phn_no_chk(){

			var x = document.getElementById("phone").value;

			if(isNaN(x)||x.indexOf(" ")!=-1)
           	{
              alert("Enter numeric value");
              document.getElementById("phone").value = "";
              return false;
           	}
           else if (x.length > 10)
           	{
                alert("enter 10 characters");
                document.getElementById("phone").value = "";
                return false;
           	}
           	else{
           		return true;
           	}
		}
	</script>

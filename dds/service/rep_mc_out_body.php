<script type="text/javascript">

	var global_var = 0,
		global_arr = [],
		global_value = [];

	$(document).ready(function(){
		$('#mc_type').change();

    $("#mc_qty").change(function(){
    	var mc_qty = $('#mc_qty').val();
    	if (mc_qty > <?php echo $mc_qty ?>) {
    		$('#mc_qty').val('');
    		$('#mc_qty_err').html("<span style='color: red;'>Quantity Exceeding No. of Submited M/C</span>");
    	}
		else{
			var count = 1;
			$.ajax({
    			url: "<?php echo $l_dds_repaired_machine_out; ?>",
    			data: {
    				tkt_no: <? echo $tkt_no; ?>
				},
				dataType:'json',
				type: 'GET'
			}).done( function(obj){
		    	global_arr = obj;
		    	console.log(global_arr);
    		});

			
    		
    		$('#mc_qty').prop('readonly', true);
    		$('#addrow').hide();

    	$("#intro").append('<tr><th>Machine Serial No</th></tr>');
    			
    	while(mc_qty > 0) {
    		
    		$("#intro").append('<tr><td style="margin-left:50px;"><input type="text" name="mc_no[]" class="input_select mc_sl_no" id="'+count+'" required></td><td class="cnt" id="w'+count+'"></td></tr>');
    		count++;
    		mc_qty--;
    	}

    	$("#intro").append('<tr><td><input type="submit" id="addrow" value="Save" class="submit"></td></tr>');
		}    		
	});

  });
</script>

<div class="item_body">
	<h1>TICKET DETAILS</h1>
	<hr>
	<br>
		<?
		if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
		<form method="POST" action="insert_rep_mc_out.php">
		<table>
			
			<tr><td>Received Date</td>
				<td><input class="input_select" name="invoice_no" value="<? echo date('d-m-Y',strtotime($recvd_dt));?>" readonly><input id="cid" type="hidden" value="<? echo $tkt_no;?>"></td>
			</tr>
			<tr>
				<td>Out Date</td>
				<td><input type="text" id="date" class="input_text" readonly></td>
				<td id ="sales_epurchase" ><span style='color: red;'></span></td>
			</tr>
			<tr>
				<td>Ticket No</td>
				<td><input class="input_select" name="tkt_no" id="tkt_no" value="<? echo $tkt_no;?>" readonly></td>
			</tr>
			<tr>
				<td>Client<br>Name</td>
				<td><input class="input_select" name="c_name" value="<? echo $client_name;?>" readonly></td> 
			</tr>
			<tr>
				<td>Machine<br>Type</td>
				<td><input class="input_select" name="mc_type" value="<? echo $mc_type;?>" readonly></td> 
			</tr>
			<tr><td>Submit By</td>
				<td><input class="input_select" name="invoice_no" value="<? echo $submit_by;?>" readonly></td>
			</tr>
			<tr><td>Phone No</td>
				<td><input class="input_select" name="invoice_no" value="<? echo $sub_phn_no;?>" readonly></td>
			</tr>
			<tr>
				<td>Received By</td>
				<td><input class="input_select" name="invoice_no" name="invoice_no" value="<? echo $rcv_by;?>" readonly></td> 
			</tr>
			<tr>
				<td>Remarks</td>
				<td><input class="input_text" name="invoice_no" value="<? echo $remarks;?>" readonly></td> 
			</tr>
			<tr>
				<td>Invoice No</td>
				<td><input class="input_select" name="invoice_no"></td> 
			</tr>
			<tr><td>Machine<br>Quantity</td>
				<td><input class="input_select" name="mc_qty" id="mc_qty"></td>
				<td id="mc_qty_err"></td>
			</tr>
		</table>	

		<br>
		<h1>SERVICE OUT ENTRY ON <?echo date('d-m-Y');?></h1>
		<hr><br>

	
		<input type="hidden" name="tkt_no" value="<? echo $tkt_no;?>">
		<input type="hidden" id="cust_id" name="cust_id">
		<table id="intro" style="margin-left: 85px;">
			
		</table>

	</form>
		
		<?
			}
		else{
		?>
		<table>		
			<form name="add_user_form" method="POST" action="">
				<tr>
					<td>Ticket No</td>
					<td><?php 
						require 'fetch_tkt.php';
							echo '<input name="tkt_no" list="tkt_no" class="input_select">';
							echo '<datalist id="tkt_no">';
							if (mysqli_num_rows($tkt_result) > 0) {
								while($tkt_data = mysqli_fetch_assoc($tkt_result)) {
									require '../include/fetch_client.php';
									while($client_data = mysqli_fetch_assoc($client_result)) {
										if ($client_data["client_code"] == $tkt_data["cust_code"]) {?>
											<option value="<?php echo $tkt_data["tkt_no"]?>"><?php echo $tkt_data['tkt_no'].' '.$client_data['client_name'];?>
											</option>
									
							<?
										}
									}
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
		<?
			}
		?>   
	
</div>

<script type="text/javascript">

	$('#intro').on('change','.mc_sl_no', function(){
		global_var = $(this).attr('id');
		var flag = false,
			value = $(this).val();
		for (var i = 0; i < global_arr.length; i++) {

    		if (global_arr[i] === value) {
    			flag = true;
    			
    			if (global_value.indexOf(value) == -1) {
    				
    				global_value.push(value);
    				$('#w' + global_var).html('');
    				$('#addrow').show();
    				break;
    			}
    			else {
    				$('#w' + global_var).html('<span style="color: red;">Already Entered</span>');
    				$('#addrow').hide();
    				break;
    			}
    		}
    	}
    	if (!flag) {
    		$('.cnt').change();
    	}
	});

	$('#intro').on('change','.cnt', function(){
		$('#addrow').hide();
		$('#w' + global_var).html('<span style="color: red;">Wrong serial no.</span>');
	});
</script>
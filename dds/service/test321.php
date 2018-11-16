<script type="text/javascript">
	var global_var = 0,
		count = 0,
		counter = 0;

	$(document).ready(function(){
		$('.hide').hide();

    $("#mc_qty").change(function(){

    	var mc_qty = $('#mc_qty').val();

    	if (mc_qty <= <?php echo $mc_qty ?>) {
    		$('#mc_qty').prop('readonly', true);
    		$('#mc_qty_err').hide('slow');
    		$('.hide').show();
	    	$("#intro").append('<table><tr><th style="width:150px;">Macine No.</th><th style="width:150px;">Problem</th><th style="width:250px;">Component Name</th><th style="width:125px;">Quantity</th><th style="width:75px;">Service By</th><th></th></tr></table>');

	    	addRow(mc_qty, count++);
    	}
    	else{
    		$('#mc_qty').val('');
    		$('#mc_qty_err').html("<span style='color: red;'>Quantity Exceeding No. of Submited M/C</span>");
    	}

      });

    $('#intro').on('change', '.trackAll', function(){

    	var comp_no = $(this).val(),
		 	serv_area = $('#center_name').val();

		$.get("<?php echo $l_dds_check_stock_qty ?>", {comp_no: comp_no, serv_area: serv_area}).done(function(data){
			global_var = parseInt(data);
			//console.log(global_var);
		});

    	var tempIndex = $(this).attr('id').substring(5,6);
    	$('.preferenceSelect' + tempIndex).each(function(){
    		$('.preferenceSelect' + tempIndex).find('option[value ="' + this.value + '"]').toggel(false);
    	});
    });

    $('#intro').on('click', '.addComp', function(){
    	
    	var currIndex = $('.addComp').index(this);
    	var highest = -Infinity;
    	
    	$('.preferenceSelect' + currIndex).each(function(){
    		highest = $('.preferenceSelect' + currIndex).index(this);
    	});

    	highest++;
    	$('#adcmp' + currIndex).append('<tr><td> </td><td ></td><td><?php require 'fetch_parts.php';?><select name="comp_no[]" class="input_select preferenceSelect'+currIndex+' trackAll" id="track'+currIndex+highest+'" style="width: 250px;" required><option>Select</option><?php while($parts = mysqli_fetch_assoc($parts_result)) {?><option value="<?php echo $parts['sl_no']?>"><?php echo $parts['parts_desc']?></option><?php }echo '<option value="0">No Parts</option>';?></select></td><td><input type="text" name="qty[]" value="1" class="input_select qty" style="width: 55px;" id="'+count+'" required></td><td></td><td></td></tr>');

    		$('.preferenceSelect' + currIndex).each(function(){
    			$('.preferenceSelect' + currIndex).find('option[value ="' + this.value + '"]').toggel(false);
    		});
    });

  });

	function addRow(mc_qty, count){
		while(mc_qty > 0){
			counter = 0;
			$("#intro").append('<hr><table id="adcmp'+count+'"><tr><td><input type="text" id="mcSL'+count+'" class="input_select" style="width:150px;"/></td><td><input type="text" class="input_text" style="width:150px;"/></td><td><?php require 'fetch_parts.php';?><select name="comp_no[]" class="input_select preferenceSelect'+count+' trackAll" id="track'+count+counter+'" style="width: 250px;" required><option>Select</option><?php while($parts = mysqli_fetch_assoc($parts_result)) {?><option value="<?php echo $parts['sl_no']?>"><?php echo $parts['parts_desc']?></option><?php }echo '<option value="0">No Parts</option>';?></select></td><td><input type="text" name="qty[]" value="1" class="input_select qty" style="width: 55px;" id="'+count+'" required></td><td><input class="input_text" name="serviceBy[]" style="width: 100px;"></td><td><input type="button" style="padding:10; color:white; background-color:gray; width:50px; height:25px; font-size:25px;" value="+" class="addComp"/></td><td class="cnt" id="w'+count+'"></td></tr></table>');
			count++
			mc_qty--;		
		}		
	}
</script>

<div class="item_body" style="width: 850px;">
	<h1>TICKET DETAILS</h1>
	<hr>
	<br>
		<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
		<form method="POST" action="insert_stock_out.php">
		<table>
			<tr><td>Received Date</td>
				<td><input class="input_select" value="<?php echo date('d-m-Y',strtotime($recvd_dt));?>" readonly><input id="cid" type="hidden" value="<?php echo $tkt_no;?>"></td>
			</tr>
			<tr><td>Ticket No</td>
				<td><input class="input_select" id="tkt_no" value="<?php echo $tkt_no;?>" readonly></td>
			</tr>
			<tr><td>Service Center<br>Name</td>
				<td><input class="input_select" id="center_name" name="center_name" value="<?php echo $center_name;?>" readonly></td>
			</tr>
			<tr>
				<td>Client<br>Name</td>
				<td><input class="input_select" value="<?php echo $client_name;?>" readonly></td>
			</tr>
			<tr>
				<td>Machine<br>Type</td>
				<td><input class="input_select" value="<?php echo $mc_type;?>" readonly></td>
			</tr>
			<tr><td>Submit By</td>
				<td><input class="input_select" value="<?php echo $submit_by;?>" readonly></td>
			</tr>
			<tr><td>Phone No</td>
				<td><input class="input_select" value="<?php echo $sub_phn_no;?>" readonly></td>
			</tr>
			<tr>
				<td>Received By</td>
				<td><input class="input_select" value="<?php echo $rcv_by;?>" readonly></td>
			</tr>
			<tr>
				<td>Remarks</td>
				<td><input class="input_select" value="<?php echo $remarks;?>" readonly></td>
			</tr>
			<tr><td>Total Machine<br>Quantity</td>
				<td><input class="input_select" value="<?php echo $mc_qty;?>" readonly></td>
			</tr>
			<tr><td>Machine<br>Quantity</td>
				<td><input class="input_select" name="mc_qty" id="mc_qty"></td>
				<td id="mc_qty_err"></td>
			</tr>
			<!--<tr class="hide">
				<td>Add Row</td>
				<td><button type="button" class="submit" id="add" style="background-color: green; ">Add another</button></td>
			</tr>-->
		</table>

		<br><br>
		<h1>SERVICE OUT ENTRY ON <?php echo date('d-m-Y');?></h1>
		<hr><br>


		<input type="hidden" name="tkt_no" value="<?php echo $tkt_no;?>">
		<input type="hidden" id="cust_id" name="cust_id">
		<div id="intro">

		</div>

		<table class="hide">
			<tr>
				<td>
					<button type="button" style="margin-left: 85px;" id="addrow" class="submit">Insert</button>
				</td>
				<td></td>
			</tr>
		</table>

	</form>

		<?php
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

							<?php
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
		<?php
			}
		?>

</div>

<script type="text/javascript">


    $('#intro').on("change", ".preferenceSelect", function() {

		var comp_no = $(this).val(),
		 	serv_area = $('#center_name').val();

		$.get("<?php echo $l_dds_check_stock_qty ?>", {comp_no: comp_no, serv_area: serv_area}).done(function(data){
			global_var = parseInt(data);
			//console.log(global_var);
		});

    });

	$('#intro').on("change", ".qty", function() {
		var id = $(this).attr('id'),
			value = parseInt($(this).val());
			//console.log($('.qty').get());
			if (value > parseInt(global_var)) {
				$(this).val('');
				$('#w' + id).show();
				$('#w' + id).html('<span style="color: red;"> &nbsp;&nbsp;Quantity<br>exceeded</span>');
			}
			else{
				$('#w' + id).hide();
			}
	});

  $('#intro').on('change','.cnt', function(){
		$('#addrow').hide();

	});

	$('.submit').click(function() {

	   $('.preferenceSelect').each(function(){
	        $('.preferenceSelect').find('option[value ="' + this.value + '"]').attr("disabled", false);
	      });

       $('#addrow').prop('type', 'submit');
  });
</script>

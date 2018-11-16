<script type="text/javascript">

	var global_var = 0,
		global_arr = [],
		global_value = [];

	$(document).ready(function(){
		$('#mc_type').change();

    $("#mc_qty").change(function(){
    	var count = 1;
    	var mc_qty = $('#mc_qty').val();
    		$('#mc_qty').prop('readonly', true);
    		$('#addrow').hide();


    	$("#intro").append('<tr><th>Machine Serial No</th></tr>');
    			
    	while(mc_qty > 0) {
    		
    		$("#intro").append('<tr><td style="margin-left:50px;"><input type="text" name="mc_no[]" class="input_select mc_sl_no" id="'+count+'" required></td><td class="cnt" id="w'+count+'"></td></tr>');
    		count++;
    		mc_qty--;
    	}

    	$("#intro").append('<tr><td><input type="submit" id="addrow" value="Save" class="submit"></td></tr>');
      });

  });
</script>

<div class="item_body">
	<h1>MACHINE OUT</h1>
	<form name="add_user_form" method="POST" action="">
	<table>
		<tr>
			<td>Date</td>
			<td><input type="text" id="date" class="input_text" readonly></td>
			<td id ="sales_epurchase"><span style='color: red;'></span></td>
		</tr>
		<tr>
			<td>Machine<br>Type</td>
			<td><?php 
				require 'fetch_machine_type.php';
					echo '<select name="mc_type" id="mc_type" class="input_select">';
					if (mysqli_num_rows($machine_result) > 0) {
						while($item_data = mysqli_fetch_assoc($machine_result)) {
							echo '<option value="'.$item_data["mc_type"].'">'.$item_data['mc_type'].'</option>';
						}
					}
				echo '</select>';
			?>	
			</td>
		</tr>
		<tr>
			<td>Client<br>Name</td>
			<td><input type="text" name="c_name" class="input_text" required/></td>
		</tr>
		<tr>
			<td>Invoice No</td>
			<td><input type="text" name="invoice_no" class="input_text" required /></td>
		</tr>
		<tr>
			<td>Machine<br>Quantity</td>
			<td><input type="text" min="1" name="machine_qty" id="mc_qty" class="input_text" placeholder="Quantity of Machines" required /></td>
		</tr>
		<tr>
			<td>Purpose</td>
			<td><select name="purpose" id="purpose" name="purpose" class="input_select" required>
				<option value="SELL">SELL</option>
				<option value="DEMO">DEMO</option>
			</select></td>
		</tr>
	</table>
	<table style="margin-left: 85px;">
		<tbody id="intro">	
	  	</tbody>	
	</table>
	</form>
</div>

<script type="text/javascript">
	$('#mc_type').change(function(){	
    	var mc_type = $('#mc_type').val();

    	$.ajax({
    			url: "<?php echo $l_dds_new_machine_out ?>",
    			data: {
    				  mc_type: mc_type
				},
				dataType:'json',
				type: 'GET'
			}).done( function(obj){
		    	global_arr = obj;
		    	console.log(global_arr);
    		});
	});

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
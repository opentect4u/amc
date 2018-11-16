<script type="text/javascript">
	var global_var = 0,
		global_arr = [],
		global_value = [],
		count = 1;

$(document).ready(function(){

  $('#trnsTo').val('SILIGURI');

  /*$('#trnsFrom').change(function(){
     if($(this).val() == 'SILIGURI'){
       $('#trnsTo').val('KOLKATA (HO)');
     }
     else{
       $('#trnsTo').val('SILIGURI');
     }
  });*/

  $('#addRow').click(function(){
		count++
		$('#addAnother').append('<tr><td><?php	require "fetch_parts.php";?> <select name="comp_sl_no[]" class="input_select blkSelected" style="width:250px;"><option>Select</option><?php while($item_data = mysqli_fetch_assoc($parts_result)) {$sl_no = $item_data["sl_no"];$parts_desc = $item_data["parts_desc"];	?><option value="<?php echo $sl_no; ?>"><?php echo $sl_no.' '.$parts_desc;?></option> <?php	}?>	</select></td><td><input type="number" min="1" name="c_qty[]" id="'+count+'" class="input_text qty" style="width:75px;" required></td><td ><button class="removeRow" type="button" style="background-color: #f44336; border: none;color: white;padding: 5px 2px; text-align: center;text-decoration: none; display: inline-block; font-size: 16px;">Remove Row</button></td><td class="cnt" id="w'+count+'"></td></tr>');
		$('.blkSelected').change();
  });

 $('#addAnother').on('click', '.removeRow', function(){
	 $(this).parent().parent().remove();
 });

 $('#addAnother').on('change', '.blkSelected', function(){
	var comp_no = $(this).val(),
		serv_area = $('#trnsFrom').val();

		console.log(comp_no);
		console.log(serv_area);
	$.get("<?php echo $l_dds_check_stock_qty ?>", {comp_no: comp_no, serv_area: serv_area}).done(function(data){
		
		global_var = data;
		console.log(global_var);

	});
	$('.blkSelected').each(function(){
		$('.blkSelected').find('option[value ="' + this.value + '"]').attr("disabled", true);
	});
 });

 $('#addAnother').on("change", ".qty", function() {
		var id = $(this).attr('id'),
			value = parseInt($(this).val());
			console.log(value);console.log(id);
			if (value > global_var) {
				$(this).val('');
				$('#w' + id).show();
				$('#w' + id).html('<span style="color: red;">You have less amount of quantity</span>');
			}
			else{
				$('#w' + id).hide();
			}
	});

$('#submit').click( function(){

	$('.blkSelected').each(function(){
		$('.blkSelected').find('option[value ="' + this.value + '"]').attr("disabled", false);
	});
	$('#submit').prop('type', 'submit');
});
});
</script>

<div class="item_body">
	<h1>STOCK</h1>
	<form method="POST" action="">
	<table>
		<tr>
			<td>Date</td>
			<td><input type="text" name="item_date" id="date" class="input_text" readonly></td>
			<td id ="sales_epurchase"><span style='color: red;'></span></td>
		</tr>
    	<tr>
			<td>Transfer No</td>
			<td><input type="text" name="trfNo" id="trfNo" placeholder="Transfer No." class="input_text" required></td>
		</tr>
    	<tr>
			<td>Transfer<br>Mode</td>
			<td><select type="text" name="trfMode" id="trfMode" class="input_select">
		            <option value="Courier">Courier</option>
		            <option value="Transport">Transport</option>
		            <option value="Manually">Manually</option>
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
							<option value="<?php echo $item_data['center_name'];?>"><?php echo $item_data['center_name'];?></option>
			<?php
						}
					}
				echo '</select>';
			?>
      </td>
		</tr>
		<tr>
			<td>Transfer To</td>
			<td><?php
				require 'fetch_service_center.php';

					echo '<select name="trnsTo" id="trnsTo" class="input_select">';
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
			<!--<td><input type="text" name="trnsTo" id="trnsTo" class="input_text" readonly></td>-->
		</tr>
    <tr>
      <td>Remarks</td>
      <td><textarea type="text" class="input_textarea" name="remarks" required></textarea></td>
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
		<tr>
			<td><?php
				require 'fetch_parts.php';
					echo '<select name="comp_sl_no[]" class="input_select blkSelected" style="width:250px;">
							<option>Select</option>';
					if (mysqli_num_rows($parts_result) > 0) {
						while($item_data = mysqli_fetch_assoc($parts_result)) {
							echo '<option value="'.$item_data["sl_no"].'">'.$item_data['sl_no'].' '.$item_data['parts_desc'].'</option>';
						}
					}
				echo '</select>';
			?>
			</td>
			<td><input type="number" min="1" name="c_qty[]" id="1" class="input_text qty" style="width:75px;" required></td>
			<td class="cnt" id="w1"></td>
		</tr>
	</table>

	<table style="margin-left:225px;">
		<tr>
			<td></td>
	    <td><input id="submit" type="button" value="Submit" class="submit"></td>
		</tr>
	</table>
	</form>

</div>

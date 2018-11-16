<script type="text/javascript">
	var global_var = 0,
		global_arr = [],
		global_value = [],
		count = 1;

$(document).ready(function(){
  $('#trnsTo').val('SILIGURI');

  $('#trnsFrom').change(function(){
     if($(this).val() == 'SILIGURI'){
       $('#trnsTo').val('KOLKATA (HO)');
     }
     else{
       $('#trnsTo').val('SILIGURI');
     }
  });

  $('#addRow').click(function(){
		count++;
		$('#addAnother').append('<tr><td><?php	require "fetch_parts.php";?> <select name="comp_sl_no[]" class="input_select blkSelected" style="width:250px;"><option>Select</option><?php while($item_data = mysqli_fetch_assoc($parts_result)) {$sl_no = $item_data["sl_no"];$parts_desc = $item_data["parts_desc"];	?><option value="<?php echo $sl_no; ?>"><?php echo $sl_no.' '.$parts_desc;?></option> <?php	}?>	</select></td><td><input type="number" min="1" name="c_qty[]" id="'+count+'" class="input_text qty" style="width:75px;" required></td><td><textarea type="text" class="input_text" name="remarks[]" style="width:255px;" required></textarea></td><td><button class="removeRow" type="button" style="background-color: #f44336; border: none;color: white;padding: 5px 2px; text-align: center;text-decoration: none; display: inline-block; font-size: 16px;">Remove Row</button></td><td class="cnt" id="w'+count+'"></td></tr>');
		$('.blkSelected').change();
  });

 $('#addAnother').on('click', '.removeRow', function(){
	 $(this).parent().parent().remove();
 });

 $('#addAnother').on('change', '.blkSelected', function(){
	var comp_no = $(this).val(),
		serv_area = 'KOLKATA (HO)';

	$.get("<?php echo $l_dds_check_stock_qty ?>", {comp_no: comp_no, serv_area: serv_area}).done(function(data){
		global_var = data;
		//console.log(global_var);

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
	<h1>DAMAGE STOCK</h1>
	<form method="POST" action="">
	<table>
		<tr>
			<td>Date</td>
			<td><input type="text" name="item_date" id="date" class="input_text" readonly></td>
			<td id ="sales_epurchase"><span style='color: red;'></span></td>
		</tr>
    	<tr>
			<td>Memo No</td>
			<td><input type="text" name="memoNo" id="memoNo" placeholder="Memo No." class="input_text" required></td>
		</tr>
		<tr>
			<td>Ordered By</td>
			<td><input type="text" name="orederBy" id="orederBy" placeholder="Ordered By" class="input_text" required></td>
		</tr>
		<tr>
			<td>Service Center<br> Name</td>
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
			<td></td>
			<td><input type="button" id="addRow" value="Add Row" class="submit" style="background-color:green"></td>
		</tr>
	</table>

	<table id="addAnother" >
		<tr>
			<th style="text-align: center;">
				Component Name
			</th>
			<th>
				Quantity
			</th>
			<th>
				Remarks
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
			<td><textarea type="text" class="input_text" name="remarks[]" style="width:255px;" required></textarea></td>
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

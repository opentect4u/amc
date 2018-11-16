<script type="text/javascript">
$(document).ready(function(){
	$('#date1').on("change", function() {
      var today = new Date();

      var to_date = $('#date1').val().split("-");
      var mydate = new Date(to_date[2], to_date[1] - 1, to_date[0]);

      if (mydate > today) {
        alert("Arrival date can't be greater than system date!");
        $('#date1').val('');
        return false;
      }
     });

	$('#addRow').click(function(){

		 $('#addAnother').append('<tr><td><?php	require "fetch_parts.php";?> <select name="comp_name[]" class="input_select blkSelected" style="width:250px;"><option>Select</option><?php while($item_data = mysqli_fetch_assoc($parts_result)) {$sl_no = $item_data["sl_no"];$parts_desc = $item_data["parts_desc"];	?><option value="<?php echo $sl_no; ?>"><?php echo $sl_no.' '.$parts_desc;?></option> <?php	}?>	</select></td><td><input type="number" min="1" name="c_qty[]" id="c_qty" class="input_text" style="width:75px;" required></td><td ><button class="removeRow" type="button" style="background-color: #f44336; border: none;color: white;padding: 5px 2px; text-align: center;text-decoration: none; display: inline-block; font-size: 16px;">Remove Row</button></td></tr>');
		 $('.blkSelected').change();
  });

	$('#addAnother').on('click', '.removeRow', function(){
		 $(this).parent().parent().remove();
	});

	$('#addAnother').on('change', '.blkSelected', function(){
		$('.blkSelected').each(function(){
			$('.blkSelected').find('option[value ="' + this.value + '"]').attr("disabled", true);
		});
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
			<td id ="sales_epurchase" ><span style='color: red;'></span></td>
		</tr>
		<tr>
			<td>Components<br> Arrival Date</td>
			<td><input type="text" name="arrival_date" id="date1" placeholder="DD-MM-YYYY" class="input_text" required></td>
		</tr>
		<tr>
			<td>Bill No</td>
			<td><input type="text" name="billNo" id="billNo" placeholder="Bill No." class="input_text" required></td>
		</tr>
		<tr>
			<td>Service Center<br> Name</td>
			<td><?php
				require 'fetch_service_center.php';

					echo '<select name="servCenName" class="input_select" >';
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
					echo '<select name="comp_name[]" class="input_select blkSelected" style="width:250px;">
							<option>Select</option>';
					if (mysqli_num_rows($parts_result) > 0) {
						while($item_data = mysqli_fetch_assoc($parts_result)) {
							echo '<option value="'.$item_data["sl_no"].'">'.$item_data['sl_no'].' '.$item_data['parts_desc'].'</option>';
						}
					}
				echo '</select>';
			?>
			</td>
			<td><input type="number" min="1" name="c_qty[]" id="c_qty" class="input_text" style="width:75px;" required></td>
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

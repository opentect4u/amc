<div class="item_body">
	<h1>NEW MACHINE</h1>
	<form name="add_user_form" method="POST" action="">
	<table>
		<tr>
			<td>Date</td>
			<td><input type="text" name="item_date" id="date" class="input_text" readonly></td>
			<td id ="sales_epurchase"><span style='color: red;'></span></td>
		</tr>
		<tr>
			<td>Machine<br>Type</td>
			<td><?php
				require 'fetch_machine_type.php';
					echo '<select name="comp_name" class="input_select">';
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
			<td>Machine<br>Quantity</td>
			<td><input type="text" name="machine_qty" id="mc_qty" class="input_text" placeholder="Quantity of Machines" required /></td>
			<td id ="user_eid"><span style='color: red;'></span></td>
		</tr>
		<tr>
			<td>Product<br>Serial No(s)</td>
			<td><textarea name="item_serial" placeholder="only numeric value ex:00000001-00000009 or 00000001,00000002,00000003-000000010,000000015-000000030" class="input_textarea" onKeyDown="clr_psn()"></textarea></td>
			<td id ="sales_epsno"><span style='color: red;'></span></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" id="addrow" value="Save" class="submit"></td>
		</tr>
	</table>
	</form>
</div>
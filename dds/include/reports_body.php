<!DOCTYPE html>
<html>
<head>
	<title>DDS REPORTS</title>
</head>
<body>

</body>
</html>
<div class="reports_body">
	<h1>WARRENTY STATUS</h1>
	<form name="report_form" action="#" method="POST">
	<table>
		<tr>
			<td>Item Name</td>
			<td><?php 
					require 'include/fetch_item.php';
						
						echo '<select name="item_code" class="input_select">';
						if (mysqli_num_rows($item_result) > 0) {
							while($item_data = mysqli_fetch_assoc($item_result)) {
								echo '<option value="'.$item_data["item_code"].'">'.$item_data["item_code"].' '.$item_data['item_type'].' '.$item_data['item_name'].' '.$item_data["item_application"].'</option>';
							}
						}
					echo '</select>';
				?>	
			</td>
			<td>Serial No.</td>
            <td>	<?php 
					require 'fetch_serial.php';
						echo '<input type="text" list="serial" name="item_serial" class="input_text"/>';
						echo '<datalist id="serial">';
						if (mysqli_num_rows($item_result) > 0) {
							while($serial_data = mysqli_fetch_assoc($serial_result)) {
								echo '<option value="'.$serial_data["serial_no"].'">'.$serial_data['serial_no'].'</option>';
							}
						}
					echo '</datalist>';
				?></td>
			<td><input type="submit" name="submit" value="SEARCH" class = "submit"></td>
		</tr>
	</table>
	</form>

</div>
<div class = "report_result">
<?php require 'search_sales.php'; ?>

</div>
</body>
</html>
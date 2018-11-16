<div class="customer_body">
	<h1>ETIM CUSTOMERS</h1>
	<form name="add_client_form" method="POST" action="#" onsubmit="return valid_form()">
	<table>
		<tr>
			<td> Name</td>
            <td><?php 
						require 'include/fetch_client.php';
							echo '<input name="customer_name" list="client" class="input_select" onChange="cus_name_one()">';
							echo '<datalist id="client">';
							if (mysqli_num_rows($client_result) > 0) {
								while($client_data = mysqli_fetch_assoc($client_result)) {
									echo '<option value="'.$client_data["client_name"].'">'.$client_data["client_name"].'</option>';
								}
							}
						echo '</datalist>';
					?>
			</td>
			<td id ="cus_ename" <span style='color: red;'></span></td>
		</tr>
		<tr>
			<td> Address</td>
			<td><textarea name="customer_address" class="input_textarea" onKeyDown="cus_address_one()"></textarea></td>
			<td id ="cus_eadd" <span style='color: red;'></span></td>
		</tr>
		<tr>
			<td> Phone No.</td>
			<td><input type="text"  name="customer_phone" class="input_text" onKeyUp="phn_no_chk()" onKeyDown="cus_phone()" /></td>
			<td id ="cus_ephone" <span style='color: red;'></span></td>
		</tr>
		<tr>
			<td> Email ID</td>
			<td><input type="text" id="test_email" placeholder="example@abc.xyz" name="customer_email" class="input_text" onKeyDown="cus_email()"/></td>
			<td id ="cus_eemail" <span style='color: red;'></span></td>
		</tr>

		<tr>
			<td></td>
			<td><input type="submit" value="ADD" class="submit" id="btn_submit"/></td>
		</tr>

	</table>
	</form>
</div>

<div class="sales_body">
<div class="sales_page">
	<h1>NEW ORDER ENTRY</h1>
	<form name="order_form" method="POST" action="#" onsubmit="return valid_form()">
	<table>
		<tr>
			<td>Client Code</td>
			<td><?php 
					require 'include/fetch_client.php';
						//echo '<select name="client_id" class="input_select">';
						echo '<input type="text" name="client_id" class="input_text" list="client"/>';
							echo '<datalist id="client">';
						if (mysqli_num_rows($client_result) > 0) {
							while($client_data = mysqli_fetch_assoc($client_result)) {
								echo '<option value="'.$client_data["client_id"].'">'.$client_data["client_name"].' '.$client_data["client_type"].'</option>';
							}
						}
					//echo '</select>';
					echo '</datalist>';
				?>	
			</td><td id ="order_ecode" <span style='color: red;'></span></td>
		</tr>
		<tr>
		<td>Order Amount( &#8377 )</td>
		<td><input type="number" name="order_value" min="1" class="input_text" onKeyDown="clr_ordervalue()"></td>
		<td id ="order_evalue" <span style='color: red;'></span></td>
		</tr>
        
        <tr>
		<td>Payment Details</td>
		<td><textarea name="payment" class="input_textarea" onKeyDown="clr_payment()"></textarea></td>
		<td id ="order_erpay" <span style='color: red;'></span></td>
		</tr>
        
        <tr>
		<td>Remarks</td>
		<td><textarea name="remarks" class="input_textarea" onKeyDown="clr_remrk()"></textarea></td>
		<td id ="order_eremark" <span style='color: red;'></span></td>
		</tr>
		<tr>
        
		<tr>
			<td>Execution Status</td>
			<td><select name="exe_status" class="input_select">
            <option value="ORDER RECEIVED" selected>ORDER RECEIVED</option>
            <option value="INSTALLATION DONE" >INSTALLATION DONE</option>
            <option value="RUNNING LIVE" >RUNNING LIVE</option>
            
            </td>
            
			<td id ="order_eexec" <span style='color: red;'></span></td>
		</tr>
        
		<tr>
		<td>Order Date</td>
		<td><input type="text" name="order_date" id="date" placeholder="DD-MM-YYYY" class="input_text" onKeyUp="prchsedate_chk()" onKeyDown="clr_date()">								        </td>
		<td id ="order_edate" <span style='color: red;'></span></td>
		</tr>
			<td></td>
			<td><input type="submit" value="SUBMIT" class="submit"/></td>
		</tr>
	</table>
	</form>
</div>
</div>
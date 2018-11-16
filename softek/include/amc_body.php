<div class="sales_body">
<div class="sales_page">
	<h1>NEW INVOICE ENTRY</h1>
	<form name="sales_form" method="POST" action="#" onsubmit="return valid_form()">
	<table>
		<tr>
		<td>Order No</td>
		<td><?php 
					require 'include/fetch_order.php';
						//echo '<select name="order_id" class="input_select">';
						echo '<input type="text" name="order_id" class="input_text" list="client"/>';
						echo '<datalist id="client">';
						if (mysqli_num_rows($order_result) > 0) {
							while($order_data = mysqli_fetch_assoc($order_result)) {
								echo '<option value="'.$order_data["order_id"].'">'.$order_data['order_id'].' '.$order_data['client_name'].'</option>';
							}
						}
					//echo '</select>';
					echo '</datalist>';
				?>
        </td>
		<td id ="sales" <span style='color: red;'></span></td>
		</tr>
		<tr>
        	<td>Invoice No.</td>
			<td><input type="text" name="invoice_no" class="input_text" onKeyDown="clr_invoice()"></td>
			<td id ="sales_einvoice" <span style='color: red;'></span></td>
		</tr>
		<tr>
			<td>Invoice Date</td>
			<td><input type="text" name="invoice_date"  placeholder="DD-MM-YYYY" class="input_text date" onKeyDown="clr_id()"></td>
		<td id ="sales_epurchase" <span style='color: red;'></span></td>
		</tr>
		<tr>
        <tr>
			<td>Invoice Type</td>
			<td><select name="invoice_type" class="input_select">
            <option value="INSTALLATION">INSTALLATION</option>
            <option value="AMC" selected>AMC</option>
            <option value="CBS">CBS</option>
            <option Value="CALL BASED SUPPORT">CALL BASED SUPPORT</option>
            </select>
            
            </td>
            
		<td id ="sales_epurchase" <span style='color: red;'></span></td>
		</tr>
		<tr>
		<td>Starting Date</td>
			<td><input type="text" name="starting_date"  placeholder="DD-MM-YYYY" class="input_text date" onKeyUp="prchsedate_chk()" onKeyDown="clr_sd()"></td>
		<td id ="sales_esdate" <span style='color: red;'></span></td>
		</tr>
		<tr>
		<td>Duration</td>
		<td><input type="number" name="duration" placeholder="in months" min="1" class="input_text" onKeyDown="clr_d()" onKeyUp="date_difference()"></td>
		<td id ="sales_ewarranty" <span style='color: red;'></span></td>
		</tr>
		<tr>
		<td>End Date</td>
		<td><input type="text" name="end_date" placeholder="DD-MM-YYYY" class="input_text date" onKeyUp="prchsedate_chk()" onKeyDown="clr_ed()" ></td>
		<td id ="sales_eedate" <span style='color: red;'></span></td>
		</tr>
		<tr>
		<td>Amount( &#8377 )</td>
		<td><input type="number" name="amount" min="1" class="input_text" onChange="calculate_tax()" onKeyDown="clr_a()"></td>
		<td id ="sales_eamount" <span style='color: red;'></span></td>
		</tr>
        <tr>
        <td>Tax(%)</td>
		<td><input type="text" name="tax" min="1" step="0.01" class="input_text" onChange="calculate_tax()" ></td>
		<td id ="sales_equantity" <span style='color: red;'></span></td>
		</tr>
        <tr>
        <td>Total Amount( &#8377 )</td>
		<td><input type="number" name="total_amount" step="0.01" min="1" class="input_text" onChange="clr_ta()"></td>
		<td id ="sales_etamount" <span style='color: red;'></span></td>
		</tr>
        <tr>
		<td>Paid Amount( &#8377 )</td>
		<td><input type="number" name="paid_amount" min="0" step="0.01" class="input_text"  onChange="calculate_due()" onKeyDown="clr_pa()"> </td>
		<td id ="sales_epamount" <span style='color: red;'></span></td>
		</tr>
        <tr>
		<td>Due Amount( &#8377 )</td>
		<td><input type="number" name="due_amount" min="0" step="0.01" class="input_text"  onKeyDown="clr_da()"></td>
		<td id ="sales_edamount" <span style='color: red;'></span></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" value="SUBMIT" class="submit"/></td>
		</tr>
	</table>
	</form>
</div>
</div>
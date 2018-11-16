<div class="sales_body">
<div class="sales_page">
	<h1>ETIM SALES</h1>
	<form name="sales_form" method="POST" action="#" onsubmit="return valid_form()">
	<table>
		<tr>
		<td>Invoice No</td>
		<td><input type="text" name="invoice_no" class="input_text" onKeyDown="clr_invoice()"></td>
		<td id ="sales_einvoice" <span style='color: red;'></span></td>
		</tr>
		<tr>
			<td>Item Code</td>
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
			</td><td id ="sales_ecode" <span style='color: red;'></span></td>
		</tr>
		<tr>
			<td>Client Name</td>
			<td><?php 
					require 'fetch_client.php';
						echo '<select name="client_name" class="input_select">';
						if (mysqli_num_rows($client_result) > 0) {
							while($client_data = mysqli_fetch_assoc($client_result)) {
								echo '<option value="'.$client_data["client_code"].'">'.$client_data['client_code'].' '.$client_data["client_name"].'</option>';
							}
						}
					echo '</select>';
				?>	
			</td><td id ="salescli_ename" <span style='color: red;'></span></td>
		</tr>
		<tr>
		<td>Item Quantity</td>
		<td><input type="number" name="item_qty" min="1" class="input_text" onKeyDown="clr_itmqnty()"></td>
		<td id ="sales_equantity" <span style='color: red;'></span></td>
		</tr>
		<tr>
		<td>Warranty Period</td>
		<td><input type="number" name="item_warr" placeholder="in months" min="1" class="input_text" onKeyDown="clr_warr()"></td>
		<td id ="sales_ewarranty" <span style='color: red;'></span></td>
		</tr>
		<tr>
		<td>Sale Date</td>
		<td><input type="text" name="item_date" id="date" placeholder="DD-MM-YYYY" class="input_text" onKeyUp="prchsedate_chk()" onKeyDown="clr_pdate()"></td>
		<td id ="sales_epurchase" <span style='color: red;'></span></td>
		</tr>
		<tr>
		<td>Product Serial No(s)</td>
		<td><textarea name="item_serial" placeholder="only numeric value ex:00000001-00000009 or 00000001,00000002,00000003-00000005" class="input_textarea" onKeyDown="clr_psn()"></textarea></td>
		<td id ="sales_epsno" <span style='color: red;'></span></td>
		</tr>
		<tr>
		<td>Remarks</td>
		<td><textarea name="remarks" class="input_textarea" onKeyDown="clr_remrk()"></textarea></td>
		<td id ="sales_eremark" <span style='color: red;'></span></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" value="SUBMIT" class="submit"/></td>
		</tr>
	</table>
	</form>
</div>
</div>
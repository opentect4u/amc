<div class="sales_body">
<div class="sales_page">
	<h1>SOFTEK AMC UPDATE</h1>
	<form name="sales_form" method="POST" action="#" onsubmit="return valid_form()">
    <input type = "hidden" name = "amc_id" value="<?php echo $amc_code?>" />
	<table>
		<tr>
		<td>Order No</td>
		<td><?php 
					require 'include/fetch_order.php';
						//echo '<select name="order_id" class="input_select">';
						echo '<input type="text" name="order_id" value="'.$order_id.'" class="input_text" readonly/>';
						
					
				?>
        </td>
		<td id ="sales" ><span style='color: red;'></span></td>
		</tr>
		<tr>
        	<td>Invoice No.</td>
			<td><input type="text" name="invoice_no" class="input_text" onKeyDown="clr_invoice()" value="<?php echo $invoice_no?>" readonly></td>
			<td id ="sales_einvoice" ><span style='color: red;'></span></td>
		</tr>
		<tr>
			<td>Invoice Date</td>
			<td><input type="text" name="invoice_date"  placeholder="DD-MM-YYYY" class="input_text date" onKeyDown="clr_id()"value = "<?php echo convert_date($invoice_date);?>"></td>
		<td id ="sales_epurchase" ><span style='color: red;'></span></td>
		</tr>
		<tr>
        <tr>
			<td>Invoice Type</td>
			<td><select name="invoice_type" class="input_select">
            <?php 
				if ($invoice_type == "INSTALLATION"){
					echo '<option value="INSTALLATION" selected>INSTALLATION</option>
            			<option value="AMC" >AMC</option>
            			<option value="CBS">CBS</option>
            			<option Value="CALL BASED SUPPORT">CALL BASED SUPPORT</option>';
				}else if ($invoice_type == "AMC"){
					echo '<option value="INSTALLATION">INSTALLATION</option>
            			<option value="AMC" selected>AMC</option>
            			<option value="CBS">CBS</option>
            			<option Value="CALL BASED SUPPORT">CALL BASED SUPPORT</option>';			
				}else if ($invoice_type == "CBS"){
					echo '<option value="INSTALLATION">INSTALLATION</option>
            			<option value="AMC" >AMC</option>
            			<option value="CBS" selected>CBS</option>
            			<option Value="CALL BASED SUPPORT">CALL BASED SUPPORT</option>';
				}else if ($invoice_type == "CALL BASED SUPPORT"){
					echo '<option value="INSTALLATION">INSTALLATION</option>
            			<option value="AMC" >AMC</option>
            			<option value="CBS">CBS</option>
            			<option Value="CALL BASED SUPPORT"  selected>CALL BASED SUPPORT</option>';
				}
			?>
            </select>
            
            </td>
            
		<td id ="sales_epurchase" ><span style='color: red;'></span></td>
		</tr>
		<tr>
		<td>Starting Date</td>
			<td><input type="text" name="starting_date"  placeholder="DD-MM-YYYY" class="input_text date" onKeyUp="prchsedate_chk()" onKeyDown="clr_sd()" value = "<?php echo convert_date($starting_date);?>"></td>
		<td id ="sales_esdate"> <span style='color: red;'></span></td>
		</tr>
		<tr>
		<td>Duration</td>
		<td><input type="number" name="duration" placeholder="in months" min="1" class="input_text" onKeyDown="clr_d()" onKeyUp="date_difference()" value = "<?php echo $duration;?>"></td>
		<td id ="sales_ewarranty" ><span style='color: red;'></span></td>
		</tr>
		<tr>
		<td>End Date</td>
		<td><input type="text" name="end_date" placeholder="DD-MM-YYYY" class="input_text date" onKeyUp="prchsedate_chk()" onKeyDown="clr_ed()" value = "<?php echo convert_date($end_date);?>"> </td>
		<td id ="sales_eedate" ><span style='color: red;'></span></td>
		</tr>
		<tr>
		<td>Amount( &#8377 )</td>
		<td><input type="number" name="amount" min="1" class="input_text" onChange="calculate_tax()" onKeyDown="clr_a()" value = "<?php echo $amount;?>" readonly></td>
		<td id ="sales_eamount" ><span style='color: red;'></span></td>
		</tr>
        <tr>
        <td>Tax(%)</td>
		<td><input type="text" name="tax" min="1" step="0.01" class="input_text" onChange="calculate_tax()" value = "<?php echo $tax;?>" readonly></td>
		<td id ="sales_equantity" ><span style='color: red;'></span></td>
		</tr>
        <tr>
        <td>Total Amount( &#8377 )</td>
		<td><input type="number" name="total_amount" step="0.01" min="1" class="input_text" onChange="clr_ta()"  value = "<?php echo $total_amount;?>" readonly></td>
		<td id ="sales_etamount" ><span style='color: red;'></span></td>
		</tr>
        
		<tr>
			<td></td>
			<td><input type="submit" value="SUBMIT" class="submit"/></td>
		</tr>
	</table>
	</form>
</div>
</div>
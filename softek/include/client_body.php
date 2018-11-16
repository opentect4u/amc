<div class="customer_body">
	<h1>NEW CUSTOMER ENTRY</h1>
	<form name="add_client_form" method="POST" action="#" onsubmit="return valid_form()">
	<table>
		<tr>
			<td> Name</td>
			<td><input type="text" name="client_name" class="input_text" onKeyDown="cus_name_one()" /></td>
			<td id ="cus_ename" <span style='color: red;'></span></td>
		</tr>
        <tr>
			<td> Type</td>
            <td><?php require 'fetch_product.php' ;
				echo '<select name="client_type" class="input_select">';
				if(mysqli_num_rows($product_result)>0){
					while($product_data=mysqli_fetch_assoc($product_result)){
					echo '<option value="'.$product_data["product_id"].'">'.$product_data["product_id"].' '.$product_data["product_type"].'</option>';
					
					}
					
				}
				echo '</select>';
			?>
            </td>
			<td id ="cus_etype" <span style='color: red;'></span></td>
		</tr>
       	<tr>
			<td> Contact Person</td>
			<td><input type="text" name="contact_person" class="input_text" onKeyDown="cus_contact_person_one()" /></td>
			<td id ="cus_econtact_person" <span style='color: red;'></span></td>
		</tr>
        
        <tr>
			<td> Designation</td>
			<td><input type="text" name="designation" class="input_text" onKeyDown="cus_designation_one()" /></td>
			<td id ="cus_edesignation" <span style='color: red;'></span></td>
		</tr>
        
        <tr>
			<td> Phone No</td>
			<td><input type="text"  name="client_phone" class="input_text" onKeyUp="phn_no_chk()" onKeyDown="cus_phone()" /></td>
			<td id ="cus_ephone" <span style='color: red;'></span></td>
		</tr>
        
        <tr>
			<td> SSS Marketing Person</td>
           <td> <?php require 'fetch_marketing.php' ;
		   		echo '<select name="sss_man" class="input_select">';
				if(mysqli_num_rows($marketing_result)>0){
					while($marketing_data=mysqli_fetch_assoc($marketing_result)){
					echo '<option value="'.$marketing_data["emp_name"].'">'.$marketing_data["emp_name"].' '.$marketing_data["emp_code"].'</option>';
					
					}
					
				}
				echo '</select>';
			?>
		   		
		   
		   
		   </td>
			<td id ="cus_esss_man" <span style='color: red;'></span></td>
		</tr>
        
        <tr>
			<td> State</td>
            <td><?php require 'fetch_state.php' ;
				echo '<select name="state" class="input_select">';
				//echo '<input type="text"  list = "lstate" name="state" class="input_text" onChange="cus_state()" />';
				//echo '<datalist id="lstate">';
				if(mysqli_num_rows($state_result)>0){
					while($state_data=mysqli_fetch_assoc($state_result)){
					echo '<option value="'.$state_data["state_name"].'">'.$state_data["state_name"].'</option>';
					
					}
					
				}
				echo '</select>';
				//echo '</datalist>';
			?><td>
			
			<td id ="cus_estate" <span style='color: red;'></span></td>
		</tr>
        
        <tr>
			<td> District</td>
                        <td><?php require 'fetch_state.php' ;
						echo '<select name="district" class="input_select">';
				//echo '<input type="text"  list = "ldistrict" name="district" class="input_text" onChange="cus_district()" />';
				//echo '<datalist id="ldistrict">';
				if(mysqli_num_rows($district_result)>0){
					while($district_data=mysqli_fetch_assoc($district_result)){
					echo '<option value="'.$district_data["district_name"].'">'.$district_data["district_name"].'</option>';
					
					}
					
				}
				echo '</select>';
				//echo '</datalist>';
			?><td>

			<td id ="cus_edistrict" <span style='color: red;'></span></td>
		</tr>
         
		<tr>
			<td> Address</td>
			<td><textarea name="client_address" class="input_textarea" onKeyDown="cus_address_one()"></textarea></td>
			<td id ="cus_eadd" <span style='color: red;'></span></td>
		</tr>
        
        <tr>
			<td> Pin Code</td>
			<td><input type="text"  name="pin_code" class="input_text"  onKeyDown="cus_pin_code()" /></td>
			<td id ="cus_epin_code" <span style='color: red;'></span></td>
		</tr>
		<tr>
			<td> Email ID</td>
			<td><input type="email" placeholder="example@abc.xyz" name="client_email" class="input_text"/></td>
			<td id ="cus_eemail" <span style='color: red;'></span></td>
		</tr>
        
        <tr>
		<td>Remarks</td>
		<td><textarea name="remarks" class="input_textarea" onKeyDown="clr_remrk()"></textarea></td>
		<td id ="client_eremark" <span style='color: red;'></span></td>
		</tr>

		<tr>
			<td></td>
			<td><input type="submit" value="ADD" class="submit"/></td>
		</tr>

	</table>
	</form>
</div>

<?php 
require '../lib/connection.php';
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$client_code=trim_data($_GET["client_code"]);
			$retrieve_data="SELECT `client_id`, `client_name`, `client_type`, `contact_person`, `designation`, `contact_no`, `sss_man`, `state`, `district`, `address`, `pin_code`, `email`, `remarks`, `client_status`, `updated_by`, `date_time` FROM `mm_client_master` WHERE client_id='".$client_code."'";
			$report_result = mysqli_query($conn,$retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
							
							while($report_data = mysqli_fetch_array($report_result,MYSQLI_NUM)) {
								$customer_code = $report_data[0];
								$customer_name = $report_data[1];
								$customer_type = $report_data[2];
								$contact_person =$report_data[3];
								$designation =	 $report_data[4];
								$contact_no = $report_data[5];
								$sss_man = $report_data[6];
								$state = $report_data[7];
								$district = $report_data[8];
								$address = $report_data[9];
								$pin_code = $report_data[10];
								$email = $report_data[11];
								$remarks = $report_data[12];
								$client_status = $report_data[13];
								$updated_by = $report_data[14];
								$date_time = $report_data[15];

							}
						}
					}
				
			}


		function trim_data($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		$data = strtoupper($data);
		return $data;
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>SYNERGIC EDIT CUSTOMERS</title>
<link rel="icon" href="../favicon.ico">
<link rel="stylesheet" type="text/css" href="style/style.css">
<script type="text/javascript">
			
	</script>


</head>
<body>
<div class="header">
		<?php require 'include/header.php';?>
	</div>
	<div class="nav_holder">
		<?php require 'include/nav.php';?>
	</div>
	<div class="client_body">
<div class="customer_body">
	<h1>SYNERGIC EDIT CUSTOMERS </h1>
	<form name="add_client_form" method="POST" action="view/edit_client.php" onsubmit="return valid_form()">
	<table>
		
            <tr>
			<td> Code</td>
			<td><input type="text" name="client_id" class="input_text" onKeyDown="cus_name_one()" readonly value="<?php echo $customer_code ;?>"/></td
			></tr>
			
            <tr>
			<td> Name</td>
			<td><input type="text" name="client_name" class="input_text" onKeyDown="cus_name_one()" value="<?php echo $customer_name ;?>"/></td>
			<td id ="cus_ename" <span style='color: red;'></span></td>
		</tr>
        <tr>
			<td> Type</td>
			<td><?php require 'include/fetch_product.php' ;
				echo '<select name="client_type" class="input_select">';
				if(mysqli_num_rows($product_result)>0){
					while($product_data=mysqli_fetch_assoc($product_result)){
						if($customer_type!=$product_data["product_id"])
					echo '<option value="'.$product_data["product_id"].'">'.$product_data["product_id"].' '.$product_data["product_type"].'</option>';
						else
						echo '<option value="'.$product_data["product_id"].'" selected>'.$product_data["product_id"].' '.$product_data["product_type"].'</option>';
					
					}
					
				}
				echo '</select>';
			?></td>
			<td id ="cus_etype" <span style='color: red;'></span></td>
		</tr>
       	<tr>
			<td> Contact Person</td>
			<td><input type="text" name="contact_person" class="input_text" onKeyDown="cus_contact_person_one()" value="<?php echo $contact_person  ;?>"/></td>
			<td id ="cus_econtact_person" <span style='color: red;'></span></td>
		</tr>
        
        <tr>
			<td> Designation</td>
			<td><input type="text" name="designation" class="input_text" onKeyDown="cus_designation_one()" value="<?php echo $designation ;?>"/></td>
			<td id ="cus_edesignation" <span style='color: red;'></span></td>
		</tr>
        
        <tr>
			<td> Phone No</td>
			<td><input type="text"  name="client_phone" class="input_text" onKeyUp="phn_no_chk()" onKeyDown="cus_phone()" value="<?php echo $contact_no ;?>"/></td>
			<td id ="cus_ephone" <span style='color: red;'></span></td>
		</tr>
        
        <tr>
			<td> SSS Marketing Person</td>
			<td> <?php require 'include/fetch_marketing.php' ;
		   		echo '<select name="sss_man" class="input_select">';
				if(mysqli_num_rows($marketing_result)>0){
					while($marketing_data=mysqli_fetch_assoc($marketing_result)){
						if($sss_man!=$marketing_data["emp_name"])
							echo '<option value="'.$marketing_data["emp_name"].'">'.$marketing_data["emp_name"].' '.$marketing_data["emp_code"].'</option>';
						else
							echo '<option value="'.$marketing_data["emp_name"].'" selected>'.$marketing_data["emp_name"].' '.$marketing_data["emp_code"].'</option>';
					}
				}
					
				echo '</select>';
			?>
		   		
		   
		   
		   </td>
			<td id ="cus_esss_man" <span style='color: red;'></span></td>
		</tr>
        
        <tr>
			<td> State</td>
            <td><?php require 'include/fetch_state.php' ;
				echo '<select name="state" class="input_select">';
				//echo '<input type="text"  list = "lstate" name="state" class="input_text" onChange="cus_state()" />';
				//echo '<datalist id="lstate">';
				if(mysqli_num_rows($state_result)>0){
					while($state_data=mysqli_fetch_assoc($state_result)){
						if($state!=$state_data["emp_name"])
							echo '<option value="'.$state_data["state_name"].'">'.$state_data["state_name"].'</option>';
						else
							echo '<option value="'.$state_data["state_name"].'" selected>'.$state_data["state_name"].'</option>';
					
					}
					
				}
				echo '</select>';
				//echo '</datalist>';
			?></td>
			<td id ="cus_estate" <span style='color: red;'></span></td>
		</tr>
        
        <tr>
            <td> District</td>
                        <td><?php require 'include/fetch_state.php' ;
						echo '<select name="district" class="input_select">';
				//echo '<input type="text"  list = "ldistrict" name="district" class="input_text" onChange="cus_district()" />';
				//echo '<datalist id="ldistrict">';
				if(mysqli_num_rows($district_result)>0){
					while($district_data=mysqli_fetch_assoc($district_result)){
					if($district!=$district_data["emp_name"])
							echo '<option value="'.$district_data["district_name"].'">'.$district_data["district_name"].'</option>';
						else
							echo '<option value="'.$district_data["district_name"].'" selected>'.$district_data["district_name"].'</option>';
					
					}
					
				}
				echo '</select>';
				//echo '</datalist>';
			?></td>

			<td id ="cus_edistrict" <span style='color: red;'></span></td>
		</tr>
         
		<tr>
			<td> Address</td>
			<td><textarea name="client_address" class="input_textarea" onKeyDown="cus_address_one()"><?php echo $address;?></textarea></td>
			<td id ="cus_eadd" <span style='color: red;'></span></td>
		</tr>
        
        <tr>
			<td> Pin Code</td>
			<td><input type="text"  name="pin_code" class="input_text"  onKeyDown="cus_pin_code()" value="<?php echo $pin_code ;?>"/></td>
			<td id ="cus_epin_code" <span style='color: red;'></span></td>
		</tr>
		<tr>
			<td> Email ID</td>
			<td><input type="email" placeholder="example@abc.xyz" name="client_email" class="input_text" value="<?php echo $email ;?>"/></td>
			<td id ="cus_eemail" <span style='color: red;'></span></td>
		</tr>
        
        <tr>
		<td>Remarks</td>
		<td><textarea name="remarks" class="input_textarea" onKeyDown="clr_remrk()" value=""><?php echo $remarks ;?></textarea></td>
		<td id ="client_eremark" <span style='color: red;'></span></td>
		</tr>
        <tr>
		<td>Status</td>
		<td><?php echo '<select name="client_status" class="input_select">';
					if($client_status == 'ACTIVE'){
							echo '<option value="DEACTIVATE">DEACTIVATE</option>';
							echo '<option value="ACTIVE" selected>ACTIVE</option>';
					}else{
						echo '<option value="DEACTIVATE" selected>DEACTIVATE</option>';
						echo '<option value="ACTIVE" >ACTIVE</option>';
					}
					
					
				
				echo '</select>';
			?>
        </td>
		</tr>    
		<tr>
			<td></td>
			<td><input type="submit" value="UPDATE" class="submit"/></td>
		</tr>
		
	</table>
	</form>
</div>
</div>
<div class = "footer" style="clear: both;">
		<?php require 'include/footer.php';?>
	</div>
</body>
</html>

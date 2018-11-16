<!DOCTYPE html>
<html>
<head>
	<title>SYNERGIC AMC REPORTS</title>
</head>
<body>

</body>
</html>
<div class="reports_body">
	<h1>MONTHLY REPORT</h1>
	<form name="report_form" action="#" method="POST">
	<table >
		<tr>
			<td>STARTING DATE</td>
		<td><input type="text" name="starting_date" placeholder="DD-MM-YYYY" class="input_text date"></td>
			<td>END DATE</td>
			<td><input type="text" name="end_date" placeholder="DD-MM-YYYY" class="input_text date"></td>
			<td><input type="submit" name="submit" value="SEARCH" class = "submit"></td>
		</tr>
        <tr>
        	<td><h3>FILTER</h3></td>
        </tr>
        <tr>
        	<td>C TYPE</td>
            <td><?php require 'fetch_product.php' ;
				echo '<select name="client_type" class="input_select">';
				echo '<option value = "ALL" selected > --ALL--</option>';
				if(mysqli_num_rows($product_result)>0){
					while($product_data=mysqli_fetch_assoc($product_result)){
					echo '<option value="'.$product_data["product_id"].'">'.$product_data["product_id"].' '.$product_data["product_type"].'</option>';
					
					}
					
				}
				echo '</select>';
			?></td>
            <td>DISTRICT</td>
            <td><?php require 'fetch_state.php' ;
						echo '<select name="district" class="input_select">';
						echo '<option value = "ALL" selected > --ALL--</option>';
				if(mysqli_num_rows($district_result)>0){
					while($district_data=mysqli_fetch_assoc($district_result)){
					echo '<option value="'.$district_data["district_name"].'">'.$district_data["district_name"].'</option>';
					
					}
					
				}
				echo '</select>';
			?></td>
         </tr>
         <tr>
            <td>SALES PRESON</td>
            <td><?php require 'fetch_marketing.php' ;
		   		echo '<select name="sss_man" class="input_select">';
				echo '<option value = "ALL" selected > --ALL--</option>';
				if(mysqli_num_rows($marketing_result)>0){
					while($marketing_data=mysqli_fetch_assoc($marketing_result)){
					echo '<option value="'.$marketing_data["emp_name"].'">'.$marketing_data["emp_name"].' '.$marketing_data["emp_code"].'</option>';
					
					}
					
				}
				echo '</select>';
			?></td>
            <td>INV TYPE</td>
            <td><select name="invoice_type" class="input_select">
            <option value = "ALL" selected > --ALL-- </option>
            <option value="INSTALLATION">INSTALLATION</option>
            <option value="AMC">AMC</option>
            <option value="CBS">CBS</option>
            <option Value="CALL BASED SUPPORT">CALL BASED SUPPORT</option>
            </select></td>
          </tr>
          <tr>
            <td>C STATUS</td>
            <td><select name="client_status" class="input_select">
            <option value = "ALL"> --ALL-- </option>
            <option value="ACTIVE" selected >ACTIVE</option>
            <option value="DEACTIVATE">DEACTIVATE</option>
            </select></td>
            <td>BASED ON</td>
            <td><select name="search_based" class="input_select">
            <option value="START">START DT</option>
            <option value="END" selected >END DT</option>
            </select></td>
        </tr>
	</table>
	</form>

</div>
<div class = "report_result">
<?php require 'search_report_amc.php'; ?>

</div>
</body>
</html>
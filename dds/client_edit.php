<?php 
require '../lib/connection.php';
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$client_code=trim_data($_GET["client_code"]);
			$retrieve_data="SELECT `client_code`, `client_name`, `client_address`, `client_phone`, `client_email` FROM `client_master` WHERE client_code='".$client_code."'";
			$report_result = mysqli_query($conn,$retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
							
							while($report_data = mysqli_fetch_array($report_result,MYSQLI_NUM)) {
								$customer_code =  $report_data[0];
								$customer_name =	 $report_data[1];
								$customer_address = $report_data[2];
								$customer_phone = $report_data[3];
								$customer_email = $report_data[4];

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
<title>SYNERGIC ETIM EDIT CUSTOMERS</title>
<link rel="stylesheet" type="text/css" href="style/style.css">
<script type="text/javascript">
			function valid_form(){
			var a=document.add_client_form.customer_name.value;
			var b=document.add_client_form.customer_address.value;
			var c=document.add_client_form.customer_phone.value;
			var e=document.add_client_form.customer_email.value;
		if (a.trim() == ""){ 
      	document.getElementById('cus_ename').innerHTML="Please Enter Customer Name";
    	return false;
   		}
   		/*else if (b.trim() == ""){ 
      	document.getElementById('cus_eadd').innerHTML="Please Enter Cutomer Address";
    	return false;
   		}*/
   		else if(c.trim() == ""){
   			document.getElementById('cus_ephone').innerHTML="Please Enter your Phone Number";
   			return false;
   		}
   		else if(e.trim() != "")
   			if(e.length==0|| e.search("@")==-1||e.indexOf(".")<e.search("@")|| e.indexOf(".")==(e.search("@")+1) && e.trim() == ""){
   			document.getElementById('cus_eemail').innerHTML="Please Enter Valid Email Id";
   			return false;
   		}
   		/*else if(isNaN(c)||c.indexOf(" ")!=-1)
           {
              document.getElementById('cus_ephone').innerHTML="Please Enter Numeric value";
              return false;
           }*/
   		else{
   			return true;
   		}
   	}

   		function cus_name_one(){
				document.getElementById('cus_ename').innerHTML="";
			}
		function cus_address_one(){
			document.getElementById('cus_eadd').innerHTML="";
			}
		function cus_phone(){
			document.getElementById('cus_ephone').innerHTML="";
		}
		function cus_email(){
			document.getElementById('cus_eemail').innerHTML="";
		}
		/*function phn_no_chk(){
			var x = document.add_client_form.customer_phone.value;
           if(isNaN(x)||x.indexOf(" ")!=-1||x.indexOf(" ")!='-1')
           {
              document.getElementById('cus_ephone').innerHTML="Please Enter Numeric value";
              return false;
           }
           else{
           	return true;
           }
		}*/
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
	<h1>ETIM EDIT CUSTOMERS </h1>
	<form name="add_client_form" method="POST" action="view/edit_client.php" onsubmit="return valid_form()">
	<table>
		<tr>
			<td> Code</td>
			<td><input type="text" name="customer_code" class="input_text" onKeyDown="cus_name_one()" readonly value="<?php echo $customer_code ;?>"/></td>
			
		</tr>
		<tr>
			<td> Name</td>
			<td><input type="text" name="customer_name" class="input_text" onKeyDown="cus_name_one()" value="<?php echo $customer_name ;?>"/></td>
			<td id ="cus_ename" <span style='color: red;'></span></td>
		</tr>
		<tr>
			<td> Address</td>
			<td><textarea name="customer_address" class="input_textarea" onKeyDown="cus_address_one()"><?php echo $customer_address;?></textarea></td>
			<td id ="cus_eadd" <span style='color: red;'></span></td>
		</tr>
		<tr>
			<td> Phone Number</td>
			<td><input type="text"  name="customer_phone" class="input_text" onKeyUp="phn_no_chk()" onKeyDown="cus_phone()" value="<?php echo $customer_phone ;?>" /></td>
			<td id ="cus_ephone" <span style='color: red;'></span></td>
		</tr>
		<tr>
			<td> Email Id</td>
			<td><input type="text" id="test_email" name="customer_email" placeholder="example@abc.xyz"  class="input_text" onKeyDown="cus_email()" value="<?php echo $customer_email ;?>"/></td>
			<td id ="cus_eemail" <span style='color: red;'></span></td>
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

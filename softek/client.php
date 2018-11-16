<?php include '../lib/connection.php'; ?>
<?php
if($_SESSION['insert_flag'] == "client")
			{
				echo '<script>alert("Added Successfully");</script>';
				$_SESSION['insert_flag']="";
			}
if($_SESSION['insert_flag'] != "" && $_SESSION['insert_flag'] != "client"){
			header('location:'.$l_softek_logout.'');
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>SYNERGIC SOFTEK CUSTOMERS</title>
    <link rel="icon" href="../favicon.ico">
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<script type="text/javascript">
			function valid_form(){
			var a=document.add_client_form.client_name.value;
			var b=document.add_client_form.client_type.value;
			var c=document.add_client_form.contact_person.value;
			var d=document.add_client_form.designation.value;
			var e=document.add_client_form.client_phone.value;
			var f=document.add_client_form.sss_man.value;
			var g=document.add_client_form.state.value;
			var h=document.add_client_form.district.value;
			var i=document.add_client_form.client_address.value;
			var j=document.add_client_form.pin_code.value;
			var k=document.add_client_form.client_email.value;
		if (a.trim() == ""){ 
      	document.getElementById('cus_ename').innerHTML="Please Enter Customer Name";
    	return false;
   		}
   		/*else if (b.trim() == ""){ 
      	document.getElementById('cus_eadd').innerHTML="Please Enter Cutomer Address";
    	return false;
   		}*/
		else if(b.trim() == ""){
		document.getElementById('cus_etype').innerHTML="Please Enter Customer Type";
    	return false;
		}
		else if(c.trim() == "")
		{
		document.getElementById('cus_econtact_person').innerHTML="Please Enter Contact Person";
    	return false;
		}
		
   		else if(e.trim() == ""){
   			document.getElementById('cus_ephone').innerHTML="Please Enter your Phone Number";
   			return false;
   		}
		else if(isNaN(e)||e.indexOf(" ")!=-1)
           {
              document.getElementById('cus_ephone').innerHTML="Please Enter Numeric value";
              return false;
           }
		else if(f.trim() == ""){
		document.getElementById('cus_esss_man').innerHTML="Please Enter Marketing Person";
    	return false;
		}
		else if(g.trim() == ""){
		document.getElementById('cus_estate').innerHTML="Please Enter State";
    	return false;
		}
		else if(h.trim() == ""){
		document.getElementById('cus_edistrict').innerHTML="Please Enter District";
    	return false;
		}
   		

   		else{
   			return true;
   		}
   	}

   		function cus_name_one(){
				document.getElementById('cus_ename').innerHTML="";
			}
		
		function cus_type_one(){
				document.getElementById('cus_etype').innerHTML="";
			}
		function cus_contact_person_one(){
				document.getElementById('cus_econtact_person').innerHTML="";
			}
		function cus_sss_man(){
				document.getElementById('cus_esss_man').innerHTML="";
			}
		function cus_state(){
				document.getElementById('cus_estate').innerHTML="";
			}
		function cus_district(){
				document.getElementById('cus_edistrict').innerHTML="";
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
		function phn_no_chk(){
			var x = document.add_client_form.client_phone.value;
           if(isNaN(x)||x.indexOf(" ")!=-1||x.indexOf(" ")!='-1')
           {
              document.getElementById('cus_ephone').innerHTML="Please Enter Numeric value";
              return false;
           }
		   else {
		   	return true;
		   }
		}
	</script>
	</head>
<body>
	<div class="header">
		<?php require 'include/header.php';?>
	</div>
	<div class="nav_holder">
		<?php require 'include/nav.php';?>
	</div>
	<?php require '../lib/connection.php';?>
	<div class="client_body">
		<?php require 'include/add_client.php';?>
		<?php require 'include/client_body.php';?>
	</div>
	<div class = "footer" style="clear: both;">
		<?php require 'include/footer.php';?>
	</div>
</body>
</html>
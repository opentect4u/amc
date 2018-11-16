<?php include '../lib/connection.php'; ?>
<?php
if($_SESSION['insert_flag'] == "client")
			{
				echo '<script>alert("Added Successfully");</script>';
				$_SESSION['insert_flag']="";
			}
if($_SESSION['insert_flag'] != "" && $_SESSION['insert_flag'] != "client"){
			header('location:'.$l_dds_logout.'');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>SYNERGIC ETIM CUSTOMERS</title>
	<link rel="icon" href="../favicon.ico">
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
   			if(e.length==0|| e.search("@")==-1||e.search("COM")==-1|| e.indexOf(".")<e.search("@")|| e.indexOf(".")==(e.search("@")+1) && e.trim() == ""){
   			document.getElementById('cus_eemail').innerHTML="Please Enter Valid Email Id";
   			return false;
   		}
   		else if(isNaN(c)||c.indexOf(" ")!=-1)
           {
              document.getElementById('cus_ephone').innerHTML="Please Enter Numeric value";
              return false;
           }
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
		function phn_no_chk(){
			var x = document.add_client_form.customer_phone.value;
           if(isNaN(x)||x.indexOf(" ")!=-1||x.indexOf(" ")!='-1')
           {
              document.getElementById('cus_ephone').innerHTML="Please Enter Numeric value";
              return false;
           }
           else{
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
	<div class="client_body">
		<?php require 'include/add_client.php';?>
		<?php require 'include/client_body.php';?>
	</div>
	<div class = "footer" style="clear: both;">
		<?php require 'include/footer.php';?>
	</div>
</body>
</html>
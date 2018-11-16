<?php require '../lib/connection.php';?>
<!DOCTYPE html>
<html>
<head>
	<title>SYNERGIC ADD USER</title>
	<link rel="icon" href="../favicon.ico">
<link rel="stylesheet" type="text/css" href="style/style.css">
	<script type="text/javascript">
		function valid_form(){
			var y= document.add_user_form.user_id.value;
			var x= document.add_user_form.user_password.value;
			var z= document.add_user_form.user_type.value;

			if (y.trim() == ""){
			document.getElementById('user_eid').innerHTML="Please Enter User Id"; 
	    	return false;
	   		}
	   		else if(x.trim() == ""){
	   		document.getElementById('user_epassword').innerHTML="Please Enter User Password";
	    	return false;
	   		}
	   		else if(z.trim() == ""){
	   		document.getElementById('user_type').innerHTML="Please Enter Account Type";
	   		return false;	
	   		}
	   		else{
	   		return true;
	   		} 
		}
		function item_nameone(){
			document.getElementById('user_eid').innerHTML="";
		}
		function item_typeone(){
			document.getElementById('user_epassword').innerHTML="";
		}
		function item_app(){
			document.getElementById('user_type').innerHTML="";
		}
	</script>
</head>
<body>
	<div class="header">
		<?php require 'include/header.php';?>
	</div>
	<div class="nav_holder">
		<?php require 'include/admin_nav.php';?>
	</div>
	<div class= "item_body_container">
	<?php require 'include/add_user.php'; ?>
	<?php require 'include/admin_add_user_body.php';?>
	</div>
	<div class = "footer" style="clear: both;">
		<?php require 'include/footer.php';?>
	</div>
</body>
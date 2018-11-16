<?php include '../lib/connection.php'; ?>
<?php
if($_SESSION['insert_flag'] == "password")
			{
				echo '<script>alert("Updated Successfully");</script>';
				$_SESSION['insert_flag']="";
			}
if($_SESSION['insert_flag'] != "" && $_SESSION['insert_flag'] != "password"){
			header('location:'.$l_softek_logout.'');
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style/style.css">
<title>CHANGE PASSWORD
</title>
	<script type="text/javascript">
		function valid_form(){
			var x= document.add_product_form.old_password.value;
			var y= document.add_product_form.new_password.value;
			var z= document.add_product_form.confirm_password.value;
			
			if (x.trim() == ""){
			document.getElementById('product_e1').innerHTML="Please Enter Old Password"; 
	    	return false;
	   		}
			if (y.trim() == ""){
			document.getElementById('product_e2').innerHTML="Please Enter New Password"; 
	    	return false;
	   		}
			if (z.trim() == ""){
			document.getElementById('product_e3').innerHTML="Please Enter Password Again"; 
	    	return false;
	   		}
			if(y!=z){
	   		return false;
	   		} 
	   		else if(y==z){
	   		return true;
	   		} 
		}
		function product_typeone(){
			document.getElementById('product_e1').innerHTML="";
		}
		function product_typetwo(){
			document.getElementById('product_e2').innerHTML="";
		}
		function product_typethree(){
			var y= document.add_product_form.new_password.value;
			var z= document.add_product_form.confirm_password.value;
			if(y!=z){
				document.getElementById('product_e3').innerHTML="Not Matched!";
				if(z=="")
				{
					document.getElementById('product_e3').innerHTML="";
				}
			}
			else if(y==z)
				document.getElementById('product_e3').innerHTML="Matched!";
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
<div class="item_body_container">
<div class="item_body">
	<h1>CHANGE PASSWORD</h1>
	<form name="add_product_form" method="POST" action="view/edit_change_pass.php" onsubmit="return valid_form()">
	<table>        
        <tr>
			<td>Old Password</td>
			<td><input type="password" name="old_password" class="input_text" onKeyDown="product_typeone()" /></td>
			<td id ="product_e1" <span style='color: red;'></span></td>
		</tr>
        <tr>
			<td>New Password</td>
			<td><input type="password" name="new_password" class="input_text" onKeyDown="product_typetwo()" /></td>
			<td id ="product_e2" <span style='color: red;'></span></td>
		</tr>
        <tr>
			<td>Confirm Password</td>
			<td><input type="password" name="confirm_password" class="input_text" onKeyUp="product_typethree()" /></td>
			<td id ="product_e3" <span style='color: red;'></span></td>
		</tr>
         <tr>
         <td></td>
         <td><input type="submit" value="UPDATE" class="submit"></td>
			
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
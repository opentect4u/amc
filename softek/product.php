<?php include '../lib/connection.php'; ?>
<?php
if($_SESSION['insert_flag'] == "product")
			{
				echo '<script>alert("Added Successfully");</script>';
				$_SESSION['insert_flag']="";
			}
if($_SESSION['insert_flag'] != "" && $_SESSION['insert_flag'] != "product"){
			header('location:'.$l_softek_logout.'');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>SYNERGIC SOFTEK CLIENT TYPE</title>
	<link rel="icon" href="../favicon.ico">
<link rel="stylesheet" type="text/css" href="style/style.css">
	<script type="text/javascript">
		function valid_form(){
			var x= document.add_product_form.product_type.value;

			if (x.trim() == ""){
			document.getElementById('product_etype').innerHTML="Please Enter Client Type"; 
	    	return false;
	   		}
	   		else{
	   		return true;
	   		} 
		}
		function product_typeone(){
			document.getElementById('product_etype').innerHTML="";
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
	<div class="item_body_container">
	
	<?php require 'include/add_product.php';?>
	<?php require 'include/product_body.php';?>
	</div>
	<div class = "footer" style="clear: both;">
		<?php require 'include/footer.php';?>
	</div>
</body>
</html>

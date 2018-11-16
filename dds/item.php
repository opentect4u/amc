<?php include '../lib/connection.php'; ?>
<?php
if($_SESSION['insert_flag'] == "item")
			{
				echo '<script>alert("Added Successfully");</script>';
				$_SESSION['insert_flag']="";
			}
if($_SESSION['insert_flag'] == "wrongItem")
			{
				echo '<script>alert("Already Exists. Failed to Insert");</script>';
				$_SESSION['insert_flag']="";
			}			
if($_SESSION['insert_flag'] != "" && $_SESSION['insert_flag'] != "item"){
			header('location:'.$l_dds_logout.'');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>ETIM ITEM</title>
	<link rel="icon" href="../favicon.ico">
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<script type="text/javascript">
		
		function valid_form(){
			var y= document.add_item_form.item_name.value;
			var x= document.add_item_form.item_type.value;
			var z= document.add_item_form.item_application.value;
			
			if (x.trim() == ""){
				document.getElementById('item_etype').innerHTML="Please Enter Item Type"; 
	    		return false;
	   		}
	   		else if(y.trim() == ""){
				document.getElementById('item_ename').innerHTML="Please Enter Item Name";
				return false;
	   		}
	   		else if(z.trim() == ""){
				document.getElementById('item_eapplication').innerHTML="Please Enter Application Type";
				return false;	
	   		}
	   		else{
	   			return true;
	   		} 
		}
		function item_nameone(){
			document.getElementById('item_ename').innerHTML="";
		}
		function item_typeone(){
			document.getElementById('item_etype').innerHTML="";
		}
		function item_app(){
			document.getElementById('item_eapplication').innerHTML="";
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
		<?php require 'include/add_item.php';?>
        <?php require 'include/item_body.php';?>
	</div>
	<div class = "footer" style="clear: both;">
		<?php require 'include/footer.php';?>
	</div>
</body>
</html>

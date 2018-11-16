<?php include '../lib/connection.php'; ?>
<?php
if($_SESSION['client_id_flag'] == "true")
			{
				echo '<script>alert("Client Does Not Exists");</script>';
				$_SESSION['client_id_flag']="";
			}
if($_SESSION['insert_flag'] == "order")
			{
				echo '<script>alert("Added Successfully");</script>';
				$_SESSION['insert_flag']="";
			}
if($_SESSION['insert_flag'] != "" && $_SESSION['insert_flag'] != "order"){
			header('location:'.$l_softek_logout.'');
}
?>




<!DOCTYPE html>
<html>
<head>
	<title>SYNERGIC SOFTEK ORDERS</title>
    <link rel="icon" href="../favicon.ico">
	<link rel="stylesheet" type="text/css" href="style/style.css">
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>
<script>
	$(document).ready(function($){
   		$("#date").mask("99-99-9999");
});
	$(document).ready(function($){
   		$("#date").css({"placeholder":"opacity:0.4"});
});
</script>
	<script type="text/javascript">
	function valid_form(){
		var a=document.order_form.order_value.value;
	
		var c=document.order_form.order_date.value;
		var b=document.order_form.exe_status.value;
		if(a.trim() == ""){
			document.getElementById('order_evalue').innerHTML="Please Input Order Amount";
			return false;
		}
		if (b.trim() == ""){
			document.getElementById('order_eexec').innerHTML="Please Input Order Status";
			return false;
		}
		 if (c.trim() == ""){
			document.getElementById('order_edate').innerHTML="Please Input Order Date";
			return false;
		}
		if (c.length!=10){
			document.getElementById('order_edate').innerHTML="Date must be 6 character";
			return false;
		}

		else{
			return true;
		}
	}
	function clr_ordervalue(){
		document.getElementById('order_evalue').innerHTML="";
	}
	function clr_exe(){
		document.getElementById('order_eexec').innerHTML="";
	}
	function clr_date(){
		document.getElementById('order_edate').innerHTML="";
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

<?php require 'include/add_order.php';?>
<?php require 'include/order_body.php';?>

	<div class = "footer" style="clear: both;">
		<?php require 'include/footer.php';?>
	</div>
</body>
</html>
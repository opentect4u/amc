<?php include '../lib/connection.php'; ?>
<?php
if($_SESSION['rdata']=="true"){
	if($_SESSION['count_flag']!=""){
		echo '<script>alert("Total Item Quantity is: '.$_SESSION['count_flag'].'");</script>';				
		if($_SESSION['invoice_flag']=="true")
			echo '<script>alert("Invoice Number Already Exists");</script>';
		elseif($_SESSION['serial_flag']=="true")
			echo '<script>alert("Serial Number Already Exists : '.$_SESSION['eserial'].'");</script>';
			
						
	}
	else
		echo '<script>alert("Please match the quantities and item serial numbers");</script>';
	
				$_SESSION['count_flag']="";
				$_SESSION['invoice_flag']="";
				$_SESSION['serial_flag']="";
				$_SESSION['rdata']="";
}

if($_SESSION['insert_flag'] == "sale")
			{	
				echo '<script>alert("Added Successfully");</script>';
				$_SESSION['insert_flag']="";
				
			}
if($_SESSION['insert_flag'] != "" && $_SESSION['insert_flag'] != "sale"){
			header('location:'.$l_dds_logout.'');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>SYNERGIC ETIM SALES</title>
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
		var a=	document.sales_form.invoice_no.value;
		var b= document.sales_form.item_qty.value;
		var c= document.sales_form.item_warr.value;
		var d= document.sales_form.item_date.value;
		var e= document.sales_form.item_serial.value;
		var f= document.sales_form.remarks.value;
		if(a.trim() == ""){
			document.getElementById('sales_einvoice').innerHTML="Please Input Invoice no";
			return false;
		}
		else if (b.trim() == ""){
			document.getElementById('sales_equantity').innerHTML="Please Input Item Quantity";
			return false;
		}
		else if (c.trim() == ""){
			document.getElementById('sales_ewarranty').innerHTML="Please Input Item Warranty";
			return false;
		}
		else if (d.trim() == ""){
			document.getElementById('sales_epurchase').innerHTML="Please Input Purchase Date";
			return false;
		}
		else if (d.length<6){
			document.getElementById('sales_epurchase').innerHTML="Date must be 6 character";
			return false;
		}

		else if (e.trim() == ""){
			document.getElementById('sales_epsno').innerHTML="Please Input Serial No";
			return false;
		}
		/*else if (f.trim() == ""){
			document.getElementById('sales_eremark').innerHTML="Please Input Remarks";
			return false;
		}*/
		else{
			return true;
		}
	}
	function clr_invoice(){
		document.getElementById('sales_einvoice').innerHTML=" ";
	}
	function clr_itmqnty(){
		document.getElementById('sales_equantity').innerHTML="";
	}
	function clr_warr(){
		document.getElementById('sales_ewarranty').innerHTML="";
	}
	function clr_pdate(){
		document.getElementById('sales_epurchase').innerHTML="";
	}
	function clr_psn(){
		document.getElementById('sales_epsno').innerHTML="";
	}
	function clr_remrk(){
		document.getElementById('sales_eremark').innerHTML="";
	}
	/*function prchsedate_chk(){
		var x=document.sales_form.item_date.value;
		if(x.indexOf(" ")!=-1||x.indexOf(" ")!='-1'||x.length()<6)
           {
              document.getElementById('sales_epurchase').innerHTML="Please Enter a Valid Date";
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

		<?php require 'include/add_sales.php';?>
        <?php require 'include/sales_body.php';?>
        

	<div class = "footer" style="clear: both;">
		<?php require 'include/footer.php';?>
	</div>
</body>
</html>
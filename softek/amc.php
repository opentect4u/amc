<?php include '../lib/connection.php'; ?>
<?php
if($_SESSION['rdata']=="true"){
	if($_SESSION['invoice_flag']=="true"){
		echo '<script>alert("Invoice Number Already Exists");</script>';
		$_SESSION['invoice_flag']="";				
	}		
		$_SESSION['rdata']="";
}
if($_SESSION['check_order_flag'] == "true"){	
	echo '<script>alert("Order Does Not Exists");</script>';
	$_SESSION['check_order_flag']="";
	
}

if($_SESSION['insert_flag'] == "amc"){	
	echo '<script>alert("Added Successfully");</script>';
	$_SESSION['insert_flag']="";
	
}
if($_SESSION['insert_flag'] != "" && $_SESSION['insert_flag'] != "amc"){
			header('location:'.$l_softek_logout.'');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>SYNERGIC SOFTEK AMC</title>
    <link rel="icon" href="../favicon.ico">
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/jquery.maskedinput.js" type="text/javascript"></script>
	<script src="js/cal_date.js" type="text/javascript"></script>
<script>
	$(document).ready(function($){
   		$(".date").mask("99-99-9999");
});
	$(document).ready(function($){
   		$(".date").css({"placeholder":"opacity:0.4"});
});
</script>
<script>
	function calculate_tax(){
		var amount=	parseFloat(document.sales_form.amount.value);
		var tax= parseFloat(document.sales_form.tax.value);
			tax_amount=(amount*tax/100);
			total_amount= amount + tax_amount;
			document.sales_form.total_amount.value=total_amount;
		
	}
	
	function date_difference(){
		var starting_date = document.sales_form.starting_date.value;
		var duration = document.sales_form.duration.value;
		
		if(starting_date.trim() !="" && duration.trim() != ""){ 
			var end_date = calculate_date(starting_date,duration);
			document.sales_form.end_date.value= end_date;
		}
	}
	function calculate_due(){
		var total_amount=	parseFloat(document.sales_form.total_amount.value);
		var paid_amount= parseFloat(document.sales_form.paid_amount.value);
			if(!isNaN(total_amount) && !isNaN(paid_amount)){
				due_amount= total_amount - paid_amount;
				document.sales_form.due_amount.value=due_amount;
			}
			else if(paid_amount == 0 || paid_amount == ""){
				due_amount= total_amount;
				document.sales_form.due_amount.value=due_amount;	
			}
	}
	//function convertDate(inputFormat) {
 	//	function pad(s) { return (s < 10) ? '0' + s : s; }
  	//	var d = new Date(inputFormat);
  	//	return [pad(d.getDate()), pad(d.getMonth()+1), d.getFullYear()].join('-');
	//}
</script>



	<script type="text/javascript">
	function valid_form(){
		var a=	document.sales_form.invoice_no.value;
		var b= document.sales_form.invoice_date.value;
		var c= document.sales_form.starting_date.value;
		var d= document.sales_form.duration.value;
		var e= document.sales_form.end_date.value;
		var f= document.sales_form.amount.value;
		var g= document.sales_form.total_amount.value;
		var h= document.sales_form.paid_amount.value;
		var i= document.sales_form.due_amount.value;
		if(a.trim() == ""){
			document.getElementById('sales_einvoice').innerHTML="Please Input Invoice no";
			return false;
		}
		else if (b.trim() == ""){
			document.getElementById('sales_epurchase').innerHTML="Please Input Invoice Date";
			return false;
		}
		else if (c.trim() == ""){
			document.getElementById('sales_esdate').innerHTML="Please Input Starting Date";
			return false;
		}
		else if (d.trim() == ""){
			document.getElementById('sales_ewarranty').innerHTML="Please Input Duration";
			return false;
		}

		else if (e.trim() == ""){
			document.getElementById('sales_eedate').innerHTML="Please Input End Date";
			return false;
		}
		else if (f.trim() == ""){
			document.getElementById('sales_eamount').innerHTML="Please Input Amount";
			return false;
		}
		else if (g.trim() == ""){
			document.getElementById('sales_etamount').innerHTML="Please Input Total Amount";
			return false;
		}
		else if (h.trim() == ""){
			document.getElementById('sales_epamount').innerHTML="Please Input Paid Amount";
			return false;
		}
		else if (i.trim() == ""){
			document.getElementById('sales_edamount').innerHTML="Please Input Due Amount";
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
	function clr_id(){
		document.getElementById('sales_epurchase').innerHTML="";
	}
	function clr_sd(){
		document.getElementById('sales_esdate').innerHTML="";
	}
	function clr_d(){
		document.getElementById('sales_ewarranty').innerHTML="";
	}
	function clr_ed(){
		document.getElementById('sales_eedate').innerHTML="";
	}
	function clr_a(){
		document.getElementById('sales_eamount').innerHTML="";
	}
	function clr_ta(){
		document.getElementById('sales_etamount').innerHTML="";
	}
	function clr_pa(){
		document.getElementById('sales_epamount').innerHTML="";
	}
	function clr_da(){
		document.getElementById('sales_edamount').innerHTML="";
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

		<?php require 'include/add_amc.php';?>
        <?php require 'include/amc_body.php';?>

	<div class = "footer" style="clear: both;">
		<?php require 'include/footer.php';?>
	</div>
</body>
</html>
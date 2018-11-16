<?php 
require '../lib/connection.php';
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$order_id=trim_data($_GET["order_id"]);
			$retrieve_data="SELECT `order_id`, `client_id`, `order_value`, `payment`, `remarks`, `exe_status`, `order_date`, `updated_by`, `date_time` FROM `mm_order_master` WHERE order_id='".$order_id."'";
			$report_result = mysqli_query($conn,$retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
							
							while($report_data = mysqli_fetch_array($report_result,MYSQLI_NUM)) {
								$order_id =  $report_data[0];
								$client_id =	 $report_data[1];
								$order_value = $report_data[2];
								$payment = $report_data[3];
								$remarks = $report_data[4];
								$exe_status = $report_data[5];
								$order_date = $report_data[6];
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
       function convert_date($data){
         $data=date('d-m-Y',strtotime($data));
         return $data;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>SYNERGIC SOFTEK UPDATE ORDER</title>
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
	<div>
<div class="sales_body">
<div class="sales_page">
	<h1>SOFTEK UPDATE ORDER</h1>
	<form name="sales_form" method="POST" action="view/edit_order.php" onsubmit="return valid_form()">
	<table>
		<tr>
		<td>Order Code</td>
		<td><input type="text" name="order_id" class="input_text" value="<?php echo $order_id;?>" readonly></td>
		
		</tr>
		<tr>
		<td>Client Name</td>
		<td><?php 
						require 'include/fetch_client.php';
							//echo '<select name="client_id" class="input_select" value="'.$client_id.'">';
							echo '<input type="text" name="client_id" class="input_text" list="client" value="'.$client_id.'"/>';
							echo '<datalist id="client">';
							if (mysqli_num_rows($client_result) > 0) {
								while($sales_data = mysqli_fetch_assoc($client_result)) {
									if($client_id!=$sales_data["client_id"])
										echo '<option value="'.$sales_data["client_id"].'">'.$sales_data["client_name"].' '.$sales_data["client_id"].'</option>';
									else{
										echo '<option value="'.$sales_data["client_id"].'" selected>'.$sales_data["client_name"].' '.$sales_data["client_id"].'</option>';
									}
										
								}
							}
						//echo '</select>';
						echo '</datalist>';
					?>	
				</td>
		<td id ="sales_einvoice" <span style='color: red;'></span></td>
		</tr>
        <tr>
		<td>Order Amount</td>
		<td><input type="number" name="order_value" min="1" class="input_text" onKeyDown="clr_ordervalue()"  value="<?php echo $order_value;?>"></td>
		<td id ="order_evalue" <span style='color: red;'></span></td>
		</tr>
        
        <tr>
		<td>Payment Details</td>
		<td><textarea name="payment" class="input_textarea" onKeyDown="clr_payment()"><?php echo $payment?></textarea></td>
		<td id ="order_erpay" <span style='color: red;'></span></td>
		</tr>
        
        <tr>
		<td>Remarks</td>
		<td><textarea name="remarks" class="input_textarea" onKeyDown="clr_remrk()"><?php echo $remarks;?></textarea></td>
		<td id ="order_eremark" <span style='color: red;'></span></td>
		</tr>
		<tr>
        
		<tr>
			<td>Execution Status</td>
			<td><select name="exe_status" class="input_select">
            <option value="ORDER RECEIVED" selected>ORDER RECEIVED</option>
            <option value="INSTALLATION DONE" >INSTALLATION DONE</option>
            <option value="RUNNING LIVE" >RUNNING LIVE</option>
            
            </td>
			<td id ="order_eexec" <span style='color: red;'></span></td>
		</tr>
        
		<tr>
		<td>Order Date</td>
		<td><input type="text" name="order_date" id="date" placeholder="DD-MM-YYYY" class="input_text" onKeyUp="prchsedate_chk()" onKeyDown="clr_pdate()"  value="<?php echo convert_date($order_date);?>"></td>
		<td id ="order_epurchase" <span style='color: red;'></span></td>
		</tr>
			<td></td>
			<td><input type="submit" value="SUBMIT" class="submit"/></td>
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

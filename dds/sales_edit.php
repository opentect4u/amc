<?php 
require '../lib/connection.php';
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$sale_code=trim_data($_GET["sale_code"]);
			$retrieve_data="SELECT `sale_code`, `item_code`, `client_code`, `quantity`, `warranty_period`, `purchase_date`, `invoice_no`, `remarks` FROM `sales_master` WHERE sale_code='".$sale_code."'";
			$report_result = mysqli_query($conn,$retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
							
							while($report_data = mysqli_fetch_array($report_result,MYSQLI_NUM)) {
								$sale_code =  $report_data[0];
								$item_code =	 $report_data[1];
								$client_code = $report_data[2];
								$quantity = $report_data[3];
								$warranty_period = $report_data[4];
								$purchase_date = $report_data[5];
								$invoice_no = $report_data[6];
								$remarks = $report_data[7];
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
<title>SYNERGIC UPDATE SALES</title>

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
	<h1>ETIM UPDATE SALES</h1>
	<form name="sales_form" method="POST" action="view/edit_sales.php" onsubmit="return valid_form()">
	<table>
		<tr>
		<td>Sale Code</td>
		<td><input type="text" name="sale_code" class="input_text" value="<?php echo $sale_code;?>" readonly></td>
		
		</tr>
		<tr>
		<td>Invoice No.</td>
		<td><input type="text" name="invoice_no" class="input_text" value="<?php echo $invoice_no;?>" onKeyDown="clr_invoice()"></td>
		<td id ="sales_einvoice" <span style='color: red;'></span></td>
		</tr>
		<tr>
			<td>Item Code</td>
			<td><?php 
					require 'include/fetch_item.php';
						echo '<select name="item_code" class="input_select" value="<?php echo $item_code;?>">';
						if (mysqli_num_rows($item_result) > 0) {
							while($item_data = mysqli_fetch_assoc($item_result)) {
								if($item_code!=$item_data["item_code"])
								echo '<option value="'.$item_data["item_code"].'">'.$item_data['item_type'].' '.$item_data['item_name'].' '.$item_data["item_application"].' '.$item_data["item_code"].'</option>';
								else{
									echo '<option value="'.$item_data["item_code"].'"selected>'.$item_data['item_type'].' '.$item_data['item_name'].' '.$item_data["item_application"].' '.$item_data["item_code"].'</option>';
								}
							}
						}
					echo '</select>';
				?>	
			</td><td id ="sales_ecode" <span style='color: red;'></span></td>
		</tr>
		<tr>
			<td>Client Name</td>
			<td><?php 
					require 'include/fetch_client.php';
						echo '<select name="client_name" class="input_select" value="<?php echo $client_code;?>">';
						if (mysqli_num_rows($client_result) > 0) {
							while($client_data = mysqli_fetch_assoc($client_result)) {
									if($client_code!=$client_data["client_code"])
										echo '<option value="'.$client_data["client_code"].'">'.$client_data["client_name"].' '.$client_data['client_code'].'</option>';
									else{
										echo '<option value="'.$client_data["client_code"].'" selected>'.$client_data["client_name"].' '.$client_data['client_code'].'</option>';
									}






								
							}
						}
					echo '</select>';
				?>	
			</td><td id ="salescli_ename" <span style='color: red;'></span></td>
		</tr>
		<tr>
		<td>Item Quantity</td>
		<td><input type="number" name="item_qty" min="1" class="input_text" onKeyDown="clr_itmqnty()" value="<?php echo $quantity;?>" readonly></td>
		<!--<td id ="sales_equantity" <span style='color: red;'></span></td>-->
		</tr>
		<tr>
		<td>Warranty Period</td>
		<td><input type="number" name="item_warr" min="1" class="input_text"  onKeyDown="clr_warr()" value="<?php echo $warranty_period;?>"onKeyDown="clr_warr()"></td>
		<td id ="sales_ewarranty" <span style='color: red;'></span></td>
		</tr>
		<tr>
		<td>Sale Date</td>
		<td><input type="text" name="item_date" id="date" placeholder="DD-MM-YYYY" class="input_text"   onKeyDown="clr_pdate()" value="<?php echo convert_date($purchase_date);?>" onKeyUp="prchsedate_chk()" onKeyDown="clr_pdate()"></td>
		<td id ="sales_epurchase" <span style='color: red;'></span></td>
		</tr>
		<tr>
		<td>Remarks</td>
		<td><textarea name="remarks" class="input_textarea"  onKeyDown="clr_remrk()"  ><?php echo $remarks;?></textarea></td>
		<td id ="sales_eremark" <span style='color: red;'></span></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" value="UPDATE" class="submit"/></td>
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

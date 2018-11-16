
<?php 
	require '../lib/connection.php';
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$invoice_no=trim_data($_GET["invoice_no"]);
			$retrieve_data="SELECT * FROM `mm_payment_master` WHERE payment_id = (select max(payment_id) from mm_payment_master where invoice_no = '".$invoice_no."')";
			$report_result = mysqli_query($conn,$retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
							
							while($report_data = mysqli_fetch_array($report_result,MYSQLI_NUM)) {
								$payment_id = $report_date[0];
								$invoice_no =  $report_data[1];
								$total_amount =	 $report_data[3];
								$due_amount = $report_data[5];	
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
?>
<!DOCTYPE html>
<html>
<head>
<title>SYNERGIC SERIAL EDIT</title>
<link rel="icon" href="../favicon.ico">
<link rel="stylesheet" type="text/css" href="style/style.css">
	<script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/jquery.maskedinput.js" type="text/javascript"></script>
	<script type="text/javascript">
        function valid_form(){
            
            var e= document.sales_form.serial_no.value;
            
            if (e.trim() == ""){
                document.getElementById('sales_epsno').innerHTML="Please Input Serial No";
                return false;
            }
            else
                return true;
        }
        
        function clr_psn(){
            document.getElementById('sales_epsno').innerHTML="";
        }
        
    </script>
    <script>
	$(document).ready(function($){
   		$(".date").mask("99-99-9999");
	});
		$(document).ready(function($){
			$(".date").css({"placeholder":"opacity:0.4"});
	});
	</script>
	<script>
		previous_due = parseFloat(<?php echo $due_amount; ?>);
		function calculate_due(){
		var due_amount=	parseFloat(document.sales_form.due_amount.value);
		var paid_amount= parseFloat(document.sales_form.paid_amount.value);
			if(!isNaN(paid_amount)){
				new_due_amount= previous_due - paid_amount;
				document.sales_form.due_amount.value=new_due_amount;
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
	<div>
<div class="sales_body">
<div class="sales_page">
	<h1>Add Payment</h1>
	<form name="sales_form" method="POST" action="view/edit_payment.php" onsubmit="return valid_form()">
	<table>
		<tr>
		<td>Invoice No.</td>
		<td><input type="text" name="invoice_no" class="input_text" value="<?php echo $invoice_no; ?>" readonly></td>
		<td id ="sales_serial" ><span style='color: red;'></span></td>
		</tr>
		<tr>
			<td>Payment Date</td>
			<td><input type="text" name="payment_date"  placeholder="DD-MM-YYYY" class="input_text date" onKeyUp="prchsedate_chk()" onKeyDown="clr_pdate()" required></td>
		<td id ="sales_epurchase" ><span style='color: red;'></span></td>
		</tr>
		<tr>
        <td>Total Amount( &#8377 )</td>
		<td><input type="number" name="total_amount" min="1" class="input_text" value="<?php echo $total_amount; ?>" readonly ></td>
		<td id ="sales_equantity" ><span style='color: red;'></span></td>
		</tr>
        <tr>
		<td>Due Amount( &#8377 )</td>
		<td><input type="number" name="due_amount" min="1" class="input_text" value="<?php echo $due_amount; ?>" readonly  ></td>
		<td id ="sales_equantity" ><span style='color: red;'></span></td>
		</tr>
         <tr>
		<td>Paid Amount( &#8377 )</td>
		<td><input type="number" name="paid_amount" min="1" class="input_text"  onChange="calculate_due()"></td>
		<td id ="sales_equantity" ><span style='color: red;'></span></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" value="ADD" class="submit"/></td>
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
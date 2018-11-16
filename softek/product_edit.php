<?php
require '../lib/connection.php';
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$product_code=trim_data($_GET["product_code"]);
			$retrieve_data="SELECT `product_id`, `product_type` FROM `mm_product_master` WHERE product_id='".$product_code."'";
			$report_result = mysqli_query($conn,$retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
							
							while($report_data = mysqli_fetch_array($report_result,MYSQLI_NUM)) {
								$product_code =  $report_data[0];
								$product_type =	 $report_data[1];
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

<html>
<head>
<link rel="icon" href="../favicon.ico">
<link rel="stylesheet" type="text/css" href="style/style.css">
<title>SYNERGIC SOFTEK EDIT CLIENT TYPE
</title>
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
<div class="item_body_container">
<div class="item_body">
	<h1>SOFTEK CLIENT TYPE EDIT</h1>
	<form name="add_product_form" method="POST" action="view/edit_product.php" onsubmit="return valid_form()">
	<table>
		<tr>
			<td>Client Type Code</td>
			<td><input type="text" name="product_code" class="input_text" value="<?php echo $product_code ;?>" readonly></td>
			
		</tr>        
        <tr>
			<td>Client Type</td>
			<td><input type="text" name="product_type" class="input_text" onKeyDown="product_typeone()" value="<?php echo $product_type;?>"/></td>
			<td id ="product_etype" ><span style="color: red;"></span></td>
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
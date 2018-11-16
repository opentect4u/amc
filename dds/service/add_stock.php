<?php require '../../lib/connection.php';?>
<!DOCTYPE html>
<html>
<head>
	<title>SYNERGIC ADD STOCK</title>
	<link rel="icon" href="../../favicon.ico">
<link rel="stylesheet" type="text/css" href="style/style.css">
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>
<script>
	$(document).ready(function($){
		var today = new Date();
		var dd = today.getDate();
	    var mm = today.getMonth()+1; //January is 0!
	    var yyyy = today.getFullYear();

	    if(dd<10) {
	        dd = '0'+dd
	    }

	    if(mm<10) {
	        mm = '0'+mm
	    }

	    today = dd + '-' + mm + '-' + yyyy;
   		$("#date").val(today);
});
	$(document).ready(function($){
   		$("#date1").mask('99-99-9999');
});
	$(document).ready(function($){
   		$("#date1").css({"placeholder":"opacity:0.4"});
});


$(document).ready(function($){
$('#c_qty').on("change", function() {
	var qty = $(this).val()

	if(qty < 1){
		alert('Quantity must be grater than 1');
		$(this).val('');
		return false;
	}
	else{
		return true;
	}
});
});
</script>
</head>
<body>
	<div class="header">
		<?php require 'header.php';?>
	</div>
	<div class="nav_holder">
		<?php require 'service_nav.php';?>
	</div>
	<div class= "item_body_container">
	<?php require 'insert_stock.php';?>
	<?php require 'add_stock_body.php';?>
	</div>
</body>

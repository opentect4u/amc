<!DOCTYPE html>
<html>
<head>
	<title>SYNERGIC ETIM REPORTS</title>
	<link rel="icon" href="../favicon.ico">
	<link rel="stylesheet" type="text/css" href="style/style.css">
    <script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>
<script>
	$(document).ready(function($){
   		$(".date").mask("99-99-9999");
});
	$(document).ready(function($){
   		$(".date").css({"placeholder":"opacity:0.4"});
});
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
	<div class="report_body_content">
		<?php require 'include/reports_invoice_date_body.php';?>
	</div>
	<div class = "footer" style="clear: both;">
		<?php require 'include/footer.php';?>
	</div>
</body>
</html>

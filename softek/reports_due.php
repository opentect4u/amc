<!DOCTYPE html>
<html>
<head>
	<title>SYNERGIC SOFTEK REPORTS</title>
	<link rel="stylesheet" type="text/css" href="style/style.css">
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
		<?php require 'include/reports_due_body.php';?>
	</div>
	<div class = "footer" style="clear: both;">
		<?php require 'include/footer.php';?>
	</div>
</body>
</html>

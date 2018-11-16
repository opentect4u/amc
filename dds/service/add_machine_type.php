<?php require '../../lib/connection.php';?>
<!DOCTYPE html>
<html>
<head>
	<title>SYNERGIC MACHINE</title>
	<link rel="icon" href="../../favicon.ico">
	<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
	<div class="header">
		<?php require 'header.php';?>
	</div>
	<div class="nav_holder">
		<?php require 'service_nav.php';?>
	</div>
	<div class= "item_body_container">
	<?php require 'insert_machine_type.php';?>
	<?php require 'add_machine_type_body.php';?>
	</div>
</body>

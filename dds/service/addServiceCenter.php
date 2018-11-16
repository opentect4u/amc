<?php
session_start();

if($_SESSION['insert_flag'] == "inserted") {
	echo '<script>alert("Successfully Inserted");</script>';
	$_SESSION['insert_flag']="";
}

elseif($_SESSION['update_flag'] == "wrongItem") {
	echo '<script>alert("Already Exists. Updataion Failed.");</script>';
	$_SESSION['update_flag']="";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>SYNERGIC ADD SERVICE CENTER</title>
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
		<div class="item_body">
			<form method="POST" action="insertServiceCenter.php">
				<h1>New Service Center</h1>
				<table>
					<tr>
						<td>Name</td>
						<td><input type="text" name="srvName" class="input_text" placeholder="Name Of the Service Center" required /></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" class="submit" value="Insert"></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</body>

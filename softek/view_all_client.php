<?php require '../lib/connection.php';?>
<?php
$_SESSION['view']="0";
if($_SESSION['update_flag'] =="client")
			{
				echo '<script>alert("Updated Successfully");</script>';
				$_SESSION['update_flag']="";
			}
if($_SESSION['update_flag'] != "" && $_SESSION['update_flag'] != "client"){
			header('location:'.$l_softek_logout.'');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>SYNERGIC SOFTEK VIEW ALL CLIENT</title>
	<link rel="stylesheet" type="text/css" href="style/style.css">
	</head>
<body>
	<div class="header">
		<?php require 'include/header.php';?>
	</div>
	<div class="nav_holder">
		<?php require 'include/nav.php';?>
	</div>
	
	<div class="report_body_content">
		<?php require 'include/view_all_body.php';?>
	</div>
	<div class = "footer" style="clear: both;">
		<?php require 'include/footer.php';?>
	</div>
</body>
</html>

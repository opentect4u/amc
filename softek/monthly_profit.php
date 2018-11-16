<!DOCTYPE html>
<html>
<head>
	<title>SYNERGIC YEARLY PROFIT</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
<div class="header">
		<?php require 'include/header.php';?>
	</div>
	<div class="nav_holder">
		<?php require 'include/nav.php';?>
	</div>
    <div class = "item_body_container">
<div class="reports_body">
	<h1>YEARLY STATEMENT</h1>
	<form name="report_form" action="#" method="POST">
	<table>
		<tr>
			
			<td>YEAR</td>
			<td><input type="text" name="year" class="input_text"/></td>
			<td><input type="submit" name="submit" value="SEARCH" class = "submit"></td>
		</tr>
	</table>
	</form>

</div>
<div class = "report_result">
<?php require 'include/monthly_profit_body.php'; ?>

</div>
</div>
<div class = "footer" style="clear: both;">
		<?php require 'include/footer.php';?>
	</div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>SYNERGIC INVOICE REPORTS</title>
</head>
<body>

</body>
</html>
<div class="reports_body">
	<h1>DATE WISE INVOICE REPORT</h1>
	<form name="report_form" action="#" method="POST">
	<table>
		<tr>
			<td>STARTING DATE</td>
			<td><input type="text" name="starting_date" placeholder="DD-MM-YYYY" class="input_text date"></td>
			<td>END DATE</td>
			<td><input type="text" name="end_date" placeholder="DD-MM-YYYY" class="input_text date"></td>
		</tr>

		<tr>
			<td>INVOICE TYPE</td>
			<td><select name="invoice_type" class="input_select" required>
			    	<option value="INSTALLATION">INSTALLATION</option>
			    	<option value="AMC" selected>AMC</option>
			    	<option value="CBS">CBS</option>
			    	<option Value="CALL BASED SUPPORT">CALL BASED SUPPORT</option>
			    </select>
			</td>		
			<td><input type="submit" name="submit" value="SEARCH" class = "submit"></td>
		</tr>
	</table>
	</form>

</div>
<div class = "report_result">
<?php require 'search_report_invoice_date.php'; ?>

</div>
</body>
</html>

<?php
	$td_stock = "SELECT in_date,bill_no,in_no,comp_arrived_dt,comp_sl_no,comp_qty FROM td_stock_in";
	$stock_results = mysqli_query($conn,$td_stock);

	$td_stock_u = "SELECT  DISTINCT bill_no FROM td_stock_in WHERE approval_status <> 1";
	$stock_results_u = mysqli_query($conn,$td_stock_u);
?>

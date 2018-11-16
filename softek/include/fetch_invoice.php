<?php
	$sales_list = "select invoice_no from mm_amc_master order by invoice_no desc";
	$sales_result = mysqli_query($conn,$sales_list);
?>
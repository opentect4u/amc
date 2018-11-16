<?php
	$td_customer_tkt = "select tkt_no, cust_code, approve_flag from td_customer_tkt";
	$tkt_result = mysqli_query($conn,$td_customer_tkt);
?>
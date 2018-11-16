<?php
	$sql = "SELECT tkt_no, cust_code, mc_qty FROM td_customer_tkt WHERE approve_flag  = 1";
	$tkt_result = mysqli_query($conn, $sql);
?>

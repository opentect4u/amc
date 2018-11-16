<?php
	$sql = "SELECT DISTINCT tkt_no FROM td_service_out 
								   WHERE approval_status IS NULL";
	$out_no = mysqli_query($conn, $sql);
?>

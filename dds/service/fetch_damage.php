<?php
	$sql = "SELECT memo_no FROM td_damage_out WHERE approval_status IS NULL LIMIT 1";
	$memo_no = mysqli_query($conn, $sql);
?>
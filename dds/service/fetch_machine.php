<?php
	$mm_machine = "SELECT batch_no, mc_type, approval_status from td_new_machine";
	$machine_result = mysqli_query($conn,$mm_machine);
?>
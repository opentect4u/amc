<?php
	$client_list = "select client_id,client_name,client_type from mm_client_master";
	$client_result = mysqli_query($conn,$client_list);
?>
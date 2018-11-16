<?php
	$state_list = "select state_code,state_name from mm_state";
	$state_result = mysqli_query($conn,$state_list);
?>
<?php
	$district_list = "select district_code,district_name from mm_district";
	$district_result = mysqli_query($conn,$district_list);
?>
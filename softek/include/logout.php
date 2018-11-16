<?php 
	require '../../lib/connection.php';
	$login_date_sql="UPDATE `mm_login_master` SET `logout_time`= now() WHERE `user_id` = '".$_SESSION['username']."'";
	$login_date_result = mysqli_query($conn, $login_date_sql);
	session_destroy();
	header("Location:".$l_index."");
?>
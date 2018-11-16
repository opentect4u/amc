<?php
	$sales_list = "select * from sales_master order by sale_code desc";
	$sales_result = mysqli_query($conn,$sales_list);
?>
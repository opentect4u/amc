<?php
	$order_list = "select o.order_id, c.client_name from mm_order_master o,mm_client_master c where o.client_id = c.client_id order by o.order_id desc ";
	$order_result = mysqli_query($conn,$order_list);
?>
<?php
	if($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['username']){
		//date_default_timezone_set('Asia/kolkata');
		$date1_temp = DateTime::createFromFormat('d-m-Y',$_POST["item_date"]);
		$date1 = $date1_temp->format('Y-m-d');
		$date2_temp = DateTime::createFromFormat('d-m-Y',$_POST["arrival_date"]);
		$date2 = $date2_temp->format('Y-m-d');
		$cur_date = date('Y-m-d');
		$bill_no = $_POST['billNo'];
		$servCenName = $_POST['servCenName'];
		$comp_name = implode('*/*',$_POST["comp_name"]);
		$comp_name = explode('*/*',$comp_name);

		$c_qty = implode('*/*',$_POST["c_qty"]);
		$c_qty = explode('*/*',$c_qty);

		for ($i=0; $i < sizeof($comp_name); $i++) {
			$sql = "INSERT INTO `td_stock_in`(`in_date`, `bill_no`, `in_no`,
				                   			  `comp_arrived_dt`, `comp_sl_no`, `comp_qty`,
													  `serv_area`, `created_by`,`created_dt`)
								 		 VALUES ('$date1', '$bill_no', $i+1, '$date2', '$comp_name[$i]', $c_qty[$i], '$servCenName','".$_SESSION['username']."','$cur_date')";
				$result = mysqli_query($conn, $sql);
		}



			if($result){
					echo '<script>alert("Added Successfully");</script>';
				}
			//header("Location: view_stock.php");
			function trim_data($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			$data = strtoupper($data);
			return $data;
		}
  }
?>

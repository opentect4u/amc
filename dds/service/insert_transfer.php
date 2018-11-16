<?php
	if($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['username']){
		//date_default_timezone_set('Asia/kolkata');
		$date1_temp = DateTime::createFromFormat('d-m-Y',$_POST["item_date"]);
		$trfDate = $date1_temp->format('Y-m-d');
		$cur_date = date('Y-m-d');
		$trfNo = $_POST['trfNo'];
    $trfMode = $_POST['trfMode'];
    $trnsFrom = $_POST['trnsFrom'];
    $trnsTo = $_POST['trnsTo'];
		$remarks = trim_data($_POST['remarks']);

		$comp_sl_no = implode('*/*', $_POST["comp_sl_no"]);
		$comp_sl_no = explode('*/*', $comp_sl_no);

		$c_qty = implode('*/*', $_POST["c_qty"]);
		$c_qty = explode('*/*', $c_qty);
    $createdBy = $_SESSION['username'];

		for ($i=0; $i < sizeof($comp_sl_no); $i++) {
			$sql = "INSERT INTO `td_transfer`(`trf_date`,
                                        `trf_no`,
                                        `trf_mode`,
				                                `from_place`,
                                        `to_place`,
                                        `comp_sl_no`,
													              `comp_qty`,
                                        `remarks`,
                                        `created_by`,
                                        `created_dt`) VALUES ( '$trfDate',
                                                               '$trfNo',
                                                               '$trfMode',
                                                               '$trnsFrom',
                                                               '$trnsTo',
                                                                $comp_sl_no[$i],
                                                                $c_qty[$i],
                                                               '$remarks',
                                                               '$createdBy',
                                                               '$cur_date' )";
				$result = mysqli_query($conn, $sql);
		}

			if($result){
					echo '<script>alert("Added Successfully");</script>';
				}
			//header("Location: view_stock.php");
  }

  function trim_data($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = strtoupper($data);
  return $data;
}
?>

<?php
require '../../lib/connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" ) {

		$memoNo = $_POST["memoNo"];
        $in_date = DateTime::createFromFormat('d-m-Y', $_POST['in_date']);
		$in_date = $in_date->format('Y-m-d');
		$orederBy = $_POST['orederBy'];
		$servCenName = $_POST['servCenName'];
		$comp_sl_no = implode(',', $_POST['comp_sl_no']);

		$c_qty = implode(',', $_POST['qty']);
		$c_qty = explode(',', $c_qty);

		$remarks = implode(',', $_POST['remarks']);
		$remarks = explode(',', $remarks);

		$modified_dt = date("Y-m-d");
		$modified_by = $_SESSION['username'];

		$sql = "DELETE FROM td_damage_out
 										WHERE memo_no = '$memoNo'
										AND comp_sl_no NOT IN ($comp_sl_no)";
		mysqli_query($conn, $sql);

		$comp_sl_no = explode(',', $comp_sl_no);
		$count = -1;
		//for edit
		for ($i = 0; $i < sizeof($comp_sl_no); $i++) {
			$sqlupdate = "UPDATE `td_damage_out` SET order_by = '$orederBy',
													 center_name = '$servCenName',
			                                         comp_qty = $c_qty[$i],
			                                         remarks = '$remarks[$i]',
			                                         modified_by = '$modified_by',
	                                         		 modified_dt = '$modified_dt'
                                      					 						WHERE memo_no = '$memoNo'
                                      											AND comp_sl_no = $comp_sl_no[$i]";
			echo $sqlupdate.'<br>';
			$resultupdate = mysqli_query($conn, $sqlupdate);
			if ($resultupdate) {
				$count++;
			}
		}

		//for extra insert
		for ($i=0; $i < sizeof($comp_sl_no) - $count; $i++) {
			//$j = $count+1;
			$sql = "INSERT INTO `td_damage_out`(`trf_dt`,
		                                        `memo_no`,
		                                        `order_by`,
		                                        `center_name`,
		                                        `comp_sl_no`,
												`comp_qty`,
		                                        `remarks`,
		                                        `created_by`,
		                                        `created_dt`) VALUES ( '$in_date',
		                                                               '$memoNo',
		                                                               '$orederBy',
		                                                               '$servCenName',
		                                                                $comp_sl_no[$count],
		                                                                $c_qty[$count],
		                                                               '$remarks[$count]',
		                                                               '$modified_by',
		                                                               '$modified_dt' )";
			echo $sql.'<br>';	                                                              
			mysqli_query($conn, $sql);
			$count++;
		}
		$_SESSION['update_flag'] = "item";
		header('Location: view_damage_stock.php');
	}
?>

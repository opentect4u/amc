<?php
require '../../lib/connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" ) {

				$billNo = $_POST["billNo"];
				$in_date = DateTime::createFromFormat('d-m-Y', $_POST['in_date']);
				$in_date = $in_date->format('Y-m-d');
				$arrival_date = DateTime::createFromFormat('d-m-Y', $_POST["arrival_date"]);
				$date1 = $arrival_date->format('Y-m-d');
				$servCenName = $_POST['servCenName'];
				$comp_sl_no = implode(',', $_POST['comp_sl_no']);

				$c_qty = implode(',', $_POST['qty']);
				$c_qty = explode(',', $c_qty);

				$time = date("Y-m-d");
				$modified_by = $_SESSION['username'];

				$sql = "DELETE FROM td_stock_in
				 										WHERE bill_no = '$billNo'
														AND comp_sl_no NOT IN ($comp_sl_no)";
				mysqli_query($conn, $sql);

				$comp_sl_no = explode(',', $comp_sl_no);
				$count = -1;
				//for edit
				for ($i = 0; $i < sizeof($comp_sl_no); $i++) {
					$sqlupdate = "UPDATE `td_stock_in` SET in_no = $i+1, `comp_arrived_dt`='$date1', comp_qty = $c_qty[$i],  modified_by = '$modified_by', modified_dt = '$time'
					 							WHERE bill_no = '$billNo'
												AND comp_sl_no = $comp_sl_no[$i]";
					$resultupdate = mysqli_query($conn, $sqlupdate);
					if ($resultupdate) {
						$count++;
					}
				}

			  //for extra insert
				for ($i=0; $i < sizeof($comp_sl_no) - $count; $i++) {
						$j = $count+1;
						$sql = "INSERT INTO `td_stock_in` (in_date,
																							 bill_no,
																							 in_no,
																							 comp_arrived_dt,
																							 comp_sl_no,
																							 comp_qty,
																						   serv_area,
																						   created_by,
																						   created_dt) VALUES ('$in_date',
																								  								 '$billNo',
																																   	$j,
																																	 '$date1',
																																	  $comp_sl_no[$count],
																																		$c_qty[$count],
																																	 '$servCenName',
																																	 '$modified_by',
																																	 '$time')";
						
						mysqli_query($conn, $sql);
						$count++;
				}
				$_SESSION['update_flag'] = "item";
				header('Location: view_stock.php');
		}
?>

<?php
require '../../lib/connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" ) {

				$trfNo = $_POST["trfNo"];
        $in_date = DateTime::createFromFormat('d-m-Y', $_POST['in_date']);
				$in_date = $in_date->format('Y-m-d');
				$trfMode = $_POST['trfMode'];
        $trnsFrom = $_POST['trnsFrom'];
        $trnsTo = $_POST['trnsTo'];
        $remarks = $_POST['remarks'];

				$comp_sl_no = implode(',', $_POST['comp_sl_no']);
        
				$c_qty = implode(',', $_POST['qty']);
				$c_qty = explode(',', $c_qty);

				$modified_dt = date("Y-m-d");
				$modified_by = $_SESSION['username'];

				$sql = "DELETE FROM td_transfer
		 										WHERE trf_no = '$trfNo'
												AND comp_sl_no NOT IN ($comp_sl_no)";
				mysqli_query($conn, $sql);

				$comp_sl_no = explode(',', $comp_sl_no);
				$count = -1;
				//for edit
				for ($i = 0; $i < sizeof($comp_sl_no); $i++) {
					$sqlupdate = "UPDATE `td_transfer` SET trf_mode = '$trfMode',
                                                 from_place = '$trnsFrom',
                                                 to_place = '$trnsTo',
                                                 comp_qty = $c_qty[$i],
                                                 remarks = '$remarks',
                                                 modified_by = '$modified_by',
                                                 modified_dt = '$modified_dt'
                                                      					 							WHERE trf_no = '$trfNo'
                                                      												AND comp_sl_no = $comp_sl_no[$i]";
					$resultupdate = mysqli_query($conn, $sqlupdate);
					if ($resultupdate) {
						$count++;
					}
				}

			  //for extra insert
				for ($i=0; $i < sizeof($comp_sl_no) - $count; $i++) {
						//$j = $count+1;
						$sql = "INSERT INTO `td_transfer` (trf_date,
																							 trf_no,
																							 trf_mode,
																							 from_place,
																							 to_place,
																							 comp_sl_no,
																						   comp_qty,
                                               remarks,
																						   created_by,
																						   created_dt) VALUES ('$in_date',
																								  								 '$trfNo',
																																   '$trfMode',
																																	 '$trnsFrom',
                                                                   '$trnsTo',
																																	  $comp_sl_no[$count],
																																		$c_qty[$count],
																																	 '$remarks',
																																	 '$modified_by',
																																	 '$modified_dt')";

						mysqli_query($conn, $sql);
						$count++;
				}
				$_SESSION['update_flag'] = "item";
				header('Location: view_transfer.php');
		}
?>

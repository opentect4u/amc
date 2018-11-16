<?php


	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		require '../../lib/connection.php';

		$date = date('Y-m-d');
		$custId = $_POST['cust_id'];
		$mc_type = $_POST['mc_type'];
		$mc_qty = $_POST['mc_qty'];
		$sub_by = $_POST['sub_by'];
		$ph_no = $_POST['ph_no'];
		$rcv_by = $_POST['rcv_by'];
    $servCenName = $_POST['servCenName'];
		$remarks = $_POST['remarks'];

		$stk_no = implode('*/*',$_POST['stk_no']);
		$prb = implode('*/*',$_POST['prb']);
		$warranty = implode('*/*',$_POST['warranty']);


		$stk_no = explode('*/*', $stk_no);
		$prb = explode('*/*', $prb);
    $warranty = explode('*/*', $warranty);


    $sql = "SELECT max(tkt_no) tkt_no FROM td_customer_tkt";
		$result = mysqli_query($conn, $sql);
		while($item_data = mysqli_fetch_assoc($result)) {

			$curYr = date("Y");
  			if ($item_data['tkt_no']) {
  				$finYr = substr($item_data['tkt_no'], 0,4);
  				$prvId = substr($item_data['tkt_no'], 4,100);

  				if($curYr != $finYr){
  					$tkt_no = $curYr.'1';
  				}
  				else{
  					$prvId += 1;
  					$tkt_no = $curYr.$prvId;
  				}
  			}
  			else{
  				$prvId += 1;
  				$tkt_no = $curYr.'1';
  			}
		}

    	$sql = "INSERT INTO td_customer_tkt(recvd_dt,
                                          tkt_no,
                                          cust_code,
                                          mc_type,
                                          mc_qty,
                                          submit_by,
                                          sub_phn_no,
                                          rcv_by,
                                          serv_area,
                                          remarks) VALUES('$date',
                                                          '$tkt_no',
                                                          '$custId',
                                                          '$mc_type',
                                                          '$mc_qty',
                                                          '$sub_by',
                                                          '$ph_no',
                                                          '$rcv_by',
                                                          '$servCenName',
                                                          '$remarks')";


    	echo $sql;
      mysqli_query($conn, $sql);

    	for ($i=0; $i < sizeof($stk_no); $i++) {

    		$sql = "INSERT INTO td_mc (tkt_no, mc_st_no, mc_prob, warr_flg) VALUES ('$tkt_no','$stk_no[$i]','$prb[$i]','$warranty[$i]')";

        	mysqli_query($conn, $sql);
         }

         $_SESSION['update_flag']="added";
         header("Location: view_service.php");

	}

?>

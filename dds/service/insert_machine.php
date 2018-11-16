<?php
//ad user 

  if($_SERVER["REQUEST_METHOD"]=="POST" && $_SESSION['username']!= "" && !empty($_SESSION['username']) && isset($_SESSION['username'])){
		$comp_name = trim_data($_POST["comp_name"]);
		$machine_qty = trim_data($_POST["machine_qty"]);
		$item_serial=trim_data($_POST["item_serial"]);
		$date = date("Y-m-d");
		$servCenName = $_POST['servCenName'];
		$dash_array=explode(",",$item_serial);
		$array_length=count($dash_array);
		$serial_array=array();
		$count_qty = 0;


		for($i=0;$i < $array_length;$i++){
			if(strpos($dash_array[$i], "-")){				
				$range_array=explode("-",$dash_array[$i]);
				if(trim($range_array[0])!='' && trim($range_array[1])!='')
				for($j=trim($range_array[0]);$j<=trim($range_array[1]);$j++){
					$count_qty++;						
					array_push($serial_array,$j);
				}	
			}
			else if(trim($dash_array[$i])!=''){
				$count_qty++;					
				array_push($serial_array,trim($dash_array[$i]));
			}
		}
		
		$sql = "SELECT max(batch_no) batch_no from td_new_machine";

		$result = mysqli_query($conn, $sql);
		while($item_data = mysqli_fetch_assoc($result)) {
			
			$curYr = date("Y");
  			if ($item_data['batch_no']) {
  				$finYr = substr($item_data['batch_no'], 0, 4);
  				$prvId = substr($item_data['batch_no'], 4, 100);
  				
  				if($curYr != $finYr){
  					$batch_no = $curYr.'10';
  				}
  				else{
  					$prvId += 1;
  					$batch_no = $curYr.$prvId;
  				}
  			}
  			else{
  				$prvId += 1;
  				$batch_no = $curYr.'10';
  			}
		}

		

		$sql1 = "INSERT INTO `td_new_machine`(`entry_date`, `batch_no`, `mc_type`, `qty`,`serv_area`,`created_by`,`created_dt`) VALUES ('$date', $batch_no, '$comp_name', $machine_qty,'$servCenName' , '".$_SESSION['username']."','$date')";

		$result = mysqli_query($conn, $sql1);


		for ($i=0; $i < sizeof($serial_array); $i++) { 
    		
    		$sql = "INSERT INTO td_mc_sl (`batch_no`, `mc_no`) VALUES ($batch_no,'$serial_array[$i]')";

        	mysqli_query($conn, $sql);
         }

		if($result){
			
			echo '<script>alert("'.$batch_no.' Added Successfully");</script>';
		}
  }

    function trim_data($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		$data = strtoupper($data);
		return $data;
	}
?>

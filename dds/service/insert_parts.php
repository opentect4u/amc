<?php
//ad user 

	if($_SERVER["REQUEST_METHOD"]=="POST" && $_SESSION['username']!= "" && !empty($_SESSION['username']) && isset($_SESSION['username'])){
		$parts_desc=trim_data($_POST["parts_desc"]);
		$time = date("Y-m-d");
		
		$sql = "SELECT * from `mm_parts` where parts_desc = '$parts_desc'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			echo '<script>alert("Already Exist!");</script>';
		}
		else{
			$sql1 = "INSERT INTO `mm_parts`(`parts_desc`,`created_by`,`created_dt`) VALUES ('".$parts_desc."','".$_SESSION['username']."','".$time."')";
			
			$result = mysqli_query($conn, $sql1);
				if($result){
					echo '<script>alert("Added Successfully");</script>';
				}
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
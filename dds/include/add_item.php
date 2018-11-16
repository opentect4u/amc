<?php
//add item
	if($_SERVER["REQUEST_METHOD"]=="POST" && $_SESSION['username']!= "" && !empty($_SESSION['username']) && isset($_SESSION['username']) && $_SESSION['insert_flag']=="" && !empty($_SESSION['login_flag']) && isset($_SESSION['login_flag'])){
		$item_name=trim_data($_POST["item_name"]);
		$item_type=trim_data($_POST["item_type"]);
		$item_application=trim_data($_POST["item_application"]);


		$sql = "SELECT COUNT(*) FROM `item_master` WHERE `item_type` = '$item_type' AND `item_name` = '$item_name' AND `item_application` LIKE '%$item_application'";

		$result = mysqli_query($conn,$sql);
		if ($result) {
			if(mysqli_num_rows($result) > 0){
				while($data = mysqli_fetch_array($result,MYSQLI_NUM)){
					if ($data[0] > 0) {
						$_SESSION['insert_flag']="wrongItem";
					 	header('Location:'.$l_dds_item.'');	

				 	}
				 	else{
			$sql = "INSERT INTO `item_master`(`item_name`, `item_type`,`item_application`,`updated_by`) VALUES ('".$item_name."','".$item_type."','".$item_application."','".$_SESSION['username']."')";
			
			$result = mysqli_query($conn, $sql);
			if($result){
					$sql_log_max="select max(item_code) from item_master where updated_by= '".$_SESSION['username']."'";
					$result_log_max=mysqli_query($conn,$sql_log_max);
					$result_log_max_data=mysqli_fetch_array($result_log_max,MYSQLI_NUM);
					$description_concat="".$result_log_max_data[0].", ".$item_name.", ".$item_type.", ".$item_application."";
					//
					$sql_log_insert="insert into mm_log_master(description,department,table_name,operation,user_id) values ('".$description_concat."','DDS','ITEM_MASTER','INSERT','".$_SESSION['username']."')";
					$result_log_insert=mysqli_query($conn,$sql_log_insert);
					
				}
				if($result_log_insert){
					//var_dump($result_log_insert);
						$_SESSION['insert_flag']="item";
						header('location:'.$l_dds_item.'');
					}
		}
				}
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
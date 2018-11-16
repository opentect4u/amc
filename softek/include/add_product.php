<?php
//add product
	if($_SERVER["REQUEST_METHOD"]=="POST" && $_SESSION['username']!= "" && !empty($_SESSION['username']) && isset($_SESSION['username']) && $_SESSION['insert_flag']=="" && !empty($_SESSION['login_flag']) && isset($_SESSION['login_flag'])){
		$product_type=trim_data($_POST["product_type"]);
	
		if($product_type!=""){
			$sql = "INSERT INTO `mm_product_master`(`product_type`,`updated_by`) VALUES ('".$product_type."','".$_SESSION['username']."')";
			$result = mysqli_query($conn, $sql);
				if($result){
					$sql_log_max="select max(product_id) from mm_product_master where updated_by= '".$_SESSION['username']."'";
					$result_log_max=mysqli_query($conn,$sql_log_max);
					$result_log_max_data=mysqli_fetch_array($result_log_max,MYSQLI_NUM);
					$description_concat="".$result_log_max_data[0].", ".$product_type."";
					$sql_log_insert="insert into mm_log_master(description,department,table_name,operation,user_id) values ('".$description_concat."','SOFTEK','MM_PRODUCT_MASTER','INSERT','".$_SESSION['username']."')";
					$result_log_insert=mysqli_query($conn,$sql_log_insert);
					if($result_log_insert){
						$_SESSION['insert_flag']="product";
						header('location:'.$l_softek_product.'');
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
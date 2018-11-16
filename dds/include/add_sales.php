<?php
//add sales 
	if($_SERVER["REQUEST_METHOD"]=="POST" && $_SESSION['username']!= "" && !empty($_SESSION['username']) && isset($_SESSION['username']) && $_SESSION['insert_flag']=="" && !empty($_SESSION['login_flag']) && isset($_SESSION['login_flag'])){
		
		$item_code=trim_data($_POST["item_code"]);
		$client_name=trim_data($_POST["client_name"]);
		$item_qty=trim_data($_POST["item_qty"]);
		$warranty=trim_data($_POST["item_warr"]);
		$item_date=convert_date(trim_data($_POST["item_date"]));
		
		$item_serial=trim_data($_POST["item_serial"]);
		$invoice_no=trim_data($_POST["invoice_no"]);
		$remarks=trim_data($_POST["remarks"]);
		
		//code for serial//
		$dash_array=explode(",",$item_serial);
		$array_length=count($dash_array);
		$serial_array=array();
		$count_qty=0;
		$_SESSION['rdata']="true";
		if($item_code!="" && $client_name!="" && $item_qty!="" && $warranty!="" && $item_date!="" && $item_serial!="" && $invoice_no!=""){
			for($i=0;$i<$array_length;$i++){
				if(strpos($dash_array[$i],"-")){				
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
	
			if($count_qty==$item_qty){
				/*echo '<script>alert("Total Item: '.$count_qty.'")</script>';*/
				/*for($i=0;$i<$count_qty;$i++)
				echo $serial_array[$i];*/
				$_SESSION['count_flag']=$count_qty;
				$check_invoice_sql="select invoice_no from sales_master where invoice_no = '".$invoice_no."'";
				$check_invoice_result=mysqli_query($conn,$check_invoice_sql);
				if(mysqli_num_rows($check_invoice_result) > 0){
					$_SESSION['invoice_flag']="true";//invoice number exists
					$URL = $l_dds_sales;
					echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
				}
				else{
					for($i=0;$i<$count_qty;$i++){
						$check_serial_sql="select serial_no from serial_master where serial_no='".$serial_array[$i]."'";
						$check_serial_result=mysqli_query($conn,$check_serial_sql);
						if(mysqli_num_rows($check_serial_result) > 0){
							
							$_SESSION['serial_flag']="true";//serial number exists
							$_SESSION['eserial']=$_SESSION['eserial'].", ".$serial_array[$i];
							$URL = $l_dds_sales;
							echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
						}
						
					}
				}
				/*$serial_sql="INSERT INTO `serial_master`(`sale_code`, `serial_no`) VALUES ('".$sales_code."','".$serial_array[$i]."')";
				$serial_result = mysqli_query($conn, $serial_sql);*/					
				/*note: else{
					header('location:'.$l_dds_sales.'');  *2times
				}*/
					
				if($_SESSION['invoice_flag']=="" && $_SESSION['serial_flag']=="" ){
					$sales_sql="INSERT INTO `sales_master`(`item_code`, `client_code`, `quantity`, `warranty_period`, `purchase_date`,`invoice_no`,`remarks`,`updated_by`) VALUES ('".$item_code."','".$client_name."','".$item_qty."','".$warranty."','".$item_date."','".$invoice_no."','".$remarks."','".$_SESSION['username']."')";
					$sales_result = mysqli_query($conn, $sales_sql);
		
					if($sales_result){
						$sales_code_sql="select max(sale_code) from sales_master where item_code='".$item_code."' and  client_code='".$client_name."' and quantity='".$item_qty."' and warranty_period='".$warranty."' and purchase_date='".$item_date."'";
						$sales_code_result = mysqli_query($conn, $sales_code_sql);
						if($sales_code_result){
							if (mysqli_num_rows($sales_code_result) > 0) {
								while($sales_code_data = mysqli_fetch_assoc($sales_code_result)) {
									$sales_code=$sales_code_data['max(sale_code)'];				
								}
							}
							for($i=0;$i<$count_qty;$i++){
								$serial_sql="INSERT INTO `serial_master`(`sale_code`, `serial_no`) VALUES ('".$sales_code."','".$serial_array[$i]."')";
								$serial_result = mysqli_query($conn, $serial_sql);
							}				
							$sql_log_max="select max(sale_code) from sales_master where updated_by= '".$_SESSION['username']."'";
							$result_log_max=mysqli_query($conn,$sql_log_max);
							$result_log_max_data=mysqli_fetch_array($result_log_max,MYSQLI_NUM);
							$description_concat="".$result_log_max_data[0].", ".$item_code.", ".$client_name.", ".$item_qty.", ".$warranty.", ".$item_date.", ".$item_serial.", ".$invoice_no.", ".$remarks."";
							$sql_log_insert="insert into mm_log_master(description,department,table_name,operation,user_id) values ('".$description_concat."','DDS','SALES_MASTER','INSERT','".$_SESSION['username']."')";
							$result_log_insert=mysqli_query($conn,$sql_log_insert);
							if($result_log_insert){
								$_SESSION['insert_flag']="sale";
								$URL = $l_dds_sales;
								echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
							}								
						}
					}
				}
			}
			else
			{
				$URL = $l_dds_sales;
				echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
			}
		}
	}



	
	/*if($item_code!="" && $client_name!="" && $item_qty!="" && $warranty!="" && $item_date!="" && $item_serial!=""){
		$sql = "INSERT INTO `client_master`(`client_name`, `client_address`, `client_phone`, `client_email`) VALUES ('".$customer_name."','".$customer_address."','".$customer_phone."','".$customer_email."')";
		$result = mysqli_query($conn, $sql);
			if($result){
				echo '<script>alert("added successfully");</script>';
			}
		}*/
    function trim_data($data) {
		$data = trim($data);
		$data = strtoupper($data);
		return $data;
	}
    function convert_date($data){
          $data=date('Y-m-d',strtotime($data));
           return $data;
	}
?>
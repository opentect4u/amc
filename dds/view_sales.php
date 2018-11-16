<?php
	require '../lib/connection.php';
?>
<?php
if($_SESSION['update_flag'] == "sale")
			{
				echo '<script>alert("Updated Successfully");</script>';
				$_SESSION['update_flag']="";
			}
if($_SESSION['update_flag1'] == "serial")
			{
				echo '<script>alert("Updated Successfully");</script>';
				$_SESSION['update_flag1']="";
			}
if(($_SESSION['update_flag'] != "" && $_SESSION['update_flag'] != "sale")||(($_SESSION['update_flag1'] != "" && $_SESSION['update_flag1'] != "serial")) ){
			header('location:'.$l_dds_logout.'');
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style/style.css">
<script src="js/delete_sales.js"></script>

	<title>SYNERGIC SALES VIEW</title>
</head>
<body>
<div class="header">
		<?php require 'include/header.php';?>
	</div>
	<div class="nav_holder">
		<?php require 'include/nav.php';?>
	</div>
	<div class="sales_body">
	<div class="reports_body">
		<h1>ETIM VIEW INVOICE WISE SALES</h1>
		<form name="report_form" action="#" method="POST">
		<table>
			<tr>
				<td>Invoice No</td>
				<td><?php 
						require 'include/fetch_invoice.php';
							echo '<input type="text" list="invoice" name="invoice_no" class="input_select">';
							echo '<datalist id="invoice">';
							if (mysqli_num_rows($sales_result) > 0) {
								while($sales_data = mysqli_fetch_assoc($sales_result)) {
									echo '<option value="'.$sales_data["invoice_no"].'">'.$sales_data["invoice_no"].'</option>';
								}
							}
						echo '</datalist>';
					?>	
				</td>
				
				<td><input type="submit" name="submit" value="SEARCH" class="submit"></td>
			</tr>
		</table>
		</form>

	</div>
	<div>
	<?php require 'view/sales_view.php'; ?>
	<form name="del_form_sales" method="post" action="#">
                <input type="hidden" name="fid"/>
                <input type="hidden" name="mode" value="deletesale"/>
                   
    </form>
    <form name="del_form_serial" method="post" action="#">
                <input type="hidden" name="fid"/>
                 <input type="hidden" name="sid"/>
                <input type="hidden" name="mode" value="deleteserial"/>
                   
    </form>
     <?php
                        if(isset($_POST["mode"]) == "deletesale")
						{
							$sqlupdate1="delete from `sales_master` where sale_code='".$_POST["fid"]."'";
							$resultupdate1 = mysqli_query($conn,$sqlupdate1);
							$sql_log_insert="insert into mm_log_master(description,department,table_name,operation,user_id) values ('".$_POST["fid"]."','DDS','SALES_MASTER','DELETE','".$_SESSION['username']."')";
							$result_log_insert=mysqli_query($conn,$sql_log_insert);
							$sqlupdate="delete from `serial_master` where sale_code='".$_POST["fid"]."'";
							$resultupdate = mysqli_query($conn,$sqlupdate);
							//$localIP = $_SERVER['HTTP_HOST'];
							//header('Location:'.$l_dds_view_sales.'');
							$URL =$l_dds_view_sales;
							echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
						}
						if(isset($_POST["mode"]) == "deleteserial")
						{
							$sqlupdate="delete from `serial_master` where serial_code='".$_POST["fid"]."'";
							$resultupdate = mysqli_query($conn,$sqlupdate);
							$sql_log_insert="insert into mm_log_master(description,department,table_name,operation,user_id) values ('".$_POST["fid"]."','DDS','SERIAL_MASTER','DELETE','".$_SESSION['username']."')";
							$result_log_insert=mysqli_query($conn,$sql_log_insert);
                            $sqlupdate3="update `sales_master` set `quantity` = (quantity-1) where sale_code='".$_POST["sid"]."'";
							$resultupdate3 = mysqli_query($conn,$sqlupdate3);
							$sqlupdate1="select count(*) from `serial_master` where sale_code='".$_POST["sid"]."'";
							$resultupdate1 = mysqli_query($conn,$sqlupdate1);
							if($resultupdate1){
								if (mysqli_num_rows($resultupdate1) == 0) {
									$sqlupdate2="delete from `sales_master` where sale_code='".$_POST["sid"]."'";
									$resultupdate2 = mysqli_query($conn,$sqlupdate2);
						}
					}
				
							//$localIP = $_SERVER['HTTP_HOST'];
							$URL =$l_dds_view_sales;
							echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
							//header('Location:'.$l_dds_view_sales.'');
						}
                    ?>
	</div>
</div>
<div class = "footer" style="clear: both;">
		<?php require 'include/footer.php';?>
	</div>
</body>
</html>
<?php
	require '../lib/connection.php';
?>
<?php
if($_SESSION['client_id_flag'] == "true")
			{
				echo '<script>alert("Client Does Not Exists");</script>';
				$_SESSION['client_id_flag']="";
			}
if($_SESSION['update_flag'] == "order")
			{
				echo '<script>alert("Updated Successfully");</script>';
				$_SESSION['update_flag']="";
			}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="../favicon.ico">
<link rel="stylesheet" type="text/css" href="style/style.css">
<script src="js/delete_order.js"></script>

	<title>SOFTEK ORDER DETAILS</title>
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
		<h1>ORDER DETAILS</h1>
		<form name="report_form" action="#" method="POST">
		<table>
			<tr>
				<td>Order Code</td>
				<td><?php 
						require 'include/fetch_order.php';
							echo '<input list="lorder" class="input_text" name="order_id"/>';
							echo '<datalist id="lorder">';
							if (mysqli_num_rows($order_result) > 0) {
								while($sales_data = mysqli_fetch_assoc($order_result)) {
									echo $sales_data["order_id"];
									echo '<option value="'.$sales_data["order_id"].'">'.$sales_data["order_id"].' '.$sales_data["client_name"].'</option>';
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
	<?php require 'view/order_view.php'; ?>
	<form name="del_form_sales" method="post" action="#">
                <input type="hidden" name="fid"/>
                <input type="hidden" name="mode" value="deleteorder"/>
                   
    </form>

     <?php
                        if(isset($_POST["mode"]) == "deleteorder")
						{
							$sqlupdate1="delete from `mm_order_master` where order_id='".$_POST["fid"]."'";
							$resultupdate1 = mysqli_query($conn,$sqlupdate1);
							$sql_log_insert="insert into mm_log_master(description,department,table_name,operation,user_id) values ('".$_POST["fid"]."','SOFTEK','MM_ORDER_MASTER','DELETE','".$_SESSION['username']."')";
							$result_log_insert=mysqli_query($conn,$sql_log_insert);
							//$localIP = $_SERVER['HTTP_HOST'];
							$URL =$l_softek_view_order;
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
<?php
	require '../lib/connection.php';
?>
<?php
if($_SESSION['update_flag'] == "product")
			{
				echo '<script>alert("Updated Successfully");</script>';
				$_SESSION['update_flag']="";
			}
if($_SESSION['update_flag'] != "" && $_SESSION['update_flag'] != "product"){
			header('location:'.$l_softek_logout.'');
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="../favicon.ico">

<link rel="stylesheet" type="text/css" href="style/style.css">
<script src="js/delete_item.js"></script>
	<title>SYNERGIC SOFTEK CLIENT TYPE VIEW</title>
	
</head>
<body>
	<div class="header">
		<?php require 'include/header.php';?>
	</div>
	<div class="nav_holder">
		<?php require 'include/nav.php';?>
	</div>
	<div class = "item_body_container">
	<div class="reports_body">
		<h1>SOFTEK VIEW CLIENT TYPE</h1>
		<form name="report_form" action="#" method="POST">
		<table>
			<tr>
				<td>Client Type</td>
				<td><?php 
					require 'include/fetch_product.php';
						echo '<select name="product_code" class="input_select" value="<?php echo $product_code;?>">';
						if (mysqli_num_rows($product_result) > 0) {
							while($product_data = mysqli_fetch_assoc($product_result)) {
								echo '<option value="'.$product_data["product_id"].'">'.$product_data['product_id'].' '.$product_data["product_type"].'</option>';
							}
						}
					echo '</select>';
				?>	
				</td>
				
				<td><input type="submit" name="submit" class ="submit" value="SEARCH"></td>
			</tr>
		</table>
		</form>

	</div>
	<div>
	<?php require 'view/product_view.php'; ?>
	<form name="del_form" method="post" action="#">
                <input type="hidden" name="fid">
                <input type="hidden" name="mode" value="deleteuser">
                   
    </form>
     <?php
                        if(isset($_POST["mode"]) == "deleteuser")
						{
							$sqlupdate="delete from `mm_product_master` where product_id='".$_POST["fid"]."'";
							$resultupdate = mysqli_query($conn,$sqlupdate);
							
							$sql_log_insert="insert into mm_log_master(description,department,table_name,operation,user_id) values ('".$_POST["fid"]."','SOFTEK','MM_PRODUCT_MASTER','DELETE','".$_SESSION['username']."')";
							$result_log_insert=mysqli_query($conn,$sql_log_insert);
							
							$URL =$l_softek_view_product;
							echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
							
							
							//$localIP = $_SERVER['HTTP_HOST'];
							//header("Location: http://".$localIP."/view_item.php");
						}
                    ?>
	</div>
	</div>
	<div class = "footer" style="clear: both;">
		<?php require 'include/footer.php';?>
	</div>
</body>
</html>
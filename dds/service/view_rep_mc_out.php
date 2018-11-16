<?php
	require '../../lib/connection.php';
?>
<?php
if($_SESSION['update_flag'] == "item")
			{
				echo '<script>alert("Updated Successfully");</script>';
				$_SESSION['update_flag']="";
			}
if($_SESSION['update_flag'] == "approved")
			{
				echo '<script>alert("Approved Successfully");</script>';
				$_SESSION['update_flag']="";
			}			

if($_SESSION['update_flag'] == "wrongItem")
			{
				echo '<script>alert("Already Exists. Updataion Failed.");</script>';
				$_SESSION['update_flag']="";
			}			
if(($_SESSION['update_flag'] != "" && $_SESSION['update_flag'] != "item") || ($_SESSION['update_flag'] != "" && $_SESSION['update_flag'] != "wrongItem")){
			header('location:'.$l_dds_logout.'');
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style/style.css">
<script src="js/delete_parts.js"></script>
	<title>SYNERGIC REPAIRED MACHINE VIEW</title>
	<link rel="icon" href="../../favicon.ico">
</head>
<body>
	<div class="header">
		<?php require 'header.php';?>
	</div>
	<div class="nav_holder">
		<?php require 'service_nav.php';?>
	</div>
	<div class = "item_body_container">
	<div class="reports_body">
		<h1>REPAIRED MACHINE</h1>
		<form name="report_form" action="" method="POST">
			<table>
				<tr>
					<td>Select Out No</td>
					<td><?php 
						require 'fetch_repaired_mc.php';
							echo '<select name="item_code" class="input_select">';
							if (mysqli_num_rows($invoice_no) > 0) {
								while($item_data = mysqli_fetch_assoc($invoice_no))
								{?>
									<option value="<?php echo $item_data["invoice_no"] ?>"><?php echo $item_data['invoice_no'];?>
									</option>
									<?										
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
	<?php require 'repaired_mc_view.php'; ?>
	<form name="del_form" method="post" action="#">
                <input type="hidden" name="fid"/>
                <input type="hidden" name="mode" value="deleteparts"/>
    </form>
     <?php
                        if(isset($_POST["mode"]) == "deleteparts")
						{
							$sqlupdate="delete from `mm_parts` where sl_no='".$_POST["fid"]."'";
							$resultupdate = mysqli_query($conn,$sqlupdate);
							
							$sql_log_insert="insert into mm_log_master(description,department,table_name,operation,user_id) values ('".$_POST["fid"]."','DDS','ITEM_MASTER','DELETE','".$_SESSION['username']."')";
							$result_log_insert=mysqli_query($conn,$sql_log_insert);
							
							$URL = $l_dds_view_parts;
							echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
						}
                    ?>
	</div>
	</div>
</body>
</html>
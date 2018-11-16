<?php
	require '../lib/connection.php';
?>
<?php
if($_SESSION['update_flag'] == "item")
			{
				echo '<script>alert("Updated Successfully");</script>';
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
	<link rel="icon" href="../favicon.ico">
<link rel="stylesheet" type="text/css" href="style/style.css">
<script src="js/delete_item.js"></script>
	<title>SYNERGIC ETIM ITEM VIEW</title>
	
		
			

	


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
		<h1>ETIM VIEW ITEMS</h1>
		<form name="report_form" action="#" method="POST">
		<table>
			<tr>
				<td>Item Name</td>
				<td><?php 
					require 'include/fetch_item.php';
						echo '<select name="item_code" class="input_select" value="<?php echo $item_code;?>">';
						if (mysqli_num_rows($item_result) > 0) {
							while($item_data = mysqli_fetch_assoc($item_result)) {
								echo '<option value="'.$item_data["item_code"].'">'.$item_data['item_code'].' '.$item_data['item_type'].' '.$item_data["item_name"].' '.$item_data['item_application'].'</option>';
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
	<?php require 'view/item_view.php'; ?>
	<form name="del_form" method="post" action="#">
                <input type="hidden" name="fid"/>
                <input type="hidden" name="mode" value="deleteuser"/>
                   
    </form>
     <?php
                        if(isset($_POST["mode"]) == "deleteuser")
						{
							$sqlupdate="delete from `item_master` where item_code='".$_POST["fid"]."'";
							$resultupdate = mysqli_query($conn,$sqlupdate);
							
							$sql_log_insert="insert into mm_log_master(description,department,table_name,operation,user_id) values ('".$_POST["fid"]."','DDS','ITEM_MASTER','DELETE','".$_SESSION['username']."')";
							$result_log_insert=mysqli_query($conn,$sql_log_insert);
							
							$URL =$l_dds_view_item;
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
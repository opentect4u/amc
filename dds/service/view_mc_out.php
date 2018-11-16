<?php
	require '../../lib/connection.php';
?>
<?php
if($_SESSION['update_flag'] == "item")
			{
				echo '<script>alert("Updated Successfully");</script>';
				$_SESSION['update_flag']="";
			}

elseif($_SESSION['update_flag'] == "wrongItem")
			{
				echo '<script>alert("Already Exists. Updataion Failed.");</script>';
				$_SESSION['update_flag']="";
			}	
elseif($_SESSION['update_flag'] == "added")
			{
				echo '<script>alert("Successfully Inserted");</script>';
				$_SESSION['update_flag']="";
			}				
elseif($_SESSION['update_flag'] == "approved")
			{
				echo '<script>alert("Approved Successfully");</script>';
				$_SESSION['update_flag']="";
			}
elseif($_SESSION['update_flag'] == "unapproved")
			{
				echo '<script>alert("Oops, Something Went Wrong.");</script>';
				$_SESSION['update_flag']="";
			}					
if(($_SESSION['update_flag'] != "" && $_SESSION['update_flag'] != "item") || ($_SESSION['update_flag'] != "" && $_SESSION['update_flag'] != "wrongItem")){
			header('location:'.$l_dds_logout.'');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>SYNERGIC MACHINE VIEW</title>
	<link rel="icon" href="../../favicon.ico">
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>
<script src="js/delete_stocks.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="style/style.css">
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
		<h1>VIEW TNVOICE</h1>

		<form name="report_form" action="" method="POST">
		<table>
			<tr>
				<td>Select Invoice No</td>
				<td><?php 
					require 'fetch_invoice.php';
						echo '<select name="item_code" class="input_select" >';
						if (mysqli_num_rows($invoice_no) > 0) {
							while($item_data = mysqli_fetch_assoc($invoice_no)) { ?>
									<option value="<?php echo $item_data["invoice_no"] ?>"><?php echo $item_data['invoice_no'].' || '.$item_data['mc_type'];?></option>

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
	<?php require 'machine_out_view.php'; ?>
	<form name="del_form" method="post" action="#">
                <input type="hidden" name="fid">
                <input type="hidden" name="mode" value="deleteparts">
    </form>
     <?php
        if(isset($_POST["mode"]) == "deleteparts")
		{
			$fid = $_POST["fid"];
			$sql = "UPDATE td_mc_sl SET invoice_no = null WHERE invoice_no = '$fid'";
			echo $sql.'<br>';
			mysqli_query($conn,$sql);
			
			$sql = "DELETE FROM td_new_machine_out WHERE invoice_no = '$fid'";
			mysqli_query($conn, $sql);
			echo $sql.'<br>';
			
			header("Location: $l_dds_view_machine_out");
		}
    ?>
	</div>
	</div>
</body>
</html>
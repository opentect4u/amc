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
	<link rel="icon" href="../favicon.ico">
<link rel="stylesheet" type="text/css" href="style/style.css">
<script src="js/delete_parts.js"></script>
	<title>SYNERGIC DAMAGE VIEW</title>
	<link rel="icon" href="../../favicon.ico">
	<script src="js/delete_stocks.js"></script>
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
				<h1>DAMAGE VIEW</h1>
				<form name="report_form" action="" method="POST">
					<table>
						<tr>
							<td>MEMO No</td>
							<td><?php
								require 'fetch_damage.php';
									echo '<select name="item_code" class="input_select" >';
									if (mysqli_num_rows($memo_no) > 0) {

										while($item_data = mysqli_fetch_assoc($memo_no)) {
											?>
												<option value='<?php echo $item_data["memo_no"];?>'>
														<?php echo $item_data['memo_no']; ?></option>
											<?php
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
				<?php require 'damage_view.php'; ?>
				<form name="del_form" method="post" action="#">
			      <input type="hidden" name="trf_no"/>
			      <input type="hidden" name="mode" value="deletestock"/>
			  	</form>
			  <?php
			  	if(isset($_POST["mode"]) == "deletestock"){
					$trf_no = $_POST["trf_no"];
					$sqlupdate="DELETE FROM `td_damage_out` WHERE memo_no = '$trf_no'";
					$resultupdate = mysqli_query($conn, $sqlupdate);

					$URL = $l_dds_view_damage;
					echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
			  	}
			    ?>
			</div>
		</div>
	</body>
</html>

<?php
	require '../lib/connection.php';
?>
<?php
$_SESSION['view']="1";
if($_SESSION['update_flag'] =="client")
			{
				echo '<script>alert("Updated Successfully");</script>';
				$_SESSION['update_flag']="";
			}
if($_SESSION['update_flag'] != "" && $_SESSION['update_flag'] != "client"){
			header('location:'.$l_softek_logout.'');
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="../favicon.ico">
<link rel="stylesheet" type="text/css" href="style/style.css">
<script src="js/delete_customer.js"></script>
	<title>SYNERGIC SOFTEK CUSTOMER AMC VIEW</title>
</head>
<body>
<div class="header">
		<?php require 'include/header.php';?>
	</div>
	<div class="nav_holder">
		<?php require 'include/nav.php';?>
	</div>
	<div class="client_body">
	<div class="reports_body">
		<h1>AMC STATUS DETAILS</h1>
		<form name="report_form" action="#" method="POST">
		<table>
			<tr>
				<td>Client Name</td>
				<td><?php 
						require 'include/fetch_client.php';
							echo '<input type="text" name="client_code" class="input_text" list="client"/>';
							echo '<datalist id="client">';
							if (mysqli_num_rows($client_result) > 0) {
								while($client_data = mysqli_fetch_assoc($client_result)) {
									echo '<option value="'.$client_data["client_id"].'">'.$client_data["client_name"].' '.$client_data['client_type'].'</option>';
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
	<?php require 'view/report_client_view.php'; ?>
	<form name="del_form" method="post" action="#">
                <input type="hidden" name="fid">
                <input type="hidden" name="mode" value="deleteuser">
                   
    </form>
     <?php
                        if(isset($_POST["mode"]) == "deleteuser")
						{
							$sqlupdate="delete from `mm_client_master` where client_id='".$_POST["fid"]."'";
							$resultupdate = mysqli_query($conn,$sqlupdate);
							
							$sql_log_insert="insert into mm_log_master(description,department,table_name,operation,user_id) values ('".$_POST["fid"]."','SOFTEK','MM_CLIENT_MASTER','DELETE','".$_SESSION['username']."')";
							$result_log_insert=mysqli_query($conn,$sql_log_insert);
							$URL =$l_softek_view_client;
							echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
							
							//$localIP = $_SERVER['HTTP_HOST'];
							//header("Location: http://".$localIP."/view_client.php");
						}
                    ?>
	</div>
</div>
<div class = "footer" style="clear: both;">
		<?php require 'include/footer.php';?>
	</div>
</body>
</html>
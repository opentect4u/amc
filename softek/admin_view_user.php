<?php
	require '../lib/connection.php';
?>
<?php
if($_SESSION['update_flag'] == 1)
			{
				echo '<script>alert("Updated Successfully");</script>';
				$_SESSION['update_flag']=0;
			}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style/style.css">
<script src="js/delete_user.js"></script>
	<title>SYNERGIC USER VIEW</title>
	<link rel="icon" href="../favicon.ico">
		
			

	


</head>
<body>
	<div class="header">
		<?php require 'include/header.php';?>
	</div>
	<div class="nav_holder">
		<?php require 'include/admin_nav.php';?>
	</div>
	<div class = "item_body_container">
	<div class="reports_body">
		<h1>VIEW USERS</h1>
		<form name="report_form" action="#" method="POST">
		<table>
			<tr>
				<td>User Name</td>
				<td><?php 
					require 'include/fetch_user.php';
						echo '<select name="login_code" class="input_select" value="<?php echo $login_code;?>">';
						if (mysqli_num_rows($login_result) > 0) {
							while($login_data = mysqli_fetch_assoc($login_result)) {
								echo '<option value="'.$login_data["login_code"].'">'.$login_data['login_code'].' '.$login_data["user_id"].'</option>';
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
	<?php require 'view/user_view.php'; ?>
	<form name="del_form" method="post" action="#">
                <input type="hidden" name="fid"/>
                <input type="hidden" name="mode" value="deleteuser"/>
                   
    </form>
     <?php
                        if(isset($_POST["mode"]) == "deleteuser")
						{
							$sqlupdate="delete from `mm_login_master` where login_code=".$_POST["fid"]."";
							//echo $sqlupdate;die;
							$resultupdate = mysqli_query($conn,$sqlupdate);
							$localIP = $_SERVER['HTTP_HOST'];
							header("Location: http://".$localIP."/softek/admin_view_user.php");
						}
                    ?>
	</div>
	</div>
	<div class = "footer" style="clear: both;">
		<?php require 'include/footer.php';?>
	</div>
</body>
</html>
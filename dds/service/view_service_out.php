<?php
require '../../lib/connection.php';
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
	<title>SYNERGIC OUT STOCK VIEW</title>
	<link rel="icon" href="../../favicon.ico">
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<script src="js/delete_parts.js"></script>
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){

			$('.hidn').hide();

			$('#click').click(function(){
				$('p').hide();
				$('.hidn').show();
				$('.hidn').prop('type', 'text');
			});

			$('.prob').change(function(){
				var index = $('.prob').index(this),
					value = $(this).val(),
					sl_no = $('#rowCount' + index).val(),
					mc_no = $('#mc_no' + index).val();
				
				/*console.log(mc_no);
				console.log(value);*/

				$.ajax({
					url:"./edit_service_out.php",
					data:{
						sl_no: sl_no,
						mc_no: mc_no,
						prob: value
					},
					type: "GET"
				});
			});

			$('.qty').change(function(){
				var index = $('.qty').index(this),
					value = $(this).val(),
					sl_no = $('#rowCount' + index).val(),
					mc_no = $('#mc_no' + index).val();
				
				/*console.log(mc_no);
				console.log(value);*/

				$.ajax({
					url:"./edit_service_out.php",
					data:{
						sl_no: sl_no,
						mc_no: mc_no,
						qty: value
					},
					type: "GET"
				});
			});

			$('.sev').change(function(){
				var index = $('.sev').index(this),
					value = $(this).val(),
					sl_no = $('#rowCount' + index).val(),
					mc_no = $('#mc_no' + index).val();
				
				/*console.log(mc_no);
				console.log(value);*/

				$.ajax({
					url:"./edit_service_out.php",
					data:{
						sl_no: sl_no,
						mc_no: mc_no,
						sev: value
					},
					type: "GET"
				});
			});
		});
	</script>
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
		<h1>STOCK OUT VIEW</h1>
		<form name="report_form" action="" method="POST">
			<table>
				<tr>
					<td>Select Out No</td>
					<td><?php
						require 'fetch_service_out.php';
							echo '<select name="item_code" class="input_select">';
							if (mysqli_num_rows($out_no) > 0) {
								while($item_data = mysqli_fetch_assoc($out_no))
								{?>
									<option value="<?php echo $item_data["tkt_no"] ?>"><?php echo $item_data['tkt_no'].' '.$client_data['client_name'];?>
									</option>
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
	<?php require 'service_out_view.php'; ?>
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

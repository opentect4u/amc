

<?php require '../../lib/connection.php';

	$item_code = $_GET['item_code'];

		$sql = "SELECT * FROM td_customer_tkt WHERE tkt_no = $item_code";


		$query = mysqli_query($conn,$sql);

		if ($query) {
			while($data = mysqli_fetch_assoc($query)) {

				$recvd_dt = $data['recvd_dt'];

				$tkt_no = $data['tkt_no'];
				$cust_code = $data['cust_code'];
				$mc_type = $data['mc_type'];
				$mc_qty = $data['mc_qty'];
				$submit_by = $data['submit_by'];
				$sub_phn_no = $data['sub_phn_no'];
				$serv_area = $data['serv_area'];
				$rcv_by = $data['rcv_by'];
			}
		}


		$sql = "SELECT * FROM td_mc WHERE tkt_no = $item_code";


		$query = mysqli_query($conn,$sql);

		if ($query) {
			while($data = mysqli_fetch_assoc($query)) {
				$mc_st_no[] = $data['mc_st_no'];
				$mc_prob[] = $data['mc_prob'];
				$warr_flg[] = $data['warr_flg'];
			}
		}

?>
<!DOCTYPE html>
<html>
<head>
	<title>SYNERGIC ADD SERVICE</title>
	<link rel="icon" href="../../favicon.ico">
<link rel="stylesheet" type="text/css" href="style/style.css">
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function(){

    $("#mc_qty").change( function(){

    	var b = $('.count').attr('id');

    	var x = document.getElementById("mc_qty").value;
    			document.getElementById("addrow").style.display = "none";
       	var c = x-b;

    	for(var i=0; i < c; i++) {

    		$("#intro").append('<tr><td><input type="text" name="stk_no[]" class="input_select" style="width: 150px;" required></td><td><?php require 'fetch_problem.php';?><select name="prb[]" class="input_select" style="width: 400px; height: 38px;" required><?php while($pdata = mysqli_fetch_assoc($problem_result)){ ?><option value="<?php echo $pdata['problem_desc'];?>"><?php echo $pdata['problem_desc'];?></option><?php } ?></select></td><td><select name="warranty[]" class="input_select" style="width: 190px;" required><option value="0">In Warranty</option><option value="1">Out Of Warranty</option></select></td></tr>');

    	}

    	$("#intro").append('<tr><td><input type="submit" id="addrow" value="Update" class="submit"></td></tr>');
    	$('#mc_qty').attr('readonly', true);
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
	<div class= "item_body_container">
		<div class="item_body">

		<form method="POST" action="edit_tkt.php">
			<input type="hidden" id="cust_id" name="cust_id">
			<table>
				<tr>
					<td>Ticket Number</td>
					<td><input type="number" id="tkt_no" class="input_select" value="<?php echo $tkt_no;?>" name="tkt_no" readonly></td>
				</tr>
			  	<tr>
					<td>Machine Type</td>
					<td>
					<?php require 'fetch_machine_type.php';
					if(mysqli_num_rows($machine_result) > 0) {
							echo '<select name="mc_type" class="input_select">';
							while($item_data = mysqli_fetch_assoc($machine_result)) {
								?>
								<option value="<?php echo $item_data['mc_type']; ?>" <?php echo ($item_data['mc_type'] == $mc_type)? 'selected':'';?> ><?php echo $item_data['mc_type'];?></option>
						<?php
							}
						echo "</select>";
						}
						?>
					</td>
				</tr>
				<tr>
					<td>Machine<br>Quantity</td>
					<td><input type="number" id="mc_qty" class="input_select" value="<?php echo $mc_qty;?>" name="mc_qty"></td>
				</tr>
				<tr>
					<td>Submit By</td>
					<td><input type="text" class="input_select" name="sub_by" value="<?php echo $submit_by;?>" required></td>
				</tr>
				<tr>
					<td>Phone No</td>
					<td><input type="text" class="input_select" id="phone" name="ph_no" value="<?php echo $sub_phn_no;?>" onkeyup="phn_no_chk()" required></td>
				</tr>
				<tr>
				<td>Service Center<br> Name</td>
				<td><?php
					require 'fetch_service_center.php';

						echo '<select name="servCenName" class="input_select">';
						if (mysqli_num_rows($result) > 0) {
							while($item_data = mysqli_fetch_assoc($result)) {
								?>
								<option value="<?php echo $item_data['center_name'];?>" <?php echo ($serv_area == $item_data['center_name'])?'selected':'';?>><?php echo $item_data['center_name'];?></option>
				<?php
							}
						}
					echo '</select>';
				?></td>
			</tr>
				<tr>
					<td>Receved By</td>
					<td><input type="text" class="input_select" name="rcv_by" value="<?php echo $rcv_by;?>" required></td>
				</tr>
			</table>


			<table>
				<tr><th>Stock No</th><th>Problem</th><th>Warranty</th></tr>
				<tbody id="intro">
					<?php
					$count = 0;
						for ($i=0; $i < sizeof($mc_st_no); $i++) {?>
							<tr>
								<td><input type="text" name="stk_no[]" class="input_select" style="width: 150px;" value="<?php echo $mc_st_no[$i];?>"></td>
								<td><?php require 'fetch_problem.php';?><select name="prb[]" class="input_select" style="width: 400px; height: 38px;" required><?php while($pdata = mysqli_fetch_assoc($problem_result)){ ?><option value="<?php echo $pdata['problem_desc'];?>" <?php echo ($mc_prob[$i] == $pdata['problem_desc'])?"selected":""; ?>><?php echo $pdata['problem_desc'];?></option><?php } ?></select></td>
								<td><select name="warranty[]" class="input_select" style="width: 190px;" required>
									<option value="0" <?php echo $warr_flg[$i]? '':'selected';?>>In Warranty</option>
									<option value="1" <?php echo $warr_flg[$i]? 'selected':'';?>>Out Of Warranty</option>
								</select></td>
							</tr>
					<?php
						$count = $i+1;
						}
					?>
					<div class="count" id="<?php echo $count; ?>" value=""></div>
					<tr><td><input type="submit" id="addrow" value="Update" class="submit"></td></tr>
				</tbody>
			</table>
		</form>
		</div>
	</div>
</body>
<script type="text/javascript">

		function phn_no_chk(){

			var x = document.getElementById("phone").value;

			if(isNaN(x)||x.indexOf(" ")!=-1)
           	{
              alert("Enter numeric value");
              document.getElementById("phone").value = "";
              return false;
           	}
           else if (x.length > 10)
           	{
                alert("enter 10 characters");
                document.getElementById("phone").value = "";
                return false;
           	}
           	else{
           		return true;
           	}
		}
	</script>

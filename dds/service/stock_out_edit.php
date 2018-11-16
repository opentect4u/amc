<?php
	require '../../lib/connection.php';

	$item_code = $_GET["item_code"];
	$tkt_no = $_GET["tkt_no"];
	$out_dt = $_GET['out_dt'];
	$serv_by = $_GET['service_by'];
	$serv_area = $_GET['serv_area'];
	$comp_no = [];
	$qty = [];

	$sql = "SELECT mc_qty FROM td_customer_tkt WHERE tkt_no = $tkt_no AND approve_flag = 1";
	$retrieve_data1 = "SELECT cmp_no, cmp_qty FROM td_service WHERE out_no = $item_code";

	$result = mysqli_query($conn, $sql);
	$mc_qty = mysqli_fetch_assoc($result);

	$report_result1 = mysqli_query($conn, $retrieve_data1);
	while($item_data = mysqli_fetch_assoc($report_result1)) {
		array_push($comp_no, $item_data['cmp_no']);
		array_push($qty, $item_data['cmp_qty']);
	}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style/style.css">
<title>SYNERGIC OUT STOCK EDIT</title>
<link rel="icon" href="../../favicon.ico">
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>
<script>

	$(document).ready(function($){
   		$("#date1").mask('99-99-9999');
});
	$(document).ready(function($){
   		$("#date1").css({"placeholder":"opacity:0.4"});
});


$(document).ready(function($){
$('#c_qty').on("change", function() {
	var qty = $(this).val()

	if(qty < 1){
		alert('Quantity must be grater than 1');
		$(this).val('');
		return false;
	}
	else{
		return true;
	}
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
<div class="item_body_container">
	<div class="item_body">
	<h1>STOCK</h1>
	<form method="POST" action="edit_stock_out.php">
		<input type="hidden" name="tkt_no" value="<?php echo $_GET["tkt_no"];?>"  class="input_text">
		<input type="hidden" name="out_dt" value="<?php echo $_GET["out_dt"];?>"  class="input_text">
		<table>
			<tr>
				<td>Out No</td>
				<td><input type="text" name="out_no" value="<?php echo $_GET["item_code"];?>"  class="input_text" readonly></td>
			</tr>
			<tr><td>Service By</td>
				<td><input class="input_text" name="serviceBy" value="<?php echo $serv_by;?>"></td>
			</tr>
			<tr><td>Service<br>Area</td>
				<td><input class="input_text" id="serviceArea" value="<?php echo $serv_area;?>" readonly></td>
			</tr>
			<tr><td>Machine<br>Quantity</td>
				<td><input class="input_select" id="mc_qty" name="mc_qty" value="<?php echo $_GET['mc_qty'] ?>"></td>
				<td id="mc_qty_err"></td>
			</tr>
			<tr>
				<td>Add Row</td>
				<td><input type="button" class="submit" value="Add Row" style="background-color: green;" id="add"></td>
			</tr>
		</table>

		<table id="intro" style="margin-left: 50px;">
			<tr>
				<th>Component Name</th>
				<th>Quantity</th>
			</tr>
			<?php
			$count = 0;
				for ($i=0; $i < sizeof($comp_no); $i++) { ?>
					<tr>
						<td>
							<?php require 'fetch_parts.php';?>
							<select name="comp_no[]" class="input_select preferenceSelect" id="sl<?php echo $i+1 ?>" style="width: 250px;" required>
								<option>Select</option>

								<?php while($parts = mysqli_fetch_assoc($parts_result)) {?>
								<option value="<?php echo $parts['sl_no']?>" <?php echo ($comp_no[$i] == $parts['sl_no'])?'selected':'' ;?>>
									<?php echo $parts['parts_desc']?></option><?php }echo '<option value="0">No Parts</option>';?>
							</select>
						</td>
						<td>
							<input type="text" name="qty[]" id="<?php echo $i+1; ?>" class="input_select qty" style="width: 150px;" value="<?php echo $qty[$i];?>" required>
						</td>
						<td class="cnt" id="w<?php echo $i+1; ?>"></td>
					</tr>
			<?php
			$count = $i+1;
				}
			?>
			<div class="count" id="<?php echo $count;?>" value=""></div>
		</table>

		<table class="hide" style="margin-left: 85px;">
			<tr>
				<td>
					<button type="button" id="addrow" class="submit">Update</button>
				</td>
				<td></td>
			</tr>
		</table>
	</form>
</div>
</div>
</body>
</html>

<script type="text/javascript">

	var global_var = 0,
		global_arr = [],
		global_value = [],
		count = <?php echo $count + 1 ?>;

	$(document).ready(function(){
	$('.preferenceSelect').change();
    $("#mc_qty").change(function(){

    	var mc_qty = $('#mc_qty').val();

    	if (mc_qty <= <?php echo $mc_qty['mc_qty'] ?>) {
    		
    		$('#mc_qty').prop('readonly', true);
    		$('#udpate').hide();
    		$('#mc_qty_err').hide();

	    	$('.preferenceSelect').change();
    	}
    	else{
    		$('#mc_qty').val('');
    		$('#mc_qty_err').html("<span style='color: red;'>Max Input <?php echo $mc_qty['mc_qty'] ?></span>");
    	}

      });

    $('#add').click(function(){

    	$("#intro").append('<tr><td><?php require 'fetch_parts.php';?><select name="comp_no[]" class="input_select preferenceSelect" id="sl'+count+'" style="width: 250px;" required><option>Select</option><?php while($parts = mysqli_fetch_assoc($parts_result)) {?><option value="<?php echo $parts['sl_no']?>"><?php echo $parts['parts_desc']?></option><?php }echo '<option value="0">No Parts</option>';?></select></td><td><input type="text" name="qty[]" class="input_select qty" style="width: 150px;" id="'+count+'" required></td><td class="cnt" id="w'+count+'"></td></tr>');
		
		count++;
	
		$('.preferenceSelect').change();
    });
  });

</script>

<script type="text/javascript">

$('#intro').on("change", ".preferenceSelect", function() {

	var comp_no = $(this).val(),
		serv_area = $('#serviceArea').val();

	$.get("<?php echo $l_dds_check_stock_qty ?>", {comp_no: comp_no, serv_area: serv_area}).done(function(data){
		global_var = parseInt(data);
		//console.log(global_var);
	});

    $('.preferenceSelect').each(function(){
        $('.preferenceSelect').find('option[value ="' + this.value + '"]').toggle(false);
      });

  });

	$('#intro').on("change", ".qty", function() {
		var id = $(this).attr('id'),
			value = parseInt($(this).val());

		var comp_no = $('#sl' + id).val(),
			serv_area = $('#serviceArea').val();

		$.get("<?php echo $l_dds_check_stock_qty ?>", {comp_no: comp_no, serv_area: serv_area}).done(function(data){
			global_var = parseInt(data);
			//console.log(global_var);

			if (value > global_var) {
				console.log(id);
				$('#' + id).val('');
				$('#w' + id).show();
				$('#addrow').hide();
				$('#w' + id).html('<span style="color: red;">You have less amount of quantity</span>');
			}
			else{
				$('#addrow').show();
				$('#w' + id).hide();
			}
		});

	});

  	$('#intro').on('change','.cnt', function(){
		$('#addrow').hide();
	});

	$('.submit').click(function() {

	   $('.preferenceSelect').each(function(){
	        $('.preferenceSelect').find('option[value ="' + this.value + '"]').attr("disabled", false);
	      });

       $('#addrow').prop('type', 'submit');
  });


</script>

<?php require '../../lib/connection.php';

	$tkt_no = $_GET['tkt_no'];
	$invoice_no = $_GET['invoice_no'];
	$mc_type = $_GET['mc_type'];
	$mc_qty = $_GET['qty'];


	$sql = "SELECT mc_st_no FROM td_mc WHERE invoice_no = '$invoice_no'";

	$query = mysqli_query($conn,$sql);
	$i = 0;
	while ($data = mysqli_fetch_assoc($query)) {
	 	$mc_no[$i] = $data['mc_st_no'];
	 	$i++;
	 } 

?>
<!DOCTYPE html>
<html>
<head>
	<title>SYNERGIC REPAIRE MACHINE EDIT</title>
	<link rel="icon" href="../../favicon.ico">
	<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>

<body>
	<div class="header">
		<?php require 'header.php';?>
	</div>
	<div class="nav_holder">
		<?php require 'service_nav.php';?>
	</div>
	<?
	//echo($recvd_dt);die;?>
	<div class= "item_body_container">
		<div class="item_body">
		
<form method="POST" action="edit_repaire_mc.php">
	<table>
		<tr>
			<td>Ticket No</td>
			<td><input type="text" name="tkt_no" class="input_text" value="<? echo $tkt_no;?>" readonly></td>
		</tr>
		<tr>
			<td>Invoice No</td>
			<td><input type="text" name="invoice_no" class="input_text" value="<? echo $invoice_no;?>" readonly></td>
		</tr>
	  	<tr>
			<td>Machine Type</td>
			<td>
				<select name="mc_type" id="mc_type" class="input_select">;
						<option><?php echo $mc_type;?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Machine<br>Quantity</td>
			<td><input type="number" id="mc_qty" class="input_select" value="<?php echo $mc_qty;?>" name="mc_qty"></td>
		</tr>
	</table>

	<table style="margin-left: 115px;">
		<tr>
			<th>Machine Serial No</th>
		</tr>
		<tbody id="intro">
			<?
				$count = 0;
				for ($i=0; $i < sizeof($mc_no); $i++) {?>
					<tr>
						<td><input type="text" name="mc_no[]" class="input_select mc_sl_no" id="m<? echo $i+1; ?>" value="<? echo $mc_no[$i]; ?>"></td>
						<td class="cnt" id="wm<?echo $i+1;?>"></td>					
					</tr>	
				<?
					$count = $i+1;
					}
				?>
				<div class="count" id="<? echo $count;?>" value=""></div>
						
		</tbody>
	</table>
			<input type="submit" id="addrow" style="margin-left: 120px;" value="Update" class="submit">
</form>	
		</div>
	</div>
</body>

<script type="text/javascript">
	var global_id = 0,
		global_arr = [],
		global_value = [];
 $(document).ready(function(){
 	console.log(global_arr);
 	console.log(global_value);
 	for (var i = 0; i < <? echo $count?> ; i++) {
 		var j = i+1;
 		global_arr[i] = $('#m' + j).val();
 		global_value[i] = global_arr[i];
 	}
 	$('#mc_type').change();
 	
 		$("#mc_qty").change( function(){
		var count = <? echo $count+1;?>;
		//console.log(count);
    	var b = $('.count').attr('id');
    	var x = document.getElementById("mc_qty").value;
    			
    	var c = x-b;

    	for(var i=0; i < c; i++) {
    		
    		$("#intro").append('<tr><td style="margin-left:50px;"><input type="text" name="mc_no[]" id="m'+count+'" class="input_select mc_sl_no"></td><td class="cnt" id="wm'+count+'"></td></tr>');
    		count++;
    	}

    	

    	$('#mc_qty').attr('readonly', true);

      });
  });
	
	
</script>

<script type="text/javascript">
	$('#mc_qty').change(function(){
		$('#add').hide();
		$('#mc_type').change();
	});
	$('#mc_type').change(function(){	
    	var mc_type = $('#mc_type').val();
    	$.ajax({
    			url: "<?php echo $l_dds_repaired_machine_out ?>",
    			data: {
    				  tkt_no: <? echo $tkt_no;?>
				},
				dataType:'json',
				type: 'GET'
			}).done( function(obj){
				for (var i = 0; i < obj.length; i++) {
					if (global_arr.indexOf(obj[i]) == -1) {
						global_arr.push(obj[i]);
					}
				}
    		});
	});

	$('#intro').on('change','.mc_sl_no', function(){
		global_id = $(this).attr('id');
		var flag = false,
			value = $(this).val();
			
		for (var i = 0; i < global_arr.length; i++) {

    		if (global_arr[i] === value) {
    			flag = true;
    			
    			if (global_value.indexOf(value) == -1) {
    				
    				global_value.push(value);
    				$('#w' + global_id).html('');
    				$('#addrow').show();
    				break;
    			}
    			else {
    				$('#w' + global_id).html('<span style="color: red;">Already Entered</span>');
    				$('#addrow').hide();
    				break;
    			}
    		}
    	}
    	if (!flag) {
    		$('.cnt').change();
    	}
	});

	$('#intro').on('change','.cnt', function(){
		console.log(global_id);
		$('#addrow').hide();
		$('#w' + global_id).html('<span style="color: red;">Wrong serial no.</span>');
	});
</script>

?>
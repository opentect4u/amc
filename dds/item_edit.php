<?php  
	require '../lib/connection.php';
	if($_SERVER["REQUEST_METHOD"]=="GET"){
		$item_code=trim_data($_GET["item_code"]);
			$retrieve_data="SELECT `item_type`,`item_name`, `item_application` FROM `item_master` WHERE item_code='".$item_code."'";
			$report_result = mysqli_query($conn,$retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
					while($report_data = mysqli_fetch_array($report_result,MYSQLI_NUM)) {
							$item_type =	$report_data["0"];
							$item_name = $report_data["1"];
							$item_application = $report_data["2"];	

							}
						}
					}
				

			}
	function trim_data($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		$data = strtoupper($data);
		return $data;
	}

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style/style.css">
<title>SYNERGIC ETIM EDIT ITEM
</title>

<script type="text/javascript">
		function valid_form(){
			var y= document.add_item_form.item_name.value;
			var x= document.add_item_form.item_type.value;
			var z= document.add_item_form.item_application.value;

			if (x.trim() == ""){
			document.getElementById('item_etype').innerHTML="Please Enter Item Type"; 
	    	return false;
	   		}
	   		else if(y.trim() == ""){
	   		document.getElementById('item_ename').innerHTML="Please Enter Item Name";
	    	return false;
	   		}
	   		else if(z.trim() == ""){
	   		document.getElementById('item_eapplication').innerHTML="Please Enter Application Type";
	   		return false;	
	   		}
	   		else{
	   		return true;
	   		} 
		}
		function item_nameone(){
			document.getElementById('item_ename').innerHTML="";
		}
		function item_typeone(){
			document.getElementById('item_etype').innerHTML="";
		}
		function item_app(){
			document.getElementById('item_eapplication').innerHTML="";
		}
	</script>




</head>
<body>
<div class="header">
		<?php require 'include/header.php';?>
	</div>
	<div class="nav_holder">
		<?php require 'include/nav.php';?>
	</div>
<div class="item_body_container">
<div class="item_body">
	<h1>ETIM ITEMS EDIT</h1>
	<form name="add_item_form" method="POST" action="view/edit_item.php" onsubmit="return valid_form()">
	<table>
		<tr>
			<td>Item Code</td>
			<td><input type="text" name="item_code" class="input_text" value="<?php echo $item_code ;?>" readonly/></td>
			
		</tr>
		<tr>
			<td>Item Type</td>
			<td><input type="text" name="item_type" class="input_text" onKeyDown="item_typeone()" value="<?php echo $item_type ;?>"/></td>
			<td id ="item_etype" ><span style='color: red;'></span></td>
		</tr>
		<tr>
		<tr>
			<td>Item Name</td>
			<td><input type="text" name="item_name" class="input_text" onKeyDown="item_nameone()" value="<?php echo $item_name;?>"/></td>
			<td id ="item_ename" ><span style='color: red;'></span></td>
		</tr>
         <tr>
         <td>Application</td>
         <td><textarea name="item_application" class="input_textarea" onKeyDown="item_app()"><?php echo $item_application;?></textarea></td>
         <td id ="item_eapplication"><span style='color: red;'></span></td>
         </tr>
         <tr>
         <td></td>
         <td><input type="submit" value="UPDATE" class="submit"></td>
			
		</tr>
	</table>
	</form>
</div>
</div>
<div class = "footer" style="clear: both;">
		<?php require 'include/footer.php';?>
	</div>
</body>
</html>
<?php  
	require '../lib/connection.php';
	if($_SERVER["REQUEST_METHOD"]=="GET"){
		$login_code=trim_data($_GET["login_code"]);
			$retrieve_data="SELECT `user_id`,`user_password`,`user_type` FROM `login_master` WHERE login_code='".$login_code."'";
			$report_result = mysqli_query($conn,$retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
					while($report_data = mysqli_fetch_array($report_result,MYSQLI_NUM)) {
							$user_id =	$report_data[0];
							$user_password = $report_data[1];
							$user_type = $report_data[2];	

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
var_dump($_SESSION['access_type']);
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style/style.css">
<title>SYNERGIC EDIT USER
</title>

<script type="text/javascript">
		function valid_form(){
			var y= document.add_edit_form.user_id.value;
			var x= document.add_edit_form.user_password.value;
			var z= document.add_edit_form.user_type.value;

			if (x.trim() == ""){
			document.getElementById('user_eid').innerHTML="Please Enter User Id"; 
	    	return false;
	   		}
	   		else if(y.trim() == ""){
	   		document.getElementById('user_epassword').innerHTML="Please Enter User Password";
	    	return false;
	   		}
	   		else if(z.trim() == ""){
	   		document.getElementById('user_etype').innerHTML="Please Enter User Type";
	   		return false;	
	   		}
	   		else{
	   		return true;
	   		} 
		}
		function item_nameone(){
			document.getElementById('user_id').innerHTML="";
		}
		function item_typeone(){
			document.getElementById('user_password').innerHTML="";
		}
		function item_app(){
			document.getElementById('user_etype').innerHTML="";
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
	<h1>USER EDIT</h1>
	<form  method="POST" action="edit_user.php" >
	<table>
		<tr>
			<td>User Id</td>
			<td><input type="text" name="user_id" class="input_text" value="<?php echo $user_id ;?>"/>
			<input type="hidden" name="login_code" value="<?php echo $login_code ;?>"/>
			</td>
			<td id ="user_eid" ><span style='color: red;'></span></td>
		</tr>
		<tr>
			<td>User Password</td>
			<td><input type="text" name="user_password" class="input_text" onKeyDown="item_typeone()" value="<?php echo $user_password ;?>"/></td>
			<td id ="user_epassword" ><span style='color: red;'></span></td>
		</tr>
		<tr>
		<tr>
         <td>User Type</td>
         <td><select name="user_type" class="input_select" required>
         		<option>--SELECT--</option>
         		<option value="A" <?php echo ($user_type == 'A')?'selected':''; ?>>ADMIN</option>
         		<option value="EM" <?php echo ($user_type == 'EM')?'selected':'';?>>USER</option>
         	</select>
		</td>
			<td id ="user_etype"><span style='color: red;'></span></td>
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
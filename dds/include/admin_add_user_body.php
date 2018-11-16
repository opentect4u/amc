<div class="item_body">
	<h1>User Name</h1>
	<form name="add_user_form" method="POST" action="#" onsubmit="return valid_form()">
	<table>
		<tr>
			<td>User Id</td>
			<td><input type="text" name="user_id" class="input_text" onKeyDown="item_typeone()"/></td>
			<td id ="user_eid"><span style='color: red;'></span></td>
		</tr>
		<tr>
		<tr>
			<td>Password</td>
			<td><input type="text" name="user_password" class="input_text" onKeyDown="item_nameone()"/></td>
			<td id ="user_epassword"><span style='color: red;'></span></td>
		</tr>
	     <tr>
         <td>User Type</td>
         <td><select name="user_type" class="input_select" required>
         		<option>--SELECT--</option>
         		<option value="A">ADMIN</option>
         		<option value="EM">USER</option>
         	</select>
		</td>
			<td id ="user_etype"><span style='color: red;'></span></td>
         </tr>
         <tr>
         <td></td>
         <td><input type="submit" value="ADD" class="submit"></td>
			
		</tr>
	</table>
	</form>
</div>

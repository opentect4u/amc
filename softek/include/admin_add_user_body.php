<div class="item_body">
	<h1>User Entry</h1>
	<form name="add_user_form" method="POST" action="#" onsubmit="return valid_form()">
	<table>
		<tr>
			<td>User Id</td>
			<td><input type="text" name="user_id" class="input_text" onKeyDown="item_typeone()" required></td>
			<td id ="user_eid"><span style='color: red;'></span></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="text" name="user_password" class="input_text" required></td>
			
		</tr>
         <tr>
         <td>User Type</td>
         <td><select name="user_type" class="input_select" required>
         		<option>--SELECT--</option>
         		<option value="AD">ADMIN</option>
         		<option value="STK">USER</option>
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

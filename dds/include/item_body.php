<div class="item_body">
	<h1>ETIM ITEMS</h1>
	<form name="add_item_form" method="POST" action="#" onsubmit="return valid_form()">
	<table>
		<tr>
			<td>Item Type</td>
			<td><input type="text" name="item_type" class="input_text" onKeyDown="item_typeone()"/></td>
			<td id ="item_etype" <span style='color: red;'></span></td>
		</tr>
		<tr>
		<tr>
			<td>Item Name</td>
			<td><input type="text" name="item_name" class="input_text" onKeyDown="item_nameone()"/></td>
			<td id ="item_ename" <span style='color: red;'></span></td>
		</tr>
         <tr>
         <td>Application</td>
         <td><textarea name="item_application" class="input_textarea" onKeyDown="item_app()"></textarea></td>
         <td id ="item_eapplication" <span style='color: red;'></span></td>
         </tr>
         <tr>
         <td></td>
         <td><input type="submit" value="ADD" class="submit" id="btn_submit"></td>
			
		</tr>
	</table>
	</form>
</div>

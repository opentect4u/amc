<div class="report_result">

		
<?php
	require '../lib/connection.php';

		if($_SERVER["REQUEST_METHOD"]=="POST"){
			echo '<table >
		<tr><th>LOGIN CODE</th><th>USER ID</th><th>USER PASSWORD</th><th>ACCOUNT TYPE</th><th>LOGIN TIME</th><th>LOGOUT TIME</th><th>OPTIONS</th></tr>';

			$login_code=trim_data($_POST["login_code"]);

			$retrieve_data="SELECT `login_code`, `user_id`,`user_password`, `user_type`, `login_time`, `logout_time` FROM `mm_login_master` WHERE login_code='".$login_code."'";

			$report_result = mysqli_query($conn,$retrieve_data);
			if($report_result){
				if (mysqli_num_rows($report_result) > 0) {
							
							while($report_data = mysqli_fetch_array($report_result,MYSQLI_NUM)) {
								echo '<tr><td>'.$report_data[0].'</td><td>'.$report_data[1].'</td><td>'.$report_data[2].'</td><td>'.$report_data[3].'</td><td>'.$report_data[4].'</td><td>'.$report_data[5].'</td><td><a href="user_edit.php?login_code='.$report_data[0].'" class = "edit_delete">EDIT</a><a href="javascript:delete_user('.$report_data[0].')" class = "edit_delete">DELETE</a></td></tr>';

							}
						}
					}
					echo '</table>';
				}
					function trim_data($data) {
							$data = trim($data);
							$data = strtoupper($data);
							return $data;
					}
?>	
</div>

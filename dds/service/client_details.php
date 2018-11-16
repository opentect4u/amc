<?php
	//require '../../lib/connection.php';
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		$client_code = $_POST['client_code'];

		$sql = "SELECT * FROM client_master WHERE client_code = $client_code";

		$query = mysqli_query($conn,$sql);

		if ($query) {
			while($data = mysqli_fetch_assoc($query)) {
				$client_name = $data['client_name'];
				$client_address = $data['client_address'];
				$client_phone = $data['client_phone'];
				$client_email = $data['client_email'];
			}
		}
		else{
			echo "<h3 style='text-align:center;'>Sorry! No Details Found.</h3>";
			exit;
		}
	}

?>
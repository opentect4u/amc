

<?php
require '../../lib/connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
				$item_code = $_POST["item_code"];
				$item_name = $_POST["item_name"];
				

		$sql = "SELECT * from `mm_parts` where parts_desc = '$item_name'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			$_SESSION['update_flag'] = "wrongItem";
			header('Location: view_parts.php');
		}
		else{

			$sqlupdate = "UPDATE `mm_parts` SET `parts_desc`='".$item_name."' WHERE sl_no ='".$item_code."'";

			$localIP = $_SERVER['HTTP_HOST'];//getHostByName(getHostName());
			$resultupdate = mysqli_query($conn,$sqlupdate);
			if ($resultupdate) {
				$_SESSION['update_flag'] = "item";
				header('Location: view_parts.php');
			}
		}
				function trim_data($data) {
					$data = trim($data);
					$data = strtoupper($data);
					return $data;
					}
}

?>
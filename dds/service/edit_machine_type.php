

<?php
require '../../lib/connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
				$item_code = trim_data($_POST["item_code"]);
				$item_name = trim_data($_POST["item_name"]);
				$modifiedBy = $_SESSION['username'];
				$modifiedDt = date('Y-m-d');

		$sql = "SELECT * FROM `mm_mc_type` WHERE mc_type = '$item_name'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			
			$_SESSION['update_flag'] = "wrongItem";
			header('Location: view_machine_type.php');
		}
		else{
			
			$sqlupdate = "UPDATE `mm_mc_type` SET `mc_type`='$item_name', modified_by = '$modifiedBy', modified_dt = '$modifiedDt' WHERE mc_id = $item_code";

			$localIP = $_SERVER['HTTP_HOST'];
			$resultupdate = mysqli_query($conn, $sqlupdate);
			if ($resultupdate) {
				$_SESSION['update_flag'] = "item";
				header('Location: view_machine_type.php');
			}
		}
				
}

				function trim_data($data) {
					$data = trim($data);
					$data = strtoupper($data);
					return $data;
					}
?>
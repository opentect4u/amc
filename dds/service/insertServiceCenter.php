<?php
  require '../../lib/connection.php';

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['username']) {
    $srvName = $_POST['srvName'];
    $created_by = $_SESSION['username'];
    $created_dt = date('Y-m-d');

    $sql = "INSERT INTO mm_service_center (center_name,created_by, created_dt)
                   VALUES('$srvName', '$created_by', '$created_dt')";
    mysqli_query($conn, $sql);

    $_SESSION['insert_flag'] = "inserted";
  
    header("Location: addServiceCenter.php");
  }
?>

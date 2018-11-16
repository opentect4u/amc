<?php
  $sql = "SELECT DISTINCT trf_no FROM td_transfer
                                    WHERE approval_status IS NULL";
   $trf_data = mysqli_query($conn, $sql);
?>

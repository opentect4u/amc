<?php
  if (!$_SESSION['username']) {
    $auth = $_SERVER['HTTP_HOST'].'/dds/';
    header("LOCATION: http://$auth");
  }
?>
<div class="nav" style="float:left;display:inline-block;">
    <ul>
      <li id="link" class="dropdown"><a href="<?php echo $l_dds_index;?>">Home</a></li>
      <li id="link" class="dropdown"><a href="#" class="dropbtn">Master Entry</a>
        <div class="dropdown-content">
                <a href="add_machine_type.php">Add M/c Type</a>
                <a href="view_machine_type.php">View M/c Type</a>
                <hr>
                <a href="add_parts.php">Add Parts Type</a>
                <a href="<?php echo $l_dds_view_parts;?>">View Parts Type</a>
                <hr>
                <a href="addServiceCenter.php">Add Service Center</a>
                <a href="editServiceCenter.php">Edit Service Center</a>
                <hr>
                <a href="problementry.php">Add Problem Types</a>
                <a href="viewproblemtype.php">View Problem Type</a>
        </div>
      </li>
      <li id="link" class="dropdown"><a href="#" class="dropbtn">Stock In</a>
        <div class="dropdown-content">
                <a href="add_stock.php">Parts In</a>
                <hr>
                <!--<a href="add_machine.php">New Machine</a>-->
        </div>
      </li>
      <li id="link" class="dropdown"><a href="#" class="dropbtn">Damage Stock</a>
        <div class="dropdown-content">
          <a href="add_damage_stock.php">Damage Stock Entry</a>
        </div>
      </li>
      <li id="link" class="dropdown"><a href="#" class="dropbtn">Stock Transfer</a>
        <div class="dropdown-content">
                <a href="add_transfer.php">Transfer Entry</a>
                </div>
      </li>
      <li id="link" class="dropdown"><a href="add_service.php" class="dropbtn">Customer Booking</a>
        <div class="dropdown-content">
                <a href="add_service.php">Service In</a>
               <a href="service_out_entry.php">Service Out</a>
       </div>
      </li>
     
      <li id="link" class="dropdown"><a href="" class="dropbtn">Approve</a>
          <div class="dropdown-content">
            <a href="view_machine.php">Approve Machine</a>
            <a href="view_stock.php">Approve Parts</a>
            <a href="view_damage_stock.php">Approve Damage Stock</a>
            <a href="view_transfer.php">Approve Transfer</a>
            <?php
            if ($_SESSION['access_type']=="A") {?>
            <a href="view_service.php">Approve Service In</a>
            <a href="view_service_out.php">Approve Service Out</a>

            <?php
            }
          ?>
          </div>  
      </li>
      <li id="link" class="dropdown"><a href="#" class="dropbtn">Reports</a>
          <div class="dropdown-content">
            <a href="report_parts_stock.php">Parts Stock Details</a>
            <a href="report_servising_details.php">Due Servicing Details</a>
            <a href="report_engg_servising_details.php">Engineer's Servicing Details</a>
          </div>
      </li>
      <li id="link" class="dropdown"><a href="<?php echo $l_dds_logout;?>" style="cursor:pointer"><img>Logout</a></li>
    </ul>
    </div>
    <div class= "right_log">
      Welcome, <?php echo $_SESSION['username'];?>
    </div>

<?php
	function redirect($page) {
		header('Location: ' . $page);
		exit;
	}
	include '../lib/connection.php';  
	if($_SESSION['username']== "" && empty($_SESSION['username']) && !isset($_SESSION['username'])){
		redirect($l_dds_sales);
	}
	$login_date_sql="UPDATE `login_master` SET `logout_time`= now() WHERE `user_id` = '".$_SESSION['username']."'";
	$login_date_result = mysqli_query($conn, $login_date_sql);
?>
    <div class="nav" style="float:left;display:inline-block;">
        <ul>
            <li id="link" class="dropdown"><a href="<?php echo $l_dds_index;  ?>">Home</a></li>
            <?php
            if ($_SESSION['access_type']=="A") {?>
                <li id="link" class="dropdown" class="dropbtn"><a href="<?php echo $l_dds_admin;?>">Admin Panel</a></li>
            <?php
            }
            ?>
            <li id="link" class="dropdown"><a href="<?php echo $l_dds_item;  ?>" class="dropbtn">Item</a>
                <div class="dropdown-content">
                <a href="<?php echo $l_dds_item;?>">Add</a>
                <a href="<?php echo $l_dds_view_item;?>">View</a>
                </div>
        	</li>
            <li id="link" class="dropdown"><a href="<?php echo $l_dds_client;?>" class="dropbtn">Customer</a>
                <div class="dropdown-content">
                <a href="<?php echo $l_dds_client;?>">Add</a>
                <a href="<?php echo $l_dds_view_client;?>">View</a>
                </div>
            </li>	
            <li id="link" class="dropdown"><a href="<?php echo $l_dds_sales;?>" class="dropbtn">Sales</a>
                <div class="dropdown-content">
                <a href="<?php echo $l_dds_sales;?>">Add</a>
                <a href="<?php echo $l_dds_view_sales;?>">View</a>
                </div>
            </li>
            <li id="link" class="dropdown"><a href="<?php echo $l_dds_service;?>" class="dropbtn">Service</a>
            </li>
            <li id="link" class="dropdown"><a href="<?php echo $l_dds_reports;?>">Reports</a>
            	 <div class="dropdown-content">
                 <a href="<?php echo $l_dds_reports;?>">Machine Warranty Status</a>
                 <a href="<?php echo $l_dds_sale_details;?>">Item Wise Sale Report</a>
                 <a href="<?php echo $l_dds_purchase_details;?>">Customer Wise Sale Report</a>
                 <a href="<?php echo $l_dds_report_invoice_date;?>">Date Wise Invoice Report</a>
             </li>
            <li id="link" class="dropdown"><a href="<?php echo $l_dds_change_pass; ?>" style="cursor:pointer"><img>Change Password</a></li>
            <li id="link" class="dropdown"><a href="<?php echo $l_dds_logout;?>" style="cursor:pointer"><img>Logout</a></li>
        </ul>
    </div>
    <div class= "right_log">
    	Welcome, <?php echo $_SESSION['username'];?>
    </div>


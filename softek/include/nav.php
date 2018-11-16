<?php include '../lib/connection.php';?>
<?php  if($_SESSION['username']== "" && empty($_SESSION['username']) && !isset($_SESSION['username'])){
          header("Location: ".$l_softek_index."");
		}
		$login_date_sql="UPDATE `login_master` SET `logout_time`= now() WHERE `user_id` = '".$_SESSION['username']."'";
		$login_date_result = mysqli_query($conn, $login_date_sql);
?>
		<div class="nav" style="float:left;display:inline-block;">
			<ul>
			<li id="link" class="dropdown"><a href="<?php echo $l_softek_index; ?>">Home</a></li>
			<?php
			if ($_SESSION['access_type']=="AD") {?>
				<li id="link" class="dropdown" class="dropbtn"><a href="<?php echo $l_softek_admin;?>">Admin Panel</a></li>
			<?php
			}
			?>
			<li id="link" class="dropdown"><a href="<?php echo $l_softek_product; ?>" class="dropbtn">Client Type</a>
				 <div class="dropdown-content">
			      <a href="<?php echo $l_softek_product; ?>">Add</a>
			      <a href="<?php echo $l_softek_view_product; ?>">View</a>
			    </div>
			</li>
			<li id="link" class="dropdown"><a href="<?php echo $l_softek_client; ?>" class="dropbtn">Client</a>
				<div class="dropdown-content">
			      <a href="<?php echo $l_softek_client; ?>">Add</a>
			      <a href="<?php echo $l_softek_view_client; ?>">View</a>
                  <a href="<?php echo $l_softek_view_all_client; ?>">View All</a>
			    </div>
			</li>	
			<li id="link" class="dropdown"><a href="<?php echo $l_softek_order; ?>" class="dropbtn">Order</a>
				<div class="dropdown-content">
			      <a href="<?php echo $l_softek_order; ?>">Add</a>
			      <a href="<?php echo $l_softek_view_order; ?>">View</a>
			    </div>
			</li>
			<li id="link" class="dropdown"><a href="<?php echo $l_softek_amc; ?>" class="dropbtn">Bill Entry</a>
				<div class="dropdown-content">
			      <a href="<?php echo $l_softek_amc; ?>">Add</a>
			      <a href="<?php echo $l_softek_view_amc; ?>">View</a>
			    </div>
			</li>
			<li id="link" class="dropdown"><a href="<?php echo $l_softek_report_amc; ?>">Report</a>
				<div class="dropdown-content">
				 <a href="<?php echo $l_softek_report_amc; ?>">Monthly AMC Report</a>
                 <a href="<?php echo $l_softek_report_client_amc; ?>">AMC Status Details</a>
			     <a href="<?php echo $l_softek_report_due; ?>">AMC Payment Due Report</a>
                 <a href="<?php echo $l_softek_monthly_profit; ?>">Yearly Statement</a>
                 <a href="<?php echo $l_softek_report_invoice_date; ?>">Date Wise Invoice Report</a>
			    </div>
            </li>
			<li id="link" class="dropdown"><a href="<?php echo $l_softek_change_pass; ?>" style="cursor:pointer"><img>Change Password</a></li>
			<li id="link" class="dropdown"><a href="<?php echo $l_softek_logout; ?>" style="cursor:pointer"><img>Logout</a></li>
			</ul>
		</div>
		<div class= "right_log">
			Welcome, <?php echo $_SESSION['username'];?>
		</div>


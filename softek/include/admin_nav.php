<?php require '../lib/connection.php';?>
<?php  if($_SESSION['username']== "" && empty($_SESSION['username']) && !isset($_SESSION['username'])){
                          $localIP=$_SERVER['HTTP_HOST'];
                           header("Location: http://".$localIP."/index.php");
}
  $login_date_sql="UPDATE `login_master` SET `logout_time`= now() WHERE `user_id` = '".$_SESSION['username']."'";
	$login_date_result = mysqli_query($conn, $login_date_sql);

	if($_SESSION['access_type']!= 'AD'  ){
		$localIP=$_SERVER['HTTP_HOST'];
         header("Location: http://".$localIP."/index.php");
	}
   ?>

<div class="nav" style="float:left;display:inline-block;">
			<ul>
			<li id="link" class="dropdown"><a href="index.php">Home</a></li>
			<li id="link" class="dropdown"><a href="admin_add_user.php" class="dropbtn">Add User</a>
			</li>
			<li id="link" class="dropdown"><a href="admin_view_user.php" class="dropbtn">View User</a>
			</li>
			<li id="link" class="dropdown"><a href="include/logout.php" style="cursor:pointer"><img>Logout</a></li>
			</ul>
		</div>
		<div class= "right_log">
			Welcome, <?php echo $_SESSION['username'];?>
		</div>
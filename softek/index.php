<link rel="stylesheet" type="text/css" href="style/style.css">
<link rel="icon" href="../favicon.ico">
<?php 
	require '../lib/connection.php';
	require 'include/check_login.php';


	if(!isset($_SESSION['username']) && empty($_SESSION['username']) && !isset($_SESSION['access_type']) && empty($_SESSION['access_type']) && empty($_SESSION['flag']) && $_SESSION['access_type']!="STK"){
		echo '<div class="header">';
			require 'include/header.php';
		echo '</div>';
		echo '<div class="login_content">';
			require 'include/login.php';
		echo '</div>';
	}

    /*else if(isset($_SESSION['username']) && !empty($_SESSION['username']) && isset($_SESSION['access_type']) && $_SESSION['access_type']=="AD"){
            require 'include/admin_index.php';
    }*/
	else if($_SESSION['access_type']=="STK" || $_SESSION['access_type']=="AD"){
		require 'include/index_body.php';
	}
?>


<?php
	/*$mst_servername = "148.72.232.182:3306";
	$mst_username = "admin_synergic";
	$mst_password = "Signat123";
	$mst_database = "synergic";*/

	$mst_servername = "localhost";
	$mst_username = "root";
	$mst_password = "teachers";
	$mst_database = "synergic";


// Create connection
	$conn = mysqli_connect($mst_servername, $mst_username, $mst_password, $mst_database);

// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	//ini_set('session.gc_maxlifetime',1800);
	session_start();
	error_reporting(E_ALL & ~E_NOTICE);
	
	
//error_reporting();

	$localIP = $_SERVER['SERVER_NAME'];//.'/httpdocs';//$_SERVER['HTTP_HOST'];//getHostByName(getHostName());


//all links
	$l_index="http://".$localIP."/";




//dds
	$l_dds_index="http://".$localIP."/dds/";
	$l_dds_admin="http://".$localIP."/dds/admin.php";
	$l_dds_item="http://".$localIP."/dds/item.php";
	$l_dds_view_item="http://".$localIP."/dds/view_item.php";
	$l_dds_client="http://".$localIP."/dds/client.php";
	$l_dds_view_client="http://".$localIP."/dds/view_client.php";
	$l_dds_sales="http://".$localIP."/dds/sales.php";
	$l_dds_view_sales="http://".$localIP."/dds/view_sales.php";
	$l_dds_reports="http://".$localIP."/dds/reports.php";
	$l_dds_logout="http://".$localIP."/dds/include/logout.php";
	$l_dds_purchase_details="http://".$localIP."/dds/purchase_details.php";
	$l_dds_sale_details="http://".$localIP."/dds/sale_details.php";
	$l_dds_service = "http://".$localIP."/dds/service/service.php";
	$l_dds_view_parts = "http://".$localIP."/dds/service/view_parts.php";
	$l_dds_change_pass="http://".$localIP."/dds/view_change_pass.php";
	$l_dds_report_invoice_date="http://".$localIP."/dds/report_invoice_date.php";
	$l_dds_view_stock="http://".$localIP."/dds/service/view_stock.php";
	$l_dds_check_stock_qty="http://".$localIP."/dds/service/check_stock_qty.php";
	$l_dds_view_machine_stock="http://".$localIP."/dds/service/view_machine.php";
	$l_dds_view_machine_out="http://".$localIP."/dds/service/view_mc_out.php";
	$l_dds_new_machine_out = "http://".$localIP."/dds/service/mcNoCheck.php";
	$l_dds_repaired_machine_out = "http://".$localIP."/dds/service/rep_mc_sl_no_check.php";
	$l_dds_view_transfer = "http://".$localIP."/dds/service/view_transfer.php";
	$l_dds_view_damage = "http://".$localIP."/dds/service/view_damage_stock.php";





//softek
	$l_softek_index="http://".$localIP."/amc/softek/";
	$l_softek_admin="http://".$localIP."/amc/softek/admin.php";
	$l_softek_product="http://".$localIP."/amc/softek/product.php";
	$l_softek_view_product="http://".$localIP."/amc/softek/view_product.php";
	$l_softek_client="http://".$localIP."/amc/softek/client.php";
	$l_softek_view_client="http://".$localIP."/amc/softek/view_client.php";
	$l_softek_view_all_client="http://".$localIP."/amc/softek/view_all_client.php";
	$l_softek_order="http://".$localIP."/amc/softek/order.php";
	$l_softek_view_order="http://".$localIP."/amc/softek/view_order.php";
	$l_softek_amc="http://".$localIP."/amc/softek/amc.php";
	$l_softek_view_amc="http://".$localIP."/amc/softek/view_amc.php";
	$l_softek_monthly_profit="http://".$localIP."/amc/softek/monthly_profit.php";
	$l_softek_report_amc="http://".$localIP."/amc/softek/reports_amc.php";
	$l_softek_report_due="http://".$localIP."/amc/softek/reports_due.php";
	$l_softek_logout="http://".$localIP."/amc/softek/include/logout.php";
	$l_softek_view_all_client="http://".$localIP."/amc/softek/view_all_client.php";
	$l_softek_change_pass="http://".$localIP."/amc/softek/view_change_pass.php";
	$l_softek_report_invoice_date="http://".$localIP."/amc/softek/report_invoice_date.php";
	$l_softek_report_client_amc="http://".$localIP."/amc/softek/report_client_amc.php"
	
?>

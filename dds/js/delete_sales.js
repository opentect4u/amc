function delete_serial(FID,SID){
	if (window.confirm("Do you really want to delete this serial?") == true){
	document.del_form_serial.fid.value=FID;
	document.del_form_serial.sid.value=SID;
	document.del_form_serial.submit();
	}
}
function delete_sales(FID){
	if (window.confirm("Do you really want to delete this sale?") == true){
	document.del_form_sales.fid.value=FID;
	document.del_form_sales.submit();
	}
}

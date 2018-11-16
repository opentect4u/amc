
function delete_sales(FID){
	if (window.confirm("Do you really want to delete this order?") == true){
	document.del_form_sales.fid.value=FID;
	document.del_form_sales.submit();
	}
}

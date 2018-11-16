function delete_customer(FID){
	if (window.confirm("Do you really want to delete this client?") == true){
	document.del_form.fid.value=FID;
	document.del_form.submit();
	}
}
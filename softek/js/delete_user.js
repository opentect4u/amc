function delete_user(FID){
	if (window.confirm("Do you really want to delete this user?") == true){
	document.del_form.fid.value=FID;
	document.del_form.submit();
	}
}
function delete_parts(FID){
	if (window.confirm("Do you really want to delete this Parts?") == true){
	document.del_form.fid.value=FID;
	document.del_form.submit();
	}
}
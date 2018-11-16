function delete_item(FID){
	if (window.confirm("Do you really want to delete this product?") == true){
	document.del_form.fid.value=FID;
	document.del_form.submit();
	}
}
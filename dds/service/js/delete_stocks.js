function delete_stock(BILL){

	if (window.confirm("Do you really want to delete this item?") == true){
		document.del_form.bill_no.value = BILL;
		document.del_form.submit();
	}
}

function delete_transfer(TRFNO){

	if (window.confirm("Do you really want to delete this item?") == true){
		document.del_form.trf_no.value = TRFNO;
		document.del_form.submit();
	}
}

function delete_damage(FID){
	if (window.confirm("Do you really want to delete this item?") == true){
		document.del_form.trf_no.value = FID;
		document.del_form.submit();
	}
}

function delete_machine_stock(FID){
	if (window.confirm("Do you really want to delete this item?") == true){
	document.del_form.fid.value = FID;
	document.del_form.submit();
	}
}

function delete_invoice(FID){
	if (window.confirm("Do you really want to delete this Invoice?") == true){
	document.del_form.fid.value = FID;
	document.del_form.submit();
	}
}

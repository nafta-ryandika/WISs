$(document).ready(function(){
	$('#inCardId').on('keypress',function(key) {
		if(key.which == 13 && $('#inCardId').val().trim() != '') {
			viewData();
		}
	})
});
var elem = document.documentElement;

function fullScreen() {
	if (elem.requestFullscreen) {
		elem.requestFullscreen();
	}
	else if (elem.webkitRequestFullscreen) {
		elem.webkitRequestFullscreen();
	}
	else if (elem.msRequestFullscreen) {
		elem.msRequestFullscreen();
	}
	$("#inCardId").focus();
}

function viewData() {
	$.ajax({
		type: "POST",
		url: base_url+"recTransaction/C_recTransaction/viewData",
		data: "inCardId="+$('#inCardId').val(),
		cache: false,
		beforeSend: function(data) {
			Swal.fire({
				title: 'Loading',
				allowEscapeKey: false,
				allowOutsideClick: false,
				didOpen: () => {
				  Swal.showLoading()
				}
			  });
		},
		success: function (data) {
			$('.contentRecTransaction').html(data);
			$(function () {
				$("#tableRecTransaction").DataTable({
					info: false,
    				ordering: false,
    				paging: false,
					searching: false
				});
				$("#inCardId").focus();
				$("#inCardId").val('');
				// fullScreen();
			})
		},
		complete : function(data){
			Swal.close();
		}
	});
}
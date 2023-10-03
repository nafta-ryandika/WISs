$(document).ready(function(){
	viewData();

	$('#btnModalProcess').on('click', function(){
		$('#formGetData').validate({
			rules: {
				inDate1: {
					required: true,
				},
		  		inDate2: {
					required: true,
				}
			},
			messages: {
				inDate1: {
					required: "Please enter Date"
				},
				inDate2: {
					required: "Please enter Date"
				}
			},
			errorElement: 'span',
			errorPlacement: function (error, element) {
			  error.addClass('invalid-feedback');
			  element.closest('.col-6').append(error);
			},
			highlight: function (element, errorClass, validClass) {
			  $(element).addClass('is-invalid');
			},
			unhighlight: function (element, errorClass, validClass) {
			  $(element).removeClass('is-invalid');
			}
		});

		if ($('#inDate1').val() > $('#inDate2').val()) { 
			Swal.fire({
				icon: 'error',
				title: 'Date1 Greater Than Date2 !'
			})
			return false;
		}

		if($("#formGetData").valid()){
			Swal.fire({
				title: 'Process Data ?',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes'
			  }).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						type: 'POST',
						url: base_url+'getDataAbsensi/C_getDataAbsensi/processData',
						data: {
								inDate1: $('#inDate1').val(),
								inDate2: $('#inDate2').val()
							  },
						cache: false,
						dataType: 'JSON',
						beforeSend: function (data){
							// Swal.showLoading();
							// alert('loading');
							// console.log('test');
							// setTimeout(function(){
								Swal.fire({
									title: 'Please Wait !',
									allowOutsideClick: false,
									showCancelButton: false,
									showConfirmButton: false,
									onBeforeOpen: () => {
										Swal.showLoading()
									},
								})	
							// }, 500);
						},
						success: function (data) {
							// console.log("lalala"+data.datax);
						},
						complete: function(data){
							Swal.fire({
								icon: 'success',
								title: 'Success'
							})
							// console.log("lalala"+data.datax);
							// console.log(data.err);
						}
					})
				}
			})
		}
	})
	
	$("#modalGetData").on("hidden.bs.modal", function () {
		$("#inDate1").val('');
		$("#inDate2").val('');
	});
});

function viewData() {
	$.ajax({
		type: "POST",
		url: base_url+"getDataAbsensi/C_getDataAbsensi/viewData",
		cache: false,
		success: function (data) {
			$('.contentData').html(data);
			$(function () {
				$("#tableData").DataTable({searching: false, paging: false, info: false});
			})
		}
	});
}
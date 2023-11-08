$(document).ready(function(){
	viewData();

	$('#btnAdd').on('click', function(){
		$('#btnArea').hide();
		viewInput('add');
	}) 

	$('#btnExport').on('click', function(){
		var inModalType = $('#inModalType').val();
		var inDatatablesParameter = $('.dataTables_filter input').val();
		
		// if (inModalType == 'pdf') {
			var url = base_url+"mCardKerja/C_cardKerja/export?inModalType="+inModalType+"&inDatatablesParameter="+inDatatablesParameter+"";
			window.open(url, '_blank');	
		// }
		// else if
	})

	$('#inModalParameter').on('change', function(){
		var param = $(this).val();
		var html = '';
		
		if (param == 'allData' || param == 'view'){
			$('#modalSearchArea').hide();
		}
		else {
			$('#modalSearchArea').show();

			if (param == 'user_id') {
				var html =  '<input type="text" name="inModalSearchParameter" class="form-control" id="inModalSearchParameter" placeholder="Parameter">';
			}
			else if (param == 'user_department'){
				getOption('m_department');
			}
			else if (param == 'user_division'){
				getOption('m_division');
			}
			else if (param == 'user_level'){
				getOption('m_level');
			}
		}
	})


});

function viewData() {
	$.ajax({
		type: "POST",
		url: base_url+"mCardKerja/C_cardKerja/viewData",
		cache: false,
		success: function (data) {
			$('.contentCardKerja').html(data);
			$(function () {
				$("#tableCardKerja").DataTable();
			})
		}
	});
}

function viewInput(inMode) {
	$.ajax({
		type: "POST",
		url: base_url+"mKerja/C_kerja/viewInput",
		data: "inMode="+inMode,
		cache: false,
		success: function (data) {
			$('.card-body').html(data);
			validateInput();
		}
	});
}

function editData(idx) {
	var inMode = "edit";
	var inKerjaId = "";
	var inKerjaName = "";
	var inKerjaPrice = "";
	var inKerjaSatuanId = "";
	
	$.ajax({
		type: "POST",
		url: base_url+"mKerja/C_kerja/getKerja",
		data: {inKerjaId : idx},
		cache: false,
		dataType: "json",
		async: false,
		success: function (data) {
			var i;
			for (i=0; i<data.length; i++) {
				inKerjaId = data[i].kerja_id;
				inKerjaName = data[i].kerja_name;
				inKerjaPrice = data[i].kerja_price;
				inKerjaSatuanId = data[i].kerja_satuan_id;
			}
		}
	}).done(function () {
		$.ajax({
			type: "POST",
			url: base_url+"mKerja/C_kerja/viewInput",
			data: "inMode="+inMode+
				  "&inKerjaId="+inKerjaId+
				  "&inKerjaName="+inKerjaName+
				  "&inKerjaPrice="+inKerjaPrice+
				  "&inKerjaSatuanId="+inKerjaSatuanId,
			cache: false,
			success: function (data) {
				$('.card-body').html(data);
				$('#btnArea').hide();
			}
		});
	})
}

function deleteData(idx) {
	Swal.fire({
		title: 'Delete Data ?',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes'
	  }).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				type: 'POST',
				url: base_url+'mKerja/C_kerja/deleteKerja',
				data: {
						inKerjaId:idx
					  },
				cache: false,
				dataType: 'JSON',
				success: function (data) {
				  console.log(data.res);
				  if (data.res == "success") {
					Swal.fire(
						'Data Deleted !'
					).then(function(){
						viewData();
					})
				  }
				  else {
					Swal.fire({
						icon: 'error',
						text: data.res,
					})
				  }
				}
			})
		}
	  })
}
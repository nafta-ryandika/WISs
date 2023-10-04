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
			var url = base_url+"mSatuan/C_satuan/export?inModalType="+inModalType+"&inDatatablesParameter="+inDatatablesParameter+"";
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
		url: base_url+"mSatuan/C_satuan/viewData",
		cache: false,
		success: function (data) {
			$('.contentSatuan').html(data);
			$(function () {
				$("#tableSatuan").DataTable();
			})
		}
	});
}

function viewInput(inMode) {
	$.ajax({
		type: "POST",
		url: base_url+"mSatuan/C_satuan/viewInput",
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
	var inSatuanId = "";
	var inSatuanName = "";
	
	$.ajax({
		type: "POST",
		url: base_url+"mSatuan/C_satuan/getSatuan",
		data: {inSatuanId : idx},
		cache: false,
		dataType: "json",
		async: false,
		success: function (data) {
			var i;
			for (i=0; i<data.length; i++) {
				inSatuanId = data[i].satuan_id;
				inSatuanName = data[i].satuan_name;
			}
		}
	}).done(function () {
		$.ajax({
			type: "POST",
			url: base_url+"mSatuan/C_satuan/viewInput",
			data: "inMode="+inMode+
				  "&inSatuanId="+inSatuanId+
				  "&inSatuanName="+inSatuanName,
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
				url: base_url+'mSatuan/C_satuan/deleteSatuan',
				data: {
						inSatuanId:idx
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
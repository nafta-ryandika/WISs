$(document).ready(function(){
	viewData();

	$('#btnAdd').on('click', function(){
		$('#btnArea').hide();
		viewInput('add');
	}) 

	$('#btnExport').on('click', function(){
		var inModalType = $('#inModalType').val();
		var inModalParameter =$('#inModalParameter').val();
		var value = $('.dataTables_filter input').val(); 
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
		url: base_url+"user/C_user/viewData",
		cache: false,
		success: function (data) {
			$('.contentUser').html(data);
			$(function () {
				$("#tableUser").DataTable();
			})
		}
	});
}

function editData(idx) {
	var inMode = "edit";
	var inId = "";
	var inName = "";
	var inEmail = "";
	var inDepartment = "";
	var inDivision = "";
	var inLevel = "";
	var inPassword = "";

	$.ajax({
		type: "POST",
		url: base_url+"user/C_user/getUser",
		data: {inId : idx},
		cache: false,
		dataType: "json",
		async: false,
		success: function (data) {
			var i;
			for (i=0; i<data.length; i++) {
				inId = data[i].user_id;
				inName = data[i].user_name;
				inEmail = data[i].user_email;
				inDepartment = data[i].user_department_id;
				inDivision = data[i].user_division_id;
				inLevel = data[i].user_level_id;
				inPassword = data[i].user_password;
			}
		}
	}).done(function () {
		$.ajax({
			type: "POST",
			url: base_url+"user/C_user/viewInput",
			data: "inMode="+inMode+
				  "&inId="+inId+
				  "&inName="+inName+
				  "&inEmail="+inEmail+
				  "&inDepartment="+inDepartment+
				  "&inDivision="+inDivision+
				  "&inLevel="+inLevel+
				  "&inPassword="+inPassword,
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
				url: base_url+'user/C_user/deleteUser',
				data: {
						inId:idx
					  },
				cache: false,
				dataType: 'JSON',
				success: function (data) {
				  console.log(data.res);
				  if (data.res == "success") {
					Swal.fire(
						'Data Deleted !'
					).then(function(){
						// window.location.href = base_url+'user/C_user';
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

function viewInput(inMode) {
	$.ajax({
		type: "POST",
		url: base_url+"user/C_user/viewInput",
		data: "inMode="+inMode,
		cache: false,
		success: function (data) {
			$('.card-body').html(data);
			validateInput();
		}
	});
}

function getDivision(){
	var inDepartment = $('#inDepartment').val();

	$.ajax({
		type: 'POST',
		url: base_url+"user/C_user/getDivision",
		data:{inDepartment: inDepartment},
		cache: false,
		dataType: 'json',
		success: function(data) {
			var html = '<option value="">Select Division</option>';
			var i;

			for (i=0; i<data.length; i++) {
				html += '<option value="' + data[i].division_id + '">' + data[i].division_name + '</option>';
			}

			$('#inDivision').html(html);
		}
	})
}

function getOption(idx){
	$.ajax({
		type: 'POST',
		url: base_url+"user/C_user/getOption",
		data:{inIdx: idx},
		cache: false,
		dataType: 'json',
		success: function(data) {
			var html = '<select class="form-control select2" style="width: 100%;" id="inModalSearchParameter" required>\n\
							<option value="">Select</option>';
			var i;

			for (i=0; i<data.length; i++) {
				if(idx == 'm_department'){
					html += '<option value="' + data[i].department_id + '">' + data[i].department_name + '</option>';
				}
				else if(idx == 'm_division'){
					html += '<option value="' + data[i].division_id + '">' + data[i].division_name + '</option>';
				}
				else if(idx == 'm_level'){
					html += '<option value="' + data[i].level_id + '">' + data[i].level_name + '</option>';
				}
			}

			html += '</select>';

			$('#modalSearchArea').html(html);
		}
	})
}
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
			var url = base_url+"rTransaction/C_rTransaction/export?inModalType="+inModalType+"&inDatatablesParameter="+inDatatablesParameter+"";
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
		url: base_url+"rTransaction/C_rTransaction/viewData",
		cache: false,
		success: function (data) {
			$('.contentRTransaction').html(data);
			$(function () {
				$("#tableRTransaction").DataTable();
			})
		}
	});
}
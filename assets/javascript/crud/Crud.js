$(document).ready(function(){
	viewData();

	$('#btnAdd').on('click', function(){
		$('#btnArea').hide();
		viewInput();
	})
});

function viewData() {
	$.ajax({
		type: "POST",
		url: base_url+"index.php/crud/C_crud/viewData",
		cache: false,
		success: function (data) {
			$('.card-body').html(data);
			$(function () {
				$("#example1").DataTable({
				  "responsive": true, "lengthChange": false, "autoWidth": false,
				  "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
				}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
			  });
		}
	});
}

function viewInput() {
	$.ajax({
		type: "POST",
		url: base_url+"index.php/crud/C_crud/viewInput",
		cache: false,
		success: function (data) {
			$('.card-body').html(data);
		}
	});
}
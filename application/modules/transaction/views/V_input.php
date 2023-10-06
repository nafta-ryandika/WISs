<?php
  if ($inMode == "edit") {
    echo '<span id="txtKerjaId" style="display : none;">'.$inKerjaId.'</span>';
    echo '<span id="txtKerjaName" style="display : none;">'.$inKerjaName.'</span>';
    echo '<span id="txtKerjaPrice" style="display : none;">'.$inKerjaPrice.'</span>';
    echo '<span id="txtKerjaSatuanId" style="display : none;">'.$inKerjaSatuanId.'</span>';
  }
?>

<form id="formKerja">
  <input type="hidden" id="inMode" value="<?=$inMode?>" disabled>
  <div class="row">
    <div class="col-3">
      <label for="id">ID Pekerjaan</label>
      <input type="text" name="inKerjaId" class="form-control" id="inKerjaId" placeholder="">
    </div>
  </div>
  <br/>
  <div class="row">
    <div class="col-3">
      <label for="id">Pekerjaan</label>
      <input type="text" name="inKerjaName" class="form-control" id="inKerjaName" placeholder="">
    </div>
  </div>
  <br/>
  <div class="row">
    <div class="col-3">
      <label for="id">Harga</label>
      <input type="text" name="inKerjaPrice" class="form-control" id="inKerjaPrice" placeholder="">
    </div>
  </div>
  <br/>
  <div class="row">
    <div class="col-3">
      <label for="id">Satuan</label>
      <input type="text" name="inKerjaSatuanId" class="form-control" id="inKerjaSatuanId" placeholder="">
    </div>
  </div>
  <br/>
  <!-- /.card-body -->
  <div class="card-footer row">
    <div class="col-5"></div>
    <div class="col-1">
      <button type="button" class="btn btn-block btn-primary" id="btnSave">Save</button>
    </div>
    <div class="col-1">
      <button type="button" class="btn btn-block btn-danger" id="btnCancel">Cancel</button>
    </div>
    <div class="col-5"></div>
  </div>
</form>

<script type="text/javascript">
$(document).ready(function(){
  $('#formKerja').validate({
		rules: {
			inKerjaId: {
				required: true,
			},
      inKerjaName: {
				required: true,
			},
      inKerjaPrice: {
				required: true,
			},
      inKerjaSatuanId: {
				required: true,
			}
		},
		messages: {
			inKerjaId: {
				required: "Please enter ID Pekerjaan"
			},
			inKerjaName: {
				required: "Please enter Pekerjaan"
			},
			inKerjaPrice: {
				required: "Please enter Harga"
			},
			inKerjaSatuanId: {
				required: "Please enter Satuan"
			}
		},
		errorElement: 'span',
		errorPlacement: function (error, element) {
		  error.addClass('invalid-feedback');
		  element.closest('.col-3').append(error);
		},
		highlight: function (element, errorClass, validClass) {
		  $(element).addClass('is-invalid');
		},
		unhighlight: function (element, errorClass, validClass) {
		  $(element).removeClass('is-invalid');
		}
	});

	$('#btnSave').on('click', function(){
		if($("#formKerja").valid()){
      var inMode = $('#inMode').val();
      var inKerjaId = $('#inKerjaId').val();
      var inKerjaName = $('#inKerjaName').val();
      var inKerjaPrice = $('#inKerjaPrice').val();
      var inKerjaSatuanId = $('#inKerjaSatuanId').val();
      
      $.ajax({
        type: 'POST',
        url: base_url+'mKerja/C_kerja/addKerja',
        data: {
                inMode:inMode,
                inKerjaId:inKerjaId, 
                inKerjaName: inKerjaName,
                inKerjaPrice: inKerjaPrice,
                inKerjaSatuanId: inKerjaSatuanId,
              },
        cache: false,
        dataType: 'JSON',
        success: function (data) {
          console.log(data.res);
          if (data.res == "success") {
              alertify.success('Success');
              setTimeout(function(){
                window.location.href = base_url+'mKerja/C_kerja';
              }, 500); 
              // window.location.href = base_url+'user/C_user';
          }
          else {
              alertify.error(data.res);
          }
        }
      })
    }
	})

  $('#btnCancel').on('click', function(){
    window.location.href = base_url+'mKerja/C_kerja'
  })

  var inMode = $("#inMode").val();
  if(inMode == "edit"){
    $("#inKerjaId").val($("#txtKerjaId").text());
    $("#inKerjaName").val($("#txtKerjaName").text());
    $("#inKerjaPrice").val($("#txtKerjaPrice").text());
    $("#inKerjaSatuanId").val($("#txtKerjaSatuanId").text());

    validateInput();
  }
});
</script>
<?php
  if ($inMode == "edit") {
    echo '<span id="txtSatuanId" style="display : none;">'.$inSatuanId.'</span>';
    echo '<span id="txtSatuanName" style="display : none;">'.$inSatuanName.'</span>';
  }
?>

<form id="formSatuan">
  <input type="hidden" id="inMode" value="<?=$inMode?>" disabled>
  <div class="row">
    <div class="col-3">
      <label for="id">Satuan ID</label>
      <input type="text" name="inSatuanId" class="form-control" id="inSatuanId" placeholder="">
    </div>
  </div>
  <br/>
  <div class="row">
    <div class="col-3">
      <label for="id">Satuan Name</label>
      <input type="text" name="inSatuanName" class="form-control" id="inSatuanName" placeholder="">
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
  $('#formSatuan').validate({
		rules: {
			inSatuanId: {
				required: true,
			},
      inSatuanName: {
				required: true,
			}
		},
		messages: {
			inSatuanId: {
				required: "Please enter Satuan ID"
			},
			inSatuanName: {
				required: "Please enter Satuan Name"
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

	$('#btnSave').on('click', function(){
		if($("#formSatuan").valid()){
      var inMode = $('#inMode').val();
      var inSatuanId = $('#inSatuanId').val();
      var inSatuanName = $('#inSatuanName').val();
      
      $.ajax({
        type: 'POST',
        url: base_url+'mSatuan/C_satuan/addSatuan',
        data: {
                inMode:inMode,
                inSatuanId:inSatuanId, 
                inSatuanName: inSatuanName
              },
        cache: false,
        dataType: 'JSON',
        success: function (data) {
          console.log(data.res);
          if (data.res == "success") {
              alertify.success('Success');
              setTimeout(function(){
                window.location.href = base_url+'mSatuan/C_satuan';
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
    window.location.href = base_url+'mSatuan/C_satuan'
  })

  var inMode = $("#inMode").val();
  if(inMode == "edit"){
    $("#inSatuanId").val($("#txtSatuanId").text());
    $("#inSatuanName").val($("#txtSatuanName").text());

    validateInput();
  }
});
</script>
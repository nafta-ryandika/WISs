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
  <label for="pekerjaan">Pekerjaan</label>
  <div class="row">
    <div class="col-md-3">
      <select class="form-control select2" id="inPekerjaan" style="width: 100%;">
        <?php
          foreach ($pekerjaan as $data) {
            echo '<option value="'.$data->kerja_id.'">'.$data->kerja_name.'</option>';
          }
        ?>
      </select>
    </div>
    <div class="col-md-1">
      <button type="button" class="btn btn-block btn-success" id="btnGetListCard">Get Data</button>
    </div>
  </div>
  <br/>
  <label for="pekerjaan">Active Date</label>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>Date range:</label>

        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">
              <i class="far fa-calendar-alt"></i>
            </span>
          </div>
          <input type="text" class="form-control float-right" id="reservation">
        </div>
        <!-- /.input group -->
      </div>
    </div>
  </div>
  <br/>
  <div class="row">
    <div class="col-md-12">
      <table id="tableListCard" class="table table-bordered table-striped">
        <thead style="text-align: center;">
          <tr>
            <th>Action</th>
            <th>ID Card</th>
            <th>Pekerjaan</th>
            <th>Status</th>
            <th>Start Date</th>
            <th>End Date</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
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
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })
  
$(document).ready(function(){
  getListPekerjaan();

  $('#inPekerjaan').on('click', function(){
    getListPekerjaan();
  })

  $('#btnGetListCard').on('click',function() {
    getListCard();
  })

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
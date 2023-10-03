<?php
  if ($inMode == "edit") {
    echo '<span id="txtId" style="display : none;">'.$inId.'</span>';
    echo '<span id="txtName" style="display : none;">'.$inName.'</span>';
    echo '<span id="txtEmail" style="display : none;">'.$inEmail.'</span>';
    echo '<span id="txtDepartment" style="display : none;">'.$inDepartment.'</span>';
    echo '<span id="txtDivision" style="display : none;">'.$inDivision.'</span>';
    echo '<span id="txtLevel" style="display : none;">'.$inLevel.'</span>';
    echo '<span id="txtPassword" style="display : none;">'.$inPassword.'</span>';
  }
?>

<form id="formUser">
  <input type="hidden" id="inMode" value="<?=$inMode?>" disabled>
  <div class="row">
    <div class="col-6">
      <label for="id">ID</label>
      <input type="text" name="inId" class="form-control" id="inId" placeholder="ID">
    </div>
    <div class="col-6">
      <label for="department">Division</label>
      <select class="form-control select2" style="width: 100%;" id="inDivision" required>
        <option value="">Select Division</option>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-6">
      <label for="name">Name</label>
      <input type="text" name="inName" class="form-control" id="inName" placeholder="Name">
    </div>
    <div class="col-6">
      <label for="level">Level</label>
      <select class="form-control select2" style="width: 100%;" id="inLevel" required>
        <option value="">Select Level</option>
        <?php
          foreach ($level as $data) {
            echo '<option value="'.$data->level_id.'">'.$data->level_name.'</option>';
          }
        ?>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-6">
      <label for="email">Email</label>
      <input type="email" name="inEmail" class="form-control" id="inEmail" placeholder="Email">          
    </div>
    <div class="col-6">
      <label for="password" id="lblPassword">Password</label>
      <input type="password" name="inPassword" class="form-control" id="inPassword" placeholder="Password">
    </div>
  </div>
  <div class="row">
    <div class="col-6">
      <label for="department">Department</label>
        <select class="form-control select2" style="width: 100%;" id="inDepartment" required>
          <option value="">Select Department</option>
          <?php
            foreach ($department as $data) {
              echo '<option value="'.$data->department_id.'">'.$data->department_name.'</option>';
            }
          ?>
        </select>
    </div>
    <div class="col-6">
      <label for="reTypePassword" id="lblReTypePassword">Retype Password</label>
      <input type="password" name="inReTypePassword" class="form-control" id="inReTypePassword" placeholder="Password">
    </div>
  </div>
  <br/>
  <!-- /.card-body -->
  <div class="card-footer row">
    <div class="col-1">
      <button type="button" class="btn btn-block btn-primary" id="btnSave">Save</button>
    </div>
    <div class="col-1">
      <button type="button" class="btn btn-block btn-danger" id="btnCancel">Cancel</button>
    </div>
  </div>
</form>

<script type="text/javascript">
$(document).ready(function(){
  $('#inDepartment').on('change', function(){
    getDivision();
  })

  $('#formUser').validate({
		rules: {
			inId: {
				required: true,
			},
      inName: {
				required: true,
			},
			inEmail: {
				required: true,
				email: true,
			},
      inPassword: {
				required: true,
			},
      inReTypePassword: {
				required: true,
        equalTo: '#inPassword'
			}
		},
		messages: {
			inId: {
				required: "Please enter ID"
			},
			inName: {
				required: "Please enter Name"
			},
			inEmail: {
				required: "Please enter Email",
				email: "Please enter valid Email"
			},
			inDepartment: {
				required: "Please enter Department"
			},
			inLevel: {
				required: "Please enter Level"
			},
			inPassword: {
				required: "Please enter Password"
			},
			inReTypePassword: {
				required: "Please enter Retype Password",
        equalTo: "Password does not match"
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
		if($("#formUser").valid()){
      var inMode = $('#inMode').val();
      var inId = $('#inId').val();
      var inName = $('#inName').val();
      var inEmail = $('#inEmail').val();
      var inDepartment = $('#inDepartment').val();
      var inDivision = $('#inDivision').val();
      var inLevel = $('#inLevel').val();
      var inPassword = $('#inPassword').val();

      $.ajax({
        type: 'POST',
        url: base_url+'user/C_user/addUser',
        data: {
                inMode:inMode,
                inId:inId, 
                inName: inName,
                inEmail: inEmail,
                inDepartment: inDepartment,
                inDivision: inDivision,
                inLevel:inLevel, 
                inPassword:inPassword
              },
        cache: false,
        dataType: 'JSON',
        success: function (data) {
          console.log(data.res);
          if (data.res == "success") {
              alertify.success('Success');
              setTimeout(function(){
                window.location.href = base_url+'user/C_user';
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
    window.location.href = base_url+'user/C_user'
  })

  var inMode = $("#inMode").val();
  if(inMode == "edit"){
    $("#inId").val($("#txtId").text());
    $("#inName").val($("#txtName").text());
    $("#inEmail").val($("#txtEmail").text());
    $("#inDepartment").val($("#txtDepartment").text());
    $("#inLevel").val($("#txtLevel").text());
    $("#inPassword").val($("#txtPassword").text());
    $("#inReTypePassword").val($("#txtPassword").text());

    $.ajax({
      type: 'POST',
      url: base_url+"user/C_user/getDivision",
      data:{inDepartment: $("#txtDepartment").text()},
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
    }).done(function () {
      $("#inDivision").val($("#txtDivision").text());
      $("#inId").attr("disabled", true);
      $("#inPassword").hide();
      $("#lblPassword").hide();
      $("#inReTypePassword").hide();
      $("#lblReTypePassword").hide();
      validateInput();
    })
  }
});
</script>
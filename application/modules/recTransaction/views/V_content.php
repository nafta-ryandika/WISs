<!-- Main content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Rec Transaction</h1>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header" id="btnArea">
              <div class="row">
                <div class="col-4">
                  <a href="<?php echo base_url();?>dashboard/C_dashboard"><i class="fa-solid fa-house fa-xl align-middle" style="cursor: pointer;"></i></a>
                </div>
                <div class="col-4">
                  <input type="text" name="inCardId" class="form-control" id="inCardId" placeholder="ID Card" style="text-align: center; font-size: 21px;" autofocus>
                </div>
                <div class="col-4" style="text-align: right;">
                  <i class="fa-solid fa-expand fa-xl align-middle" id="btnFullScreen" style="cursor: pointer;" onclick="fullScreen()"></i>
                </div>
              </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body contentRecTransaction">
            
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content -->
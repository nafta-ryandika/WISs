<!-- Main content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Get Data Absensi</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>dashboard/C_dashboard">Home</a></li>
          <li class="breadcrumb-item">HRM/GA-HSE</li>
          <li class="breadcrumb-item">HRM</li>
          <li class="breadcrumb-item active"><a href="<?php echo base_url();?>getDataAbsensi/C_getDataAbsensi">Get Data Absensi</a></li>
        </ol>
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
                <div class="col-1">
                  <button type="button" class="btn btn-block btn-primary" id="btnGetData" data-toggle="modal" data-target="#modalGetData">Get Data</button>

                  <div class="modal fade" id="modalGetData" tabindex="-1" role="dialog" aria-labelledby="modalGetData" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <form id="formGetData">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Get Data Absensi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="col-12">
                              <label for="inDate1">Date 1</label>
                              <input type="date" name="inDate1" class="form-control" id="inDate1" placeholder="Date 1">
                            </div>
                            <div class="col-12">
                              <label for="inDate2">Date 2</label>
                              <input type="date" name="inDate2" class="form-control" id="inDate2" placeholder="Date 1">
                            </div>
                            <br/>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" id="btnModalProcess">Process</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body contentData">
            
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
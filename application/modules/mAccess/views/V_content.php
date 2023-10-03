<!-- Main content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Master User</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item">Master</li>
          <li class="breadcrumb-item active">User</li>
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
                  <button type="button" class="btn btn-block btn-primary" id="btnAdd">Add</button>
                </div>
                <div class="col-10">
                
                </div>
                <div class="col-1">
                  <button type="button" class="btn btn-block btn-success" id="btnModalExport" data-toggle="modal" data-target="#modalExport">Export</button>

                  <div class="modal fade" id="modalExport" tabindex="-1" role="dialog" aria-labelledby="modalExport" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Export</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <label for="department">Type</label>
                          <select class="form-control select2" style="width: 100%;" id="inModalType" required>
                            <option value="pdf">PDF</option>
                            <option value="xls">XLS</option>
                          </select>

                          <label for="data">Parameter</label>
                          <select class="form-control select2" style="width: 100%;" id="inModalParameter" required>
                            <option value="allData">All Data</option>
                            <option value="view">View</option>
                            <option value="user_id">Id</option>
                            <option value="user_department">Department</option>
                            <option value="user_division">Division</option>
                            <option value="user_level">Level</option>
                          </select>
                          <br/>
                          <div id="modalSearchArea" style="display: none;">
                            <input type="text" name="inModalSearchParameter" class="form-control" id="inModalSearchParameter" placeholder="Parameter">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-success" id="btnExport">Export</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body contentUser">
            
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
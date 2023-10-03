<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> Dashboard </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content" style="height: 100%; min-height: 359px;">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h5 class="card-title m-0">Featured</h5>
            </div>
            <div class="card-body">
              <h6 class="card-title">Born Day</h6>

              <p class="card-text">The system was born - 01/11/2022</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-2 col-8">
          <a href="<?php echo base_url();?>getDataAbsensi/C_getDataAbsensi">
            <div class="small-box bg-success">
              <div class="inner" style="min-height: 120px;">
                <h3>Get Data</h3>
                <h4>Absensi</h4>  
              </div>
              <div class="icon">
                <i class="fas fa-user-plus"></i>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-2 col-8">
          <a href="http://192.168.10.167/HRD/absCsv/" target="_blank">
            <div class="small-box bg-info">
            <div class="inner" style="min-height: 120px;">
              <h3>*.csv</h3>
            </div>
            <div class="icon">
              <i class="fas fa-file-csv"></i>
            </div>
          </div>
          </a>
        </div>
        <div class="col-lg-2 col-8">
          <a href="http://192.168.10.167/HRD/absManual/" target="_blank">
            <div class="small-box bg-success">
              <div class="inner" style="min-height: 120px;">
                <h3>Abs. Manual</h3>
              </div>
              <div class="icon">
                <i class="fas fa-user-plus"></i>
              </div>
            </div>
          </a>
        </div>
      </div>
      <!-- <div class="row"> -->
        
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
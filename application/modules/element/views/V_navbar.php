<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
  <div class="container-fluid">
    <!-- <a href="<?php echo base_url();?>index.php/dashboard/C_dashboard" class="navbar-brand">
      <span class="brand-text font-weight-light">HR Department</span>
    </a> -->
    <a href="<?php echo base_url();?>dashboard/C_dashboard">
      <!-- <img src="<?php echo base_url();?>assets/image/bbmmp.png" style="height: 25px; width: auto;"> -->
    </a>

    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="<?php echo base_url();?>dashboard/C_dashboard" class="nav-link">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Master</a>
          <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            <li><a href="<?php echo base_url();?>user/C_user" class="dropdown-item">User</a></li>
            <li><a href="<?php echo base_url();?>mMenu/C_menu" class="dropdown-item">Menu</a></li>
            <li><a href="<?php echo base_url();?>user/C_user" class="dropdown-item">Access</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">HRM/GA-HSE</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li class="dropdown-submenu dropdown-hover">
                <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">HRM</a>
                <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                  <li>
                    <a tabindex="-1" class="dropdown-item" href="<?php echo base_url();?>getDataAbsensi/C_getDataAbsensi">Get Data Absensi</a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
      </ul>

      <!-- SEARCH FORM -->
      <form class="form-inline ml-0 ml-md-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>
    </div>

    <!-- Right navbar links -->
    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">0</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">0 Notifications</span>
          <!-- <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a> -->
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>

      <!-- User Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-id-card mr-2"></i><?php echo($this->session->userdata('user_id')); ?>
            </a>
            <a href="#" class="dropdown-item">
              <i class="fas fa-user mr-2"></i><?php echo($this->session->userdata('user_name')); ?>
            </a>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i><?php echo($this->session->userdata('user_email')); ?>
            </a>
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url();?>index.php/login/C_login/logout" class="dropdown-item dropdown-footer">Log Out</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
<!-- /.navbar -->
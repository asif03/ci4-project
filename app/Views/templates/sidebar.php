<div class="sidebar sidebar-style-2" data-background-color="white">
  <div class="sidebar-logo">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="white">
      <a href="<?php echo base_url(); ?>" class="logo">
        <img src="<?php echo base_url(); ?>public/logo.png" alt="navbar brand" class="navbar-brand" height="36"
          width="36" />
        <span class="fs-3 fw-bold ps-2">BCPS</span>
      </a>
      <div class="nav-toggle">
        <button class="btn btn-toggle toggle-sidebar">
          <i class="gg-menu-right"></i>
        </button>
        <button class="btn btn-toggle sidenav-toggler">
          <i class="gg-menu-left"></i>
        </button>
      </div>
      <button class="topbar-toggler more">
        <i class="gg-more-vertical-alt"></i>
      </button>
    </div>
    <!-- End Logo Header -->
  </div>
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <ul class="nav nav-secondary">
        <?php echo base_url('dashboard'); ?>
        <li class="nav-item <?=(current_url() === base_url('dashboard')) ? 'active' : ''?>">
          <a href="<?=base_url('dashboard')?>">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">Admin</h4>
        </li>
        <li class="nav-item active submenu">
          <a data-bs-toggle="collapse" href="#sidebarApplications">
            <i class="fas fa-th-list"></i>
            <p>Applications</p>
            <span class="caret"></span>
          </a>
          <div class="collapse show" id="sidebarApplications">
            <ul class="nav nav-collapse">
              <li class="active">
                <a href="sidebar-style-2.html">
                  <span class="sub-item">Sidebar Style 2</span>
                </a>
              </li>
              <li>
                <a href="icon-menu.html">
                  <span class="sub-item">Icon Menu</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item <?=(current_url() === base_url('honorariums')) ? 'active' : ''?> submenu">
          <a data-bs-toggle="collapse" href="#sidebarHonourariums">
            <i class="fas fa-th-list"></i>
            <p>Honorariums</p>
            <span class="caret"></span>
          </a>
          <div class="collapse show" id="sidebarHonourariums">
            <ul class="nav nav-collapse">
              <li class="active">
                <a href="sidebar-style-2.html">
                  <span class="sub-item">Sidebar Style 2</span>
                </a>
              </li>
              <li>
                <a href="icon-menu.html">
                  <span class="sub-item">Icon Menu</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">Settings</h4>
        </li>
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#forms">
            <i class="fas fa-pen-square"></i>
            <p>Forms</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="forms">
            <ul class="nav nav-collapse">
              <li>
                <a href="forms/forms.html">
                  <span class="sub-item">Basic Form</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>
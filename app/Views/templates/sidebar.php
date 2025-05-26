<?php
    $auth = service('auth');
    $user = $auth->user();

    echo '<pre>';
    print_r($user);
    echo '</pre>';
?>
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
        <li class="nav-item <?=set_active('dashboard', true)?>">
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
        <li class="nav-item <?=set_active('applications')?> submenu">
          <a data-bs-toggle="collapse" href="#sidebarApplications">
            <i class="fas fa-th-list"></i>
            <p>Applications</p>
            <span class="caret"></span>
          </a>
          <div class="collapse <?=set_show('applications')?>" id="sidebarApplications">
            <ul class="nav nav-collapse">
              <li class="<?=set_active('applications')?>">
                <a href="<?=base_url('applications')?>">
                  <span class="sub-item">Applicant List</span>
                </a>
              </li>
              <!-- <li>
                <a href="icon-menu.html">
                  <span class="sub-item">Icon Menu</span>
                </a>
              </li> -->
            </ul>
          </div>
        </li>
        <li class="nav-item <?=set_active('bills')?> submenu">
          <a data-bs-toggle="collapse" href="#sidebarBills">
            <i class="fas fa-th-list"></i>
            <p>Bills</p>
            <span class="caret"></span>
          </a>
          <div class="collapse <?=set_show('bills')?>" id="sidebarBills">
            <ul class="nav nav-collapse">
              <li class="<?=set_active('bills')?>">
                <a href="<?=base_url('bills')?>">
                  <span class="sub-item">Honorarium List</span>
                </a>
              </li>

            </ul>
          </div>
        </li>
        <li class="nav-item <?=set_active('reports')?> submenu">
          <a data-bs-toggle="collapse" href="#sidebarReports">
            <i class="fas fa-file-alt"></i>
            <p>Reports</p>
            <span class="caret"></span>
          </a>
          <div class="collapse <?=set_show('reports')?>" id="sidebarReports">
            <ul class="nav nav-collapse">
              <li class="<?=set_active('reports/applications')?>">
                <a href="<?=base_url('reports/applications')?>">
                  <span class="sub-item">Application Report</span>
                </a>
              </li>
              <li class="<?=set_active('reports/bills')?>">
                <a href="<?=base_url('reports/bills')?>">
                  <span class="sub-item">Bill Report</span>
                </a>
              </li>
              <!-- <li>
                <a href="icon-menu.html">
                  <span class="sub-item">Icon Menu</span>
                </a>
              </li> -->
            </ul>
          </div>
        </li>
        <?php if ($user && $user->inGroup('superadmin', 'admin')) {?>
        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">Settings</h4>
        </li>
        <li class="nav-item <?=set_active('users')?>">
          <a data-bs-toggle="collapse" href="#userManagement">
            <i class='fas fa-user-cog'></i>
            <p>User Management</p>
            <span class="caret"></span>
          </a>
          <div class="collapse <?=set_show('users')?>" id="userManagement">
            <ul class="nav nav-collapse">
              <li>
                <a href="forms/forms.html">
                  <span class="sub-item">User Management</span>
                </a>
              </li>
              <li class="<?=set_active('users/assign-user-role')?>">
                <a href="<?=base_url('users/assign-user-role')?>">
                  <span class="sub-item">Assign Role</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <?php }?>
      </ul>
    </div>
  </div>
</div>
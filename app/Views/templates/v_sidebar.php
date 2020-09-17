<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
  <div class="sidebar-brand-icon">
    <i class="fas fa-school"></i>
  </div>
  <div class="sidebar-brand-text mx-3">Sekolah</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
  <a class="nav-link" href="<?= base_url(); ?>">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Member
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
<a class="nav-link collapsed" href="<?= base_url('guru'); ?>">
    <i class="fas fa-table"></i>
    <span>Data Guru</span>
  </a>
  <a class="nav-link collapsed" href="<?= base_url('pelajar'); ?>">
    <i class="fas fa-table"></i>
    <span>Data Pelajar</span>
  </a>
</li>



<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->
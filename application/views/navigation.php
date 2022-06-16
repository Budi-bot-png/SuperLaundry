<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex flex-column align-items-center justify-content-center my-3" href="<?php echo base_url()?>dashboard">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-tshirt rotate-n-15"></i>
                    <div class="sidebar-brand-text mx-3">SuperLaundry:<?php echo $username ?></div>
                </div>
                
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url()?>dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <!-- <hr class="sidebar-divider"> -->

            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url()?>karyawan">
                    <i class="fas fa-fw fa-user-tie"></i>
                    <span>Karyawan</span></a>
            </li>

            <!-- <hr class="sidebar-divider"> -->

            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url()?>pelanggan">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Pelanggan</span></a>
            </li>

            <!-- <hr class="sidebar-divider"> -->

            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url()?>transaksi">
                    <i class="fas fa-fw fa-dollar-sign"></i>
                    <span>Transaksi</span></a>
            </li>

            <!-- <hr class="sidebar-divider"> -->

            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url()?>pengeluaran">
                    <i class="fas fa-fw fa-share"></i>
                    <span>Pengeluaran</span></a>
            </li>

            <!-- <hr class="sidebar-divider"> -->

            <!-- Nav Item - Master Data Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Master Data</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="---PHP Link---karyawan">Employee</a>
                        <a class="collapse-item" href="---PHP Link---pelanggan">Customer</a>
                        <a class="collapse-item" href="---PHP Link---transaksi">Transaction</a>
                        <a class="collapse-item" href="---PHP Link---pengeluaran">Expenditure</a>
                    </div>
                </div>
            </li> -->

            

            <!-- Nav Item - Report Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-file-pdf"></i>
                    <span>Bagian Laporan</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo base_url()?>karyawan/laporan">Karyawan</a>
                        <a class="collapse-item" href="<?php echo base_url()?>pelanggan/laporan">Pelanggan</a>
                        <a class="collapse-item" href="<?php echo base_url()?>transaksi/laporan">Transaksi</a>
                        <a class="collapse-item" href="<?php echo base_url()?>pengeluaran/laporan">Pengeluaran</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <!-- <hr class="sidebar-divider"> -->

            <!-- Nav Item - Data Mahasiswa -->
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-power-off icon-nav"></i>
                    <span>Logout</span>
                </a>
            </li>

            <!-- Divider -->
            <!-- <hr class="sidebar-divider d-none d-md-block"> -->

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav mr-auto">

                        <!-- Web Page Logo -->
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url().'dashboard' ?>">
                                <img class="logo"
                                    src="<?php echo base_url().'assets/img/logo.png' ?>">
                            </a>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Web Page Title -->
                        <li class="nav-item mx-1">
                            <a class="nav-link" href="#">
                                <div class="text-lg text-dark font-weight-bold"> SuperLaundry Management</div>
                            </a>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Logout Modal-->
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModal"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="logoutModalLabel">Apakah Anda yakin untuk keluar?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body mx-3 mb-4">Pilih tombol "Logout" di bawah jika Anda siap untuk mengakhiri sesi ini.</div>
                            <div class="modal-footer d-flex m-3">
                                <button class="flex-fill btn btn-secondary p-2 rounded-pill" type="button" data-dismiss="modal">Batal</button>
                                <a class="flex-fill btn btn-danger p-2 rounded-pill" href="<?php echo base_url().'welcome/logout'?>">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>

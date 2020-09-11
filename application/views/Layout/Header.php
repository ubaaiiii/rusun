<!doctype html>
<html class="no-js" lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $setting['nama']; ?> - <?=$lokasi;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= base_url('assets/images/icon/'.$setting['logo']); ?>">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap-toggle.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/rangeslider.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/ekko-lightbox.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/themify-icons.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/metisMenu.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/slicknav.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/home/') ?>css/icomoon.css">
    <!-- Date Time Picker -->
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/datatables/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/datatables/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/datatables/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/datatables/responsive.jqueryui.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="<?=base_url();?>assets/css/google-font.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/typography.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/default-css.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/styles.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/switcher.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/responsive.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/daterangepicker/daterangepicker.css">
    <!-- jquery latest version -->
    <script src="<?=base_url();?>assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- modernizr css -->
    <script src="<?=base_url();?>assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <!-- Date Time Picker -->
    <script src="<?=base_url();?>assets/js/bootstrap-datetimepicker.min.js"></script>
    <!-- <script src="<?=base_url();?>assets/js/bootstrap-datetimepicker.id.js"></script> -->
    <script src="<?=base_url();?>assets/js/rangeslider.min.js"></script>
    <!-- Start datatable js -->
    <script src="<?=base_url();?>assets/js/datatables/jquery.dataTables.10.18.min.js"></script>
    <script src="<?=base_url();?>assets/js/datatables/jquery.dataTables.10.19.min.js"></script>
    <script src="<?=base_url();?>assets/js/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="<?=base_url();?>assets/js/datatables/dataTables.responsive.min.js"></script>
    <script src="<?=base_url();?>assets/js/datatables/responsive.bootstrap.min.js"></script>
    <script src="<?=base_url();?>assets/js/datatables/dataTables.buttons.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?=base_url();?>assets/js/sweetalert2.js"></script>
    <script src="<?=base_url();?>assets/js/validate.min.js"></script>
    <script src="<?=base_url();?>assets/js/jquery.mask.min.js"></script>
  </head>

  <body>
    <!--[if lt IE 8]> <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p> <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
      <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
      <!-- sidebar menu area start -->
      <div class="sidebar-menu">
        <div class="sidebar-header">
          <div class="logo">
            <a href="<?=base_url();?>"><img src="<?=base_url();?>assets/images/icon/logo-new.png" alt="logo"></a>
          </div>
        </div>
        <div class="main-menu">
          <div class="menu-inner">
            <nav>
              <ul class="metismenu" id="menu">
                <li>
                  <a href="<?=base_url('home');?>" aria-expanded="true">
                    <i class="icon-dashboard2"></i>
                    <span>Dashboard</span></a>
                </li>
                <li>
                  <a href="<?=base_url();?>" aria-expanded="true">
                    <i class="icon-home"></i>
                    <span>Landing Page</span>
                    <br><small>Halaman Utama Website</small></a>
                </li>
                <li><a href="<?= base_url('home/booking') ?>">
                    <?php if (isset($dUser['admin'])): ?>
                        <i class="icon-calendar"></i> <span>Transaksi</span>
                        <br><small>Booking, Perpanjang</small></a>
                        <?php if ($booking > 0): ?>
                            <span class="badge badge-danger"><?= $booking ?> Notif</span>
                            <br><small>Proses Booking, Konfirmasi, Tolak</small>
                        <?php endif ?>
                    <?php else: ?>
                        <i class="icon-calendar"></i> <span>Booking</span>
                    <?php endif; ?>
                  </a>
                </li>

                <?php if (isset($dUser['admin'])) { ?>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="icon-room_service"></i><span> Kamar</span></a>
                        <ul class="collapse">
                            <li><a href="<?= base_url('home/kamar') ?>"><i class="fa fa-bed"></i><span>Data Kamar</span></a></li>
                            <li><a href="<?= base_url('home/kamar/management') ?>"><i class="ti-timer"></i><span> Management Kamar</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?=base_url('home/laporan');?>" aria-expanded="true"><i class="ti-file"></i><span> Laporan</span><br><small>Laporan Keuangan</small></a>
                    </li>
                    <li>
                        <a href="<?= base_url('home/users') ?>"><i class="fa fa-users"></i><span> Users</span><br><small>Tambah, Edit, Hapus, User, Admin</small></a>
                    </li>
                    <li><a href="<?= base_url('home/gallery') ?>"><i class="ti-gallery"></i> <span>Gallery</span><br><small>Foto - Foto <?=$setting['nama'];?></small></a></li>
                    <li><a href="<?= base_url('home/pesan') ?>"><i class="ti-envelope"></i> <span>Pesan</span><br><small>Masukkan Dari Pengunjung</small></a></li>
                    <li><a href="<?= base_url('home/setting') ?>"><i class="ti-settings"></i> <span>Setting</span><br><small>Logo, Data Aplikasi, Rekening</small></a></li>
                  <?php
                    } ?>
                  </ul>
            </nav>
            <?php
            if (isset($dUser['nik']) and $lokasi=="Booking") {
              ?>
              <div class="card" id="filter-booking">
                <div class="card-body">
                  <h4 class="header-title">Filter Booking</h4>
                  <div id="accordion2" class="according accordion-s2">
                    <div class="card">
                      <div class="card-header">
                        <select class="custom-select" id="filter-lantai">
                          <option value="all" selected="selected" hidden>-- Lantai --</option>
                          <option value="all">Semua Lantai</option>
                          <option value="1">Lantai 1</option>
                          <option value="2">Lantai 2</option>
                          <option value="3">Lantai 3</option>
                          <option value="4">Lantai 4</option>
                        </select>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header">
                        <select class="custom-select" id="filter-status">
                          <option value="all" selected="selected" hidden>-- Status --</option>
                          <option value="all">Semua Status</option>
                          <option value="1">Tersedia</option>
                          <option value="2">Dibooking</option>
                          <option value="3">Ditempati</option>
                        </select>
                      </div>
                    </div>
                    <button id="filter-search" hidden></button>
                    <button id="filter-reset" class="btn btn-dark float-right btn-xs">Reset</button>
                  </div>
                </div>
              </div>
              <script>
              $(document).ready(function(){
                $('#filter-lantai').change(function(e){
                  $('#filter-search').trigger('click');
                })
                $('#filter-status').change(function(e){
                  $('#filter-search').trigger('click');
                })
                $('#filter-reset').click(function(){
                  $('#filter-lantai').val('all');
                  $('#filter-status').val('all');
                  $('#filter-search').trigger('click');
                })

                $('#filter-search').on('click',function(){
                  var fLantai = $('#filter-lantai option:selected').val();
                  var fStatus = $('#filter-status option:selected').val();
                  $('.t-all').css('display','none');
                  $('.t-'+fLantai+'.s-'+fStatus).removeAttr('style');
                  if(!$('.t-all').is(':visible')){
                    $('#kamar-kosong').removeAttr('style');
                  } else {
                    $('#kamar-kosong').css('display','none');
                  }
                })
              })
              </script>
            <?php } ?>
          </div>
        </div>
      </div>
      <!-- sidebar menu area end -->
      <!-- main content area start -->
      <div class="main-content">
        <!-- header area start -->
        <div class="header-area">
          <div class="row align-items-center">
            <!-- nav and search button -->
            <div class="col-md-6 col-sm-8 clearfix">
              <div class="nav-btn pull-left">
                <span></span>
                <span></span>
                <span></span>
              </div>
            </div>
            <!-- profile info & task notification -->

          </div>
        </div>
        <!-- header area end -->
        <!-- page title area start -->
        <div class="page-title-area">
          <div class="row align-items-center">
            <div class="col-sm-6">
              <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left" id="pTitle"><?=$lokasi;?><span id="pTambahan"></span></h4>
              </div>
            </div>
            <div class="col-sm-6 clearfix">
              <div class="user-profile pull-right">
                <h4 class="user-name dropdown-toggle" data-toggle="dropdown">
                  <img class="avatar user-thumb" src="<?=base_url((isset($dUser['admin']))?('assets/images/author/'.$dUser['foto']):('assets/images/users/'.$dUser['foto']));?>" alt="avatar">
                  <?=ucwords($dUser['nama']);?>
                  <i class="fa fa-angle-down"></i>
                </h4>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="<?=base_url('home/profile');?>"><i class="icon-user"></i> My Profile</a>
                  <a class="dropdown-item" href="javascript:void(0);" id="aLogout"><i class="icon-sign-out"></i> Log Out</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- page title area end -->
        <div class="main-content-inner">
          <div class="row">
            <div class="col-12">
              <!-- Isinya -->
<script>
  $(document).ready(function(){
    $('#aLogout').click(function(){
      Swal.fire({
        title: 'Anda yakin?',
        text: "Anda harus login kembali untuk membuka aplikasi.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Tidak',
        confirmButtonText: 'Yakin!'
      }).then((result) => {
        if (result.value) {
          window.location = "<?=base_url('auth/logout');?>";
        }
      })
    })
  })
</script>

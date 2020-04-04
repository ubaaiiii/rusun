<?php
    $setting = $this->db->get_where('setting', ['id' => 1])->row_array();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Booking Kamar di <?= $setting['nama']; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="shortcut icon" href="<?= base_url('assets/images/icon/') ?>villa.png">

		<link rel="stylesheet" href="<?= base_url('assets/home/') ?>fonts/google.css">

    <link rel="stylesheet" href="<?= base_url('assets/home/') ?>css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/home/') ?>css/animate.css">

		<link rel="stylesheet" href="<?= base_url('assets/home/') ?>fonts/flaticon/font/flaticon.css">
		<link rel="stylesheet" href="<?= base_url('assets/home/') ?>css/icomoon.css">
		<link rel="stylesheet" href="<?= base_url('assets/home/') ?>css/style.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/home/') ?>css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/home/') ?>css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/home/') ?>css/magnific-popup.css">

    <link rel="stylesheet" href="<?= base_url('assets/home/') ?>css/aos.css">

    <link rel="stylesheet" href="<?= base_url('assets/home/') ?>css/ionicons.min.css">
    <script src="<?= base_url('assets/home/') ?>js/jquery.min.js"></script>

		<style>
		h4
		{
		 position: relative;
		 width: 100%;
		 font-size: 1.5em;
		 font-weight: bold;
		 padding: 6px 20px 6px 70px;
		 margin: 30px -50px 10px -35px;
		 color: #555;
		 background-color: #999;
		 text-shadow: 0px 1px 2px #bbb;
		 -webkit-box-shadow: 0px 2px 4px #888;
		 -moz-box-shadow: 0px 2px 4px #888;
		 box-shadow: 0px 2px 4px #888;
		}
		</style>
    <script>
      var base_url = '<?=base_url();?>';
    </script>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a href="#" class="navbar-brand nav-link" data-nav-section="home"><span><?= $setting['nama'] ?></span></a>
	      <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav nav ml-auto">
	          <li class="nav-item"><a href="#" class="nav-link" data-nav-section="home"><span>Home</span></a></li>
	          <li class="nav-item"><a href="#" id="about" class="nav-link" data-nav-section="about"><span>About</span></a></li>
	          <li class="nav-item"><a href="#" class="nav-link" data-nav-section="projects"><span>Gallery</span></a></li>
	          <li class="nav-item"><a href="#" class="nav-link" data-nav-section="blog"><span>Booking</span></a></li>
	          <li class="nav-item"><a href="#" class="nav-link" data-nav-section="contact"><span>Contact</span></a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>

    <section class="hero-wrap js-fullheight" style="background-image: url('<?= base_url('assets/home/') ?>images/bg_1.jpg');" data-section="home">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
          <div class="col-md-8 ftco-animate mt-5" data-scrollax=" properties: { translateY: '70%' }">
            <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Booking Rusun</h1>
            <p class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Dengan Cara mudah, cepat, dan Murah</p>
          </div>
        </div>
      </div>
    </section>

		<section class="ftco-section ftco-services ftco-no-pt">
      <div class="container">
        <div class="row services-section">
          <div class="col-md-4 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services text-center d-block">
              <div class="icon"><span class="icon-bookmark-o"></span></div>
              <div class="media-body">
                <h3 class="heading mb-3">Booking Cepat</h3>
                <p>Anda tidak perlu menunggu Waktu yang lama untuk Booking kamar</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services text-center d-block">
              <div class="icon"><span class="icon-attach_money"></span></div>
              <div class="media-body">
                <h3 class="heading mb-3">Harga Murah</h3>
                <p>Tidak perlu untuk menghabiskan kantong dompet anda</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services text-center d-block">
              <div class="icon"><span class="oi oi-action-undo"></span></div>
              <div class="media-body">
                <h3 class="heading mb-3">Cepat Dan Mudah</h3>
                <p>Anda dapat mencari Kamar yang cocok dengan selera anda dengan cepat</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-counter img ftco-section ftco-no-pt ftco-no-pb" id="section-counter" data-section="about">
    	<div class="container">
    		<div class="row d-flex">
    			<div class="col-md-6 col-lg-4 d-flex">
    				<div class="img d-flex align-self-stretch align-items-center" style="background-image:url(<?= base_url('assets/home/') ?>images/about.jpg);">
    					<div class="request-quote py-5">
								<?php
                    if ($login=="belum") {
                        ?>
								<div class="py-2">
	    						<span class="subheading">Jadi Bagian Rusunawa BPJS</span>
	    						<h3>Daftarkan Diri Anda</h3>
	    					</div>
	    					<form id="landing-daftar" class="request-form ftco-animate" method="post" autocomplete="off">
			    				<div class="form-group">
			    					<input type="number" class="form-control" name="nik" placeholder="Nomor Induk KTP" required>
			    				</div>
			    				<div class="form-group">
			    					<input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" style="text-transform: capitalize;" required>
			    				</div>
			    				<div class="form-group">
			    					<input type="email" class="form-control" name="email" placeholder="Alamat Email" required>
			    				</div>
			    				<div class="form-group">
			    					<input type="password" class="form-control" name="password" placeholder="Password" required>
			    				</div>
			    				<div class="form-group">
			    					<input type="number" class="form-control" name="no_telp" placeholder="Nomor Telepon (+62)" required>
			    				</div>
			    				<div class="form-group">
			    					<label><input type="radio" class="" placeholder="" name="gender" id="gender" value="1" required> Laki-Laki</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			    					<label><input type="radio" class="" placeholder="" name="gender" id="gender" value="2" required> Perempuan</label>
			    				</div>
		    					<div class="form-group">
			              <textarea name="alamat" id="" cols="30" rows="2" class="form-control" name="alamat" placeholder="Alamat" required></textarea>
			            </div>
			            <div class="form-group">
			              <button type="submit" id="landing-submit" class="btn btn-secondary py-3 px-4"><i class="icon-edit"></i> Daftar!</button>
			              &nbsp;<br><a class="float-right btn btn-secondary" href="<?=base_url('auth'); ?>">Sudah punya akun? Masuk <i class="icon-user"></i></a>
			            </div>
			    			</form>
							<?php
                    } else { ?>
							<a class=" float-right btn btn-warning" href="<?=base_url('home'); ?>"><i class="icon-dashboard2"></i> Halaman Dashboard</a>
						<?php } ?>
							</div>
    				</div>
    			</div>
    			<div class="col-md-6 col-lg-8 pl-lg-5 py-5">
    				<div class="row justify-content-start pb-3">
		          <div class="col-md-12 heading-section ftco-animate">
		          	<span class="subheading">Selamat Datang di</span>
		            <h2 class="mb-4"><?= $setting['nama'] ?></h2>
		            <p><?= $setting['deskripsi'] ?></p>
                <a href="javascript.void(0);" data-toggle="modal" data-target="#exampleModal">Baca Syarat & Ketentuan Menghuni</a>
		          </div>
		        </div>
		    		<div class="row">
		          <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate d-flex">
		            <div class="block-18 text-center p-4 mb-4 align-self-stretch d-flex">
		              <div class="text">
		                <strong class="number" data-number="<?php echo $laki; ?>">0</strong>
		                <span>Penghuni Laki-Laki</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate d-flex">
		            <div class="block-18 text-center py-4 px-3 mb-4 align-self-stretch d-flex">
		              <div class="text">
										<strong class="number" data-number="<?php echo $cewe; ?>">0</strong>
		                <span>Penghuni Perempuan</span>
		              </div>
		            </div>
		          </div>
		        </div>
	        </div>
        </div>
    	</div>
    </section>

    <section class="ftco-section ftco-project bg-light" data-section="projects">
    	<div class="container-fluid px-md-5">
    		<div class="row justify-content-center pb-5">
          <div class="col-md-12 heading-section text-center ftco-animate">
          	<span class="subheading">Gallery</span>
            <h2 class="mb-4">Gallery Photo</h2>
          </div>
        </div>
    		<div class="row">
					<div class="col-md-12 testimonial">
            <div class="carousel-project owl-carousel">

							<?php foreach ($gallery as $key) { ?>
								<div class="item">
	            		<div class="project">
			    					<div class="img">
					    				<img src="<?= base_url('assets/images/gallery/'.$key['foto']) ?>" class="img-fluid" alt="Colorlib Template">
					    				<a href="<?= base_url('assets/images/gallery/'.$key['foto']) ?>" class="icon image-popup d-flex justify-content-center align-items-center">
					    					<span class="icon-expand"></span>
					    				</a>
				    				</div>
				    				<div class="text px-4">
				    					<h3><a href="#"><?=$key['deskripsi']?></a></h3>
				    					<span>Rusunawa BPJS</span>
				    				</div>
			    				</div>
	            	</div>
							<?php } ?>
<!--
					<div class="col-md-3">
            <div class="media block-6 services text-center d-block">
              <div class="icon">
								<a href="<?= base_url('assets/img/'.$key['foto']) ?>" class="icon image-popup d-flex"> <img src="<?= base_url('assets/img/'.$key['foto']) ?>" class="img-fluid" alt="Colorlib Template"></a>
							</div>
              <div class="media-body">
                <h3 class="heading mb-3"><?=$key['deskripsi']?></h3>
              </div>
            </div>
          </div> -->

    		</div>
    	</div>
    </section>

    <section class="ftco-section bg-light" data-section="blog">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-5">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <span class="subheading">Booking</span>
            <h2 class="mb-4">Booking Kamar</h2>
            <p>Kami Menyediakan Booking Kamar khusus Laki-Laki dan Perempuan</p>
          </div>
        </div>
				<div class="row d-flex" id="booking-laki">

					<?php for ($i=1; $i <= $juml_lantai; $i++) { ?>
	          <div class="col-md-3 d-flex ftco-animate">
	            <div class="blog-entry justify-content-end">
	              <a href="<?=base_url('home/booking');?>" class="block-20" style="background-image: url('assets/img/kamar-cowo.jpg');"></a>
	              <div class="text mt-3 float-right d-block">
                  <i class="fa fa-ban text-danger" style="position: absolute;top: 18%;left: 21%;font-size:10em;<?=($kCowokL[$i]=='0')?(''):('display:none;');?>"></i>
	                <h3 class="heading">
	                  <a href="<?=base_url('home/booking');?>">Lantai <?=$i;?></a>
	                </h3>
                  <?php
                    if($kCowokL[$i]!=0){
                  ?>
  	                <p>Kamar di lantai ini kami beri harga:<br><?=$hCowokL[$i];?></p>
                  <?php } else { ?>
                    <p>Mohon maaf kamar di lantai ini sedang tidak tersedia<br>&nbsp;</p>
                  <?php } ?>
	                <div class="d-flex align-items-center mt-4 meta">
	                  <p class="mb-0">
											<?php
                          if ($kCowokL[$i]!=0) {
                              echo '<a href="'.base_url('home/booking').'" class="btn btn-secondary">Sisa Kamar : '.$kCowokL[$i].'</a>';
                          } else {
                              echo '<button type="button" class="btn btn-warning mb-3" disabled="">Sisa Kamar : 0</button>';
                          }
                      ?>
	                  </p>
	                  <p class="ml-auto mb-0">
	                    <a class="mr-2">Laki-Laki
	                    <a class="meta-chat">
	                      <span data-toggle="popover" data-placement="top" data-content="Penghuni"><i class="icon-users"></i></span>
	                      <?=$pCowokL[$i];?></a>
	                  </p>
	                </div>
	              </div>
	            </div>
	          </div>
					<?php } ?>

				</div>

				<div class="row d-flex" id="booking-perempuan">

					<?php for ($i=1; $i <= $juml_lantai; $i++) { ?>
	          <div class="col-md-3 d-flex ftco-animate">
	            <div class="blog-entry justify-content-end">
	              <a href="<?=base_url('auth');?>" class="block-20" style="background-image: url('assets/img/kamar-cewe.jpeg');"></a>
	              <div class="text mt-3 float-right d-block">
                  <i class="fa fa-ban text-danger" style="position: absolute;top: 18%;left: 21%;font-size:10em;<?=($kCewekL[$i]=='0')?(''):('display:none;');?>"></i>
	                <h3 class="heading">
	                  <a href="<?=base_url('auth');?>">Lantai <?=$i;?></a>
	                </h3>
                  <?php
                    if($kCewekL[$i]!=0){
                  ?>
  	                <p>Kamar di lantai ini kami beri harga:<br><?=$hCewekL[$i];?></p>
                  <?php } else { ?>
                    <p>Mohon maaf kamar di lantai ini sedang tidak tersedia<br>&nbsp;</p>
                  <?php } ?>
	                <div class="d-flex align-items-center mt-4 meta">
	                  <p class="mb-0">
	                    <a <?=($kCewekL[$i]!=0)?('href='.base_url('home/booking')):('');?> class="btn btn-secondary">Sisa Kamar : <?= $kCewekL[$i]; ?></a>
	                  </p>
	                  <p class="ml-auto mb-0">
	                    <a class="mr-2">Perempuan
	                    <a class="meta-chat">
	                      <span data-toggle="popover" data-placement="top" data-content="Penghuni"><i class="icon-users"></i></span>
	                      <?=$pCewekL[$i];?></a>
	                  </p>
	                </div>
	              </div>
	            </div>
	          </div>
					<?php } ?>

				</div>

      </div>
    </section>

    <section class="ftco-section contact-section ftco-no-pb" data-section="contact">
      <div class="container">
      	<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <span class="subheading">Contact</span>
            <h2 class="mb-4">Hubungi Kami</h2>
          </div>
        </div>
        <div class="row no-gutters block-9">
          <div class="col-md-6 order-md-last d-flex">
            <fieldset id="field-pesan">
            <form class="bg-light p-5 contact-form" id="form-pesan">
              <div class="form-group">
                <input type="text" name="nama" class="form-control text-capitalize" placeholder="Nama" required>
              </div>
              <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
              </div>
              <div class="form-group">
                <input type="text" name="judul" class="form-control text-capitalize" placeholder="Judul" required>
              </div>
              <div class="form-group">
                <textarea name="pesan" id="" cols="30" rows="7" class="form-control" placeholder="Pesan" required></textarea>
              </div>
              <div class="form-group">
                <input type="submit" value="Kirim Pesan" class="btn btn-secondary py-3 px-5">
              </div>
            </form>
          </fieldset>
            <script>
              $(document).ready(function(){
                $('#form-pesan').submit(function(e){
                  e.preventDefault();
                  var dataPesan = $(this).serialize();
                  $('#field-pesan').prop('disabled','true');
                  $.ajax({
                    url: "<?=base_url('pesan/simpan');?>",
                    data: dataPesan,
                    type: "post",
                    success: function(data) {
                      if (data=="true") {
                        $('#field-pesan').prop('disabled',false);
                        $(':input','#form-pesan')
                        .not(':button, :submit, :reset, :hidden')
                        .val('');
                        Swal.fire(
                          'Success!',
                          'Terima kasih telah menghubungi kami.',
                          'success'
                        )
                      }
                    }
                  })
                })
              })
            </script>

          </div>

          <div class="col-md-6 d-flex">
          	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3302.7940866947383!2d107.16288255052795!3d-6.302955258652154!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e699b3b8774791d%3A0xabdc149ae228469c!2sRumah%20Susun%20Sewa%20BPJS%20Ketenagakerjaan!5e0!3m2!1sid!2sid!4v1581442345512!5m2!1sid!2sid" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section contact-section">
      <div class="container">
        <div class="row d-flex contact-info">
          <div class="col-md-6 col-lg-4 d-flex">
          	<div class="align-self-stretch box p-4 text-center">
          		<div class="icon d-flex align-items-center justify-content-center">
          			<span class="icon-map-signs"></span>
          		</div>
          		<h3 class="mb-4">Alamat</h3>
	            <p><a target="_blank" href="http://maps.google.com/maps?q=<?=str_replace(" ", "+", $setting['alamat']);?>">
								<?= $setting['alamat'] ?></a></p>
	          </div>
          </div>
          <div class="col-md-6 col-lg-4 d-flex">
          	<div class="align-self-stretch box p-4 text-center">
          		<div class="icon d-flex align-items-center justify-content-center">
          			<span class="icon-phone2"></span>
          		</div>
          		<h3 class="mb-4">Nomor Telepon</h3>
	            <p><a href="tel://<?= $setting['no_telp'] ?>"><?= $setting['no_telp'] ?></a></p>
	          </div>
          </div>
          <div class="col-md-6 col-lg-4 d-flex">
          	<div class="align-self-stretch box p-4 text-center">
          		<div class="icon d-flex align-items-center justify-content-center">
          			<span class="icon-paper-plane"></span>
          		</div>
          		<h3 class="mb-4">Alamat Email</h3>
	            <p><a href="mailto:<?= $setting['email'] ?>"><?= $setting['email'] ?></a></p>
	          </div>
          </div>

        </div>
      </div>
    </section>

    <footer class="ftco-footer ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">

            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						  Copyright &copy;<?=date('Y');?> All rights reserved | This template is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="<?= base_url(); ?>" target="_blank"><?= $setting['nama'] ?></a>
						</p>
          </div>
        </div>
      </div>
    </footer>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Syarat & Ketentuan Menghuni</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="color:black;">
            Syarat:
            <ol>
              <li>Berkewarganegaraan Indonesia.</li>
              <li>Memiliki Kartu Identitas (KTP, Kartu Pelajar, dll).</li>
              <li>Membayar biaya sewa sebelum lewat 1 jam setelah booking.</li>
            </ol>
            Ketentuan:
            <ol>
              <li>Maksimal penghuni perkamar adalah 4 orang</li>
              <li>Harga sewa tidak termasuk Listrik dan PDAM</li>
              <li>Bertamu:
                <ul style="list-style-type:square;">
                  <li>Tempat menerima tamu dilakukan di ruang tamu atau teras, kecuali keluarga (disertai KK).</li>
                  <li>Teman lawan jenis dilarang masuk ke kamar.</li>
                  <li>Batas waktu menerima tamu pukul 21:00.</li>
                </ul>
              </li>
              <li>Jam 24:00 pagar rusun ditutup, untuk yang bekerja hingga larut bisa meminta salinan kunci pagar dengan kewajiban menjaga keamanan, kenyamanan, dan ketertiban rusun.</li>
              <li>Hilangnya barang atas kecerobohan atau kecelakaan bukan tanggung jawab Rusunawa.</li>
            </ol>
          </div>
          <div class="modal-footer">

          </div>
        </div>
      </div>
    </div>



  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

  <script src="<?=base_url();?>assets/js/sweetalert2.js"></script>
  <script src="<?= base_url('assets/home/') ?>js/jquery-migrate-3.0.1.min.js"></script>
  <script src="<?= base_url('assets/home/') ?>js/popper.min.js"></script>
  <script src="<?= base_url('assets/home/') ?>js/bootstrap.min.js"></script>
  <script src="<?= base_url('assets/home/') ?>js/jquery.easing.1.3.js"></script>
  <script src="<?= base_url('assets/home/') ?>js/jquery.waypoints.min.js"></script>
  <script src="<?= base_url('assets/home/') ?>js/jquery.stellar.min.js"></script>
  <script src="<?= base_url('assets/home/') ?>js/owl.carousel.min.js"></script>
  <script src="<?= base_url('assets/home/') ?>js/jquery.magnific-popup.min.js"></script>
  <script src="<?= base_url('assets/home/') ?>js/aos.js"></script>
  <script src="<?= base_url('assets/home/') ?>js/jquery.animateNumber.min.js"></script>
  <script src="<?= base_url('assets/home/') ?>js/scrollax.min.js"></script>
  <script src="<?= base_url('assets/home/') ?>js/main.js"></script>
  <script src="<?= base_url('assets/js/proses/') ?>landing-daftar.js"></script>
	<script>
		$(document).ready(function(){
      if(window.location.href.split('?').pop() == 'Daftar') {
        $('#about').click();
      }
      $('[data-toggle="popover"]').popover();

      <?php
        if (isset($dUser['nik'])) {
          if ($dUser['gender']==1) {
            echo "$('#booking-perempuan').empty();";
          } else {
            echo "$('#booking-laki').empty();";
          }
        }
      ?>
		});
	</script>
  </body>
</html>

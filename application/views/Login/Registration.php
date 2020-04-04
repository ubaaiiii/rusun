<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- login area start -->
    <div class="login-area login-s2">
        <div class="container">
            <div class="login-box ptb--100">
                <form id="landing-daftar">
                    <div class="login-form-head">
                        <h4>Pendaftaran</h4>
                        <p>Silahkan mendaftar untuk Login Aplikasi</p>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="exampleInputName1">Nomor Induk KTP</label>
                            <input required type="number" id="exampleInputName1" name="nik">
                            <i class="icon-vcard"></i>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputName1">Nama Lengkap</label>
                            <input required type="text" id="exampleInputName1" name="nama">
                            <i class="ti-user"></i>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputEmail1">Alamat Email</label>
                            <input required type="email" id="exampleInputEmail1" name="email">
                            <i class="ti-email"></i>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Password</label>
                            <input required type="password" id="exampleInputPassword1" name="password">
                            <i class="ti-lock"></i>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputNumber1">Nomor Telepon</label>
                            <input required type="number" id="exampleInputNumber1" name="no_telp">
                            <i class="icon-phone2"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadio4" name="gender" class="custom-control-input" value="1">
                                <label class="custom-control-label" for="customRadio4">Laki-Laki <i class="icon-male"></i></label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadio5" name="gender" class="custom-control-input" value="2">
                                <label class="custom-control-label" for="customRadio5">Perempuan <i class="icon-female"></i></label>
                            </div>
                            <div>&nbsp;</div><hr>
                        </div>
                        <div class="form-gp">
                          <label for="alamat">Alamat</label>
                          <textarea id="alamat" class="form-control" aria-label="With textarea" name="alamat"></textarea>
                          <i class="icon-home2"></i>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">Daftar <i class="ti-arrow-right"></i></button>
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">Sudah punya akun? <a href="<?=base_url();?>auth/login">Masuk!</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->

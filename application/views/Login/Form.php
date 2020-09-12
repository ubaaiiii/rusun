<body>
  <!--[if lt IE 8]> <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p> <![endif]-->
  <!-- preloader area start -->
  <div id="preloader">
    <div class="loader"></div>
  </div>
  <!-- preloader area end -->
  <!-- login area start -->
  <div class="login-area login-s2">
    <div class="container">
      <div class="login-box ptb--100">
          <form id="form-masuk" autocomplete="off">
            <?php
              if ($errcode=="salah") {
                  echo '<div class="alert alert-danger" role="alert" >
                    <strong>Maaf!</strong> Email dan Password salah.
                  </div>';
              }
            ?>
            <div class="login-form-head">
              <h4>Masuk</h4>
              <p>Masukkan Email dan Password untuk melanjutkan ke aplikasi</p>
            </div>
            <div class="login-form-body">
              <div class="form-gp">
                <label for="exampleInputEmail1">Alamat Email</label>
                <input type="email" id="exampleInputEmail1" name="email" required="required">
                <i class="ti-email"></i>
              </div>
              <div class="form-gp">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" id="exampleInputPassword1" name="password" required="required">
                <i class="ti-lock"></i>
              </div>
              <div class="row mb-4 rmber-area">
                <div class="col-6">
                  <a href="<?=base_url();?>">Rusunawa</a>
                </div>
                <!-- <div class="col-6 text-right">
                  <a href="<?=base_url();?>auth/forgot">Lupa Password?</a>
                </div> -->
              </div>
              <div class="submit-btn-area">
                <button id="form_submit" type="submit">Masuk
                  <i class="ti-arrow-right"></i>
                </button>
              </div>
              <div class="form-footer text-center mt-5">
                <p class="text-muted">Belum punya akun?
                  <a id="daftar" href="<?=base_url('?Daftar');?>">Daftar!</a>
                </p>
              </div>
            </div>
          </form>
      </div>
    </div>
  </div>
  <!-- login area end -->

<script>
  $(document).ready(function() {
    $('#form-masuk').submit(function(e) {
      e.preventDefault();
      var dataForm = $('#form-masuk').serialize();
      $('#form-masuk :input').prop('disabled', true);
      $('#form-masuk button').prop('disabled', true);
      $('#form-masuk a').prop('disabled', true);
      $.ajax({
        url: "<?=base_url('auth/cek_login');?>",
        type: "post",
        data: dataForm,
        success: function(data) {
          data = JSON.parse(data);
          console.log(data);
          if(data!=="berhasil"){
            $('#form-masuk :input').prop('disabled', false);
            $('#form-masuk button').prop('disabled', false);
            $('#form-masuk a').prop('disabled', false);
            $('#exampleInputEmail1').focus();
            swal.fire({
              title: "Error!",
              text: "Email dan Password tidak sesuai",
              icon: "warning",
            })
          } else {
            swal.fire({
              title: "Success!",
              text: "Redirecting to Dashboard...",
              icon: "success",
              showConfirmButton: false,
              timer: 1000
            }).then(function() {
              window.location = "<?=base_url('home');?>";
            });

            // setTimeout(function() {
            //   Swal.fire({
            //     position: 'top-end',
            //     icon: 'success',
            //     title: 'Redirecting to Dashboard',
            //     showConfirmButton: false,
            //     timer: 1500
            //   }).then(function() {
            //         window.location = "home";
            //       }),
            // }, 250);
          }
        }
      })
    })

    $('#daftar').click(function(){
      setTimeout(function(){ $('#about').click(); }, 1500);
      window.location.href = '<?=base_url();?>';
    })
  })
</script>

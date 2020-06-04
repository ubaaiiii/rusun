<style>
.btn-file{position:relative;overflow:hidden}.btn-file input[type=file]{position:absolute;top:0;right:0;min-width:100%;min-height:100%;font-size:100px;text-align:right;opacity:0;outline:0;background:#fff;cursor:inherit;display:block}#img-upload{width:100%}@keyframes blink {50% { color: transparent }}
.loader__dot { animation: 1s blink infinite }
.loader__dot:nth-child(2) { animation-delay: 300ms }
.loader__dot:nth-child(3) { animation-delay: 700ms }
</style>
<script>
function togglePassword() {
  var x = document.getElementById('password');
  if (x.type === "password") {
    x.type = "text";
    $('#eye').removeClass('fa-eye');
    $('#eye').addClass('fa-eye-slash');
  } else {
    x.type = "password";
    $('#eye').removeClass('fa-eye-slash');
    $('#eye').addClass('fa-eye');
  }
}
</script>
<?php
if (isset($user)) {
  if (isset($user['admin'])) {
    echo "<script>
    $(document).ready(function(){
      $('div#form-admin').addClass('active show');
      $('div#form-user').removeClass('active show');
      $('#form-admin-tab').addClass('active show');
      $('#form-user-tab').removeClass('active show');
      $('#form-user-tab').css('display','none');
      $('#admin-submit').html('Update');
      $('#id').val('".$user['id']."');
      $('#nama').val('".$user['nama']."');
      $('#nama').attr('placeholder','".$user['nama']."');
      $('#email').val('".$user['email']."');
      $('#email').attr('placeholder','".$user['email']."');
      $('#no_telp').val('".$user['no_telp']."');
      $('#no_telp').attr('placeholder','".$user['no_telp']."');
      $('#judulModal').html('Edit Admin');
    });
    </script>";
  } else {
    ($user['gender']==1)?($gender="Laki-laki"):($gender="Perempuan");
    echo "<script>
    $(document).ready(function(){
      $('div#form-user').addClass('active show');
      $('div#form-admin').removeClass('active show');
      $('#form-user-tab').addClass('active show');
      $('#form-admin-tab').removeClass('active show');
      $('#form-admin-tab').css('display','none');
      $('#user-submit').html('Update');
      $('#judulModal').html('Edit User');
      $('#id-user').val('".$user['nik']."');
      $('#nik').val('".$user['nik']."');
      $('#nik').attr('placeholder','".$user['nik']."');
      $('#nama-user').val('".$user['nama']."');
      $('#nama-user').attr('placeholder','".$user['nama']."');
      $('#no_telp-user').val('".$user['no_telp']."');
      $('#no_telp-user').attr('placeholder','".$user['no_telp']."');
      $('#email-user').val('".$user['email']."');
      $('#email-user').attr('placeholder','".$user['email']."');
      $('#alamat-user').val('".$user['alamat']."');
      $('#alamat-user').attr('placeholder','".$user['alamat']."');
      $('#L').css('display',none);
      $('#P').css('display',none);
      $('#lbl-gender').append('".$gender."');
    });
    </script>";
  }
} else {
  echo "<script>
  $(document).ready(function(){
    if ($('#admin').hasClass('active show')) {
      $('div#form-admin').addClass('active show');
      $('div#form-user').removeClass('active show');
      $('#form-admin-tab').addClass('active show');
      $('#form-user-tab').removeClass('active show');
    } else {
      $('#L').removeAttr('style');
      $('#P').removeAttr('style');
      $('div#form-user').addClass('active show');
      $('div#form-admin').removeClass('active show');
      $('#form-user-tab').addClass('active show');
      $('#form-admin-tab').removeClass('active show');
    }
  });
</script>";
}
?>

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link" id="form-admin-tab" data-toggle="tab" href="#form-admin" role="tab" aria-controls="form-admin" aria-selected="true">Admin</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active show" id="form-user-tab" data-toggle="tab" href="#form-user" role="tab" aria-controls="form-user" aria-selected="false">User</a>
  </li>
</ul>
<div class="tab-content mt-3" id="myTabContent">
  <div class="tab-pane fade" id="form-admin" role="tabpanel" aria-labelledby="form-admin-tab">
    <div class="card">
      <div class="card-body">
        <fieldset id="admin-field">
          <form id="admin-form">
            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="validationCustom01">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" style="text-transform: capitalize;" placeholder="Nama Lengkap" required="">
                <input type="text" class="form-control" id="id" name="id" hidden>
              </div>
              <div class="col-md-6 mb-3">
                <label for="validationCustom02">Nomor Telepon</label>
                <input type="number" class="form-control" id="no_telp" name="no_telp" placeholder="Nomor Handphone" required="">
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-<?=(!isset($user))?('6'):('12');?> mb-3">
                <label for="validationCustom03">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email@domain.com" required="">
              </div>
              <?php
              if (!isset($user)) {
                ?>
                <div class="col-md-6 mb-3">
                  <label for="validationCustom02">Password</label>
                  <div class="input-group">
                    <input type="password" id="password" name="password" required class="form-control">
                    <div class="input-group-append" style="cursor:pointer;">
                      <div class="input-group-text" onclick="togglePassword()"><i id="eye" class="fa fa-eye"></i></div>
                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
            <div class="form-group">
              <div class="form-check">
                <label class="form-check-label" for="invalidCheck">
                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required="">
                  Setuju bahwa data yang diisi sudah benar.
                </label>
              </div>
            </div>
            <button id="admin-submit" class="btn btn-primary" type="submit">Simpan</button>
          </form>
        </fieldset>
        <script>
        $(document).ready(function(){
          $('#admin-form').submit(function(e){
            e.preventDefault();
            var datanya = $(this).serialize();
            // console.log(datanya);
            <?=(!isset($user))?('var tipe = "simpan";'):('var tipe = "edit";');?>
            $('#admin-field').prop('disabled',true);
            $("#admin-submit").html('<i class="fa fa-spinner fa-pulse"></i> Updating <span class="loader__dot">. </span><span class="loader__dot">. </span><span class="loader__dot">.</span>');
            $.ajax({
              url: "<?=base_url('users/proses/admin/');?>"+tipe,
              data: datanya,
              type: "post",
              success: function(data) {
                console.log(data);
                if (data=="saved") {
                  $("#modalSmall").modal('hide');
                  $('#admin-refresh').click();
                  swal.fire({
                    title: "Success!",
                    text: "Berhasil Menambah Admin Baru.",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1000
                  });
                } else if (data=="edited") {
                  $("#modalSmall").modal('hide');
                  $('#admin-refresh').click();
                  swal.fire({
                    title: "Success!",
                    text: "Berhasil Mengubah Data Admin.",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1000
                  });
                } else if (data=="email_exists") {
                  $('#admin-field').prop('disabled',false);
                  $('#admin-submit').html('Update');
                  $('#email').focus();
                  swal.fire({
                    title: "Data Sudah Ada!",
                    text: "Email Yang Dimasukkan Telah Terdaftar.",
                    icon: "error"
                  });
                } else if (data=="telp_exists") {
                  $('#admin-field').prop('disabled',false);
                  $('#admin-submit').html('Update');
                  $('#no_telp').focus();
                  swal.fire({
                    title: "Data Sudah Ada!",
                    text: "Nomor Telepon Yang Dimasukkan Telah Terdaftar.",
                    icon: "error"
                  });
                } else {
                  $('#admin-field').prop('disabled',false);
                  $('#admin-submit').html('Update');
                  swal.fire({
                    title: "Gagal!",
                    text: "Gagal Memproses Data Admin.",
                    icon: "error"
                  });
                }
              }
            })
          })
        })
        </script>
      </div>
    </div>
  </div>
  <div class="tab-pane fade active show" id="form-user" role="tabpanel" aria-labelledby="form-user-tab">
    <div class="card">
      <div class="card-body">
        <fieldset id="user-field">
          <form id="user-form" data-toggle="validator" role="form">
            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="validationCustom02">NIK</label>
                <input type="number" class="form-control" id="nik" name="nik" placeholder="Nomor Induk Kependudu.." required="">
              </div>
              <div class="col-md-6 mb-3">
                <label for="validationCustom01">Nama</label>
                <input type="text" class="form-control" id="nama-user" style="text-transform: capitalize;" name="nama" placeholder="Nama Lengkap" required="">
                <input type="text" class="form-control" id="id-user" name="id" hidden>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="validationCustom02">Nomor Telepon</label>
                <input type="number" class="form-control" id="no_telp-user" name="no_telp" placeholder="Nomor Telepon" required="">
              </div>
              <div class="col-md-6 mb-3">
                <label for="validationCustom03">Alamat Email</label>
                <input type="email" class="form-control" id="email-user" name="email" placeholder="Email@domain.com" required="">
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-<?=(isset($user))?('12'):('6');?> mb-3">
                <label for="gender">Jenis Kelamin</label>
                <div class="custom-control custom-radio">
                  <input type="radio" id="L" value="1" required name="gender" class="custom-control-input">
                  <label class="custom-control-label" for="L">Laki - Laki</label>
                </div>
                <div class="custom-control custom-radio">
                  <input type="radio" id="P" value="2" required name="gender" class="custom-control-input">
                  <label class="custom-control-label" for="P">Perempuan</label>
                </div>
              </div>
              <?php
              if (!isset($user)) {
                ?>
                <div class="col-md-6 mb-3">
                  <label for="validationCustom02">Password</label>
                  <div class="input-group">
                    <input type="password" id="password" name="password" required class="form-control">
                    <div class="input-group-append" style="cursor:pointer;">
                      <div class="input-group-text" onclick="togglePassword()"><i id="eye" class="fa fa-eye"></i></div>
                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
            <div class="form-group">
              <label>Alamat :
              </label>
              <textarea name="alamat" id="alamat-user" class="form-control" required=""></textarea>
            </div>
            <div class="form-group">
              <div class="form-check">
                <label class="form-check-label" for="invalidCheck">
                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required="">
                  Setuju bahwa data yang diisi sudah benar.
                </label>
              </div>
            </div>
            <button id="user-submit" class="btn btn-primary" type="submit">Simpan</button>
          </form>
        </fieldset>
        <script>
        $(document).ready(function(){
          $('#user-form').submit(function(e){
            e.preventDefault();
            var datanya = $(this).serialize();
            console.log(datanya);
            <?=(!isset($user))?('var tipe = "simpan";'):('var tipe = "edit";');?>
            console.log("<?=base_url('users/proses/user/');?>"+tipe);
            $('#user-field').prop('disabled',true);
            $("#user-submit").html('<i class="fa fa-spinner fa-pulse"></i> Updating <span class="loader__dot">. </span><span class="loader__dot">. </span><span class="loader__dot">.</span>');
            $.ajax({
              url: "<?=base_url('users/proses/user/');?>"+tipe,
              data: datanya,
              type: "post",
              success: function(data) {
                console.log(data);
                if (data=="saved") {
                  $("#modalSmall").modal('hide');
                  $('#user-refresh').click();
                  swal.fire({
                    title: "Success!",
                    text: "Berhasil Menambah User Baru.",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1000
                  });
                } else if (data=="edited") {
                  $("#modalSmall").modal('hide');
                  $('#user-refresh').click();
                  swal.fire({
                    title: "Success!",
                    text: "Berhasil Mengubah Data User.",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1000
                  });
                } else if (data=="nik_exists") {
                  $('#user-field').prop('disabled',false);
                  $('#user-submit').html('Update');
                  $('#nik').focus();
                  swal.fire({
                    title: "Data Sudah Ada!",
                    text: "Nomor Induk Kependudukan Yang Dimasukkan Telah Terdaftar.",
                    icon: "error"
                  });
                } else if (data=="email_exists") {
                  $('#user-field').prop('disabled',false);
                  $('#user-submit').html('Update');
                  $('#email').focus();
                  swal.fire({
                    title: "Data Sudah Ada!",
                    text: "Email Yang Dimasukkan Telah Terdaftar.",
                    icon: "error"
                  });
                } else if (data=="telp_exists") {
                  $('#user-field').prop('disabled',false);
                  $('#user-submit').html('Update');
                  $('#no_telp').focus();
                  swal.fire({
                    title: "Data Sudah Ada!",
                    text: "Nomor Telepon Yang Dimasukkan Telah Terdaftar.",
                    icon: "error"
                  });
                } else {
                  $('#user-field').prop('disabled',false);
                  $('#user-submit').html('Update');
                  swal.fire({
                    title: "Gagal!",
                    text: "Gagal Memproses Data user.",
                    icon: "error"
                  });
                }
              }
            })
          })
        })
        </script>
        </div>
      </div>
    </div>
  </div>

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
      // $('div#form-admin').addClass('active show');
      // $('div#form-user').removeClass('active show');
      // $('#form-admin-tab').addClass('active show');
      // $('#form-user-tab').removeClass('active show');
      // $('#form-user-tab').css('display','none');
      // $('#submit-admin').html('Update');
      // $('div#hideID').append('<input type=\"text\" class=\"form-control\" name=\"id\" id=\"id\" hidden>');
      // $('#id').val('".$user['id']."');
      // $('#nama').val('".$user['nama']."');
      // $('#email').val('".$user['email']."');
      // $('#notelp').val('".$user['no_telp']."');
      // $('#judulModal').html('Edit Admin');
    });
    </script>";
  } else {
    echo "<script>
    $(document).ready(function(){
      $('div#form-user').addClass('active show');
      $('div#form-admin').removeClass('active show');
      $('#form-user-tab').addClass('active show');
      $('#form-admin-tab').removeClass('active show');
      $('#form-admin-tab').css('display','none');
      $('#submit-user').html('Update');
      $('#judulModal').html('Edit User');
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
        <form data-toggle="validator" role="form">
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="validationCustom01">First name</label>
                    <input type="text" class="form-control" id="validationCustom01" placeholder="First name" value="Mark" required="">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationCustom02">Last name</label>
                    <input type="text" class="form-control" id="validationCustom02" placeholder="Last name" value="Otto" required="">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationCustomUsername">Username</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                        </div>
                        <input type="text" class="form-control" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" required="">
                        <div class="invalid-feedback">
                            Please choose a username.
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationCustom03">City</label>
                    <input type="text" class="form-control" id="validationCustom03" placeholder="City" required="">
                    <div class="invalid-feedback">
                        Please provide a valid city.
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom04">State</label>
                    <input type="text" class="form-control" id="validationCustom04" placeholder="State" required="">
                    <div class="invalid-feedback">
                        Please provide a valid state.
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom05">Zip</label>
                    <input type="text" class="form-control" id="validationCustom05" placeholder="Zip" required="">
                    <div class="invalid-feedback">
                        Please provide a valid zip.
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required="">
                    <label class="form-check-label" for="invalidCheck">
                        Agree to terms and conditions
                    </label>
                    <div class="invalid-feedback">
                        You must agree before submitting.
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Submit form</button>
        </form>
        <!-- <form method="post" id="form-admin">
          <div class="form-row">
              <div class="col-md-6 mb-3" id="hideID">
                  <label for="validationCustom02">Nama</label>
                  <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap" required="">
              </div>
              <div class="col-md-6 mb-3">
                <label for="validationCustom01">Nomor Telepon</label>
                <input type="number" class="form-control" name="notelp" id="notelp" required="">
              </div>
          </div>
          <div class="form-row">
            <div class="col-md-12 mb-6">
              <label for="validationCustom02">Alamat Email</label>
              <input type="email" class="form-control" name="email" id="email" required="">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button id="submit-admin" class="btn btn-primary" type="submit">Simpan</button>
          <button id="cancel" type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </form> -->
      </div>
    </div>
  </div>
  <div class="tab-pane fade active show" id="form-user" role="tabpanel" aria-labelledby="form-user-tab">
    <div class="card">
      <div class="card-body">
        <form method="post" id="form-user">
          <div class="form-row">
              <div class="col-md-6 mb-3">
                  <label for="validationCustom01">NIK</label>
                  <input type="number" min=1 class="form-control" name="nik" id="nik" placeholder="Nomor Induk Kependudu.." required="">
              </div>
              <div class="col-md-6 mb-3">
                  <label for="validationCustom02">Nama</label>
                  <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap" required="">
              </div>
          </div>
          <div class="form-row">
              <div class="col-md-6 mb-3">
                  <label for="validationCustom01">Nomor Telepon</label>
                  <input type="number" class="form-control" name="notelp" id="notelp" required="">
              </div>
              <div class="col-md-6 mb-3">
                  <label for="validationCustom02">Alamat Email</label>
                  <input type="email" class="form-control" name="email" id="email" required="">
              </div>
          </div>
          <div class="form-row">
              <div class="col-md-6 mb-3">
                  <label for="gender">Jenis Kelamin</label>
                  <div class="custom-control custom-radio">
                      <input type="radio" id="gender1" value="1" required name="gender" class="custom-control-input">
                      <label class="custom-control-label" for="gender1">Laki - Laki</label>
                  </div>
                  <div class="custom-control custom-radio">
                      <input type="radio" id="gender2" value="2" required name="gender" class="custom-control-input">
                      <label class="custom-control-label" for="gender2">Perempuan</label>
                  </div>
              </div>
              <div class="col-md-6 mb-3">
                  <label for="validationCustom02">Password</label>
                  <div class="input-group">
                      <input type="password" id="password" name="password" required class="form-control">
                      <div class="input-group-append" style="cursor:pointer;">
                          <div class="input-group-text" onclick="togglePassword()"><i id="eye" class="fa fa-eye"></i></div>
                      </div>
                  </div>
                  <!-- <input type="password" class="form-control" id="validationCustom02" required="">
                  <div class="input-group-addon">
                    <a href="javascript:void(0);"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                  </div> -->
              </div>
          </div>
          <div class="form-group">
            <label>Alamat :
            </label>
            <textarea name="alamat" id="alamat" class="form-control" required=""></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button id="submit-user" class="btn btn-primary" type="submit">Simpan</button>
          <button id="cancel" type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </form>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function(){
      $('#submit-admin').click(function(){
        var serialized = $('form#form-admin').serialize();
        if(serialized.indexOf('=&') > -1 || serialized.substr(serialized.length - 1) == '='){
          Swal.fire(
            'Perhatian',
            'Harap Periksa Kembali Formulir User!',
            'warning'
          );
        } else {
          console.log(serialized);
        }
      })
    });
  </script>
</div>

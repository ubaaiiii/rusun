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
<form method="post" id="formUser">
  <div class="form-row">
      <div class="col-md-6 mb-3">
          <label for="validationCustom01">NIK</label>
          <input type="number" min=1 class="form-control" name="nik" id="nik" placeholder="Nomor Induk Kependudukan" required="">
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
  <button id="submit" class="btn btn-primary" type="submit">Simpan</button>
  <button id="cancel" type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
</form>

<script>
  $(document).ready(function(){
    $('#formUser').submit(function(e){
      e.preventDefault();
      var datanya = $(this).serialize();
      // console.log(datanya);
      $('#formUser :input').prop('disabled',true);
      $('#submit').html('<i class="fa fa-circle-o-notch fa-spin"></i> Loading. . .');
      $.ajax({
        url: "<?=base_url('users/daftar/tambah');?>",
        type:"post",
        data: datanya,
        success: function(data) {
          console.log(data);
          if (data=="email_exists"){
            $('#formUser :input').prop('disabled',false);
            $('#submit').html('<i class="icon-edit"></i> Daftar!');
            $('[name="email"]').focus();
            Swal.fire(
              'Kesalahan!',
              'Email sudah pernah didaftarkan.',
              'error'
            )
          } else if (data=="nik_exists") {
            $('#formUser :input').prop('disabled',false);
            $('#submit').html('<i class="icon-edit"></i> Daftar!');
            $('[name="nik"]').focus();
            Swal.fire(
              'Kesalahan!',
              'NIK sudah pernah didaftarkan.',
              'error'
            )
          } else {
            $('#modalSmall').modal('hide');
            Swal.fire({
              title: "Success!",
              text: "Berhasil menambah user baru.",
              icon: "success",
              showConfirmButton: false,
              timer: 1000
            }).then(function() {
              table_user.ajax.reload();
            });
          }
        }
      })
    })

    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
    if($('#judulModal:contains("Edit")').length>0) {
      $('#submit').html('Update');
      $('#cancel').html('Cancel');
    }
  })
</script>

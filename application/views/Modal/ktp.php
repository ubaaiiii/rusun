<style>
.btn-file{position:relative;overflow:hidden}.btn-file input[type=file]{position:absolute;top:0;right:0;min-width:100%;min-height:100%;font-size:100px;text-align:right;opacity:0;outline:0;background:#fff;cursor:inherit;display:block}#img-upload{width:100%}@keyframes blink {50% { color: transparent }}
.loader__dot { animation: 1s blink infinite }
.loader__dot:nth-child(2) { animation-delay: 300ms }
.loader__dot:nth-child(3) { animation-delay: 700ms }
</style>
<fieldset id="field-ktp">
  <form id="form-ktp" enctype="multipart/form-data">
    <div class="input-group">
      <span class="input-group-prepend" style="cursor: pointer;">
        <span class="btn btn-outline-secondary btn-file">
          Pilih Gambar…
          <input type="file" name="file_ktp" id="imgInp">
        </span>
      </span>
      <!-- <label class="form-control form-control-sm" onclick="$('#imgInp').click();" style="cursor: context-menu;"></label> -->
      <input id="textnya" name="judul_ktp" type="text" class="form-control form-control-sm" onclick="$('#imgInp').click();" style="cursor: context-menu;color: transparent;text-shadow: 0 0 0 #2196f3;">
      <div class="input-group-append">
        <button id="submit" type="submit" class="btn btn-primary btn-file">Upload</button>
      </div>
    </div><br>
    <img id='img-upload'/>
  </form>
</fieldset>

<script>
$(document).ready(function() {

  $('#form-ktp').submit(function(e) {
    // console.log(new FormData(this));
    e.preventDefault();
    if ($('#imgInp').val() == "") {
      Swal.fire(
        'Oops!',
        'Belum Ada Gambar Yang Dipilih..',
        'warning'
      )
    } else {
      $('#textnya').prop('disabled', true);
      $('#submit').prop('disabled', true);
      $('button#submit').html('<i class="fa fa-spinner fa-pulse"></i> Uploading <span class="loader__dot">. </span><span class="loader__dot">. </span><span class="loader__dot">.</span>');
      $('#fieldGallery').prop('readonly', true);
      Swal.fire({
        title: 'Apakah Data Sudah Benar?',
        html: "Data identitas ini tidak dapat diubah<br>Akun Anda akan diblokir jika data identitas tidak sesuai",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Tidak',
        confirmButtonText: 'Yakin!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url:'<?php echo base_url("users/simpan_ktp");?>',
            type:"post",
            data:new FormData(this), //this is formData
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            success: function(data){
              console.log(data);
              if (data=="true") {
                $('#modalSmall').modal('hide');
                swal.fire({
                  title: "Success!",
                  text: "Terima Kasih Telah Mengupload Tanda Identitas.",
                  icon: "success",
                  showConfirmButton: false,
                  timer: 1000
                }).then(function() {
                  window.location = "<?=base_url('home');?>";
                });
              } else {
                Swal.fire(
                  'Error!',
                  'Gagal Upload KTP.',
                  'error'
                )
              }
            }
          });
        } else {
          $('#textnya').prop('disabled', false);
          $('#submit').prop('disabled', false);
          $('button#submit').html('Upload');
          $('#fieldGallery').prop('readonly', false);
        }
      })

    }
  })

  $(document).on('change', '.btn-file :file', function() {
    var input = $(this),
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [label]);
  });

  $('.btn-file :file').on('fileselect', function(event, label) {
    var input = $(this).parents('.input-group').find(':text'),
      log = label;

    if (input.length) {
      input.val(log);
    } else {
      if (log) alert(log);
    }
  });

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#img-upload').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#imgInp").change(function() {
    readURL(this);
  });
})
</script>

<style>
.btn-file{position:relative;overflow:hidden}.btn-file input[type=file]{position:absolute;top:0;right:0;min-width:100%;min-height:100%;font-size:100px;text-align:right;opacity:0;outline:0;background:#fff;cursor:inherit;display:block}#img-upload{width:100%}@keyframes blink {50% { color: transparent }}
.loader__dot { animation: 1s blink infinite }
.loader__dot:nth-child(2) { animation-delay: 300ms }
.loader__dot:nth-child(3) { animation-delay: 700ms }
</style>
<fieldset id="field-ktp">
  <form id="form-bukti" enctype="multipart/form-data">
    <input type="text" name="code-booking" value="<?=$codeBooking;?>" hidden>
    <input type="text" id="rekeningText" name="rekening" hidden>
    <div class="form-group">
      <select class="custom-select" id="rekening" required onchange="$('#rekeningText').val($('#rekening option:selected').val());">
        <option selected="selected" disabled hidden>-- Pilih Rekening Tujuan --</option>
        <?php
        foreach ($rekening as $r) {
          echo "<option value='{$r['id']}'>{$r['bank']} - {$r['no_rek']} ({$r['nama']})</option>";
        }
        ?>
      </select>
    </div>
    <div class="input-group">
      <span class="input-group-prepend" style="cursor: pointer;">
        <span class="btn btn-outline-secondary btn-file">
          Pilih Gambar…
          <input type="file" name="file_bukti" id="imgInp">
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

  $('#form-bukti').submit(function(e) {
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
      // console.log($('#form-bukti').serialize());
      $.ajax({
        url:'<?= base_url("booking/upload_bukti");?>',
        type:"post",
        data:new FormData(this), //this is formData
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        success: function(data) {
          if (data=="true") {
            $('#modalSmall').modal('hide');
            swal.fire({
              title: "Success!",
              text: "Terima Kasih Telah Mengupload Bukti Pembayaran.",
              icon: "success",
              showConfirmButton: false,
              timer: 1000
            }).then(function() {
              window.location = "<?=base_url('home/booking');?>";
            });
          } else {
            $('#rekening').prop('disabled', false);
            $('#textnya').prop('disabled', false);
            $('#submit').prop('disabled', false);
            $('button#submit').html('Upload');
            $('#fieldGallery').prop('readonly', false);
            Swal.fire(
              'Error!',
              'Gagal Upload Bukti Pembayaran.',
              'error'
            )
          }
          console.log(data);
        }
      });

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

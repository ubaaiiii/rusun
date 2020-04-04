<style>
.btn-file{position:relative;overflow:hidden}.btn-file input[type=file]{position:absolute;top:0;right:0;min-width:100%;min-height:100%;font-size:100px;text-align:right;opacity:0;outline:0;background:#fff;cursor:inherit;display:block}#img-upload{width:100%}@keyframes blink{50%{color:transparent}}.loader__dot{animation:1s blink infinite}.loader__dot:nth-child(2){animation-delay:300ms}.loader__dot:nth-child(3){animation-delay:700ms}
</style>
<?php
  if (isset($aksi)) {
    if ($aksi=="edit") {
      $judul = $gambar['deskripsi'];
      $idGambar = $gambar['id'];
      $srcGambar = base_url('assets/images/gallery/').$gambar['foto'];
      $upload = 'style="display:none;"';
      $update = '';
    }
  } else {
    $judul = "";
    $idGambar = "";
    $srcGambar = "";
    $upload = "";
    $update = 'style="display:none;"';
  }
?>
<fieldset id="field-gallery">
  <form id="form-gallery" enctype="multipart/form-data">
    <div class="input-group mb-3">
      <input class="" hidden value="<?=$idGambar;?>" type="text" id="id-gambar" name="id-gambar">
      <input class="form-control" value="<?=$judul;?>" required type="text" id="judul-gambar" name="judul-gambar" placeholder="Judul Gambar…" style="text-transform:capitalize;"><br>
      <div class="input-group-append">
        <button id="update" type="button" data-id="" class="btn btn-primary btn-file" <?=$update;?>>Update</button>
      </div>
    </div>
    <?php
    if (!isset($aksi)){
      ?>
      <div class="input-group" <?=$upload;?>>
        <span class="input-group-prepend" style="cursor: pointer;">
          <span class="btn btn-outline-secondary btn-file">
            Pilih Gambar…
            <input type="file" name="file_gallery" id="imgInp">
          </span>
        </span>
        <!-- <label class="form-control form-control-sm" onclick="$('#imgInp').click();" style="cursor: context-menu;"></label> -->
        <input id="textnya" name="judul_ktp" type="text" class="form-control form-control-sm" onclick="$('#imgInp').click();" style="cursor: context-menu;color: transparent;text-shadow: 0 0 0 #2196f3;">
        <div class="input-group-append">
          <button id="submit" type="submit" class="btn btn-primary btn-file">Upload</button>
        </div>
      </div><br>
      <?php
    }
    ?>
    <img id='img-upload' src="<?=$srcGambar;?>">
  </form>
</fieldset>

<script>
$(document).ready(function() {
  $('#update').click(function() {
    var deskripsi = $('#judul-gambar').val();
    var idGambar = $('#id-gambar').val();
    // console.log(idGambar);
    $('#judul-gambar').prop('disabled', true);
    $(this).prop('disabled', true);
    $(this).html('<i class="fa fa-spinner fa-pulse"></i> Updating <span class="loader__dot">. </span><span class="loader__dot">. </span><span class="loader__dot">.</span>');
    $('#field-gallery').prop('readonly', true);
    $.ajax({
      url:'<?php echo base_url("gallery/edit/");?>'+idGambar,
      type:"post",
      data:"deskripsi="+deskripsi,
      success: function(data) {
        if (data=="true") {
          $('#modalSmall').modal('hide');
          $('#div-gallery').load('<?=base_url('gallery/foto');?>');
          swal.fire({
            title: "Success!",
            text: "Berhasil Menyimpan Perubahan.",
            icon: "success",
            showConfirmButton: false,
            timer: 1000
          })
        } else {
          $('#rekening').prop('disabled', false);
          $('#textnya').prop('disabled', false);
          $('#submit').prop('disabled', false);
          $('button#submit').html('Upload');
          $('#field-gallery').prop('readonly', false);
          Swal.fire(
            'Error!',
            'Gagal Menyimpan Perubahan.',
            'error'
          )
        }
      }
    });
  })

  $('#form-gallery').submit(function(e) {
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
      $('#field-gallery').prop('readonly', true);
      // console.log($('#form-gallery').serialize());
      $.ajax({
        url:'<?php echo base_url("gallery/tambah");?>',
        type:"post",
        data:new FormData(this), //this is formData
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        success: function(data) {
          if (data=="true") {
            $('#modalSmall').modal('hide');
            $('#div-gallery').load('<?=base_url('gallery/foto');?>');
            swal.fire({
              title: "Success!",
              text: "Berhasil menambah gambar ke gallery.",
              icon: "success",
              showConfirmButton: false,
              timer: 1000
            })
          } else {
            $('#rekening').prop('disabled', false);
            $('#textnya').prop('disabled', false);
            $('#submit').prop('disabled', false);
            $('button#submit').html('Upload');
            $('#field-gallery').prop('readonly', false);
            Swal.fire(
            'Error!',
            'Gagal Upload Gambar.',
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

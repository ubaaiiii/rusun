<?php
if (isset($kamar)) {
  ($kamar['gender']==1)?($check='true'):($check='false');
  echo "<script>
    $('#submit').html('Update');
    $('#harga').val('".$kamar['harga']."');
    $('#id').val('".$kamar['id']."');
    $('#tingkat').val('".$kamar['tingkat']."');
    $('#gender').prop('checked',".$check.");
  </script>";
}
?>
<style>
.wrap{margin:auto;position:relative;top:-20px}.slider-v2{position:relative;display:block;width:5.5em;height:3em;cursor:pointer;border-radius:1.5em;transition:350ms;background:linear-gradient(rgba(0,0,0,.07),rgba(255,255,255,0)),#ddd;box-shadow:0 .07em .1em -.1em rgba(0,0,0,.4) inset,0 .05em .08em -.01em rgba(255,255,255,.7)}.slider-v2::after{position:absolute;content:'';width:2em;height:2em;top:.5em;left:.5em;border-radius:50%;transition:250ms ease-in-out;background:linear-gradient(#f5f5f5 10%,#eee);box-shadow:0 .1em .15em -.05em rgba(255,255,255,.9) inset,0 .2em .2em -.12em rgba(0,0,0,.5)}.slider-v2::before{position:absolute;content:'';width:4em;height:1.5em;top:.75em;left:.75em;border-radius:.75em;transition:250ms ease-in-out;background:linear-gradient(rgba(0,0,0,.07),rgba(255,255,255,.1)),#ff7cfd;box-shadow:0 .08em .15em -.1em rgba(255,142,242,.5) inset,0 .05em .08em -.01em rgba(255,255,255,.7),0 0 0 0 rgba(0,168,255,.7) inset}input:checked+.slider-v2::before{box-shadow:0 .08em .15em -.1em rgba(255,142,242,.5) inset,0 .05em .08em -.01em rgba(255,255,255,.7),3em 0 0 0 rgba(0,168,255,.7) inset}input:checked+.slider-v2::after{left:3em}.cewe{position:relative;left:-90px;top:39px}.cowo{position:relative;left:80px;top:-39px}.btn-file{position:relative;overflow:hidden}.btn-file input[type=file]{position:absolute;top:0;right:0;min-width:100%;min-height:100%;font-size:100px;text-align:right;opacity:0;outline:0;background:#fff;cursor:inherit;display:block}#img-upload{width:100%}@keyframes blink{50%{color:transparent}}.loader__dot{animation:1s blink infinite}.loader__dot:nth-child(2){animation-delay:.3s}.loader__dot:nth-child(3){animation-delay:.7s}
</style>
<fieldset id="kamar-field">
  <form id="kamar-form" data-toggle="validator" role="form">
    <div class="form-row">
      <div class="col-md-6 mb-3">
        <label for="validationCustom02">Harga</label>
        <input type="text" class="form-control" id="id" name="id" hidden>
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text">Rp.</div>
          </div>
          <input type="text" class="form-control uang" id="harga" name="harga" required="">
        </div>
      </div>
      <div class="col-md-6 mb-3">
        <label class="col-form-label">Lantai</label>
        <select class="custom-select" name="tingkat" id="tingkat">
          <option selected disabled hidden value="">Pilih Lantai</option>
          <option value="1">Lantai 1</option>
          <option value="2">Lantai 2</option>
          <option value="3">Lantai 3</option>
          <option value="4">Lantai 4</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="gender">Tipe Kamar</label>
      <div class="wrap">
        <center class="">
          <label class="cewe">Perempuan</label>
          <input type="checkbox" hidden id="gender" name="gender">
          <label class="slider-v2" for="gender"></label>
          <label class="cowo">Laki-Laki</label>
        </center>
      </div>
    </div>
    <button id="submit" class="btn btn-primary float-right" type="submit">Simpan</button>
  </form>
</fieldset>

<script>
  $(document).ready(function(){
    $('.uang').mask('0.000.000.000.000', {reverse: true});

    $('#kamar-form').submit(function(e){
      e.preventDefault();
      <?=(isset($kamar))?('var tipe = "update";'):('var tipe = "save";');?>
      var datanya = $(this).serialize();
      $('#kamar-field').prop('disabled',true);
      console.log(datanya);
      $("#submit").html('<i class="fa fa-spinner fa-pulse"></i> Updating <span class="loader__dot">. </span><span class="loader__dot">. </span><span class="loader__dot">.</span>');
      $.ajax({
        url: "<?=base_url('kamar/proses/');?>"+tipe,
        data: datanya,
        type: "post",
        success: function(data) {
          console.log(data);
          if (data=="true") {
            $('#refresh-kamar').click();
            $('#modalSmall').modal('hide');
            swal.fire({
              title: "Success!",
              text: "Berhasil Mengubah Data Kamar.",
              icon: "success",
              showConfirmButton: false,
              timer: 1000
            });
          } else {
            swal.fire({
              title: "Gagal!",
              text: "Gagal Mengubah Data Kamar.",
              icon: "error"
            });
          }
        }
      })
    })
  })
</script>

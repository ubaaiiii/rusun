<?php
  if (isset($rekening)) {
    $id   = $rekening['id'];
    $rek  = $rekening['no_rek'];
    $nama = $rekening['nama'];
    $bank = $rekening['bank'];
    $tipe = "update";
  } else {
    $id   = "";
    $rek  = "";
    $nama = "";
    $bank = "";
    $tipe = "simpan";
  }
?>
<form method="post" id="form-rekening">
  <div class="form-row">
      <div class="col-md-6 mb-3">
          <label for="nomor-rekening">Nomor Rekening</label>
          <input type="number" min=1 class="form-control" name="nomor-rekening" id="nomor-rekening" required="" value="<?=$rek;?>">
          <input type="hidden" class="form-control" name="id" required="" value="<?=$id;?>">
      </div>
      <div class="col-md-6 mb-3">
          <label for="bank">Bank</label>
          <input type="text" class="form-control" name="bank" id="bank" required="" value="<?=$bank;?>">
      </div>
  </div>
  <div class="form-row">
      <div class="col-md-12 mb-3">
          <label for="pemilik">Pemilik Rekening</label>
          <input type="text" class="form-control" name="pemilik" id="pemilik" required="" value="<?=$nama;?>">
      </div>
  </div>
</div>
<div class="modal-footer">
  <?php
  if (isset($rekening)) {
    ?>
    <button id="update" class="btn btn-success" type="update">Update</button>
    <?php
  } else {
    ?>
    <button id="submit" class="btn btn-primary" type="submit">Simpan</button>
    <?php
  }
  ?>
  <button id="cancel" type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
</form>

<script>
$(document).ready(function(){
  $('#form-rekening').submit(function(e){
    e.preventDefault();
    var datanya = $(this).serialize();
    // console.log(datanya);
    $.ajax({
      url: "<?=base_url('rekening/proses/').$tipe;?>",
      data: datanya,
      type: "post",
      success: function(data) {
        if (data=="true") {
          $('#table-rekening').DataTable().ajax.reload();
          $('#modalSmall').modal('hide');
          swal.fire({
            title: "Success!",
            <?php if (!isset($rekening)) { ?>
            text: "Berhasil Menambah Data Rekening.",
            <?php } else { ?>
            text: "Berhasil Merubah Data Rekening.",
            <?php } ?>
            icon: "success",
            showConfirmButton: false,
            timer: 1000
          });
        } else if (data=="exists"){
          swal.fire({
            title: "Warning!",
            text: "Rekening Sudah Ada.",
            icon: "warning",
            showConfirmButton: false,
            timer: 1000
          });
        } else if (data=="exists"){
          swal.fire({
            title: "Error!",
            text: "Gagal Menambah Data Rekening.",
            icon: "error",
            showConfirmButton: false,
            timer: 1000
          });
        }
      }
    })
  })
})
</script>

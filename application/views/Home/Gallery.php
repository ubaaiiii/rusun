<div class="tab-pane fade show active mt-3" id="showall" role="tabpanel" aria-labelledby="showall-tab">
  <div class="row" id="div-gallery">

  </div>
</div>
<script>
  $(document).ready(function(){
    $('#div-gallery').load('<?=base_url('gallery/foto');?>')

    $('#pTambahan').html(` <button id="tambahGambar" type="button" class="btn btn-dark btn-xs mb-3 fa fa-plus" data-toggle="modal" data-target="#modalSmall" onclick="$('.modal-body').load('<?=base_url('modal/gambar');?>');" style="position:relative;top:7px;"></button>`);

    $('#tambahGambar').click(function(){
      $('#judulModal').html('Tambah Gambar');
    });
  })
</script>

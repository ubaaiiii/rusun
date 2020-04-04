<?php foreach ($gallery as $g) : ?>
    <div class="col-lg-3 col-md-4 mt-3">
      <div class="card card-bordered">
        <a href="<?=base_url('assets/images/gallery/').$g['foto'];?>" data-toggle="lightbox" data-max-width="600" data-title="<?=$setting['nama'];?>" data-footer="<h4 class='float-left'><?=ucwords($g['deskripsi']);?></p>">
          <img class="card-img-top img-fluid" src="<?=base_url('assets/images/gallery/').$g['foto'];?>" alt="image">
        </a>
        <div class="card-body">
          <p class="card-text"><?=$g['deskripsi'];?></p>
          <div class="btn-group btn-block" role="group" aria-label="Basic example">
            <button type="button" data-toggle="modal" data-target="#modalSmall" style="width:200%;" data-id="<?=$g['id'];?>" class="editGallery btn btn-sm btn-primary fa fa-edit"></button>
            <button type="button" style="width:200%;" data-id="<?=$g['id'];?>" class="hapusGallery btn btn-sm btn-primary fa fa-trash"></button>
          </div>
        </div>
      </div>
    </div>
<?php endforeach; ?>
<script>
$(document).ready(function(){
  $('.editGallery').on('click',function(){
    var dataGambar = $(this).attr('data-id');
    $('.modal-body').load('<?=base_url('modal/gambar/');?>'+dataGambar+"/edit");
    $('#judulModal').html('Ubah Deskripsi Gambar');

  })

  $('.hapusGallery').on('click',function(){
    var dataGambar = $(this).attr('data-id');
    Swal.fire({
      title: 'Anda Yakin Ingin Hapus Gambar?',
      text: "Gambar tidak akan dapat dikembalikan.",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Tidak',
      confirmButtonText: 'Ya!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: '<?=base_url('gallery/hapus/');?>'+dataGambar,
          type: "post",
          success: function(data) {
            // console.log(data);
            $('#div-gallery').load('<?=base_url('gallery/foto');?>');
            swal.fire({
              title: "Success!",
              text: "Gambar telah dihapus",
              icon: "success",
              showConfirmButton: false,
              timer: 1000
            })
          }
        })
      }
    })
  })
})
</script>

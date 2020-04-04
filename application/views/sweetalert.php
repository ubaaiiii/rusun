<!-- jquery latest version -->
<script src="<?=base_url();?>assets/js/vendor/jquery-2.2.4.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?=base_url();?>assets/js/sweetalert2.js"></script>
<script>
  $(document).ready(function(){
    <?php
    switch ($tipe) {
      case ("success") :
        echo `var judul = "Success!";
        var tipe    = "success";
        var pesan   = "`.$pesan.`";`;
        break;
    }
    ?>

    swal.fire({
      title: judul,
      text: pesan,
      icon: tipe,
      showConfirmButton: false,
      timer: 1000
    }).then(function() {
      window.location = "<?=base_url($tujuan);?>";
    });
  })
</script>

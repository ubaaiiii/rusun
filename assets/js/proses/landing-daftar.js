$(document).ready(function(){
  $('#landing-daftar').submit('click',function(e){
    e.preventDefault();
    var datanya = $(this).serialize();
    // console.log(datanya);
    Swal.fire({
      title: 'Sebelum Mendaftar',
      text: "Apa anda sudah membaca Syarat & Ketentuan Menghuni?",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sudah!',
      cancelButtonText: 'Belum',
    }).then((result) => {
      if (result.value) {
        $('#landing-daftar :input').prop('disabled',true);
        $('#landing-submit').html('<i class="fa fa-circle-o-notch fa-spin"></i> Loading. . .');
        $.ajax({
          url: base_url+"users/proses/user/simpan",
          type:"post",
          data: datanya,
          success: function(data) {
            console.log(data);
            if (data=="email_exists"){
              $('#landing-daftar :input').prop('disabled',false);
              $('#landing-submit').html('<i class="icon-edit"></i> Daftar!');
              $('[name="email"]').focus();
              Swal.fire(
                'Kesalahan!',
                'Email sudah pernah didaftarkan.',
                'error'
              )
            } else if (data=="nik_exists") {
              $('#landing-daftar :input').prop('disabled',false);
              $('#landing-submit').html('<i class="icon-edit"></i> Daftar!');
              $('[name="nik"]').focus();
              Swal.fire(
                'Kesalahan!',
                'NIK sudah pernah didaftarkan.',
                'error'
              )
            } else {
              Swal.fire({
                title: "Success!",
                text: "Anda akan dialihkan ke halaman Login",
                icon: "success",
                showConfirmButton: false,
                timer: 1000
              }).then(function() {
                window.location = base_url+"home";
              });
            }
          }
        })
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        $('#exampleModal').modal('show');
      }
    })

  })
})

<div class="card mt-3">
    <div class="card-body">
        <div id="sisa-waktu"></div>
        <div class="invoice-area" id="invoice-area">
            <div class="invoice-head">
                <div class="row">
                    <div class="iv-left col-6">
                        <span><?=$setting['nama'];?></span>
                    </div>
                    <div class="iv-right col-6 text-md-right">
                        <span>Kode <?=($invoice['status']==0)?('Booking'):('Transaksi');?> #<?=$invoice['code_booking'];?></span>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="invoice-address">
                        <h3>Invoice</h3>
                        <h5>to: <?=$dUser['nama'];?></h5>
                        <p><?=(isset($dUser['alamat']))?($dUser['alamat']):('Alamat Tertagih');?></p>
                        <p><?=$dUser['email'];?></p>
                        <p><?=$dUser['no_telp'];?></p>
                    </div>
                </div>
                <div class="col-md-6 text-md-right">
                    <ul class="invoice-date">
                        <li>Harap transfer pembayaran ke:</li>
                        <ul>
                          <?php foreach ($rekening as $r): ?>
                            <li><?=" ".$r['no_rek']." A/N ".strtoupper($r['nama']." - (".$r['bank'].")");?></li>
                          <?php endforeach; ?>
                        </ul>
                    </ul>
                </div>
            </div>
            <div class="invoice-table table-responsive mt-5">
                <table class="table table-bordered table-hover text-right">
                    <thead>
                        <tr class="text-capitalize">
                            <th class="text-left" style="width: 45%; min-width: 130px;">Deskripsi</th>
                            <th>Jumlah</th>
                            <th style="min-width: 100px">Harga Perbulan</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-left">Pembayaran <?=($invoice['status']==0)?('Booking'):('Perpanjang Sewa');?> Kamar Rusun <?=$invoice['code'];?>, di Lantai <?=$invoice['tingkat'];?></td>
                            <td><?=($invoice['status']==0)?($invoice['jumlah']):($perpanjang['jumlah_bulan']);?> Bulan</td>
                            <td>Rp. <?=number_format($invoice['harga'],2,',','.');?></td>
                            <td>Rp. <?=number_format($invoice['harga']*(($invoice['status']==0)?($invoice['jumlah']):($perpanjang['jumlah_bulan'])),2,',','.');?></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">Yang harus dibayar :</td>
                            <td>Rp. <?=number_format($invoice['harga']*(($invoice['status']==0)?($invoice['jumlah']):($perpanjang['jumlah_bulan'])),2,',','.');?></td>
                        </tr>
                        <h1 style="display:none;" class="stampel">LUNAS</h1>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="float-right">
            <a href="javascript:void(0);" onclick="printDiv('invoice-area');" class="btn btn-primary">Print Invoice</a>
            <a href="javascript:void(0);" id="upload-bukti" data-toggle="modal" data-target="#modalSmall" onclick="$('.modal-body').load('<?=base_url('modal/upload_bukti/'.$invoice['code_booking']);?>');" class="btn btn-success">Upload Bukti</a>
            <a href="javascript:void(0);" id="booking-cancel" data-booking="<?=$invoice['code_booking'];?>" class="btn btn-danger">Cancel <?=($invoice['status']==0)?('Booking'):('Perpanjang');?></a>
        </div>
    </div>
</div>

<script>
  function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
  }

  $(document).ready(function(){
    $('#filter-booking').css("display","none");

    $('#booking-cancel').on('click',function(){
      var dataBooking = $(this).attr('data-booking');
      Swal.fire({
        title: 'Anda Yakin Ingin Cancel?',
        text: "<?=($invoice['status']==0)?('Booking'):('Transaksi');?> #"+dataBooking+" tidak akan bisa dikembalikan.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Tidak',
        confirmButtonText: 'Yakin!'
      }).then((result) => {
        if(result.value){
          if (<?=$invoice['status'];?>==0) {
            var tipeCancel = "booking";
          } else {
            var tipeCancel = "perpanjang";
          }
          $.ajax({
            url: "<?=base_url('booking/batal/');?>"+tipeCancel+"/"+dataBooking,
            type: "post",
            success: function(data) {
              // console.log(data);
              swal.fire({
                title: "Success!",
                text: "<?=($invoice['status']==0)?('Booking'):('Transaksi');?> #"+dataBooking+" telah dibatalkan.",
                icon: "success",
                showConfirmButton: false,
                timer: 1000
              }).then(function() {
                window.location = "booking";
              });

            }
          })
        }
      })
    })

    $('#upload-bukti').click(function(){
      $('#judulModal').html('Upload Bukti');
    })
    var expp = "";
    <?php
      if (!isset($lunas)){
    ?>
    var ends = new Date("<?=date('Y-m-d H:i:s',strtotime(($invoice['status']==0)?($invoice['tanggal_booking']):($perpanjang['tanggal_request']))+60*60);?>").getTime();
    var x = setInterval(function() {
      var now = new Date().getTime();
      var distance = ends - now;
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      if (hours!=0) {
        var jam = hours+" Jam ";
      } else {
        var jam = "";
      }
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
      document.getElementById("sisa-waktu").innerHTML = "Sisa waktu: " + jam
      + minutes + " Menit " + seconds + " Detik ";
      if (distance < 0) {
        document.getElementById("sisa-waktu").innerHTML = "EXPIRED";
        expp = "expired";
        clearInterval(x);
        <?php $cegah = "expired"; ?>
      }
    }, 1000);

    if(expp != "expired"){
      Swal.fire({
        title:'Pemberitahuan',
        html:'Harap Melunasi <?=($invoice['status']==0)?('Booking'):('Transaksi');?> #<?=$invoice['code_booking'];?>.',
        footer:'<a href="<?=base_url('home');?>">Hubungi Admin.</a>',
        icon:'warning'
      })
    } else {
      Swal.fire(
        'Pemberitahuan',
        'Booking #<?=$invoice['code_booking'];?> telah kadaluarsa.',
        'error'
      ).then((result) => {
        if (result.value) {
          window.location = "<?=base_url('home');?>"
        }
      })
    }
    <?php
      } else {
    ?>
      $('.stampel').removeAttr('style');
    <?php
      }
    ?>
  })
</script>

<style>
.swal2-overflow {
  overflow-x: visible;
  overflow-y: visible;
}
.red {
  background-color: #e74c3c !important;
}
</style>
<?php
  if(isset($dUser['admin'])){
?>

<div class="card mt-3">
  <div class="card-body">
    <h4 class="header-title">Data Booking</h4>
    <div class="data-tables datatable-dark">
      <table id="tableBooking" class="text-center table-hover">
        <thead class="text-capitalize">
          <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Penghuni</th>
            <th colspan="2">Tanggal</th>
            <th colspan="3">Bukti</th>
            <th rowspan="2">Actions</th>
          </tr>
          <tr>
            <th>Booking</th>
            <th>Konfirmasi</th>
            <th>Rekening Tujuan</th>
            <th>Foto</th>
            <th>Biaya Sewa</th>
          </tr>
        </thead>
          <tbody>

          </tbody>
        </table>
      </div>
    </div>
  </div>


<script>
  $(document).ready(function(){
    $('#tableBooking tbody').on( 'click', '.konfirmasi', function () {
      var booking = $(this).attr('data-id');
      var uang = $(this).attr('data-value');
      // console.log(booking);
      Swal.fire({
        title: 'Booking #'+booking,
        html: 'Anda Yakin Ingin Mengonfirmasi?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Tidak',
        confirmButtonText: 'Ya!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: "<?=base_url('booking/konfirmasi/');?>"+booking+"/"+uang,
            type:"post",
            success: function(data) {
              console.log(data);
              switch (data) {
                case "true":
                table_booking.ajax.reload();
                swal.fire({
                  title: "Success!",
                  text: "Booking #"+booking+" Telah Dikonfirmasi.",
                  icon: "success",
                  showConfirmButton: false,
                  timer: 1000
                });
                break;

                case "gagal_kamar":
                swal.fire({
                  title: "Gagal!",
                  text: "Data Kamar Gagal Diupdate.",
                  icon: "error"
                })
                break;

                case "gagal_keuangan":
                swal.fire({
                  title: "Gagal!",
                  text: "Laporan Keuangan Gagal Tersimpan.",
                  icon: "error"
                })
                break;
                default:
                swal.fire({
                  title: "Gagal!",
                  text: "Maaf, Booking #"+booking+" Gagal Dikonfirmasi.",
                  icon: "error"
                });
                break;
              }
            }
          })
        }
      })
    });
    $('#tableBooking tbody').on( 'click', '.tolak', function () {
      var booking = $(this).attr('data-id');
      // console.log(booking);
      Swal.fire({
        title: 'Anda Yakin Ingin Menolak?',
        html: 'Setelah Ditolak, Booking #'+booking+' Tidak Dapat Dikembalikan.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Tidak',
        confirmButtonText: 'Ya!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: "<?=base_url('booking/tolak/');?>"+booking,
            type:"post",
            success: function(data) {
              console.log(data);
              if (data=="true") {
                table_booking.ajax.reload();
                swal.fire({
                  title: "Success!",
                  text: "Booking #"+booking+" Telah Ditolak.",
                  icon: "success",
                  showConfirmButton: false,
                  timer: 1000
                })
              } else {
                swal.fire({
                  title: "Gagal!",
                  text: "Booking #"+booking+" Gagal Ditolak.",
                  icon: "error"
                })
              }
            }
          })
        }
      })
    });

    var table_booking = $('#tableBooking').DataTable({
      responsive: true,
      autoWidth: false,
      ajax:{
          url: "<?=base_url('booking/data');?>",
          type:"POST",
          dataSrc: ""
      },
      columns:[
        {data:"booking"},
        {data:"nama", render:function(data,type,row,meta){
          return (data==null)?('User Dihapus'):(data);
        }},
        {data:"tanggal_booking", render:function(data){
          return moment(data).format('YYYY-MM-D [[]H:mm:ss[]]');
        }},
        {data:"tanggal_lunas", render:function(data){
          return (data!=null)?(moment(data).format('YYYY-MM-D [[]H:mm:ss[]]')):(`<span class="badge badge-pill badge-danger" style="letter-spacing: 2px;">BELUM<BR>DIKONFIRMASI</span>`);;
        }},
        {data:"rekening"},
        {data:"upload_bukti", render: function(data,type,row,meta){
          return `<a href="<?=base_url('assets/images/bukti/');?>`+data+`" data-toggle="lightbox" data-max-width="600" data-title="<?=$setting['nama'];?>" data-footer="<h4 class='float-left'>Tujuan: `+row.rekening+`</p>">
            <i class="ti-receipt"></i>
          </a>`;
        }},
        {data:"uang",
          render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp. ' )},
        {data:"bookstats",render: function(data,type,row,meta){
          switch(data) {
            case ("0"):
              return `<span class="badge badge-pill badge-warning" style="letter-spacing: 2px;">BELUM BAYAR</span>`;
              break;
            case ("1"):
              return `<div class="btn-group" role="group" aria-label="Basic example">
                          <button type="button" class="konfirmasi btn btn-xs btn-primary" data-value="`+row.uang+`" data-id="`+row.booking+`"><i class="fa fa-check" data-toggle="tooltip" data-placement="right" title="Konfirmasi"></i></button>
                          <button type="button" class="tolak btn btn-xs btn-warning"data-id="`+row.booking+`"><i class="fa fa-times" data-toggle="tooltip" data-placement="right" title="Tolak"></i></button>
                      </div>`;
              break;
            case ("2"):
              return `<div class="btn-group" role="group" aria-label="Basic example">
              <span class="badge badge-pill badge-primary" style="letter-spacing: 2px;">SEDANG DIHUNI</span>
              </div>`;
              break;
            case ("3"):
              return '<span class="badge badge-pill badge-success" style="letter-spacing: 2px;">SELESAI</span>';
              break;
            case ("4"):
              return '<span class="badge badge-pill badge-warning" style="letter-spacing: 2px;">DITOLAK</span>';
              break;
            case ("5"):
              return '<span class="badge badge-pill badge-info" style="letter-spacing: 2px;">PERPANJANG</span>';
              break;
            case ("6"):
              return `<span class="badge badge-pill badge-info">REQUEST<br>PERPANJANG</span>`;
              break;
            default:
              return '<span class="badge badge-pill badge-danger" style="letter-spacing: 2px;">KESALAHAN STATUS</span>';
              break;
          }
        }},
        {data:"uang",visible:false}
      ],
      createdRow: function( row, data, dataIndex ) {
        if ( data.nama == null ) {
          $(row).addClass('red');
        }
      },
      "columnDefs": [ {
          "searchable": false,
          "orderable": false,
          "targets": 0
      } ],
      "order": [[ 1, 'asc' ]]
    });

    table_booking.on( 'order.dt search.dt', function () {
        table_booking.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    $('#tableBooking tbody').on( 'click', '#lihat-bukti', function () {
      var gambar = $(this).attr('data-gambar');
      $('#judulModal').html('Bukti Transfer');
      $('#load-modal-here').load('<?=base_url('modal/bukti/');?>'+gambar);
    });

  })
</script>

<?php
} else {
?>

<div class="row" id="list-booking">
  <?php foreach($kamar as $k): ?>
    <div class="col-xl-3 col-ml-4 col-mdl-4 col-sm-6 <?="t-".$k['tingkat']." g-".$k['gender']." s-".$k['status'];?> t-all g-all s-all">
        <div class="card mt-4">
            <div class="<?=($k['status']==1)?(''):('unvl');?> pricing-list">
                <div class="prc-head">
                    <h4><?=$k['code'];?></h4>
                </div>
                <div class="prc-list">
                    <ul>
                        <li>Lantai <?=$k['tingkat'];?></li>
                        <li>Harga Rp. <?=number_format($k['harga'], 0, ',', '.');?></li>
                        <li>Status : <?=($k['status']==1)?('<br><span class="badge badge-pill badge-primary">TERSEDIA</span>'):(($k['status']==2)?('<span class="badge badge-pill badge-warning">DIBOOKING</span>'):('<span class="badge badge-pill badge-danger">DITEMPATI</span>'));?></li>
                        <?php
                          if ($k['status']!=1) {
                            if ($k['status']==2) {
                              $dt = strtotime($k['tanggal_booking']) + 3600;
                              $dt = date('Y-m-d H:i:s',$dt);
                              echo '<li>Hingga : <u>'.$dt.'</u></li>';
                            } else if ($k['status']==3) {
                              echo '<li>Hingga : <u>'.$k['tanggal_selesai'].'</u></li>';
                            }
                          }
                          ?>
                        <li class="bold">Tipe : <?=($k['gender']==1)?('Laki-Laki'):('Perempuan');?></li>
                    </ul>
                    <a href="javascript:void(0);" data-harga="<?=$k['harga'];?>" data-kamar="<?=$k['code'];?>" data-booking="<?=$k['id'];?>" <?=($k['status']!=1)?('disabled'):('class="bBooking"');?>><?=($k['status']==1)?('Booking'):('<s>Booking</s>');?></a>
                </div>
            </div>
        </div>
    </div>
  <?php endforeach; ?>
</div>

<div id="kamar-kosong" class="alert alert-danger mt-3" role="alert" style="display:none;">
  <strong><i class="fa fa-exclamation-triangle"></i> Uh oh!</strong> Hasil filter tidak menemukan kamar yang diinginkan.
</div>


<div class="card mt-3" id="list-history" style="display:none;">
  <div class="card-body">
    <div class="btn-group mb-xl-3" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-xs btn-secondary">History Booking</button>
        <button type="button" class="btn btn-xs btn-secondary">History Perpanjang</button>
    </div>
    <div class="data-tables datatable-dark">
      <table id="tableBookingUser" class="text-center table-hover">
        <thead class="text-capitalize">
          <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Kode Booking</th>
            <th rowspan="2">Kamar</th>
            <th colspan="3">Tanggal</th>
            <th colspan="2">Bukti</th>
            <th rowspan="2">Status</th>
          </tr>
          <tr>
            <th>Booking</th>
            <th>Konfirmasi</th>
            <th>Selesai</th>
            <th>Rekening Tujuan</th>
            <th>Foto</th>
          </tr>
        </thead>
          <tbody>

          </tbody>
        </table>
      </div>
    </div>
  </div>


<script>
  $(document).ready(function(){

    function rupiah(uangnya){
      var	reverse = uangnya.toString().split('').reverse().join(''),
      	ribuan 	= reverse.match(/\d{1,3}/g);
      	ribuan	= ribuan.join('.').split('').reverse().join('');
        return "RP. "+ribuan;
    }

    $('#tableBookingUser tbody').on( 'click', '.perpanjang', function () {
      var booking = $(this).attr('data-booking');
      var kamar = $(this).attr('data-kamar');
      $('#judulModal').html('Perpanjang Sewa Kamar '+kamar);
      $('#load-modal-here').load('<?=base_url('modal/perpanjang/');?>'+booking);
      $('#modalSmall').modal({'backdrop': 'static','keyboard':false});
    })

    function tableHistory(){
      var table_history = $('#tableBookingUser').DataTable({
        responsive: true,
        autoWidth: false,
        ajax:{
            url: "<?=base_url('booking/data/'.$dUser['nik']);?>",
            type:"POST",
            dataSrc: ""
        },
        columns:[
          {data:"id_kamar"},
          {data:"booking"},
          {data:"kamar"},
          {data:"tanggal_booking", render:function(data){
            return moment(data).format('YYYY-MM-D [[]H:mm:ss[]]');
          }},
          {data:"tanggal_lunas", render:function(data){
            return (data!=null)?(moment(data).format('YYYY-MM-D [[]H:mm:ss[]]')):(`<a href="<?=base_url('home');?>" data-toggle="tooltip" data-placement="right" title="Hubungi Admin"><span class="badge badge-pill badge-warning" style="letter-spacing: 2px;">MENUNGGU<br>KONFIRMASI</span></a>`);;
          }},
          {data:"tanggal_selesai", render:function(data){
            return (data!=null)?(moment(data).format('YYYY-MM-D [[]H:mm:ss[]]')):(`<span class="badge badge-pill badge-danger">booking E L U M &nbsp;&nbsp;&nbsp;L U N A S</span>`);;
          }},
          {data:"rekening"},
          {data:"upload_bukti",render: function(data,type,row,meta){
            return `<a href="<?=base_url('assets/images/bukti/');?>`+data+`" data-toggle="lightbox" data-max-width="600" data-title="<?=$setting['nama'];?>" data-footer="<h4 class='float-left'>Tujuan: `+row.rekening+`</p>">
              <i class="ti-receipt"></i>
            </a>`;
          }},
          {data:"bookstats",render: function(data,type,row,meta){
            switch(data) {
              case ("0"):
                return `<span class="badge badge-pill badge-danger" style="letter-spacing: 2px;">HARAP UPLOAD<BR>BUKTI PEMBAYARAN</span>`;
                break;
              case ("1"):
                return `<a href="<?=base_url('home');?>" data-toggle="tooltip" data-placement="right" title="Hubungi Admin" style="letter-spacing: 2px;"><span class="badge badge-pill badge-warning">MENUNGGU<br>KONFIRMASI</span></a>`;
                break;
              case ("2"):
                return `<div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-xs btn-success">Sedang Dihuni</button>
                            <button type="button" class="perpanjang btn btn-xs btn-success fa fa-plus" data-kamar="`+row.kamar+`" data-booking="`+row.booking+`" data-toggle="tooltip" data-placement="top" title="Perpanjang Sewa?"></button>
                        </div>`;
                break;
              case ("3"):
                return '<span class="badge badge-pill badge-success" style="letter-spacing: 2px;">SELESAI</span>';
                break;
              case ("4"):
                return '<a href="<?=base_url('home');?>" data-toggle="tooltip" data-placement="right" title="Hubungi Admin" style="letter-spacing: 2px;"><span class="badge badge-pill badge-warning" style="letter-spacing: 2px;">DITOLAK</span></a>';
                break;
              case ("5"):
                return `<a href="<?=base_url('home');?>" data-toggle="tooltip" data-placement="right" title="Hubungi Admin" style="letter-spacing: 2px;"><span class="badge badge-pill badge-info">PERPANJANG</span></a>`;
                break;
              case ("6"):
                return `<a href="<?=base_url('home');?>" data-toggle="tooltip" data-placement="right" title="Hubungi Admin" style="letter-spacing: 2px;"><span class="badge badge-pill badge-info">REQUEST<br>PERPANJANG</span></a>`;
                break;
              default:
                return '<span class="badge badge-pill badge-danger" style="letter-spacing: 2px;">KESALAHAN STATUS</span>';
                break;
            }
          }},
          {data:"id_kamar",visible:false}
        ],
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        },{
            "searchable": false,
            "orderable": false,
            "targets": 8
        }],
        "order": [[ 1, 'asc' ]]
      });

      table_history.on( 'order.dt search.dt', function () {
          table_history.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
              cell.innerHTML = i+1;
          } );
      } ).draw();
    }

    function tableBooking(){
      var table_booking = $('#tableBookingUser').DataTable({
        responsive: true,
        autoWidth: false,
        ajax:{
            url: "<?=base_url('booking/data/'.$dUser['nik']);?>",
            type:"POST",
            dataSrc: ""
        },
        columns:[
          {data:"id_kamar"},
          {data:"booking"},
          {data:"kamar"},
          {data:"tanggal_booking", render:function(data){
            return moment(data).format('YYYY-MM-D [[]H:mm:ss[]]');
          }},
          {data:"tanggal_lunas", render:function(data){
            return (data!=null)?(moment(data).format('YYYY-MM-D [[]H:mm:ss[]]')):(`<a href="<?=base_url('home');?>" data-toggle="tooltip" data-placement="right" title="Hubungi Admin"><span class="badge badge-pill badge-warning" style="letter-spacing: 2px;">MENUNGGU<br>KONFIRMASI</span></a>`);;
          }},
          {data:"tanggal_selesai", render:function(data){
            return (data!=null)?(moment(data).format('YYYY-MM-D [[]H:mm:ss[]]')):(`<span class="badge badge-pill badge-danger">booking E L U M &nbsp;&nbsp;&nbsp;L U N A S</span>`);;
          }},
          {data:"rekening"},
          {data:"upload_bukti",render: function(data,type,row,meta){
            return `<a href="<?=base_url('assets/images/bukti/');?>`+data+`" data-toggle="lightbox" data-max-width="600" data-title="<?=$setting['nama'];?>" data-footer="<h4 class='float-left'>Tujuan: `+row.rekening+`</p>">
              <i class="ti-receipt"></i>
            </a>`;
          }},
          {data:"bookstats",render: function(data,type,row,meta){
            switch(data) {
              case ("0"):
                return `<span class="badge badge-pill badge-danger" style="letter-spacing: 2px;">HARAP UPLOAD<BR>BUKTI PEMBAYARAN</span>`;
                break;
              case ("1"):
                return `<a href="<?=base_url('home');?>" data-toggle="tooltip" data-placement="right" title="Hubungi Admin" style="letter-spacing: 2px;"><span class="badge badge-pill badge-warning">MENUNGGU<br>KONFIRMASI</span></a>`;
                break;
              case ("2"):
                return `<div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-xs btn-success">Sedang Dihuni</button>
                            <button type="button" class="perpanjang btn btn-xs btn-success fa fa-plus" data-kamar="`+row.kamar+`" data-booking="`+row.booking+`" data-toggle="tooltip" data-placement="top" title="Perpanjang Sewa?"></button>
                        </div>`;
                break;
              case ("3"):
                return '<span class="badge badge-pill badge-success" style="letter-spacing: 2px;">SELESAI</span>';
                break;
              case ("4"):
                return '<a href="<?=base_url('home');?>" data-toggle="tooltip" data-placement="right" title="Hubungi Admin" style="letter-spacing: 2px;"><span class="badge badge-pill badge-warning" style="letter-spacing: 2px;">DITOLAK</span></a>';
                break;
              case ("5"):
                return `<a href="<?=base_url('home');?>" data-toggle="tooltip" data-placement="right" title="Hubungi Admin" style="letter-spacing: 2px;"><span class="badge badge-pill badge-info">PERPANJANG</span></a>`;
                break;
              case ("6"):
                return `<a href="<?=base_url('home');?>" data-toggle="tooltip" data-placement="right" title="Hubungi Admin" style="letter-spacing: 2px;"><span class="badge badge-pill badge-info">REQUEST<br>PERPANJANG</span></a>`;
                break;
              default:
                return '<span class="badge badge-pill badge-danger" style="letter-spacing: 2px;">KESALAHAN STATUS</span>';
                break;
            }
          }},
          {data:"id_kamar",visible:false}
        ],
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        },{
            "searchable": false,
            "orderable": false,
            "targets": 8
        }],
        "order": [[ 1, 'asc' ]]
      });

      table_booking.on( 'order.dt search.dt', function () {
          table_booking.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
              cell.innerHTML = i+1;
          } );
      } ).draw();
    }

    tableBooking();

  $('#pTitle').html(`<label class="switch book active mt-3">
    <input type="checkbox" <?=(isset($history))?(''):('checked');?> id="togBtn"><div class="slider round"></div>
  </label>`);

  $('#togBtn').on('click',function(){
    if($(this).is(':checked')){
      $("#list-booking").css("display", "");
      $('#filter-booking').css("display","");
      $("#list-history").css("display", "none");
    } else {
      $("#list-booking").css("display", "none");
      $('#filter-booking').css("display","none");
      $("#list-history").css("display", "");
    }
  })

  $('#togBtn').trigger('click');

  $('.bBooking').on('click',function(){
    var dataBooking = $(this).attr('data-booking');
    var dataKamar = $(this).attr('data-kamar');
    var dataHarga = $(this).attr('data-harga');
    $('#modalSmall').modal({'backdrop': 'static','keyboard':false});
    $('.modal-body').load('<?=base_url('modal/booking/');?>'+dataBooking);
    $('#judulModal').html('Booking Kamar '+dataKamar);
  })

})
</script>

<?php
}
?>

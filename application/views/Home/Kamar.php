<script>
function pad (str, max) {
  str = str.toString();
  return str.length < max ? pad("0" + str, max) : str;
}
</script>

<?php
date_default_timezone_set('Asia/Jakarta');
function tgl_indo($tanggal){
  $bulan = array (
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
  );
  $pecahkan = explode('-', $tanggal);

  // variabel pecahkan 0 = tahun
  // variabel pecahkan 1 = bulan
  // variabel pecahkan 2 = tanggal

  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
?>

<?php
if($tabel=="Data"){
  ?>
  <div class="card mt-3">
    <div class="card-body">
      <div class="header-title">
        <h4><button id="tambahKamar" type="button" class="btn btn-dark mb-3 fa fa-plus" data-toggle="modal" data-target="#modalSmall" onclick="$('.modal-body').load('<?=base_url('modal/kamar');?>');"> &nbsp;Tambah Kamar</button></h4>
      </div>
      <div class="data-tables datatable-dark">
        <table id="tableKamar" class="text-center table-hover">
          <thead class="text-capitalize">
            <tr>
              <th>No</th>
              <th>Kode</th>
              <th>Lantai</th>
              <th>Tipe</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
    </div>
  </div>
<button id="refresh-kamar" hidden></button>
  <script>
    $(document).ready(function(){
      var table_kamar = $('#tableKamar').DataTable({
        responsive: true,
        autoWidth: false,
        ajax:{
          url: "<?=base_url('kamar/data');?>",
          type:"POST",
          dataSrc: ""
        },
        columns:[
        {data:"id"},
        {data:"code"},
        {data:"tingkat"},
        {data:"gender",render: function(data,type,row){
          return (data=="1")?("Laki-Laki"):("Perempuan");}},
          {data:"status",render: function(data,type,row){
            switch (data) {
              case ("1"):
                return '<span class="badge badge-pill badge-success" style="letter-spacing: 2px;">KOSONG</span>';
                break;
              case ("2"):
                return '<span class="badge badge-pill badge-warning" style="letter-spacing: 2px;">DIBOOKING</span>';
                break;
              case ("3"):
                return '<span class="badge badge-pill badge-primary" style="letter-spacing: 2px;">DITEMPATI</span>';
                break;
              default:
                return '<span class="badge badge-pill badge-danger" style="letter-spacing: 2px;">KESALAHAN STATUS</span>';;
                break;
            }}},
            {data:"id",render: function(data,type,row,meta){
              return (row.status==1)?(`<ul class="d-flex justify-content-center">
                <li class="mr-3"><a href="javascript:void(0)" data-value="`+row.code+`" data-status="`+row.status+`" data-id="`+data+`" id="edit" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                <li><a id="hapus" href="#" data-status="`+row.status+`" data-id="`+data+`" data-value="`+row.code+`" class="text-danger"><i class="ti-trash"></i></a></li>
              </ul>`):('<span class="badge badge-pill badge-warning" style="letter-spacing: 2px;">NO ACTION</span>');}}
              ],
              "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": 0
              } ],
              "order": [[ 1, 'asc' ]]
            });

            table_kamar.on( 'order.dt search.dt', function () {
              table_kamar.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
              } );
            } ).draw();

            $('#refresh-kamar').click(function(){
              table_kamar.ajax.reload();
            })

            $('#tambahKamar').click(function(){
              $('#judulModal').html('Tambah Kamar');
            })

            $('#tableKamar tbody').on( 'click', '#edit', function () {
              var idnya = $(this).attr('data-id');
              var status = $(this).attr('data-status');
              var kodenya = $(this).attr('data-value');
              // console.log(idnya);
              if(status==1){
                $('#judulModal').html('Ubah Kamar '+kodenya);
                $('.modal-body').load('<?=base_url('modal/kamar/');?>'+idnya);
                $('#modalSmall').modal('show');
              } else {
                Swal.fire(
                'Forbidden!',
                'Kamar ini sedang dibooking / ditempati.',
                'error'
                ).then((result) => {
                  $('#modalSmall').modal('hide');
                })
              }
            });

            $('#tableKamar tbody').on( 'click', '#hapus', function () {
              var idnya = $(this).attr('data-id');
              var status = $(this).attr('data-status');
              var kodenya = $(this).attr('data-value');
              console.log(idnya);
              if (status==1){
                Swal.fire({
                  title: 'Yakin ingin hapus kamar '+kodenya+'?',
                  text: "Data kamar tidak bisa dikembalikan.",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ya, hapus saja!',
                  cancelButtonText: 'Jangan!',
                }).then((result) => {
                  if (result.value) {
                    $.ajax({
                      url: '<?=base_url("kamar/hapus/");?>'+idnya,
                      method: 'POST',
                      dataType: 'JSON',
                      success: (data) => {
                        console.log(data);
                        if(data!=false){
                          table_kamar.ajax.reload();
                          Swal.fire(
                            'Terhapus!',
                            'Kamar telah dihapus.',
                            'success'
                          )
                        } else {
                          Swal.fire(
                            'Gagal!',
                            'Kamar tidak terhapus.',
                            'warning'
                          )
                        }
                      }
                    })
                  }
                })
              } else {
                Swal.fire(
                'Forbidden!',
                'Kamar ini sedang dibooking / ditempati.',
                'error'
                )
              }
            });


          })

        </script>
        <?php
      } else {
        ?>
        <div class="card mt-3">
          <div class="card-body">
            <div class="header-title">
              <h4>Tanggal Hari Ini: <?=tgl_indo(date("Y-m-d"));?> <button onclick="tgRefresh(this)" class="btn btn-xs btn-dark"><i class="fa fa-refresh fa-spins"></i></button></h4>
            </div>
            <div class="data-tables datatable-dark">
              <table id="tableKamar" class="text-center table-hover">
                <thead class="text-capitalize">
                  <tr>
                    <th rowspan=2>No</th>
                    <th rowspan=2>Penghuni</th>
                    <th rowspan=2>Kamar</th>
                    <th colspan=3>Tanggal</th>
                    <th rowspan=2>Sisa Waktu</th>
                    <th rowspan=2>Actions</th>
                  </tr>
                  <tr>
                    <th>Booking</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
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
            $('#tableKamar tbody').on( 'click', '#perpanjang', function () {
              var idnya = $(this).attr('data-id');
              var kodenya = $(this).attr('data-kode');
              $('#modalSmall').modal({'backdrop': 'static','keyboard':false});
              $('.modal-body').load('<?=base_url('modal/perpanjang');?>/'+idnya);
              $('#judulModal').html('Perpanjang Waktu Sewa');
            });

            $('#tableKamar tbody').on( 'click', '#akhiri', function () {
              // console.log('a');
              var idnya = $(this).attr('data-id');
              var kodenya = $(this).attr('data-kode');
              Swal.fire({
                title: 'Yakin ingin akhiri sewa kamar '+kodenya+'?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Tidak',
              }).then((result) => {
                if (result.value) {
                  $.ajax({
                    url: '<?=base_url("kamar/akhiri/");?>'+idnya,
                    method: 'POST',
                    dataType: 'JSON',
                    success: (data) => {
                      console.log(data);

                    }
                  })
                }
              })
            });

            tgRefresh = function(button) {
              $(button).find('i').toggleClass('fa-spin fa-spins');
              $(button).toggleClass('btn-dark btn-primary')
              if(!($(button).find('i').hasClass("fa-spins"))) {
                interval = setInterval(function() {
                  table_kamar.ajax.reload();
                },1000);
              } else {
                clearInterval(interval);
              }
            }

            var table_kamar = $('#tableKamar').DataTable({
              responsive: true,
              autoWidth: false,
              ajax:{
                url: "<?=base_url('kamar/datamanagement');?>",
                type:"POST",
                dataSrc: ""
              },
              columns:[
              {data:"booking"},
              {data:"nama",render:function(data,row,type,meta){
                return (data!=null)?(data.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();})):('Penghuni Tidak Ditemukan');
              }},
              {data:"kamar"},
              {data:"tanggal_booking", render:function(data){
                return moment(data).format('YYYY-MM-D [[]H:mm:ss[]]');
              }},
              {data:"tanggal_mulai", render:function(data){
                return moment(data).format('YYYY-MM-D [[]H:mm:ss[]]');
              }},
              {data:"tanggal_selesai", render:function(data){
                return moment(data).format('YYYY-MM-D [[]H:mm:ss[]]');
              }},
              {data:"tanggal_selesai",render:function(data,type,row,meta){
                var ends = new Date(data).getTime();
                var now = new Date().getTime();
                var distance = ends - now;
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = pad(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),2);
                var minutes = pad(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)),2);
                var seconds = pad(Math.floor((distance % (1000 * 60)) / 1000),2);
                if (distance<1){
                  return '<span class="badge badge-pill badge-danger" style="letter-spacing: 2px;">EXPIRED</span>'
                } else {
                  return days + " hari [" + hours + ":" + minutes + ":" + seconds + "]";
                }
              }},
              {data:"booking",render: function(data,type,row,meta){
                return `<ul class="d-flex justify-content-center">
                  <li class="mr-3"><a href="javascript:void(0)" data-id="`+data+`" data-kode="`+row.kamar+`" id="perpanjang" class="text-success"><i class="fa fa-plus-circle" title="Perpanjang"></i></a></li>
                  <li><a id="akhiri" href="#" data-value="`+row.nama+`" data-id="`+data+`" data-kode="`+row.kamar+`" class="text-danger"><i class="fa fa-ban" title="Akhiri"></i></a></li>
                </ul>`;}},
                {data:"status",visible:false}
                ],
                "columnDefs": [ {
                  "searchable": false,
                  "orderable": false,
                  "targets": 0
                },
                {
                  targets: 1,
                  className: 'dt-body-left'
                } ],
                "order": [[ 1, 'asc' ]]
              });

              table_kamar.on( 'order.dt search.dt', function () {
                table_kamar.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                  cell.innerHTML = i+1;
                } );
              }).draw();
            })
          </script>
          <?php
        }
        ?>

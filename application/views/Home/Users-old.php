<style>
.red {
  background-color: coral !important;
}
</style>

<?php
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
  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
?>

<?php
  if($lokasi!="Admins"){
?>
      <div class="card mt-3">
        <div class="card-body">
          <div class="header-title">
            <h4><button id="tambahUser" type="button" class="btn btn-dark mb-3 fa fa-user-plus" data-toggle="modal" data-target="#modalSmall" onclick="$('.modal-body').load('<?=base_url('modal/user');?>');"> &nbsp;Tambah User</button></h4>
          </div>
          <div class="data-tables datatable-dark">
            <table id="tableUser" class="text-center table-hover">
              <thead class="text-capitalize">
                <tr>
                  <th>No</th>
                  <th>NIK</th>
                  <th>Nama</th>
                  <th>No Telpon</th>
                  <th>Gender</th>
                  <th>KTP</th>
                  <th>Foto</th>
                  <th>Status</th>
                  <th>Actions</th>
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
        var table_user = $('#tableUser').DataTable({
            responsive: true,
            autoWidth: false,
            ajax:{
                url: "<?=base_url('users/data/users');?>",
                type:"POST",
                dataSrc: ""
            },
            columns:[
              {data:"nik"},
              {data:"nik"},
              {data:"nama",render: function(data,type,row,meta){
                return (row.status==0)?('[Belum Aktif] - '+data):(data);
              }},
              {data:"no_telp"},
              {data:"gender",render: function(data,type,row){
                 return (data=="1")?("Laki-Laki"):("Perempuan");}},
              {data:"ktp",visible:false},
              {data:"foto",render: function(data,type,row,meta){
                return `<ul class="d-flex justify-content-center">
                            <li class="mr-3"><a href="javascript:void(0);" class="text-secondary"><img class="avatar user-thumb" width="35" src="<?=base_url('assets/images/users/');?>`+data+`" alt="avatar"></a></li>
                        </ul>`;
              }},
              {data:"status",visible:false},
              {data:"nik",render: function(data,type,row,meta){
                return `<ul class="d-flex justify-content-center">
                            <li class="mr-3"><a href="javascript:void(0)" id="edit" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                            <li><a href="#" class="text-danger"><i class="ti-trash"></i></a></li>
                        </ul>`;
              }}
            ],
            "createdRow": function( row, data, dataIndex ) {
               if ( data.status == 0 ) {
                 $(row).addClass('red');
               }
            },
            "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": 0
            }],
            "order": [[ 1, 'asc' ]]
        });

        table_user.on( 'order.dt search.dt', function () {
            table_user.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();

        $('#tambahUser').click(function(){
          $('#judulModal').html('Tambah User');
        })

        $('#tableUser tbody').on( 'click', '#edit', function () {
          $('.modal-body').load('<?=base_url('modal/kamar');?>');
          $('#judulModal').html('Edit Kamar');
          var idnya = $(this).attr('data-modal');
          var status = $(this).attr('data-status');
          if(status==1){
            $.ajax({
              url: '<?php echo base_url("kamar/cariKamar/") ?>'+idnya,
              method: 'GET',
              dataType: 'JSON',
              success: (data) => {
                $('#edit_harga').val(data.harga);
                $('#edit_lantai').val(data.tingkat);
                $('#edit_gender').val(data.gender);
                $('#edit_id').val(idnya);
              }
            })
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

        $('#tableUser tbody').on( 'click', '#hapus', function () {
          var idnya = $(this).attr('data-modal');
          var status = $(this).attr('data-status');
          if (status==1){
            $.ajax({
              url: '<?php echo base_url("kamar/cariKamar/") ?>'+idnya,
              method: 'POST',
              dataType: 'JSON',
              success: (data) => {
                Swal.fire({
                  title: 'Yakin ingin hapus kamar '+data.code+'?',
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
                      url: '<?=base_url("home/kamar/hapusKamarbyID/");?>'+idnya,
                      method: 'POST',
                      dataType: 'JSON',
                      success: (data) => {
                        if(data!=false){
                          table_user.ajax.reload();
                          Swal.fire(
                            'Terhapus!',
                            'Kamar '+data.code+' telah dihapus.',
                            'success'
                          )
                        } else {
                          Swal.fire(
                            'Gagal!',
                            'Kamar '+data.code+' tidak terhapus.',
                            'warning'
                          )
                        }
                      }
                    })
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
            <h4>Tanggal Hari Ini: <?=tgl_indo(date("Y-m-d"));?> <button onclick="tgRefresh(this)" class="btn btn-dark"><i class="fa fa-refresh fa-spins"></i></button></h4>
          </div>
          <div class="data-tables datatable-dark">
            <table id="tableUser" class="text-center table-hover">
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
          var table_user = $('#tableUser').DataTable({
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
                  return data.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
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
                      return '<span class="badge badge-pill badge-danger">E X P I R E D</span>'
                    } else {
                      return days + " hari [" + hours + ":" + minutes + ":" + seconds + "]";
                    }
                }},
                {data:"booking",render: function(data,type,row,meta){
                   return `<div class="btn-group">
                              <button id="edit" class="btn btn-default btn-xs" data-modal=`+data+` data-toggle="modal" data-target="#modalSmall"><i class="icon-plus"></i> &nbsp;Perpanjang</button>
                              <button type="button" class="btn btn-default btn-xs dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                              </button>
                              <div class="dropdown-menu">
                                <button id="hapus" data-modal=`+data+` data-status=`+row.status+` class="dropdown-item"><i class="icon-trash"></i> Akhiri</button>
                              </div>
                            </div>`;}}
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

          table_user.on( 'order.dt search.dt', function () {
              table_user.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                  cell.innerHTML = i+1;
              } );
          }).draw();
        })
      </script>
<?php
  }
?>

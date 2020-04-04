<style>
.red {
  background-color: #7f8c8d !important;
}
</style>
<div class="card mt-3">
  <div class="card-body">
    <div class="d-sm-flex justify-content-between align-items-center">
      <div class="trd-history-tabs">
        <ul class="nav" role="tablist">
          <li>
            <a class="" data-toggle="tab" href="#admin" role="tab" aria-selected="false">Admin</a>
          </li>
          <li>
            <a data-toggle="tab" href="#user" role="tab" class="active show" aria-selected="true">User</a>
          </li>
        </ul>
      </div>
      <div class="pr-3">
        <button class="btn btn-dark fa fa-user-plus" id="tambah-user"> Tambah User</button>
      </div>
    </div>
    <div class="trad-history mt-4">
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade" id="admin" role="tabpanel">
          <div class="table-responsive">
            <button id="admin-refresh" hidden>asd</button>
            <table id="table-admin" class="data-tables datatable-dark table-hover">
              <thead class="text-capitalize">
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>No Telpon</th>
                  <th>Email</th>
                  <th>Foto</th>
                  <th>Password</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
        <div class="tab-pane fade active show" id="user" role="tabpanel">
          <div class="table-responsive">
            <button id="user-refresh" hidden>asd</button>
            <table id="table-user" class="data-tables datatable-dark table-hover">
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
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    var table_admin = $('#table-admin').DataTable({
      responsive: true,
      autoWidth: false,
      ajax:{
        url: "<?=base_url('users/data/admin');?>",
        type:"POST",
        dataSrc: ""
      },
      columns:[
      {data:'id'},
      {data:'nama',render: function(data,type,row,meta){
        return (row.status==0)?('[Belum Aktif] - '+data):(data);
      }},
      {data:'no_telp',render: function(data,type,row){
        return `<a href="tel:`+data+`">`+data+`</a>`;
      }},
      {data:'email',render: function(data,type,row){
        return `<a href="mailto:`+data+`">`+data+`</a>`;
      }},
      {data:'foto',render: function(data,type,row,meta){
        return `<ul class="d-flex justify-content-center">
          <li class="mr-3"><a href="javascript:void(0);" class="text-secondary">
          <a href="<?=base_url('assets/images/author/');?>`+data+`" data-toggle="lightbox" data-max-width="600" data-title="<?=$setting['nama'];?>" data-footer="<h4 class='float-left'>`+row.nama+`</p>">
            <img class="avatar user-thumb" width="35" src="<?=base_url('assets/images/author/');?>`+data+`" alt="avatar">
          </a>
          </li>
          </ul>`;
        }},
        {data:'password',visible:false},
        {data:"id",render: function(data,type,row,meta){
          return `<ul class="d-flex justify-content-center">
            <li class="mr-3"><a href="javascript:void(0)" data-id="`+data+`" id="edit" class="text-secondary"><i class="fa fa-edit"></i></a></li>
            <li><a id="hapus" href="#" data-value="`+row.nama+`" data-id="`+data+`" class="text-danger"><i class="ti-trash"></i></a></li>
          </ul>`;
        }}
        ],
        createdRow: function( row, data, dataIndex ) {
          if ( data.status == 0 ) {
            $(row).addClass('red');
          }
        },
        columnDefs: [ {
          searchable: false,
          orderable: false,
          targets: 0
        },{
          searchable: false,
          orderable: false,
          targets: 6
        }],
        order: [[ 1, 'asc' ]]
      });

      $('#admin-refresh').click(function(){
        table_admin.ajax.reload();
      })
      $('#user-refresh').click(function(){
        table_user.ajax.reload();
      })

      $('#table-admin tbody').on( 'click', '#edit', function () {
        var id = $(this).attr('data-id');
        $('#modalSmall').modal({'backdrop': 'static','keyboard':false});
        $('.modal-body').load('<?=base_url('modal/user/admin/');?>'+id);
      });

      $('#table-admin tbody').on( 'click', '#hapus', function () {
        var id = $(this).attr('data-id');
        var nama = $(this).attr('data-value');
        Swal.fire({
          title: 'Ingin Hapus Admin '+nama+'?',
          text: "Admin "+nama+" tidak akan dapat dikembalikan.",
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Tidak',
          confirmButtonText: 'Ya!'
        }).then((result) => {
          if (result.value) {
            $.ajax({
              url: '<?=base_url('users/hapus/admin/');?>'+id,
              type: "post",
              success: function(data) {
                console.log(data);
                $('#admin-refresh').click();
                swal.fire({
                  title: "Success!",
                  text: "Admin telah dihapus",
                  icon: "success",
                  showConfirmButton: false,
                  timer: 1000
                })
              }
            })
          }
        })
      });

      $('#tambah-user').click(function(){
        $('#modalSmall').modal({'backdrop': 'static','keyboard':false});
        $('.modal-body').load('<?=base_url('modal/user');?>');
        $('#judulModal').html('Tambah User');
      })

      table_admin.on( 'order.dt search.dt', function () {
        table_admin.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
        } );
      } ).draw();

      var table_user = $('#table-user').DataTable({
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
            return (row.ktp!="")?(`<ul class="d-flex justify-content-center">
              <li class="mr-3">
              <a href="<?=base_url('assets/images/users/');?>`+data+`" data-toggle="lightbox" data-max-width="600" data-title="<?=$setting['nama'];?>" data-footer="<h4 class='float-left'>`+row.nama+`</p>">
                <img class="avatar user-thumb rounded-circle" width="35" src="<?=base_url('assets/images/users/');?>`+data+`" alt="avatar">
              </a>
              </li>
            <li class="mr-3">
            <a href="<?=base_url('assets/images/ktp/');?>`+row.ktp+`" data-toggle="lightbox" data-max-width="600" data-title="`+row.nama+`" data-footer="<h4 class='float-left'>`+row.nik+`</p>">
              <i class="icon-id-card-o"></i>
            </a>
            </li></ul>`):(`<ul class="d-flex justify-content-center">
              <li class="mr-3">
              <a href="<?=base_url('assets/images/users/');?>`+data+`" data-toggle="lightbox" data-max-width="600" data-title="<?=$setting['nama'];?>" data-footer="<h4 class='float-left'>`+row.nama+`</p>">
                <img class="avatar user-thumb rounded-circle" width="35" src="<?=base_url('assets/images/users/');?>`+data+`" alt="avatar">
              </a>
              </li>
            </ul>`);
          }},
          {data:"status",visible:false},
          {data:"nik",render: function(data,type,row,meta){
            return `<ul class="d-flex justify-content-center">
              <li class="mr-3"><a href="javascript:void(0)" data-id="`+data+`" id="edit" class="text-secondary"><i class="fa fa-edit"></i></a></li>
              <li><a href="javascript:void(0)" data-value="`+row.nama+`" data-id="`+data+`" id="hapus" class="text-danger"><i class="ti-trash"></i></a></li>
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
          },{
            "searchable": false,
            "orderable": false,
            "targets": 8
          }],
          "order": [[ 1, 'asc' ]]
        });

        table_user.on( 'order.dt search.dt', function () {
          table_user.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
          } );
        } ).draw();

        $('#table-user tbody').on( 'click', '#edit', function () {
          var id = $(this).attr('data-id');
          $('#modalSmall').modal({'backdrop': 'static','keyboard':false});
          $('.modal-body').load('<?=base_url('modal/user/user/');?>'+id);
        });

        $('#table-user tbody').on( 'click', '#hapus', function () {
          var id = $(this).attr('data-id');
          var nama = $(this).attr('data-value');
          Swal.fire({
            title: 'Ingin Hapus User '+nama+'?',
            text: "User "+nama+" tidak akan dapat dikembalikan.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya!'
          }).then((result) => {
            if (result.value) {
              $.ajax({
                url: '<?=base_url('users/hapus/user/');?>'+id,
                type: "post",
                success: function(data) {
                  console.log(data);
                  if (data=="true") {
                    swal.fire({
                      title: "Success!",
                      text: "User "+nama+" telah dihapus",
                      icon: "success",
                      showConfirmButton: false,
                      timer: 1000
                    })
                    $('#user-refresh').click();
                  } else if (data=="forbid") {
                    swal.fire({
                      title: "Forbidden!",
                      text: "User "+nama+" sedang menghuni, tidak dapat dihapus.",
                      icon: "error"
                    });
                  } else {
                    swal.fire({
                      title: "Gagal!",
                      text: "Gagal memproses data user.",
                      icon: "warning"
                    });
                  }
                }
              })
            }
          })
        });
      })
    </script>

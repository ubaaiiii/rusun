$(document).ready(function(){
  var table_kamar = $('#tableKamar').DataTable({
      responsive: true,
      autoWidth: false,
      ajax:{
          url: "<?=base_url('data/kamar');?>",
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
           return (data=="1")?('<span class="badge badge-pill badge-success">KOSONG</span>'):((data=="2")?('<span class="badge badge-pill badge-warning">BOOKING</span>'):('<span class="badge badge-pill badge-danger">DITEMPATI</span>'));}},
        {data:"id",render: function(data,type,row,meta){
           return `<div class="btn-group">
                <button id="edit" class="btn btn-default btn-xs" data-modal=`+data+` data-toggle="modal" data-target="#modalSmall"><i class="icon-edit"></i> Edit</button>
                <button type="button" class="btn btn-default btn-xs dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu">
                  <button id="hapus" data-modal=`+data+` data-status=`+row.status+` class="dropdown-item"><i class="icon-trash"></i> Hapus</button>
                </div>
              </div>`;}}
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

  $('#tambahKamar').click(function(){
    $('#judulModal').html('Tambah Kamar');
  })

  $('#tableKamar tbody').on( 'click', '#edit', function () {
    $('#judulModal').html('Edit Kamar');
    $('#submit').html('Update');
    var idnya = $(this).attr('data-modal');
    // console.log('<?php echo base_url("home/kamar/cariKamarbyID/") ?>'+idnya);
    $.ajax({
      url: '<?php echo base_url("home/kamar/cariKamarbyID/") ?>'+idnya,
      method: 'GET',
      dataType: 'JSON',
      success: (data) => {
        $('#edit_harga').val(data.harga);
        $('#edit_lantai').val(data.tingkat);
        $('#edit_gender').val(data.gender);
        $('#edit_id').val(idnya);
      }
    })
  } );

  $('#tableKamar tbody').on( 'click', '#hapus', function () {
    var idnya = $(this).attr('data-modal');
    var status = $(this).attr('data-status');
    if (status==1){
      $.ajax({
        url: '<?php echo base_url("home/kamar/cariKamarbyID/") ?>'+idnya,
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
                    table_kamar.ajax.reload();
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

<div class="card mt-3">
  <div class="card-body">
    <div class="data-tables datatable-dark">
      <table id="tablePesan" class="text-center table-hover">
        <thead class="text-capitalize">
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Pesan</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div>
  </div>
</div>
<button id="refresh-pesan" hidden></button>
<script>
$(document).ready(function() {
var table_pesan = $('#tablePesan').DataTable({
  responsive: true,
  autoWidth: false,
  ajax: {
    url: "<?=base_url('pesan/data');?>",
    type: "POST",
    dataSrc: ""
  },
  columns: [{
      data: "id"
    },
    {
      data: "nama"
    },
    {
      data: "email",
      render: function(data, type, row) {
        return "<a href='mailto:"+data+"' target='_blank'>"+data+"</a>";
      }
    },
    {
      data: "pesan",
      render: function(data, type, row) {
        data = data.split("-");
        return '<span class="badge badge-pill badge-success" style="letter-spacing: 2px;">'+data[0]+'</span><br />'+data[1];
      }
    },
  ],
  "columnDefs": [{
    "searchable": false,
    "orderable": false,
    "targets": 0
  }],
  "order": [
    [1, 'asc']
  ]
});

table_pesan.on('order.dt search.dt', function() {
  table_pesan.column(0, {
    search: 'applied',
    order: 'applied'
  }).nodes().each(function(cell, i) {
    cell.innerHTML = i + 1;
  });
}).draw();

$('#refresh-pesan').click(function() {
  table_pesan.ajax.reload();
})

})
</script>

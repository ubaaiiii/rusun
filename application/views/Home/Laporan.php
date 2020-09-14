<div class="card mt-3">
  <div class="card-body">
    <div class="">
      <div class="search-box pull-left" style="position:relative;top:-10px;">
          <form action="laporan/print" method="post">
              <input type="text" name="periode" placeholder="Pilih Periode Booking..." id="rangeLaporan" required>
              <button type="submit" href="#"><i class="fa fa-print" data-toggle="tooltip" data-placement="right" title="Print"></i></button>
          </form>
      </div>
      <input hidden type="text" id="minDate">
      <input hidden type="text" id="maxDate">
    </div>
    <div class="data-tables datatable-dark">
      <table id="tableLaporan" class="text-center table-hover">
        <thead class="text-capitalize">
          <tr>
            <th rowspan="2">No</th>
            <th colspan="2">Tanggal</th>
            <th rowspan="2">Kamar</th>
            <th rowspan="2">Nama</th>
            <th rowspan="2">Rekening Tujuan</th>
            <th rowspan="2">Jumlah Uang</th>
          </tr>
          <tr>
            <th>Booking</th>
            <th>Selesai</th>
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

    var tabel_laporan = $('#tableLaporan').DataTable({
        responsive: true,
        autoWidth: false,
        ajax:{
            url: "<?=base_url('laporan/data');?>",
            type:"POST",
            dataSrc: ""
        },
        columns:[
          {data:"id"},
          {data:"tanggal_booking"},
          {data:"tanggal_selesai"},
          {data:"kamar"},
          {data:"nama",render:function(data,row,type,meta){
            return (data!=null)?(data.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();})):("User Tidak Ditemukan");
          }},
          {data:"no_rek"},
          {data:"uang",
            render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp. ' )}
        ],
        "columnDefs": [ {
              "searchable": false,
              "orderable": false,
              "targets": 0
          },
          {
            targets: 4,
            className: 'dt-body-left'
          },
          {
            targets: 6,
            className: 'dt-body-right'
          }
        ],
        "order": [[ 1, 'asc' ]]
      });

      tabel_laporan.on( 'order.dt search.dt', function () {
          tabel_laporan.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
              cell.innerHTML = i+1;
          } );
      } ).draw();

      $('#rangeLaporan').keydown(function() {
        return false;
      });
      $('#rangeLaporan').focus(function() {
        this.value = '';
      });
      $('#rangeLaporan').focusout(function() {
        this.value = 'All Periode';
        minDateFilter = "";
        maxDateFilter = "";
        tabel_laporan.draw();
      });

    $('#rangeLaporan').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'All Periode'
      }
    });

    $('#rangeLaporan').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        minDateFilter = picker.startDate.format('YYYY-MM-DD')
        maxDateFilter = picker.endDate.format('YYYY-MM-DD')
        tabel_laporan.draw();
    });

    $('#rangeLaporan').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('All Periode');
        minDateFilter = "";
        maxDateFilter = "";
        tabel_laporan.draw();
    });

    minDateFilter = "";
    maxDateFilter = "";

    $.fn.dataTableExt.afnFiltering.push(
      function(oSettings, aData, iDataIndex) {

        if (typeof aData._date == 'undefined') {
          aData._date = new Date(aData[1]).getTime();
        }
        if (typeof minDateFilter == 'string') {
          minDateFilter = new Date(minDateFilter).getTime();
        }
        if (typeof maxDateFilter == 'string') {
          maxDateFilter = new Date(maxDateFilter).getTime();
        }

        if (minDateFilter && !isNaN(minDateFilter)) {
          if (aData._date < minDateFilter) {
            console.log("false pertama");
            return false;
          }
        }

        if (maxDateFilter && !isNaN(maxDateFilter)) {
          if (aData._date > maxDateFilter) {
            console.log("false kedua");
            return false;
          }
        }

        console.log("true");
        return true;
      }
    );

    $('a#lihat-bukti').click(function(){
      var gambar = $(this).attr('data-gambar');
      $('#judulModal').html('Bukti Transfer');
      $('#load-modal-here').load('<?=base_url('modal/bukti/');?>'+gambar);
      console.log('<?=base_url('modal/bukti/');?>'+gambar);
    })

  })
</script>

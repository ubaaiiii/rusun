<div class="card mt-3">
  <div class="card-body">
    <div class="">
      <div class="search-box pull-left" style="position:relative;top:-10px;">
          <form action="laporan/print" method="post">
              <input type="text" name="periode" placeholder="Pilih Periode..." id="rangeLaporan" required>
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
        $('#minDate').val('');
        $('#maxDate').val('');
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
        $('#minDate').val(picker.startDate.format('YYYY-MM-DD'));
        $('#maxDate').val(picker.endDate.format('YYYY-MM-DD'));
        tabel_laporan.draw();
    });

    $('#rangeLaporan').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('All Periode');
        $('#minDate').val('');
        $('#maxDate').val('');
        tabel_laporan.draw();
    });

    $.fn.dataTableExt.afnFiltering.push(
        function( oSettings, aData, iDataIndex ) {
            var iFini = $('#minDate').val();
            var iFfin = $('#maxDate').val();
            var iStartDateCol = 2;
            var iEndDateCol = 2;

            iFini=iFini.substring(6,10) + iFini.substring(3,5)+ iFini.substring(0,2);
            iFfin=iFfin.substring(6,10) + iFfin.substring(3,5)+ iFfin.substring(0,2);

            var datofini=aData[iStartDateCol].substring(6,10) + aData[iStartDateCol].substring(3,5)+ aData[iStartDateCol].substring(0,2);
            var datoffin=aData[iEndDateCol].substring(6,10) + aData[iEndDateCol].substring(3,5)+ aData[iEndDateCol].substring(0,2);

            if ( iFini === "" && iFfin === "" )
            {
                return true;
            }
            else if ( iFini <= datofini && iFfin === "")
            {
                return true;
            }
            else if ( iFfin >= datoffin && iFini === "")
            {
                return true;
            }
            else if (iFini <= datofini && iFfin >= datoffin)
            {
                return true;
            }
            return false;
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

<?php
date_default_timezone_set('Asia/Jakarta');
$sekarang = strtotime(date('Y-m-d'));
$jarak_awal = date("Y-m-d", strtotime("+1 month", $sekarang));
$waktu_sekarang = date('H:i');
?>
<fieldset id="field-booking">
  <form id="form-booking">
    <div class="form-group">
      <label>Harga Kamar :
      </label>
      <input type="text" name="id-kamar" id="id-kamar" class="form-control" required="" hidden value="<?=$kamar['id'];?>">
      <input type="text" id="edit_harga" class="form-control" required style="text-align: right;" readonly value="Rp. <?=number_format($kamar['harga'], 0, ',', '.');?>">
    </div>
    <div class="form-group">
      <label>Jumlah Bulan :
      </label>
      <input id="booking-bulan" name="bulan" type="range" value="0" min="1" max="12">
    </div>
    <div class="form-group">
      <label>Total Harga :
      </label>
      <input type="text" id="total-harga" class="form-control" required style="text-align: right;" readonly value="Rp. <?=number_format($kamar['harga'], 0, ',', '.');?>">
    </div>
    <div class="form-row">
      <div class="col-md-6 mb-3">
        <label for="validationCustom03">Tanggal Mulai :</label>
        <input type='date' id="tanggal-mulai" name="tanggal-mulai" class="form-control" value="<?=date('Y-m-d');?>" min="<?=date('Y-m-d');?>">
      </div>
      <div class="col-md-6 mb-3">
        <label for="validationCustom03">Tanggal Selesai :</label>
        <input type='date' id="tanggal-selesai" name="tanggal-selesai" class="form-control" value="<?=$jarak_awal;?>" readonly>
      </div>
    </div>
    <div class="form-group">
      <label for="example-time-input" class="col-form-label">Waktu Mulai :</label>
      <input class="form-control" type="time" name="waktu-mulai" value="<?=$waktu_sekarang;?>" id="example-time-input">
      <small><i class="fa fa-info-circle"></i> AM: malam - siang, PM: siang - malam</small>
    </div>
  </div>
  <div class="modal-footer">
    <button id="submit" class="btn btn-primary" type="submit">Booking</button>
    <button id="cancel" type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
  </form>
</fieldset>

<script>
function formatRupiah(angka, prefix){
  var number_string = angka.toString().replace(/[^,\d]/g, '').toString(),
  split   		= number_string.split(','),
  sisa     		= split[0].length % 3,
  rupiah     		= split[0].substr(0, sisa),
  ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if(ribuan){
    separator = sisa ? '.' : '';
    rupiah += separator + ribuan.join('.');
  }
  rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
  return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

function add_months(dt, n)
{
   return new Date(dt.setMonth(dt.getMonth() + n));
}

function pad (str, max) {
  str = str.toString();
  return str.length < max ? pad("0" + str, max) : str;
}

  $(document).ready(function(){
    $('#dtpicker').datetimepicker();

    $('#form-booking').submit(function(e) {
      e.preventDefault();
      var datanya = $(this).serialize();
      $('#field-booking').prop('disabled',true);
      console.log(datanya);
      $.ajax({
        url: "<?=base_url('booking/simpan');?>",
        data: datanya,
        type: "post",
        success: function(data) {
          $('modalSmall').modal('hide');
          swal.fire({
            title: "Success!",
            text: "Booking telah disimpan.",
            icon: "success",
            showConfirmButton: false,
            timer: 1000
          }).then(function() {
            window.location = "booking";
          });
        }
      })
    })

    var harga = <?=$kamar['harga'];?>;

    if($('#judulModal:contains("Edit")').length>0) {
      $('#submit').html('Update');
      $('#cancel').html('Cancel');
    }

    $('input[type="range"]').rangeslider({
        polyfill : false,
        onInit : function() {
            this.output = $( '<div class="range-output" />' ).insertAfter( this.$range ).html( this.$element.val() );
        },
        onSlide : function( position, value ) {
            this.output.html( value );
        }
    });

    $('#booking-bulan').on('input',function(e){
      var tanggalnya = $('#tanggal-mulai').val();
      var arr = tanggalnya.split("-");
      var angka = parseInt($(this).val());
      var tahun = parseInt(arr[0]);
      var bulan = parseInt(arr[1])-1;
      var tanggal = parseInt(arr[2]);
      var dateSrt = new Date(tahun, bulan, tanggal);
      var currentDay = dateSrt.getDate();
      var currentMonth = dateSrt.getMonth();
      dateSrt.setMonth(currentMonth + angka, currentDay);
      var jadi = dateSrt.getFullYear()+"-"+pad(dateSrt.getMonth()+1,2)+"-"+pad(dateSrt.getDate(),2);
      $('#tanggal-selesai').val(jadi);
      $('#total-harga').val(formatRupiah(harga*angka,"Rp. "));
    })

    $('#tanggal-mulai').on('change',function(){
      $('#booking-bulan').trigger('input');
    })
  })
</script>

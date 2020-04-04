<?php
if (!isset($dUser['admin'])) {
    if ($dUser['status']==0) {
        echo "<script>
    $(document).ready(function(){
      $('#modalSmall').modal({'backdrop': 'static','keyboard':false});
      $('.modal-body').load('".base_url('modal/ktp')."');
      $('#judulModal').html('Upload Identitas');
      $('#modal-close').css('display','none');
    })
    </script>";
    }
}
?>

<div class="row mt-3">
  <div class="col-md-3">
    <div class="single-report mb-xs-30">
      <div class="s-report-inner pr--20 pt--30 mb-3">
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
        <div class="s-report-title d-flex justify-content-between">
          <h4 class="header-title mb-0">User Laki-Laki</h4>
        </div>
        <div class="d-flex justify-content-between pb-2">
          <h2><?=$userCowok;?></h2>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="single-report mb-xs-30">
      <div class="s-report-inner pr--20 pt--30 mb-3">
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
        <div class="s-report-title d-flex justify-content-between">
          <h4 class="header-title mb-0">User Perempuan</h4>
        </div>
        <div class="d-flex justify-content-between pb-2">
          <h2><?=$userCewek;?></h2>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="single-report mb-xs-30">
      <div class="s-report-inner pr--20 pt--30 mb-3">
        <div class="icon">
          <i class="fa fa-bed"></i>
        </div>
        <div class="s-report-title d-flex justify-content-between">
          <h4 class="header-title mb-0">Jumlah Kamar</h4>
        </div>
        <div class="d-flex justify-content-between pb-2">
          <h2><?=$jumlahKamar;?></h2>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="single-report mb-xs-30">
      <div class="s-report-inner pr--20 pt--30 mb-3">
        <div class="icon">
          <i class="fa fa-bed"></i>
        </div>
        <div class="s-report-title d-flex justify-content-between">
          <h4 class="header-title mb-0">Sisa Kamar</h4>
        </div>
        <div class="d-flex justify-content-between pb-2">
          <h2><?=$sisaKamar;?></h2>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <hr>
    <div class="card mt-3">
      <div class="card-header bg-dark text-light">
        <i class="fa fa-phone"></i>
        Kontak Admin
      </div>
      <div class="card-body">
        <?php
        foreach ($admins as $a) {
          echo '<a tabindex="0" class="" role="button" data-toggle="popover" data-trigger="focus" title="" data-content="Email : <a href=\'https://mail.google.com/mail/?view=cm&fs=1&to='.$a['email'].'&su=SUBJECT&body=BODY\' target=\'_blank\'>'.$a['email'].'</a><br>HP / Whatsapp <i class=\'icon-whatsapp\'></i> : <a href=\'https://wa.me/62'.substr($a['no_telp'], 1).'\' target=\'_blank\'>'.$a['no_telp'].'</a>" data-html="true" data-original-title="'.$a['nama'].'" data-placement="bottom"><img src="'.base_url('assets/images/author/'.$a['foto']).'" class="rounded-circle" alt=" Err IMG:'.$a['nama'].'" width="100" height="100"></a>&nbsp;';
        }
        ?>
      </div>
    </div>
  </div>
</div>

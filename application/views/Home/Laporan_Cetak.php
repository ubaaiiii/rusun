<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?= base_url('') ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/font-awesome.min.css">

	<title> Laporan Keuangan </title>
  <style>
    .currency {
     text-align: right;
    }

    .currency:before {
     content: "Rp.";
     float: left;
     padding-right: 4px;
    }
  </style>
</head>
<body>

	<div class="container" id="div_print">
		<div class="content">
			<div class="col-lg-12">
				<center>
					<h2><?=$setting['nama'];?></h2>
					<h4>Laporan Keuangan Periode: <?=$periode;?></h4>
					<h6><i class="fa fa-home"></i> Alamat : <?= $setting['alamat'] ?><br><i class="fa fa-phone"></i> Kontak : <?= $setting['no_telp'] ?>, </h6>
				</center>
				<hr>
				<table class="table table-hover table-bordered" align="center">
					<thead>
						<tr>
							<th>No</th>
              <th>Kode Booking</th>
							<th>Tgl. Booking</th>
							<th>Tgl. Selesai</th>
							<th>Kamar</th>
							<th>Nama</th>
							<th>Pembayaran</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1;foreach ($datanya as $key): ?>
							<tr>
                <td align="center"><?=$no++;?></td>
                <td align="center"><?=$key['booking'];?></td>
                <td align="center"><?=$key['tanggal_booking'];?></td>
                <td align="center"><?=$key['tanggal_selesai'];?></td>
                <td align="center"><?=$key['kamar'];?></td>
                <td><?=ucwords($key['nama']);?></td>
                <td class="currency"><?=number_format($key['uang'], 2, ',', '.');?></td>
							</tr>
						<?php endforeach ?>
            <tr>
              <td colspan=6 align="right"><b>TOTAL</b></td>
              <td class="currency"><?=number_format($total['uang'], 2, ',', '.');?></td>
            </tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>



	<script>
		function printDiv(divName) {
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;

			window.print();

			document.body.innerHTML = originalContents;
		}
		printDiv('div_print');
	</script>
</body>
</html>

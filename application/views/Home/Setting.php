<style>
.btn-file{position:relative;overflow:hidden}.btn-file input[type=file]{position:absolute;top:0;right:0;min-width:100%;min-height:100%;font-size:100px;text-align:right;opacity:0;outline:0;background:#fff;cursor:inherit;display:block}#img-upload{width:100%}@keyframes blink {50% { color: transparent }}
.loader__dot { animation: 1s blink infinite }
.loader__dot:nth-child(2) { animation-delay: 300ms }
.loader__dot:nth-child(3) { animation-delay: 700ms }
</style>
<div class="row">
	<div class="col-lg-3">
		<div class="card mt-3">
			<div class="card-header bg-dark text-light">
				<h4>
					<i class="fa fa-photo"></i>
					Logo</h4>
				</div>
				<div class="card-body">
					<fieldset id="field-logo">
						<form id="form-logo" enctype="multipart/form-data">
							<div class="form-group">
								<center>
									<img id="imgInp" src="<?=base_url('assets/images/icon/').$setting['logo'];?>">
								</center>
								<hr>
								<div class="form-group">
									<label>Ubah Logo Aplikasi :</label>
									<input id="fileInp" required="required" type="file" class="form-control" name="foto-logo">
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-danger btn-sm btn-block">Simpan</button>
								</div>
							</div>
						</form>
					</fieldset>
				</div>
			</div>
		</div>
		<div class="col-9">
			<div class="card mt-3">
				<div class="card-header bg-dark text-light">
					<h4><a id="tambah-rekening" href="javascript:void(0);" class="fa fa-plus"></a> Data Rekening</h4>
				</div>
				<div class="card-body">
					<div class="data-tables datatable-dark">
						<table id="table-rekening" class="text-center table-hover">
							<thead class="text-capitalize">
								<tr>
									<th>No</th>
									<th>Rekening</th>
									<th>Atas Nama</th>
									<th>Bank</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card mt-3">
				<div class="card-header bg-dark text-light">
					<h4>
						<i class="fa fa-laptop"></i>
						Data Aplikasi</h4>
					</div>
					<div class="card-body">
						<fieldset id="field-logo">
							<form id="form-setting">
								<div class="form-row">
									<div class="col-md-4 mb-3">
										<label>Nama :
										</label>
										<input required="required" type="text" name="nama" class="form-control" value="<?=$setting['nama'];?>">
									</div>
									<div class="col-md-4 mb-3">
										<label>Nomor Telpon :
										</label>
										<input required="required" type="tel" name="no_telp" class="form-control" pattern="[0-9]*" value="<?=$setting['no_telp'];?>">
									</div>
									<div class="col-md-4 mb-3">
										<label>Alamat Email :
										</label>
										<input required="required" type="email" name="email" class="form-control" value="<?=$setting['email'];?>">
									</div>
								</div>
								<div class="form-group">
									<label>Alamat :
									</label>
									<textarea class="form-control" rows="2" name="alamat" required=""><?=$setting['alamat'];?></textarea>
								</div>
								<div class="form-group">
									<label>Deskripsi :
									</label>
									<textarea class="form-control" rows="5" name="deskripsi" required=""><?=$setting['deskripsi'];?></textarea>
								</div>
								<div class="form-group">
									<button class="btn btn-info btn-sm pull-right" type="submit">
										<i class="fa fa-save"></i>
										Update</button>
									</div>
								</form>
							</fieldset>
						</div>
					</div>
				</div>
			</div>

			<script>
			$(document).ready(function () {
				var tabel_rekening = $('#table-rekening').DataTable({
					responsive: true,
					autoWidth: false,
					aLengthMenu: [[5, 10, 50, -1], [5, 10, 50, "All"]],
					ajax:{
						url: "<?=base_url('setting/DataRekening');?>",
						type:"POST",
						dataSrc: ""
					},
					columns:[
						{data:"id"},
						{data:"no_rek"},
						{data:"nama"},
						{data:"bank"},
						{data:"id",render: function(data,type,row,meta){
							return `<ul class="d-flex justify-content-center">
							<li class="mr-3"><a id="edit-rekening" href="javascript:void(0);" class="edit-rekening fa fa-edit text-primary" data-id="`+data+`"></a></li>
							<li><a href="javascript:void(0)" onclick="hapusRekening(`+data+`,'`+row.nama+`')" class="ti-trash hapus-rekening text-danger"></a></li>
							</ul>`;
						}}
					],
					"columnDefs": [ {
						"searchable": false,
						"orderable": false,
						"targets": 0
					},{
						"searchable": false,
						"orderable": false,
						"targets": 4
					} ],
					"order": [[ 1, 'asc' ]]
				});

				$('#table-rekening tbody').on( 'click', '.edit-rekening', function () {
					var id = $(this).attr('data-id');
					$('#modalSmall').modal('show');
					$('#judulModal').html('Ubah Rekening');
					$('.modal-body').load('<?=base_url('modal/rekening/');?>'+id);
				});

				tabel_rekening.on( 'order.dt search.dt', function () {
					tabel_rekening.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
						cell.innerHTML = i+1;
					});
				}).draw();

					$('#tambah-rekening').click(function(){
					$('#modalSmall').modal('show');
					$('#judulModal').html('Tambah Rekening');
					$('.modal-body').load('<?=base_url('modal/rekening');?>');
				});

				function readURL(input) {
					if (input.files && input.files[0]) {
						var reader = new FileReader();
						reader.onload = function (e) {
							$('#imgInp').attr('src', e.target.result);
						}
						reader.readAsDataURL(input.files[0]);
					}
				}

				$("#fileInp").change(function () {
					readURL(this);
				});
			})
		</script>

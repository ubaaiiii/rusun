<style>
.container{position:relative;width:100%;max-width:400px}.image{width:350px;height:350px;object-fit:cover;border-radius:50%}.overlay{position:absolute;top:0;bottom:0;left:0;right:0;height:100%;width:100%;opacity:0;transition:.3s ease}.container:hover .overlay{opacity:1}.icon{color:#fff;position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);text-align:center}.btn-file{position:relative;overflow:hidden}.btn-file input[type=file]{position:absolute;top:0;right:0;min-width:100%;min-height:100%;font-size:100px;text-align:right;opacity:0;outline:0;background:#fff;cursor:inherit;display:block}#img-upload{width:100%}@keyframes blink{50%{color:transparent}}.loader__dot{animation:1s blink infinite}.loader__dot:nth-child(2){animation-delay:300ms}.loader__dot:nth-child(3){animation-delay:700ms}
</style>
<div class="row">
	<div class="col-lg-4">
		<?php

		if(!isset($dUser['admin'])){
			?>
			<div class="card mt-3">
				<div class="card-header bg-dark text-light">
					<h4><i class="fa fa-image"></i> Kartu Identitas</h4>
				</div>
				<div class="card-body">
					<div class="form-group">
						<center>
							<img src="<?=base_url('assets/images/ktp/').$dUser['ktp'];?>">
						</center>
					</div>
				</div>
			</div>
			<hr>
			<?php
		}

		?>
		<div class="card mt-3">
			<div class="card-header bg-dark text-light">
				<h4><i class="fa fa-photo"></i> Foto</h4>
			</div>
			<div class="card-body">
				<form id="form-foto" enctype="multipart/form-data">
					<label for="fileInp" class="container">
						<center>
							<img id="imgInp" class="image" src="<?=(isset($dUser['admin']))?(base_url('assets/images/author/').$dUser['foto']):(base_url('assets/images/users/').$dUser['foto']);?>">
						</center>
						<div class="overlay">
							<i class="fa fa-edit fa-3x"></i>
						</div>
					</label>
					<input id="fileInp" required type="file" class="form-control" name="foto_profile" style="display:none;">
					<hr>
					<div id="button-update-foto" class="form-group" style="display:none;">
						<button id="submit-foto" type="submit" class="btn btn-danger btn-sm btn-block">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="card mt-3">
			<div class="card-header bg-dark text-light">
				<h4><i class="fa fa-user"></i> Biodata</h4>
			</div>
			<div class="card-body">
				<form id="form-biodata">
					<input type="text" hidden id="role" name="role" value="<?=(!isset($dUser['admin']))?('user'):('admin');?>">
					<?php
					if(!isset($dUser['admin'])){
						?>
						<div class="form-group">
							<label>NIK : </label>
							<input required type="number" name="nik" class="form-control" value="<?=$dUser['nik'];?>">
						</div>
					<?php } ?>
					<input required type="number" name="id" hidden class="form-control" value="<?=(isset($dUser['admin']))?($dUser['id']):($dUser['nik']);?>">
					<div class="form-group">
						<label>Nama : </label>
						<input required type="text" name="nama" class="form-control text-capitalize" value="<?=$dUser['nama'];?>">
					</div>
					<div class="form-group">
						<label>Email : </label>
						<input required type="email" name="email" class="form-control" value="<?=$dUser['email'];?>">
					</div>
					<div class="form-group">
						<label>Nomor Telepon : </label>
						<input required type="tel" name="no_telp" class="form-control" pattern="[0-9]*" value="<?=$dUser['no_telp'];?>">
					</div>
					<?php

					if(!isset($dUser['admin'])){
						?>
						<div class="form-group">
							<label>Jenis Kelamin : <br><?=($dUser['gender']==1)?('Laki - Laki'):('Perempuan');?></label>
						</div>
						<div class="form-group">
							<label>Alamat : </label>
							<textarea class="form-control" name="alamat" required=""><?=$dUser['alamat'];?></textarea>
						</div>
						<?php
					}

					?>
					<div class="form-group">
						<button class="btn btn-info btn-sm pull-right" type="submit" id="bio-submit" style="display:none;"><i class="fa fa-save"></i> Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="card mt-3">
			<div class="card-header bg-dark text-light">
				<h4><i class="fa fa-user"></i> Ubah Password</h4>
			</div>
			<div class="card-body">
				<form id="form-password">
					<div class="form-group">
						<label>Password Lama : <i id="shaa"></i></label>
						<div class="input-group">
							<input required type="password" name="psLama" id="psLama" class="form-control" value="" tabindex="1">
							<input type="text" name="id" class="form-control" value="<?=(isset($dUser['admin']))?($dUser['id']):($dUser['nik']);?>" hidden>
							<input type="text" name="role" class="form-control" value="<?=(isset($dUser['admin']))?('admin'):('users');?>" hidden>
							<div class="input-group-append">
								<button id="togPsLama" type="button" class="input-group-text fa fa-eye"></button>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Password Baru : </label>
						<div class="input-group">
							<input required type="password" name="psBaru" id="psBaru" class="form-control" value="" tabindex="2">
							<div class="input-group-append">
								<button id="togPsBaru" type="button" class="input-group-text fa fa-eye"></button>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Ulangi Password Baru : </label>
						<input required type="password" id="psBaru2" class="form-control" value="" tabindex="3">
						<div id="valid-pass" class="invalid-feedback">
							Password tidak cocok.
						</div>
					</div>
					<div class="form-group">
						<button class="btn btn-info btn-sm pull-right" type="submit" id="password-submit" style="display:none;" tabindex="4"><i class="fa fa-save"></i> Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){

		$('#togPsLama').click(function(){
			$(this).toggleClass('fa-eye fa-eye-slash');
			var x = document.getElementById('psLama');
			if (x.type === "password") {
				x.type = "text";
			} else {
				x.type = "password";
			}
		})

		$('#togPsBaru').click(function(){
			$(this).toggleClass('fa-eye fa-eye-slash');
			var x = document.getElementById('psBaru');
			var y = document.getElementById('psBaru2');
			if (x.type === "password") {
				x.type = "text";
				y.type = "text";
			} else {
				x.type = "password";
				y.type = "password";
			}
		})

		$('#form-biodata input').keyup(function(){
			if (!$(this).val()) {
				$('#bio-submit').css('display','none');
			} else {
				$('#bio-submit').removeAttr('style');
			}
		})

		$("#form-password input").keyup(function() {
			$("#form-password input").each(function() {
				if ($('#psLama').val() === "" || $('#psBaru').val() === "" || $('#psBaru2').val() === "") {
					// console.log('kosong');
					$('#password-submit').css('display','none');
					$('#valid-pass').css('display','none');
				} else {
					// console.log($('#psBaru').val().length);
					if ($('#psBaru').val() == $('#psBaru2').val()) {
						if ($('#psBaru').val().length < 4) {
							$('#password-submit').css('display','none');
							$('#valid-pass').addClass('d-block');
							$('#valid-pass').html('Setidaknya password mengandung 4 karakter atau lebih.');
						} else {
							$('#password-submit').removeAttr('style');
							$('#valid-pass').removeClass('d-block');
						}
					} else {
						$('#password-submit').css('display','none');
						$('#valid-pass').html('Password tidak cocok.');
						$('#valid-pass').addClass('d-block');
					}
				}
			});
		});

		$('#form-biodata').submit(function(e){
			e.preventDefault();
			var datanya = $(this).serialize();
			// console.log(datanya);
			$.ajax({
				url: '<?=base_url('users/ubah_bio');?>',
				data: datanya,
				type: 'post',
				success: function(data) {
					if (data=="true") {
						swal.fire({
							title: "Success!",
							text: "Biodata telah terganti.",
							footer: "Halaman Akan Refresh Untuk Update Sesi Login <span class=\"loader__dot\">. </span><span class=\"loader__dot\">. </span><span class=\"loader__dot\">.</span>",
							icon: "success"
						}).then(function() {
							window.location = "<?=base_url('home/profile');?>";
						});
					} else {
						swal.fire({
							title: "Error!",
							text: "Gagal update biodata.",
							icon: "error",
							showConfirmButton: false,
							timer: 1000
						});
					}
				}
			})
		})

		$('#form-password').submit(function(e){
			e.preventDefault();
			var datanya = $(this).serialize();
			// console.log(datanya);
			$.ajax({
				url: '<?=base_url('users/ubah_password');?>',
				data: datanya,
				type: 'post',
				success: function(data) {
					console.log(data);
					if (data=="wrong") {
						$('#psLama').select();
						swal.fire({
							title: "Error!",
							text: "Password lama salah.",
							icon: "error",
							showConfirmButton: false,
							timer: 1000
						});
					} else {
						swal.fire({
							title: "Success!",
							text: "Password telah terganti.",
							footer: "Halaman Akan Refresh Untuk Update Sesi Login <span class=\"loader__dot\">. </span><span class=\"loader__dot\">. </span><span class=\"loader__dot\">.</span>",
							icon: "success"
						}).then(function() {
							window.location = "<?=base_url('home/profile');?>";
						});
					}
				}
			})
		});

		$('#form-foto').submit(function(e){
			e.preventDefault();
			$('#submit-foto').prop('disabled', true);
			$('#submit-foto').html('<i class="fa fa-spinner fa-pulse"></i> Updating <span class="loader__dot">. </span><span class="loader__dot">. </span><span class="loader__dot">.</span>');
			$.ajax({
				url:'<?=base_url("users/foto_profile");?>',
				type:"post",
				data:new FormData(this), //this is formData
				processData:false,
				contentType:false,
				cache:false,
				async:false,
				success: function(data) {
					console.log(data);
					if (data=="true") {
						$('#button-update-foto').css('display','none');
						$('#submit-foto').html('Update');
						swal.fire({
							title: "Success!",
							html: "Berhasil Mengubah Foto Profil.<br>Halaman Akan Refresh Untuk Update Sesi Login <span class=\"loader__dot\">. </span><span class=\"loader__dot\">. </span><span class=\"loader__dot\">.</span>",
							icon: "success",
						}).then(function() {
              window.location = "<?=base_url('home/profile');?>";
            });
					} else {
						$('#submit-foto').prop('disabled', false);
						$('#submit-foto').html('Update');
						Swal.fire(
						'Error!',
						'Gagal Update Foto Profil.',
						'error'
						)
					}
				}
			});
		})

		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
					$('#imgInp').attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			}
		}

		$("#fileInp").change(function() {
			if ($(this).val()) {
				$('#button-update-foto').removeAttr('style');
			} else {
				$('#button-update-foto').css('display','none');
			}
			readURL(this);
		});
	})
</script>

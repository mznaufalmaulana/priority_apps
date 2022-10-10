<div class="container">

	<!-- Outer Row -->
	<div class="row justify-content-center">

		<div class="col-xl-10 col-lg-12 col-md-9">

			<div class="card o-hidden border-0 shadow-lg my-5">
				<div class="card-body p-0">
					<!-- Nested Row within Card Body -->
					<div class="row">
						<div class="col-lg-3"></div>
						<div class="col-lg-6">
							<div class="p-5">
								<div class="text-center">
									<img src="<?= BASE_THEME . 'images/icon/logo.png' ?>" alt="logo" style="width: 80%; padding-bottom: 20px;">
								</div>
								<?= $this->session->flashdata('message') ?>
								<form action="<?= BASE_URL . 'auth/' ?>" method="post" class="user">
									<div class="form-group">
										<input type="text" class="form-control form-control-user" name="username" id="username" placeholder="Masukkan Username..." autofocus>
										<?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
									</div>
									<div class="form-group">
										<input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Masukkan Katasandi..." value="password">
										<?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?>
									</div>
									<button type="submit" class="btn btn-primary btn-user btn-block">
										Masuk
									</button>
								</form>
								<div class="text-center">
									<a class="small" href="<?= BASE_URL . 'auth/register' ?>">Buat Akun Baru!</a>
								</div>
							</div>
						</div>
						<div class="col-lg-3"></div>
					</div>
				</div>
			</div>

		</div>

	</div>

</div>

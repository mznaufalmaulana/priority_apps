<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-3"></div>
          <div class="col-lg-6">
            <div class="p-5">
              <div class="text-center">
                <img src="<?= BASE_THEME.'images/icon/logo.png'?>" alt="logo" style="width: 80%; padding-bottom: 20px;">
              </div>
              <form class="user" action="<?= BASE_URL.'auth/register' ?>" method="post">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name="nama_depan" class="form-control form-control-user" id="exampleFirstName" placeholder="Nama Depan" value="<?= set_value('nama_depan') ?>">
                    <?= form_error('nama_depan', '<small class="text-danger pl-3">', '</small>') ?>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" name="nama_belakang" class="form-control form-control-user" id="exampleLastName" placeholder="Nama Belakang" value="<?= set_value('nama_belakang') ?>">
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" name="username" class="form-control form-control-user" id="exampleInputEmail" placeholder="Username" value="<?= set_value('username') ?>">
                  <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Alamat Email" value="<?= set_value('email') ?>">
                  <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" name="password1" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>') ?>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" name="password2" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password">
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Daftar
                </button>
              </form>
              <div class="text-center">
                <a class="small" href="forgot-password.html">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="<?= BASE_URL.'auth' ?>">Already have an account? Login!</a>
              </div>
            </div>
          </div>
          <div class="col-lg-3"></div>
        </div>
      </div>
    </div>

  </div>
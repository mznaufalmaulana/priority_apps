<div class="container-fluid">
    <div class="row">
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4" style="padding:20px">
                <div class="text-center">
                    <img class="img-profile-lg rounded-circle" src="<?= BASE_THEME . 'images/icon/user.png' ?>">
                    <h4><span style="font-weight:bold"><?= $user['nama_belakang'] ?></span>, <?= $user['nama_depan'] ?></h4>
                    <span><?= $user['email'] ?></span><br>
                    <span><?= $user['username'] ?></span>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4" style="padding:20px">
                <div class="">
                    <form action="<?= BASE_URL . 'auth/edit_profil' ?>" method="post">
                        <div class="row form-group">
                            <div class="col-md-3">
                                <label for="nama_depan" class="form-control-label" style="float:right;">Nama Depan</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="nama_depan" name="nama_depan" class="form-control" placeholder="Masukkan Nama Depan ANda" value="<?= $user['nama_depan'] ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-3">
                                <label for="nama_belakang" class="form-control-label" style="float:right;">Nama Belakang</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="nama_belakang" name="nama_belakang" placeholder="Masukkan Nama Belakang Anda" class="form-control" value="<?= $user['nama_belakang'] ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-3">
                                <label for="description" class="form-control-label" style="float:right;">Kata Sandi</label>
                            </div>
                            <div class="col-md-9">
                                <input type="password" id="password" name="password" placeholder="Masukkan Kata Sandi Anda" class="form-control">
                                <?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                        </div>
                        <hr>
                        <div style="float:right;">
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
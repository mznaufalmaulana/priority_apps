<div class="container-fluid">
    <div class="row">
        <div class="col-xl-4 col-lg-3"></div>
        <div class="col-xl-4 col-lg-6">
            <div class="card shadow mb-4" style="padding:20px">
                <div class="text-center">
                    <img class="img-profile-lg rounded-circle" src="<?= BASE_THEME . 'images/icon/user.png' ?>">
                    <h4><span style="font-weight:bold"><?= $user['nama_belakang'] ?></span>, <?= $user['nama_depan'] ?></h4>
                    <span><?= $user['email'] ?></span><br>
                    <span><?= $user['username'] ?></span>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-3"></div>
    </div>
    <div class="row">
        <div class="col-xl-1 col-lg-1"></div>
        <div class="col-xl-10 col-lg-10">
            <div class="card shadow mb-4" style="padding:20px">
                <h3>Daftar Proyek Anda</h3>
                <hr>
                <?php foreach ($proyek as $value) { ?>
                    <b><?= $value->nama_proyek ?><br></b>
                    <?= TanggalIndonesia($value->tgl_proyek) ?>
                    <hr>
                <?php } ?>
            </div>
        </div>
        <div class="col-xl-1 col-lg-1"></div>
    </div>
</div>
</div>
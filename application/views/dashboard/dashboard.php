<div class="container-fluid">
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4" style="padding:40px">
                <h2>Selamat Datang, <span style="font-weight:bold"><?= $user['nama_depan'] ?> <?= $user['nama_belakang'] ?></span></h2>
                <p> <span style="font-weight:bold">Priority Apps</span> merupakan sistem penentu prioritas kebutuhan dalam proses pembangunan sebuah perangkat lunak. Sistem ini dibangun menggunakan metode <span style="font-weight:bold">Algoritme Genetik</span> dalam penentuan urutan prioritas kebutuhan.</p>
            </div>
        </div>
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4" style="padding:20px">
                <div class="text-center">
                    <img class="img-profile-lg rounded-circle" src="<?= BASE_THEME . 'images/icon/user.png' ?>">
                    <h4><span style="font-weight:bold"><?= $user['nama_belakang'] ?></span>, <?= $user['nama_depan'] ?></h4>
                    <span><?= $user['email'] ?></span>
                    <span><?= $user['username'] ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
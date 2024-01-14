<div class="container-fluid">
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4" style="padding:40px">
                <h2>Selamat Datang, <span style="font-weight:bold"><?= $user['first_name'] ?> <?= $user['last_name'] ?></span></h2>
                <p>Ini merupakan sistem CMS untuk mengatur konten pada <a href="http://redanis.id" target="_blank">redanis.id</a></p>
            </div>
        </div>
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4" style="padding:20px">
                <div class="text-center">
                    <img class="img-profile-lg rounded-circle" src="<?= BASE_THEME . 'images/icon/user.png' ?>">
                    <h4><span style="font-weight:bold"><?= $user['last_name'] ?></span>, <?= $user['first_name'] ?></h4>
                    <span><?= $user['email'] ?></span>
                    <span><?= $user['username'] ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

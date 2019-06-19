<div class="container-fluid">

    <div class="card mb-4">
        <div class="card-header">
            Masukkan Detail Proyek
        </div>
        <div class="card-body">
            <form action="<?= BASE_URL . 'project/' ?>" method="post">
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="id_project" class="form-control-label">Kode Proyek</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="id_project1" name="id_project1" class="form-control" value="<?= 'PA' . date("Ymdhis") ?>" disabled>
                        <input type="text" id="id_project" name="id_project" class="form-control" value="<?= 'PA' . date("Ymdhis") ?>" hidden>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="title" class="form-control-label">Nama Proyek</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="title" name="title" placeholder="Masukkan Nama Proyek" class="form-control">
                        <?= form_error('title', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="description" class="form-control-label">Deskripsi</label>
                    </div>
                    <div class="col-md-9">
                        <textarea name="description" id="description" rows="5" placeholder="Masukkan Detail Proyek" class="form-control"></textarea>
                        <?= form_error('description', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
                <hr>
                <div style="float:right;">
                    <button type="submit" class="btn btn-primary">
                        Buat Proyek
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
</div>
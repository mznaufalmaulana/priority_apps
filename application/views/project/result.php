<?php
$id_proyek = $this->uri->segment(3, 0);
$kebutuhan = explode('-', $data_proyek['prioritas']);
?>
<div class="container-fluid">

    <div class="card mb-4">
        <div class="card-header">
            Hasil Perhitungan Proyek
        </div>
        <div class="card-body">
            <h2><?= $data_proyek['nama_proyek'] ?></h2>
            <h5><?= $data_proyek['id_proyek'] ?></h5>
            <p><?= $data_proyek['deskripsi_proyek'] ?></p>
            <input type="text" value="<?= $data_proyek['id_proyek'] ?>" id="id_proyek" hidden>
            <div class="row">
                <div class="col col-md-12">
                    <div class="table-responsive table--no-card m-b-30 project-list">
                        <table class="table table-border table-earning">
                            <thead>
                                <tr>
                                    <th style="width:10px;">No</th>
                                    <th class="text-center" style="width:200px;">Nomor Kebutuhan</th>
                                    <th>Kalimat Kebutuhan</th>
                                    <th class="text-center" style="width:200px;">Pemilik Kebutuhan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 0;
                                for ($i = 0; $i < count($kebutuhan) - 1; $i++) {
                                    $no++;
                                    $this->db->select('*');
                                    $this->db->from('data_kebutuhan');
                                    $this->db->where('id_proyek', $id_proyek);
                                    $this->db->where('id_kebutuhan', $kebutuhan[$i]);
                                    $data_kebutuhan = $this->db->get()->result();
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $no ?></td>
                                        <td class="text-center">SRS-F-<?= $no ?></td>
                                        <?php foreach ($data_kebutuhan as $value) { ?>
                                            <td><?= $value->kalimat_kebutuhan ?></td>
                                            <td class="text-center"><?= $value->pemilik ?></td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div style="float:right;">
                <a href="<?= BASE_URL . 'project/result_voting' ?>" class="btn btn-danger">
                    Kembali
                </a>
            </div>
        </div>
    </div>

</div>
</div>

<div id="loader"></div>

<script>
    var loading = document.getElementById('loader');

    window.addEventListener('load', function() {
        loading.style.display = "none";
    });
</script>
<?php
$id = $this->session->userdata('id');
$this->db->select('*');
$this->db->from('data_proyek');
$this->db->where('id_user', $id);
$this->db->order_by("tgl_proyek", "desc");
$data_proyek = $this->db->get()->result();
?>
<div class="container-fluid">
    <table class="table table-hover table-responsive">
        <thead>
            <tr>
                <th scope="col" style="width: 5%;">No.</th>
                <th scope="col" style="width: 20%;">Nama Proyek</th>
                <th scope="col" style="width: 15%;">Tanggal Pembuatan</th>
                <th scope="col" style="width: 30%;">Deskripsi Proyek</th>
                <th scope="col" style="width: 30%">Action</th>
            </tr>
        </thead>
        <tbody id="showDataProject">
            <?php
            $no = 0;
            foreach ($data_proyek as $val) {
                if ($val->prioritas == '') {
                    $no++;
                    ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $val->nama_proyek ?></td>
                        <td><?= TanggalIndonesia($val->tgl_proyek) ?></td>
                        <td><?= substr($val->deskripsi_proyek, 0, 90) . '...'  ?></td>
                        <td>
                            <a href="<?= BASE_URL . 'project/voting/' . $val->id_proyek ?>" class="btn btn-primary btn-sm">
                                <!-- Hitung Proyek -->
								Voting Proyek
                            </a>
                            <button id="hapus_proyek" class="btn btn-danger btn-sm" onclick="hapus_temp_proyek('<?= $val->id_proyek ?>')">
                                Hapus
                            </button>
                        </td>
                    </tr>
                <?php }
        } ?>
        </tbody>
    </table>
</div>
</div>

<!-- modal hapus -->
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Proyek</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Apakah Anda Yakin?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger" id="btn-delete">Hapus</button>
            </div>
        </div>
    </div>
</div>

<script>
    function hapus_temp_proyek(id_proyek) {
        var id_proyek = id_proyek;
        $('#hapusModal').modal('show');

        $('#btn-delete').unbind().click(function() {
            $.ajax({
                url: '<?= BASE_URL . 'project/delete_project' ?>',
                method: 'POST',
                data: {
                    id_proyek: id_proyek
                },
                dataType: 'JSON',
                success: function(data) {
                    location.reload();
                }
            });
        });
    }
</script>

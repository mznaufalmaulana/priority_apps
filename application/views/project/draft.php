<?php
$id = $this->session->userdata('id');
$this->db->select('*');
$this->db->from('temp_data_proyek');
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
                $no++;
                ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $val->nama_proyek ?></td>
                    <td><?= TanggalIndonesia($val->tgl_proyek) ?></td>
                    <td><?= substr($val->deskripsi_proyek, 0, 90) . '...'  ?></td>
                    <td>
                        <button onclick="edit_proyek('<?= $val->id_proyek ?>')" class="btn btn-success btn-sm">
                            Edit
                        </button>
                        <a href="<?= BASE_URL . 'project/edit_project/' . $val->id_proyek ?>" class="btn btn-primary btn-sm">
                            Tambah Kebutuhan
                        </a>
                        <button id="hapus_proyek" class="btn btn-danger btn-sm" onclick="hapus_temp_proyek('<?= $val->id_proyek ?>')">
                            Hapus
                        </button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
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

<!-- modal edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Proyek</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="alert alert-danger" id="pesan" role="alert" style="display:none; margin:15px;"> </div>
            <form action="<?= BASE_URL . 'project/save_data_edit' ?>" method="POST">
                <div class="modal-body">
                    <input type="text" id="id_proyek" name="id_proyek" class="form-control" hidden>
                    <input type="text" id="title" name="title" placeholder="Masukkan Nama Proyek" class="form-control"><br>
                    <textarea name="description" id="description" rows="5" placeholder="Masukkan Detail Proyek" class="form-control"></textarea>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button type="Submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<script>
    function edit_proyek(id_proyek) {
        var id_proyek = id_proyek;
        $.ajax({
            url: '<?= BASE_URL . 'project/get_data_edit' ?>',
            method: 'POST',
            data: {
                id_proyek: id_proyek
            },
            dataType: 'JSON',
            success: function(data) {
                $('[name="id_proyek"]').val(data.id_proyek);
                $('[name="title"]').val(data.nama_proyek);
                $('[name="description"]').val(data.deskripsi_proyek);

                $('#editModal').modal('show');
            }
        });
    }

    function simpan_temp_proyek() {
        var id_proyek = $('#id_project').val();
        var nama_proyek = $('#title').val();
        var deskripsi_proyek = $('#description').val();

        if (deskripsi_proyek == '' || nama_proyek == '') {
            $('#pesan').html('Field Tidak Boleh Kosong').fadeIn().delay(1000).fadeOut('slow');
            document.getElementById('pesan').style.display = 'block';
        } else {
            $.ajax({
                url: '<?= BASE_URL . 'project/save_data_edit' ?>',
                method: 'POST',
                data: {
                    id_proyek: id_proyek,
                    nama_proyek: nama_proyek,
                    deskripsi_proyek: deskripsi_proyek
                },
                dataType: 'JSON',
                success: function(data) {
                    location.reload();
                }
            });
        }
    }

    function hapus_temp_proyek(id_proyek) {
        var id_proyek = id_proyek;
        $('#hapusModal').modal('show');

        // if ($('#btn-delete').on('click')) {}
        $('#btn-delete').unbind().click(function() {
            $.ajax({
                url: '<?= BASE_URL . 'project/delete_temp_project' ?>',
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
<?php
// require_once('application/views/templates/script.php');
$id_proyek = $this->uri->segment(3, 0);
$id = $this->session->userdata('id');
$data_proyek = $this->db->get_where('temp_data_proyek', ['id_proyek' => $id_proyek])->row_array();

$this->db->select('*');
$this->db->from('temp_data_kebutuhan');
$this->db->where('id_proyek', $id_proyek);
$data_kebutuhan = $this->db->get()->result();
?>

<div class="container-fluid">

    <div class="card mb-4">
        <div class="card-header">
            Masukkan Kebutuhan Proyek
        </div>
        <div class="card-body">
            <h2><?= $data_proyek['nama_proyek'] ?></h2>
            <h5><?= $id_proyek ?></h5>
            <p><?= $data_proyek['deskripsi_proyek'] ?></p>
            <form action="" method="post">
                <div class="row form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="id_project" name="id_project" class="form-control" value="<?= $id_proyek ?>" hidden>
                    </div>
                </div>
                <hr>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="pemilik" class=" form-control-label">Pemilik Kebutuhan</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" id="pemilik" name="pemilik" placeholder="Masukkan Pemilik Kebutuhan" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="kebutuhan" class=" form-control-label">Kalimat Kebutuhan</label>
                    </div>
                    <div class="col-12 col-md-8">
                        <textarea id="kebutuhan" name="kebutuhan" placeholder="Masukkan Detail Kebutuhan" class="form-control" rows="5"></textarea><br>
                        <p class="keterangan" style="margin-top:-20px; font-size: 10px; font-style:italic;">*) masukkan kebutuhan anda dan tekan tombol tambah</p>
                    </div>
                    <div class="col-12 col-md-1">
                        <button class="btn btn-primary" type="submit" onclick="add_req()">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col col-md-12">
                    <div class="table-responsive table--no-card m-b-30 project-list">
                        <table class="table table-borderless table-striped table-earning">
                            <thead>
                                <tr>
                                    <th style="width:10px;">No</th>
                                    <th>Kalimat Kebutuhan</th>
                                    <th>Pemilik Kebutuhan</th>
                                    <th style="width:120px;">Action</th>
                                </tr>
                            </thead>
                            <tbody id="data_kebutuhan">
                                <?php
                                $no = 0;
                                foreach ($data_kebutuhan as $val) {
                                    $no++;
                                    ?>
                                    <tr>
                                        <td align="center"><?= $no ?></td>
                                        <td><?= $val->kalimat_kebutuhan ?></td>
                                        <td><?= $val->pemilik ?></td>
                                        <td>
                                            <button class="btn btn-success btn-sm" onclick="edit_kebutuhan('<?= $val->id_kebutuhan ?>')">
                                                <i class="fa fa-pen"></i>
                                            </button>
                                            <button class="btn btn-danger btn-sm" onclick="hapus_kebutuhan('<?= $val->id_kebutuhan ?>')">
                                                <i class=" fa fa-trash"></i>
                                            </button>
                                        </td>
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
                <a href="<?= BASE_URL . 'project/draft' ?>" class="btn btn-danger">
                    Kembali
                </a>
                <button class="btn btn-primary" onclick="simpan_project()">
                    Simpan
                </button>
            </div>
        </div>
    </div>

</div>

<!-- modal hapus -->
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Kebutuhan</h5>
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
                <h5 class="modal-title" id="exampleModalLabel">Edit Kebutuhan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="alert alert-danger" id="pesan" role="alert" style="display:none; margin:15px;"> </div>
            <form action="<?= BASE_URL . 'project/save_data_edit_req' ?>" method="POST">
                <div class="modal-body">
                    <input type="text" id="id_proyek" name="id_proyek" class="form-control" hidden>
                    <input type="text" id="id_kebutuhan" name="id_kebutuhan" class="form-control" hidden>
                    <input type="text" id="pemilik" name="pemilik" placeholder="Masukkan Nama Proyek" class="form-control"><br>
                    <textarea name="kebutuhan" id="kebutuhan" rows="5" placeholder="Masukkan Detail Proyek" class="form-control"></textarea>
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

<!-- modal simpan -->
<div class="modal fade" id="simpanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Kebutuhan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= BASE_URL . 'project/save_data_project' ?>" method="POST">
                <div class="modal-body">
                    <input type="text" id="id_proyek" name="id_proyek" class="form-control" value="<?= $id_proyek ?>" hidden>
                    <input type="text" id="nama_proyek" name="nama_proyek" placeholder="Masukkan Nama Proyek" class="form-control" value="<?= $data_proyek['nama_proyek'] ?>" hidden><br>
                    <textarea name="deskripsi" id="deskripsi" rows="5" placeholder="Masukkan Detail Proyek" class="form-control" hidden><?= $data_proyek['deskripsi_proyek'] ?></textarea>

                    <p>Simpan dan Lakukan Perhitungan Sekarang?</p>
                </div>
                <div class="modal-footer">
                    <a href="<?= BASE_URL . 'project/draft' ?>" class="btn btn-warning">Nanti</a>
                    <button type="Submit" class="btn btn-primary">Ya, Lakukan Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal eror -->
<div class="modal fade" id="erorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Error</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= BASE_URL . 'project/save_data_project' ?>" method="POST">
                <div class="modal-body">
                    <p>Data Tidak Boleh Kosong!</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function add_req() {
        var id_proyek = $('#id_project').val();
        var pemilik = $('#pemilik').val();
        var kebutuhan = $('#kebutuhan').val();

        if (pemilik == '' || kebutuhan == '') {
            alert('Data Tidak Boleh Kosong!');
            // $('#erorModal').modal('show');
        } else {
            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?= BASE_URL . 'Project/Insert_Temp_Req' ?>',
                data: {
                    id_proyek: id_proyek,
                    pemilik: pemilik,
                    kebutuhan: kebutuhan
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    $('#data_kebutuhan').html(data);
                    // alert(data.kalimat_kebutuhan);
                }
            });
        }
    }

    function edit_kebutuhan(id_kebutuhan) {
        var id_kebutuhan = id_kebutuhan;
        var id_proyek = $('#id_project').val();
        $.ajax({
            url: '<?= BASE_URL . 'project/get_data_edit_req' ?>',
            method: 'POST',
            data: {
                id_kebutuhan: id_kebutuhan,
                id_proyek: id_proyek
            },
            dataType: 'JSON',
            success: function(data) {
                $('[name="id_proyek"]').val(data.id_proyek);
                $('[name="id_kebutuhan"]').val(data.id_kebutuhan);
                $('[name="pemilik"]').val(data.pemilik);
                $('[name="kebutuhan"]').val(data.kalimat_kebutuhan);

                $('#editModal').modal('show');
            }
        });
    }

    function hapus_kebutuhan(id_kebutuhan) {
        var id_kebutuhan = id_kebutuhan;
        var id_proyek = $('#id_project').val();
        $('#hapusModal').modal('show');

        // if ($('#btn-delete').on('click')) {}
        $('#btn-delete').unbind().click(function() {
            $.ajax({
                url: '<?= BASE_URL . 'project/delete_req' ?>',
                method: 'POST',
                data: {
                    id_kebutuhan: id_kebutuhan,
                    id_proyek: id_proyek
                },
                dataType: 'JSON',
                success: function(data) {
                    location.reload();
                }
            });
        });
    }

    function simpan_project() {
        $('#simpanModal').modal('show');
    }
</script>
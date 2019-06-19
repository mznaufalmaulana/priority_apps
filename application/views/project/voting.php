<div class="container-fluid">

    <div class="card mb-4">
        <div class="card-header">
            Hitung Proyek
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
                                    <th>Kalimat Kebutuhan</th>
                                    <th class="text-center" style="width:200px;">Pemilik Kebutuhan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 0;
                                foreach ($data_kebutuhan as $val) {
                                    $no++;
                                    ?>
                                    <tr>
                                        <td align="center"><?= $no ?></td>
                                        <td><?= $val->kalimat_kebutuhan ?></td>
                                        <td class="text-center"><?= $val->pemilik ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <hr>
                        <h5 style="color:red">Perhatian</h5>
                        <p>Berikut merupakan beberapa pertanyaan yang harus anda jawab dengan menekan tombol yang telah disediakan. Gunakan tombol <span class="badge badge-success font-weight-bold text-md">Ya</span> apabila kebutuhan tersebut lebih penting, gunakan tombol <span class="badge badge-danger font-weight-bold text-md">Tidak</span> apabila kebutuhan tersebut tidak lebih penting, dan gunakan tombol <span class="badge badge-warning font-weight-bold text-md">Sama</span> apabila kebutuhan tersebut memiliki kepentingan yang sama. </p>
                        <table class="table table-borderbottom table-earning">
                            <thead>
                                <tr>
                                    <th style="width:10px;">No</th>
                                    <th>Deskripsi</th>
                                    <th class="text-center" style="width:260px;">Action</th>
                                </tr>
                            </thead>
                            <tbody id="data_kebutuhan"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div style="float:right;">
                <a href="<?= BASE_URL . 'project/vote' ?>" class="btn btn-danger">
                    Kembali
                </a>
                <button class="btn btn-primary" onclick="hitung('<?= $data_proyek['id_proyek'] ?>')">
                    Hitung
                </button>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="hitungModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hitung Proyek</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Apakah Anda Yakin?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal" style="width:90px">Tidak</button>
                <a href="<?= BASE_URL . 'result/index/' . $data_proyek['id_proyek'] ?>" class="btn btn-primary" id="btn-hitung" style="width:90px">Ya</a>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    $(function() {
        var id_proyek = $('#id_proyek').val();
        $.ajax({
            type: 'ajax',
            url: '<?= BASE_URL . 'project/get_data_voting' ?>',
            async: false,
            data: {
                id_proyek: id_proyek
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i;
                var j;
                var no = 1;
                for (i = 0; i < data.length; i++) {
                    for (j = i; j < data.length; j++) {
                        if (data[i].id_kebutuhan != data[j].id_kebutuhan) {
                            html += '<tr class="' + data[i].id_kebutuhan + '-' + data[j].id_kebutuhan + '">' +
                                '<td align = "center" >' +
                                (no++) + '</td>' +
                                '<td>' +
                                'Apakah <b>' + data[i].kalimat_kebutuhan + '</b> lebih penting daripada <b>' + data[j].kalimat_kebutuhan + '</b> ?' +
                                '</td>' +
                                '<td hidden>' +
                                '<input type="text" id="' + data[i].id_kebutuhan + '-' + data[j].id_kebutuhan + '" >' +
                                '</td>' +
                                '<td class = "text-center">' +
                                '<button id = "ya" class = "btn btn-success btn-sm" style = "width:60px; margin: 3px;" onclick="ya(\'' + data[i].id_kebutuhan + '-' + data[j].id_kebutuhan + '\', \'' + data[j].id_kebutuhan + '-' + data[i].id_kebutuhan + '\')">Ya</button>' +
                                '<button id = "tidak" class = "btn btn-danger btn-sm" style = "width:60px; margin: 3px;" onclick="tidak(\'' + data[i].id_kebutuhan + '-' + data[j].id_kebutuhan + '\', \'' + data[j].id_kebutuhan + '-' + data[i].id_kebutuhan + '\')"> Tidak </button>' +
                                '<button id = "sama" class = "btn btn-warning btn-sm" style = "width:60px; margin: 3px;" onclick="sama(\'' + data[i].id_kebutuhan + '-' + data[j].id_kebutuhan + '\', \'' + data[j].id_kebutuhan + '-' + data[i].id_kebutuhan + '\')"> Sama </button>' +
                                '</td>' +
                                '</tr>';
                        }
                    }
                }
                $('#data_kebutuhan').html(html);
            }
        });
    });

    function ya(id_kebutuhan, id_kebutuhan2) {
        var id_kebutuhan = id_kebutuhan;
        var id_kebutuhan2 = id_kebutuhan2;
        var id_proyek = $('#id_proyek').val();
        var status = 1;
        var status2 = -1;
        $('#' + id_kebutuhan).val('1');
        $.ajax({
            type: 'ajax',
            url: '<?= BASE_URL . 'project/set_data_voting' ?>',
            async: false,
            data: {
                id_proyek: id_proyek,
                id_kebutuhan: id_kebutuhan,
                status: status,
                id_kebutuhan2: id_kebutuhan2,
                status2: status2
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                document.getElementByClassName(id_kebutuhan).style.color = "blue";
            }
        });
    }

    function tidak(id_kebutuhan, id_kebutuhan2) {
        var id_kebutuhan = id_kebutuhan;
        var id_kebutuhan2 = id_kebutuhan2;
        var id_proyek = $('#id_proyek').val();
        var status = -1;
        var status2 = 1;
        $('#' + id_kebutuhan).val('-1');
        $.ajax({
            type: 'ajax',
            url: '<?= BASE_URL . 'project/set_data_voting' ?>',
            async: false,
            data: {
                id_proyek: id_proyek,
                id_kebutuhan: id_kebutuhan,
                status: status,
                id_kebutuhan2: id_kebutuhan2,
                status2: status2
            },
            method: 'post',
            dataType: 'json'
        });
    }

    function sama(id_kebutuhan, id_kebutuhan2) {
        var id_kebutuhan = id_kebutuhan;
        var id_kebutuhan2 = id_kebutuhan2;
        var id_proyek = $('#id_proyek').val();
        var status = 0;
        var status2 = 0;
        $('#' + id_kebutuhan).val('0');
        $.ajax({
            type: 'ajax',
            url: '<?= BASE_URL . 'project/set_data_voting' ?>',
            async: false,
            data: {
                id_proyek: id_proyek,
                id_kebutuhan: id_kebutuhan,
                status: status,
                id_kebutuhan2: id_kebutuhan2,
                status2: status2
            },
            method: 'post',
            dataType: 'json'
        });
    }

    function hitung(id_proyek) {
        var id_proyek = id_proyek;
        $('#hitungModal').modal('show');
    }
</script>
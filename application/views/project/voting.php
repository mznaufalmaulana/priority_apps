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
            <input type="text" id="daftarVoting" hidden>
            <input type="text" id="jumlahVoting" value="<?= $data_voting ?>" hidden>
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
                        <!-- <p>Berikut merupakan beberapa pertanyaan yang harus anda jawab dengan menekan tombol yang telah disediakan. Gunakan tombol <span class="badge badge-success font-weight-bold text-md">Ya</span> apabila kebutuhan tersebut lebih penting, gunakan tombol <span class="badge badge-danger font-weight-bold text-md">Tidak</span> apabila kebutuhan tersebut tidak lebih penting, dan gunakan tombol <span class="badge badge-warning font-weight-bold text-md">Sama</span> apabila kebutuhan tersebut memiliki kepentingan yang sama. </p> -->
						<p>Silahkan pilih jawaban yang sesuai dengan perbandingan antara 2 (dua) kalimat kebutuhan dibawah ini:</p>
                        <table class="table table-borderbottom table-earning">
                            <thead>
                                <tr>
                                    <th style="width:10px;">No</th>
                                    <th>Deskripsi</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php
								$no = 0;
								for ($i=0; $i < count($data_kebutuhan); $i++) { 
									for ($j=$i+1; $j < count($data_kebutuhan); $j++) { 
										$no++;
										$id_jarak = $data_kebutuhan[$i]->id_kebutuhan . '-' . $data_kebutuhan[$j]->id_kebutuhan;
								?>
									<tr 
										class="row-<?= $no ?>"
										<?php 
											foreach($data_voting as $dv) { 
												if ($dv->id_jarak === $id_jarak) {
													echo 'style="background-color: #cacdd6"';
												} 
											}
										?>
									>
										<td><?= $no ?></td>
										<td>Apakah <b><?= $data_kebutuhan[$i]->kalimat_kebutuhan ?></b> lebih penting daripada <b><?= $data_kebutuhan[$j]->kalimat_kebutuhan ?></b> </td>
										<td>
										<select 
											class="form-control select-voting" 
											name="select" 
											data-id="<?= $id_jarak ?>" 
											data-class="row-<?= $no ?>"
										>
											<option value="-1" disabled selected>Pilih Voting</option>
											<?php 
											for ($x=0; $x < count($options); $x++) {
											?>
											<option 
												value='<?= $options[$x]['value'] ?>'
												<?php 
													foreach($data_voting as $dv) { 
														if ($dv->id_jarak === $id_jarak && $options[$x]['value'] === $dv->status) {
															echo 'selected';
														} 
													}
												?>
												> 
													<?= $options[$x]['option'] ?> 
											</option>
											<?php } ?>
										</select>
										</td>
									</tr>
								<?php 
									}
								} 
								?>
							</tbody>
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
                <button class="btn btn-primary" onclick="hitung('<?= $data_proyek['id_proyek'] ?>')" style="display: none;">
                    Hitung
                </button>
                <button class="btn btn-primary" onclick="result('<?= $data_proyek['id_proyek'] ?>')">
					Hasil
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
                <!-- <button class="btn btn-primary" type="button" onclick="result('<?= $data_proyek['id_proyek'] ?>')" style="width:90px">Ya</button> -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="result-ahp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hasil Voting AHP</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal" style="width:90px">Tutup</button>
                <!-- <a href="<?= BASE_URL . 'result/index/' . $data_proyek['id_proyek'] ?>" class="btn btn-primary" id="btn-hitung" style="width:90px">Ya</a> -->
                <!-- <button class="btn btn-primary" type="button" onclick="result('<?= $data_proyek['id_proyek'] ?>')" style="width:90px">Ya</button> -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="votingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Peringatan!</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Lakukan Proses Voting Terlebih Dahulu</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal" style="width:90px">Tutup</button>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    var isDisabledYa = '';
    var isDisabledTidak = '';
    var isDisabledSama = '';

    function hitung(id_proyek) {
        var id_proyek = id_proyek;
        var jumlahVoting = $('#jumlahVoting').val();
        var daftarVoting = $('#daftarVoting').val();
        if (jumlahVoting == daftarVoting) {
            $('#hitungModal').modal('show');
        } else {
            $('#votingModal').modal('show');
        }
    }

    function result(id_proyek) {
        var id_proyek = id_proyek;

        $.ajax({
			type: 'ajax',
            url: '<?= BASE_URL . 'project/result_ahp' ?>',
            async: false,
            data: {
				id_proyek: id_proyek,
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
				// console.log(data);
				$('#result-ahp').modal('show');
            }
        });
    }

	$(".select-voting").on('change', function() {
		var classRow = $(this).data('class');
		var id = $(this).data('id');
		var value = parseFloat($(this).val());
		var id_proyek = $('#id_proyek').val();
		
		$.ajax({
			type: 'ajax',
            url: '<?= BASE_URL . 'project/set_data_voting' ?>',
            async: false,
            data: {
				id_proyek: id_proyek,
                id_kebutuhan: id,
                status: value,
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
				$(`.${classRow}`).css('background-color', '#cacdd6');
            }
        });
	})
</script>

<div class="container-fluid">
	<div class="d-flex flex-row justify-content-between mb-5">
		<h3><?= $judul_halaman ?></h3>
	</div>
    <div class="card mb-4">
        <div class="card-header">
            Detail Pertanyaan Pelanggan
        </div>
        <div class="card-body">
			<input type="text" id="idPelanggan" name="idPelanggan" class="form-control" value='<?= $question['id'] ?>' hidden>
			<div class="row form-group">
				<div class="col-md-3">
					<label for="partnerName" class="form-control-label">Nama Pelanggan</label>
				</div>
				<div class="col-md-9">
					<input type="text" id="partnerName" name="partnerName" placeholder="Masukkan Nama Pelanggan" class="form-control" value='<?php if ($type === 'edit') echo $question['cust_name'] ?>' disabled>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-3">
					<label for="partnerDistrict" class="form-control-label">Judul Pertanyaan</label>
				</div>
				<div class="col-md-9">
					<input type="text" id="partnerDistrict" name="partnerDistrict" placeholder="Masukkan Nama Kecamatan" class="form-control" value='<?php if ($type === 'edit') echo $question['cust_question_title'] ?>' disabled>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-3">
					<label for="partnerAddress" class="form-control-label">Detail Pertanyaan</label>
				</div>
				<div class="col-md-9">
					<div style="width: 100%; background-color: #EAECF4; padding: 12px; border-radius: 6px; border: 1px solid #D1D3E2;">
						<?php if ($type === 'edit') echo $question['cust_question'] ?>
					</div>
				</div>
			</div>
			<hr>
			<div style="float:right;">
				<a href="#" onclick="call('<?= $question['cust_phone'] ?>')" class="btn btn-success">
				<!-- <a href="http://wa.me/62<?= $question["cust_phone"] ?>"  target="_blank" onclick="call('<?= $question['cust_phone'] ?>')" class="btn btn-success"> -->
					<i class="fas fa-phone"></i> Jawab Via WA
				</a>
			</div>
        </div>
    </div>
</div>
</div>

<script>
	function call(phone_no) {
		$.ajax({
            url: '<?= BASE_URL . 'question/updateStatus' ?>',
            method: 'POST',
            data: {
                id: '<?= $question['id'] ?>'
            },
            dataType: 'JSON',
            success: function(data) {
				window.open("http://wa.me/62" + phone_no);
            }
        });
	}
</script>

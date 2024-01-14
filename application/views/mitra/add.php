<div class="container-fluid">
	<div class="d-flex flex-row justify-content-between mb-5">
		<h3><?= $judul_halaman ?></h3>
	</div>
    <div class="card mb-4">
        <div class="card-header">
            Masukkan Detail Mitra
        </div>
        <div class="card-body">
			<?php echo form_open_multipart('mitra/saveMitra');?>
				<?php if ($type === 'edit') { ?>
					<input type="text" id="idMitra" name="idMitra" class="form-control" value='<?= $mitra['id'] ?>' hidden>
				<?php } ?>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="partnerType" class="form-control-label">Jenis Mitra</label>
                    </div>
                    <div class="col-md-9">
						<select name="partnerType" id="partnerType" class="form-control" onchange="onChangeType()">
							<option value="1">Mitra Distribusi Utama</option>
							<option value="2">Reseller</option>
						</select>
                        <?= form_error('partnerType', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="partnerName" class="form-control-label">Nama Mitra</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="partnerName" name="partnerName" placeholder="Masukkan Nama Mitra" class="form-control" value='<?php if ($type === 'edit') echo $mitra['partner_name'] ?>'>
                        <?= form_error('partnerName', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="partnerAddress" class="form-control-label">Alamat Mitra</label>
                    </div>
                    <div class="col-md-9">
						<textarea name="partnerAddress" id="partnerAddress" rows="5" placeholder="Masukkan Detail Event" class="form-control">
							<?php if ($type === 'edit') echo $mitra['partner_address'] ?>
						</textarea>
                        <?= form_error('partnerAddress', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
				<div class="row form-group">
					<div class="col-md-3">
						<label for="partnerDistrict" class="form-control-label">Kecamatan</label>
					</div>
					<div class="col-md-9">
						<input type="text" id="partnerDistrict" name="partnerDistrict" placeholder="Masukkan Nama Kecamatan" class="form-control" value='<?php if ($type === 'edit') echo $mitra['partner_district'] ?>'>
						<?= form_error('partnerDistrict', '<small class="text-danger pl-3">', '</small>') ?>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-3">
						<label for="partnerCity" class="form-control-label">Kab/Kota</label>
					</div>
					<div class="col-md-9">
						<input type="text" id="partnerCity" name="partnerCity" placeholder="Masukkan Nama Kab/Kota" class="form-control" value='<?php if ($type === 'edit') echo $mitra['partner_city'] ?>'>
						<?= form_error('partnerCity', '<small class="text-danger pl-3">', '</small>') ?>
					</div>
				</div>
				<div class="row form-group">
                    <div class="col-md-3">
                        <label for="partnerPhone" class="form-control-label">Nomor Telepon</label>
                    </div>
                    <div class="col-md-9">
                        <input type="number" id="partnerPhone" name="partnerPhone" placeholder="Masukkan Nomor Telepon, Contoh: 81234567890" class="form-control" value='<?php if ($type === 'edit') echo $mitra['partner_phone'] ?>'>
                        <?= form_error('partnerPhone', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
				<div class="distribution">
					<div class="row form-group">
						<div class="col-md-3">
							<label for="partnerLocation" class="form-control-label">Lokasi Google Maps</label>
						</div>
						<div class="col-md-9">
							<input type="text" id="partnerLocation" name="partnerLocation" placeholder="Masukkan Lokasi Google Maps" class="form-control" value='<?php if ($type === 'edit') echo $mitra['partner_location'] ?>'>
							<?= form_error('partnerLocation', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-3">
							<label for="partnerImage" class="form-control-label">Gambar Mitra</label>
						</div>
						<div class="col-md-9">
							<?php if ($type === 'edit' && $mitra['partner_image'] !== '') { ?>
								<img src="<?=$mitra['partner_image'] ?>" class="mb-3" alt="img-event" style='max-width: 124px;'>
							<?php } ?>
							<input type="file" id="partnerImage" name="partnerImage" accept="image/png, image/jpeg, image/jpg" class="form-control">
							<?= form_error('partnerImage', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
					</div>
				</div>
                <hr>
                <div style="float:right;">
                    <button type="submit" class="btn btn-primary">
						<?php
							if ($type === 'add') {
								echo 'Buat Mitra';
							} else {
								echo 'Perbarui Mitra';
							}
						?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
	function onChangeType() {
		if ($("#partnerType").val() === "1") {
			$(".distribution").show();
		} else {
			$(".distribution").hide();
		}
	}

	$(document).ready(function() {
		$(".distribution").show();

		if ('<?= $type ?>' === 'edit') {
			$("#partnerType").val('<?= $mitra['partner_type'] ?>');
			onChangeType();
		}
	});


</script>

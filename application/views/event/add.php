<div class="container-fluid">
	<div class="d-flex flex-row justify-content-between mb-5">
		<h3><?= $judul_halaman ?></h3>
	</div>
    <div class="card mb-4">
        <div class="card-header">
            Masukkan Detail Event
        </div>
        <div class="card-body">
			<?php echo form_open_multipart('event/saveEvent');?>
				<?php if ($type === 'edit') { ?>
					<input type="text" id="idEvent" name="idEvent" class="form-control" value='<?= $event['id'] ?>' hidden>
				<?php } ?>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="title" class="form-control-label">Judul Event</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="title" name="title" placeholder="Masukkan Nama Event" class="form-control" value='<?php if ($type === 'edit') echo $event['title'] ?>'>
                        <?= form_error('title', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="description" class="form-control-label">Deskripsi</label>
                    </div>
                    <div class="col-md-9">
                        <textarea name="description" id="description" rows="5" placeholder="Masukkan Detail Event" class="form-control">
							<?php if ($type === 'edit') echo $event['description'] ?>
						</textarea>
                        <?= form_error('description', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
				<div class="row form-group">
                    <div class="col-md-3">
                        <label for="title" class="form-control-label">Gambar</label>
                    </div>
                    <div class="col-md-9">
						<?php if ($type === 'edit') { ?>
							<img src="<?=$event['image'] ?>" class="mb-3" alt="img-event" style='max-width: 124px;'>
						<?php } ?>
                        <input type="file" id="event_img" name="event_img" accept="image/png, image/jpeg, image/jpg" class="form-control">
                        <?= form_error('event_img', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
                <hr>
                <div style="float:right;">
                    <button type="submit" class="btn btn-primary">
						<?php
							if ($type === 'add') {
								echo 'Buat Event';
							} else {
								echo 'Perbarui Event';
							}
						?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

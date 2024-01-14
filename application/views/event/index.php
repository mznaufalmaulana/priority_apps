<?php
$id = $this->session->userdata('id');
$this->db->select('*');
$this->db->from('dt_event');
$this->db->order_by("created_at", "desc");
$dt_event = $this->db->get()->result();
?>
<div class="container-fluid">
	<div class="d-flex flex-row justify-content-between mb-5">
		<h3><?= $judul_halaman ?></h3>
		<a href="<?= BASE_URL . 'event/add' ?>" class="btn btn-success btn-md">
			Tambah Event
		</a>
	</div>
	<table id="dataTable" class="order-column" style="width:100%">
		<thead>
			<tr>
				<th scope="col" style="width: 5%;">No.</th>
				<th scope="col" style="width: 65%;">Judul Event</th>
				<th scope="col" style="width: 30%">Action</th>
			</tr>
		</thead>
		<tbody id="showDataProject">
			<?php
			$no = 0;
			foreach ($dt_event as $val) {
				$no++;
			?>
				<tr>
					<td><?= $no ?></td>
					<td><?= $val->title ?></td>
					<td>
						<button onclick="editEvent('<?= $val->id ?>')" class="btn btn-primary btn-sm">
							Lihat Detail
						</button>
						<button id="hapus_proyek" class="btn btn-danger btn-sm" onclick="deleteEvent('<?= $val->id ?>')">
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
</div>

<script>
	tinymce.init({
		selector: 'textarea#description'
	});

	function editEvent(id) {
		window.location.href = "<?= BASE_URL . 'event/edit/' ?>" + id;
	}

	function deleteEvent(id) {
		$('#hapusModal').modal('show');

		$('#btn-delete').unbind().click(function() {
			$.ajax({
				url: '<?= BASE_URL . 'event/deleteEvent' ?>',
				method: 'POST',
				data: {
					id: id
				},
				dataType: 'JSON',
				success: function(data) {
					location.reload();
				}
			});
		});
	}
</script>

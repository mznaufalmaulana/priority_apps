<?php
$id = $this->session->userdata('id');
$this->db->select('*');
$this->db->from('dt_customer');
$this->db->order_by("created_at", "desc");
$dt_customer = $this->db->get()->result();
?>
<div class="container-fluid">
	<div class="d-flex flex-row justify-content-between mb-5">
		<h3><?= $judul_halaman ?></h3>
	</div>
	<table class="order-column" style="width:100%" id="dataTable">
		<thead>
			<tr>
				<th>No.</th>
				<th>Nama Pelanggan</th>
				<th>Judul Pertanyaan</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody id="showDataProject">
			<?php
			$no = 0;
			foreach ($dt_customer as $val) {
				$no++;
			?>
				<tr>
					<td><?= $no ?></td>
					<td><?= $val->cust_name ?></td>
					<td><?= $val->cust_question_title ?></td>
					<td>
						<?php
							if($val->status === '1') echo "Terjawab";
							else echo "Belum Terjawab";
						?>
					</td>
					<td>
						<button onclick="edit_proyek('<?= $val->id ?>')" class="btn btn-primary btn-sm">
							Lihat Detail
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
				<h5 class="modal-title" id="exampleModalLabel">Hapus Mitra</h5>
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

	function edit_proyek(id) {
		window.location.href = "<?= BASE_URL . 'question/detail/' ?>" + id;
	}

	function hapus_temp_proyek(id) {
		$('#hapusModal').modal('show');

		$('#btn-delete').unbind().click(function() {
			$.ajax({
				url: '<?= BASE_URL . 'mitra/deleteMitra' ?>',
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

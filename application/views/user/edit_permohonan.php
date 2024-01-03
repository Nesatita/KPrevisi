<!-- Begin Edit Permohonan Form -->
<div class="container-fluid">
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

	<div class="row">
		<div class="col-lg">
			<form id="editPermohonanForm" method="post" action="<?= base_url('user/edit_permohonan/' . $permohonan['id']) ?>">
				<div class="form-group">
					<label for="title">Title</label>
					<?php if ($this->session->userdata('role_id') == '1') { ?>
						<input type="text" class="form-control" id="title" name="title" value="<?= $permohonan['title'] ?>" required disabled>
					<?php } ?>
				</div>
				<div class="form-group">
					<label for="upt">UPT</label>
					<?php if ($this->session->userdata('role_id') == '1') { ?>
					<input type="text" class="form-control" id="upt" name="upt" value="<?= $permohonan['upt'] ?>" required disabled>
					<?php } ?>
				</div>
				<div class="form-group">
					<label for="konten">Konten</label>
					<?php if ($this->session->userdata('role_id') == '1') { ?>
					<input type="text" class="form-control" id="konten" name="konten" value="<?= $permohonan['konten'] ?>" required disabled></input>
					<?php } ?>
				</div>
				<div class="form-group">
					<label for="status">Status</label>
					<input type="text" class="form-control" id="status" name="status" value="<?= $permohonan['status'] ?>" required>
				</div>
				<button type="submit" class="btn btn-primary">Update Permohonan</button>
			</form>
		</div>
	</div>
</div>
<!-- End Edit Permohonan Form -->
<script>
	// Fungsi untuk mengaktifkan input sebelum submit
	function enableStatus() {
		document.getElementById('title').disabled = false;
		document.getElementById('upt').disabled = false;
		document.getElementById('konten').disabled = false;
	}

	// Event listener untuk submit form
	document.getElementById('editPermohonanForm').addEventListener('submit', enableStatus);
</script>
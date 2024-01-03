<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

	<div class="row">
		<div class="col-lg">
			<?php if ($this->session->userdata('role_id') == '2') { ?>
				<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newPermohonan">Add New Permohonan</a>
			<?php	}  ?>
			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Title</th>
						<th scope="col">UPT</th>
						<th scope="col">Konten</th>
						<th scope="col">Tanggal</th>
						<th scope="col">Status</th>
						<?php if ($this->session->userdata('role_id') == '1') { ?>
							<th scope="col">Action</th>
						<?php	}  ?>
					</tr>
				</thead>
				<!-- Table content -->
				<tbody>
					<?php if (!empty($permohonan)) : ?>
						<?php $i = 1; ?>
						<?php foreach ($permohonan as $p) : ?>
							<tr>
								<th scope="row"><?= $i; ?></th>
								<td><?= $p['title']; ?></td>
								<td><?= $p['upt']; ?></td>
								<td><?= $p['konten']; ?></td>
								<td><?= $p['tanggal']; ?></td>
								<td><?= $p['status']; ?></td>
								<td>
									<?php if ($this->session->userdata('role_id') == '1') { ?>
										<a href="<?= base_url('user/edit_permohonan/' . $p['id']) ?>" class="badge badge-success">Ubah</a>

										<!-- <a href="<?= base_url('user/delete_permohonan/' . $p['id']) ?>" class="badge badge-danger">Delete</a> -->
									<?php	}  ?>
								</td>

								</td>
							</tr>
							<?php $i++; ?>
						<?php endforeach; ?>
					<?php else : ?>
						<tr>
							<td colspan="5">No data available</td>
						</tr>
					<?php endif; ?>
				</tbody>

			</table>
		</div>


	</div>
	<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal for Adding New Permohonan -->
<div class="modal" id="newPermohonan" tabindex="-1" role="dialog" aria-labelledby="newPermohonanLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="newPermohonanLabel">Add New Permohonan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="addPermohonanForm" method="post" action="<?= base_url('user/permohonan'); ?>">
					<div class="form-group">
						<label for="title">Title</label>
						<input type="text" class="form-control" id="title" name="title" required>
					</div>
					<div class="form-group">
						<label for="upt">UPT</label>
						<input type="text" class="form-control" id="upt" name="upt" required>
					</div>
					<div class="form-group">
						<label for="konten">Konten</label>
						<input type="text" class="form-control" id="konten" name="konten" required></input>
					</div>

					<div class="form-group">
						<label for="tanggal">Tanggal</label>
						<input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d'); ?>" required>
					</div>

					<div class="form-group">
						<label for="status">Status</label>
						<?php if ($this->session->userdata('role_id') == '2') { ?>
							<input type="text" class="form-control" placeholder="Pending" value="Pending" id="status" name="status" required disabled>
						<?php } else { ?>
							<input type="text" class="form-control" placeholder="Pending" id="status" name="status" required>
						<?php } ?>
					</div>

					<button type="submit" class="btn btn-primary">Add Permohonan</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- End of Main Content -->
<script>
	// Fungsi untuk mengaktifkan input sebelum submit
	function enableStatus() {
		document.getElementById('status').disabled = false;
	}

	// Event listener untuk submit form
	document.getElementById('addPermohonanForm').addEventListener('submit', enableStatus);
</script>

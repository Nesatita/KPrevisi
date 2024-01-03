<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

	<h5>Selamat Datang <?= $user['name']; ?></h5>

	<div class="card border-left-primary shadow h-100 py-2 mb-3">
		<div class="card-body">
			<div class="row no-gutters align-items-center">
				<div class="col mr-2">
					<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
						User</div>
					<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_users; ?></div>					
				</div>
			</div>
		</div>
	</div>
	<div class="card border-left-success shadow h-100 py-2 mb-3">
		<div class="card-body">
			<div class="row no-gutters align-items-center">
				<div class="col mr-2">
					<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
						Permohonan</div>
					<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $permohonan; ?></div>			
				</div>
			</div>
		</div>
	</div>
</div>

<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

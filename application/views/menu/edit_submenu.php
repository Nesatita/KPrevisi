<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

	<div class="row">
		<div class="col-lg">
			<!-- Add any validation error messages here if needed -->
			
			<form action="<?= base_url('menu/edit_submenu/' . $submenu['id']); ?>" method="post">
				<div class="form-group">
					<label for="title">Submenu Title</label>
					<input type="text" class="form-control" id="title" name="title" value="<?= $submenu['title']; ?>">
				</div>
                <div class="form-group">
                    <label for="menu_id">Select Menu</label>
                    <select name="menu_id" id="menu_id" class="form-control">
                        <option value="">Select Menu</option>
                        <?php foreach ($menu as $m) : ?>
                            <option value="<?= $m['id']; ?>" <?= ($m['id'] == $submenu['menu_id']) ? 'selected' : ''; ?>>
                                <?= $m['menu']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
				<div class="form-group">
					<label for="url">Submenu URL</label>
					<input type="text" class="form-control" id="url" name="url" value="<?= $submenu['url']; ?>">
				</div>
				<div class="form-group">
					<label for="icon">Submenu Icon</label>
					<input type="text" class="form-control" id="icon" name="icon" value="<?= $submenu['icon']; ?>">
				</div>
				<div class="form-group">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" <?= ($submenu['is_active'] == 1) ? 'checked' : ''; ?>>
						<label class="form-check-label" for="is_active">
							Active?
						</label>
					</div>
				</div>

				<button type="submit" class="btn btn-primary">Update</button>
			</form>
		</div>
	</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


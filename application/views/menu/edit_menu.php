<!-- views/menu/edit_menu.php -->

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Menu</h1>

    <div class="row">
        <div class="col-lg-6">

            <!-- Error Message -->
            <?= $this->session->flashdata('message'); ?>

            <!-- Form -->
            <form action="<?= base_url('menu/edit_menu/') . $menu['id']; ?>" method="post">
                <div class="form-group">
                    <label for="menu">Menu Name</label>
                    <input type="text" class="form-control" id="menu" name="menu" value="<?= $menu['menu']; ?>">
                    <?= form_error('menu', '<small class="text-danger">', '</small>'); ?>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>

        </div>
    </div>

</div>

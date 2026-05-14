<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0"><strong><?= esc($title) ?></strong></h1>
        <p class="text-muted">Manage your suppliers.</p>
    </div>
    <a href="<?= base_url('suppliers/create') ?>" class="btn btn-primary">+ Add Supplier</a>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- Search Bar -->
<div class="card shadow-sm border-0 mb-3">
    <div class="card-body py-2">
        <form method="GET" action="<?= base_url('suppliers') ?>" class="row g-2 align-items-center">
            <div class="col-md-10">
                <input type="text" name="search" class="form-control" placeholder="Search by name, phone, or email..." value="<?= esc($search) ?>">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($suppliers)): ?>
                    <?php foreach ($suppliers as $supplier): ?>
                        <tr>
                            <td><?= esc($supplier['id']) ?></td>
                            <td><strong><?= esc($supplier['name']) ?></strong></td>
                            <td><?= esc($supplier['phone'] ?: '—') ?></td>
                            <td><?= esc($supplier['email'] ?: '—') ?></td>
                            <td><?= esc($supplier['address'] ?: '—') ?></td>
                            <td>
                                <a href="<?= base_url('suppliers/edit/' . $supplier['id']) ?>" class="btn btn-sm btn-info text-white">Edit</a>
                                <a href="<?= base_url('suppliers/delete/' . $supplier['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            <?php if ($search): ?>
                                <h5>No suppliers found for "<?= esc($search) ?>".</h5>
                                <a href="<?= base_url('suppliers') ?>">Clear search</a>
                            <?php else: ?>
                                <em>No suppliers yet. Click "+ Add Supplier" to get started.</em>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if ($pager): ?>
        <div class="card-footer bg-white">
            <?= $pager->links() ?>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection(); ?>
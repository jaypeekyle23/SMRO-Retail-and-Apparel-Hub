<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><strong><?= esc($title) ?></strong></h1>
    <a href="<?= base_url('suppliers') ?>" class="btn btn-secondary">← Back to Suppliers</a>
</div>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <div><?= esc($error) ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="<?= base_url('suppliers/update/' . $supplier['id']) ?>" method="POST">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label fw-bold">Supplier Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" value="<?= esc($supplier['name']) ?>" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Phone</label>
                    <input type="text" name="phone" class="form-control" value="<?= esc($supplier['phone']) ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= esc($supplier['email']) ?>">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Address</label>
                <textarea name="address" class="form-control" rows="3"><?= esc($supplier['address']) ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Supplier</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>
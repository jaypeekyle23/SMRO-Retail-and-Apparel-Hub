<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0 text-gray-800"><strong><?= esc($title) ?></strong></h1>
        <p class="text-muted">View and manage your customers.</p>
    </div>
</div>

<!-- Search Bar -->
<div class="card shadow-sm border-0 mb-3">
    <div class="card-body py-2">
        <form method="GET" action="<?= base_url('customers') ?>" class="row g-2 align-items-center">
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
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Member Since</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($customers)): ?>
                        <?php foreach ($customers as $customer): ?>
                            <tr>
                                <td><?= esc($customer['id']) ?></td>
                                <td><strong><?= esc($customer['name']) ?></strong></td>
                                <td><?= esc($customer['phone'] ?: '—') ?></td>
                                <td><?= esc($customer['email'] ?: '—') ?></td>
                                <td><?= date('M d, Y', strtotime($customer['created_at'])) ?></td>
                                <td>
                                    <a href="<?= base_url('customers/' . $customer['id']) ?>" class="btn btn-sm btn-primary">View</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <?php if ($search): ?>
                                    <h5>No customers found for "<?= esc($search) ?>".</h5>
                                    <a href="<?= base_url('customers') ?>">Clear search</a>
                                <?php else: ?>
                                    <em>No customers yet. They will appear here after a sale.</em>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <?php if ($pager): ?>
        <div class="card-footer bg-white">
            <?= $pager->links() ?>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection(); ?>
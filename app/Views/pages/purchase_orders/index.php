<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0"><strong><?= esc($title) ?></strong></h1>
        <p class="text-muted">Manage incoming stock from suppliers.</p>
    </div>
    <a href="<?= base_url('purchase-orders/create') ?>" class="btn btn-primary">+ Create Purchase Order</a>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- Search Bar -->
<div class="card shadow-sm border-0 mb-3">
    <div class="card-body py-2">
        <form method="GET" action="<?= base_url('purchase-orders') ?>" class="row g-2 align-items-center">
            <div class="col-md-10">
                <input type="text" name="search" class="form-control" placeholder="Search by PO number or supplier..." value="<?= esc($search) ?>">
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
                    <th>PO Number</th>
                    <th>Supplier</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($purchaseOrders)): ?>
                    <?php foreach ($purchaseOrders as $po): ?>
                        <tr>
                            <td><strong><?= esc($po['po_number']) ?></strong></td>
                            <td><?= esc($po['supplier_name'] ?? '—') ?></td>
                            <td>
                                <?php if ($po['status'] === 'pending'): ?>
                                    <span class="badge bg-warning text-dark">Pending</span>
                                <?php elseif ($po['status'] === 'received'): ?>
                                    <span class="badge bg-success">Received</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Cancelled</span>
                                <?php endif; ?>
                            </td>
                            <td><?= date('M d, Y', strtotime($po['created_at'])) ?></td>
                            <td>
                                <a href="<?= base_url('purchase-orders/' . $po['id']) ?>" class="btn btn-sm btn-primary">View</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            <?php if ($search): ?>
                                <h5>No purchase orders found for "<?= esc($search) ?>".</h5>
                                <a href="<?= base_url('purchase-orders') ?>">Clear search</a>
                            <?php else: ?>
                                <em>No purchase orders yet. Click "+ Create Purchase Order" to get started.</em>
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
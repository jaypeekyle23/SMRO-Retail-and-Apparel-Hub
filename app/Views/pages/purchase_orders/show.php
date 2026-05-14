<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><strong>Purchase Order Detail</strong></h1>
    <a href="<?= base_url('purchase-orders') ?>" class="btn btn-secondary">← Back to Purchase Orders</a>
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

<!-- PO Summary -->
<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <p class="mb-1 text-muted">PO Number</p>
                <h5><?= esc($po['po_number']) ?></h5>
            </div>
            <div class="col-md-3">
                <p class="mb-1 text-muted">Supplier</p>
                <h5><?= esc($supplier['name'] ?? '—') ?></h5>
            </div>
            <div class="col-md-3">
                <p class="mb-1 text-muted">Status</p>
                <?php if ($po['status'] === 'pending'): ?>
                    <span class="badge bg-warning text-dark fs-6">Pending</span>
                <?php elseif ($po['status'] === 'received'): ?>
                    <span class="badge bg-success fs-6">Received</span>
                <?php else: ?>
                    <span class="badge bg-danger fs-6">Cancelled</span>
                <?php endif; ?>
            </div>
            <div class="col-md-3">
                <p class="mb-1 text-muted">Date Created</p>
                <h5><?= date('M d, Y', strtotime($po['created_at'])) ?></h5>
            </div>
        </div>
        <?php if (!empty($po['notes'])): ?>
            <hr>
            <p class="mb-1 text-muted">Notes</p>
            <p><?= esc($po['notes']) ?></p>
        <?php endif; ?>
    </div>
</div>

<!-- Action Buttons -->
<?php if ($po['status'] === 'pending'): ?>
    <div class="mb-4 d-flex gap-2">
        <form action="<?= base_url('purchase-orders/receive/' . $po['id']) ?>" method="POST" onsubmit="return confirm('Mark this PO as received? This will add stock to inventory.')">
            <?= csrf_field() ?>
            <button type="submit" class="btn btn-success">✔ Mark as Received</button>
        </form>
        <a href="<?= base_url('purchase-orders/cancel/' . $po['id']) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this PO?')">✖ Cancel PO</a>
    </div>
<?php endif; ?>

<!-- Items Table -->
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Order Items</h5>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Quantity</th>
                    <th>Cost Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($items)): ?>
                    <?php $grandTotal = 0; ?>
                    <?php foreach ($items as $i => $item): ?>
                        <?php $subtotal = $item['quantity'] * $item['cost_price']; $grandTotal += $subtotal; ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= esc($item['product_name']) ?></td>
                            <td><?= esc($item['sku']) ?></td>
                            <td><?= esc($item['size']) ?></td>
                            <td><?= esc($item['color']) ?></td>
                            <td><?= $item['quantity'] ?></td>
                            <td>₱<?= number_format($item['cost_price'], 2) ?></td>
                            <td>₱<?= number_format($subtotal, 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">No items found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <?php if (!empty($items)): ?>
                <tfoot>
                    <tr>
                        <td colspan="7" class="text-end fw-bold">Grand Total</td>
                        <td class="fw-bold">₱<?= number_format($grandTotal, 2) ?></td>
                    </tr>
                </tfoot>
            <?php endif; ?>
        </table>
    </div>
</div>

<?= $this->endSection(); ?>
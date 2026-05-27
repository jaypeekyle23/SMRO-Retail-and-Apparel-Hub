<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="row mb-4">
    <div class="col">
        <h3 class="mb-0">My Orders</h3>
        <p class="text-muted mb-0">Your complete order history</p>
    </div>
</div>

<?php if (empty($orders)): ?>
    <div class="alert alert-info">
        You have no orders yet. <a href="<?= base_url('shop'); ?>">Start shopping!</a>
    </div>
<?php else: ?>
    <?php foreach ($orders as $order): ?>
        <div class="card mb-3 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <strong><?= esc($order['order_number']); ?></strong>
                    <span class="text-muted small ms-2"><?= date('M d, Y h:i A', strtotime($order['created_at'])); ?></span>
                </div>
                <span class="badge bg-success">Completed</span>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Product</th>
                            <th>SKU</th>
                            <th>Size</th>
                            <th>Color</th>
                            <th class="text-center">Qty</th>
                            <th class="text-end">Price</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order['items'] as $item): ?>
                            <tr>
                                <td><?= esc($item['product_name']); ?></td>
                                <td><?= esc($item['sku']); ?></td>
                                <td><?= esc($item['size'] ?? '—'); ?></td>
                                <td><?= esc($item['color'] ?? '—'); ?></td>
                                <td class="text-center"><?= $item['quantity']; ?></td>
                                <td class="text-end">₱<?= number_format($item['price'], 2); ?></td>
                                <td class="text-end">₱<?= number_format($item['price'] * $item['quantity'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="6" class="text-end fw-bold">Total</td>
                            <td class="text-end fw-bold" style="color: #C0490A;">
                                ₱<?= number_format($order['total_amount'], 2); ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?= $this->endSection(); ?>
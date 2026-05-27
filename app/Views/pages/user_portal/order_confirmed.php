<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="row justify-content-center">
    <div class="col-lg-7">

        <!-- Success Header -->
        <div class="text-center mb-4">
            <div class="mb-3" style="color: #C0490A;">
                <i data-feather="check-circle" style="width:64px;height:64px;"></i>
            </div>
            <h3 class="fw-bold mb-1">Order Placed Successfully!</h3>
            <p class="text-muted">Thank you for your purchase. Here's your receipt.</p>
        </div>

        <!-- Receipt Card -->
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-0 fw-bold"><?= esc($order['order_number']); ?></h6>
                    <span class="text-muted small"><?= date('F d, Y h:i A', strtotime($order['created_at'])); ?></span>
                </div>
                <span class="badge bg-success">Completed</span>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Product</th>
                            <th>Variant</th>
                            <th class="text-center">Qty</th>
                            <th class="text-end">Price</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order['items'] as $item): ?>
                            <tr>
                                <td><?= esc($item['product_name']); ?></td>
                                <td>
                                    <span class="text-muted small">
                                        <?= esc($item['sku']); ?>
                                        <?= !empty($item['size'])  ? '/ ' . esc($item['size'])  : ''; ?>
                                        <?= !empty($item['color']) ? '/ ' . esc($item['color']) : ''; ?>
                                    </span>
                                </td>
                                <td class="text-center"><?= $item['quantity']; ?></td>
                                <td class="text-end">₱<?= number_format($item['price'], 2); ?></td>
                                <td class="text-end">₱<?= number_format($item['price'] * $item['quantity'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="4" class="text-end fw-bold">Total</td>
                            <td class="text-end fw-bold" style="color: #C0490A; font-size: 1.1rem;">
                                ₱<?= number_format($order['total_amount'], 2); ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex gap-2 mt-4 justify-content-center">
            <a href="<?= base_url('shop'); ?>" class="btn btn-primary">
                <i data-feather="shopping-bag" style="width:16px;height:16px;margin-right:6px;"></i>
                Continue Shopping
            </a>
            <a href="<?= base_url('my-orders'); ?>" class="btn btn-outline-secondary">
                <i data-feather="package" style="width:16px;height:16px;margin-right:6px;"></i>
                View All Orders
            </a>
        </div>

    </div>
</div>

<?= $this->endSection(); ?>
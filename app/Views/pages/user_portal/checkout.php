<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="row mb-4">
    <div class="col">
        <h3 class="mb-0">Checkout</h3>
        <p class="text-muted mb-0">Review your order before placing it</p>
    </div>
    <div class="col-auto">
        <a href="<?= base_url('shop'); ?>" class="btn btn-outline-secondary btn-sm">
            <i data-feather="arrow-left" style="width:14px;height:14px;margin-right:4px;"></i>
            Continue Shopping
        </a>
    </div>
</div>

<!-- Flash Messages -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="row">
    <!-- Cart Items -->
    <div class="col-lg-8 mb-4">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Cart Items</h6>
                <form method="POST" action="<?= base_url('cart/clear'); ?>">
                    <?= csrf_field(); ?>
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                        <i data-feather="trash-2" style="width:14px;height:14px;margin-right:4px;"></i>
                        Clear Cart
                    </button>
                </form>
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
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart as $item): ?>
                            <tr>
                                <td>
                                    <?php if (!empty($item['base_image'])): ?>
                                        <img src="<?= base_url('uploads/products/' . $item['base_image']); ?>"
                                            style="width:40px;height:40px;object-fit:cover;border-radius:4px;margin-right:8px;">
                                    <?php endif; ?>
                                    <?= esc($item['product_name']); ?>
                                </td>
                                <td>
                                    <span class="text-muted small">
                                        <?= esc($item['sku']); ?>
                                        <?= !empty($item['size'])  ? '/ ' . esc($item['size'])  : ''; ?>
                                        <?= !empty($item['color']) ? '/ ' . esc($item['color']) : ''; ?>
                                    </span>
                                </td>
                                <td class="text-center"><?= $item['quantity']; ?></td>
                                <td class="text-end">₱<?= number_format($item['price'], 2); ?></td>
                                <td class="text-end fw-bold">₱<?= number_format($item['price'] * $item['quantity'], 2); ?></td>
                                <td class="text-end">
                                    <form method="POST" action="<?= base_url('cart/remove'); ?>">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="variant_id" value="<?= $item['variant_id']; ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i data-feather="x" style="width:13px;height:13px;"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Order Summary -->
    <div class="col-lg-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h6 class="mb-0 fw-bold">Order Summary</h6>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Subtotal</span>
                    <span>₱<?= number_format($total, 2); ?></span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-3">
                    <span class="fw-bold">Total</span>
                    <span class="fw-bold" style="color: #C0490A; font-size: 1.2rem;">
                        ₱<?= number_format($total, 2); ?>
                    </span>
                </div>
                <form method="POST" action="<?= base_url('checkout/place-order'); ?>">
                    <?= csrf_field(); ?>
                    <button type="submit" class="btn btn-primary w-100">
                        <i data-feather="check-circle" style="width:16px;height:16px;margin-right:6px;"></i>
                        Place Order
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
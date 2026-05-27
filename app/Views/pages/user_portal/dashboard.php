<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="row mb-4">
    <div class="col">
        <h3 class="mb-0">Dashboard</h3>
        <p class="text-muted mb-0">Welcome back, <?= esc(session()->get('username')); ?>!</p>
    </div>
    <div class="col-auto">
        <a href="<?= base_url('shop'); ?>" class="btn btn-primary">
            <i data-feather="shopping-bag" style="width:16px;height:16px;margin-right:6px;"></i>
            Browse Shop
        </a>
    </div>
</div>

<!-- Stats Row -->
<div class="row mb-4">
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <p class="text-muted small mb-1 text-uppercase fw-bold" style="font-size: 11px; letter-spacing: 1px;">Total Orders</p>
                <h2 class="mb-0 fw-bold"><?= $totalOrders; ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <p class="text-muted small mb-1 text-uppercase fw-bold" style="font-size: 11px; letter-spacing: 1px;">Total Spent</p>
                <h2 class="mb-0 fw-bold" style="color: #C0490A;">₱<?= number_format($totalSpent, 2); ?></h2>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="card shadow-sm">
    <div class="card-header">
        <h6 class="mb-0 fw-bold">Recent Orders</h6>
    </div>
    <div class="card-body p-0">
        <?php if (empty($recentOrders)): ?>
            <div class="p-4 text-center text-muted">
                You have no orders yet. <a href="<?= base_url('shop'); ?>">Start shopping!</a>
            </div>
        <?php else: ?>
            <table class="table table-sm mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Order #</th>
                        <th>Date</th>
                        <th class="text-center">Items</th>
                        <th class="text-end">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentOrders as $order): ?>
                        <tr>
                            <td class="fw-bold"><?= esc($order['order_number']); ?></td>
                            <td><?= date('M d, Y', strtotime($order['created_at'])); ?></td>
                            <td class="text-center"><?= count($order['items']); ?></td>
                            <td class="text-end fw-bold" style="color: #C0490A;">
                                ₱<?= number_format($order['total_amount'], 2); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="p-3 text-end">
                <a href="<?= base_url('my-orders'); ?>" class="btn btn-sm btn-outline-secondary">View All Orders</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection(); ?>
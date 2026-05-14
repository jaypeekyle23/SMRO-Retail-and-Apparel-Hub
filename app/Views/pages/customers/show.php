<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><strong>Customer Detail</strong></h1>
    <a href="<?= base_url('customers') ?>" class="btn btn-secondary">← Back to Customers</a>
</div>

<!-- Customer Info Card -->
<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <p class="mb-1 text-muted">Name</p>
                <h5><?= esc($customer['name']) ?></h5>
            </div>
            <div class="col-md-4">
                <p class="mb-1 text-muted">Phone</p>
                <h5><?= esc($customer['phone'] ?: '—') ?></h5>
            </div>
            <div class="col-md-4">
                <p class="mb-1 text-muted">Email</p>
                <h5><?= esc($customer['email'] ?: '—') ?></h5>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <p class="mb-1 text-muted">Total Orders</p>
                <h5><?= count($orders) ?></h5>
            </div>
            <div class="col-md-4">
                <p class="mb-1 text-muted">Total Spent</p>
                <h5>₱<?= number_format($totalSpent, 2) ?></h5>
            </div>
            <div class="col-md-4">
                <p class="mb-1 text-muted">Member Since</p>
                <h5><?= date('M d, Y', strtotime($customer['created_at'])) ?></h5>
            </div>
        </div>
    </div>
</div>

<!-- Order History -->
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Order History</h5>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>Order Number</th>
                    <th>Total Amount</th>
                    <th>Date & Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($orders)): ?>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><strong><?= esc($order['order_number']) ?></strong></td>
                            <td>₱<?= number_format($order['total_amount'], 2) ?></td>
                            <td><?= date('M d, Y h:i A', strtotime($order['created_at'])) ?></td>
                            <td>
                                <a href="<?= base_url('sales/' . $order['id']) ?>" class="btn btn-sm btn-primary">View</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">No orders found for this customer.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection(); ?>
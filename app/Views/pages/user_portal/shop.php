<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="row mb-3">
    <div class="col">
        <h3 class="mb-0">Shop</h3>
        <p class="text-muted mb-0">Browse our available products</p>
    </div>
</div>

<!-- Search Bar -->
<div class="row mb-4">
    <div class="col-md-5">
        <form method="GET" action="<?= base_url('shop'); ?>">
            <div class="input-group">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search products..."
                    value="<?= esc($search); ?>">
                <button class="btn btn-primary" type="submit">Search</button>
                <?php if ($search): ?>
                    <a href="<?= base_url('shop'); ?>" class="btn btn-outline-secondary">Clear</a>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>

<!-- Products Grid -->
<?php if (empty($products)): ?>
    <div class="alert alert-info">No products found.</div>
<?php else: ?>
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
        <?php foreach ($products as $product): ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <?php if (!empty($product['base_image'])): ?>
                        <img
                            src="<?= base_url('uploads/products/' . $product['base_image']); ?>"
                            class="card-img-top"
                            style="height: 200px; object-fit: cover;"
                            alt="<?= esc($product['name']); ?>">
                    <?php else: ?>
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i data-feather="image" style="opacity: 0.2; width: 48px; height: 48px;"></i>
                        </div>
                    <?php endif; ?>

                    <div class="card-body d-flex flex-column">
                        <span class="badge bg-secondary mb-1" style="width: fit-content;"><?= esc($product['category']); ?></span>
                        <h6 class="card-title mb-1"><?= esc($product['name']); ?></h6>
                        <p class="text-muted small mb-1">SKU: <?= esc($product['sku']); ?></p>

                        <?php if (!empty($product['variants'])): ?>
                            <div class="mb-2">
                                <?php
                                $sizes  = array_unique(array_filter(array_column($product['variants'], 'size')));
                                $colors = array_unique(array_filter(array_column($product['variants'], 'color')));
                                ?>
                                <?php if (!empty($sizes)): ?>
                                    <p class="mb-0 small"><strong>Sizes:</strong> <?= esc(implode(', ', $sizes)); ?></p>
                                <?php endif; ?>
                                <?php if (!empty($colors)): ?>
                                    <p class="mb-0 small"><strong>Colors:</strong> <?= esc(implode(', ', $colors)); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <p class="fw-bold mt-auto mb-0" style="color: #C0490A;">
                            ₱<?= number_format($product['selling_price'], 2); ?>
                        </p>
                        <p class="small text-muted mb-0">
                            <?= $product['total_stock'] > 0 ? $product['total_stock'] . ' in stock' : '<span class="text-danger">Out of stock</span>'; ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        <?= $pager->links(); ?>
    </div>
<?php endif; ?>

<?= $this->endSection(); ?>
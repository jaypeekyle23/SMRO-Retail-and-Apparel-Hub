<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="row mb-3">
    <div class="col">
        <h3 class="mb-0">Shop</h3>
        <p class="text-muted mb-0">Browse our available products</p>
    </div>
    <div class="col-auto">
        <a href="<?= base_url('checkout'); ?>" class="btn btn-primary position-relative">
            <i data-feather="shopping-cart" style="width:16px;height:16px;margin-right:6px;"></i>
            Cart
            <?php if (!empty($cart)): ?>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?= count($cart); ?>
                </span>
            <?php endif; ?>
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
                        <p class="text-muted small mb-2">SKU: <?= esc($product['sku']); ?></p>
                        <p class="fw-bold mt-auto mb-1" style="color: #C0490A;">
                            ₱<?= number_format($product['selling_price'], 2); ?>
                        </p>
                        <p class="small text-muted mb-2">
                            <?= $product['total_stock'] > 0
                                ? $product['total_stock'] . ' in stock'
                                : '<span class="text-danger">Out of stock</span>'; ?>
                        </p>

                        <?php if (!empty($product['variants'])): ?>
                            <button
                                class="btn btn-primary btn-sm w-100"
                                data-bs-toggle="modal"
                                data-bs-target="#addToCartModal"
                                data-product-id="<?= $product['id']; ?>"
                                data-product-name="<?= esc($product['name']); ?>"
                                data-product-price="<?= $product['selling_price']; ?>"
                                data-variants="<?= esc(json_encode($product['variants'])); ?>">
                                <i data-feather="shopping-cart" style="width:14px;height:14px;margin-right:4px;"></i>
                                Add to Cart
                            </button>
                        <?php else: ?>
                            <button class="btn btn-secondary btn-sm w-100" disabled>Out of Stock</button>
                        <?php endif; ?>
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

<!-- Add to Cart Modal -->
<div class="modal fade" id="addToCartModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add to Cart</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="<?= base_url('shop/add-to-cart'); ?>">
                <?= csrf_field(); ?>
                <input type="hidden" name="variant_id" id="modalVariantId">
                <div class="modal-body">
                    <h6 id="modalProductName" class="mb-3"></h6>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Select Variant</label>
                        <select name="variant_id" id="modalVariantSelect" class="form-select" required>
                            <option value="">-- Choose a variant --</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Quantity</label>
                        <input type="number" name="quantity" id="modalQuantity" class="form-control" value="1" min="1" required>
                        <div class="form-text" id="modalStockInfo"></div>
                    </div>

                    <p class="fw-bold" style="color: #C0490A;">
                        Price: ₱<span id="modalPrice"></span>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i data-feather="shopping-cart" style="width:14px;height:14px;margin-right:4px;"></i>
                        Add to Cart
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const addToCartModal = document.getElementById('addToCartModal');
    addToCartModal.addEventListener('show.bs.modal', function (event) {
        const button   = event.relatedTarget;
        const name     = button.getAttribute('data-product-name');
        const price    = button.getAttribute('data-product-price');
        const variants = JSON.parse(button.getAttribute('data-variants'));

        document.getElementById('modalProductName').textContent = name;
        document.getElementById('modalPrice').textContent       = parseFloat(price).toLocaleString('en-PH', { minimumFractionDigits: 2 });

        const select = document.getElementById('modalVariantSelect');
        select.innerHTML = '<option value="">-- Choose a variant --</option>';

        variants.forEach(function(v) {
            const label  = [v.sku, v.size, v.color].filter(Boolean).join(' / ');
            const option = document.createElement('option');
            option.value       = v.id;
            option.textContent = label + ' (' + v.stock_quantity + ' in stock)';
            option.dataset.stock = v.stock_quantity;
            select.appendChild(option);
        });

        document.getElementById('modalQuantity').value = 1;
        document.getElementById('modalStockInfo').textContent = '';
    });

    document.getElementById('modalVariantSelect').addEventListener('change', function() {
        const selected = this.options[this.selectedIndex];
        const stock    = selected.dataset.stock ?? 0;
        const qtyInput = document.getElementById('modalQuantity');
        qtyInput.max   = stock;
        document.getElementById('modalStockInfo').textContent = stock > 0 ? 'Max available: ' + stock : 'Out of stock';
    });
</script>

<?= $this->endSection(); ?>
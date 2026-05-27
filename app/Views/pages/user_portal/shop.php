<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">

<style>
  :root {
    --bg:        #F7F3EF;
    --surface:   #FFFFFF;
    --border:    #EBE5DF;
    --accent:    #C0490A;
    --accent-bg: #FBF0E9;
    --txt:       #1A1714;
    --txt-2:     #6B6360;
    --txt-3:     #A89F9B;
    --ok:        #1F9E5C;
    --ok-bg:     #E8F8EF;
    --danger:    #C0392B;
    --danger-bg: #FDECEA;
    --r:         12px;
    --shadow:    0 2px 12px rgba(0,0,0,.06);
  }

  body, .content-wrapper, main { background: var(--bg) !important; font-family: 'DM Sans', sans-serif; }

  /* ── Page header ─────────────────────────────── */
  .page-header h1 { font-family: 'Sora', sans-serif; font-size: 1.6rem; color: var(--txt); letter-spacing: -.02em; }
  .page-header p  { color: var(--txt-2); font-size: .875rem; margin: 0; }

  /* ── Buttons ─────────────────────────────────── */
  .btn-primary              { background: var(--accent) !important; border-color: var(--accent) !important; font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 600; border-radius: 8px; padding: .5rem 1.1rem; color: #fff !important; }
  .btn-primary:hover        { background: #a83d08 !important; border-color: #a83d08 !important; }
  .btn-outline-secondary    { border-color: var(--border) !important; color: var(--txt-2) !important; font-size: .82rem; font-weight: 500; border-radius: 8px; padding: .5rem 1rem; background: var(--surface) !important; }
  .btn-outline-secondary:hover { background: var(--bg) !important; border-color: #d0c8c0 !important; }
  .btn-secondary[disabled]  { background: var(--border) !important; border-color: var(--border) !important; color: var(--txt-3) !important; font-size: .8rem; font-weight: 500; border-radius: 8px; }

  /* ── Flash alerts ────────────────────────────── */
  .alert-success { background: var(--ok-bg); border: 1px solid #A7D7BE; color: #155235; border-radius: var(--r); font-size: .875rem; }
  .alert-danger  { background: var(--danger-bg); border: 1px solid #F0C4C0; color: var(--danger); border-radius: var(--r); font-size: .875rem; }

  /* ── Search bar ──────────────────────────────── */
  .search-wrap { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); padding: .75rem 1rem; }
  .search-wrap .form-control { border: 1px solid var(--border); border-radius: 8px 0 0 8px; background: var(--bg); font-size: .875rem; color: var(--txt); }
  .search-wrap .form-control:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(192,73,10,.1); background: var(--surface); }
  .search-wrap .input-group .btn { border-radius: 0 8px 8px 0; }

  /* ── Product card ────────────────────────────── */
  .product-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); overflow: hidden; transition: box-shadow .18s, transform .18s; height: 100%; display: flex; flex-direction: column; }
  .product-card:hover { box-shadow: 0 6px 24px rgba(0,0,0,.1); transform: translateY(-2px); }

  .product-card .card-img-top { height: 200px; object-fit: cover; border-bottom: 1px solid var(--border); }
  .product-card .no-img { height: 200px; background: var(--bg); display: flex; align-items: center; justify-content: center; border-bottom: 1px solid var(--border); color: var(--txt-3); }

  .product-card .card-body { padding: 1rem 1.1rem; display: flex; flex-direction: column; flex: 1; }

  .product-card .cat-badge { display: inline-block; font-family: 'Sora', sans-serif; font-size: .65rem; font-weight: 600; letter-spacing: .07em; text-transform: uppercase; padding: .25em .6em; border-radius: 5px; background: var(--accent-bg); color: var(--accent); margin-bottom: .5rem; }
  .product-card .prod-name { font-family: 'Sora', sans-serif; font-size: .9rem; font-weight: 600; color: var(--txt); margin-bottom: .2rem; line-height: 1.3; }
  .product-card .prod-sku  { font-size: .75rem; color: var(--txt-3); margin-bottom: .6rem; }
  .product-card .prod-price { font-family: 'Sora', sans-serif; font-size: 1.1rem; font-weight: 700; color: var(--accent); margin-top: auto; margin-bottom: .3rem; }
  .product-card .stock-info { font-size: .775rem; color: var(--txt-3); margin-bottom: .75rem; }
  .stock-info .out { color: var(--danger); font-weight: 500; }

  .btn-add-cart { font-family: 'Sora', sans-serif; font-size: .8rem; font-weight: 600; padding: .5rem; border-radius: 8px; width: 100%; display: flex; align-items: center; justify-content: center; gap: 6px; }

  /* ── Cart button badge ───────────────────────── */
  .cart-badge { font-size: .65rem; padding: .2em .45em; border-radius: 20px; }

  /* ── Empty state ─────────────────────────────── */
  .empty-state { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); padding: 3.5rem 1rem; text-align: center; color: var(--txt-3); }
  .empty-state h5 { font-family: 'Sora', sans-serif; font-size: 1rem; color: var(--txt-2); margin-bottom: .4rem; }
  .empty-state p  { font-size: .875rem; margin: 0; }

  /* ── Pagination ──────────────────────────────── */
  .pagination .page-link { border-color: var(--border); color: var(--txt-2); font-size: .8rem; border-radius: 6px !important; margin: 0 2px; }
  .pagination .page-item.active .page-link { background: var(--accent); border-color: var(--accent); color: #fff; }
  .pagination .page-link:hover { background: var(--accent-bg); color: var(--accent); }

  /* ── Modal ───────────────────────────────────── */
  .modal-content { border: 1px solid var(--border); border-radius: var(--r); box-shadow: 0 16px 48px rgba(0,0,0,.12); font-family: 'DM Sans', sans-serif; }
  .modal-header  { border-bottom: 1px solid var(--border); padding: 1.2rem 1.5rem; }
  .modal-header .modal-title { font-family: 'Sora', sans-serif; font-size: 1rem; font-weight: 600; color: var(--txt); }
  .modal-body    { padding: 1.25rem 1.5rem; }
  .modal-footer  { border-top: 1px solid var(--border); padding: 1rem 1.5rem; }
  .modal-footer .btn-close-modal { border-color: var(--border) !important; }

  .modal .form-label { font-family: 'Sora', sans-serif; font-size: .78rem; font-weight: 600; letter-spacing: .04em; text-transform: uppercase; color: var(--txt-3); margin-bottom: .4rem; }
  .modal .form-control,
  .modal .form-select { border: 1px solid var(--border); border-radius: 8px; background: var(--bg); font-size: .875rem; color: var(--txt); padding: .55rem .8rem; }
  .modal .form-control:focus,
  .modal .form-select:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(192,73,10,.1); background: var(--surface); }
  .modal .form-text { font-size: .775rem; color: var(--txt-3); margin-top: .3rem; }
  .modal-product-name { font-family: 'Sora', sans-serif; font-size: 1rem; font-weight: 600; color: var(--txt); margin-bottom: 1.1rem; }
  .modal-price { font-family: 'Sora', sans-serif; font-size: 1.05rem; font-weight: 700; color: var(--accent); margin: .75rem 0 0; }
</style>

<!-- Page Header -->
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0"><b>Shop</b></h1>
        <p>Browse our available products</p>
    </div>
    <div>
        <a href="<?= base_url('checkout'); ?>" class="btn btn-primary position-relative">
            <i data-feather="shopping-cart" style="width:15px;height:15px;margin-right:6px;vertical-align:-.1em;"></i>
            Cart
            <?php if (!empty($cart)): ?>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-badge">
                    <?= count($cart); ?>
                </span>
            <?php endif; ?>
        </a>
    </div>
</div>

<!-- Flash Messages -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
        <?= session()->getFlashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
        <?= session()->getFlashdata('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- Search Bar -->
<div class="search-wrap mb-4">
    <form method="GET" action="<?= base_url('shop'); ?>">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="input-group">
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search products by name, SKU, or category..."
                        value="<?= esc($search); ?>">
                    <button class="btn btn-primary" type="submit">Search</button>
                    <?php if ($search): ?>
                        <a href="<?= base_url('shop'); ?>" class="btn btn-outline-secondary">Clear</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Products Grid -->
<?php if (empty($products)): ?>
    <div class="empty-state">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:.75rem;opacity:.4"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <h5>No products found<?= $search ? ' for "' . esc($search) . '"' : '' ?>.</h5>
        <?php if ($search): ?>
            <p><a href="<?= base_url('shop'); ?>" style="color:var(--accent);font-weight:500;text-decoration:none;">Clear search</a></p>
        <?php endif; ?>
    </div>
<?php else: ?>
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-3">
        <?php foreach ($products as $product): ?>
            <div class="col">
                <div class="product-card">
                    <?php if (!empty($product['base_image'])): ?>
                        <img
                            src="<?= base_url('uploads/products/' . $product['base_image']); ?>"
                            class="card-img-top"
                            alt="<?= esc($product['name']); ?>">
                    <?php else: ?>
                        <div class="no-img">
                            <i data-feather="image" style="width:40px;height:40px;opacity:.2;"></i>
                        </div>
                    <?php endif; ?>

                    <div class="card-body">
                        <span class="cat-badge"><?= esc($product['category']); ?></span>
                        <div class="prod-name"><?= esc($product['name']); ?></div>
                        <div class="prod-sku">SKU: <?= esc($product['sku']); ?></div>
                        <div class="prod-price">₱<?= number_format($product['selling_price'], 2); ?></div>
                        <div class="stock-info">
                            <?= $product['total_stock'] > 0
                                ? $product['total_stock'] . ' in stock'
                                : '<span class="out">Out of stock</span>'; ?>
                        </div>

                        <?php if (!empty($product['variants'])): ?>
                            <button
                                class="btn btn-primary btn-add-cart"
                                data-bs-toggle="modal"
                                data-bs-target="#addToCartModal"
                                data-product-id="<?= $product['id']; ?>"
                                data-product-name="<?= esc($product['name']); ?>"
                                data-product-price="<?= $product['selling_price']; ?>"
                                data-variants="<?= esc(json_encode($product['variants'])); ?>">
                                <i data-feather="shopping-cart" style="width:14px;height:14px;"></i>
                                Add to Cart
                            </button>
                        <?php else: ?>
                            <button class="btn btn-secondary btn-add-cart" disabled>Out of Stock</button>
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
                    <p class="modal-product-name" id="modalProductName"></p>

                    <div class="mb-3">
                        <label class="form-label">Select Variant</label>
                        <select name="variant_id" id="modalVariantSelect" class="form-select" required>
                            <option value="">— Choose a variant —</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" name="quantity" id="modalQuantity" class="form-control" value="1" min="1" required>
                        <div class="form-text" id="modalStockInfo"></div>
                    </div>

                    <p class="modal-price">Price: ₱<span id="modalPrice"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-close-modal" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i data-feather="shopping-cart" style="width:14px;height:14px;margin-right:5px;vertical-align:-.1em;"></i>
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
        select.innerHTML = '<option value="">— Choose a variant —</option>';

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
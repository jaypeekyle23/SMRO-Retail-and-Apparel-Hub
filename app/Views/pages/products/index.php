<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>

<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">

<style>
  :root {
    --bg:          #F7F3EF;
    --surface:     #FFFFFF;
    --border:      #EBE5DF;
    --accent:      #C96A2E;
    --accent-bg:   #FBF0E9;
    --txt:         #1A1714;
    --txt-2:       #6B6360;
    --txt-3:       #A89F9B;
    --ok:          #1F9E5C;
    --ok-bg:       #E8F8EF;
    --warn:        #B45309;
    --warn-bg:     #FEF3C7;
    --danger:      #C0392B;
    --danger-bg:   #FDECEA;
    --r:           12px;
    --shadow:      0 2px 12px rgba(0,0,0,.06);
  }

  body, .content-wrapper, main { background: var(--bg) !important; font-family: 'DM Sans', sans-serif; }

  /* ── Page header ─────────────────────────────── */
  .page-header h1           { font-family: 'Sora', sans-serif; font-size: 1.6rem; color: var(--txt); letter-spacing: -.02em; }
  .page-header p            { color: var(--txt-2); font-size: .875rem; margin: 0; }
  .btn-primary              { background: var(--accent) !important; border-color: var(--accent) !important; font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 600; border-radius: 8px; padding: .5rem 1.1rem; }
  .btn-primary:hover        { background: #b35a23 !important; border-color: #b35a23 !important; }

  /* ── Flash alert ─────────────────────────────── */
  .alert-success { background: var(--ok-bg); border: 1px solid #A7D7BE; color: #155235; border-radius: var(--r); font-size: .875rem; }

  /* ── Search card ─────────────────────────────── */
  .search-wrap { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); padding: .75rem 1rem; margin-bottom: 1rem; }
  .search-wrap .form-control { border: 1px solid var(--border); border-radius: 8px; background: var(--bg); font-size: .875rem; color: var(--txt); padding-left: 2.4rem; }
  .search-wrap .form-control:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(201,106,46,.12); background: var(--surface); }
  .search-wrap .input-wrap   { position: relative; }
  .search-wrap .input-wrap i { position: absolute; left: .8rem; top: 50%; transform: translateY(-50%); color: var(--txt-3); font-size: .9rem; pointer-events: none; }

  /* ── Main card ───────────────────────────────── */
  .main-card         { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); overflow: hidden; }
  .card-footer       { background: var(--surface) !important; border-top: 1px solid var(--border) !important; padding: .85rem 1.5rem !important; }

  /* ── Table ───────────────────────────────────── */
  .table             { margin-bottom: 0; }
  .table thead th    { font-family: 'Sora', sans-serif; font-size: .67rem; font-weight: 600; letter-spacing: .09em; text-transform: uppercase; color: var(--txt-3); background: var(--bg); border-bottom: 1px solid var(--border) !important; border-top: none; padding: .85rem 1rem; white-space: nowrap; }
  .table tbody td    { border-bottom: 1px solid var(--border) !important; border-top: none; padding: .9rem 1rem; vertical-align: middle; font-size: .875rem; color: var(--txt); }
  .table-hover tbody tr:hover { background: #FBF7F4 !important; }
  .table tbody tr:last-child td { border-bottom: none !important; }

  /* ── SKU ─────────────────────────────────────── */
  td.sku-cell        { font-family: 'Sora', sans-serif; font-size: .75rem; font-weight: 600; color: var(--accent); letter-spacing: .02em; }

  /* ── Product image ───────────────────────────── */
  .product-thumb     { width: 44px; height: 44px; object-fit: cover; border-radius: 8px; border: 1px solid var(--border); }
  .no-img            { width: 44px; height: 44px; border-radius: 8px; border: 1px solid var(--border); background: var(--bg); color: var(--txt-3); font-size: .62rem; display: flex; align-items: center; justify-content: center; }

  /* ── Product name ────────────────────────────── */
  td strong          { font-weight: 600; font-size: .875rem; color: var(--txt); }

  /* ── Size badges ─────────────────────────────── */
  .badge.bg-secondary { background: transparent !important; border: 1px solid var(--border) !important; color: var(--txt-2) !important; font-size: .68rem; font-weight: 500; padding: .25em .55em; border-radius: 5px; }

  /* ── Price ───────────────────────────────────── */
  .price-cell        { font-family: 'Sora', sans-serif; font-weight: 700; color: var(--accent) !important; font-size: .95rem; }

  /* ── Stock badges ────────────────────────────── */
  .badge.bg-danger   { background: var(--danger-bg) !important; color: var(--danger) !important; font-size: .72rem; font-weight: 600; border-radius: 6px; padding: .3em .65em; border: none !important; }
  .badge.bg-success  { background: var(--ok-bg) !important; color: var(--ok) !important; font-size: .72rem; font-weight: 600; border-radius: 6px; padding: .3em .65em; border: none !important; }

  /* ── Status badges ───────────────────────────── */
  .status-active     { display: inline-flex; align-items: center; gap: .35rem; font-size: .8rem; font-weight: 500; color: var(--ok); }
  .status-active::before  { content: ''; width: 7px; height: 7px; border-radius: 50%; background: var(--ok); flex-shrink: 0; }
  .badge.bg-primary  { background: var(--accent-bg) !important; color: var(--accent) !important; font-size: .72rem; font-weight: 600; border-radius: 6px; padding: .3em .65em; }
  .badge.bg-warning  { background: var(--warn-bg) !important; color: var(--warn) !important; font-size: .72rem; font-weight: 600; border-radius: 6px; padding: .3em .65em; }

  /* ── Action buttons ──────────────────────────── */
  .btn-sm.btn-info   { background: #EBF5FB !important; border: 1px solid #C8E3F0 !important; color: #2471A3 !important; font-size: .75rem; font-weight: 500; border-radius: 6px; padding: .3rem .7rem; }
  .btn-sm.btn-info:hover { background: #D4EAF7 !important; }
  .btn-sm.btn-danger { background: var(--danger-bg) !important; border: 1px solid #F0C4C0 !important; color: var(--danger) !important; font-size: .75rem; font-weight: 500; border-radius: 6px; padding: .3rem .7rem; }
  .btn-sm.btn-danger:hover { background: #F5D0CC !important; }

  /* ── Empty state ─────────────────────────────── */
  .empty-state       { padding: 3.5rem 1rem; text-align: center; color: var(--txt-3); }
  .empty-state h5    { font-family: 'Sora', sans-serif; font-size: 1rem; color: var(--txt-2); margin-bottom: .4rem; }
  .empty-state p     { font-size: .875rem; margin-bottom: .75rem; }
  .empty-state a     { color: var(--accent); font-weight: 500; text-decoration: none; }
  .empty-state a:hover { text-decoration: underline; }

  /* ── Pagination ──────────────────────────────── */
  .pagination .page-link { border-color: var(--border); color: var(--txt-2); font-size: .8rem; border-radius: 6px !important; margin: 0 2px; }
  .pagination .page-item.active .page-link { background: var(--accent); border-color: var(--accent); color: #fff; }
  .pagination .page-link:hover { background: var(--accent-bg); color: var(--accent); }
</style>

<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0 text-gray-800"><strong><?= $title; ?></strong></h1>
        <p class="text-muted">Manage your retail inventory, pricing, and stock.</p>
    </div>
    <div class="page-actions">
        <?php if (session()->get('role_id') <= 2): ?>
        <a href="<?= base_url('products/create') ?>" class="btn btn-primary">+ Add Product</a>
        <?php endif; ?>
    </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Search Bar -->
<div class="search-wrap">
    <form method="GET" action="<?= base_url('products') ?>" class="row g-2 align-items-center">
        <div class="col-md-10">
            <div class="input-wrap">
                <i class="bi bi-search"></i>
                <input type="text" name="search" class="form-control" placeholder="Search by name, SKU, or category..." value="<?= esc($search) ?>">
            </div>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Search</button>
        </div>
    </form>
</div>

<div class="main-card">
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead>
                <tr>
                    <th>SKU</th>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Sizes</th>
                    <th>Colors</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products) && is_array($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td class="sku-cell"><?= esc($product['sku']); ?></td>
                            <td>
                                <?php if (!empty($product['base_image'])): ?>
                                    <img src="<?= base_url('uploads/products/' . esc($product['base_image'])) ?>" alt="<?= esc($product['name']) ?>" class="product-thumb">
                                <?php else: ?>
                                    <div class="no-img">No Img</div>
                                <?php endif; ?>
                            </td>
                            <td><strong><?= esc($product['name']); ?></strong></td>
                            <td style="color:var(--txt-2)"><?= esc($product['category']); ?></td>
                            <td>
                                <?php
                                    $sizes = explode(',', $product['sizes']);
                                    foreach ($sizes as $size) {
                                        if (trim($size) !== '') {
                                            echo '<span class="badge bg-secondary me-1">' . esc(trim($size)) . '</span>';
                                        }
                                    }
                                ?>
                            </td>
                            <td style="color:var(--txt-2);font-size:.85rem"><?= esc($product['colors']); ?></td>
                            <td class="price-cell">₱<?= number_format($product['selling_price'], 2); ?></td>
                            <td>
                                <?php if ($product['total_stock'] <= 5): ?>
                                    <span class="badge bg-danger"><?= esc($product['total_stock']); ?> Left</span>
                                <?php else: ?>
                                    <span class="badge bg-success"><?= esc($product['total_stock']); ?> In Stock</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($product['status'] === 'Active'): ?>
                                    <span class="status-active">Active</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark"><?= esc($product['status']); ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (session()->get('role_id') <= 2): ?>
                                <a href="<?= base_url('products/edit/' . $product['id']); ?>" class="btn btn-sm btn-info text-white">Edit</a>
                                <?php endif; ?>
                                <?php if (session()->get('role_id') == 1): ?>
                                <a href="<?= base_url('products/delete/' . $product['id']); ?>"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Are you sure you want to delete this product?');">
                                   Delete
                                </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10">
                            <div class="empty-state">
                                <?php if ($search): ?>
                                    <h5>No products found for "<?= esc($search) ?>".</h5>
                                    <a href="<?= base_url('products') ?>">Clear search</a>
                                <?php else: ?>
                                    <h5>No products found.</h5>
                                    <p>Click "+ Add Product" to start building your inventory.</p>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <?php if ($pager): ?>
        <div class="card-footer bg-white">
            <?= $pager->links() ?>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection(); ?>
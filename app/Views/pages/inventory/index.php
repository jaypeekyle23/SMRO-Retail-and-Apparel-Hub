<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>

<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">

<style>
  :root {
    --bg:        #F7F3EF;
    --surface:   #FFFFFF;
    --border:    #EBE5DF;
    --accent:    #C96A2E;
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
  .btn-primary  { background: var(--accent) !important; border-color: var(--accent) !important; font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 600; border-radius: 8px; padding: .52rem 1.15rem; color: #fff !important; }
  .btn-primary:hover { background: #b35a23 !important; border-color: #b35a23 !important; }
  .btn-success  { background: var(--ok) !important; border-color: var(--ok) !important; font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 600; border-radius: 8px; padding: .52rem 1.15rem; color: #fff !important; }
  .btn-success:hover { background: #178a4e !important; }
  .btn-secondary { background: var(--surface) !important; border: 1px solid var(--border) !important; color: var(--txt-2) !important; font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 500; border-radius: 8px; padding: .52rem 1.15rem; }
  .btn-secondary:hover { background: var(--bg) !important; }

  /* ── Alert ───────────────────────────────────── */
  .alert-success { background: var(--ok-bg); border: 1px solid #A7D7BE; color: #155235; border-radius: var(--r); font-size: .875rem; }
  .alert-danger  { background: var(--danger-bg); border: 1px solid #F0C4C0; color: var(--danger); border-radius: var(--r); font-size: .875rem; }

  /* ── Search wrap ─────────────────────────────── */
  .search-wrap { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); padding: .75rem 1rem; margin-bottom: 1rem; }
  .search-wrap .form-control { border: 1px solid var(--border); border-radius: 8px; background: var(--bg); font-size: .875rem; color: var(--txt); padding-left: 2.4rem; }
  .search-wrap .form-control:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(201,106,46,.12); background: var(--surface); outline: none; }
  .search-wrap .input-wrap   { position: relative; }
  .search-wrap .input-wrap i { position: absolute; left: .8rem; top: 50%; transform: translateY(-50%); color: var(--txt-3); font-size: .9rem; pointer-events: none; }

  /* ── Main card ───────────────────────────────── */
  .main-card    { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); overflow: hidden; }
  .card-footer  { background: var(--surface) !important; border-top: 1px solid var(--border) !important; padding: .85rem 1.5rem !important; }

  /* ── Table ───────────────────────────────────── */
  .table { margin-bottom: 0; }
  .table thead th { font-family: 'Sora', sans-serif; font-size: .67rem; font-weight: 600; letter-spacing: .09em; text-transform: uppercase; color: var(--txt-3); background: var(--bg); border-bottom: 1px solid var(--border) !important; border-top: none; padding: .85rem 1rem; white-space: nowrap; }
  .table tbody td { border-bottom: 1px solid var(--border) !important; border-top: none; padding: .9rem 1rem; vertical-align: middle; font-size: .875rem; color: var(--txt); }
  .table-hover tbody tr:hover { background: #FBF7F4 !important; }
  .table tbody tr:last-child td { border-bottom: none !important; }

  /* ── Variant SKU badge ───────────────────────── */
  .badge.bg-secondary { background: transparent !important; border: 1px solid var(--border) !important; color: var(--txt-2) !important; font-size: .68rem; font-weight: 500; padding: .25em .55em; border-radius: 5px; }

  /* ── Movement badges ─────────────────────────── */
  .badge.bg-success { background: var(--ok-bg) !important; color: var(--ok) !important; font-size: .72rem; font-weight: 700; border-radius: 6px; padding: .3em .7em; letter-spacing: .04em; }
  .badge.bg-danger  { background: var(--danger-bg) !important; color: var(--danger) !important; font-size: .72rem; font-weight: 700; border-radius: 6px; padding: .3em .7em; letter-spacing: .04em; }

  /* ── Qty column ──────────────────────────────── */
  .qty-in  { font-family: 'Sora', sans-serif; font-weight: 700; font-size: 1rem; color: var(--ok); }
  .qty-out { font-family: 'Sora', sans-serif; font-weight: 700; font-size: 1rem; color: var(--danger); }

  /* ── Empty state ─────────────────────────────── */
  .empty-state { padding: 3.5rem 1rem; text-align: center; color: var(--txt-3); }
  .empty-state i  { font-size: 2rem; display: block; margin-bottom: .5rem; }
  .empty-state h5 { font-family: 'Sora', sans-serif; font-size: 1rem; color: var(--txt-2); margin-bottom: .4rem; }
  .empty-state a  { color: var(--accent); font-weight: 500; text-decoration: none; }
  .empty-state a:hover { text-decoration: underline; }

  /* ── Pagination ──────────────────────────────── */
  .pagination .page-link { border-color: var(--border); color: var(--txt-2); font-size: .8rem; border-radius: 6px !important; margin: 0 2px; }
  .pagination .page-item.active .page-link { background: var(--accent); border-color: var(--accent); color: #fff; }
  .pagination .page-link:hover { background: var(--accent-bg); color: var(--accent); }

  /* ── Modal ───────────────────────────────────── */
  .modal-content  { border: 1px solid var(--border) !important; border-radius: var(--r) !important; box-shadow: 0 8px 32px rgba(0,0,0,.12) !important; overflow: hidden; }
  .modal-header   { background: var(--bg) !important; border-bottom: 1px solid var(--border) !important; padding: 1.25rem 1.5rem !important; }
  .modal-title    { font-family: 'Sora', sans-serif; font-size: .95rem; font-weight: 700; color: var(--txt); }
  .modal-body     { padding: 1.5rem !important; background: var(--surface); }
  .modal-footer   { background: var(--bg) !important; border-top: 1px solid var(--border) !important; padding: 1rem 1.5rem !important; }

  /* ── Modal form controls ─────────────────────── */
  .modal .form-label  { font-family: 'Sora', sans-serif; font-size: .68rem; font-weight: 600; letter-spacing: .08em; text-transform: uppercase; color: var(--txt-3); margin-bottom: .4rem; }
  .modal .form-control,
  .modal .form-select { border: 1px solid var(--border); border-radius: 8px; background: var(--bg); font-size: .875rem; color: var(--txt); padding: .55rem .85rem; transition: border-color .15s, box-shadow .15s; }
  .modal .form-control::placeholder { color: var(--txt-3); }
  .modal .form-control:focus,
  .modal .form-select:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(201,106,46,.12); background: var(--surface); outline: none; }
</style>

<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0 text-gray-800"><strong><?= $title; ?></strong></h1>
        <p class="text-muted">Track the history of stock movements (In / Out).</p>
    </div>
    <?php if (session()->get('role_id') <= 2): ?>
    <button type="button" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#adjustStockModal">
        + Adjust Stock
    </button>
    <?php endif; ?>
</div>

<?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success shadow-sm"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<!-- Search Bar -->
<div class="search-wrap">
    <form method="GET" action="<?= base_url('inventory') ?>" class="row g-2 align-items-center">
        <div class="col-md-10">
            <div class="input-wrap">
                <i class="bi bi-search"></i>
                <input type="text" name="search" class="form-control" placeholder="Search by product name, SKU, or remarks..." value="<?= esc($search) ?>">
            </div>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Search</button>
            <a href="<?= base_url('inventory/export') ?>?search=<?= esc($search) ?>" class="btn btn-success w-100 mt-2">Export CSV</a>
        </div>
    </form>
</div>

<div class="main-card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Date & Time</th>
                    <th>Product</th>
                    <th>Variant (Size/Color)</th>
                    <th>Movement</th>
                    <th>Qty</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($logs)): ?>
                    <?php foreach ($logs as $log): ?>
                        <tr>
                            <td style="color:var(--txt-3);font-size:.8rem;white-space:nowrap"><?= date('M d, Y h:i A', strtotime($log['created_at'])) ?></td>
                            <td class="fw-bold"><?= esc($log['product_name']) ?></td>
                            <td>
                                <?php if ($log['variant_sku']): ?>
                                    <span class="badge bg-secondary me-1"><?= esc($log['variant_sku']) ?></span>
                                    <span style="color:var(--txt-2);font-size:.82rem"><?= esc($log['size']) ?> / <?= esc($log['color']) ?></span>
                                <?php else: ?>
                                    <span class="text-muted fst-italic">N/A</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($log['movement_type'] === 'in'): ?>
                                    <span class="badge bg-success">STOCK IN</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">STOCK OUT</span>
                                <?php endif; ?>
                            </td>
                            <td class="<?= $log['movement_type'] === 'in' ? 'qty-in' : 'qty-out' ?>">
                                <?= $log['movement_type'] === 'in' ? '+' : '-' ?><?= esc($log['quantity']) ?>
                            </td>
                            <td style="color:var(--txt-2);font-size:.85rem"><?= esc($log['remarks'] ?: 'No remarks') ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <?php if ($search): ?>
                                    <h5>No results found for "<?= esc($search) ?>".</h5>
                                    <a href="<?= base_url('inventory') ?>">Clear search</a>
                                <?php else: ?>
                                    <i class="bi bi-inbox"></i>
                                    <em>No stock movements recorded yet.</em>
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

<?php if (session()->get('role_id') <= 2): ?>
<!-- Adjust Stock Modal -->
<div class="modal fade" id="adjustStockModal" tabindex="-1" aria-labelledby="adjustStockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= base_url('inventory/adjust') ?>" method="POST">
            <div class="modal-content border-0 shadow">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="adjustStockModalLabel">Adjust Inventory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if(session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <div class="mb-3">
                        <label class="form-label">Select Product & Variant</label>
                        <select name="variant_id" class="form-select" required>
                            <option value="" disabled selected>Choose a specific item...</option>
                            <?php if(!empty($variants)): ?>
                                <?php foreach($variants as $variant): ?>
                                    <option value="<?= $variant['id'] ?>">
                                        <?= esc($variant['product_name']) ?> —
                                        <?= esc($variant['size']) ?> / <?= esc($variant['color']) ?>
                                        (Current Stock: <?= $variant['stock_quantity'] ?>)
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Movement Type</label>
                            <select name="movement_type" class="form-select" required>
                                <option value="in">STOCK IN (+)</option>
                                <option value="out">STOCK OUT (-)</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Quantity</label>
                            <input type="number" name="quantity" class="form-control" min="1" required>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Remarks / Reason</label>
                        <input type="text" name="remarks" class="form-control" placeholder="e.g., Restock shipment, Damaged item..." required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Adjustment</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php endif; ?>

<?= $this->endSection(); ?>
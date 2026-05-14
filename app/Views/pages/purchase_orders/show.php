<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">

<style>
  :root {
    --bg:         #F7F3EF;
    --surface:    #FFFFFF;
    --border:     #EBE5DF;
    --accent:     #C96A2E;
    --accent-bg:  #FBF0E9;
    --txt:        #1A1714;
    --txt-2:      #6B6360;
    --txt-3:      #A89F9B;
    --ok:         #1F9E5C;
    --ok-bg:      #E8F8EF;
    --warn:       #B45309;
    --warn-bg:    #FEF3C7;
    --danger:     #C0392B;
    --danger-bg:  #FDECEA;
    --r:          12px;
    --shadow:     0 2px 12px rgba(0,0,0,.06);
  }

  body, .content-wrapper, main { background: var(--bg) !important; font-family: 'DM Sans', sans-serif; }

  /* ── Page header ── */
  .page-header h1      { font-family: 'Sora', sans-serif; font-size: 1.6rem; color: var(--txt); letter-spacing: -.02em; }
  .btn-secondary       { background: var(--surface) !important; border: 1px solid var(--border) !important; color: var(--txt-2) !important; font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 600; border-radius: 8px; padding: .5rem 1.1rem; }
  .btn-secondary:hover { background: var(--bg) !important; color: var(--txt) !important; }

  /* ── Alerts ── */
  .alert-success { background: var(--ok-bg); border: 1px solid #A7D7BE; color: #155235; border-radius: var(--r); font-size: .875rem; }
  .alert-danger  { background: var(--danger-bg); border: 1px solid #F0C4C0; color: var(--danger); border-radius: var(--r); font-size: .875rem; }

  /* ── Cards ── */
  .main-card      { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); overflow: hidden; }
  .card-section-header { padding: .85rem 1.25rem; border-bottom: 1px solid var(--border); background: var(--bg); }
  .card-section-header h5 { font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 600; letter-spacing: .05em; text-transform: uppercase; color: var(--txt-3); margin: 0; }

  /* ── PO Summary ── */
  .po-summary            { padding: 1.5rem; }
  .po-summary .info-label { font-family: 'Sora', sans-serif; font-size: .67rem; font-weight: 600; letter-spacing: .09em; text-transform: uppercase; color: var(--txt-3); margin-bottom: .3rem; }
  .po-summary .info-value { font-family: 'Sora', sans-serif; font-size: 1rem; font-weight: 700; color: var(--txt); margin: 0; }
  .po-summary .notes-block { margin-top: 1.25rem; padding-top: 1.25rem; border-top: 1px solid var(--border); }
  .po-summary .notes-block p { font-size: .875rem; color: var(--txt-2); margin: 0; }

  /* ── Badges ── */
  .badge.bg-warning { background: var(--warn-bg) !important; color: var(--warn) !important; font-size: .8rem; font-weight: 600; border-radius: 6px; padding: .35em .75em; }
  .badge.bg-success { background: var(--ok-bg) !important; color: var(--ok) !important; font-size: .8rem; font-weight: 600; border-radius: 6px; padding: .35em .75em; }
  .badge.bg-danger  { background: var(--danger-bg) !important; color: var(--danger) !important; font-size: .8rem; font-weight: 600; border-radius: 6px; padding: .35em .75em; }

  /* ── Action buttons ── */
  .btn-success      { background: var(--ok-bg) !important; border: 1px solid #A7D7BE !important; color: var(--ok) !important; font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 600; border-radius: 8px; padding: .5rem 1.1rem; }
  .btn-success:hover { background: #d1f0e0 !important; }
  .btn-danger       { background: var(--danger-bg) !important; border: 1px solid #F0C4C0 !important; color: var(--danger) !important; font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 600; border-radius: 8px; padding: .5rem 1.1rem; }
  .btn-danger:hover  { background: #f5d0cc !important; }

  /* ── Table ── */
  .table            { margin-bottom: 0; }
  .table thead th   { font-family: 'Sora', sans-serif; font-size: .67rem; font-weight: 600; letter-spacing: .09em; text-transform: uppercase; color: var(--txt-3); background: var(--bg); border-bottom: 1px solid var(--border) !important; border-top: none; padding: .85rem 1rem; white-space: nowrap; }
  .table tbody td   { border-bottom: 1px solid var(--border) !important; border-top: none; padding: .9rem 1rem; vertical-align: middle; font-size: .875rem; color: var(--txt); }
  .table-hover tbody tr:hover { background: #FBF7F4 !important; }
  .table tbody tr:last-child td { border-bottom: none !important; }

  .sku-cell         { font-family: 'Sora', sans-serif; font-size: .75rem; font-weight: 600; color: var(--accent); letter-spacing: .02em; }
  .price-cell       { font-family: 'Sora', sans-serif; font-weight: 700; color: var(--accent); }
  .row-num          { font-family: 'Sora', sans-serif; font-size: .75rem; color: var(--txt-3); font-weight: 600; }

  /* ── Tfoot grand total ── */
  .table tfoot td   { border-top: 2px solid var(--border) !important; border-bottom: none !important; padding: .9rem 1rem; background: var(--bg); font-family: 'Sora', sans-serif; font-size: .875rem; font-weight: 700; color: var(--txt); }
  .grand-total-val  { font-family: 'Sora', sans-serif; font-size: 1rem; font-weight: 700; color: var(--accent); }

  /* ── Empty ── */
  .empty-state      { padding: 3rem 1rem; text-align: center; color: var(--txt-3); font-size: .875rem; }
</style>

<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0"><strong>Purchase Order Detail</strong></h1>
    </div>
    <a href="<?= base_url('purchase-orders') ?>" class="btn btn-secondary">← Back to Purchase Orders</a>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- PO Summary -->
<div class="main-card mb-4">
    <div class="card-section-header"><h5>Order Summary</h5></div>
    <div class="po-summary">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="info-label">PO Number</div>
                <div class="info-value"><?= esc($po['po_number']) ?></div>
            </div>
            <div class="col-md-3">
                <div class="info-label">Supplier</div>
                <div class="info-value"><?= esc($supplier['name'] ?? '—') ?></div>
            </div>
            <div class="col-md-3">
                <div class="info-label">Status</div>
                <div class="mt-1">
                    <?php if ($po['status'] === 'pending'): ?>
                        <span class="badge bg-warning text-dark">Pending</span>
                    <?php elseif ($po['status'] === 'received'): ?>
                        <span class="badge bg-success">Received</span>
                    <?php else: ?>
                        <span class="badge bg-danger">Cancelled</span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-label">Date Created</div>
                <div class="info-value"><?= date('M d, Y', strtotime($po['created_at'])) ?></div>
            </div>
        </div>
        <?php if (!empty($po['notes'])): ?>
            <div class="notes-block">
                <div class="info-label mb-1">Notes</div>
                <p><?= esc($po['notes']) ?></p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Action Buttons -->
<?php if ($po['status'] === 'pending'): ?>
    <div class="mb-4 d-flex gap-2">
        <form action="<?= base_url('purchase-orders/receive/' . $po['id']) ?>" method="POST" onsubmit="return confirm('Mark this PO as received? This will add stock to inventory.')">
            <?= csrf_field() ?>
            <button type="submit" class="btn btn-success">✔ Mark as Received</button>
        </form>
        <a href="<?= base_url('purchase-orders/cancel/' . $po['id']) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this PO?')">✖ Cancel PO</a>
    </div>
<?php endif; ?>

<!-- Items Table -->
<div class="main-card">
    <div class="card-section-header"><h5>Order Items</h5></div>
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Quantity</th>
                    <th>Cost Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($items)): ?>
                    <?php $grandTotal = 0; ?>
                    <?php foreach ($items as $i => $item): ?>
                        <?php $subtotal = $item['quantity'] * $item['cost_price']; $grandTotal += $subtotal; ?>
                        <tr>
                            <td class="row-num"><?= $i + 1 ?></td>
                            <td><strong style="font-size:.875rem;color:var(--txt);font-family:'DM Sans',sans-serif;font-weight:600"><?= esc($item['product_name']) ?></strong></td>
                            <td class="sku-cell"><?= esc($item['sku']) ?></td>
                            <td style="color:var(--txt-2)"><?= esc($item['size']) ?></td>
                            <td style="color:var(--txt-2)"><?= esc($item['color']) ?></td>
                            <td style="color:var(--txt-2)"><?= $item['quantity'] ?></td>
                            <td class="price-cell">₱<?= number_format($item['cost_price'], 2) ?></td>
                            <td class="price-cell">₱<?= number_format($subtotal, 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8"><div class="empty-state">No items found.</div></td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <?php if (!empty($items)): ?>
                <tfoot>
                    <tr>
                        <td colspan="7" class="text-end">Grand Total</td>
                        <td class="grand-total-val">₱<?= number_format($grandTotal, 2) ?></td>
                    </tr>
                </tfoot>
            <?php endif; ?>
        </table>
    </div>
</div>

<?= $this->endSection(); ?>
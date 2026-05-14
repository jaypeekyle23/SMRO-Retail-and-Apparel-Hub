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
    --r:         12px;
    --shadow:    0 2px 12px rgba(0,0,0,.06);
  }

  body, .content-wrapper, main { background: var(--bg) !important; font-family: 'DM Sans', sans-serif; }

  /* ── Header ──────────────────────────────────── */
  h1 { font-family: 'Sora', sans-serif; font-size: 1.6rem; color: var(--txt); letter-spacing: -.02em; }

  /* ── Buttons ─────────────────────────────────── */
  .btn-success   { background: var(--ok) !important; border-color: var(--ok) !important; font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 600; border-radius: 8px; padding: .52rem 1.15rem; color: #fff !important; }
  .btn-success:hover { background: #178a4e !important; }
  .btn-secondary { background: var(--surface) !important; border: 1px solid var(--border) !important; color: var(--txt-2) !important; font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 500; border-radius: 8px; padding: .52rem 1.15rem; }
  .btn-secondary:hover { background: var(--bg) !important; }

  /* ── Summary card ────────────────────────────── */
  .summary-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); padding: 1.5rem; margin-bottom: 1.5rem; }
  .summary-field p  { font-family: 'Sora', sans-serif; font-size: .68rem; font-weight: 600; letter-spacing: .08em; text-transform: uppercase; color: var(--txt-3); margin-bottom: .3rem; }
  .summary-field h5 { font-family: 'Sora', sans-serif; font-size: 1rem; font-weight: 700; color: var(--txt); margin: 0; }
  .summary-field h5.accent { color: var(--accent); font-size: 1.2rem; }
  .summary-divider { width: 1px; background: var(--border); align-self: stretch; margin: 0 1.5rem; }

  /* ── Items card ──────────────────────────────── */
  .main-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); overflow: hidden; }
  .main-card .card-header { background: var(--surface); border-bottom: 1px solid var(--border); padding: 1rem 1.5rem; }
  .main-card .card-header h5 { font-family: 'Sora', sans-serif; font-size: .88rem; font-weight: 700; color: var(--txt); margin: 0; }

  /* ── Table ───────────────────────────────────── */
  .table { margin-bottom: 0; }
  .table thead th { font-family: 'Sora', sans-serif; font-size: .67rem; font-weight: 600; letter-spacing: .09em; text-transform: uppercase; color: var(--txt-3); background: var(--bg); border-bottom: 1px solid var(--border) !important; border-top: none; padding: .85rem 1rem; white-space: nowrap; }
  .table tbody td { border-bottom: 1px solid var(--border) !important; border-top: none; padding: .9rem 1rem; vertical-align: middle; font-size: .875rem; color: var(--txt); }
  .table tbody tr:last-child td { border-bottom: none !important; }
  .table tfoot td { border-top: 2px solid var(--border) !important; border-bottom: none !important; padding: 1rem; background: var(--bg); font-family: 'Sora', sans-serif; font-size: .9rem; font-weight: 700; color: var(--txt); }
  .table tfoot .total-amount { color: var(--accent); font-size: 1rem; }
  .table-hover tbody tr:hover { background: #FBF7F4 !important; }

  /* ── SKU badge ───────────────────────────────── */
  .sku-text { font-family: 'Sora', sans-serif; font-size: .75rem; font-weight: 600; color: var(--accent); }
  .row-num  { font-family: 'Sora', sans-serif; font-size: .75rem; color: var(--txt-3); font-weight: 600; }

  /* ── Empty state ─────────────────────────────── */
  .empty-cell { padding: 3rem 1rem; text-align: center; color: var(--txt-3); font-size: .875rem; }

  /* ── Print styles ────────────────────────────── */
  @media print {
    body * { visibility: hidden; }
    .container-fluid, .container-fluid * { visibility: visible; }
    .container-fluid { position: absolute; left: 0; top: 0; width: 100%; }
    .btn { display: none !important; }
  }
</style>

<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3"><strong>Order Detail</strong></h1>
        <div class="d-flex gap-2">
            <button onclick="window.print()" class="btn btn-success">🖨 Print Receipt</button>
            <a href="<?= base_url('sales') ?>" class="btn btn-secondary">← Back to Sales</a>
        </div>
    </div>

    <!-- Order Summary Card -->
    <div class="summary-card">
        <div class="d-flex flex-wrap gap-4">
            <div class="summary-field">
                <p>Order Number</p>
                <h5><?= esc($order['order_number']) ?></h5>
            </div>
            <div class="summary-divider d-none d-md-block"></div>
            <div class="summary-field">
                <p>Date & Time</p>
                <h5><?= date('M d, Y h:i A', strtotime($order['created_at'])) ?></h5>
            </div>
            <div class="summary-divider d-none d-md-block"></div>
            <div class="summary-field">
                <p>Total Amount</p>
                <h5 class="accent">₱<?= number_format($order['total_amount'], 2) ?></h5>
            </div>
        </div>
    </div>

    <!-- Order Items Table -->
    <div class="main-card">
        <div class="card-header">
            <h5 class="card-title mb-0">Items Purchased</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>SKU</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Qty</th>
                        <th>Unit Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($items)): ?>
                        <?php foreach ($items as $i => $item): ?>
                            <tr>
                                <td class="row-num"><?= $i + 1 ?></td>
                                <td style="font-weight:600"><?= esc($item['product_name']) ?></td>
                                <td class="sku-text"><?= esc($item['sku']) ?></td>
                                <td style="color:var(--txt-2)"><?= esc($item['size']) ?></td>
                                <td style="color:var(--txt-2)"><?= esc($item['color']) ?></td>
                                <td style="font-family:'Sora',sans-serif;font-weight:600"><?= $item['quantity'] ?></td>
                                <td style="color:var(--txt-2)">₱<?= number_format($item['price'], 2) ?></td>
                                <td style="font-family:'Sora',sans-serif;font-weight:700">₱<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="8" class="empty-cell">No items found for this order.</td></tr>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7" class="text-end">Total</td>
                        <td class="total-amount">₱<?= number_format($order['total_amount'], 2) ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
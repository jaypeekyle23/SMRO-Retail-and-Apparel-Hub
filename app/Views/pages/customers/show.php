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
  .btn-secondary    { background: var(--surface) !important; border: 1px solid var(--border) !important; color: var(--txt-2) !important; font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 500; border-radius: 8px; padding: .52rem 1.15rem; }
  .btn-secondary:hover { background: var(--bg) !important; }
  .btn-primary      { background: var(--accent) !important; border-color: var(--accent) !important; font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 600; border-radius: 8px; padding: .52rem 1.15rem; color: #fff !important; }
  .btn-sm.btn-primary { padding: .3rem .85rem; font-size: .78rem; border-radius: 6px; }

  /* ── Info card ───────────────────────────────── */
  .info-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); padding: 1.5rem; margin-bottom: 1.5rem; }
  .info-field p  { font-family: 'Sora', sans-serif; font-size: .68rem; font-weight: 600; letter-spacing: .08em; text-transform: uppercase; color: var(--txt-3); margin-bottom: .3rem; }
  .info-field h5 { font-family: 'Sora', sans-serif; font-size: 1rem; font-weight: 700; color: var(--txt); margin: 0; }
  .info-field h5.accent { color: var(--accent); font-size: 1.15rem; }
  .info-divider  { border: none; border-top: 1px solid var(--border); margin: 1.25rem 0; }

  /* ── Stat row ────────────────────────────────── */
  .stat-icon { width: 36px; height: 36px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: .95rem; margin-bottom: .6rem; }
  .stat-icon.primary { background: var(--accent-bg); color: var(--accent); }
  .stat-icon.success { background: var(--ok-bg); color: var(--ok); }
  .stat-icon.muted   { background: var(--bg); color: var(--txt-3); border: 1px solid var(--border); }

  /* ── Main card ───────────────────────────────── */
  .main-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); overflow: hidden; }
  .main-card .card-header { background: var(--surface); border-bottom: 1px solid var(--border); padding: 1rem 1.5rem; }
  .main-card .card-header h5 { font-family: 'Sora', sans-serif; font-size: .88rem; font-weight: 700; color: var(--txt); margin: 0; }

  /* ── Table ───────────────────────────────────── */
  .table { margin-bottom: 0; }
  .table thead th { font-family: 'Sora', sans-serif; font-size: .67rem; font-weight: 600; letter-spacing: .09em; text-transform: uppercase; color: var(--txt-3); background: var(--bg); border-bottom: 1px solid var(--border) !important; border-top: none; padding: .85rem 1rem; white-space: nowrap; }
  .table tbody td { border-bottom: 1px solid var(--border) !important; border-top: none; padding: .9rem 1rem; vertical-align: middle; font-size: .875rem; color: var(--txt); }
  .table-hover tbody tr:hover { background: #FBF7F4 !important; }
  .table tbody tr:last-child td { border-bottom: none !important; }
  .order-num { font-family: 'Sora', sans-serif; font-size: .78rem; font-weight: 700; color: var(--accent); }

  /* ── Empty state ─────────────────────────────── */
  .empty-cell { padding: 3rem 1rem; text-align: center; color: var(--txt-3); font-size: .875rem; }

  /* ── Pagination ──────────────────────────────── */
  .pagination .page-link { border-color: var(--border); color: var(--txt-2); font-size: .8rem; border-radius: 6px !important; margin: 0 2px; }
  .pagination .page-item.active .page-link { background: var(--accent); border-color: var(--accent); color: #fff; }
  .pagination .page-link:hover { background: var(--accent-bg); color: var(--accent); }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><strong>Customer Detail</strong></h1>
    <a href="<?= base_url('customers') ?>" class="btn btn-secondary">← Back to Customers</a>
</div>

<!-- Customer Info Card -->
<div class="info-card">
    <div class="row g-4">
        <div class="col-md-4 info-field">
            <p>Name</p>
            <h5><?= esc($customer['name']) ?></h5>
        </div>
        <div class="col-md-4 info-field">
            <p>Phone</p>
            <h5><?= esc($customer['phone'] ?: '—') ?></h5>
        </div>
        <div class="col-md-4 info-field">
            <p>Email</p>
            <h5><?= esc($customer['email'] ?: '—') ?></h5>
        </div>
    </div>

    <hr class="info-divider">

    <div class="row g-4">
        <div class="col-md-4">
            <div class="stat-icon primary"><i class="bi bi-receipt"></i></div>
            <div class="info-field">
                <p>Total Orders</p>
                <h5><?= count($orders) ?></h5>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-icon success"><i class="bi bi-cash-stack"></i></div>
            <div class="info-field">
                <p>Total Spent</p>
                <h5 class="accent">₱<?= number_format($totalSpent, 2) ?></h5>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-icon muted"><i class="bi bi-calendar3"></i></div>
            <div class="info-field">
                <p>Member Since</p>
                <h5><?= date('M d, Y', strtotime($customer['created_at'])) ?></h5>
            </div>
        </div>
    </div>
</div>

<!-- Order History -->
<div class="main-card">
    <div class="card-header">
        <h5 class="card-title mb-0">Order History</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
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
                            <td class="order-num"><?= esc($order['order_number']) ?></td>
                            <td style="font-family:'Sora',sans-serif;font-weight:600">₱<?= number_format($order['total_amount'], 2) ?></td>
                            <td style="color:var(--txt-3);font-size:.8rem;white-space:nowrap"><?= date('M d, Y h:i A', strtotime($order['created_at'])) ?></td>
                            <td>
                                <a href="<?= base_url('sales/' . $order['id']) ?>" class="btn btn-sm btn-primary">View</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4" class="empty-cell">No orders found for this customer.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection(); ?>
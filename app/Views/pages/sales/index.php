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
    --warn:      #B45309;
    --warn-bg:   #FEF3C7;
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
  .btn-primary:hover { background: #b35a23 !important; }
  .btn-success  { background: var(--ok) !important; border-color: var(--ok) !important; font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 600; border-radius: 8px; padding: .52rem 1.15rem; color: #fff !important; }
  .btn-success:hover { background: #178a4e !important; }
  .btn-sm.btn-primary { padding: .3rem .85rem; font-size: .78rem; border-radius: 6px; }

  /* ── Filter card ─────────────────────────────── */
  .filter-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); padding: 1.25rem 1.5rem; margin-bottom: 1.5rem; }
  .filter-card .form-label { font-family: 'Sora', sans-serif; font-size: .75rem; font-weight: 600; color: var(--txt-2); margin-bottom: .35rem; }
  .filter-card .form-control { border: 1px solid var(--border); border-radius: 8px; background: var(--bg); font-size: .875rem; color: var(--txt); padding: .52rem .85rem; transition: border-color .15s, box-shadow .15s; }
  .filter-card .form-control:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(201,106,46,.12); background: var(--surface); outline: none; }

  /* ── Stat cards ──────────────────────────────── */
  .stat-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); padding: 1.25rem 1.5rem; }
  .stat-label { font-family: 'Sora', sans-serif; font-size: .68rem; font-weight: 600; letter-spacing: .08em; text-transform: uppercase; color: var(--txt-3); margin-bottom: .45rem; }
  .stat-value { font-family: 'Sora', sans-serif; font-weight: 700; color: var(--txt); line-height: 1.1; }
  .stat-value.large { font-size: 2rem; }
  .stat-value.medium { font-size: 1.15rem; }
  .stat-icon { width: 38px; height: 38px; border-radius: 9px; display: flex; align-items: center; justify-content: center; font-size: 1rem; margin-bottom: .75rem; }
  .stat-icon.primary { background: var(--accent-bg); color: var(--accent); }
  .stat-icon.success { background: var(--ok-bg); color: var(--ok); }
  .stat-icon.warn    { background: var(--warn-bg); color: var(--warn); }

  /* ── Main card ───────────────────────────────── */
  .main-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); overflow: hidden; }
  .main-card .card-header { background: var(--surface); border-bottom: 1px solid var(--border); padding: 1rem 1.5rem; }
  .main-card .card-header h4 { font-family: 'Sora', sans-serif; font-size: .88rem; font-weight: 700; color: var(--txt); margin: 0; }
  .card-footer { background: var(--surface) !important; border-top: 1px solid var(--border) !important; padding: .85rem 1.5rem !important; }

  /* ── Tables ──────────────────────────────────── */
  .table { margin-bottom: 0; }
  .table thead th { font-family: 'Sora', sans-serif; font-size: .67rem; font-weight: 600; letter-spacing: .09em; text-transform: uppercase; color: var(--txt-3); background: var(--bg); border-bottom: 1px solid var(--border) !important; border-top: none; padding: .85rem 1rem; white-space: nowrap; }
  .table tbody td { border-bottom: 1px solid var(--border) !important; border-top: none; padding: .9rem 1rem; vertical-align: middle; font-size: .875rem; color: var(--txt); }
  .table-hover tbody tr:hover { background: #FBF7F4 !important; }
  .table tbody tr:last-child td { border-bottom: none !important; }

  /* ── Order number ────────────────────────────── */
  td.order-num { font-family: 'Sora', sans-serif; font-size: .78rem; font-weight: 700; color: var(--accent); }

  /* ── Empty state ─────────────────────────────── */
  .empty-cell { padding: 3rem 1rem; text-align: center; color: var(--txt-3); font-size: .875rem; }

  /* ── Pagination ──────────────────────────────── */
  .pagination .page-link { border-color: var(--border); color: var(--txt-2); font-size: .8rem; border-radius: 6px !important; margin: 0 2px; }
  .pagination .page-item.active .page-link { background: var(--accent); border-color: var(--accent); color: #fff; }
  .pagination .page-link:hover { background: var(--accent-bg); color: var(--accent); }
</style>

<!-- Page Header -->
<div class="page-header mb-4">
    <h1 class="h3 mb-0"><strong><?= esc($title) ?></strong></h1>
    <p class="text-muted">Monitor transactions, revenue, and top-performing products.</p>
</div>

<div class="container-fluid px-0 mt-2">

    <!-- Date Filter -->
    <div class="filter-card">
        <form method="GET" action="<?= base_url('sales') ?>" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label fw-bold">Date From</label>
                <input type="date" name="date_from" class="form-control" value="<?= esc($dateFrom) ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold">Date To</label>
                <input type="date" name="date_to" class="form-control" value="<?= esc($dateTo) ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Search Order ID</label>
                <input type="text" name="search" class="form-control" placeholder="Search order number..." value="<?= esc($search) ?>">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
                <a href="<?= base_url('sales/export') ?>?date_from=<?= esc($dateFrom) ?>&date_to=<?= esc($dateTo) ?>" class="btn btn-success w-100 mt-2">Export CSV</a>
            </div>
        </form>
    </div>

    <!-- Summary Stats -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="stat-card h-100">
                <div class="stat-icon primary"><i class="bi bi-receipt"></i></div>
                <div class="stat-label">Total Orders</div>
                <div class="stat-value large"><?= count($orders) ?></div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="stat-card h-100">
                <div class="stat-icon success"><i class="bi bi-cash-stack"></i></div>
                <div class="stat-label">Total Revenue</div>
                <div class="stat-value large">₱<?= number_format($totalRevenue, 2) ?></div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="stat-card h-100">
                <div class="stat-icon warn"><i class="bi bi-calendar-range"></i></div>
                <div class="stat-label">Period</div>
                <div class="stat-value medium"><?= date('M d, Y', strtotime($dateFrom)) ?> — <?= date('M d, Y', strtotime($dateTo)) ?></div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Orders Table -->
        <div class="col-lg-8 mb-4">
            <div class="main-card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Sales History</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Order ID</th>
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
                                <tr><td colspan="4" class="empty-cell">No sales found for this period.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <?php if ($pager): ?>
                    <div class="card-footer bg-white">
                        <?= $pager->links() ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Top Products -->
        <div class="col-lg-4 mb-4">
            <div class="main-card h-100">
                <div class="card-header">
                    <h4 class="card-title mb-0">Top Products</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm mb-0">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Sold</th>
                                <th>Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($topProducts)): ?>
                                <?php foreach ($topProducts as $product): ?>
                                    <tr>
                                        <td style="font-weight:600"><?= esc($product['name']) ?></td>
                                        <td style="color:var(--txt-2)"><?= esc($product['total_sold']) ?></td>
                                        <td style="font-family:'Sora',sans-serif;font-weight:600;color:var(--accent)">₱<?= number_format($product['revenue'], 2) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="3" class="empty-cell">No data.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>
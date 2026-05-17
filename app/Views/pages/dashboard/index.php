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
    --r:         14px;
    --shadow:    0 2px 12px rgba(0,0,0,.06);
  }

  body, .content-wrapper, main { background: var(--bg) !important; font-family: 'DM Sans', sans-serif; }

  /* ── Page header ─────────────────────────────── */
  .page-header h1 { font-family: 'Sora', sans-serif; font-size: 1.6rem; color: var(--txt); letter-spacing: -.02em; }
  .page-header p  { color: var(--txt-2); font-size: .875rem; margin: 0; }

  /* ── Stat cards ──────────────────────────────── */
  .stat-card { background: var(--surface); border-radius: var(--r); box-shadow: var(--shadow); border: 1px solid var(--border); padding: 1.4rem 1.5rem; }
  .stat-label { font-family: 'Sora', sans-serif; font-size: .68rem; font-weight: 600; letter-spacing: .08em; text-transform: uppercase; color: var(--txt-3); margin-bottom: .5rem; }
  .stat-value { font-family: 'Sora', sans-serif; font-size: 2rem; font-weight: 700; color: var(--txt); line-height: 1; }
  .stat-icon  { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; margin-bottom: .85rem; }
  .stat-icon.primary { background: var(--accent-bg); color: var(--accent); }
  .stat-icon.success { background: var(--ok-bg); color: var(--ok); }

  /* ── Generic card ────────────────────────────── */
  .card { background: var(--surface) !important; border: 1px solid var(--border) !important; border-radius: var(--r) !important; box-shadow: var(--shadow) !important; }
  .card-header { background: var(--surface) !important; border-bottom: 1px solid var(--border) !important; border-radius: var(--r) var(--r) 0 0 !important; padding: 1.25rem 1.5rem .85rem !important; }
  .card-body   { padding: 1.25rem 1.5rem !important; }
  .card-header h6 { font-family: 'Sora', sans-serif; font-size: .8rem; font-weight: 600; letter-spacing: .05em; }

  /* ── Table ───────────────────────────────────── */
  .table th { font-family: 'Sora', sans-serif; font-size: .7rem; font-weight: 600; letter-spacing: .07em; text-transform: uppercase; color: var(--txt-3); border-bottom: 1px solid var(--border) !important; padding: .6rem .5rem; }
  .table td { font-size: .875rem; color: var(--txt); border-bottom: 1px solid var(--border) !important; padding: .7rem .5rem; vertical-align: middle; }
  .table-hover tbody tr:hover { background: var(--bg) !important; }

  /* ── Activity list ───────────────────────────── */
  .list-group-item { border: none !important; border-bottom: 1px solid var(--border) !important; padding: .85rem 0 !important; }
  .list-group-item:last-child { border-bottom: none !important; }
  .list-group-item .fw-bold { font-size: .875rem; color: var(--txt); }
  .list-group-item .small   { font-size: .75rem; color: var(--txt-3); }

  /* ── Badges ──────────────────────────────────── */
  .badge.bg-danger  { background: var(--danger-bg) !important; color: var(--danger) !important; font-weight: 600; font-size: .72rem; border-radius: 6px; padding: .3em .6em; }
  .badge.bg-success { background: var(--ok-bg) !important; color: var(--ok) !important; font-weight: 600; font-size: .72rem; border-radius: 6px; padding: .3em .6em; }

  /* ── Chart card header accent ────────────────── */
  .text-primary { color: var(--accent) !important; }
  .text-danger  { color: var(--danger) !important; }

  /* ── Empty state ─────────────────────────────── */
  .empty-state { padding: 2.5rem 1rem; text-align: center; color: var(--txt-3); font-size: .875rem; }
  .empty-state i { font-size: 1.75rem; margin-bottom: .5rem; display: block; }
</style>

<div class="page-header mb-4">
  <h1 class="h3 mb-0 text-gray-800"><strong><?= esc($title); ?></strong></h1>
  <p class="text-muted">Welcome to your inventory control center.</p>
</div>

<div class="row mb-4">
  <div class="col-md-6 col-lg-3 mb-3">
    <div class="stat-card h-100">
      <div class="stat-icon primary">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M21 8V21H3V8"/><path d="M23 3H1v5h22V3z"/><path d="M10 12h4"/>
        </svg>
      </div>
      <div class="stat-label">Total Products</div>
      <div class="stat-value"><?= esc($totalProducts) ?></div>
    </div>
  </div>

  <div class="col-md-6 col-lg-3 mb-3">
    <div class="stat-card h-100">
      <div class="stat-icon success">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/>
        </svg>
      </div>
      <div class="stat-label">Total Items in Stock</div>
      <div class="stat-value"><?= esc($totalStock) ?></div>
    </div>
  </div>
</div>

<!-- Charts Row -->
<div class="row mb-4">
  <div class="col-lg-8 mb-4">
    <div class="card border-0 shadow-sm h-100">
      <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
        <h6 class="m-0 font-weight-bold text-primary">Daily Sales Revenue (Last 7 Days)</h6>
      </div>
      <div class="card-body">
        <canvas id="salesChart" height="120"></canvas>
      </div>
    </div>
  </div>
  <div class="col-lg-4 mb-4">
    <div class="card border-0 shadow-sm h-100">
      <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
        <h6 class="m-0 font-weight-bold text-primary">Top Selling Products</h6>
      </div>
      <div class="card-body">
        <canvas id="topProductsChart" height="120"></canvas>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6 mb-4">
    <div class="card border-0 shadow-sm h-100">
      <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
        <h6 class="m-0 font-weight-bold text-danger"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right:.4rem;vertical-align:-.1em"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg> Low Stock Alerts</h6>
      </div>
      <div class="card-body">
        <?php if (!empty($lowStockItems)): ?>
          <div class="table-responsive">
            <table class="table table-sm table-hover mb-0">
              <thead>
                <tr>
                  <th>Item</th>
                  <th>Variant</th>
                  <th>Stock</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($lowStockItems as $item): ?>
                  <tr>
                    <td class="fw-bold"><?= esc($item['product_name']) ?></td>
                    <td><?= esc($item['size']) ?> / <?= esc($item['color']) ?></td>
                    <td><span class="badge bg-danger"><?= esc($item['stock_quantity']) ?> Left</span></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php else: ?>
          <div class="empty-state">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#1F9E5C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:.5rem"><circle cx="12" cy="12" r="10"/><polyline points="9 12 11 14 15 10"/></svg>
            <em>All inventory levels look healthy!</em>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <div class="col-lg-6 mb-4">
    <div class="card border-0 shadow-sm h-100">
      <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
        <h6 class="m-0 font-weight-bold text-primary"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right:.4rem;vertical-align:-.1em"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> Recent Activity</h6>
      </div>
      <div class="card-body">
        <?php if (!empty($recentActivity)): ?>
          <ul class="list-group list-group-flush">
            <?php foreach ($recentActivity as $log): ?>
              <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                <div>
                  <div class="fw-bold"><?= esc($log['product_name']) ?> <span class="text-muted small">(<?= esc($log['size']) ?>/<?= esc($log['color']) ?>)</span></div>
                  <div class="small text-muted"><?= date('M d, Y h:i A', strtotime($log['created_at'])) ?></div>
                </div>
                <div>
                  <?php if ($log['movement_type'] === 'in'): ?>
                    <span class="badge bg-success">+<?= esc($log['quantity']) ?> (IN)</span>
                  <?php else: ?>
                    <span class="badge bg-danger">-<?= esc($log['quantity']) ?> (OUT)</span>
                  <?php endif; ?>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php else: ?>
          <div class="empty-state">
            <em>No recent activity found.</em>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Daily Sales Chart
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: <?= $salesLabels ?>,
            datasets: [{
                label: 'Revenue (₱)',
                data: <?= $salesData ?>,
                borderColor: '#C96A2E',
                backgroundColor: 'rgba(201,106,46,0.08)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: '#EBE5DF' }, ticks: { color: '#A89F9B', font: { family: 'DM Sans' } } },
                x: { grid: { display: false }, ticks: { color: '#A89F9B', font: { family: 'DM Sans' } } }
            }
        }
    });

    // Top Products Chart
    const topCtx = document.getElementById('topProductsChart').getContext('2d');
    new Chart(topCtx, {
        type: 'bar',
        data: {
            labels: <?= $topProductLabels ?>,
            datasets: [{
                label: 'Units Sold',
                data: <?= $topProductData ?>,
                backgroundColor: ['#C96A2E','#2471A3','#1F9E5C','#B45309','#7D3C98'],
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: '#EBE5DF' }, ticks: { color: '#A89F9B', font: { family: 'DM Sans' } } },
                x: { grid: { display: false }, ticks: { color: '#A89F9B', font: { family: 'DM Sans' } } }
            }
        }
    });
</script>

<?= $this->endSection(); ?>
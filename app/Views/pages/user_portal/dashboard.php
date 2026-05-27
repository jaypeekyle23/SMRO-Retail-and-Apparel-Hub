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
    --danger:    #DC2626;
    --danger-bg: #FEE2E2;
    --r:         14px;
    --shadow:    0 2px 12px rgba(0,0,0,.06);
  }
  body, .content-wrapper, main { background: var(--bg) !important; font-family: 'DM Sans', sans-serif; }

  .stat-card   { background: var(--surface); border-radius: var(--r); box-shadow: var(--shadow); border: 1px solid var(--border); padding: 1.4rem 1.5rem; }
  .stat-icon   { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: .85rem; }
  .stat-icon.primary { background: var(--accent-bg); color: var(--accent); }
  .stat-icon.success { background: var(--ok-bg);     color: var(--ok); }
  .stat-label  { font-family: 'Sora', sans-serif; font-size: .68rem; font-weight: 600; letter-spacing: .08em; text-transform: uppercase; color: var(--txt-3); margin-bottom: .5rem; }
  .stat-value  { font-family: 'Sora', sans-serif; font-size: 2rem; font-weight: 700; color: var(--txt); line-height: 1; }
  .stat-value.accent { color: var(--accent); }

  .card        { background: var(--surface) !important; border: 1px solid var(--border) !important; border-radius: var(--r) !important; box-shadow: var(--shadow) !important; }
  .card-header { background: var(--surface) !important; border-bottom: 1px solid var(--border) !important; padding: 1.1rem 1.5rem !important; display: flex; align-items: center; justify-content: space-between; }
  .card-header h6 { font-family: 'Sora', sans-serif; font-size: .8rem; font-weight: 600; letter-spacing: .05em; margin: 0; color: var(--txt); }

  .table th    { font-family: 'Sora', sans-serif; font-size: .7rem; font-weight: 600; letter-spacing: .07em; text-transform: uppercase; color: var(--txt-3); border-bottom: 1px solid var(--border) !important; padding: .65rem 1rem; }
  .table td    { font-size: .875rem; color: var(--txt); border-bottom: 1px solid var(--border) !important; padding: .75rem 1rem; vertical-align: middle; }
  .table tbody tr:last-child td { border-bottom: none !important; }
  .table-hover tbody tr:hover { background: var(--bg) !important; }

  .btn-accent  { background: var(--accent); color: #fff; border: none; border-radius: 8px; padding: .45rem 1rem; font-family: 'Sora', sans-serif; font-size: .8rem; font-weight: 600; letter-spacing: .03em; display: inline-flex; align-items: center; gap: 6px; text-decoration: none; transition: opacity .15s; }
  .btn-accent:hover { opacity: .88; color: #fff; }
  .btn-outline-muted { background: transparent; color: var(--txt-2); border: 1px solid var(--border); border-radius: 8px; padding: .4rem .9rem; font-size: .8rem; font-family: 'Sora', sans-serif; font-weight: 600; text-decoration: none; transition: border-color .15s, color .15s; }
  .btn-outline-muted:hover { border-color: var(--accent); color: var(--accent); }

  .return-item { display: flex; align-items: flex-start; gap: 10px; padding: .75rem 1.5rem; border-bottom: 1px solid var(--border); font-size: .85rem; }
  .return-item:last-child { border-bottom: none; }
  .return-badge { display: inline-flex; align-items: center; gap: 4px; font-family: 'Sora', sans-serif; font-size: .68rem; font-weight: 600; letter-spacing: .05em; padding: .2rem .55rem; border-radius: 20px; white-space: nowrap; }
  .return-badge.pending  { background: var(--warn-bg);   color: var(--warn); }
  .return-badge.approved { background: var(--ok-bg);     color: var(--ok); }
  .return-badge.rejected { background: var(--danger-bg); color: var(--danger); }

  .empty-state { padding: 2.5rem 1rem; text-align: center; color: var(--txt-3); font-size: .875rem; }
</style>

<!-- Page Header -->
<div class="d-flex align-items-center justify-content-between mb-4">
  <div>
    <h1 style="font-family:'Sora',sans-serif;font-size:1.5rem;font-weight:700;color:var(--txt);letter-spacing:-.02em;margin:0">Dashboard</h1>
    <p style="color:var(--txt-2);font-size:.875rem;margin:.2rem 0 0">Welcome back, <?= esc(session()->get('username')); ?>!</p>
  </div>
  <a href="<?= base_url('shop'); ?>" class="btn-accent">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
    Browse Shop
  </a>
</div>

<!-- Stat Cards -->
<div class="row mb-4">
  <div class="col-md-6 col-lg-3 mb-3">
    <div class="stat-card h-100">
      <div class="stat-icon primary">
        <!-- clipboard / orders icon -->
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="2"/><line x1="9" y1="12" x2="15" y2="12"/><line x1="9" y1="16" x2="13" y2="16"/></svg>
      </div>
      <div class="stat-label">Total Orders</div>
      <div class="stat-value"><?= $totalOrders; ?></div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3 mb-3">
    <div class="stat-card h-100">
      <div class="stat-icon success">
        <!-- wallet / peso icon -->
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/><line x1="12" y1="12" x2="12" y2="16"/><line x1="10" y1="12" x2="14" y2="12"/></svg>
      </div>
      <div class="stat-label">Total Spent</div>
      <div class="stat-value accent">₱<?= number_format($totalSpent, 2); ?></div>
    </div>
  </div>
  <?php if (!empty($pendingReturns)): ?>
  <div class="col-md-6 col-lg-3 mb-3">
    <div class="stat-card h-100">
      <div class="stat-icon" style="background: var(--warn-bg); color: var(--warn);">
        <!-- clock icon -->
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
      </div>
      <div class="stat-label">Pending Returns</div>
      <div class="stat-value" style="color: var(--warn);"><?= count($pendingReturns); ?></div>
    </div>
  </div>
  <?php endif; ?>
  <?php if (!empty($approvedReturns)): ?>
  <div class="col-md-6 col-lg-3 mb-3">
    <div class="stat-card h-100">
      <div class="stat-icon success">
        <!-- check icon -->
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
      </div>
      <div class="stat-label">Approved Returns</div>
      <div class="stat-value" style="color: var(--ok);"><?= count($approvedReturns); ?></div>
    </div>
  </div>
  <?php endif; ?>
</div>

<!-- Return Notifications -->
<?php if (!empty($pendingReturns) || !empty($approvedReturns) || !empty($rejectedReturns)): ?>
<div class="card mb-4">
  <div class="card-header">
    <h6>Return &amp; Refund Updates</h6>
    <a href="<?= base_url('my-orders'); ?>" class="btn-outline-muted">View Orders</a>
  </div>
  <div class="card-body p-0">
    <?php foreach ($approvedReturns as $return): ?>
      <div class="return-item">
        <span class="return-badge approved">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
          Approved
        </span>
        <div>
          <span style="font-weight:600;font-family:'Sora',sans-serif;font-size:.8rem"><?= esc($return['order_number']); ?></span>
          <span style="color:var(--txt-2);"> — Your refund of </span>
          <span style="font-weight:700;color:var(--ok)">₱<?= number_format($return['refund_amount'], 2); ?></span>
          <span style="color:var(--txt-2);"> has been processed.</span>
          <span style="color:var(--txt-3);font-size:.75rem;margin-left:6px"><?= date('M d, Y', strtotime($return['created_at'])); ?></span>
        </div>
      </div>
    <?php endforeach; ?>
    <?php foreach ($pendingReturns as $return): ?>
      <div class="return-item">
        <span class="return-badge pending">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          Pending
        </span>
        <div>
          <span style="font-weight:600;font-family:'Sora',sans-serif;font-size:.8rem"><?= esc($return['order_number']); ?></span>
          <span style="color:var(--txt-2);"> — Your return request is being reviewed by our team.</span>
          <span style="color:var(--txt-3);font-size:.75rem;margin-left:6px"><?= date('M d, Y', strtotime($return['created_at'])); ?></span>
        </div>
      </div>
    <?php endforeach; ?>
    <?php foreach ($rejectedReturns as $return): ?>
      <div class="return-item">
        <span class="return-badge rejected">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
          Rejected
        </span>
        <div>
          <span style="font-weight:600;font-family:'Sora',sans-serif;font-size:.8rem"><?= esc($return['order_number']); ?></span>
          <span style="color:var(--txt-2);"> — Unfortunately your return request was not approved.</span>
          <span style="color:var(--txt-3);font-size:.75rem;margin-left:6px"><?= date('M d, Y', strtotime($return['created_at'])); ?></span>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>

<!-- Recent Orders -->
<div class="card">
  <div class="card-header">
    <h6>Recent Orders</h6>
    <?php if (!empty($recentOrders)): ?>
      <a href="<?= base_url('my-orders'); ?>" class="btn-outline-muted">View All</a>
    <?php endif; ?>
  </div>
  <div class="card-body p-0">
    <?php if (empty($recentOrders)): ?>
      <div class="empty-state">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:.5rem;color:var(--txt-3)"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="2"/></svg><br>
        No orders yet. <a href="<?= base_url('shop'); ?>" style="color:var(--accent);font-weight:600;">Start shopping!</a>
      </div>
    <?php else: ?>
      <table class="table table-hover mb-0">
        <thead>
          <tr>
            <th>Order #</th>
            <th>Date</th>
            <th class="text-center">Items</th>
            <th class="text-end">Total</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($recentOrders as $order): ?>
            <tr>
              <td><span style="font-family:'Sora',sans-serif;font-weight:600;font-size:.8rem"><?= esc($order['order_number']); ?></span></td>
              <td style="color:var(--txt-2)"><?= date('M d, Y', strtotime($order['created_at'])); ?></td>
              <td class="text-center" style="color:var(--txt-2)"><?= count($order['items']); ?></td>
              <td class="text-end" style="font-family:'Sora',sans-serif;font-weight:700;color:var(--accent)">₱<?= number_format($order['total_amount'], 2); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>
</div>

<?= $this->endSection(); ?>
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

  /* ── Alerts ──────────────────────────────────── */
  .alert-success { background: var(--ok-bg); border: 1px solid #A7D7BE; color: #155235; border-radius: var(--r); font-size: .875rem; }
  .alert-danger  { background: var(--danger-bg); border: 1px solid #F0C4C0; color: var(--danger); border-radius: var(--r); font-size: .875rem; }

  /* ── Main card ───────────────────────────────── */
  .main-card  { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); overflow: hidden; }

  /* ── Table ───────────────────────────────────── */
  .table { margin-bottom: 0; }
  .table thead th { font-family: 'Sora', sans-serif; font-size: .67rem; font-weight: 600; letter-spacing: .09em; text-transform: uppercase; color: var(--txt-3); background: var(--bg); border-bottom: 1px solid var(--border) !important; border-top: none; padding: .85rem 1rem; white-space: nowrap; }
  .table tbody td { border-bottom: 1px solid var(--border) !important; border-top: none; padding: .9rem 1rem; vertical-align: middle; font-size: .875rem; color: var(--txt); }
  .table-hover tbody tr:hover { background: #FBF7F4 !important; }
  .table tbody tr:last-child td { border-bottom: none !important; }

  /* ── Column treatments ───────────────────────── */
  .order-num  { font-family: 'Sora', sans-serif; font-size: .78rem; font-weight: 700; color: var(--accent); }
  .sku-text   { font-family: 'Sora', sans-serif; font-size: .75rem; font-weight: 600; color: var(--accent); }
  .refund-amt { font-family: 'Sora', sans-serif; font-weight: 700; color: var(--txt); }
  .date-cell  { color: var(--txt-3); font-size: .8rem; white-space: nowrap; }
  .reason-cell { color: var(--txt-2); font-size: .83rem; max-width: 160px; }

  /* ── Status badges ───────────────────────────── */
  .badge-pending  { background: var(--warn-bg); color: var(--warn); font-family: 'Sora', sans-serif; font-size: .72rem; font-weight: 600; border-radius: 6px; padding: .3em .7em; display: inline-block; }
  .badge-approved { background: var(--ok-bg); color: var(--ok); font-family: 'Sora', sans-serif; font-size: .72rem; font-weight: 600; border-radius: 6px; padding: .3em .7em; display: inline-block; }
  .badge-rejected { background: var(--danger-bg); color: var(--danger); font-family: 'Sora', sans-serif; font-size: .72rem; font-weight: 600; border-radius: 6px; padding: .3em .7em; display: inline-block; }

  /* ── Action buttons ──────────────────────────── */
  .btn-sm.btn-success { background: var(--ok-bg) !important; border: 1px solid #A7D7BE !important; color: var(--ok) !important; font-size: .75rem; font-weight: 600; border-radius: 6px; padding: .28rem .7rem; font-family: 'Sora', sans-serif; }
  .btn-sm.btn-success:hover { background: #C8EDD8 !important; }
  .btn-sm.btn-danger  { background: var(--danger-bg) !important; border: 1px solid #F0C4C0 !important; color: var(--danger) !important; font-size: .75rem; font-weight: 600; border-radius: 6px; padding: .28rem .7rem; font-family: 'Sora', sans-serif; }
  .btn-sm.btn-danger:hover  { background: #F5D0CC !important; }

  /* ── Empty state ─────────────────────────────── */
  .empty-state { padding: 3.5rem 1rem; text-align: center; color: var(--txt-3); font-size: .875rem; }
</style>

<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0"><strong><?= esc($title) ?></strong></h1>
        <p class="text-muted">Manage product returns and refunds.</p>
    </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="main-card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Size/Color</th>
                    <th>Qty</th>
                    <th>Refund</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($returns)): ?>
                    <?php foreach ($returns as $return): ?>
                        <tr>
                            <td class="order-num"><?= esc($return['order_number']) ?></td>
                            <td style="font-weight:600"><?= esc($return['product_name']) ?></td>
                            <td class="sku-text"><?= esc($return['sku']) ?></td>
                            <td style="color:var(--txt-2)"><?= esc($return['size']) ?> / <?= esc($return['color']) ?></td>
                            <td style="font-family:'Sora',sans-serif;font-weight:600"><?= esc($return['quantity']) ?></td>
                            <td class="refund-amt">₱<?= number_format($return['refund_amount'], 2) ?></td>
                            <td class="reason-cell"><?= esc($return['reason']) ?></td>
                            <td>
                                <?php if ($return['status'] === 'pending'): ?>
                                    <span class="badge-pending">Pending</span>
                                <?php elseif ($return['status'] === 'approved'): ?>
                                    <span class="badge-approved">Approved</span>
                                <?php else: ?>
                                    <span class="badge-rejected">Rejected</span>
                                <?php endif; ?>
                            </td>
                            <td class="date-cell"><?= date('M d, Y', strtotime($return['created_at'])) ?></td>
                            <td>
                                <?php if ($return['status'] === 'pending'): ?>
                                    <form action="<?= base_url('returns/approve/' . $return['id']) ?>" method="POST" class="d-inline" onsubmit="return confirm('Approve this return and restock?')">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                    </form>
                                    <form action="<?= base_url('returns/reject/' . $return['id']) ?>" method="POST" class="d-inline" onsubmit="return confirm('Reject this return?')">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                    </form>
                                <?php else: ?>
                                    <span style="color:var(--txt-3)">—</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10">
                            <div class="empty-state"><em>No return requests yet.</em></div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection(); ?>
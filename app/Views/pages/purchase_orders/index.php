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

  .page-header h1        { font-family: 'Sora', sans-serif; font-size: 1.6rem; color: var(--txt); letter-spacing: -.02em; }
  .page-header p         { color: var(--txt-2); font-size: .875rem; margin: 0; }
  .btn-primary           { background: var(--accent) !important; border-color: var(--accent) !important; font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 600; border-radius: 8px; padding: .5rem 1.1rem; }
  .btn-primary:hover     { background: #b35a23 !important; border-color: #b35a23 !important; }

  .alert-success { background: var(--ok-bg); border: 1px solid #A7D7BE; color: #155235; border-radius: var(--r); font-size: .875rem; }
  .alert-danger  { background: var(--danger-bg); border: 1px solid #F0C4C0; color: var(--danger); border-radius: var(--r); font-size: .875rem; }

  .search-wrap                  { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); padding: .75rem 1rem; margin-bottom: 1rem; }
  .search-wrap .form-control    { border: 1px solid var(--border); border-radius: 8px; background: var(--bg); font-size: .875rem; color: var(--txt); padding-left: 2.4rem; }
  .search-wrap .form-control:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(201,106,46,.12); background: var(--surface); }
  .search-wrap .input-wrap      { position: relative; }
  .search-wrap .input-wrap i    { position: absolute; left: .8rem; top: 50%; transform: translateY(-50%); color: var(--txt-3); font-size: .9rem; pointer-events: none; }

  .main-card           { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); overflow: hidden; }
  .card-footer         { background: var(--surface) !important; border-top: 1px solid var(--border) !important; padding: .85rem 1.5rem !important; }

  .table              { margin-bottom: 0; }
  .table thead th     { font-family: 'Sora', sans-serif; font-size: .67rem; font-weight: 600; letter-spacing: .09em; text-transform: uppercase; color: var(--txt-3); background: var(--bg); border-bottom: 1px solid var(--border) !important; border-top: none; padding: .85rem 1rem; white-space: nowrap; }
  .table tbody td     { border-bottom: 1px solid var(--border) !important; border-top: none; padding: .9rem 1rem; vertical-align: middle; font-size: .875rem; color: var(--txt); }
  .table-hover tbody tr:hover { background: #FBF7F4 !important; }
  .table tbody tr:last-child td { border-bottom: none !important; }

  td strong           { font-family: 'Sora', sans-serif; font-size: .8rem; font-weight: 600; color: var(--accent); letter-spacing: .02em; }

  .badge.bg-warning   { background: var(--warn-bg) !important; color: var(--warn) !important; font-size: .72rem; font-weight: 600; border-radius: 6px; padding: .3em .65em; }
  .badge.bg-success   { background: var(--ok-bg) !important; color: var(--ok) !important; font-size: .72rem; font-weight: 600; border-radius: 6px; padding: .3em .65em; }
  .badge.bg-danger    { background: var(--danger-bg) !important; color: var(--danger) !important; font-size: .72rem; font-weight: 600; border-radius: 6px; padding: .3em .65em; }

  .btn-sm.btn-primary { background: var(--accent-bg) !important; border: 1px solid #f0d4bc !important; color: var(--accent) !important; font-size: .75rem; font-weight: 500; border-radius: 6px; padding: .3rem .7rem; }
  .btn-sm.btn-primary:hover { background: #f5e0cc !important; }

  .empty-state       { padding: 3.5rem 1rem; text-align: center; color: var(--txt-3); }
  .empty-state h5    { font-family: 'Sora', sans-serif; font-size: 1rem; color: var(--txt-2); margin-bottom: .4rem; }
  .empty-state em    { font-size: .875rem; font-style: normal; }
  .empty-state a     { color: var(--accent); font-weight: 500; text-decoration: none; }
  .empty-state a:hover { text-decoration: underline; }

  .pagination .page-link { border-color: var(--border); color: var(--txt-2); font-size: .8rem; border-radius: 6px !important; margin: 0 2px; }
  .pagination .page-item.active .page-link { background: var(--accent); border-color: var(--accent); color: #fff; }
  .pagination .page-link:hover { background: var(--accent-bg); color: var(--accent); }
</style>

<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0"><strong><?= esc($title) ?></strong></h1>
        <p class="text-muted">Manage incoming stock from suppliers.</p>
    </div>
    <a href="<?= base_url('purchase-orders/create') ?>" class="btn btn-primary">+ Create Purchase Order</a>
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

<!-- Search Bar -->
<div class="search-wrap">
    <form method="GET" action="<?= base_url('purchase-orders') ?>" class="row g-2 align-items-center">
        <div class="col-md-10">
            <div class="input-wrap">
                <i class="bi bi-search"></i>
                <input type="text" name="search" class="form-control" placeholder="Search by PO number or supplier..." value="<?= esc($search) ?>">
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
                    <th>PO Number</th>
                    <th>Supplier</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($purchaseOrders)): ?>
                    <?php foreach ($purchaseOrders as $po): ?>
                        <tr>
                            <td><strong><?= esc($po['po_number']) ?></strong></td>
                            <td style="color:var(--txt-2)"><?= esc($po['supplier_name'] ?? '—') ?></td>
                            <td>
                                <?php if ($po['status'] === 'pending'): ?>
                                    <span class="badge bg-warning text-dark">Pending</span>
                                <?php elseif ($po['status'] === 'received'): ?>
                                    <span class="badge bg-success">Received</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Cancelled</span>
                                <?php endif; ?>
                            </td>
                            <td style="color:var(--txt-2)"><?= date('M d, Y', strtotime($po['created_at'])) ?></td>
                            <td>
                                <a href="<?= base_url('purchase-orders/' . $po['id']) ?>" class="btn btn-sm btn-primary">View</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <?php if ($search): ?>
                                    <h5>No purchase orders found for "<?= esc($search) ?>".</h5>
                                    <a href="<?= base_url('purchase-orders') ?>">Clear search</a>
                                <?php else: ?>
                                    <h5>No purchase orders yet.</h5>
                                    <em>Click "+ Create Purchase Order" to get started.</em>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
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

<?= $this->endSection(); ?>
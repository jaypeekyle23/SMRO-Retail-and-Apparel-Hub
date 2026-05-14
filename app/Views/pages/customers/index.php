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
    --r:         12px;
    --shadow:    0 2px 12px rgba(0,0,0,.06);
  }

  body, .content-wrapper, main { background: var(--bg) !important; font-family: 'DM Sans', sans-serif; }

  /* ── Page header ─────────────────────────────── */
  .page-header h1 { font-family: 'Sora', sans-serif; font-size: 1.6rem; color: var(--txt); letter-spacing: -.02em; }
  .page-header p  { color: var(--txt-2); font-size: .875rem; margin: 0; }

  /* ── Buttons ─────────────────────────────────── */
  .btn-primary      { background: var(--accent) !important; border-color: var(--accent) !important; font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 600; border-radius: 8px; padding: .52rem 1.15rem; color: #fff !important; }
  .btn-primary:hover { background: #b35a23 !important; }
  .btn-sm.btn-primary { padding: .3rem .85rem; font-size: .78rem; border-radius: 6px; }

  /* ── Search wrap ─────────────────────────────── */
  .search-wrap { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); padding: .75rem 1rem; margin-bottom: 1rem; }
  .search-wrap .form-control { border: 1px solid var(--border); border-radius: 8px; background: var(--bg); font-size: .875rem; color: var(--txt); padding-left: 2.4rem; }
  .search-wrap .form-control:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(201,106,46,.12); background: var(--surface); outline: none; }
  .search-wrap .input-wrap   { position: relative; }
  .search-wrap .input-wrap i { position: absolute; left: .8rem; top: 50%; transform: translateY(-50%); color: var(--txt-3); font-size: .9rem; pointer-events: none; }

  /* ── Main card ───────────────────────────────── */
  .main-card   { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); overflow: hidden; }
  .card-footer { background: var(--surface) !important; border-top: 1px solid var(--border) !important; padding: .85rem 1.5rem !important; }

  /* ── Table ───────────────────────────────────── */
  .table { margin-bottom: 0; }
  .table thead th { font-family: 'Sora', sans-serif; font-size: .67rem; font-weight: 600; letter-spacing: .09em; text-transform: uppercase; color: var(--txt-3); background: var(--bg); border-bottom: 1px solid var(--border) !important; border-top: none; padding: .85rem 1rem; }
  .table tbody td { border-bottom: 1px solid var(--border) !important; border-top: none; padding: .9rem 1rem; vertical-align: middle; font-size: .875rem; color: var(--txt); }
  .table-hover tbody tr:hover { background: #FBF7F4 !important; }
  .table tbody tr:last-child td { border-bottom: none !important; }
  .id-cell { font-family: 'Sora', sans-serif; font-size: .75rem; font-weight: 600; color: var(--txt-3); }

  /* ── Empty state ─────────────────────────────── */
  .empty-state { padding: 3.5rem 1rem; text-align: center; color: var(--txt-3); font-size: .875rem; }
  .empty-state h5 { font-family: 'Sora', sans-serif; font-size: 1rem; color: var(--txt-2); margin-bottom: .4rem; }
  .empty-state a  { color: var(--accent); font-weight: 500; text-decoration: none; }
  .empty-state a:hover { text-decoration: underline; }

  /* ── Pagination ──────────────────────────────── */
  .pagination .page-link { border-color: var(--border); color: var(--txt-2); font-size: .8rem; border-radius: 6px !important; margin: 0 2px; }
  .pagination .page-item.active .page-link { background: var(--accent); border-color: var(--accent); color: #fff; }
  .pagination .page-link:hover { background: var(--accent-bg); color: var(--accent); }
</style>

<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0 text-gray-800"><strong><?= esc($title) ?></strong></h1>
        <p class="text-muted">View and manage your customers.</p>
    </div>
</div>

<!-- Search Bar -->
<div class="search-wrap">
    <form method="GET" action="<?= base_url('customers') ?>" class="row g-2 align-items-center">
        <div class="col-md-10">
            <div class="input-wrap">
                <i class="bi bi-search"></i>
                <input type="text" name="search" class="form-control" placeholder="Search by name, phone, or email..." value="<?= esc($search) ?>">
            </div>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Search</button>
        </div>
    </form>
</div>

<div class="main-card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Member Since</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($customers)): ?>
                    <?php foreach ($customers as $customer): ?>
                        <tr>
                            <td class="id-cell"><?= esc($customer['id']) ?></td>
                            <td><strong><?= esc($customer['name']) ?></strong></td>
                            <td style="color:var(--txt-2)"><?= esc($customer['phone'] ?: '—') ?></td>
                            <td style="color:var(--txt-2)"><?= esc($customer['email'] ?: '—') ?></td>
                            <td style="color:var(--txt-3);font-size:.8rem;white-space:nowrap"><?= date('M d, Y', strtotime($customer['created_at'])) ?></td>
                            <td>
                                <a href="<?= base_url('customers/' . $customer['id']) ?>" class="btn btn-sm btn-primary">View</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <?php if ($search): ?>
                                    <h5>No customers found for "<?= esc($search) ?>".</h5>
                                    <a href="<?= base_url('customers') ?>">Clear search</a>
                                <?php else: ?>
                                    <em>No customers yet. They will appear here after a sale.</em>
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
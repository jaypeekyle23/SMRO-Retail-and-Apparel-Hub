<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">

<style>
  :root {
    --bg:        #F7F3EF;
    --surface:   #FFFFFF;
    --border:    #EBE5DF;
    --accent:    #C96A2E;
    --txt:       #1A1714;
    --txt-2:     #6B6360;
    --txt-3:     #A89F9B;
    --danger:    #C0392B;
    --danger-bg: #FDECEA;
    --r:         12px;
    --shadow:    0 2px 12px rgba(0,0,0,.06);
  }

  body, .content-wrapper, main { background: var(--bg) !important; font-family: 'DM Sans', sans-serif; }

  /* ── Header ──────────────────────────────────── */
  h1 { font-family: 'Sora', sans-serif; font-size: 1.6rem; color: var(--txt); letter-spacing: -.02em; }

  /* ── Buttons ─────────────────────────────────── */
  .btn-primary   { background: var(--accent) !important; border-color: var(--accent) !important; font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 600; border-radius: 8px; padding: .52rem 1.3rem; color: #fff !important; }
  .btn-primary:hover { background: #b35a23 !important; border-color: #b35a23 !important; }
  .btn-secondary { background: var(--surface) !important; border: 1px solid var(--border) !important; color: var(--txt-2) !important; font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 500; border-radius: 8px; padding: .52rem 1.15rem; }
  .btn-secondary:hover { background: var(--bg) !important; }

  /* ── Alert ───────────────────────────────────── */
  .alert-danger { background: var(--danger-bg); border: 1px solid #F0C4C0; color: var(--danger); border-radius: var(--r); font-size: .875rem; }

  /* ── Main card ───────────────────────────────── */
  .main-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); padding: 2rem; }

  /* ── Section label ───────────────────────────── */
  .section-label { font-family: 'Sora', sans-serif; font-size: .68rem; font-weight: 600; letter-spacing: .09em; text-transform: uppercase; color: var(--txt-3); margin-bottom: 1rem; padding-bottom: .5rem; border-bottom: 1px solid var(--border); }

  /* ── Form controls ───────────────────────────── */
  .form-label { font-family: 'Sora', sans-serif; font-size: .78rem; font-weight: 600; color: var(--txt-2); margin-bottom: .4rem; }
  .form-label .text-danger { color: var(--danger) !important; }
  .form-control {
    border: 1px solid var(--border); border-radius: 8px; background: var(--bg);
    font-size: .875rem; color: var(--txt); padding: .55rem .85rem;
    transition: border-color .15s, box-shadow .15s;
  }
  .form-control:focus {
    border-color: var(--accent); box-shadow: 0 0 0 3px rgba(201,106,46,.12);
    background: var(--surface); outline: none;
  }
  textarea.form-control { resize: vertical; }

  /* ── Form actions ────────────────────────────── */
  .form-actions { padding-top: 1.5rem; border-top: 1px solid var(--border); margin-top: 1.5rem; display: flex; gap: .75rem; }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><strong><?= esc($title) ?></strong></h1>
    <a href="<?= base_url('suppliers') ?>" class="btn btn-secondary">← Back to Suppliers</a>
</div>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <div><?= esc($error) ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<div class="main-card">
    <p class="section-label">Supplier Details</p>

    <form action="<?= base_url('suppliers/store') ?>" method="POST">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label class="form-label fw-bold">Supplier Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" value="<?= old('name') ?>" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Phone</label>
                <input type="text" name="phone" class="form-control" value="<?= old('phone') ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Email</label>
                <input type="email" name="email" class="form-control" value="<?= old('email') ?>">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Address</label>
            <textarea name="address" class="form-control" rows="3"><?= old('address') ?></textarea>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save Supplier</button>
            <a href="<?= base_url('suppliers') ?>" class="btn btn-secondary">Cancel</a>
        </div>

    </form>
</div>

<?= $this->endSection(); ?>
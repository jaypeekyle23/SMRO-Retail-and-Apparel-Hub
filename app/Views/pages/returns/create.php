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
    --ok:        #1F9E5C;
    --danger:    #C0392B;
    --danger-bg: #FDECEA;
    --r:         12px;
    --shadow:    0 2px 12px rgba(0,0,0,.06);
  }

  body, .content-wrapper, main { background: var(--bg) !important; font-family: 'DM Sans', sans-serif; }

  /* ── Header ──────────────────────────────────── */
  h1 { font-family: 'Sora', sans-serif; font-size: 1.6rem; color: var(--txt); letter-spacing: -.02em; }

  /* ── Buttons ─────────────────────────────────── */
  .btn-secondary { background: var(--surface) !important; border: 1px solid var(--border) !important; color: var(--txt-2) !important; font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 500; border-radius: 8px; padding: .52rem 1.15rem; }
  .btn-secondary:hover { background: var(--bg) !important; }
  .btn-primary   { background: var(--accent) !important; border-color: var(--accent) !important; font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 600; border-radius: 8px; padding: .52rem 1.3rem; color: #fff !important; }
  .btn-primary:hover { background: #b35a23 !important; }

  /* ── Alert ───────────────────────────────────── */
  .alert-danger { background: var(--danger-bg); border: 1px solid #F0C4C0; color: var(--danger); border-radius: var(--r); font-size: .875rem; }

  /* ── Summary card ────────────────────────────── */
  .summary-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); padding: 1.5rem; margin-bottom: 1.5rem; }
  .summary-field p  { font-family: 'Sora', sans-serif; font-size: .68rem; font-weight: 600; letter-spacing: .08em; text-transform: uppercase; color: var(--txt-3); margin-bottom: .3rem; }
  .summary-field h5 { font-family: 'Sora', sans-serif; font-size: 1rem; font-weight: 700; color: var(--txt); margin: 0; }
  .summary-field h5.accent { color: var(--accent); }

  /* ── Main card ───────────────────────────────── */
  .main-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); padding: 2rem; }

  /* ── Section label ───────────────────────────── */
  .section-label { font-family: 'Sora', sans-serif; font-size: .68rem; font-weight: 600; letter-spacing: .09em; text-transform: uppercase; color: var(--txt-3); margin-bottom: 1rem; padding-bottom: .5rem; border-bottom: 1px solid var(--border); }

  /* ── Form controls ───────────────────────────── */
  .form-label { font-family: 'Sora', sans-serif; font-size: .78rem; font-weight: 600; color: var(--txt-2); margin-bottom: .4rem; }
  .form-label .text-danger { color: var(--danger) !important; }
  .form-control, .form-select {
    border: 1px solid var(--border); border-radius: 8px; background: var(--bg);
    font-size: .875rem; color: var(--txt); padding: .55rem .85rem;
    transition: border-color .15s, box-shadow .15s;
  }
  .form-control:focus, .form-select:focus {
    border-color: var(--accent); box-shadow: 0 0 0 3px rgba(201,106,46,.12);
    background: var(--surface); outline: none;
  }
  .form-control:disabled { background: var(--bg); color: var(--txt-2); border-style: dashed; cursor: default; }
  textarea.form-control { resize: vertical; }

  /* ── Refund display ──────────────────────────── */
  #refund_display { font-family: 'Sora', sans-serif; font-weight: 700; color: var(--ok); border-style: dashed; }

  /* ── Form actions ────────────────────────────── */
  .form-actions { padding-top: 1.5rem; border-top: 1px solid var(--border); margin-top: 1.5rem; display: flex; gap: .75rem; }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><strong><?= esc($title) ?></strong></h1>
    <a href="<?= base_url('returns') ?>" class="btn btn-secondary">← Back to Returns</a>
</div>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <div><?= esc($error) ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<!-- Order Summary -->
<div class="summary-card">
    <div class="row g-4">
        <div class="col-md-4 summary-field">
            <p>Order Number</p>
            <h5><?= esc($order['order_number']) ?></h5>
        </div>
        <div class="col-md-4 summary-field">
            <p>Date</p>
            <h5><?= date('M d, Y', strtotime($order['created_at'])) ?></h5>
        </div>
        <div class="col-md-4 summary-field">
            <p>Total Amount</p>
            <h5 class="accent">₱<?= number_format($order['total_amount'], 2) ?></h5>
        </div>
    </div>
</div>

<!-- Return Form -->
<div class="main-card">
    <p class="section-label">Return Details</p>

    <form action="<?= base_url('returns/store') ?>" method="POST">
        <?= csrf_field() ?>
        <input type="hidden" name="order_id" value="<?= esc($order['id']) ?>">

        <div class="mb-3">
            <label class="form-label fw-bold">Select Item to Return <span class="text-danger">*</span></label>
            <select name="variant_id" id="variant_select" class="form-select" required onchange="fillProductId(this)">
                <option value="" disabled selected>Choose an item...</option>
                <?php foreach ($items as $item): ?>
                    <option value="<?= $item['variant_id'] ?>" data-product-id="<?= $item['product_id'] ?>" data-price="<?= $item['price'] ?>" data-max="<?= $item['quantity'] ?>">
                        <?= esc($item['product_name']) ?> — <?= esc($item['size']) ?>/<?= esc($item['color']) ?> (SKU: <?= esc($item['sku']) ?>) — Qty: <?= $item['quantity'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="hidden" name="product_id" id="product_id">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Quantity to Return <span class="text-danger">*</span></label>
                <input type="number" name="quantity" id="quantity" class="form-control" min="1" value="1" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Estimated Refund</label>
                <input type="text" id="refund_display" class="form-control" value="₱0.00" disabled>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Reason for Return <span class="text-danger">*</span></label>
            <textarea name="reason" class="form-control" rows="3" placeholder="e.g. Defective item, Wrong size..." required></textarea>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Submit Return Request</button>
            <a href="<?= base_url('returns') ?>" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<script>
    let selectedPrice = 0;
    let maxQty = 1;

    function fillProductId(select) {
        const selected = select.options[select.selectedIndex];
        document.getElementById('product_id').value = selected.getAttribute('data-product-id');
        selectedPrice = parseFloat(selected.getAttribute('data-price'));
        maxQty = parseInt(selected.getAttribute('data-max'));
        document.getElementById('quantity').max = maxQty;
        updateRefund();
    }

    function updateRefund() {
        const qty = parseInt(document.getElementById('quantity').value) || 0;
        const refund = selectedPrice * qty;
        document.getElementById('refund_display').value = '₱' + refund.toFixed(2);
    }

    document.getElementById('quantity').addEventListener('input', updateRefund);
</script>

<?= $this->endSection(); ?>
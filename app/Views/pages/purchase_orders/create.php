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
    --danger:     #C0392B;
    --danger-bg:  #FDECEA;
    --r:          12px;
    --shadow:     0 2px 12px rgba(0,0,0,.06);
  }

  body, .content-wrapper, main { background: var(--bg) !important; font-family: 'DM Sans', sans-serif; }

  /* ── Page header ── */
  h1.h3              { font-family: 'Sora', sans-serif; font-size: 1.6rem; color: var(--txt); letter-spacing: -.02em; }
  .btn-secondary     { background: var(--surface) !important; border: 1px solid var(--border) !important; color: var(--txt-2) !important; font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 600; border-radius: 8px; padding: .5rem 1.1rem; }
  .btn-secondary:hover { background: var(--bg) !important; color: var(--txt) !important; }
  .btn-primary       { background: var(--accent) !important; border-color: var(--accent) !important; font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 600; border-radius: 8px; padding: .5rem 1.1rem; color: #fff !important; }
  .btn-primary:hover { background: #b35a23 !important; border-color: #b35a23 !important; }

  /* ── Alert ── */
  .alert-danger { background: var(--danger-bg); border: 1px solid #F0C4C0; color: var(--danger); border-radius: var(--r); font-size: .875rem; }

  /* ── Main card ── */
  .main-card           { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); overflow: hidden; }
  .card-section-header { padding: .85rem 1.25rem; border-bottom: 1px solid var(--border); background: var(--bg); }
  .card-section-header h5 { font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 600; letter-spacing: .05em; text-transform: uppercase; color: var(--txt-3); margin: 0; }
  .form-body           { padding: 1.5rem; }

  /* ── Form controls ── */
  .form-label        { font-family: 'Sora', sans-serif; font-size: .72rem; font-weight: 600; letter-spacing: .06em; text-transform: uppercase; color: var(--txt-2); margin-bottom: .4rem; }
  .form-control, .form-select {
    border: 1px solid var(--border); border-radius: 8px; background: var(--bg);
    font-family: 'DM Sans', sans-serif; font-size: .875rem; color: var(--txt); padding: .5rem .85rem;
  }
  .form-control:focus, .form-select:focus {
    border-color: var(--accent); box-shadow: 0 0 0 3px rgba(201,106,46,.12); background: var(--surface); outline: none;
  }
  .text-danger       { color: var(--danger) !important; }

  /* ── Section divider ── */
  .items-header      { font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 600; letter-spacing: .05em; text-transform: uppercase; color: var(--txt-3); padding-bottom: .75rem; border-bottom: 1px solid var(--border); margin-bottom: 0; }

  /* ── Items table ── */
  .table             { margin-bottom: 0; }
  .table thead th    { font-family: 'Sora', sans-serif; font-size: .67rem; font-weight: 600; letter-spacing: .09em; text-transform: uppercase; color: var(--txt-3); background: var(--bg); border-bottom: 1px solid var(--border) !important; border-top: none; padding: .75rem 1rem; white-space: nowrap; }
  .table tbody td    { border-bottom: 1px solid var(--border) !important; border-top: none; padding: .65rem .75rem; vertical-align: middle; }
  .table tbody tr:last-child td { border-bottom: none !important; }
  .table-wrap        { border: 1px solid var(--border); border-radius: var(--r); overflow: hidden; margin-bottom: 1rem; }

  /* ── Remove / Add row buttons ── */
  .btn-sm.btn-danger    { background: var(--danger-bg) !important; border: 1px solid #F0C4C0 !important; color: var(--danger) !important; font-size: .75rem; font-weight: 500; border-radius: 6px; padding: .3rem .7rem; font-family: 'Sora', sans-serif; }
  .btn-sm.btn-danger:hover { background: #f5d0cc !important; }
  .btn-add-row          { background: var(--surface); border: 1px dashed var(--border); color: var(--txt-2); font-family: 'Sora', sans-serif; font-size: .8rem; font-weight: 600; border-radius: 8px; padding: .45rem 1rem; transition: border-color .15s, color .15s; }
  .btn-add-row:hover    { border-color: var(--accent); color: var(--accent); background: var(--accent-bg); }

  /* ── Form footer ── */
  .form-footer { padding: 1.25rem 1.5rem; border-top: 1px solid var(--border); background: var(--bg); }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0"><strong><?= esc($title) ?></strong></h1>
    <a href="<?= base_url('purchase-orders') ?>" class="btn btn-secondary">← Back to Purchase Orders</a>
</div>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <div><?= esc($error) ?></div>
        <?php endforeach; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="main-card">
    <div class="card-section-header"><h5>Order Details</h5></div>
    <form action="<?= base_url('purchase-orders/store') ?>" method="POST" id="po-form">
        <?= csrf_field() ?>

        <div class="form-body">
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label">Supplier <span class="text-danger">*</span></label>
                    <select name="supplier_id" class="form-select" required>
                        <option value="" disabled selected>Select a supplier...</option>
                        <?php foreach ($suppliers as $supplier): ?>
                            <option value="<?= $supplier['id'] ?>"><?= esc($supplier['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Notes</label>
                    <input type="text" name="notes" class="form-control" placeholder="Optional notes...">
                </div>
            </div>

            <p class="items-header">Order Items</p>

            <div class="table-wrap table-responsive">
                <table class="table mb-0 align-middle" id="items-table">
                    <thead>
                        <tr>
                            <th>Product / Variant</th>
                            <th style="width:130px">Quantity</th>
                            <th style="width:150px">Cost Price</th>
                            <th style="width:80px"></th>
                        </tr>
                    </thead>
                    <tbody id="items-body">
                        <tr id="row-0">
                            <td>
                                <select name="variants[0][variant_id]" class="form-select variant-select" onchange="fillProductId(this, 0)" required>
                                    <option value="" disabled selected>Select a variant...</option>
                                    <?php foreach ($variants as $variant): ?>
                                        <option value="<?= $variant['id'] ?>" data-product-id="<?= $variant['product_id'] ?>" data-cost="<?= $variant['cost_price'] ?>">
                                            <?= esc($variant['product_name']) ?> — <?= esc($variant['size']) ?> / <?= esc($variant['color']) ?> (SKU: <?= esc($variant['sku']) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="hidden" name="variants[0][product_id]" id="product-id-0">
                            </td>
                            <td>
                                <input type="number" name="variants[0][quantity]" class="form-control" min="1" value="1" required>
                            </td>
                            <td>
                                <input type="number" name="variants[0][cost_price]" id="cost-price-0" class="form-control" min="0" step="0.01" value="0">
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger" onclick="removeRow(0)">Remove</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <button type="button" class="btn-add-row" onclick="addRow()">+ Add Item</button>
        </div>

        <div class="form-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Create Purchase Order</button>
        </div>
    </form>
</div>

<script>
    let rowCount = 1;
    const variants = <?= json_encode($variants) ?>;

    function fillProductId(select, index) {
        const selected = select.options[select.selectedIndex];
        document.getElementById('product-id-' + index).value = selected.getAttribute('data-product-id');
        document.getElementById('cost-price-' + index).value = selected.getAttribute('data-cost') || 0;
    }

    function addRow() {
        const index = rowCount++;
        const options = variants.map(v =>
            `<option value="${v.id}" data-product-id="${v.product_id}" data-cost="${v.cost_price}">
                ${v.product_name} — ${v.size} / ${v.color} (SKU: ${v.sku})
            </option>`
        ).join('');

        const row = `
            <tr id="row-${index}">
                <td>
                    <select name="variants[${index}][variant_id]" class="form-select" onchange="fillProductId(this, ${index})" required>
                        <option value="" disabled selected>Select a variant...</option>
                        ${options}
                    </select>
                    <input type="hidden" name="variants[${index}][product_id]" id="product-id-${index}">
                </td>
                <td>
                    <input type="number" name="variants[${index}][quantity]" class="form-control" min="1" value="1" required>
                </td>
                <td>
                    <input type="number" name="variants[${index}][cost_price]" id="cost-price-${index}" class="form-control" min="0" step="0.01" value="0">
                </td>
                <td>
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeRow(${index})">Remove</button>
                </td>
            </tr>`;

        document.getElementById('items-body').insertAdjacentHTML('beforeend', row);
    }

    function removeRow(index) {
        const row = document.getElementById('row-' + index);
        if (row) row.remove();
    }
</script>

<?= $this->endSection(); ?>
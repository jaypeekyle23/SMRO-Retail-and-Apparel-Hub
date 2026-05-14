<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><strong><?= esc($title) ?></strong></h1>
    <a href="<?= base_url('purchase-orders') ?>" class="btn btn-secondary">← Back to Purchase Orders</a>
</div>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <div><?= esc($error) ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="<?= base_url('purchase-orders/store') ?>" method="POST" id="po-form">
            <?= csrf_field() ?>

            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Supplier <span class="text-danger">*</span></label>
                    <select name="supplier_id" class="form-select" required>
                        <option value="" disabled selected>Select a supplier...</option>
                        <?php foreach ($suppliers as $supplier): ?>
                            <option value="<?= $supplier['id'] ?>"><?= esc($supplier['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Notes</label>
                    <input type="text" name="notes" class="form-control" placeholder="Optional notes...">
                </div>
            </div>

            <h5 class="fw-bold mb-3">Order Items</h5>

            <div class="table-responsive">
                <table class="table table-bordered" id="items-table">
                    <thead class="table-light">
                        <tr>
                            <th>Product / Variant</th>
                            <th>Quantity</th>
                            <th>Cost Price</th>
                            <th></th>
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

            <button type="button" class="btn btn-secondary mb-3" onclick="addRow()">+ Add Item</button>

            <div class="mt-2">
                <button type="submit" class="btn btn-primary">Create Purchase Order</button>
            </div>
        </form>
    </div>
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
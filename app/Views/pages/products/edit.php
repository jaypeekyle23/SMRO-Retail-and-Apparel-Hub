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
    --r:         12px;
    --shadow:    0 2px 12px rgba(0,0,0,.06);
  }

  body, .content-wrapper, main { background: var(--bg) !important; font-family: 'DM Sans', sans-serif; }

  /* ── Page header ─────────────────────────────── */
  .page-header h1 { font-family: 'Sora', sans-serif; font-size: 1.6rem; color: var(--txt); letter-spacing: -.02em; }
  .page-header p  { color: var(--txt-2); font-size: .875rem; margin: 0; }

  /* ── Alert ───────────────────────────────────── */
  .alert-danger { background: var(--danger-bg); border: 1px solid #F0C4C0; color: var(--danger); border-radius: var(--r); font-size: .875rem; }
  .alert-danger ul { color: var(--txt-2); }

  /* ── Main card ───────────────────────────────── */
  .main-card      { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); padding: 2rem; }

  /* ── Section label ───────────────────────────── */
  .section-label  { font-family: 'Sora', sans-serif; font-size: .68rem; font-weight: 600; letter-spacing: .09em; text-transform: uppercase; color: var(--txt-3); margin-bottom: 1rem; padding-bottom: .5rem; border-bottom: 1px solid var(--border); }

  /* ── Form controls ───────────────────────────── */
  .form-label     { font-family: 'Sora', sans-serif; font-size: .78rem; font-weight: 600; color: var(--txt-2); margin-bottom: .4rem; }
  .form-control, .form-select {
    border: 1px solid var(--border); border-radius: 8px; background: var(--bg);
    font-size: .875rem; color: var(--txt); padding: .55rem .85rem;
    transition: border-color .15s, box-shadow .15s;
  }
  .form-control:focus, .form-select:focus {
    border-color: var(--accent); box-shadow: 0 0 0 3px rgba(201,106,46,.12);
    background: var(--surface); outline: none;
  }
  .form-control-sm { padding: .35rem .65rem; font-size: .8rem; border-radius: 6px; }

  /* ── Variants card ───────────────────────────── */
  .variants-card  { border: 1px solid var(--border); border-radius: var(--r); overflow: hidden; }
  .variants-header {
    background: var(--bg); border-bottom: 1px solid var(--border);
    padding: .85rem 1.25rem;
    display: flex; align-items: center; justify-content: space-between;
  }
  .variants-header h5 { font-family: 'Sora', sans-serif; font-size: .85rem; font-weight: 600; color: var(--txt); margin: 0; }

  /* ── Variants table ──────────────────────────── */
  #variantsTable          { margin-bottom: 0; }
  #variantsTable thead th { font-family: 'Sora', sans-serif; font-size: .67rem; font-weight: 600; letter-spacing: .09em; text-transform: uppercase; color: var(--txt-3); background: var(--surface); border-bottom: 1px solid var(--border) !important; border-top: none; padding: .75rem 1rem; }
  #variantsTable tbody td { border-bottom: 1px solid var(--border) !important; border-top: none; padding: .6rem 1rem; vertical-align: middle; background: var(--surface); }
  #variantsTable tbody tr:last-child td { border-bottom: none !important; }
  #variantsTable tbody tr:nth-child(even) td { background: #FDFAF8; }

  /* ── Image section ───────────────────────────── */
  .image-section  { background: var(--bg); border: 1px solid var(--border); border-radius: var(--r); padding: 1.25rem; }
  .img-thumbnail  { border-radius: 8px; border: 1px solid var(--border); max-height: 140px; object-fit: cover; }

  /* ── Buttons ─────────────────────────────────── */
  .btn-primary    { background: var(--accent) !important; border-color: var(--accent) !important; font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 600; border-radius: 8px; padding: .55rem 1.3rem; }
  .btn-primary:hover { background: #b35a23 !important; border-color: #b35a23 !important; }
  .btn-success    { background: var(--ok) !important; border-color: var(--ok) !important; font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 600; border-radius: 8px; padding: .55rem 1.3rem; color: #fff !important; }
  .btn-success:hover { background: #178a4e !important; }
  .btn-secondary  { background: var(--surface) !important; border: 1px solid var(--border) !important; color: var(--txt-2) !important; font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 500; border-radius: 8px; padding: .55rem 1.3rem; }
  .btn-secondary:hover { background: var(--bg) !important; }
  .btn-sm.btn-primary { padding: .3rem .85rem; font-size: .78rem; border-radius: 6px; }
  .btn-outline-danger { border: 1px solid #F0C4C0 !important; background: var(--danger-bg) !important; color: var(--danger) !important; font-size: .75rem; font-weight: 600; border-radius: 6px; padding: .28rem .65rem; }
  .btn-outline-danger:hover { background: #F5D0CC !important; }

  /* ── Form actions divider ────────────────────── */
  .form-actions { padding-top: 1.5rem; border-top: 1px solid var(--border); margin-top: 1.5rem; display: flex; gap: .75rem; }
</style>

<div class="page-header mb-4">
    <h1 class="h3 mb-0 text-gray-800"><strong><?= $title; ?></strong></h1>
    <p class="text-muted">Update product details below.</p>
</div>

<?php if (session()->has('errors')): ?>
    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
        <strong>Please check your inputs:</strong>
        <ul class="mb-0 mt-1">
            <?php foreach (session('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="main-card">
    <form action="<?= base_url('products/update/' . $product['id']) ?>" method="POST" enctype="multipart/form-data">

        <p class="section-label">Basic Information</p>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Product Name</label>
                <input type="text" name="name" class="form-control" value="<?= old('name', esc($product['name'])) ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Base SKU</label>
                <input type="text" name="sku" class="form-control" value="<?= old('sku', esc($product['sku'])) ?>" required>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label">Category</label>
                <input type="text" name="category" class="form-control" value="<?= old('category', esc($product['category'])) ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Default Selling Price</label>
                <input type="number" step="0.01" name="selling_price" class="form-control" value="<?= old('selling_price', esc($product['selling_price'])) ?>">
            </div>
        </div>

        <p class="section-label">Product Variants</p>

        <div class="col-md-12 mb-4">
            <div class="variants-card">
                <div class="variants-header">
                    <h5>Variants</h5>
                    <button type="button" class="btn btn-sm btn-primary" id="addVariantBtn">+ Add Variant</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless mb-0" id="variantsTable">
                        <thead>
                            <tr>
                                <th>Variant SKU</th>
                                <th>Size</th>
                                <th>Color</th>
                                <th>Price (₱)</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($variants)): ?>
                                <?php foreach ($variants as $index => $variant): ?>
                                    <tr>
                                        <td><input type="text" name="variants[<?= $index ?>][sku]" class="form-control form-control-sm" value="<?= esc($variant['sku']) ?>" required></td>
                                        <td><input type="text" name="variants[<?= $index ?>][size]" class="form-control form-control-sm" value="<?= esc($variant['size']) ?>"></td>
                                        <td><input type="text" name="variants[<?= $index ?>][color]" class="form-control form-control-sm" value="<?= esc($variant['color']) ?>"></td>
                                        <td><input type="number" step="0.01" name="variants[<?= $index ?>][price]" class="form-control form-control-sm" value="<?= esc($variant['price']) ?>"></td>
                                        <td><input type="number" name="variants[<?= $index ?>][stock_quantity]" class="form-control form-control-sm" value="<?= esc($variant['stock_quantity']) ?>" required></td>
                                        <td><button type="button" class="btn btn-outline-danger btn-sm remove-variant">✕</button></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td><input type="text" name="variants[0][sku]" class="form-control form-control-sm" required></td>
                                    <td><input type="text" name="variants[0][size]" class="form-control form-control-sm"></td>
                                    <td><input type="text" name="variants[0][color]" class="form-control form-control-sm"></td>
                                    <td><input type="number" step="0.01" name="variants[0][price]" class="form-control form-control-sm" value="0.00"></td>
                                    <td><input type="number" name="variants[0][stock_quantity]" class="form-control form-control-sm" value="0" required></td>
                                    <td><button type="button" class="btn btn-outline-danger btn-sm remove-variant">✕</button></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <p class="section-label">Product Image</p>

        <div class="mb-4 image-section">
            <label class="form-label d-block fw-bold">Product Image</label>
            <div class="mb-3">
                <?php if (!empty($product['base_image'])): ?>
                    <p class="text-muted small mb-1">Current Image:</p>
                    <img src="<?= base_url('uploads/products/' . esc($product['base_image'])) ?>" alt="Current Image" class="img-thumbnail" style="max-height: 150px;">
                <?php else: ?>
                    <p class="text-muted small fst-italic">No image currently assigned to this product.</p>
                <?php endif; ?>
            </div>
            <label class="form-label">Upload New Image</label>
            <input type="file" name="image" class="form-control bg-white" accept="image/png, image/jpeg, image/jpg, image/webp">
            <small class="text-muted" style="font-size:.78rem;color:var(--txt-3)!important">Leave blank if you want to keep the current image.</small>
        </div>

        <p class="section-label">Visibility</p>

        <div class="mb-2" style="max-width:280px">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <?php $statusValue = old('status', $product['status']); ?>
                <option value="Active" <?= $statusValue === 'Active' ? 'selected' : '' ?>>Active</option>
                <option value="Inactive" <?= $statusValue === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-success">Save Changes</button>
            <a href="<?= base_url('products') ?>" class="btn btn-secondary">Cancel</a>
        </div>

    </form>
</div>

<script>
    // Set starting index based on existing rows
    let variantIndex = <?= !empty($variants) ? count($variants) : 1 ?>;
    
    document.getElementById('addVariantBtn').addEventListener('click', function() {
        const tableBody = document.querySelector('#variantsTable tbody');
        const newRow = `
            <tr>
                <td><input type="text" name="variants[${variantIndex}][sku]" class="form-control form-control-sm" required></td>
                <td><input type="text" name="variants[${variantIndex}][size]" class="form-control form-control-sm"></td>
                <td><input type="text" name="variants[${variantIndex}][color]" class="form-control form-control-sm"></td>
                <td><input type="number" step="0.01" name="variants[${variantIndex}][price]" class="form-control form-control-sm" value="0.00"></td>
                <td><input type="number" name="variants[${variantIndex}][stock_quantity]" class="form-control form-control-sm" value="0" required></td>
                <td><button type="button" class="btn btn-outline-danger btn-sm remove-variant">✕</button></td>
            </tr>
        `;
        tableBody.insertAdjacentHTML('beforeend', newRow);
        variantIndex++;
    });

    document.getElementById('variantsTable').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-variant')) {
            if (document.querySelectorAll('#variantsTable tbody tr').length > 1) {
                e.target.closest('tr').remove();
            } else {
                alert("At least one variant is required.");
            }
        }
    });
</script>

<?= $this->endSection(); ?>
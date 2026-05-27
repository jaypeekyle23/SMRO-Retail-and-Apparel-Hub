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
    --info-bg:    #EBF5FB;
    --info-border:#C8E3F0;
    --info:       #2471A3;
    --r:          12px;
    --shadow:     0 2px 12px rgba(0,0,0,.06);
  }

  body, .content-wrapper, main { background: var(--bg) !important; font-family: 'DM Sans', sans-serif; }

  /* ── Page Header ── */
  .page-header h1 { font-family: 'Sora', sans-serif; font-size: 1.6rem; font-weight: 700; color: var(--txt); letter-spacing: -.02em; margin: 0; }
  .page-header p  { color: var(--txt-2); font-size: .875rem; margin: 0; }

  /* ── Back Button ── */
  .btn-back       { display: inline-flex; align-items: center; gap: 6px; font-size: .8rem; font-weight: 500; padding: .45rem 1rem; border-radius: 8px; background: var(--surface); border: 1px solid var(--border); color: var(--txt-2); text-decoration: none; transition: background .15s; }
  .btn-back:hover { background: var(--bg); border-color: var(--txt-3); color: var(--txt); }

  /* ── Flash Alerts ── */
  .alert-success { background: var(--ok-bg);     border: 1px solid #A7D7BE; color: #155235;       border-radius: var(--r); font-size: .875rem; }
  .alert-danger  { background: var(--danger-bg); border: 1px solid #F0C4C0; color: var(--danger); border-radius: var(--r); font-size: .875rem; }

  /* ── Empty State ── */
  .empty-state       { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); padding: 4rem 1rem; text-align: center; }
  .empty-state-icon  { width: 56px; height: 56px; border-radius: 14px; background: var(--accent-bg); display: flex; align-items: center; justify-content: center; margin: 0 auto 1.1rem; color: var(--accent); }
  .empty-state h5    { font-family: 'Sora', sans-serif; font-size: 1.05rem; font-weight: 600; color: var(--txt); margin-bottom: .35rem; }
  .empty-state p     { font-size: .875rem; color: var(--txt-2); margin-bottom: 1rem; }
  .btn-browse        { display: inline-flex; align-items: center; gap: 6px; font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 600; padding: .55rem 1.2rem; border-radius: 9px; background: var(--accent); border: none; color: #fff; text-decoration: none; transition: background .15s; }
  .btn-browse:hover  { background: #b35a23; color: #fff; }

  /* ── Main Card ── */
  .main-card        { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); overflow: hidden; }
  .main-card-header { display: flex; justify-content: space-between; align-items: center; padding: 1rem 1.25rem; border-bottom: 1px solid var(--border); background: var(--bg); }
  .main-card-title  { font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: var(--txt-2); margin: 0; }
  .cart-count       { display: inline-flex; align-items: center; justify-content: center; font-family: 'Sora', sans-serif; font-size: .68rem; font-weight: 700; background: var(--accent-bg); color: var(--accent); border-radius: 99px; padding: .15em .6em; margin-left: .45rem; }

  /* ── Clear Cart ── */
  .btn-clear        { display: inline-flex; align-items: center; gap: 5px; font-size: .75rem; font-weight: 500; padding: .35rem .85rem; border-radius: 7px; background: var(--danger-bg); border: 1px solid #F0C4C0; color: var(--danger); transition: background .15s; }
  .btn-clear:hover  { background: #F5D0CC; }

  /* ── Cart Item Row ── */
  .cart-item             { display: flex; gap: 1rem; align-items: flex-start; padding: 1.1rem 1.25rem; border-bottom: 1px solid var(--border); transition: background .15s; }
  .cart-item:last-child  { border-bottom: none; }
  .cart-item:hover       { background: #FBF7F4; }

  .product-thumb         { width: 64px; height: 64px; object-fit: cover; border-radius: 10px; border: 1px solid var(--border); flex-shrink: 0; }
  .product-thumb-empty   { width: 64px; height: 64px; border-radius: 10px; border: 1px solid var(--border); background: var(--bg); display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: var(--txt-3); }

  .item-info             { flex: 1; min-width: 0; }
  .item-top              { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: .65rem; gap: .5rem; }
  .item-name             { font-weight: 600; font-size: .9rem; color: var(--txt); margin: 0 0 3px; }
  .item-price            { font-size: .78rem; color: var(--txt-3); }
  .item-subtotal         { font-family: 'Sora', sans-serif; font-size: 1rem; font-weight: 700; color: var(--accent); white-space: nowrap; }

  /* ── Item Controls ── */
  .item-controls         { display: flex; flex-wrap: wrap; gap: .5rem; align-items: flex-end; }
  .ctrl-group            { display: flex; flex-direction: column; gap: 3px; }
  .ctrl-label            { font-family: 'Sora', sans-serif; font-size: .65rem; font-weight: 600; letter-spacing: .07em; text-transform: uppercase; color: var(--txt-3); }
  .form-select-sm,
  .form-control-sm       { border: 1px solid var(--border); border-radius: 7px; background: var(--bg); font-size: .8rem; color: var(--txt); padding: .35rem .65rem; }
  .form-select-sm:focus,
  .form-control-sm:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(201,106,46,.12); background: var(--surface); outline: none; }
  input.form-control-sm  { width: 70px; }
  .variant-text          { font-family: 'Sora', sans-serif; font-size: .72rem; font-weight: 600; color: var(--accent); letter-spacing: .02em; margin-top: 5px; }

  /* ── Item Action Buttons ── */
  .btn-update  { display: inline-flex; align-items: center; gap: 5px; font-size: .75rem; font-weight: 500; padding: .35rem .85rem; border-radius: 7px; background: var(--info-bg); border: 1px solid var(--info-border); color: var(--info); transition: background .15s; }
  .btn-update:hover  { background: #D4EAF7; }
  .btn-remove-item   { display: inline-flex; align-items: center; justify-content: center; width: 30px; height: 30px; border-radius: 7px; background: var(--danger-bg); border: 1px solid #F0C4C0; color: var(--danger); transition: background .15s; padding: 0; flex-shrink: 0; }
  .btn-remove-item:hover { background: #F5D0CC; }

  /* ── Summary Card ── */
  .summary-card         { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); overflow: hidden; position: sticky; top: 1.5rem; }
  .summary-card-header  { padding: 1rem 1.25rem; border-bottom: 1px solid var(--border); background: var(--bg); }
  .summary-card-title   { font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: var(--txt-2); margin: 0; }
  .summary-card-body    { padding: 1.25rem; }
  .summary-row          { display: flex; justify-content: space-between; align-items: center; font-size: .875rem; margin-bottom: .65rem; }
  .summary-row .label   { color: var(--txt-2); }
  .summary-row .value   { color: var(--txt); font-weight: 500; }
  .summary-divider      { border: none; border-top: 1px solid var(--border); margin: .85rem 0; }
  .summary-total        { display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 1.25rem; }
  .summary-total .label { font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: var(--txt); }
  .summary-total .amount{ font-family: 'Sora', sans-serif; font-size: 1.4rem; font-weight: 700; color: var(--accent); }
  .btn-place-order      { display: flex; align-items: center; justify-content: center; gap: 7px; width: 100%; font-family: 'Sora', sans-serif; font-size: .85rem; font-weight: 700; padding: .7rem 1rem; border-radius: 9px; background: var(--accent); border: none; color: #fff; transition: background .15s, transform .1s; cursor: pointer; }
  .btn-place-order:hover  { background: #b35a23; }
  .btn-place-order:active { transform: scale(.98); }
</style>

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4 page-header">
    <div>
        <h1>Cart</h1>
        <p>Review your items before placing an order</p>
    </div>
    <a href="<?= base_url('shop'); ?>" class="btn-back">
        <i data-feather="arrow-left" style="width:13px;height:13px;"></i>
        Continue Shopping
    </a>
</div>

<!-- Flash Messages -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
        <?= session()->getFlashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
        <?= session()->getFlashdata('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (empty($cart)): ?>

    <!-- Empty Cart State -->
    <div class="empty-state">
        <div class="empty-state-icon">
            <i data-feather="shopping-cart" style="width:24px;height:24px;"></i>
        </div>
        <h5>Your cart is empty</h5>
        <p>Looks like you haven't added anything yet.</p>
        <a href="<?= base_url('shop'); ?>" class="btn-browse">
            <i data-feather="shopping-bag" style="width:14px;height:14px;"></i>
            Browse Shop
        </a>
    </div>

<?php else: ?>

    <div class="row g-4">

        <!-- ── Cart Items ── -->
        <div class="col-lg-8">
            <div class="main-card">
                <div class="main-card-header">
                    <span class="main-card-title">
                        Cart Items
                        <span class="cart-count"><?= count($cart); ?></span>
                    </span>
                    <form method="POST" action="<?= base_url('cart/clear'); ?>">
                        <?= csrf_field(); ?>
                        <button type="submit" class="btn-clear">
                            <i data-feather="trash-2" style="width:13px;height:13px;"></i>
                            Clear Cart
                        </button>
                    </form>
                </div>

                <?php foreach ($cart as $item): ?>
                    <div class="cart-item">

                        <!-- Product Image -->
                        <?php if (!empty($item['base_image'])): ?>
                            <img src="<?= base_url('uploads/products/' . $item['base_image']); ?>"
                                class="product-thumb">
                        <?php else: ?>
                            <div class="product-thumb-empty">
                                <i data-feather="image" style="width:22px;height:22px;"></i>
                            </div>
                        <?php endif; ?>

                        <!-- Product Info + Controls -->
                        <div class="item-info">
                            <div class="item-top">
                                <div>
                                    <p class="item-name"><?= esc($item['product_name']); ?></p>
                                    <p class="item-price">₱<?= number_format($item['price'], 2); ?> each</p>
                                </div>
                                <span class="item-subtotal">₱<?= number_format($item['price'] * $item['quantity'], 2); ?></span>
                            </div>

                            <!-- Update Form -->
                            <form method="POST" action="<?= base_url('cart/update'); ?>" class="item-controls">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="variant_id" value="<?= $item['variant_id']; ?>">

                                <!-- Variant Selector -->
                                <?php if (!empty($item['all_variants']) && count($item['all_variants']) > 1): ?>
                                    <div class="ctrl-group">
                                        <span class="ctrl-label">Variant</span>
                                        <select name="new_variant_id" class="form-select-sm" style="min-width:190px;">
                                            <?php foreach ($item['all_variants'] as $v): ?>
                                                <option value="<?= $v['id']; ?>" <?= $v['id'] == $item['variant_id'] ? 'selected' : ''; ?>>
                                                    <?= esc($v['sku']); ?>
                                                    <?= !empty($v['size'])  ? '/ ' . esc($v['size'])  : ''; ?>
                                                    <?= !empty($v['color']) ? '/ ' . esc($v['color']) : ''; ?>
                                                    (<?= $v['stock_quantity']; ?> in stock)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                <?php else: ?>
                                    <input type="hidden" name="new_variant_id" value="<?= $item['variant_id']; ?>">
                                    <div class="ctrl-group">
                                        <span class="ctrl-label">Variant</span>
                                        <div class="variant-text">
                                            <?= esc($item['sku']); ?>
                                            <?= !empty($item['size'])  ? '<span style="color:var(--txt-3);font-weight:400"> / </span>' . esc($item['size'])  : ''; ?>
                                            <?= !empty($item['color']) ? '<span style="color:var(--txt-3);font-weight:400"> / </span>' . esc($item['color']) : ''; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Quantity -->
                                <div class="ctrl-group">
                                    <span class="ctrl-label">Qty</span>
                                    <input
                                        type="number"
                                        name="quantity"
                                        value="<?= $item['quantity']; ?>"
                                        min="1"
                                        class="form-control-sm">
                                </div>

                                <!-- Update Button -->
                                <button type="submit" class="btn-update" style="align-self:flex-end;">
                                    <i data-feather="refresh-cw" style="width:12px;height:12px;"></i>
                                    Update
                                </button>

                                <!-- Remove Button -->
                                <button
                                    type="submit"
                                    form=""
                                    class="btn-remove-item remove-btn"
                                    data-variant="<?= $item['variant_id']; ?>"
                                    style="align-self:flex-end;">
                                    <i data-feather="x" style="width:13px;height:13px;"></i>
                                </button>

                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>

        <!-- ── Order Summary ── -->
        <div class="col-lg-4">
            <div class="summary-card">
                <div class="summary-card-header">
                    <span class="summary-card-title">Order Summary</span>
                </div>
                <div class="summary-card-body">
                    <div class="summary-row">
                        <span class="label">Subtotal</span>
                        <span class="value">₱<?= number_format($total, 2); ?></span>
                    </div>
                    <hr class="summary-divider">
                    <div class="summary-total">
                        <span class="label">Total</span>
                        <span class="amount">₱<?= number_format($total, 2); ?></span>
                    </div>
                    <form method="POST" action="<?= base_url('checkout/place-order'); ?>">
                        <?= csrf_field(); ?>
                        <button type="submit" class="btn-place-order">
                            <i data-feather="check-circle" style="width:15px;height:15px;"></i>
                            Place Order
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>

<?php endif; ?>

<!-- Hidden remove forms -->
<div id="remove-forms">
    <?php foreach ($cart as $item): ?>
        <form id="remove-<?= $item['variant_id']; ?>" method="POST" action="<?= base_url('cart/remove'); ?>">
            <?= csrf_field(); ?>
            <input type="hidden" name="variant_id" value="<?= $item['variant_id']; ?>">
        </form>
    <?php endforeach; ?>
</div>

<script>
    document.querySelectorAll('.remove-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const variantId = this.getAttribute('data-variant');
            document.getElementById('remove-' + variantId).submit();
        });
    });
</script>

<?= $this->endSection(); ?>
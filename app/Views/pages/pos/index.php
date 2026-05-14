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

  /* ── Alerts ──────────────────────────────────── */
  .alert-success { background: var(--ok-bg); border: 1px solid #A7D7BE; color: #155235; border-radius: var(--r); font-size: .875rem; }
  .alert-danger  { background: var(--danger-bg); border: 1px solid #F0C4C0; color: var(--danger); border-radius: var(--r); font-size: .875rem; }

  /* ── Panel cards ─────────────────────────────── */
  .panel { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); overflow: hidden; }
  .panel-header { background: var(--surface); border-bottom: 1px solid var(--border); padding: 1rem 1.25rem; display: flex; align-items: center; justify-content: space-between; }
  .panel-header h6 { font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 700; color: var(--txt); margin: 0; }
  .panel-body { padding: 1.25rem; }

  /* ── Product grid cards ──────────────────────── */
  .item-card {
    background: var(--surface); border: 1.5px solid var(--border); border-radius: var(--r);
    cursor: pointer; transition: border-color .15s, box-shadow .15s, transform .15s;
    padding: 1rem; height: 100%;
  }
  .item-card:hover {
    border-color: var(--accent); box-shadow: 0 4px 16px rgba(201,106,46,.15);
    transform: translateY(-2px);
  }
  .item-card:active { transform: scale(.97); }
  .item-card h6 { font-family: 'Sora', sans-serif; font-size: .85rem; font-weight: 700; color: var(--txt); margin-bottom: .2rem; }
  .item-card .variant { font-size: .78rem; color: var(--txt-3); margin-bottom: .75rem; }
  .item-card .price { font-family: 'Sora', sans-serif; font-size: .95rem; font-weight: 700; color: var(--accent); }
  .item-card .stock-badge { background: var(--ok-bg); color: var(--ok); font-size: .68rem; font-weight: 600; border-radius: 6px; padding: .25em .6em; }

  /* ── Empty state ─────────────────────────────── */
  .empty-state { padding: 3rem 1rem; text-align: center; color: var(--txt-3); }
  .empty-state i { font-size: 2rem; display: block; margin-bottom: .5rem; }

  /* ── Cart panel ──────────────────────────────── */
  .cart-panel { top: 20px; }
  .cart-panel .panel-header { background: var(--bg); }

  /* ── Cart items list ─────────────────────────── */
  #cart-items { list-style: none; padding: 0; margin: 0; }
  #cart-items li { border-bottom: 1px solid var(--border); padding: .85rem 1.25rem; }
  #cart-items li:last-child { border-bottom: none; }
  .cart-item-name { font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 700; color: var(--txt); }
  .cart-item-meta { font-size: .75rem; color: var(--txt-3); }
  .cart-item-price { font-family: 'Sora', sans-serif; font-size: .85rem; font-weight: 700; color: var(--txt); }
  .cart-empty-msg  { padding: 2.5rem 1rem; text-align: center; color: var(--txt-3); font-size: .85rem; }

  /* ── Cart clear button ───────────────────────── */
  .btn-clear { background: var(--danger-bg) !important; border: 1px solid #F0C4C0 !important; color: var(--danger) !important; font-size: .75rem; font-weight: 600; border-radius: 6px; padding: .28rem .75rem; font-family: 'Sora', sans-serif; }
  .btn-clear:hover { background: #F5D0CC !important; }

  /* ── Cart remove link ────────────────────────── */
  .btn-remove { background: none; border: none; padding: 0; font-size: .72rem; color: var(--danger); cursor: pointer; font-family: 'DM Sans', sans-serif; }
  .btn-remove:hover { text-decoration: underline; }

  /* ── Cart footer ─────────────────────────────── */
  .cart-footer { background: var(--bg); border-top: 1px solid var(--border); padding: 1.25rem; }
  .cart-total-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.1rem; }
  .cart-total-label { font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 600; color: var(--txt-2); }
  .cart-total-value { font-family: 'Sora', sans-serif; font-size: 1.3rem; font-weight: 700; color: var(--txt); }

  /* ── Checkout form controls ──────────────────── */
  .checkout-form .form-label { font-family: 'Sora', sans-serif; font-size: .68rem; font-weight: 600; letter-spacing: .08em; text-transform: uppercase; color: var(--txt-3); margin-bottom: .35rem; }
  .checkout-form .form-control { border: 1px solid var(--border); border-radius: 8px; background: var(--surface); font-size: .85rem; color: var(--txt); padding: .5rem .85rem; transition: border-color .15s, box-shadow .15s; }
  .checkout-form .form-control::placeholder { color: var(--txt-3); }
  .checkout-form .form-control:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(201,106,46,.12); outline: none; }

  /* ── Checkout button ─────────────────────────── */
  .btn-checkout { background: var(--accent) !important; border-color: var(--accent) !important; font-family: 'Sora', sans-serif; font-size: .9rem; font-weight: 700; border-radius: 10px; padding: .75rem; color: #fff !important; width: 100%; letter-spacing: .01em; transition: background .15s; }
  .btn-checkout:hover:not(:disabled) { background: #b35a23 !important; border-color: #b35a23 !important; }
  .btn-checkout:disabled { opacity: .45; cursor: not-allowed; }
</style>

<div class="page-header mb-4">
    <h1 class="h3 mb-0 text-gray-800"><strong><?= esc($title); ?></strong></h1>
    <p class="text-muted">Tap an item to add it to the cart.</p>
</div>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="row">
    <!-- ── Product Grid ── -->
    <div class="col-lg-8 mb-4">
        <div class="panel mb-4">
            <div class="panel-header">
                <h6><i class="bi bi-grid me-2"></i>Available Items</h6>
            </div>
            <div class="panel-body">
                <div class="row g-3">
                    <?php if(!empty($availableItems)): ?>
                        <?php foreach($availableItems as $item): ?>
                            <div class="col-md-6 col-xl-4">
                                <div class="item-card"
                                     onclick="addToCart(<?= $item['id'] ?>, '<?= esc($item['product_name']) ?>', '<?= esc($item['size']) ?>/<?= esc($item['color']) ?>', <?= esc($item['selling_price']) ?>)">
                                    <h6><?= esc($item['product_name']) ?></h6>
                                    <p class="variant"><?= esc($item['size']) ?> / <?= esc($item['color']) ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="price">₱<?= number_format($item['selling_price'], 2) ?></span>
                                        <span class="stock-badge"><?= esc($item['stock_quantity']) ?> left</span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="empty-state">
                                <i class="bi bi-box-seam"></i>
                                No items available in stock. Time to restock!
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- ── Cart Panel ── -->
    <div class="col-lg-4">
        <div class="panel sticky-top cart-panel">
            <div class="panel-header">
                <h6><i class="bi bi-cart3 me-2"></i>Current Order</h6>
                <button class="btn-clear" onclick="clearCart()">Clear</button>
            </div>

            <ul id="cart-items">
                <li id="empty-cart-msg">
                    <div class="cart-empty-msg">Cart is empty</div>
                </li>
            </ul>

            <div class="cart-footer">
                <div class="cart-total-row">
                    <span class="cart-total-label">Total</span>
                    <span class="cart-total-value">₱<span id="cart-total">0.00</span></span>
                </div>

                <form action="<?= base_url('pos/checkout') ?>" method="POST" id="checkout-form" class="checkout-form">
                    <?= csrf_field() ?>
                    <input type="hidden" name="cart_data" id="cart-data-input">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-uppercase text-muted">Customer Name</label>
                        <input type="text" name="customer_name" class="form-control" placeholder="e.g. Juan Dela Cruz">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-uppercase text-muted">Phone Number</label>
                        <input type="text" name="customer_phone" class="form-control" placeholder="e.g. 09123456789">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-uppercase text-muted">Email (optional)</label>
                        <input type="text" name="customer_email" class="form-control" placeholder="e.g. juan@email.com">
                    </div>
                    <button type="submit" class="btn-checkout" id="checkout-btn" disabled>
                        Complete Sale
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let cart = {};

    function addToCart(variantId, name, variantName, price) {
        price = parseFloat(price);

        if (cart[variantId]) {
            cart[variantId].quantity++;
        } else {
            cart[variantId] = {
                id: variantId,
                name: name,
                variant: variantName,
                price: price,
                quantity: 1
            };
        }
        renderCart();
    }

    function removeFromCart(variantId) {
        delete cart[variantId];
        renderCart();
    }

    function clearCart() {
        cart = {};
        renderCart();
    }

    function renderCart() {
        const cartItemsContainer = document.getElementById('cart-items');
        const checkoutBtn = document.getElementById('checkout-btn');
        const cartDataInput = document.getElementById('cart-data-input');
        const totalDisplay = document.getElementById('cart-total');

        cartItemsContainer.innerHTML = '';
        let total = 0;
        let itemCount = 0;

        for (const id in cart) {
            const item = cart[id];
            const itemTotal = item.price * item.quantity;
            total += itemTotal;
            itemCount++;

            cartItemsContainer.innerHTML += `
                <li class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="cart-item-name">${item.name}</div>
                        <div class="cart-item-meta">${item.variant} &nbsp;&bull;&nbsp; x${item.quantity}</div>
                    </div>
                    <div class="text-end">
                        <div class="cart-item-price">₱${itemTotal.toFixed(2)}</div>
                        <button type="button" class="btn-remove" onclick="removeFromCart(${id})">Remove</button>
                    </div>
                </li>
            `;
        }

        if (itemCount === 0) {
            cartItemsContainer.innerHTML = '<li><div class="cart-empty-msg">Cart is empty</div></li>';
            checkoutBtn.disabled = true;
        } else {
            checkoutBtn.disabled = false;
        }

        totalDisplay.innerText = total.toFixed(2);
        cartDataInput.value = JSON.stringify(cart);
    }
</script>

<?= $this->endSection(); ?>
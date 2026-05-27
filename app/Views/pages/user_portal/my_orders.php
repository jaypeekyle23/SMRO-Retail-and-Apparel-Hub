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

  /* ── Page Header ── */
  .page-header h1       { font-family: 'Sora', sans-serif; font-size: 1.6rem; font-weight: 700; color: var(--txt); letter-spacing: -.02em; margin: 0; }
  .page-header p        { color: var(--txt-2); font-size: .875rem; margin: 0; }

  /* ── Flash Alerts ── */
  .alert-success { background: var(--ok-bg);   border: 1px solid #A7D7BE; color: #155235;    border-radius: var(--r); font-size: .875rem; }
  .alert-danger  { background: var(--danger-bg); border: 1px solid #F0C4C0; color: var(--danger); border-radius: var(--r); font-size: .875rem; }

  /* ── Empty State ── */
  .empty-state       { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); padding: 3.5rem 1rem; text-align: center; }
  .empty-state-icon  { width: 52px; height: 52px; border-radius: 14px; background: var(--accent-bg); display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; color: var(--accent); }
  .empty-state h5    { font-family: 'Sora', sans-serif; font-size: 1rem; font-weight: 600; color: var(--txt); margin-bottom: .35rem; }
  .empty-state p     { font-size: .875rem; color: var(--txt-2); margin-bottom: .9rem; }
  .empty-state a     { color: var(--accent); font-weight: 500; text-decoration: none; }
  .empty-state a:hover { text-decoration: underline; }

  /* ── Order Card ── */
  .order-card            { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); overflow: hidden; margin-bottom: 1.25rem; }
  .order-card-header     { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: .75rem; padding: 1rem 1.25rem; border-bottom: 1px solid var(--border); background: var(--bg); }
  .order-number          { font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 700; color: var(--accent); letter-spacing: .02em; }
  .order-date            { font-size: .78rem; color: var(--txt-3); margin-top: 2px; }
  .order-actions         { display: flex; align-items: center; gap: .5rem; flex-wrap: wrap; }

  /* Status badge */
  .status-badge          { display: inline-flex; align-items: center; gap: .35rem; font-size: .72rem; font-weight: 600; padding: .3em .75em; border-radius: 99px; }
  .status-completed      { background: var(--ok-bg); color: var(--ok); }
  .status-completed::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: var(--ok); }

  /* Action buttons */
  .btn-receipt  { display: inline-flex; align-items: center; gap: 5px; font-size: .75rem; font-weight: 500; padding: .35rem .85rem; border-radius: 7px; background: var(--surface); border: 1px solid var(--border); color: var(--txt-2); text-decoration: none; transition: background .15s, border-color .15s; }
  .btn-receipt:hover { background: var(--bg); border-color: var(--txt-3); color: var(--txt); }
  .btn-return   { display: inline-flex; align-items: center; gap: 5px; font-size: .75rem; font-weight: 500; padding: .35rem .85rem; border-radius: 7px; background: var(--warn-bg); border: 1px solid #F0D58A; color: var(--warn); cursor: pointer; transition: background .15s; }
  .btn-return:hover { background: #FDE99A; }

  /* ── Order Table ── */
  .order-table                  { margin: 0; }
  .order-table thead th         { font-family: 'Sora', sans-serif; font-size: .67rem; font-weight: 600; letter-spacing: .09em; text-transform: uppercase; color: var(--txt-3); background: var(--bg); border-bottom: 1px solid var(--border) !important; border-top: none !important; padding: .75rem 1rem; white-space: nowrap; }
  .order-table tbody td         { border-bottom: 1px solid var(--border) !important; border-top: none !important; padding: .85rem 1rem; vertical-align: middle; font-size: .875rem; color: var(--txt); }
  .order-table tbody tr:last-child td { border-bottom: none !important; }
  .order-table tbody tr:hover   { background: #FBF7F4 !important; }
  .order-table tfoot td         { background: var(--bg); border-top: 1px solid var(--border) !important; padding: .75rem 1rem; font-size: .875rem; }
  .sku-cell                     { font-family: 'Sora', sans-serif; font-size: .73rem; font-weight: 600; color: var(--accent); letter-spacing: .02em; }
  .total-amount                 { font-family: 'Sora', sans-serif; font-weight: 700; font-size: .95rem; color: var(--accent); }

  /* ── Return Status Strip ── */
  .return-strip          { padding: .75rem 1.25rem; border-top: 1px solid var(--border); background: var(--surface); display: flex; flex-direction: column; gap: .5rem; }
  .return-item           { display: flex; align-items: flex-start; gap: .6rem; padding: .6rem .9rem; border-radius: 8px; font-size: .8rem; line-height: 1.5; }
  .return-item.approved  { background: var(--ok-bg); color: #155235; }
  .return-item.rejected  { background: var(--danger-bg); color: var(--danger); }
  .return-item.pending   { background: var(--warn-bg); color: var(--warn); }
  .return-item i         { flex-shrink: 0; margin-top: 2px; }
  .return-date           { font-size: .72rem; opacity: .7; margin-left: .35rem; }

  /* ── Modal ── */
  .modal-content         { border: 1px solid var(--border); border-radius: var(--r); box-shadow: 0 8px 32px rgba(0,0,0,.10); overflow: hidden; }
  .modal-header          { background: var(--bg); border-bottom: 1px solid var(--border); padding: 1.1rem 1.4rem; }
  .modal-title           { font-family: 'Sora', sans-serif; font-size: 1rem; font-weight: 600; color: var(--txt); }
  .modal-body            { padding: 1.4rem; background: var(--surface); }
  .modal-footer          { background: var(--bg); border-top: 1px solid var(--border); padding: .9rem 1.4rem; }
  .modal-order-ref       { font-size: .825rem; color: var(--txt-2); background: var(--bg); border: 1px solid var(--border); border-radius: 8px; padding: .55rem .9rem; margin-bottom: 1.1rem; }
  .modal-order-ref strong { color: var(--accent); font-family: 'Sora', sans-serif; }

  /* Form elements in modal */
  .form-label            { font-family: 'Sora', sans-serif; font-size: .75rem; font-weight: 600; letter-spacing: .04em; color: var(--txt-2); text-transform: uppercase; margin-bottom: .4rem; }
  .form-control,
  .form-select           { border: 1px solid var(--border); border-radius: 8px; background: var(--bg); font-size: .875rem; color: var(--txt); padding: .5rem .85rem; }
  .form-control:focus,
  .form-select:focus     { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(201,106,46,.12); background: var(--surface); outline: none; }
  .form-text             { font-size: .76rem; color: var(--txt-3); margin-top: .3rem; }
  .refund-estimate       { font-size: .825rem; color: var(--txt-2); background: var(--accent-bg); border: 1px solid #F0D4BC; border-radius: 8px; padding: .55rem .9rem; margin-top: .5rem; }
  .refund-estimate strong { font-family: 'Sora', sans-serif; color: var(--accent); font-size: .95rem; }

  /* Modal buttons */
  .btn-modal-cancel   { font-size: .82rem; font-weight: 500; padding: .45rem 1rem; border-radius: 8px; background: var(--surface); border: 1px solid var(--border); color: var(--txt-2); }
  .btn-modal-cancel:hover { background: var(--bg); color: var(--txt); }
  .btn-modal-submit   { display: inline-flex; align-items: center; gap: 6px; font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 600; padding: .45rem 1.1rem; border-radius: 8px; background: var(--warn-bg); border: 1px solid #F0D58A; color: var(--warn); }
  .btn-modal-submit:hover { background: #FDE99A; color: var(--warn); }
</style>

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4 page-header">
    <div>
        <h1>My Orders</h1>
        <p>Your complete order history</p>
    </div>
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

<?php if (empty($orders)): ?>
    <div class="empty-state">
        <div class="empty-state-icon">
            <i data-feather="shopping-bag" style="width:22px;height:22px;"></i>
        </div>
        <h5>No orders yet</h5>
        <p>You haven't placed any orders. Browse our catalog and find something you like.</p>
        <a href="<?= base_url('shop'); ?>">Start shopping &rarr;</a>
    </div>

<?php else: ?>
    <?php foreach ($orders as $order): ?>
        <div class="order-card">

            <!-- Card Header -->
            <div class="order-card-header">
                <div>
                    <div class="order-number"><?= esc($order['order_number']); ?></div>
                    <div class="order-date"><?= date('M d, Y · h:i A', strtotime($order['created_at'])); ?></div>
                </div>
                <div class="order-actions">
                    <span class="status-badge status-completed">Completed</span>
                    <a href="<?= base_url('order-confirmed/' . $order['id']); ?>" class="btn-receipt">
                        <i data-feather="file-text" style="width:13px;height:13px;"></i> Receipt
                    </a>
                    <button
                        class="btn-return"
                        data-bs-toggle="modal"
                        data-bs-target="#returnModal"
                        data-order-id="<?= $order['id']; ?>"
                        data-order-number="<?= esc($order['order_number']); ?>">
                        <i data-feather="rotate-ccw" style="width:13px;height:13px;"></i> Return / Refund
                    </button>
                </div>
            </div>

            <!-- Items Table -->
            <div>
                <table class="table order-table mb-0">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>SKU</th>
                            <th>Size</th>
                            <th>Color</th>
                            <th class="text-center">Qty</th>
                            <th class="text-end">Price</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order['items'] as $item): ?>
                            <tr>
                                <td style="font-weight:500;"><?= esc($item['product_name']); ?></td>
                                <td class="sku-cell"><?= esc($item['sku']); ?></td>
                                <td style="color:var(--txt-2);"><?= esc($item['size'] ?? '—'); ?></td>
                                <td style="color:var(--txt-2);"><?= esc($item['color'] ?? '—'); ?></td>
                                <td class="text-center" style="color:var(--txt-2);"><?= $item['quantity']; ?></td>
                                <td class="text-end" style="color:var(--txt-2);">₱<?= number_format($item['price'], 2); ?></td>
                                <td class="text-end" style="font-weight:500;">₱<?= number_format($item['price'] * $item['quantity'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" class="text-end fw-bold" style="color:var(--txt-2); font-size:.8rem; letter-spacing:.04em; text-transform:uppercase; font-family:'Sora',sans-serif;">Total</td>
                            <td class="text-end total-amount">₱<?= number_format($order['total_amount'], 2); ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Return Status Strip -->
            <?php if (!empty($order['returns'])): ?>
                <div class="return-strip">
                    <?php foreach ($order['returns'] as $return): ?>
                        <?php
                            $cls  = match($return['status']) {
                                'approved' => 'approved',
                                'rejected' => 'rejected',
                                default    => 'pending'
                            };
                            $icon = match($return['status']) {
                                'approved' => 'check-circle',
                                'rejected' => 'x-circle',
                                default    => 'clock'
                            };
                            $msg  = match($return['status']) {
                                'approved' => 'Return Approved — your refund of ₱' . number_format($return['refund_amount'], 2) . ' has been processed.',
                                'rejected' => 'Return Rejected — unfortunately your return request was not approved.',
                                default    => 'Return Pending — our team is reviewing your request.'
                            };
                        ?>
                        <div class="return-item <?= $cls; ?>">
                            <i data-feather="<?= $icon; ?>" style="width:14px;height:14px;"></i>
                            <div>
                                <strong>Return Request:</strong> <?= $msg; ?>
                                <span class="return-date"><?= date('M d, Y', strtotime($return['created_at'])); ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
    <?php endforeach; ?>
<?php endif; ?>


<!-- Return / Refund Modal -->
<div class="modal fade" id="returnModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Request Return / Refund</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="<?= base_url('my-orders/return'); ?>">
                <?= csrf_field(); ?>
                <input type="hidden" name="order_id" id="returnOrderId">
                <div class="modal-body">

                    <div class="modal-order-ref">
                        Order: <strong id="returnOrderNumber"></strong>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Select Item to Return <span style="color:var(--danger);">*</span></label>
                        <select name="variant_id" id="returnVariantSelect" class="form-select" required>
                            <option value="">— Choose an item —</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Quantity to Return <span style="color:var(--danger);">*</span></label>
                        <input type="number" name="quantity" id="returnQuantity" class="form-control" value="1" min="1" required>
                        <div class="form-text" id="returnQuantityInfo"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Reason <span style="color:var(--danger);">*</span></label>
                        <textarea
                            name="reason"
                            class="form-control"
                            rows="3"
                            placeholder="Please describe the reason for your return or refund request..."
                            required></textarea>
                    </div>

                    <div class="refund-estimate">
                        Estimated refund: <strong>₱<span id="returnRefundEstimate">0.00</span></strong>
                    </div>

                </div>
                <div class="modal-footer gap-2">
                    <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-modal-submit">
                        <i data-feather="rotate-ccw" style="width:13px;height:13px;"></i>
                        Submit Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Pass orders data to JS -->
<script>
    const ordersData = <?= json_encode(array_values($orders)); ?>;

    const returnModal = document.getElementById('returnModal');
    returnModal.addEventListener('show.bs.modal', function (event) {
        const button      = event.relatedTarget;
        const orderId     = button.getAttribute('data-order-id');
        const orderNumber = button.getAttribute('data-order-number');

        document.getElementById('returnOrderId').value              = orderId;
        document.getElementById('returnOrderNumber').textContent    = orderNumber;
        document.getElementById('returnRefundEstimate').textContent = '0.00';
        document.getElementById('returnQuantityInfo').textContent   = '';

        const select = document.getElementById('returnVariantSelect');
        select.innerHTML = '<option value="">— Choose an item —</option>';

        const order = ordersData.find(o => o.id == orderId);
        if (order && order.items) {
            order.items.forEach(function(item) {
                const label  = item.product_name + ' — ' + item.sku +
                    (item.size  ? ' / ' + item.size  : '') +
                    (item.color ? ' / ' + item.color : '');
                const option = document.createElement('option');
                option.value              = item.variant_id;
                option.textContent        = label;
                option.dataset.price      = item.price;
                option.dataset.maxQty     = item.quantity;
                select.appendChild(option);
            });
        }

        document.getElementById('returnQuantity').value = 1;
    });

    document.getElementById('returnVariantSelect').addEventListener('change', function() {
        const selected = this.options[this.selectedIndex];
        const price    = parseFloat(selected.dataset.price  ?? 0);
        const maxQty   = parseInt(selected.dataset.maxQty   ?? 1);
        const qtyInput = document.getElementById('returnQuantity');
        qtyInput.max   = maxQty;
        qtyInput.value = 1;
        document.getElementById('returnQuantityInfo').textContent   = 'Max: ' + maxQty;
        document.getElementById('returnRefundEstimate').textContent = (price * 1).toLocaleString('en-PH', { minimumFractionDigits: 2 });
    });

    document.getElementById('returnQuantity').addEventListener('input', function() {
        const select   = document.getElementById('returnVariantSelect');
        const selected = select.options[select.selectedIndex];
        const price    = parseFloat(selected.dataset.price ?? 0);
        const qty      = parseInt(this.value ?? 1);
        document.getElementById('returnRefundEstimate').textContent = (price * qty).toLocaleString('en-PH', { minimumFractionDigits: 2 });
    });
</script>

<?= $this->endSection(); ?>
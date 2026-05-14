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

  /* ── Page title ──────────────────────────────── */
  h1 { font-family: 'Sora', sans-serif; font-size: 1.6rem; color: var(--txt); letter-spacing: -.02em; }

  /* ── Outer card ──────────────────────────────── */
  .main-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); overflow: hidden; }
  .main-card > .card-header { background: var(--bg); border-bottom: 1px solid var(--border); padding: 1rem 1.5rem; }
  .main-card > .card-header h5 { font-family: 'Sora', sans-serif; font-size: .88rem; font-weight: 700; color: var(--txt); margin: 0; }
  .main-card > .card-body { padding: 1.5rem; }

  /* ── Tabs ────────────────────────────────────── */
  .nav-tabs { border-bottom: 2px solid var(--border); gap: .25rem; margin-bottom: 1.5rem; }
  .nav-tabs .nav-link { font-family: 'Sora', sans-serif; font-size: .8rem; font-weight: 600; color: var(--txt-3); border: none; border-bottom: 2px solid transparent; border-radius: 0; padding: .6rem 1rem; margin-bottom: -2px; background: none; transition: color .15s, border-color .15s; }
  .nav-tabs .nav-link:hover { color: var(--txt-2); border-bottom-color: var(--border); }
  .nav-tabs .nav-link.active { color: var(--accent); border-bottom-color: var(--accent); background: none; }

  /* ── Split layout ────────────────────────────── */
  .split-divider { width: 1px; background: var(--border); }

  /* ── Table ───────────────────────────────────── */
  .table { margin-bottom: 0; }
  .table thead th { font-family: 'Sora', sans-serif; font-size: .67rem; font-weight: 600; letter-spacing: .09em; text-transform: uppercase; color: var(--txt-3); background: var(--bg); border-bottom: 1px solid var(--border) !important; border-top: none; padding: .75rem .85rem; white-space: nowrap; }
  .table tbody td { border-bottom: 1px solid var(--border) !important; border-top: none; padding: .75rem .85rem; vertical-align: middle; font-size: .855rem; color: var(--txt); }
  .table tbody tr:last-child td { border-bottom: none !important; }
  .table-hover tbody tr:hover { background: #FBF7F4 !important; }
  .row-num { font-family: 'Sora', sans-serif; font-size: .72rem; font-weight: 600; color: var(--txt-3); }
  .table-wrap { border: 1px solid var(--border); border-radius: 10px; overflow: hidden; }

  /* ── Form section ────────────────────────────── */
  .form-section h5 { font-family: 'Sora', sans-serif; font-size: .88rem; font-weight: 700; color: var(--txt); margin-bottom: .75rem; }
  .form-section hr  { border-color: var(--border); margin-bottom: 1.25rem; }
  .form-label { font-family: 'Sora', sans-serif; font-size: .78rem; font-weight: 600; color: var(--txt-2); margin-bottom: .4rem; }
  .form-label a { color: var(--accent); text-decoration: none; font-weight: 500; font-size: .75rem; }
  .form-label a:hover { text-decoration: underline; }
  .form-control, .form-select {
    border: 1px solid var(--border); border-radius: 8px; background: var(--bg);
    font-size: .875rem; color: var(--txt); padding: .55rem .85rem;
    transition: border-color .15s, box-shadow .15s;
  }
  .form-control:focus, .form-select:focus {
    border-color: var(--accent); box-shadow: 0 0 0 3px rgba(201,106,46,.12);
    background: var(--surface); outline: none;
  }
  .form-control.is-invalid, .form-select.is-invalid { border-color: #E74C3C; }
  .invalid-feedback { font-size: .75rem; color: #C0392B; margin-top: .3rem; }

  /* ── Button ──────────────────────────────────── */
  .btn-primary { background: var(--accent) !important; border-color: var(--accent) !important; font-family: 'Sora', sans-serif; font-size: .82rem; font-weight: 600; border-radius: 8px; padding: .52rem 1.3rem; color: #fff !important; }
  .btn-primary:hover { background: #b35a23 !important; }
</style>

<h1 class="h3 mb-4"><strong><?= $title; ?></strong></h1>

<div class="container-fluid px-0">
    <div class="main-card">
        <div class="card-header">
            <h5 class="card-title mb-0">Create New Menu</h5>
        </div>
        <div class="card-body">

            <!-- Tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Menu Category</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="menu-tab" data-bs-toggle="tab" data-bs-target="#menu" type="button" role="tab" aria-controls="menu" aria-selected="false">Menu</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="submenu-tab" data-bs-toggle="tab" data-bs-target="#submenu" type="button" role="tab" aria-controls="submenu" aria-selected="false">Submenu</button>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">

                <!-- ── Tab 1: Menu Category ── -->
                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="table-wrap">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Menu Categories</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; foreach ($MenuCategories as $menuCategories): ?>
                                            <tr>
                                                <td class="row-num"><?= $no++; ?></td>
                                                <td><?= $menuCategories['menu_category']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6 form-section">
                            <h5>Create New Menu Category</h5>
                            <hr>
                            <form action="<?= base_url('menu-management/create-menu-category'); ?>" method="post">
                                <div class="mb-3">
                                    <label for="inputMenuCategory" class="form-label">Add Menu Category</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('inputMenuCategory')) ? 'is-invalid' : ''; ?>" autofocus value="<?= old('inputMenuCategory'); ?>" id="inputMenuCategory" name="inputMenuCategory" placeholder="Menu Category Name">
                                    <div class="invalid-feedback"><?= $validation->getError('inputMenuCategory'); ?></div>
                                </div>
                                <div class="text-end">
                                    <button class="btn btn-primary">Save Menu Category</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- ── Tab 2: Menu ── -->
                <div class="tab-pane fade" id="menu" role="tabpanel" aria-labelledby="menu-tab">
                    <div class="row g-4">
                        <div class="col-sm-6">
                            <div class="table-wrap">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Icon</th>
                                            <th>Title</th>
                                            <th>URL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; foreach ($Menus as $menu): ?>
                                            <tr>
                                                <td class="row-num"><?= $no++; ?></td>
                                                <td style="color:var(--txt-2)"><?= $menu['menu_category']; ?></td>
                                                <td><i class="align-middle" data-feather="<?= $menu['icon']; ?>"></i></td>
                                                <td style="font-weight:600"><?= $menu['title']; ?></td>
                                                <td style="color:var(--txt-3);font-size:.8rem"><?= $menu['url']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-6 form-section">
                            <h5>Create New Menu</h5>
                            <hr>
                            <form action="<?= base_url('menu-management/create-menu'); ?>" method="post">
                                <div class="mb-3">
                                    <label for="inputMenuCategory2" class="form-label">Menu Category</label>
                                    <select name="inputMenuCategory2" id="inputMenuCategory2" class="form-control <?= ($validation->hasError('inputMenuCategory2')) ? 'is-invalid' : ''; ?>" autofocus value="<?= old('inputMenuCategory2'); ?>">
                                        <option value=""> -- Choose Menu Category --</option>
                                        <?php foreach ($MenuCategories as $menuCategory): ?>
                                            <option value="<?= $menuCategory['id']; ?>"><?= $menuCategory['menu_category']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback"><?= $validation->getError('inputMenuCategory2'); ?></div>
                                </div>
                                <div class="mb-3">
                                    <label for="inputMenuTitle" class="form-label">Menu Title</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('inputMenuTitle')) ? 'is-invalid' : ''; ?>" autofocus value="<?= old('inputMenuTitle'); ?>" id="inputMenuTitle" name="inputMenuTitle">
                                    <div class="invalid-feedback"><?= $validation->getError('inputMenuTitle'); ?></div>
                                </div>
                                <div class="mb-3">
                                    <label for="inputMenuURL" class="form-label">Menu URL</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('inputMenuURL')) ? 'is-invalid' : ''; ?>" autofocus value="<?= old('inputMenuURL'); ?>" id="inputMenuURL" name="inputMenuURL">
                                    <div class="invalid-feedback"><?= $validation->getError('inputMenuURL'); ?></div>
                                </div>
                                <div class="mb-3">
                                    <label for="inputMenuIcon" class="form-label">Menu Icon <a href="https://feathericons.com/" target="_blank" rel="noopener noreferrer">(Lookup References)</a></label>
                                    <input type="text" class="form-control <?= ($validation->hasError('inputMenuIcon')) ? 'is-invalid' : ''; ?>" autofocus value="<?= old('inputMenuIcon'); ?>" id="inputMenuIcon" name="inputMenuIcon">
                                    <div class="invalid-feedback"><?= $validation->getError('inputMenuIcon'); ?></div>
                                </div>
                                <div class="text-end mt-3">
                                    <button class="btn btn-primary">Save Menu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- ── Tab 3: Submenu ── -->
                <div class="tab-pane fade" id="submenu" role="tabpanel" aria-labelledby="submenu-tab">
                    <div class="row g-4">
                        <div class="col-sm-6">
                            <div class="table-wrap">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Menu</th>
                                            <th>Submenu Title</th>
                                            <th>URL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; foreach ($Submenus as $submenu): ?>
                                            <tr>
                                                <td class="row-num"><?= $no++; ?></td>
                                                <td style="color:var(--txt-2)"><?= $submenu['menu_category']; ?></td>
                                                <td style="color:var(--txt-2)"><?= $submenu['menu_title']; ?></td>
                                                <td style="font-weight:600"><?= $submenu['title']; ?></td>
                                                <td style="color:var(--txt-3);font-size:.8rem"><?= $submenu['url']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-6 form-section">
                            <h5>Create New Submenu</h5>
                            <hr>
                            <form action="<?= base_url('menu-management/create-submenu'); ?>" method="post">
                                <div class="mb-3">
                                    <label for="inputMenu" class="form-label">Menu Parent</label>
                                    <select name="inputMenu" id="inputMenu" class="form-control <?= ($validation->hasError('inputMenu')) ? 'is-invalid' : ''; ?>" autofocus value="<?= old('inputMenu'); ?>">
                                        <option value=""> -- Choose Menu Parent --</option>
                                        <?php foreach ($Menus as $menu): ?>
                                            <option value="<?= $menu['id']; ?>"><?= $menu['title']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback"><?= $validation->getError('inputMenu'); ?></div>
                                </div>
                                <div class="mb-3">
                                    <label for="inputSubmenuTitle" class="form-label">Submenu Title</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('inputSubmenuTitle')) ? 'is-invalid' : ''; ?>" autofocus value="<?= old('inputSubmenuTitle'); ?>" id="inputSubmenuTitle" name="inputSubmenuTitle">
                                    <div class="invalid-feedback"><?= $validation->getError('inputSubmenuTitle'); ?></div>
                                </div>
                                <div class="mb-3">
                                    <label for="inputSubmenuURL" class="form-label">Submenu URL</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('inputSubmenuURL')) ? 'is-invalid' : ''; ?>" autofocus value="<?= old('inputSubmenuURL'); ?>" id="inputSubmenuURL" name="inputSubmenuURL">
                                    <div class="invalid-feedback"><?= $validation->getError('inputSubmenuURL'); ?></div>
                                </div>
                                <div class="text-end">
                                    <button class="btn btn-primary">Save Submenu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
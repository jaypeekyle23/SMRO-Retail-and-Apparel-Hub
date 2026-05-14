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
    --r:         12px;
    --shadow:    0 2px 12px rgba(0,0,0,.06);
  }

  body, .content-wrapper, main { background: var(--bg) !important; font-family: 'DM Sans', sans-serif; }

  /* ── Page title ──────────────────────────────── */
  h1 { font-family: 'Sora', sans-serif; font-size: 1.6rem; color: var(--txt); letter-spacing: -.02em; }
  h1 span { color: var(--accent); }

  /* ── Main card ───────────────────────────────── */
  .main-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); overflow: hidden; }
  .main-card .card-header { background: var(--bg); border-bottom: 1px solid var(--border); padding: .9rem 1.5rem; }
  .main-card .card-header h5 { font-family: 'Sora', sans-serif; font-size: .88rem; font-weight: 700; color: var(--txt); margin: 0; }

  /* ── Table ───────────────────────────────────── */
  .table { margin-bottom: 0; }
  .table thead th { font-family: 'Sora', sans-serif; font-size: .67rem; font-weight: 600; letter-spacing: .09em; text-transform: uppercase; color: var(--txt-3); background: var(--surface); border-bottom: 1px solid var(--border) !important; border-top: none; padding: .85rem 1.25rem; white-space: nowrap; }
  .table tbody td { border-bottom: 1px solid var(--border) !important; border-top: none; padding: .75rem 1.25rem; vertical-align: middle; font-size: .875rem; color: var(--txt); }
  .table-hover tbody tr:hover { background: #FBF7F4 !important; }
  .table tbody tr:last-child td { border-bottom: none !important; }

  /* ── Category row ────────────────────────────── */
  tr.category-row td { background: var(--bg) !important; font-family: 'Sora', sans-serif; font-size: .75rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: var(--txt-2); padding: .6rem 1.25rem; border-bottom: 1px solid var(--border) !important; }
  tr.category-row:hover td { background: var(--bg) !important; }

  /* ── Menu / submenu indent ───────────────────── */
  .menu-title    { padding-left: 2rem !important; font-weight: 600; }
  .submenu-title { padding-left: 3.5rem !important; color: var(--txt-2); font-size: .845rem; }
  .url-cell      { color: var(--txt-3); font-size: .8rem; font-family: 'DM Sans', monospace; }

  /* ── Checkbox toggle ─────────────────────────── */
  .form-check { display: flex; align-items: center; gap: .5rem; margin: 0; }
  .form-check-input { width: 16px; height: 16px; border: 1.5px solid var(--border); border-radius: 4px; cursor: pointer; flex-shrink: 0; accent-color: var(--accent); }
  .form-check-input:checked { background-color: var(--accent); border-color: var(--accent); }
  .form-check-input:focus { box-shadow: 0 0 0 3px rgba(201,106,46,.15); outline: none; }
  .access-label { font-size: .75rem; font-weight: 500; }
  .access-label.granted { color: var(--ok); }
  .access-label.denied  { color: var(--txt-3); }
</style>

<div class="container px-0">
    <h1 class="h3 mb-4"><span><?= $role['role_name'] ?? 'Role'; ?></span> Access Menu</h1>

    <div class="main-card">
        <div class="card-header">
            <h5 class="card-title mb-0">Role Access Menu List</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover my-0">
                <thead>
                    <tr>
                        <th>Menu</th>
                        <th>URL</th>
                        <th>Access</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($MenuCategories as $menuCategory) : ?>
                        <tr class="category-row">
                            <td colspan="2"><?= $menuCategory['menu_category'] ?? 'Unknown Category'; ?></td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input menu_category_permission" type="checkbox"
                                        <?= check_menuCategory_access($role['id'], $menuCategory['id']) ?>
                                        data-role="<?= $role['id'] ?>"
                                        data-menucategory="<?= $menuCategory['id'] ?>">
                                    <label class="form-check-label access-label <?= (check_menuCategory_access($role['id'], $menuCategory['id']) == 'checked') ? 'granted' : 'denied' ?>">
                                        <?= (check_menuCategory_access($role['id'], $menuCategory['id']) == 'checked') ? 'Access Granted' : 'Access Not Granted' ?>
                                    </label>
                                </div>
                            </td>
                        </tr>

                        <?php foreach ($Menus as $menu) : if ($menu['menu_category_id'] == $menuCategory['id']) : ?>
                            <tr>
                                <td class="menu-title"><?= $menu['title'] ?? 'Unknown Menu'; ?></td>
                                <td class="d-none d-md-table-cell url-cell">/<?= $menu['url'] ?? '#'; ?></td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input menu_permission" type="checkbox"
                                            <?= check_menu_access($role['id'], $menu['menu_id']) ?>
                                            data-role="<?= $role['id'] ?>"
                                            data-menu="<?= $menu['menu_id'] ?>">
                                        <label class="form-check-label access-label <?= (check_menu_access($role['id'], $menu['id']) == 'checked') ? 'granted' : 'denied' ?>">
                                            <?= (check_menu_access($role['id'], $menu['id']) == 'checked') ? 'Access Granted' : 'Access Not Granted' ?>
                                        </label>
                                    </div>
                                </td>
                            </tr>

                            <?php foreach ($Submenus as $subMenu) : if ($menu['id'] == $subMenu['menu_id']) : ?>
                                <tr>
                                    <td class="submenu-title"><?= $subMenu['submenu_title'] ?? 'Unknown Submenu'; ?></td>
                                    <td class="d-none d-md-table-cell url-cell">/<?= $subMenu['submenu_url'] ?? '#'; ?></td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input submenu_permission" type="checkbox"
                                                <?= check_submenu_access($role['id'], $subMenu['submenu_id']) ?>
                                                data-role="<?= $role['id'] ?>"
                                                data-submenu="<?= $subMenu['submenu_id'] ?>">
                                            <label class="form-check-label access-label <?= (check_submenu_access($role['id'], $subMenu['submenu_id']) == 'checked') ? 'granted' : 'denied' ?>">
                                                <?= (check_submenu_access($role['id'], $subMenu['submenu_id']) == 'checked') ? 'Access Granted' : 'Access Not Granted' ?>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; endforeach; ?>

                        <?php endif; endforeach; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('javascript'); ?>
<script>
    $('.menu_category_permission').on('click', function() {
        const menuCategoryId = $(this).data('menucategory');
        const roleId = $(this).data('role');
        $.ajax({
            url: "<?= base_url('users/change-menu-category-permission'); ?>",
            type: 'post',
            data: { menuCategoryID: menuCategoryId, roleID: roleId },
            success: function() { location.reload(); }
        });
    });
    $('.menu_permission').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');
        $.ajax({
            url: "<?= base_url('users/change-menu-permission'); ?>",
            type: 'post',
            data: { menuID: menuId, roleID: roleId },
            success: function() { location.reload(); }
        });
    });
    $('.submenu_permission').on('click', function() {
        const submenuID = $(this).data('submenu');
        const roleId = $(this).data('role');
        $.ajax({
            url: "<?= base_url('users/change-submenu-permission'); ?>",
            type: 'post',
            data: { submenuID: submenuID, roleID: roleId },
            success: function() { location.reload(); }
        });
    });
</script>
<?= $this->endSection(); ?>
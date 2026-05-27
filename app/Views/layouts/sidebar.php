<style>
@import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@1,300;1,400&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap');

:root {
  --sb-bg:          #141210;
  --sb-surface:     #181512;
  --sb-hover:       #1C1815;
  --sb-active:      #221A15;
  --sb-border:      rgba(255, 255, 255, 0.055);
  --sb-text-mute:   #3D3028;
  --sb-text-dim:    #6B5E58;
  --sb-text:        #A89890;
  --sb-text-bright: #EDE6DF;
  --accent:         #C0490A;
  --accent-dim:     rgba(192, 73, 10, 0.18);
  --font-cg:        'Cormorant Garamond', serif;
  --font-b:         'Plus Jakarta Sans', sans-serif;
  --ease:           cubic-bezier(0.16, 1, 0.3, 1);
}

#sidebar.sidebar,
#sidebar {
  background: var(--sb-bg) !important;
  border-right: 1px solid var(--sb-border) !important;
  font-family: var(--font-b) !important;
}

#sidebar .sidebar-content {
  background: var(--sb-bg) !important;
}

#sidebar .sidebar-brand {
  display: flex !important;
  flex-direction: column !important;
  align-items: flex-start !important;
  padding: 24px 20px 20px !important;
  border-bottom: 1px solid var(--sb-border) !important;
  text-decoration: none !important;
  background: var(--sb-bg) !important;
}

#sidebar .sidebar-brand > .align-middle {
  display: flex !important;
  flex-direction: column !important;
  align-items: flex-start !important;
  line-height: 1 !important;
  width: 100% !important;
}

#sidebar .sidebar-brand .align-middle i {
  font-family: var(--font-cg) !important;
  font-style: italic !important;
  font-weight: 300 !important;
  font-size: 28px !important;
  color: var(--sb-text-bright) !important;
  letter-spacing: 0.04em !important;
  display: block !important;
  line-height: 1 !important;
  position: relative !important;
}

#sidebar .sidebar-brand .align-middle i::before {
  content: none !important;
}

#sidebar .sidebar-brand .align-middle i::after {
  content: '' !important;
  display: block !important;
  width: 72px !important;
  height: 1px !important;
  background: linear-gradient(90deg, var(--accent) 0%, transparent 100%) !important;
  margin-top: 6px !important;
}

#sidebar .sidebar-header {
  font-size: 9.5px !important;
  font-weight: 700 !important;
  color: var(--sb-text-mute) !important;
  text-transform: uppercase !important;
  letter-spacing: 1.4px !important;
  padding: 20px 20px 6px !important;
  background: transparent !important;
  font-family: var(--font-b) !important;
}

#sidebar .sidebar-item > .sidebar-link {
  display: flex !important;
  align-items: center !important;
  gap: 11px !important;
  padding: 9px 20px !important;
  color: var(--sb-text-dim) !important;
  font-size: 13px !important;
  font-weight: 500 !important;
  font-family: var(--font-b) !important;
  text-decoration: none !important;
  border-left: 2px solid transparent !important;
  border-radius: 0 !important;
  background: transparent !important;
  transition: color 0.15s var(--ease), background 0.15s var(--ease), border-color 0.15s var(--ease) !important;
  letter-spacing: 0.1px !important;
}

#sidebar .sidebar-item > .sidebar-link:hover {
  color: var(--sb-text) !important;
  background: var(--sb-hover) !important;
  border-left-color: rgba(192, 73, 10, 0.3) !important;
}

#sidebar .sidebar-item.active > .sidebar-link {
  color: var(--sb-text-bright) !important;
  background: var(--sb-active) !important;
  border-left-color: var(--accent) !important;
}

#sidebar .sidebar-link svg {
  width: 14px !important;
  height: 14px !important;
  flex-shrink: 0 !important;
  stroke: currentColor !important;
  stroke-width: 1.75 !important;
  opacity: 0.75 !important;
  transition: opacity 0.15s ease !important;
}

#sidebar .sidebar-item.active > .sidebar-link svg,
#sidebar .sidebar-item > .sidebar-link:hover svg {
  opacity: 1 !important;
}

#sidebar .simplebar-scrollbar::before {
  background: rgba(255, 255, 255, 0.07) !important;
  border-radius: 2px !important;
}

#sidebar .sidebar-footer {
  border-top: 1px solid var(--sb-border) !important;
  background: var(--sb-bg) !important;
  padding: 12px 0 !important;
}

#sidebar .sidebar-footer a,
#sidebar .sidebar-footer span {
  color: var(--sb-text-dim) !important;
  font-family: var(--font-b) !important;
  font-size: 12px !important;
}
</style>

<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="<?= base_url(); ?>">
            <span class="align-middle"><i>Thread</i></span>
        </a>
        <ul class="sidebar-nav">

            <?php
            $role = session()->get('role_id');

            // Always show Dashboard (accessible to all roles)
            ?>
            <li class="sidebar-header">Main</li>
            <li class="sidebar-item <?= url_is('dashboard*') ? 'active' : ''; ?>">
                <a class="sidebar-link" href="<?= base_url('dashboard'); ?>">
                    <i class="align-middle" data-feather="sliders"></i>
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <?php
            // Icon map: menu url => feather icon name
            $iconMap = [
                'products'        => 'box',
                'inventory'       => 'clipboard',
                'suppliers'       => 'truck',
                'purchase-orders' => 'shopping-bag',
                'pos'             => 'shopping-cart',
                'sales'           => 'file-text',
                'customers'       => 'users',
                'returns'         => 'rotate-ccw',
                'users'           => 'settings',
                'menu-management' => 'settings',
            ];

            // Loop through menu categories the role has access to
            if (!empty($MenuCategory)):
                foreach ($MenuCategory as $category):
                    // Skip 'Main' — Dashboard is already hardcoded above
                    if (strtolower($category['menu_category']) === 'main') continue;

                    $menus = getMenu($category['menuCategoryID'], $role);
                    if (empty($menus)) continue;
            ?>
            <li class="sidebar-header"><?= esc($category['menu_category']); ?></li>

            <?php foreach ($menus as $menu): ?>
            <li class="sidebar-item <?= url_is($menu['url'] . '*') ? 'active' : ''; ?>">
                <a class="sidebar-link" href="<?= base_url($menu['url']); ?>">
                    <i class="align-middle" data-feather="<?= esc($iconMap[$menu['url']] ?? 'circle'); ?>"></i>
                    <span class="align-middle"><?= esc($menu['title']); ?></span>
                </a>
            </li>
            <?php endforeach; ?>

            <?php
                endforeach;
            endif;
            ?>

            <?php // My Profile is always visible to every logged-in user ?>
            <li class="sidebar-header">Account</li>
            <li class="sidebar-item <?= url_is('profile*') ? 'active' : ''; ?>">
                <a class="sidebar-link" href="<?= base_url('profile'); ?>">
                    <i class="align-middle" data-feather="user"></i>
                    <span class="align-middle">My Profile</span>
                </a>
            </li>

        </ul>
    </div>
</nav>
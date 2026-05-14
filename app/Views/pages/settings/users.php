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
    --info:      #2471A3;
    --info-bg:   #EBF5FB;
    --danger:    #C0392B;
    --danger-bg: #FDECEA;
    --r:         12px;
    --shadow:    0 2px 12px rgba(0,0,0,.06);
  }

  body, .content-wrapper, main { background: var(--bg) !important; font-family: 'DM Sans', sans-serif; }

  /* ── Page title ──────────────────────────────── */
  h1 { font-family: 'Sora', sans-serif; font-size: 1.6rem; color: var(--txt); letter-spacing: -.02em; }

  /* ── Cards ───────────────────────────────────── */
  .main-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); box-shadow: var(--shadow); overflow: hidden; display: flex; flex-direction: column; height: 100%; }
  .main-card .card-header { background: var(--bg); border-bottom: 1px solid var(--border); padding: .9rem 1.25rem; display: flex; align-items: center; justify-content: space-between; }
  .main-card .card-header h5 { font-family: 'Sora', sans-serif; font-size: .88rem; font-weight: 700; color: var(--txt); margin: 0; }
  .main-card .card-body { padding: 0; flex: 1; }

  /* ── Table ───────────────────────────────────── */
  .table { margin-bottom: 0; }
  .table thead th { font-family: 'Sora', sans-serif; font-size: .67rem; font-weight: 600; letter-spacing: .09em; text-transform: uppercase; color: var(--txt-3); background: var(--surface); border-bottom: 1px solid var(--border) !important; border-top: none; padding: .85rem 1.25rem; white-space: nowrap; }
  .table tbody td { border-bottom: 1px solid var(--border) !important; border-top: none; padding: .85rem 1.25rem; vertical-align: middle; font-size: .875rem; color: var(--txt); }
  .table-hover tbody tr:hover { background: #FBF7F4 !important; }
  .table tbody tr:last-child td { border-bottom: none !important; }

  /* ── Badges ──────────────────────────────────── */
  .badge.bg-success { background: var(--ok-bg) !important; color: var(--ok) !important; font-size: .72rem; font-weight: 600; border-radius: 6px; padding: .3em .7em; }
  .badge.bg-primary { background: var(--accent-bg) !important; color: var(--accent) !important; font-size: .72rem; font-weight: 600; border-radius: 6px; padding: .3em .7em; text-decoration: none; }

  /* ── Buttons ─────────────────────────────────── */
  .btn-primary      { background: var(--accent) !important; border-color: var(--accent) !important; font-family: 'Sora', sans-serif; font-size: .78rem; font-weight: 600; border-radius: 7px; padding: .35rem .9rem; color: #fff !important; }
  .btn-primary:hover { background: #b35a23 !important; }
  .btn-sm.btn-info  { background: var(--info-bg) !important; border: 1px solid #C8E3F0 !important; color: var(--info) !important; font-size: .75rem; font-weight: 500; border-radius: 6px; padding: .28rem .7rem; }
  .btn-sm.btn-info:hover { background: #D4EAF7 !important; }
  .btn-sm.btn-danger { background: var(--danger-bg) !important; border: 1px solid #F0C4C0 !important; color: var(--danger) !important; font-size: .75rem; font-weight: 500; border-radius: 6px; padding: .28rem .7rem; }
  .btn-sm.btn-danger:hover { background: #F5D0CC !important; }
  .btn-sm.btn-outline-danger { background: var(--danger-bg) !important; border: 1px solid #F0C4C0 !important; color: var(--danger) !important; font-size: .75rem; font-weight: 500; border-radius: 6px; padding: .28rem .7rem; }
  .btn-sm.btn-outline-danger:hover { background: #F5D0CC !important; }

  /* ── Date cell ───────────────────────────────── */
  .date-cell { color: var(--txt-3); font-size: .8rem; white-space: nowrap; }
</style>

<h1 class="h3 mb-4"><strong>Users</strong></h1>

<div class="row g-4">
    <!-- ── Users List ── -->
    <div class="col-12 col-lg-8 col-xxl-8 d-flex">
        <div class="main-card flex-fill">
            <div class="card-header">
                <h5 class="card-title mb-0">Users List</h5>
                <button class="btn btn-primary btn-sm btnAdd" data-bs-toggle="modal" data-bs-target="#formUserModal">+ Create New User</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th class="d-none d-xl-table-cell">Username</th>
                                <th>Role</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Users as $users) : ?>
                                <tr>
                                    <td style="font-weight:600"><?= $users['fullname']; ?></td>
                                    <td class="d-none d-md-table-cell" style="color:var(--txt-2)"><?= $users['username']; ?></td>
                                    <td><span class="badge bg-success"><?= $users['role_name'] ?? 'User'; ?></span></td>
                                    <td class="date-cell"><?= $users['created_at']; ?></td>
                                    <td>
                                        <button class="btn btn-info btn-sm btnEdit"
                                            data-bs-toggle="modal" data-bs-target="#formUserModal"
                                            data-id="<?= $users['userID']; ?>"
                                            data-fullname="<?= $users['fullname']; ?>"
                                            data-username="<?= $users['username']; ?>"
                                            data-role="<?= $users['role'] ?? ''; ?>">Update</button>

                                        <?php if ($users['username'] != session()->get('username')) : ?>
                                            <form action="<?= base_url('users/delete-user/' . $users['userID']); ?>" method="post" class="d-inline">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure delete <?= $users['username']; ?> ?')">Delete</button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ── User Roles ── -->
    <div class="col-12 col-lg-4 col-xxl-4 d-flex">
        <div class="main-card flex-fill">
            <div class="card-header">
                <h5 class="card-title mb-0">User Roles</h5>
                <button class="btn btn-primary btn-sm btnAddRole" data-bs-toggle="modal" data-bs-target="#formRoleModal">+ Create New Role</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th colspan="2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($UserRole as $userRole) : ?>
                                <tr>
                                    <td style="font-weight:600"><?= $userRole['role_name'] ?? 'Role'; ?></td>
                                    <td>
                                        <a href="<?= base_url('users/role-access?role=' . $userRole['id']); ?>">
                                            <span class="badge bg-primary">Access Menu</span>
                                        </a>
                                    </td>
                                    <td>
                                        <button class="btn btn-info btn-sm btnEditRole"
                                            data-bs-toggle="modal" data-bs-target="#formRoleModal"
                                            data-id="<?= $userRole['id']; ?>"
                                            data-role="<?= $userRole['role_name'] ?? ''; ?>">Update</button>
                                        <form action="<?= base_url('users/delete-role/' . $userRole['id']); ?>" method="post" class="d-inline">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('widgets/users/user_form_modal'); ?>
<?= $this->include('widgets/users/role_form_modal'); ?>
<?= $this->endSection(); ?>

<?= $this->section('javascript'); ?>
<script>
    $(document).ready(function() {
        $(".btnAdd").click(function() {
            $('#formUserModalLabel').html('Create New User');
            $('.modal-footer button[type=submit]').html('Save Role');
            $('#userID').val('');
            $('#inputFullname').val('');
            $('#inputUsername').val('');
            $('#inputRole').val('');
        });
        $(".btnEdit").click(function() {
            const userId = $(this).data('id');
            const fullname = $(this).data('fullname');
            const username = $(this).data('username');
            const role = $(this).data('role');
            $('#modalTitle').html('form Data User');
            $('.modal-footer button[type=submit]').html('Update User');
            $('.modal-content form').attr('action', '<?= base_url('users/update-user') ?>');
            $('#userID').val(userId);
            $('#inputFullname').val(fullname);
            $('#inputUsername').val(username);
            $('#inputUsername').attr('readonly', true);
            $('#inputPassword').attr('required', false);
            $('#inputRole').val(role);
        });

        $(".btnAddRole").click(function() {
            $('#formUserModalLabel').html('Create New Role');
            $('.modal-content form').attr('action', '<?= base_url('users/create-role') ?>');
            $('.modal-footer button[type=submit]').html('Save Role');
            $('#roleID').val('');
            $('#inputRoleName').val('');
        });
        $(".btnEditRole").click(function() {
            const roleID = $(this).data('id');
            const inputRoleName = $(this).data('role');
            $('#modalTitle').html('Update Data Role');
            $('.modal-footer button[type=submit]').html('Update role');
            $('.modal-content form').attr('action', '<?= base_url('users/update-role') ?>');
            $('#roleID').val(roleID);
            $('#inputRoleName').val(inputRoleName);
        });
    });
</script>
<?= $this->endSection(); ?>
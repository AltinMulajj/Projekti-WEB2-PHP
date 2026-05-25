<?php

require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../config/session-config.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../classes/User.php';

requireRole('admin');

if(isset($_GET['delete'])){

    User::delete((int)$_GET['delete']);

    header("Location: admin-users.php");
    exit;
}

$users = User::all();

require_once __DIR__ . '/../includes/header.php';

?>

<main>
    <div class="page-wrap" style="margin-top:50px;margin-bottom:50px;">

        <div class="page-hero">
            <h1>Manage Users</h1>
            <p>Admin panel për menaxhimin e user-ave</p>
        </div>

        <div class="page-card" style="overflow-x:auto;">

            <table style="width:100%;border-collapse:collapse;margin-top:20px;">

                <thead>
                    <tr style="background:#f6d6df;">
                        <th style="padding:15px;text-align:left;">ID</th>
                        <th style="padding:15px;text-align:left;">Name</th>
                        <th style="padding:15px;text-align:left;">Email</th>
                        <th style="padding:15px;text-align:left;">Role</th>
                        <th style="padding:15px;text-align:left;">Action</th>
                    </tr>
                </thead>

                <tbody>

                <?php foreach($users as $user): ?>

                    <tr style="border-bottom:1px solid #eee;">

                        <td style="padding:15px;">
                            <?= htmlspecialchars($user['id']) ?>
                        </td>

                        <td style="padding:15px;">
                            <?= htmlspecialchars($user['name']) ?>
                        </td>

                        <td style="padding:15px;">
                            <?= htmlspecialchars($user['email']) ?>
                        </td>

                        <td style="padding:15px;">
                            <span style="background:black;color:white;padding:5px 10px;border-radius:8px;font-size:12px;">
                                <?= htmlspecialchars($user['role']) ?>
                            </span>
                        </td>

                        <td style="padding:15px;">

                            <a href="?delete=<?= $user['id'] ?>"
                               class="page-btn"
                               style="background:#ff4d4d;"
                               onclick="return confirm('Delete user?')">

                                Delete

                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>

        <div style="margin-top:25px;">

            <a href="<?php echo BASE_URL; ?>pages/admin-dashboard.php"
               class="page-btn">

                Back to Dashboard

            </a>

        </div>

    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
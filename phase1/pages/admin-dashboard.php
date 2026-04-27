<?php
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../config/session-config.php';
require_once __DIR__ . '/../includes/auth.php';

requireRole('admin');

require_once __DIR__ . '/../data/products-data.php';
require_once __DIR__ . '/../data/user-data.php';
require_once __DIR__ . '/../includes/header.php';
?>
<main>
    <div class="page-wrap">
        <div class="page-hero">
            <h2>Admin Dashboard</h2>
            <p>Welcome, <?php echo htmlspecialchars($_SESSION['user']['name']); ?></p>
        </div>

        <div class="page-grid">
            <div class="page-card">
                <h3>Total Products</h3>
                <p style="font-size:32px;font-weight:bold;"><?php echo count($products); ?></p>
            </div>
            <div class="page-card">
                <h3>Total Users</h3>
                <p style="font-size:32px;font-weight:bold;"><?php echo count($users); ?></p>
            </div>
            <div class="page-card">
                <h3>On Sale</h3>
                <p style="font-size:32px;font-weight:bold;">
                    <?php echo count(array_filter($products, fn($p) => $p['on_sale'])); ?>
                </p>
            </div>
        </div>

        <div class="page-card" style="margin-top:20px;">
            <h3>All Products</h3>
            <table style="width:100%;border-collapse:collapse;margin-top:15px;">
                <thead>
                    <tr style="background:#f6d6df;">
                        <th style="padding:10px;text-align:left;">Name</th>
                        <th style="padding:10px;text-align:left;">Category</th>
                        <th style="padding:10px;text-align:left;">Price</th>
                        <th style="padding:10px;text-align:left;">On Sale</th>
                        <th style="padding:10px;text-align:left;">Featured</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $p): ?>
                    <tr style="border-bottom:1px solid #eee;">
                        <td style="padding:10px;"><?php echo $p['name']; ?></td>
                        <td style="padding:10px;"><?php echo $p['category']; ?></td>
                        <td style="padding:10px;"><?php echo number_format($p['price'],2); ?>€</td>
                        <td style="padding:10px;"><?php echo $p['on_sale'] ? '✅' : '—'; ?></td>
                        <td style="padding:10px;"><?php echo $p['featured'] ? '⭐' : '—'; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Users Table -->
        <div class="page-card" style="margin-top:20px;">
            <h3>All Users</h3>
            <table style="width:100%;border-collapse:collapse;margin-top:15px;">
                <thead>
                    <tr style="background:#f6d6df;">
                        <th style="padding:10px;text-align:left;">Name</th>
                        <th style="padding:10px;text-align:left;">Email</th>
                        <th style="padding:10px;text-align:left;">Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $u): ?>
                    <tr style="border-bottom:1px solid #eee;">
                        <td style="padding:10px;"><?php echo htmlspecialchars($u['name']); ?></td>
                        <td style="padding:10px;"><?php echo htmlspecialchars($u['email']); ?></td>
                        <td style="padding:10px;">
                            <span style="background:#000;color:#fff;padding:2px 8px;border-radius:5px;font-size:12px;">
                                <?php echo htmlspecialchars($u['role']); ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
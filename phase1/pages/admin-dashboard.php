<?php
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../config/session-config.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../classes/Product.php';

requireRole('admin');

require_once __DIR__ . '/../includes/header.php';

$message = '';
$messageType = 'success';
$search = '';
$category = 'all';
$sort = '';
$products = [];
$editProduct = null;

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action === 'create') {
            if (Product::create($_POST)) {
                $message = 'Produkti u shtua me sukses.';
            } else {
                $message = 'Shtimi i produktit dështoi.';
                $messageType = 'error';
            }
        }

        if ($action === 'update') {
            $id = trim((string)($_POST['id'] ?? ''));
            if ($id !== '' && Product::update($id, $_POST)) {
                $message = 'Produkti u përditësua me sukses.';
            } else {
                $message = 'Përditësimi i produktit dështoi.';
                $messageType = 'error';
            }
        }

        if ($action === 'delete') {
            $id = trim((string)($_POST['id'] ?? ''));
            if ($id !== '' && Product::delete($id)) {
                $message = 'Produkti u fshi me sukses.';
            } else {
                $message = 'Fshirja e produktit dështoi.';
                $messageType = 'error';
            }
        }
    }

    if (isset($_GET['delete'])) {
        $id = trim((string)$_GET['delete']);
        if ($id !== '' && Product::delete($id)) {
            $message = 'Produkti u fshi me sukses.';
        } else {
            $message = 'Fshirja e produktit dështoi.';
            $messageType = 'error';
        }
    }

    $search = trim((string)($_GET['q'] ?? ''));
    $category = trim((string)($_GET['category'] ?? 'all'));
    $sort = trim((string)($_GET['sort'] ?? ''));

    $products = Product::all([
        'q' => $search,
        'category' => $category,
        'sort' => $sort
    ]);

    $editProduct = null;
    if (!empty($_GET['edit'])) {
        $editProduct = Product::find((string)$_GET['edit']);
    }

} catch (Throwable $e) {
    $message = 'Gabim: ' . $e->getMessage();
    $messageType = 'error';
    $products = [];
    $editProduct = null;
}


?>
<main>
    <div class="page-wrap">
        <div class="page-hero">
            <h2>Admin Dashboard</h2>
            <p>Welcome, <?php echo htmlspecialchars($_SESSION['user']['name']); ?></p>
        </div>

        <?php if ($message !== ''): ?>
            <div style="padding:12px 16px;margin-bottom:20px;border-radius:8px;background:<?php echo $messageType === 'success' ? '#e8fff0' : '#ffecec'; ?>;border:1px solid <?php echo $messageType === 'success' ? '#7fd39b' : '#f1a3a3'; ?>;">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <div class="page-grid">
            <div class="page-card">
                <h3>Total Products</h3>
                <p style="font-size:32px;font-weight:bold;"><?php echo count($products); ?></p>
            </div>
            <div class="page-card">
                <h3>Featured</h3>
                <p style="font-size:32px;font-weight:bold;">
                    <?php echo count(array_filter($products, fn($p) => !empty($p['featured']))); ?>
                </p>
            </div>
            <div class="page-card">
                <h3>On Sale</h3>
                <p style="font-size:32px;font-weight:bold;">
                    <?php echo count(array_filter($products, fn($p) => !empty($p['on_sale']))); ?>
                </p>
            </div>
        </div>

        <div class="page-card" style="margin-top:20px;">
            <h3><?php echo $editProduct ? 'Edit Product' : 'Add New Product'; ?></h3>

            <form method="POST" style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:12px;margin-top:15px;" enctype="multipart/form-data">
                <input type="hidden" name="action" value="<?php echo $editProduct ? 'update' : 'create'; ?>">

                <div>
                    <label style="display:block;margin-bottom:6px;">Product ID</label>
                    <input
                        type="text"
                        name="id"
                        value="<?php echo htmlspecialchars($editProduct['id'] ?? ''); ?>"
                        <?php echo $editProduct ? 'readonly' : ''; ?>
                        style="width:100%;padding:10px;"
                        placeholder="p001"
                    >
                </div>

                <div>
                    <label style="display:block;margin-bottom:6px;">Name</label>
                    <input
                        type="text"
                        name="name"
                        value="<?php echo htmlspecialchars($editProduct['name'] ?? ''); ?>"
                        required
                        style="width:100%;padding:10px;"
                    >
                </div>

                <div>
                    <label style="display:block;margin-bottom:6px;">Price</label>
                    <input
                        type="number"
                        step="0.01"
                        min="0"
                        name="price"
                        value="<?php echo htmlspecialchars((string)($editProduct['price'] ?? '')); ?>"
                        required
                        style="width:100%;padding:10px;"
                    >
                </div>

                <div>
                    <label style="display:block;margin-bottom:6px;">Category</label>
                    <input
                        type="text"
                        name="category"
                        value="<?php echo htmlspecialchars($editProduct['category'] ?? ''); ?>"
                        required
                        style="width:100%;padding:10px;"
                        placeholder="makeup, skincare, hair..."
                    >
                </div>

                <div>
                    <label style="display:block;margin-bottom:6px;">Product Image</label>
                    <input
    type="file"
    name="image"
    accept="image/*"
    <?php echo isset($editProduct) ? '' : 'required'; ?>
    style="width:100%;padding:10px;"
>
                </div>

                <div style="grid-column:1 / -1;">
                    <label style="display:block;margin-bottom:6px;">Description</label>
                    <textarea
                        name="description"
                        rows="4"
                        required
                        style="width:100%;padding:10px;"
                    ><?php echo htmlspecialchars($editProduct['description'] ?? ''); ?></textarea>
                </div>

                <div>
                    <label>
                        <input type="checkbox" name="featured" value="1" <?php echo !empty($editProduct['featured']) ? 'checked' : ''; ?>>
                        Featured
                    </label>
                </div>

                <div>
                    <label>
                        <input type="checkbox" name="on_sale" value="1" <?php echo !empty($editProduct['on_sale']) ? 'checked' : ''; ?>>
                        On Sale
                    </label>
                </div>

                <div style="grid-column:1 / -1;display:flex;gap:10px;align-items:center;">
                    <button type="submit" class="page-btn"><?php echo $editProduct ? 'Update Product' : 'Save Product'; ?></button>
                    <?php if ($editProduct): ?>
                        <a href="<?php echo BASE_URL; ?>pages/admin-dashboard.php" class="page-btn">Cancel</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
        <div style="margin:20px 0;text-align:right;">
    <a href="<?php echo BASE_URL; ?>pages/admin-users.php"
       class="page-btn">

        Manage Users
    </a>
</div>

        <div class="page-card" style="margin-top:20px;">
            <h3>Search Products</h3>
            <form method="GET" style="display:flex;gap:10px;flex-wrap:wrap;margin-top:15px;">
                <input type="text" name="q" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search..." style="padding:10px;min-width:220px;">
                <select name="category" style="padding:10px;">
                    <option value="all" <?php echo $category === 'all' ? 'selected' : ''; ?>>All</option>
                    <option value="makeup" <?php echo $category === 'makeup' ? 'selected' : ''; ?>>Makeup</option>
                    <option value="skincare" <?php echo $category === 'skincare' ? 'selected' : ''; ?>>Skincare</option>
                    <option value="hair" <?php echo $category === 'hair' ? 'selected' : ''; ?>>Hair</option>
                    <option value="tools" <?php echo $category === 'tools' ? 'selected' : ''; ?>>Tools</option>
                </select>
                <select name="sort" style="padding:10px;">
                    <option value="" <?php echo $sort === '' ? 'selected' : ''; ?>>Default</option>
                    <option value="price_asc" <?php echo $sort === 'price_asc' ? 'selected' : ''; ?>>Price ↑</option>
                    <option value="price_desc" <?php echo $sort === 'price_desc' ? 'selected' : ''; ?>>Price ↓</option>
                    <option value="name_asc" <?php echo $sort === 'name_asc' ? 'selected' : ''; ?>>Name A-Z</option>
                </select>
                <button type="submit" class="page-btn">Filter</button>
                <a href="<?php echo BASE_URL; ?>pages/admin-dashboard.php" class="page-btn">Reset</a>
            </form>
        </div>

        <div class="page-card" style="margin-top:20px;overflow-x:auto;">
            <h3>All Products</h3>
            <table style="width:100%;border-collapse:collapse;margin-top:15px;min-width:900px;">
                <thead>
                    <tr style="background:#f6d6df;">
                        <th style="padding:10px;text-align:left;">Name</th>
                        <th style="padding:10px;text-align:left;">Category</th>
                        <th style="padding:10px;text-align:left;">Price</th>
                        <th style="padding:10px;text-align:left;">Featured</th>
                        <th style="padding:10px;text-align:left;">On Sale</th>
                        <th style="padding:10px;text-align:left;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $p): ?>
                        <tr id="product-row-<?php echo htmlspecialchars($p['id']); ?>" style="border-bottom:1px solid #eee;">
    
                            <td style="padding:10px;"><?php echo htmlspecialchars($p['name']); ?></td>
                            <td style="padding:10px;"><?php echo htmlspecialchars($p['category']); ?></td>
                            <td style="padding:10px;"><?php echo number_format((float)$p['price'], 2); ?>€</td>
                            <td style="padding:10px;"><?php echo !empty($p['featured']) ? 'Yes' : 'No'; ?></td>
                            <td style="padding:10px;"><?php echo !empty($p['on_sale']) ? 'Yes' : 'No'; ?></td>
                            <td style="padding:10px;">
                                <a href="<?php echo BASE_URL; ?>pages/admin-dashboard.php?edit=<?php echo urlencode($p['id']); ?>" class="page-btn" style="margin-right:8px;">Edit</a>
                                <a href="#" class="page-btn ajax-delete-btn" data-id="<?php echo htmlspecialchars($p['id']); ?>">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($products)): ?>
                        <tr>
                            <td colspan="7" style="padding:20px;text-align:center;">Nuk u gjet asnjë produkt.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<script src="../assets/js/ajax.js"></script>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
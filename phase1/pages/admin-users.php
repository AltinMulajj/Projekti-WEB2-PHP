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
<div class="page-wrap">

<h1>Manage Users</h1>

<table border="1" cellpadding="10" cellspacing="0">

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Role</th>
<th>Action</th>
</tr>

<?php foreach($users as $user): ?>

<tr>

<td>
<?= htmlspecialchars($user['id']) ?>
</td>

<td>
<?= htmlspecialchars($user['name']) ?>
</td>

<td>
<?= htmlspecialchars($user['email']) ?>
</td>

<td>
<?= htmlspecialchars($user['role']) ?>
</td>

<td>

<a href="?delete=<?= $user['id'] ?>"
onclick="return confirm('Delete user?')">

Delete

</a>

</td>

</tr>

<?php endforeach; ?>

</table>

</div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
<?php
session_start();
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$emailPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
$passwordPattern = "/^(?=.*[A-Za-z])(?=.*\d).{6,}$/";

if(!preg_match($emailPattern,$_POST["email"])){
$message="Email nuk është valid.";
}

elseif(!preg_match($passwordPattern,$_POST["password"])){
$message="Password duhet min 6 karaktere dhe 1 numër.";
}

else{
    $newUser = [
        "name" => $_POST["name"],
        "email" => $_POST["email"],
        "password" => $_POST["password"],
        "role" => "user",
        "favorite_category" => $_POST["favorite_category"]
    ];

    setcookie(
        "registered_user",
        json_encode($newUser),
        time() + 604800,
        "/"
    );
    setcookie(
"favorite_category",
$_POST["favorite_category"],
time()+604800,
"/"
);

    header("Location: login.php");
    exit;
}
}
?>

<?php require_once __DIR__ . "/../includes/header.php"; ?>

<main class="signup-wrapper">
    <div class="signup-card">
        <h2>Create Account</h2>
        <p>Krijo llogari të re</p>

        <?php if ($message != ""): ?>
            <p style="color:green;"><?php echo $message; ?></p>
        <?php endif; ?>

        <form class="signup-form" method="POST">
            <div class="input-group">
                <label>Full Name</label>
                <input type="text" name="name" required>
            </div>

            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
<div class="input-group">
<label>Favorite Category</label>

<select name="favorite_category">
<option value="Makeup">Makeup</option>
<option value="Skincare">Skincare</option>
<option value="Haircare">Haircare</option>
</select>

</div>
            <button class="signup-btn" type="submit">Sign Up</button>
        </form>

        <div class="signup-footer">
            <p>Already have account?</p>
            <a href="login.php">Login</a>
        </div>
    </div>
</main>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>
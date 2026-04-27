<?php
session_start();

require_once __DIR__ . "/../data/user-data.php";

$users = $users ?? [];


if(isset($_COOKIE["registered_user"])){

$cookieUser = json_decode(
$_COOKIE["registered_user"],
true
);

if($cookieUser){
$users[] = $cookieUser;
}

}

$message = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){

$email=$_POST["email"];
$password=$_POST["password"];

foreach($users as $user){

if(
$user["email"]==$email &&
$user["password"]==$password
){

$_SESSION["user"]=$user;
$_SESSION["is_logged_in"]=true;
$_SESSION["role"]=$user["role"];
$favoriteCategory=$_POST["favorite_category"];

setcookie(
"favorite_category",
$favoriteCategory,
time()+604800,
"/"
);

header("Location: ../index.php");
exit;

}

}

$message="Email ose password gabim!";
}
?>

<?php require_once __DIR__ . "/../includes/header.php"; ?>

<main class="signin-wrapper">

<div class="signin-card">

<h2>Login</h2>
<p>Kyçu në llogarinë tënde</p>

<?php if($message!=""): ?>
<p style="color:red;">
<?php echo $message; ?>
</p>
<?php endif; ?>

<form class="signin-form" method="POST">

<div class="input-group">
<label>Email</label>
<input
type="email"
name="email"
required
autocomplete="off"
>
</div>

<div class="input-group">
<label>Password</label>
<input
type="password"
name="password"
required
autocomplete="new-password"
>

<button class="signin-btn" type="submit">
Login
</button>

</form>

<div class="signin-footer">
<p>Nuk ke account?</p>
<a href="signup.php">Sign Up</a>
</div>

</div>

</main>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>
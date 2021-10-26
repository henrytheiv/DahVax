<?php

include_once '../views/partials/header.php';

$username = '';
$password = '';

require_once 'form-validation/login-validation.php';

?>

<!-- navigation bar with Logo and log out icon -->
<nav class="navbar navbar-expand-lg custom-navbar" id="navbarNav">
    <span class="navbar-brand mb-0 h1">DahVax</span>
</nav>

<h2 class="page-title">Sign In</h2>

<!-- Log in form-->
<div class="container form-container">
    <form id="form" class="validation-form" method="POST">
        <div class="form-control">
            <label for="username">Username</label>
            <input type="text" placeholder="Username" id="username" name="username" value="<?php echo $username ?>"/>
            <?php if (isset($blankUsernameMsg)){ ?>
                        <small><?php echo $blankUsernameMsg; ?></small>
                        <?php } ?>

            <!-- <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small> -->
        </div>

        <div class="form-control">
            <label for="username">Password</label>
            <input type="password" placeholder="Password" id="password" name="password" value="<?php echo $password ?>"/>
            <?php if (isset($blankPasswordMsg)){ ?>
                        <small><?php echo $blankPasswordMsg; ?></small>
                        <?php } ?>
            <!-- <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small> -->
        </div>

        <button type="submit">Sign In</button>
    </form>
</div>

<p class="text-center mt-2">Doesn't have an account? <a href="SignUp.html">Sign up here</a></p>

<?php include_once '../views/partials/footer.php'; ?>
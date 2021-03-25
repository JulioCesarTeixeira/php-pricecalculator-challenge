<?php require 'includes/header.php'; ?>

<form method="post">
    <div class="form-group">

        <label for="email">Email</label>
        <input type="email" class="form-control col-2" id="email" name="email">

        <label for="password">Password</label>
        <input type="password" class="form-control col-2" id="password" name="password">

    </div>
    <button type="submit" class="btn btn-primary" id="submit" name="login">Login</button>
</form>


<?php require 'includes/footer.php'; ?>

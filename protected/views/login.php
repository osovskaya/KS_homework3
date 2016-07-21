<?php require_once(__DIR__.'/layouts/header.php');?>

<div class="content">
    <h2>Please login</h2>

    <form action="/authorize" method="post" enctype="multipart/form-data">
        <label for="name">Name</label>
        <input type="text" name="name" required  maxlength="50"><br>

        <label for="password">Password</label>
        <input type="password" name="password" required maxlength="50"><br>

        <input id="submit" type="submit" value="Login">
    </form>

    <h2>First time here? <a href="/form">Register</a></h2>
</div>

<script src="/static/js/login.js"></script>

<?php require_once(__DIR__.'/layouts/footer.php');?>

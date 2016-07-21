<?php require_once(__DIR__.'/layouts/header.php');?>

<div class="content">
    <h2>Information about myself</h2>

    <?php if (empty($user)): ?>
        <p class="alert">You haven't add information yet</p>
    <?php else: ?>

        <div class="flexbox">
            <div class="table">
                <table>
                    <?php foreach($user as $key => $value): ?>
                        <?php if (array_search($key, [1 => 'avatar', 'about', 'created', 'password'])) continue; ?>
                        <tr>
                            <td class="key"><?php echo ucfirst($key); ?></td>
                            <td class="value"><?php echo $value; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <div class="aboutmyself">
                <h3>My story</h3>
                <p><?php echo $user['about'];?></p>
            </div>
            <div class="image">
                <img src="<?php echo $user['avatar']; ?>" />
            </div>
        </div>

    <?php endif; ?>
</div>

<?php require_once(__DIR__.'/layouts/footer.php');?>

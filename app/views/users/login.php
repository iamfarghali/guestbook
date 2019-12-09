<?php require_once APPROOT.'views'.DS.'inc'.DS.'header.php'; ?>

<div class="row mt-5">
    <div class="col-md-4 m-auto shadow-sm border rounded">
        <?php flash('msg'); ?>
        <form class="form-signin mt-3" method="POST">
            <div class="form-group">
                <input type="email" class="form-control <?= !empty($data['email_err']) ? 'is-invalid' : '';?>" name="email" value="<?=$data['email']?>" placeholder="Email address">
                <span class="text-left invalid-feedback"><?=$data['email_err']?></span>
            </div>

            <div class="form-group">
                <input type="password" class="form-control <?= !empty($data['password_err']) ? 'is-invalid' : '';?>" name="password" value="<?=$data['password']?>" placeholder="Password" autocomplete="new-password">
                <span class="text-left invalid-feedback"><?=$data['password_err']?></span>
            </div>

            <button class="btn btn-dark btn-block" type="submit">Login</button>
            <a href="<?=APPURL.'users'.DS.'register'?>" class="btn btn-purple btn-block">Register</a>
        </form>
    </div>
</div>

<?php require_once APPROOT.'views'.DS.'inc'.DS.'footer.php'; ?>
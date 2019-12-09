<?php require_once APPROOT.'views'.DS.'inc'.DS.'header.php'; ?>

<div class="row mt-5">
    <div class="col-md-4 m-auto shadow-sm border rounded">
        <form class="form-signin mt-3" method="POST">
            <div class="form-group">
                <label for="inputName" class="sr-only">Name</label>
                <input type="text" class="form-control <?= !empty($data['name_err']) ? 'is-invalid' : '';?>" name="name" value="<?=$data['name']?>" placeholder="Name" autocomplete="name">
                <span class="text-left invalid-feedback"><?=$data['name_err']?></span>
            </div>

            <div class="form-group">
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" class="form-control <?= !empty($data['email_err']) ? 'is-invalid' : '';?>" name="email" value="<?=$data['email']?>" placeholder="Email address" autocomplete="email">
                <span class="text-left invalid-feedback"><?=$data['email_err']?></span>
            </div>

            <div class="form-group">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" class="form-control <?= !empty($data['password_err']) ? 'is-invalid' : '';?>" name="password" value="<?=$data['password']?>" placeholder="Password" autocomplete="new-password">
                <span class="text-left invalid-feedback"><?=$data['password_err']?></span>
            </div>

            <button class="btn btn-success btn-block" type="submit">Register</button>
            <a href="<?=APPURL.'users'.DS.'login'?>" class="btn btn-purple btn-block">Login</a>
        </form>
    </div>
</div>

<?php require_once APPROOT.'views'.DS.'inc'.DS.'footer.php'; ?>
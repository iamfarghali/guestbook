<?php require_once APPROOT.'views'.DS.'inc'.DS.'header.php'; ?>

<div class="row my-4">
    <?php  ?>
    <?php
        // Show Message if exist 
        flash('msg');

        // Check if user logged
        if (!isUserLogged()): ?>

            <!-- Unlogged User  -->
            <div class="col-12 text-center my-auto">
                <h1 class="display-1 text-muted my-5">GuestBook</h1>
                <a class="btn btn-dark px-5 py-1 mr-2" href="<?=APPURL.'users'.DS.'login'?>">Login</a>
                <a class="btn btn-success px-5 py-1 ml-2" href="<?=APPURL.'users'.DS.'register'?>">Register</a>
            </div>

        <?php else: ?>

            <!-- Logged User  -->
            <div class="col-12 text-center">

                <div class="d-flex justify-content-between border-bottom pb-2">
                    <h1 class=" display-4 text-muted">GuestBook</h1>
                    <a class="align-self-end btn btn-primary btn-sm" href="<?=APPURL.'messages'?>">Add Message</a>
                </div>

                <div class="row messages my-5">
                    <?php 
                        if (empty($messages)): ?>
                            <!-- No Messages  -->
                            <div class="col-12 text-center my-5 text-muted">
                                <p class="my-5">There are no messages till now.</p> 
                            </div>

                       <?php else: ?>
                            <!-- There are Messages  -->
                            <?php
                               foreach($messages as $message) { ?>
                                    <div class="col-4">
                                        <div class="message px-3 py-4">
                                            <p><?= htmlspecialchars_decode(substr($message->message, 0, 75)) ?></p>
                                            <div class="d-flex justify-content-between mx-2 sm-font">
                                                <span class="message-owner"><?=$message->name?></span>
                                                <span><a href="<?=APPURL.'messages'.DS.'message'.DS.$message->id?>">Read more .. </a></span>
                                            </div>
                                        </div>
                                    </div>
                               <?php }
                            ?>
                       
                       <?php endif;
                    ?>
                </div>
                
            </div>

        <?php endif;
    ?>
</div>

<?php require_once APPROOT.'views'.DS.'inc'.DS.'footer.php'; ?>
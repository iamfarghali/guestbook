<?php require_once APPROOT.'views'.DS.'inc'.DS.'header.php'; ?>

<div class="row my-4">
    
    <!-- Show Message if exist  -->
    <?= flash('msg'); ?>

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
                        <p class="my-5">You have no messages till now.</p> 
                    </div>

                <?php else: ?>
                    <!-- There are Messages  -->
                    <?php
                        foreach($messages as $message) { ?>
                            <div class="col-12 mb-2">
                                <div class="message px-3 pb-3 pt-2 text-left">
                                    <?php if ($message->new_reply_num > 0) { ?>
                                        <span class="notify"><?=$message->new_reply_num?></span>
                                    <?php } ?>
                                    
                                    <p><?= htmlspecialchars_decode(substr($message->message, 0, 100)) ?>...</p>
                                    <div class="d-flex justify-content-between mx-2 sm-font">
                                        <span class="message-owner"><?=$message->name?></span>
                                        <span><a class="text-info" href="<?=APPURL.'messages'.DS.'edit'.DS.$message->id?>">Edit</a></span>
                                        <span><a class="text-danger" href="<?=APPURL.'messages'.DS.'delete'.DS.$message->id?>">Delete</a></span>
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

</div>

<?php require_once APPROOT.'views'.DS.'inc'.DS.'footer.php'; ?>
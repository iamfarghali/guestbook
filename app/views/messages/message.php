<?php require_once APPROOT.'views'.DS.'inc'.DS.'header.php'; ?>

<div class="row mt-5">
    <div class="col-10 mx-auto">
        <!-- Show Message  -->
        <?php flash('msg'); ?>

        <!-- Main Message  -->
        <div class="message px-3 py-4">
            <h5 class="text-muted">Message</h5>
            <p><?= htmlspecialchars_decode($message->message) ?></p>
            <div class="d-flex justify-content-between mx-2 sm-font">
                <span class="message-owner"><?=$message->name?></span>
                <?php
                    if ($isMessageOwner) { ?>
                        <span><a class="text-info" href="<?=APPURL.'messages'.DS.'edit'.DS.$message->id?>">Edit</a></span>
                        <span><a class="text-danger" href="<?=APPURL.'messages'.DS.'delete'.DS.$message->id?>">Delete</a></span>
                    <?php }
                ?>
                <span><a href="<?=APPURL.'messages'.DS.'reply'.DS.$message->id.DS.$message->id?>">Reply </a></span>
            </div>
        </div>

        <!-- Replies  -->
        <div class="replies">
            <?php 
                foreach($message->replies as $reply) { ?>

                    <div class="reply p-2 mx-1 mt-3 mb-0">
                        <p class="mr-4 ml-1"><?= htmlspecialchars_decode($reply->message) ?></p>
                        <div class="d-flex justify-content-between mx-2 sm-font">
                            <span class="message-owner"><?=$reply->name?></span>
                            <span><a href="<?=APPURL.'messages'.DS.'reply'.DS.$reply->id.DS.$message->id?>">Reply </a></span>
                        </div>
                        <div>
                            <?=generateRepliesInHtml($reply->replies, $message->id);?>
                        </div>
                    </div>

                <?php } 
            ?>
        </div>

    </div>
</div>

<?php require_once APPROOT.'views'.DS.'inc'.DS.'footer.php'; ?>
<?php require_once APPROOT.'views'.DS.'inc'.DS.'header.php'; ?>

<div class="row mt-5">
    <div class="col-10 mx-auto">
        <!-- Main Message  -->
        <?php
            
        // echo '<pre>';
        // print_r($data);
        // // print_r($data);
        // die;
        ?>
        <div class="message px-3 py-4 mb-4">
            <h5 class="text-muted">Message</h5>
            <p><?= htmlspecialchars_decode($message->message) ?></p>
            <div class="d-flex justify-content-between">
                <div class="message-owner"><?=$message->name?></div>
                <div class=""><?=$message->id?></div>
                <div class="created-at"><?=$message->created_at?></div>
            </div>
        </div>

        <?php 
            foreach($message->replies as $reply) { ?>

                <div class="reply p-2 mx-2 mb-3">
                    <p class="mr-4 ml-1"><?= htmlspecialchars_decode($reply->message) ?></p>
                    <div class="d-flex justify-content-between mt-2">
                        <div class=""><?=$reply->id?></div>
                        <div class="message-owner"><?=$reply->name?></div>
                    </div>
                </div>

            <?php } 
        ?>
    </div>
</div>

<?php require_once APPROOT.'views'.DS.'inc'.DS.'footer.php'; ?>
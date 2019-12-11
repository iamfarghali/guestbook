<?php require_once APPROOT.'views'.DS.'inc'.DS.'header.php'; ?>

<div class="row mt-5">
    <div class="col-md-8 m-auto shadow-sm border rounded">
        <?php flash('msg'); ?>
        <form class="mt-3" action="<?=APPURL.'messages'.DS.'update'?>" method="POST">
            <input type="hidden" name="msgId" value="<?= isset($data['msgId']) ? $data['msgId'] : $message->id ?>">

            <div class="form-group">
                <textarea 
                    name="message" 
                    id="message" 
                    class="form-control <?= isset($data['message_err']) && !empty($data['message_err']) ? 'is-invalid' : '';?>" 
                    cols="30" 
                    rows="10"><?= isset($data['message']) ? $data['message'] : htmlspecialchars_decode($message->message) ?></textarea>

                <span class="text-left invalid-feedback"><?=isset($data['message_err']) ? $data['message_err'] : ''?></span>
            </div>

            <button class="btn btn-dark btn-block" type="submit">Edit Message</button>
        </form>
    </div>
</div>

<?php require_once APPROOT.'views'.DS.'inc'.DS.'footer.php'; ?>
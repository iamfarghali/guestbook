<?php require_once APPROOT.'views'.DS.'inc'.DS.'header.php'; ?>

<div class="row mt-5">
    <div class="col-md-8 m-auto shadow-sm border rounded">
        <?php flash('msg'); ?>
        <form class="mt-3" action="<?=APPURL.'messages'.DS.'store'?>" method="POST">
            <div class="form-group">
                <textarea 
                    name="message" 
                    id="message" 
                    class="form-control <?= isset($data['message_err']) && !empty($data['message_err']) ? 'is-invalid' : '';?>" 
                    cols="30" 
                    rows="10"><?= isset($data['message']) ? $data['message'] : '';?></textarea>

                <span class="text-left invalid-feedback"><?=$data['message_err']?></span>
            </div>

            <button class="btn btn-dark btn-block" type="submit">Add Your Message</button>
        </form>
    </div>
</div>

<?php require_once APPROOT.'views'.DS.'inc'.DS.'footer.php'; ?>
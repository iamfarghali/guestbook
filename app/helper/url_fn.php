<?php

if (!function_exists('redirect')) {
    function redirect($location) {
       $location = strpos($location, '.') ? str_replace('.', DS, $location) : $location;
       header('Location:'.APPURL.$location);
    }
}

if (!function_exists('generateRepliesInHtml')) {
    function generateRepliesInHtml($data, $msgId) {

       foreach($data as $val) { ?>

            <div class="reply py-2 px-1 mt-3">
                <p class="mr-4 ml-1"><?= htmlspecialchars_decode($val->message) ?></p>

                <div class="d-flex justify-content-between mx-2 sm-font">
                    <span class="message-owner"><?=$val->name?></span>
                    <span><a href="<?=APPURL.'messages'.DS.'reply'.DS.$val->id.DS.$msgId?>">Reply </a></span>
                </div>

                <div>
                    <?=generateRepliesInHtml($val->replies, $msgId);?>
                </div>
            </div>

       <?php } 

    }
}
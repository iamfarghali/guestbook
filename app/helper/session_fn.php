<?php

// Start the session
session_start();

/**
 * Flash Message Helper
 * Ex: flash('login_success', 'Welcome there!');
 * Display in view flash('login_success');
 */
function flash($name, $message = '', $class = 'success') {

    if (!empty($message)) {
        $_SESSION[$name] = $message;
        $_SESSION[$name.'_class'] = $class;
    } else if (isset($_SESSION[$name]) && !empty($_SESSION[$name])) {
        $class = !empty($_SESSION[$name.'_class']) ? $_SESSION[$name.'_class'] : $class;
        echo "<div class='col-10 mx-auto text-center alert alert-$class my-2' id='msg-flash'>$_SESSION[$name]</div>";
        unset($_SESSION[$name]);
        unset($_SESSION[$name.'_class']);
    }
}

function isUserLogged() {
    return (isset($_SESSION['user_id']) && !empty($_SESSION['user_id']));
}
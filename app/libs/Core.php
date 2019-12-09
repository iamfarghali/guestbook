<?php

/**
 * App Core Class
 * Creates URLs & Loads core controller
 * URL FORMAT => /controller/method/params 
 */

 class Core 
 {
    protected $currentController = 'Home';
    protected $currentMethod     = 'index';
    protected $params            = [];

    public function __construct() {   
        // get url array
        $url = $this->getUrl();

        // pasre the url
        $this->parseUrl($url);

        // load the controller and if loaded call the method.
        $this->loadController() ? $this->callMethod() : $this->showError('404 Page Not Found', 'No controller named ' . $this->currentController);
    }

    private function getUrl() {
        return isset($_GET['url']) ? explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL)) : [];
    }

    private function parseUrl($url) {
        $this->currentController = isset($url[0]) ? $url[0] : $this->currentController;
        $this->currentMethod     = isset($url[1]) ? $url[1] : $this->currentMethod;
        if (isset($url[2])) {
            for ($i = 0; $i < (count($url) - 2); $i++) {
                $this->params[$i] = $url[$i+2];
            }
        }
    }

    private function loadController() {
        if (file_exists(APPROOT . 'controllers' . DS . $this->currentController . '.php')) {
            require_once APPROOT . 'controllers' . DS . $this->currentController . '.php';
            $this->currentController = new $this->currentController;
            return true;
        }
        return false;
    }

    private function callMethod() {
        if (method_exists($this->currentController, $this->currentMethod)) {
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        } else {
            $this->showError('404 Page Not Found', 'No method named "' . $this->currentMethod . '" In "' . get_class($this->currentController) . '" Controller.');
        }
    }

    private function showError($errMsg, $details = '') {
        ?>
            <h1 style="color:red; text-align:center; margin-top:250px;"><?=$errMsg?></h1>
        <?php

        if (APPENV == 'DEV') {
            ?>
                <hr><h2 style="color:#969694; text-align:left; margin-top:50px;">Details: <span style="color:red;"> <?= $details ?> </span> </h2>
            <?php
        }
    }

 }
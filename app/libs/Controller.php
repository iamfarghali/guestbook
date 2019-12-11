<?php

class Controller
{
    // model
    protected $model = null;

    // Load Model
    public function model($m) {

        if (file_exists(APPROOT . 'models' . DS . $m . '.php')) {
            require_once APPROOT . 'models' . DS . $m . '.php';
            $this->model = new $m();
        }

        // If Model Not Exist
        return false;
    }

    // Load View
    public function view($view, $data = []) {
        
        extract($data);

        $view = $this->parseViewPath($view);
        if (file_exists(APPROOT . 'views' . DS . $view . '.php')) {
            require_once APPROOT . 'views' . DS . $view . '.php';
        } else {
            // View Not Exist
            if (APPENV === 'DEV') {
                die('View does not exist!');
            }
            $this->view('404');
        }
    }

    /** 
     * Parse view path
     * To support 2 formats (pages/about) and (pages.about) when write view path.
    */
    private function parseViewPath($view) {
        return strpos($view, '.') ? str_replace('.', '/', $view) : $view;
    }
}
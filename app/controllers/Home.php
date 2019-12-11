<?php

class Home extends Controller
{
    public function __construct() {
        !isUserLogged() ? '' : $this->model('Message');
    }

    public function index() {
        $messages = !isUserLogged() ? [] : $this->model->getMessages();
        $this->view('home.index', ['messages' => $messages]);
    }
}
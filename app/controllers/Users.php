<?php

class Users extends Controller
{
    public function __construct() {
        $this->model('User');
    }

    public function profile($id = '') {

        if (isUserLogged()) {
            $user = $this->model->getUser($id);
            $data = ['user' => $user];
            $user ?  $this->view('users.profile', $data) : $this->view('404');
        } else {
            flash('msg', 'Login to able to see this profile.', 'danger');
            redirect('users.login');
        }
    }

    public function login() {
        // page date
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = sanitize($_POST);

            // Check Email
            $data['email_err'] = empty($data['email']) ?  'Plaese Enter Email.' : '';
            if (!$this->model->findByEmail($data['email'])) {
                $data['email_err'] = 'Email does not exist! You can register now.';
            }
            
            // Check Password
            if (empty($data['password'])){
                $data['password_err'] = 'Plaese Enter Password.';
            } elseif (strlen($data['password']) <= 5) {
                $data['password_err'] = 'Password must be more than 5 characters.';
            } else {
                $data['password_err'] = '';
            }
 
            if (empty($data['email_err']) && empty($data['password_err'])) {
                // valid
                $logged = $this->model->login($data['email'], $data['password']);
                if ($logged) {
                    $this->createUserSession($logged);
                    redirect('pages');
                } else {
                    $data['password_err'] = 'Password Incorrect.';
                    $this->view('users.login', $data);
                }
            } else {
                $this->view('users.login', $data);
            }
            
        } else {

            // Redirect if user logged in
            if (isUserLogged()) {
                redirect('posts.index');
            } else {
                $data = [
                    'email'  => '',
                    'password'  => '',
                    'email_err'  => '',
                    'password_err'  => ''
                ];
    
                $this->view('users.login', $data);
            }
        }
    }

    public function register() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // register process
            $data = sanitize($_POST);

            $data['name_err']  = empty($data['name']) ?  'Plaese Enter Name.' : '';
            $data['email_err'] = empty($data['email']) ?  'Plaese Enter Email.' : '';

            if ($this->model->findByEmail($data['email'])) {
                $data['email_err'] = 'Email Already Exists!';
            }
 
            if (empty($data['password'])){
                $data['password_err'] = 'Plaese Enter Password.';
            } elseif (strlen($data['password']) <= 5) {
                $data['password_err'] = 'Password must be more than 5 characters.';
            } else {
                $data['password_err'] = '';
            }

            if (empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err'])) {
                // valid
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
               
                if ($this->model->register($data)) {
                    flash('msg', 'You are now registered! You can login :)');
                    redirect('users.login');
                } else {
                    if (APPENV === 'DEV') {
                        die('Something wrong, Check Your DB or Model Class');
                    } else {
                        die('Something wrong!');
                    }
                }
            } else {
                $this->view('users.register', $data);
            }

        } else {
            // Redirect if user logged in
            if (isUserLogged()) { 
                redirect('posts.index');
            } else { 
                $data = [
                    'name'  => '',
                    'email'  => '',
                    'password'  => '',
                    'name_err'  => '',
                    'email_err'  => '',
                    'password_err'  => ''
                ];
                $this->view('users.register', $data);
            }

        }
    }

    public function createUserSession($user) {
        $_SESSION['user_id']    = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name']  = $user->name;
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        session_destroy();
        redirect('users.login');
    }
}
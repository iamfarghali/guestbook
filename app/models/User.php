<?php

class User 
{
    private $_db;
    private $_table = 'users';

    public function __construct() {
        $this->_db = new Database;
    }

    public function findByEmail($email) {
        $this->_db->query("SELECT * FROM $this->_table WHERE email = :email");
        $this->_db->bind(':email', $email);
        
        return $this->_db->one();
    }

    public function getUser($id) {
        $this->_db->query("SELECT * FROM $this->_table WHERE id = :id");
        $this->_db->bind(':id', $id);

        return $this->_db->one();
    }

    public function login($email, $password) {
        $this->_db->query("SELECT * FROM $this->_table WHERE email = :email");
        $this->_db->bind(':email', $email);
        $row = $this->_db->one();

        return password_verify($password, $row->password) ? $row : false;
    }

    public function register($data) {
        $this->_db->query("INSERT INTO $this->_table (name, email, password) VALUES (:name, :email, :password)");
        $this->_db->bind(':name', $data['name']);
        $this->_db->bind(':email', $data['email']);
        $this->_db->bind(':password', $data['password']);
        
        return $this->_db->execute(); 
    }
}
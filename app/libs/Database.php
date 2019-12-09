<?php

 /**
  * PDO Database Class
  * Connect to database
  * Create prepared statments
  * Bind values
  * Return rows and results
  */

  class Database

  {
    private $_host = DB_HOST;
    private $_user = DB_USER;
    private $_pass = DB_PASS;
    private $_name = DB_NAME;

    private $_dbh;
    private $_stmt;
    private $_error;

    public function __construct() {
        // Set DSN
        $dsn = 'mysql:host=' . $this->_host . ';dbname=' . $this->_name;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->_dbh = new PDO($dsn, $this->_user, $this->_pass, $options);
        } catch (PDOException $e) {
            if (APPENV === 'DEV') {
                $this->_error = $e->getMessage();
                echo $this->_error;
            } else {
                die('Something Wrong!');
            }
        }
    }

    // Prepare statment with query
    public function query($sql) {
        $this->_stmt = $this->_dbh->prepare($sql);

    }

    // bind the values
    public function bind($param, $val, $type = null) {
        if (is_null($type)) {
            switch(true) {
                case is_int($val):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($val):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($val):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->_stmt->bindValue($param, $val, $type);
    }

    // Execute the prepared statment
    public function execute() {    
        return $this->_stmt->execute();
    }

    // Get results set as array of objects
    public function getAll() {
        $this->execute();
        return $this->_stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get one row
    public function one() {
        $this->execute();
        return $this->_stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get row count
    public function count() {
        return $this->_stmt->rowCount();
    }

  }
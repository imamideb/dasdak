<?php

class CONN {

    private $_host = '127.0.0.1';
    private $_username = 'amidevxy_dasdak';
    private $_password = '.o8.v?_)YHG7';
    private $_database = 'amidevxy_dasdak';
    public $connection = null;

    public function __construct() {
        if ($this->connection == null) {
            $this->connection = mysqli_connect($this->_host, $this->_username, $this->_password, $this->_database);

            if (!$this->connection) {
                echo 'Cannot connect to database server';
                exit;
            }
        }
    }

}

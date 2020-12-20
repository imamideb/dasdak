<?php

class DB extends CONN {

    public $query;
    public $rows = [];
    public $errors;

    public function __construct() {
        parent::__construct();

        $this->query = '';
        $this->rows = [];
        $this->result = [];
        $this->errors = [];
    }

    public function __destruct() {
        $this->connection = null;
    }

    public function result() {
        return mysqli_query($this->connection, $this->query);
    }

    public function execute() {
        return $this->result();
    }

    public function all() {
        $result = $this->result();
        
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result))
                $this->rows[] = $row;
        }
        
        return $this->rows;
    }

    public function find() {
        $results = $this->all();

        if (is_array($results) && count($results) > 0) {
            return $this->rows[0];
        }

        return [];
    }

    public function errors() {
        return mysqli_error($this->connection);
    }
    
    public function insert() {
        if ($this->connection->query($this->query)) :
            return $this->connection->insert_id;
        endif;
    }

}

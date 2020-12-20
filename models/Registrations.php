<?php

class Registrations {
       
    public function __construct() {
        $this->db = new DB();
        $this->errors = [];
        $this->status = false;
    }

    public function create_registrations($data) {
        $s = $g = 0;
        if (!isset($_SESSION['ddr_id'])) :
            $this->db->query = "INSERT INTO dd_registrations SET  
                                   DDR_FIRST_NAME='{$data['firstName']}'
                                   ,DDR_LAST_NAME='{$data['lastName']}'
                                   ,DDR_EMAIL='{$data['email']}'
                                   ,DDR_ZIP='{$data['zipCode']}'
                                   ,DDR_GUESTS_NO='{$data['noOfGuests']}'
                                   ,DDR_IP='{$_SERVER['REMOTE_ADDR']}'";
            $_SESSION['ddr_id'] = $this->db->insert();
            self::send_emails($data['firstName'] . ' ' . $data['lastName'], $data['email'], $_SESSION['guests']);
        else :
            $registrations = self::get_registrations();
            self::send_emails($registrations[0]['DDR_FIRST_NAME'] . ' ' . $registrations[0]['DDR_LAST_NAME'], $registrations[0]['DDR_EMAIL'], $_SESSION["guests"]);
        endif;
            if (isset($data["subscriptions"]) && !empty($data["subscriptions"])) :
                
                foreach ($data['subscriptions'] as $key => $value) :
                        $this->db->query = "INSERT INTO dd_options SET  
                                                DDO_DDR_ID='{$_SESSION['ddr_id']}'
                                                ,DDO_VALUE='{$key}'";
                        if ($this->db->insert()) : $s++; endif;
                endforeach;
            endif;           
        if (isset($data["guests"]) && !empty($data["guests"])) :
            foreach ($data['guests'] as $key => $value) :
                $this->db->query = "INSERT INTO dd_guests SET  
                                        DDG_FIRST_NAME='{$value['firstName']}'
                                        ,DDG_LAST_NAME='{$value['lastName']}'
                                        ,DDG_EMAIL='{$value['email']}'
                                        ,DDG_DDR_ID='{$_SESSION['ddr_id']}'";
                if ($this->db->insert()) :
                    $g++;
                    self::send_emails($value['firstName'] . ' ' . $value['lastName'], $value['email']);
                endif;
            endforeach;
        endif;
        if (isset($_SESSION['ddr_id']) && (count($data["guests"]) == $g) && (count($data['subscriptions']) == $s)) :
            return 1;
        else :
            $this->errors['db'] = $this->db->errors;
            exit;
        endif;
    }
    
    private function send_emails($name, $email, $guests = '') {
        $SendGridEmails = new SendGridEmails();
        $SendGridEmails->send($name, $email, $guests);
    }

    private function get_guests() {
        $this->db->query = "SELECT * FROM dd_guests WHERE DDG_DDR_ID='{$_SESSION['ddr_id']}';";
        return $this->db->all();
    }
    
    private function get_registrations() {
        $this->db->query = "SELECT * FROM dd_registrations WHERE DDR_ID='{$_SESSION['ddr_id']}';";
        return $this->db->all();
    }

}
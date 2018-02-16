<?php

class Loyalty_logs_model extends CI_Model {
    
        public $log;
        public $module;
        public $details;
        public $created_by;
        public $date_created;

        public function insert_log()
        {
            $this->date_created = date("Y-m-d H:i:s A");
            $this->db->insert("loyalty_logs",$this);
        }

}

?>
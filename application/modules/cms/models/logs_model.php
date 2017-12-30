<?php

class Logs_model extends CI_Model {
    
        public $log;
        public $created_by;
        public $date_created;

        public function insert_log()
        {
            $this->date_created = date("Y-m-d h:i:s A");
            $this->db->insert("logs",$this);
        }

}

?>
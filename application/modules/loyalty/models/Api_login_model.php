<?php

class Api_login_model extends CI_Model {
    
        public $card_number;

        public function insert_loyalty_login()
        {
            $this->db->where("card_number",$this->card_number);
            $result = $this->db->get("loyalty_record")->row();
            if( count($result) == 0 )
            {
                $data["card_number"] = $this->card_number;  
                $data["date_created"] = date("Y-m-d H:i:s A");
                $this->db->insert("loyalty_record",$data);
            }
        }
}


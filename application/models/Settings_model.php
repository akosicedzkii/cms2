<?php

class Settings_model extends CI_Model {
    
        public function get_settings()
        {
                $query = $this->db->get('site_settings');
                define("SITE_NAME",$query->row()->site_name);
        }

}


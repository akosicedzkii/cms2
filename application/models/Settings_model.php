<?php

class Settings_model extends CI_Model {
    
        public function get_settings()
        {
                $query = $this->db->get('site_settings');
                if($query->row() == null)
                {
                        $site_name = "";
                }
                else
                {
                        $site_name = $query->row()->site_name;
                }
                define("SITE_NAME", $site_name);
        }

}


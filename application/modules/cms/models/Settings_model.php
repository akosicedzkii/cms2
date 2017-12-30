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
        
        public function get_user_access()
        {
            $id = $this->session->userdata("USERID");
            $this->db->where("id",$id);
            $user_account = $this->db->get("user_accounts");

            $this->db->where("role_id",$user_account->row()->role_id);
            $this->db->select("module");
            $role_modules = $this->db->get("role_modules");
            $return = array();
            foreach($role_modules->result() as $row)
            {
                array_push($return,$row->module);
            }
            return $return;
        }
}


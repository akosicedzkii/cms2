<?php

class Login_model extends CI_Model {
    
        public $username;
        public $password;

        public function validate_login()
        {
            $this->db->where("username",$this->username);
            $query = $this->db->get("user_accounts");
            if($query->row() == null)
            {
                echo "User not found";
            }
            else
            {
                $username = $query->row()->username;
                $password = $query->row()->password;
                $user_id = $query->row()->user_id;
                $salt = $query->row()->salt;
                
                $combined_password =  hash ( "sha256",  $salt.$this->password );
                if($combined_password == $password )
                {
                    
                    $this->session->set_userdata("username",$username);
                    $this->session->set_userdata("user_id",$user_id);
                    $this->logs->log = "Logged in";
                    $this->logs->created_by = $user_id;
                    $this->logs->insert_log();
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }

}

?>
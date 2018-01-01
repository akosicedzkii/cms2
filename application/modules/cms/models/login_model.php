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
                $user_id = $query->row()->id;
                $salt = $query->row()->salt;
                if($username != $this->username)
                {
                    echo "User not found";
                    die();
                }
                $combined_password =  hash ( "sha256",  $salt.$this->password );
                if($combined_password == $password)
                {
                    
                    $this->session->set_userdata("USERNM",$username);
                    $this->session->set_userdata("USERID",$user_id);

                    $this->db->where("user_id",$this->session->userdata("USERID"));
                    $result = $this->db->get("user_profiles");
                    $result = $result->row();
                    $full_name = str_replace("  "," ",ucwords($result->first_name." ".$result->middle_name." ".$result->last_name));
                    $this->session->set_userdata("FULLNM",$full_name);
                    
                    $this->logs->log = "Logged in" ;
                    $this->logs->details = $username;
                    $this->logs->module = "login";
                    $this->logs->created_by = $this->session->userdata("USERID");
                    $this->logs->insert_log();
                    return "true";
                }
                else
                {
                    return "false";
                }
            }
        }

}

?>
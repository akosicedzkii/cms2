<?php

class Users_model extends CI_Model {
    
        public $username;
        public $password;
        public $email;
        public $salt;
        public $lastname;
        public $firstname;
        public $middlename;
        public $contact_number;
        public $address;
        public $role;
        public $user_id;

        public function insert_user()
        {
                $data["username"] = $this->username ; 
                $this->salt = hash ( "sha256", $this->username ); 
                $data["salt"] = $this->salt;
                $data["password"] =  hash ( "sha256",  $this->salt.$this->password );
                $data["date_created"] = date("Y-m-d h:i:s A");
                $data["role_id"] = $this->role;
                $data["created_by"] =  $this->session->userdata("USERID");
                $result = $this->db->insert('user_accounts', $data);

                $this->db->where("username",$this->username);
                $result = $this->db->get("user_accounts");

                $data_profile["user_id"] =   $result->row()->id;
                $data_profile["last_name"] = $this->last_name; 
                $data_profile["first_name"] = $this->first_name;
                $data_profile["middle_name"] = $this->middle_name; 
                $data_profile["contact_number"] = $this->contact_number;
                $data_profile["email_address"] = $this->email_address;
                $data_profile["address"] = $this->address; 
                $data_profile["created_by"] = $this->session->userdata("USERID");
                $data_profile["date_created"] = date("Y-m-d h:i:s A");
                echo $result = $this->db->insert('user_profiles', $data_profile);
                
                $data = json_encode($data_profile);
                $this->logs->log = "Created User: ". $data ;
                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();

        }

        public function update_user()
        {
                $data["username"] = $this->username ; 
                $data["date_modified"] = date("Y-m-d h:i:s A");
                $data["role_id"] = $this->role;
                $data["modified_by"] = $this->session->userdata("USERID");
                $this->db->where("id",$this->user_id);
                $result = $this->db->update('user_accounts', $data);

                $data_profile["last_name"] = $this->last_name; 
                $data_profile["first_name"] = $this->first_name;
                $data_profile["middle_name"] = $this->middle_name; 
                $data_profile["contact_number"] = $this->contact_number;
                $data_profile["email_address"] = $this->email_address;
                $data_profile["address"] = $this->address; 
                $data["date_modified"] = date("Y-m-d h:i:s A");
                $data["modified_by"] = $this->session->userdata("USERID");
                $this->db->where("user_id",$this->user_id);
                echo $result = $this->db->update('user_profiles', $data_profile);
                $data = json_encode($data_profile);
                $this->logs->log = "Updated User: ". $data ;
                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();

        }

        public function get_user_roles($search)
        {
                $this->db->like("role_name",$search);
                $result = $this->db->select("id,role_name as text")->get("roles");
                return json_encode($result->result());
        }
        public function check_username_exist($method)
        {
                
                if($method != "add")
                {
                        $this->db->where("id!=",$this->user_id);
                }
                $this->db->where("username",$this->username);
                $query = $this->db->get('user_accounts');
                if($query->row() == null)
                {
                return false;
                }
                else
                {
                return true;
                }
        }

      
}

?>
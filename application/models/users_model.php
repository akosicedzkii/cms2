<?php

class Users_model extends CI_Model {
    
        public $username;
        public $password;
        public $salt;
        public $date_created;
        public $lastname;
        public $firstname;
        public $middlename;
        public $contact_number;
        public $address;
        public $usertype;
        public $user_id;

        public function get_last_ten_entries()
        {
                $query = $this->db->get('entries', 10);
                return $query->result();
        }

        public function insert_user()
        {
                $data["username"] = hash ( "sha256", $this->username ); 
                $data["password"] =  hash ( "sha256",  $this->salt.$this->password );
                $data["date_created"] = date("Y-m-d h:i:s A");
                $data["created_by"] = $this->session->userdata("USERID");
                $result = $this->db->insert('user_accounts', $data);

                $this->db->where("username",$this->username);
                $result = $this->db->get("user_accounts");

                $data_profile["user_id"] =   $result->row()->id;
                $data_profile["last_name"] = $this->first_name; 
                $data_profile["first_name"] = $this->last_name;
                $data_profile["middle_name"] = $this->middle_name; 
                $data_profile["contact"] = $this->contact;
                $data_profile["address"] = $this->address; 
                $data_profile["created_by"] = $this->session->userdata("USERID");
                $data_profile["date_created"] = date("Y-m-d h:i:s A");
                echo $result = $this->db->insert('user_profile', $data_profile);
        }

        public function update_user()
        {
                $data["username"] = hash ( "sha256", $this->username ); 
                $data["password"] =  hash ( "sha256",  $this->salt.$this->password );
                $data["date_created"] = date("Y-m-d h:i:s A");
                $data["created_by"] = $this->session->userdata("USERID");
                $result = $this->db->insert('user_accounts', $data);

                $this->db->where("user_id",$this->user_id);
                $result = $this->db->get("user_accounts");

                $data_profile["user_id"] =   $result->row()->id;
                $data_profile["last_name"] = $this->first_name; 
                $data_profile["first_name"] = $this->last_name;
                $data_profile["middle_name"] = $this->middle_name; 
                $data_profile["contact"] = $this->contact;
                $data_profile["address"] = $this->address; 
                $data_profile["created_by"] = $this->session->userdata("USERID");
                $data_profile["date_created"] = date("Y-m-d h:i:s A");
                $this->db->where("user_id",$this->user_id);
                echo $result = $this->db->update('user_profile', $data_profile);
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
                        $this->db->where("user_id!=",$this->user_id);
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
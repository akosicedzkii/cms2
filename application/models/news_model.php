<?php

class News_model extends CI_Model {
    
        public $id;
        public $name;
        public $description;
        public $content;
        public $banner_image;

        public function insert_news()
        {
                $data["name"] = $this->name ; 
                $data["description"] = $this->description;
                $data["content"] = $this->content;
                $data["date_created"] = date("Y-m-d h:i:s A");
                $data["role_id"] = $this->role;
                $data["created_by"] =  $this->session->userdata("USERID");
                echo $result = $this->db->insert('user_accounts', $data);
                
                $data = json_encode($data_profile);
                $this->logs->log = "Created News: ". $data ;
                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();
        }

        public function update_news()
        {
                $data["name"] = $this->name ; 
                $data["description"] = $this->description;
                $data["content"] = $this->content;
                $data["date_created"] = date("Y-m-d h:i:s A");
                $data["role_id"] = $this->role;
                $data["created_by"] =  $this->session->userdata("USERID");
                $this->db->where("id",$this->id);
                echo $result = $this->db->insert('user_accounts', $data);
                
                $data = json_encode($data_profile);
                $this->logs->log = "Updated News: ". $data ;
                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();

        }

}

?>
<?php

class Banners_model extends CI_Model {
    
        public $id;
        public $title;
        public $description;
        public $content;
        public $banner_image;
        public $status;

        public function insert_banners()
        {
                $data["title"] = $this->title ; 
                $data["description"] = $this->description;
                $data["date_created"] = date("Y-m-d H:i:s A");
                $data["banner_image"] = $this->banner_image;
                $data["status"] = $this->status;
                $data["content"] = $this->content;
                $data["created_by"] =  $this->session->userdata("USERID");
                echo $result = $this->db->insert('banners', $data);
                $data = json_encode($data);
                $this->logs->log = "Created Banners: ". $data ;
                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();
        }

        public function update_banners()
        {
                $data["title"] = $this->title ; 
                $data["description"] = $this->description;
                $data["content"] = $this->content;
                $data["date_modified"] = date("Y-m-d H:i:s A");
                if($this->banner_image != null)
                {
                     $data["banner_image"] = $this->banner_image;
                }
                $data["status"] = $this->status;
                $data["modified_by"] =  $this->session->userdata("USERID");
                $this->db->where("id",$this->id);
                echo $result = $this->db->update('banners', $data);
                

                $data = json_encode($data);
                $this->logs->log = "Updated Banners: ". $data ;
                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();

        }

}

?>
<?php

class Updates_model extends CI_Model {
    
        public $id;
        public $title;
        public $description;
        public $content;
        public $cover_image;
        public $status;

        public function insert_updates()
        {
                $data["title"] = $this->title ; 
                $data["description"] = $this->description;
                $data["content"] = $this->content;
                $data["date_created"] = date("Y-m-d h:i:s A");
                $data["cover_image"] = $this->cover_image;
                $data["status"] = $this->status;
                $data["created_by"] =  $this->session->userdata("USERID");
                echo $result = $this->db->insert('updates', $data);
                unset($data["content"]);
                $data = json_encode($data);
                $this->logs->log = "Created Updates: ". $data ;
                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();
        }

        public function update_updates()
        {
                $data["title"] = $this->title ; 
                $data["description"] = $this->description;
                $data["content"] = $this->content;
                $data["date_modified"] = date("Y-m-d h:i:s A");
                if($this->cover_image != null)
                {
                     $data["cover_image"] = $this->cover_image;
                }
                $data["status"] = $this->status;
                $data["modified_by"] =  $this->session->userdata("USERID");
                $this->db->where("id",$this->id);
                echo $result = $this->db->update('updates', $data);
                
                unset($data["content"]);

                $data = json_encode($data);
                $this->logs->log = "Updated Updates: ". $data ;
                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();

        }

}

?>
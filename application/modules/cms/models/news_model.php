<?php

class News_model extends CI_Model {
    
        public $id;
        public $title;
        public $description;
        public $content;
        public $cover_image;
        public $status;

        public function insert_news()
        {
                $data["title"] = $this->title ; 
                $data["description"] = $this->description;
                $data["content"] = $this->content;
                $data["date_created"] = date("Y-m-d H:i:s A");
                $data["cover_image"] = $this->cover_image;
                $data["status"] = $this->status;
                $data["created_by"] =  $this->session->userdata("USERID");
                echo $result = $this->db->insert('news', $data);
                $insertId = $this->db->insert_id();
                $data["id"] = $insertId;
                $data = json_encode($data);
                $this->logs->log = "Created News - ID:". $insertId .", News Title: ".$this->title ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "news";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();
        }

        public function update_news()
        {
                $data["title"] = $this->title ; 
                $data["description"] = $this->description;
                $data["content"] = $this->content;
                $data["date_modified"] = date("Y-m-d H:i:s A");
                if($this->cover_image != null)
                {
                     $data["cover_image"] = $this->cover_image;
                }
                $data["status"] = $this->status;
                $data["modified_by"] =  $this->session->userdata("USERID");
                $this->db->where("id",$this->id);
                echo $result = $this->db->update('news', $data);
                
                
                $data["id"] = $this->id;
                $data = json_encode($data);
                $this->logs->log = "Updated News - ID:". $this->id .", News Title: ".$this->title ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "news";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();

        }

}

?>
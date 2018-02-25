<?php

class Achievements_model extends CI_Model {
    
        public $id;
        public $year;
        public $achievement;

        public function insert_achievement()
        {
                $data["year"] = $this->year ; 
                $data["achievement"] = $this->achievement;
                $data["date_created"] = date("Y-m-d H:i:s A");
                $data["created_by"] =  $this->session->userdata("USERID");
                echo $result = $this->db->insert('achievements', $data);
                $insertId = $this->db->insert_id();
                $data["id"] = $insertId;
                $data = json_encode($data);
                $this->logs->log = "Created Achievement - ID:". $insertId .", Achievement: ".$this->title ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "achievements";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();
        }

        public function update_achievement()
        {
                $data["year"] = $this->year ; 
                $data["achievement"] = $this->achievement;
                $data["date_modified"] = date("Y-m-d H:i:s A");
                $data["modified_by"] =  $this->session->userdata("USERID");
                $this->db->where("id",$this->id);
                echo $result = $this->db->update('achievements', $data);
                
                
                $data["id"] = $this->id;
                $data = json_encode($data);
                $this->logs->log = "Updated Achievement - ID:". $this->id .", Achievement: ".$this->year ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "achievements";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();

        }

}

?>
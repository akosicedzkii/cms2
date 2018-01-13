<?php

class Careers_model extends CI_Model {
    
        public $id;
        public $job_title;
        public $job_description;

        public function insert_career()
        {
                $data["job_title"] = $this->job_title ; 
                $data["job_description"] = $this->job_description;
                $data["date_created"] = date("Y-m-d H:i:s A");
                $data["created_by"] =  $this->session->userdata("USERID");
                echo $result = $this->db->insert('careers', $data);
                $insertId = $this->db->insert_id();
                $data["id"] = $insertId;
                $data = json_encode($data);
                $this->logs->log = "Created Career - ID:". $insertId .", Career: ".$this->title ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "careers";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();
        }

        public function update_career()
        {
                $data["job_title"] = $this->job_title ; 
                $data["job_description"] = $this->job_description;
                $data["date_modified"] = date("Y-m-d H:i:s A");
                $data["modified_by"] =  $this->session->userdata("USERID");
                $this->db->where("id",$this->id);
                echo $result = $this->db->update('careers', $data);
                
                
                $data["id"] = $this->id;
                $data = json_encode($data);
                $this->logs->log = "Updated Career - ID:". $this->id .", Career: ".$this->job_title ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "careers";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();

        }

}

?>
<?php

class Branches_model extends CI_Model {
    
        public $id;
        public $branch_name;
        public $details;

        public function insert_branch()
        {
            $data["branch_name"] = $this->branch_name; 
            $data["details"] = $this->details; 
            $data["date_created"] = date("Y-m-d H:i:s A");
            $data["created_by"] =  $this->session->userdata("USERID");
            echo $result = $this->db->insert('branches', $data);

            $insertId = $this->db->insert_id();
            $data["id"] = $insertId;
            $data = json_encode($data);
            $this->logs->log = "Created Branch - ID:". $insertIdd .", Branch Name: ".$this->branch_name ;
            $this->logs->details = json_encode($data);
            $this->logs->module = "branch";
            $this->logs->created_by = $this->session->userdata("USERID");
            $this->logs->insert_log();
        }

        public function update_branch()
        {
            $data["branch_name"] = $this->branch_name; 
            $data["details"] = $this->details; 
            $data["date_modified"] = date("Y-m-d H:i:s A");
            $data["modified_by"] =  $this->session->userdata("USERID");
            $this->db->where("id",$this->id);
            echo $result = $this->db->update('branches', $data);
            
            $data["id"] = $this->id;
            $data = json_encode($data);
            $this->logs->log = "Updated Branch - ID:". $this->id .", Branch Name: ".$this->branch_name ;
            $this->logs->details = json_encode($data);
            $this->logs->module = "branch";
            $this->logs->created_by = $this->session->userdata("USERID");
            $this->logs->insert_log();
        }

}

?>
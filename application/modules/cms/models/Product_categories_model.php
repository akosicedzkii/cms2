<?php

class Product_categories_model extends CI_Model {
    
        public $id;
        public $category_name;
        public $category_description;

        public function insert_product_category()
        {
                $data["category_name"] = $this->category_name ; 
                $data["category_description"] = $this->category_description;
                $data["date_created"] = date("Y-m-d H:i:s A");
                $data["created_by"] =  $this->session->userdata("USERID");
                echo $result = $this->db->insert('product_categories', $data);
                $insertId = $this->db->insert_id();
                $data["id"] = $insertId;
                $data = json_encode($data);
                $this->logs->log = "Created Product Category - ID:". $insertId .", Product Category: ".$this->title ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "product_categories";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();
        }

        public function update_product_category()
        {
                $data["category_name"] = $this->category_name ; 
                $data["category_description"] = $this->category_description;
                $data["date_modified"] = date("Y-m-d H:i:s A");
                $data["modified_by"] =  $this->session->userdata("USERID");
                $this->db->where("id",$this->id);
                echo $result = $this->db->update('product_categories', $data);
                
                
                $data["id"] = $this->id;
                $data = json_encode($data);
                $this->logs->log = "Updated Product Category - ID:". $this->id .", Product Category: ".$this->category_name ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "product_categories";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();

        }

}

?>
<?php

class Product_series_model extends CI_Model {
    
        public $id;
        public $series_name;
        public $series_description;
        public $series_image;
        public $series_title_image;
        public $vendor_id;
        public $product_category_id;

        public function insert_product_series()
        {
                $data["series_name"] = $this->series_name ; 
                $data["series_description"] = $this->series_description;
                $data["date_created"] = date("Y-m-d H:i:s A");
                $data["series_image"] = $this->series_image;
                
                if($this->series_title_image != null)
                {
                     $data["series_title_image"] = $this->series_title_image;
                }

                $data["vendor_id"] = $this->vendor_id;
                $data["product_category_id"] = $this->product_category_id;
                $data["created_by"] =  $this->session->userdata("USERID");
                echo $result = $this->db->insert('product_series', $data);
                $insertId = $this->db->insert_id();
                $data["id"] = $insertId;
                $data = json_encode($data);
                $this->logs->log = "Created Product Series - ID:". $insertId .", Product Series Name: ".$this->series_name ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "product_series";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();
        }

        public function update_product_series()
        {
                $data["series_name"] = $this->series_name ; 
                $data["series_description"] = $this->series_description;
                $data["date_modified"] = date("Y-m-d H:i:s A");
                $data["vendor_id"] = $this->vendor_id;
                $data["product_category_id"] = $this->product_category_id;
                if($this->series_image != null)
                {
                     $data["series_image"] = $this->series_image;
                }

                if($this->series_title_image != null)
                {
                     $data["series_title_image"] = $this->series_title_image;
                }

                $data["modified_by"] =  $this->session->userdata("USERID");
                $this->db->where("id",$this->id);
                echo $result = $this->db->update('product_series', $data);
                
                
                $data["id"] = $this->id;
                $data = json_encode($data);
                $this->logs->log = "Updated Product Series - ID:". $this->id .", Product Series Name: ".$this->series_name ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "product_series";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();

        }

}

?>
<?php

class Products_model extends CI_Model {
    
        public $id;
        public $product_name;
        public $product_description;
        public $product_image;
        public $product_sub_image;
        public $specification;
        public $product_vendor_id;
        public $product_category_id;
        public $product_series_id;
        public $pdf;
        public $visibility;
        public $status;

        public function insert_products()
        {
                $data["product_name"] = $this->product_name ; 
                $data["product_description"] = $this->product_description;
                $data["date_created"] = date("Y-m-d H:i:s A");
                $data["product_image"] = $this->product_image;
                $data["specification"] = $this->specification;
                $data["product_vendor_id"] = $this->product_vendor_id;
                $data["product_series_id"] = $this->product_series_id;
                $data["product_category_id"] = $this->product_category_id;
                $data["visibility"] = $this->visibility;
                $data["status"] = $this->status;
                if($this->product_sub_image != null)
                {
                     $data["product_sub_image"] = $this->product_sub_image;
                }
                if($this->pdf != null)
                {
                     $data["pdf"] = $this->pdf;
                }
                if($this->mds != null)
                {
                     $data["mds"] = $this->mds;
                }
                $data["created_by"] =  $this->session->userdata("USERID");
                echo $result = $this->db->insert('products', $data);
                $insertId = $this->db->insert_id();
                $data["id"] = $insertId;
                $data = json_encode($data);
                $this->logs->log = "Created Product Series - ID:". $insertId .", Product Name: ".$this->product_name ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "products";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();
        }

        public function update_products()
        {
                $data["product_name"] = $this->product_name ; 
                $data["product_description"] = $this->product_description;
                $data["date_modified"] = date("Y-m-d H:i:s A");
                $data["product_vendor_id"] = $this->product_vendor_id;
                $data["product_series_id"] = $this->product_series_id;
                $data["product_category_id"] = $this->product_category_id;
                $data["specification"] = $this->specification;
                $data["visibility"] = $this->visibility;
                $data["status"] = $this->status;
                if($this->product_image != null)
                {
                     $data["product_image"] = $this->product_image;
                }
                if($this->product_sub_image != null)
                {
                     $data["product_sub_image"] = $this->product_sub_image;
                }
                if($this->pdf != null)
                {
                     $data["pdf"] = $this->pdf;
                }
                if($this->mds != null)
                {
                     $data["mds"] = $this->mds;
                }
                $data["modified_by"] =  $this->session->userdata("USERID");
                $this->db->where("id",$this->id);
                echo $result = $this->db->update('products', $data);
                
                
                $data["id"] = $this->id;
                $data = json_encode($data);
                $this->logs->log = "Updated Product Series - ID:". $this->id .", Product Name: ".$this->product_name ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "products";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();

        }

}

?>
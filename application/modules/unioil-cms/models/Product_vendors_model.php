<?php

class Product_vendors_model extends CI_Model {
    
        public $id;
        public $vendor_name;
        public $vendor_description;
        public $vendor_image;

        public function insert_product_vendor()
        {
                $data["vendor_name"] = $this->vendor_name ; 
                $data["vendor_description"] = $this->vendor_description;
                $data["date_created"] = date("Y-m-d H:i:s A");
                $data["vendor_image"] = $this->vendor_image;
                $data["created_by"] =  $this->session->userdata("USERID");
                echo $result = $this->db->insert('product_vendors', $data);
                $insertId = $this->db->insert_id();
                $data["id"] = $insertId;
                $data = json_encode($data);
                $this->logs->log = "Created Product Vendor - ID:". $insertId .", Product Vendor Name: ".$this->vendor_name ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "product_vendors";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();
        }

        public function update_product_vendor()
        {
                $data["vendor_name"] = $this->vendor_name ; 
                $data["vendor_description"] = $this->vendor_description;
                $data["date_modified"] = date("Y-m-d H:i:s A");
                if($this->vendor_image != null)
                {
                     $data["vendor_image"] = $this->vendor_image;
                }
                $data["modified_by"] =  $this->session->userdata("USERID");
                $this->db->where("id",$this->id);
                echo $result = $this->db->update('product_vendors', $data);
                
                
                $data["id"] = $this->id;
                $data = json_encode($data);
                $this->logs->log = "Updated Product Vendor - ID:". $this->id .", Product Vendor Name: ".$this->vendor_name ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "product_vendors";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();

        }

}

?>
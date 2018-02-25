<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_vendors extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();   
        $this->load->model("unioil-cms/product_vendors_model"); 
        
        if($this->session->userdata("USERID") == null)
        {
                echo "Sorry you are not logged in";
                die();
        }
    }

	public function add_product_vendors()
	{
        $this->product_vendors_model->vendor_name = $this->input->post("vendor_name");
        $this->product_vendors_model->vendor_description = $this->input->post("vendor_description");
        $this->product_vendors_model->vendor_image = $this->input->post("vendor_image");
        echo $this->product_vendors_model->insert_product_vendor();
	}

	public function edit_product_vendors()
	{
        $product_vendors_id = $this->input->post("id");
        $this->product_vendors_model->vendor_image = $this->input->post("vendor_image");
        $this->product_vendors_model->vendor_name = $this->input->post("vendor_name");
        $this->product_vendors_model->vendor_description = $this->input->post("vendor_description");
        $this->product_vendors_model->id = $product_vendors_id;
        echo $this->product_vendors_model->update_product_vendor();
	}

	public function delete_product_vendors()
	{
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $data_product_vendors = $this->db->get("product_vendors");
        $this->db->where("id",$id);
        echo $result = $this->db->delete("product_vendors");
        $data = json_encode($data_product_vendors->row());
        $this->logs->log = "Deleted Product Vendor - ID:". $data_product_vendors->row()->id .", Product Vendor Name: ".$data_product_vendors->row()->vendor_name ;
        $this->logs->details = json_encode($data);
        $this->logs->module = "product_vendors";
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
        
	}

    public function get_product_vendor_data()
    {
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $result = $this->db->get("product_vendors");
        $product_vendors = $result->row();
        if($product_vendors->vendor_image != null)
        {
            if(is_numeric( $product_vendors->vendor_image ))
            {
                $product_vendors->vendor_image_id = $product_vendors->vendor_image;
                $product_vendors->vendor_image = $this->db->where("id",$product_vendors->vendor_image)->get("media")->row()->file_name;
            }
        }
        $return["product_vendors"] = $product_vendors;
        echo json_encode($return); 
    }

    public function get_product_vendors_list()
    {
        $this->load->model("unioil-cms/data_table_model","dt_model");  
        $this->dt_model->select_columns = array("t1.id","t1.vendor_name","t4.file_name as vendor_image","t1.date_created","t2.username as created_by","t1.date_modified","t3.username as modified_by");  
        $this->dt_model->where  = array("t1.id","t1.vendor_name","t4.file_name","t1.date_created","t2.username","t1.date_modified","t3.username");  
        $select_columns = array("id","vendor_name","vendor_image","date_created","created_by","date_modified","modified_by");  
        $this->dt_model->table = "product_vendors AS t1 LEFT JOIN user_accounts AS t2 ON t2.id = t1.created_by LEFT JOIN user_accounts AS t3 ON t3.id = t1.modified_by LEFT JOIN media as t4 on t4.id = t1.vendor_image";  
        $this->dt_model->index_column = "t1.id";
        $result = $this->dt_model->get_table_list();
        $output = $result["output"];
        $rResult = $result["rResult"];
        $aColumns = $result["aColumns"];
        foreach ($rResult->result_array() as $aRow) {
            $row = array();
            foreach ($select_columns as $col) {
                    if($col == "username" || $col == "created_by" || $col == "modified_by")
                    {
                        $row[] = $aRow[$col];
                    }
                    else if($col == "vendor_image")
                    {
                        $row[] = "<a href=\"#\" onclick='return false;'><img class='img-thumbnail' src='".base_url()."uploads/product_vendors/".$aRow[$col]."' style='height:70px;' onclick='img_preview(\"".$aRow[$col]."\");return false;'></a>";
                    }
                    else
                    {
                        $row[] = ucfirst( $aRow[$col] );
                    }
            }
            
            $btns = '<!--<a href="#" onclick="_view('.$aRow['id'].');return false;" class="glyphicon glyphicon-search text-orange" data-toggle="tooltip" title="View Details"></a>-->
            <a href="#" onclick="_edit('.$aRow['id'].');return false;" class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" title="Edit"></a>
            <a href="#" onclick="_delete('.$aRow['id'].',\''.$aRow["vendor_name"].'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" title="Delete"></a>';
            array_push($row,$btns);
            $output['data'][] = $row;
        }
        echo json_encode( $output );
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_categories extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();   
        $this->load->model("cms/product_categories_model"); 
        
        if($this->session->userdata("USERID") == null)
        {
                echo "Sorry you are not logged in";
                die();
        }
    }

	public function add_product_category()
	{
        $this->product_categories_model->category_name = $this->input->post("category_name");
        $this->product_categories_model->category_description = $this->input->post("category_description");
        echo $this->product_categories_model->insert_product_category();
	}

	public function edit_product_category()
	{
        $products_id = $this->input->post("id");
        $this->product_categories_model->category_name = $this->input->post("category_name");
        $this->product_categories_model->category_description = $this->input->post("category_description");
        $this->product_categories_model->id = $products_id;
        echo $this->product_categories_model->update_product_category();
	}

	public function delete_product_category()
	{
        
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $data_product_category = $this->db->get("product_categories");
        $this->db->where("id",$id);
        echo $result = $this->db->delete("product_categories");
        $data = json_encode($data_product_category->row());
        $this->logs->log = "Deleted Products - ID:". $this->id .", Products Category: ".$data_product_category->row()->category_name ;
        $this->logs->details = json_encode($data);
        $this->logs->module = "product_categories";
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
        
	}

    public function get_product_category_data()
    {
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $result = $this->db->get("product_categories");
        $product_category = $result->row();
        $return["product_category"] = $product_category;
        echo json_encode($return); 
    }

    public function get_product_category_list()
    {
        $this->load->model("cms/data_table_model","dt_model");  
        $this->dt_model->select_columns = array("t1.id","t1.category_name","t1.category_description","t1.date_created","t2.username as created_by","t1.date_modified","t3.username as modified_by");  
        $this->dt_model->where  = array("t1.id","t1.category_name","t1.category_description","t1.date_created","t2.username","t1.date_modified","t3.username");  
        $select_columns = array("id","category_name","category_description","date_created","created_by","date_modified","modified_by");  
        $this->dt_model->table = "product_categories AS t1 LEFT JOIN user_accounts AS t2 ON t2.id = t1.created_by LEFT JOIN user_accounts AS t3 ON t3.id = t1.modified_by";  
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
                    else
                    {
                        $row[] = ucfirst( $aRow[$col] );
                    }
            }
            
            $btns = '<!--<a href="#" onclick="_view('.$aRow['id'].');return false;" class="glyphicon glyphicon-search text-orange" data-toggle="tooltip" title="View Details"></a>-->
            <a href="#" onclick="_edit('.$aRow['id'].');return false;" class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" title="Edit"></a>
            <a href="#" onclick="_delete('.$aRow['id'].',\''.$aRow["category_name"].'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" title="Delete"></a>';
            array_push($row,$btns);
            $output['data'][] = $row;
        }
        echo json_encode( $output );
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();   
        $this->load->model("cms/products_model"); 
        
        if($this->session->userdata("USERID") == null)
        {
                echo "Sorry you are not logged in";
                die();
        }
    }

	public function add_products()
	{
        $upload_path = './uploads/products/'; 
        $upload_path = './uploads/products/'; 
        if (!empty($_FILES['pdf']['name']))
        {
            $config_pdf['upload_path'] = $upload_path;  
            $config_pdf['allowed_types'] = 'pdf';  
            $new_filename_pdf = str_replace(" ","_",$this->input->post("product_name"))."_inner_".date("YmdHisU");
            $config_pdf['file_name']= $new_filename_pdf ;
            $this->load->library('upload', $config_pdf); 
            if(!$this->upload->do_upload('pdf',$new_filename_pdf))  
            {  
                echo $this->upload->display_errors(); 
                die(); 
            }else{
                $data_pdf = $this->upload->data();
                $this->products_model->pdf = $data_pdf["file_name"];
            }
        }
        
        $this->products_model->product_sub_image = $this->input->post("product_sub_image");
        $this->products_model->product_image = $this->input->post("product_image");
        $this->products_model->product_vendor_id = $this->input->post("vendor_id");
        $this->products_model->product_category_id = $this->input->post("product_category_id");
        if($this->input->post("product_series_id") != "None")
        {
            $this->products_model->product_series_id = $this->input->post("product_series_id");
        }
        $this->products_model->product_name = $this->input->post("product_name");
        $this->products_model->specification = $this->input->post("specification");
        $this->products_model->product_description = $this->input->post("product_description");
        $this->products_model->visibility = $this->input->post("visibility");
        echo $this->products_model->insert_products();

		
	}

	public function edit_products()
	{
        $products_id = $this->input->post("id");
       
        $this->products_model->product_sub_image = $this->input->post("product_sub_image");
        $this->products_model->product_image = $this->input->post("product_image");
       
        $upload_path = './uploads/products/'; 
        if (!empty($_FILES['pdf']['name']))
        {
            $config_pdf['upload_path'] = $upload_path;  
            $config_pdf['allowed_types'] = 'pdf';  
            $new_filename_pdf = str_replace(" ","_",$this->input->post("product_name"))."_pdf_".date("YmdHisU");
            $config_pdf['file_name']= $new_filename_pdf ;
            $this->load->library('upload', $config_pdf); 
            if(!$this->upload->do_upload('pdf',$new_filename_pdf))  
            {  
                echo $this->upload->display_errors(); 
                die(); 
            }else{
                $data_pdf = $this->upload->data();
                $this->products_model->pdf = $data_pdf["file_name"];
            }
        }

        $this->products_model->product_vendor_id = $this->input->post("vendor_id");
        $this->products_model->product_category_id = $this->input->post("product_category_id");
        $this->products_model->product_name = $this->input->post("product_name"); 
        $this->products_model->visibility = $this->input->post("visibility");
        if($this->input->post("product_series_id") != "None")
        {
            $this->products_model->product_series_id = $this->input->post("product_series_id");
        }
        $this->products_model->specification = $this->input->post("specification");
        $this->products_model->product_description = $this->input->post("product_description");
        $this->products_model->id = $products_id;
        echo $this->products_model->update_products();
	}

	public function delete_products()
	{
        
        $dir = './uploads/products/'; 
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $data_products = $this->db->get("products");
        $this->db->where("id",$id);
        echo $result = $this->db->delete("products");
        unlink($dir.$data_products->row()->pdf);
        $data = json_encode($data_products->row());
        $this->logs->log = "Deleted Products - ID:". $data_products->row()->id .", Products Name: ".$data_products->row()->product_name ;
        $this->logs->details = json_encode($data);
        $this->logs->module = "products";
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
        
	}

    public function get_products_data()
    {
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $result = $this->db->get("products");
        $products = $result->row();
        if($products->product_sub_image != null)
        {
            if(is_numeric( $products->product_sub_image ))
            {
                $products->product_sub_image_id = $products->product_sub_image;
                $products->product_sub_image = $this->db->where("id",$products->product_sub_image)->get("media")->row()->file_name;
            }
        }
        if($products->product_image != null)
        {
            if(is_numeric( $products->product_image ))
            {
                $products->product_image_id = $products->product_image;
                $products->product_image = $this->db->where("id",$products->product_image)->get("media")->row()->file_name;
            }
        }
        $return["products"] = $products;
        echo json_encode($return); 
    }

    public function get_products_list()
    {
        $this->load->model("cms/data_table_model","dt_model");  
        $this->dt_model->select_columns = array("t1.id","t1.product_name","t7.file_name as product_image","t8.file_name as product_sub_image","t4.category_name","t6.series_name","t5.vendor_name","t1.date_created","t2.username as created_by","t1.date_modified","t3.username as modified_by");  
        $this->dt_model->where  = array("t1.id","t1.product_name","t7.file_name","t8.file_name","t4.category_name","t6.series_name","t5.vendor_name","t1.date_created","t2.username","t1.date_modified","t3.username");  
        $select_columns = array("id","product_name","product_image","product_sub_image","category_name","series_name","vendor_name","date_created","created_by","date_modified","modified_by");  
        $this->dt_model->table = "products AS t1 LEFT JOIN user_accounts AS t2 ON t2.id = t1.created_by LEFT JOIN user_accounts AS t3 ON t3.id = t1.modified_by LEFT JOIN product_categories AS t4 ON t4.id = t1.product_category_id  LEFT JOIN product_vendors AS t5 ON t5.id = t1.product_vendor_id  LEFT JOIN product_series AS t6 ON t6.id = t1.product_series_id LEFT JOIN media as t7 ON t7.id = t1.product_image LEFT JOIN media as t8 ON t8.id = t1.product_sub_image ";  
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
                    else if($col == "series_name")
                    {
                        if($aRow[$col] == "" || $aRow[$col] == null)
                        {
                            $row[] = "None";
                        }
                        else
                        {
                            
                            $row[] = $aRow[$col];
                        }
                    }
                    else if($col == "visibility")
                    { 
                            $row[] = ucwords(str_replace("_"," ",$aRow[$col]));
                    }
                    else if($col == "product_image" || $col == "product_sub_image")
                    { 
                        if($aRow[$col] != null || $aRow[$col] != "")
                        {  
                            $row[] = "<a href=\"#\" onclick='return false;'><img class='img-thumbnail' src='".base_url()."uploads/products/".$aRow[$col]."' style='height:70px;' onclick='img_preview(\"".$aRow[$col]."\")'></a>";
                        }
                        else
                        {
                            $row[] = "None";
                        }
                    }
                    else
                    {
                        $row[] = ucfirst( $aRow[$col] );
                    }
            }
            
            $btns = '<!--<a href="#" onclick="_view('.$aRow['id'].');return false;" class="glyphicon glyphicon-search text-orange" data-toggle="tooltip" title="View Details"></a>-->
            <a href="#" onclick="_edit('.$aRow['id'].');return false;" class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" title="Edit"></a>
            <a href="#" onclick="_delete('.$aRow['id'].',\''.$aRow["product_name"].'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" title="Delete"></a>';
            array_push($row,$btns);
            $output['data'][] = $row;
        }
        echo json_encode( $output );
    }

    public function get_product_series()
    {
        $vendor_id = $this->input->post("vendor_id");
        $product_category_id = $this->input->post("product_category_id");
        $this->db->where("vendor_id",$vendor_id);
        $this->db->where("product_category_id",$product_category_id);
        $result = $this->db->order_by("series_name")->get("product_series");
        $return = "";
        $return .= "<option value='None'>None</option>";
        if($result->result() != null)
        {
            foreach($result->result() as $row){
                $return .= "<option value='".$row->id."'>".ucfirst($row->series_name)."</option>";
            }
        }
        echo $return;
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Careers extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();   
        $this->load->model("cms/loyalty_model"); 
        
        if($this->session->userdata("USERID") == null)
        {
                echo "Sorry you are not logged in";
                die();
        }
    }

	public function add_loyalty()
	{
        $this->loyalty_model->job_title = $this->input->post("job_title");
        $this->loyalty_model->job_description = $this->input->post("job_description");
        echo $this->loyalty_model->insert_loyalty();
	}

	public function edit_loyalty()
	{
        $products_id = $this->input->post("id");
        $this->loyalty_model->job_title = $this->input->post("job_title");
        $this->loyalty_model->job_description = $this->input->post("job_description");
        $this->loyalty_model->id = $products_id;
        echo $this->loyalty_model->update_loyalty();
	}

	public function delete_loyalty()
	{
        
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $data_loyalty = $this->db->get("loyalty");
        $this->db->where("id",$id);
        echo $result = $this->db->delete("loyalty");
        $data = json_encode($data_loyalty->row());
        $this->logs->log = "Deleted Products - ID:". $this->id .", Products Category: ".$data_loyalty->row()->job_title ;
        $this->logs->details = json_encode($data);
        $this->logs->module = "loyalty";
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
        
	}

    public function get_loyalty_data()
    {
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $result = $this->db->get("loyalty");
        $loyalty = $result->row();
        $return["loyalty"] = $loyalty;
        echo json_encode($return); 
    }

    public function get_loyalty_list()
    {
        $this->load->model("cms/data_table_model","dt_model");  
        $this->dt_model->select_columns = array("t1.id","t1.job_title","t1.job_description","t1.date_created","t2.username as created_by","t1.date_modified","t3.username as modified_by");  
        $this->dt_model->where  = array("t1.id","t1.job_title","t1.job_description","t1.date_created","t2.username","t1.date_modified","t3.username");  
        $select_columns = array("id","job_title","job_description","date_created","created_by","date_modified","modified_by");  
        $this->dt_model->table = "loyalty AS t1 LEFT JOIN user_accounts AS t2 ON t2.id = t1.created_by LEFT JOIN user_accounts AS t3 ON t3.id = t1.modified_by";  
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
            <a href="#" onclick="_delete('.$aRow['id'].',\''.$aRow["job_title"].'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" title="Delete"></a>';
            array_push($row,$btns);
            $output['data'][] = $row;
        }
        echo json_encode( $output );
    }
}
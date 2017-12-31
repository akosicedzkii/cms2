<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branches extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();   
        $this->load->model("cms/branches_model"); 
        
        if($this->session->userdata("USERID") == null)
        {
                echo "Sorry you are not logged in";
                die();
        }
    }

	public function add_branch()
	{
        $this->branches_model->branch_name = $this->input->post("branch_name");
        $this->branches_model->details = $this->input->post("details");
        $this->branches_model->id = $this->input->post("id");
        echo $this->branches_model->insert_branch(); 
		
	}

	public function edit_branch()
	{
        $this->branches_model->branch_name = $this->input->post("branch_name");
        $this->branches_model->details = $this->input->post("details");
        $this->branches_model->id = $this->input->post("id");
        echo $this->branches_model->update_branch(); 
	}

	public function delete_branch()
	{
        
        $id = $this->input->post("id");
        $this->db->where("branch_id",$id);
        $this->db->delete("stations");
        $this->db->where("id",$id);
        $data_branches = $this->db->get("branches");
        $this->db->where("id",$id);
        echo $result = $this->db->delete("branches");
        $data = json_encode($data_branches->row());
        $this->logs->log = "Deleted Branch: ". $data ." Station: " . $data_station . " Fuel Prices: " . $data_fuel_price;
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
        
	}

    public function get_branches_data()
    {
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $result = $this->db->get("branches");
        $branches = $result->row();
        $return["branches"] = $branches;
        echo json_encode($return); 
    }

    public function get_branches_list()
    {
        $this->load->model("cms/data_table_model","dt_model");  
        $this->dt_model->select_columns = array("t1.id","t1.branch_name","t1.details","t1.date_created","t2.username as created_by","t1.date_modified","t3.username as modified_by");  
        $this->dt_model->where  = array("t1.id","t1.branch_name","t1.details","t1.date_created","t2.username","t1.date_modified","t3.username");  
        $select_columns = array("id","branch_name","details","date_created","created_by","date_modified","modified_by");  
        $this->dt_model->table = "branches AS t1 LEFT JOIN user_accounts AS t2 ON t2.id = t1.created_by LEFT JOIN user_accounts AS t3 ON t3.id = t1.modified_by";  
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
            <a href="#" onclick="_delete('.$aRow['id'].',\''.$aRow["branch_name"].'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" title="Delete"></a>';
            array_push($row,$btns);
            $output['data'][] = $row;
        }
        echo json_encode( $output );
    }
}

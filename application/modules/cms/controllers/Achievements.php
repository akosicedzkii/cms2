<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Achievements extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();   
        $this->load->model("cms/achievements_model"); 
        
        if($this->session->userdata("USERID") == null)
        {
                echo "Sorry you are not logged in";
                die();
        }
    }

	public function add_achievement()
	{
        $this->achievements_model->year = $this->input->post("year");
        $this->achievements_model->achievement = $this->input->post("achievement");
        echo $this->achievements_model->insert_achievement();
	}

	public function edit_achievement()
	{
        $achievement_id = $this->input->post("id");
        $this->achievements_model->year = $this->input->post("year");
        $this->achievements_model->achievement = $this->input->post("achievement");
        $this->achievements_model->id = $achievement_id;
        echo $this->achievements_model->update_achievement();
	}

	public function delete_achievement()
	{
        
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $data_achievement = $this->db->get("achievements");
        $this->db->where("id",$id);
        echo $result = $this->db->delete("achievements");
        $data = json_encode($data_achievement->row());
        $this->logs->log = "Deleted Products - ID:". $this->id .", Products Category: ".$data_achievement->row()->year ;
        $this->logs->details = json_encode($data);
        $this->logs->module = "achievements";
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
        
	}

    public function get_achievement_data()
    {
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $result = $this->db->get("achievements");
        $achievement = $result->row();
        $return["achievement"] = $achievement;
        echo json_encode($return); 
    }

    public function get_achievement_list()
    {
        $this->load->model("cms/data_table_model","dt_model");  
        $this->dt_model->select_columns = array("t1.id","t1.year","t1.achievement","t1.date_created","t2.username as created_by","t1.date_modified","t3.username as modified_by");  
        $this->dt_model->where  = array("t1.id","t1.year","t1.achievement","t1.date_created","t2.username","t1.date_modified","t3.username");  
        $select_columns = array("id","year","achievement","date_created","created_by","date_modified","modified_by");  
        $this->dt_model->table = "achievements AS t1 LEFT JOIN user_accounts AS t2 ON t2.id = t1.created_by LEFT JOIN user_accounts AS t3 ON t3.id = t1.modified_by";  
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
            <a href="#" onclick="_delete('.$aRow['id'].',\''.$aRow["year"].'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" title="Delete"></a>';
            array_push($row,$btns);
            $output['data'][] = $row;
        }
        echo json_encode( $output );
    }
}

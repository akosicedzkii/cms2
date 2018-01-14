<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();   
        
        if($this->session->userdata("USERID") == null)
        {
                echo "Sorry you are not logged in";
                die();
        }
    }

	
    public function get_logs_list()
    {
        $this->load->model("cms/data_table_model","dt_model");  
        $this->dt_model->select_columns = array("t1.id","t1.log","t1.date_created","t2.username as created_by");  
        $this->dt_model->where  = array("t1.id","t1.log","t1.date_created","t2.username");  
        $select_columns = array("id","log","date_created","created_by");  
        $this->dt_model->table = "logs AS t1 LEFT JOIN user_accounts AS t2 ON t2.id = t1.created_by";  
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
            $output['data'][] = $row;
        }
        echo json_encode( $output );
    }

    public function delete_all_logs()
	{
        $action = $this->input->post("action");
        if($action == "delete")
        {
            echo $result = $this->db->truncate("logs");
            $this->logs->log = "Deleted All Logs" ;
            $this->logs->created_by = $this->session->userdata("USERID");
            $this->logs->insert_log();
        }
        
	}
}

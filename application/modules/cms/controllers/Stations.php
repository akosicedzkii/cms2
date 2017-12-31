<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stations extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();   
        $this->load->model("cms/stations_model"); 
        
        if($this->session->userdata("USERID") == null)
        {
                echo "Sorry you are not logged in";
                die();
        }
    }

	public function add_station()
	{
        $this->stations_model->station_name = $this->input->post("station_name");
        $this->stations_model->map_url = $this->input->post("map_url");
        $this->stations_model->id = $this->input->post("id");
        $this->stations_model->branch_id = $this->input->post("branch_id");
        echo $this->stations_model->insert_station($this->input->post("fuel_price")); 
		
	}

	public function edit_station()
	{
        $this->stations_model->station_name = $this->input->post("station_name");
        $this->stations_model->map_url = $this->input->post("map_url");
        $this->stations_model->id = $this->input->post("id");
        $this->stations_model->branch_id = $this->input->post("branch_id");
        echo $this->stations_model->update_station($this->input->post("fuel_price")); 
	}

	public function delete_station()
	{
        
        $id = $this->input->post("id");
        $this->db->where("station_id",$id);
        $this->db->delete("stations_fuel_prices");
        $this->db->where("id",$id);
        $data_stations = $this->db->get("stations");
        $this->db->where("id",$id);
        echo $result = $this->db->delete("stations");
        $data = json_encode($data_stations->row());
        $this->logs->log = "Deleted Stations: ". $data ;
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
        
	}

    public function get_stations_data()
    {
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $result = $this->db->get("stations");
        $stations = $result->row();
        $this->db->where("station_id",$id);
        $this->db->select("fuel_id,price");
        $result = $this->db->get("stations_fuel_prices");
        $stations_fuel_prices = $result->result();
        $return["stations"] = $stations;
        $return["stations_fuel_prices"] = json_encode($stations_fuel_prices);
        echo json_encode($return); 
    }

    public function get_stations_list()
    {
        $this->load->model("cms/data_table_model","dt_model");  
        $this->dt_model->select_columns = array("t1.id","t1.station_name","t4.branch_name","t1.date_created","t2.username as created_by","t1.date_modified","t3.username as modified_by");  
        $this->dt_model->where  = array("t1.id","t1.station_name","t4.branch_name","t1.date_created","t2.username","t1.date_modified","t3.username");  
        $select_columns = array("id","station_name","branch_name","date_created","created_by","date_modified","modified_by");  
        $this->dt_model->table = "stations AS t1 LEFT JOIN user_accounts AS t2 ON t2.id = t1.created_by LEFT JOIN user_accounts AS t3 ON t3.id = t1.modified_by LEFT JOIN branches as t4 ON t4.id = t1.branch_id";  
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
            <a href="#" onclick="_delete('.$aRow['id'].',\''.$aRow["station_name"].'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" title="Delete"></a>';
            array_push($row,$btns);
            $output['data'][] = $row;
        }
        echo json_encode( $output );
    }
}

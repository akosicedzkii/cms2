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
        $this->stations_model->contact_number = $this->input->post("contact_number");
        $this->stations_model->map_url = $this->input->post("map_url");
        $this->stations_model->id = $this->input->post("id");
        $this->stations_model->branch_id = $this->input->post("branch_id");
        echo $this->stations_model->insert_station($this->input->post("fuel_price")); 
		
	}

	public function edit_station()
	{
        $this->stations_model->station_name = $this->input->post("station_name");
        $this->stations_model->map_url = $this->input->post("map_url");
        $this->stations_model->contact_number = $this->input->post("contact_number");
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
        $this->logs->log = "Deleted Station - ID:". $data_stations->row()->id .", Station Name: ".$data_stations->row()->station_name ;
        $this->logs->details = json_encode($data);
        $this->logs->module = "stations";
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
        $this->dt_model->select_columns = array("t1.id","t1.map_url","t1.station_name","t4.branch_name","t1.date_created","t2.username as created_by","t1.date_modified","t3.username as modified_by");  
        $this->dt_model->where  = array("t1.id","t1.map_url","t1.station_name","t4.branch_name","t1.date_created","t2.username","t1.date_modified","t3.username");  
        $select_columns = array("id","map_url","station_name","branch_name","date_created","created_by","date_modified","modified_by");  
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
            
            $btns = '<a href="#" onclick="_showMap(\''.$aRow['map_url'].'\');return false;" class="glyphicon glyphicon-map-marker text-orange" data-toggle="tooltip" title="View Map"></a>
            <a href="#" onclick="_edit('.$aRow['id'].');return false;" class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" title="Edit"></a>
            <a href="#" onclick="_delete('.$aRow['id'].',\''.$aRow["station_name"].'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" title="Delete"></a>';
            array_push($row,$btns);
            $output['data'][] = $row;
        }
        echo json_encode( $output );
    }

    public function download_station_prices()
    {
            header('Content-type: text/csv');
            header('Content-Disposition: attachment; filename="station_prices.csv"');
            
            // do not cache the file
            header('Pragma: no-cache');
            header('Expires: 0');
            
            // create a file pointer connected to the output stream
            $file = fopen('php://output', 'w');
            $sql = "SELECT t1.id,t1.station_name,t2.branch_name FROM stations as t1 LEFT JOIN branches as t2 on t2.id = t1.branch_id";
            $stations = $this->db->query($sql)->result();


            // send the column headers
            $headers = array('Station Name', 'Branch Name');
            
            $query = "SELECT * from products where product_category_id = 1 AND (visibility = 'price_only' OR visibility = 'price_and_promotion')";
            $result = $this->db->query($query)->result();
            if($result != null)
            {
                foreach($result as $row)
                {
                    array_push($headers,$row->product_name);
                }
            }
            fputcsv($file, $headers);
            $data = array();
            if($stations != null)
            {
                foreach($stations as $row)
                {
                    $arr_push = array($row->station_name,$row->branch_name);

                    foreach($result as $row_fuel)
                    {
                        $this->db->where("station_id",$row->id);
                        $this->db->where("fuel_id",$row_fuel->id);
                        $fuel_price_query = $this->db->get("stations_fuel_prices");
                        $price = "00.00";
                        if($fuel_price_query->row() != null)
                        {	
                            $price = $fuel_price_query->row()->price;
                        }
                        array_push($arr_push,$price);
                    }
                    array_push($data,$arr_push);
                }
            }
            
            // output each row of the data
            foreach ($data as $row)
            {
            fputcsv($file, $row);
            }
            
            $this->logs->log = "Downloaded Pricelist";
            $this->logs->module = "stations";
            $this->logs->created_by = $this->session->userdata("USERID");
            $this->logs->insert_log();
            exit();
    }

    public function upload_prices()
    {
        if(isset($_FILES["pricelist"]["name"]))  
        {  
            
           $upload_path = './uploads/pricelist/'; 
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
            } 
            $config['upload_path'] = $upload_path;  
            $config['allowed_types'] = 'csv';  
            $new_filename = "price_list_".date("YmdHisU");
            $config['file_name']= $new_filename ;
            $this->load->library('upload', $config); 
            if(!$this->upload->do_upload('pricelist',$new_filename))  
            {  
                echo $this->upload->display_errors(); 
                die(); 
            }  
            else  
            {  
                $data = $this->upload->data();
                $fileHandle = fopen($upload_path.$data["file_name"], "r");
 
                //Loop through the CSV rows.
                $counter = 0;
                $header = array();
                while (($row = fgetcsv($fileHandle, 0, ",")) !== FALSE) {
                    //Dump out the row for the sake of clarity.
                    
                    $column_count = count($row);
                    if($counter == 0)
                    {
                        $header = $row;
                    }
                    else
                    {
                        $this->db->select("id");
                        $this->db->where("branch_name",$row[1]);
                        $branch = $this->db->get("branches")->row();
                        if($branch == null)
                        {
                            echo "Error! Please check file uploaded";
                            die();
                        }
                        $this->db->select("id");
                        $this->db->where("station_name",$row[0]);
                        $this->db->where("branch_id",$branch->id);
                        $station = $this->db->get("stations")->row();
                        if($station == null)
                        {
                            echo "Error! Please check file uploaded";
                            die();
                        }
                        $fuel_prices =  2;///removed 2 columns
                        $this->db->where("station_id",$station->id);
                        $this->db->delete("stations_fuel_prices");
                        while($column_count != $fuel_prices)
                        {
                            $fuel = $this->db->select("id")->where("product_name",$header[$fuel_prices])->get("products")->row();
                            $data_prices["fuel_id"] = $fuel->id;
                            $data_prices["station_id"] = $station->id;
                            $data_prices["price"] = $row[$fuel_prices];
                            $this->db->insert("stations_fuel_prices",$data_prices);
                            $fuel_prices++;
                        }
                    }
                    $counter++;
                }
                $this->logs->log = "Uploaded New Pricelist: <a href='".base_url("uploads/pricelist/").$data["file_name"]."' download>Download</a>";
                $this->logs->module = "stations";
                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();
                echo true;
            }  
        }  
		
    }
}

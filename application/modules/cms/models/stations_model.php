<?php

class Stations_model extends CI_Model {
    
        public $id;
        public $station_name;
        public $map_url;
        public $branch_id;

        public function insert_station($fuel_price)
        {
            $fuel_price = rtrim($fuel_price,"__");
            $fuel_price = explode("__",$fuel_price);

            $data["station_name"] = $this->station_name; 
            $data["map_url"] = $this->map_url; 
            $data["branch_id"] = $this->branch_id; 
            $data["date_created"] = date("Y-m-d h:i:s A");
            $data["created_by"] =  $this->session->userdata("USERID");
            $result = $this->db->insert('stations', $data);
            $data = json_encode($data);
            $data_fuel_log = array();
            
            $insertId = $this->db->insert_id();

            foreach($fuel_price as $row)
            {
                $fuel = explode("||",$row);
                if(count($fuel) != 1)
                {
                    $data_fuel["station_id"] = $insertId;
                    $data_fuel["fuel_id"] = str_replace("fuel_","",$fuel[0]);
                    $data_fuel["price"] = $fuel[1];
                    $result = $this->db->insert('stations_fuel_prices', $data_fuel);
                    array_push($data_fuel_log,$data_fuel);
                }
            }
            echo $result;
            $this->logs->log = "Created Store: ". $data ." Fuel Prices: ". json_encode($data_fuel_log );
            $this->logs->created_by = $this->session->userdata("USERID");
            $this->logs->insert_log();
        }

        public function update_station($fuel_price)
        {
            $fuel_price = rtrim($fuel_price,"__");
            $fuel_price = explode("__",$fuel_price);

            $data["station_name"] = $this->station_name; 
            $data["map_url"] = $this->map_url; 
            $data["branch_id"] = $this->branch_id; 
            $data["date_modified"] = date("Y-m-d h:i:s A");
            $data["modified_by"] =  $this->session->userdata("USERID");
            $this->db->where("id",$this->id);
            $result = $this->db->update('stations', $data);
            $data = json_encode($data);
            $data_fuel_log = array();
            
            $this->db->where("station_id",$this->id);
            $this->db->delete("stations_fuel_prices");
            foreach($fuel_price as $row)
            {
                $fuel = explode("||",$row);
                if(count($fuel) != 1)
                {
                    $data_fuel["station_id"] = $this->id;
                    $data_fuel["fuel_id"] = str_replace("fuel_","",$fuel[0]);
                    $data_fuel["price"] = $fuel[1];
                    $this->db->insert('stations_fuel_prices', $data_fuel);
                    array_push($data_fuel_log,$data_fuel);
                }
            }
            $this->logs->log = "Updated Store: ". $data ." Fuel Prices: ". json_encode($data_fuel_log );
            $this->logs->created_by = $this->session->userdata("USERID");
            $this->logs->insert_log();
        }

}

?>
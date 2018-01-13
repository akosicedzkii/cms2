<?php

class Visitor_counter_model extends CI_Model {
    
        public function insert_visitor()
        {
                $externalContent = file_get_contents('http://checkip.dyndns.com/');
                preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', $externalContent, $m);
                $externalIp = $m[1];

                $this->db->where("ip_address",$externalIp);
                $this->db->where("date_created",date("Y-m-d"));
                $result = $this->db->get("visit_counts")->row();
                if($result == null){
                    $data["ip_address"] = $externalIp;

                    
                    $url = "http://freegeoip.net/json/{$externalIp}";
                    $ch  = curl_init();
                    
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                    $data_curl = curl_exec($ch);
                    curl_close($ch);
                    $data_curl = json_decode($data_curl,true) ;
                    $data["lat"] =  $data_curl["latitude"];
                    $data["long"] = $data_curl["longitude"];
                    $data["time"] = date("Y-m-d H:i:s A");
                    $data["date_created"] = date("Y-m-d");
                    $data["country"] = $data_curl["country_name"];
                    $this->db->insert("visit_counts",$data);
                }
        }
}


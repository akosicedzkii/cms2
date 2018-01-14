<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();  
    }
	public function index()
	{
		$this->v_counter->insert_visitor();   
		$data["module_name"] = strtolower($this->router->fetch_class());
		$data["title"] = "HOME - Unioil";
		$data["banners"] = $this->db->where("status","1")->order_by("date_created","asc")->get("banners")->result();
		$data["mid_banners"] = $this->db->where("status","1")->order_by("date_created","asc")->get("mid_banners")->result();
		$this->load->view('template/header.php',$data);
		$this->load->view('home_view');
		$this->load->view('template/footer.php',$data);
	}
	
	
    public function get_all_station()
    {
        $branch = $this->db->get("branches");

		$test = array();
		$return = "{";
        foreach($branch->result() as $row)
        {
            $return .= '"'.strtolower(str_replace(" ","",$row->branch_name)).'" : {';
				$return .= '"name" : "'.$row->branch_name.'",';
					$return .= '"branches" : {';
						$this->db->where("branch_id",$row->id);
						$stations = $this->db->get("stations");
						$return_station = ""; 
							foreach($stations->result() as $row_stations)
							{
								$return_station .= '"'.strtolower(str_replace(" ","",$row_stations->station_name)).'" : {';
									$return_station .= '"name" : "'.ucwords($row_stations->station_name).'",';
									$return_station .= '"map-url" : "'.$row_stations->map_url.'"';
								$return_station .= '},';
							}
							$return_station = rtrim($return_station,",") . "}";
							$return .= $return_station.'},';
						
        }
		$return = rtrim($return,",") . "}";
		echo json_encode($return,true);
	}
	
	public function get_gas_price()
	{
		$store_name = $this->input->post("station_name");
		$branch_name = $this->input->post("branch_name");
		$query = "SELECT t1.id as station_id,t2.id as branch_id FROM stations as t1 LEFT JOIN branches as t2 ON t2.id = t1.branch_id WHERE t1.station_name='".$store_name."' AND t2.branch_name = '".$branch_name."' LIMIT 1";
		$result = $this->db->query($query);


		$fuel_list = $this->db->where("product_category_id","1")->get("products");
		$return = "<tbody>";
		foreach($fuel_list->result() as $row)
		{
			$this->db->where("station_id",$result->row()->station_id);
			$this->db->where("fuel_id",$row->id);
			$fuel_price_query = $this->db->get("stations_fuel_prices");
			$price = "00.00";
			if($fuel_price_query->row() != null)
			{	
				$price = $fuel_price_query->row()->price;
			}
			$return .='<tr>
				<td>'.ucwords($row->product_name).'</td>
			<td>
				<div class="price-container" data-price="'.$price.'">';

				
				$str_price = str_split($price);
				foreach($str_price as $char  ) {
					if($char != null){
						$return .= '<div class="price-digit">'.$char.'</div>';
					}
				}
				$return .= '</div>
			</td>
			</tr>';
		}
		$return .= "</tbody>";
		echo $return;

	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();    
	}
	public function fuel()
	{
		$this->v_counter->insert_visitor(); 
		$data["module_name"] = strtolower($this->router->fetch_class());
		$data["title"] = "FUEL - Unioil";

		$fuel_series = $this->db->where("product_category_id","1")->get("product_series")->result();

		$return = "";
		if($fuel_series != null){
			foreach($fuel_series as $row){
				$return .= '<section id="euro-5-content">
					<div class="custom-column fuel-item animate fade-in">
						<div class="item-wrapper">
							<img src="'.base_url("uploads/").'product_series/'.$row->series_image.'" alt="" class="img-fluid" />
							<div class="partial-border-container">
								<div class="partial-border"></div>
							</div>
							<p style="text-align:justify">'.$row->series_description.'</p>
						</div>
					</div>
					<div class="custom-column fuel-item animate fade-in from-right">';
					
						$products = $this->db->where("visibility","promotion_only")->where("product_series_id",$row->id)->get("products")->result();
										
						if($products != null){
							foreach($products as $row_prod){
								$this->db->where("id",$row_prod->product_image);
								$img = $this->db->get("media")->row()->file_name;
								$return .= '<a href="#" onclick="view_product_details('.$row_prod->id.');return false;"><img src="'.base_url()."uploads/products/".$img.'" alt="" class="img-fluid" /></a>';
							}
						}
					$return.='</div>
				</section>';
			}
		}
		$data["fuel_products"] = $return;
		$this->load->view('template/header.php',$data);
		$this->load->view('fuel_view');
		$this->load->view('template/footer.php',$data);
    }

    
	public function asphalt()
	{
		$this->v_counter->insert_visitor(); 
		$data["module_name"] = strtolower($this->router->fetch_class());
		$data["title"] = "ASPHALT - Unioil";
		$data["asphalt_products"] = $this->db->where("product_category_id","3")->get("products")->result();
		$this->load->view('template/header.php',$data);
		$this->load->view('asphalt_view');
		$this->load->view('template/footer.php',$data);
    }

    
	public function lubricants()
	{
		$this->v_counter->insert_visitor(); 
		$data["module_name"] = strtolower($this->router->fetch_class());
		$data["title"] = "LUBRICANTS - Unioil";
		$query = "SELECT t1.id,t1.series_name,t1.series_description,t2.file_name as series_image,t3.file_name as series_title_image FROM product_series as t1 LEFT JOIN media as t2 on t2.id = t1.series_image  LEFT JOIN media as t3 on t3.id = t1.series_title_image WHERE t1.product_category_id = 2 ORDER BY t1.series_name DESC";
		$data["lubricants_products"] = $this->db->query($query)->result();
		$this->load->view('template/header.php',$data);
		$this->load->view('lubricants_view');
		$this->load->view('template/footer.php',$data);
    }

	public function get_product_details()
	{
		$id = $this->input->post("id");
		$this->db->where("id",$id);
		$return = $this->db->get("products");
		$data = $return->row();
		$data->product_sub_image = $this->db->where("id",$data->product_sub_image)->get("media")->row()->file_name;
		echo json_encode($data);
	}

	public function get_lubricants()
	{
		
		
			$id = $this->input->post("id");
			$this->db->where("product_series_id",$id);
			$return = $this->db->get("products")->result();
			$return_ol = '<ol class="carousel-indicators">';
			$return_carousel = '<div class="carousel-inner">';
			if($return != null)
			{
				$count = 0;
				foreach($return as $row)
				{
					if( $count == 0 )
					{
						$active = ' active';
					}else{
						$active = "";
					}
					$return_ol .= '<li data-target="#product-carousel" data-slide-to="'.$count.'" class="'.ltrim($active." ").'">
										<img src="'.base_url().'uploads/products/'.$row->product_image.'" alt="" class="img-fluid product-thumbnail">
									</li>';
					$pdf = "";
					if($row->pdf != null)
					{

						$pdf = "<div class='btn-spacer' style='padding-left: 14px;padding-bottom: 14px;'><a style='font-size: 13px;' class='ghost-btn blue' href='".base_url("uploads/products/".$row->pdf)."' target=_blank>Download</a></div>";
					}
					
					$row->product_image = $this->db->where("id",$row->product_image)->get("media")->row()->file_name;
					$return_carousel .= '<div class="carousel-item'.$active.'">
											<div class="container">
												<div class="row justify-content-center">
													<div class="col-12 col-md-5 col-lg-4 my-auto">
														<img src="'.base_url().'uploads/products/'.$row->product_image.'" alt="" class="img-fluid product-img">
													</div>
													<div class="col-12 col-md-6 col-lg-6 my-auto">
														<h4>'.strtoupper($row->product_name).'</h4>
														<h5>'.nl2br($row->product_description).'</h5>
														<div class="modal-divider"></div>
														<p>
															'.$row->specification.'
														</p>
														<p>
															'.$pdf.'
														</p>
													</div>
												</div>
											</div>
										</div>';
					$count++;
				}
			}
			$return_ol .= '</ol>';
			$return_carousel .= '</div>';

		echo $return_ol . $return_carousel;
	}
}

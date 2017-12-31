<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_settings extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();   
        $this->load->model("cms/news_model"); 
        
        if($this->session->userdata("USERID") == null)
        {
                echo "Sorry you are not logged in";
                die();
        }
    }
}

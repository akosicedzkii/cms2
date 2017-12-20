<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();    
    }

	public function index()
	{
		$this->load->view('administrator/login_view');
    }
}

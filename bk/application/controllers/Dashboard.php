<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('admin_users')){
			redirect(base_url('login'));
		}else{
			$this->load->model('base_model');
			$this->load->model('dashboard_model');
		}
	}
	public function index()
	{
		$data=array();
		$this->base_model->load_metronic_theme('view_dashboard',$data);
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Managcountries extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('admin_users')){
			redirect(base_url('login'));
		}else{
			$this->load->model('base_model');
		}
	}
	/*
	@ Main page loading method
	*/
	public function index($data=NULL)
	{
		$this->base_model->load_metronic_theme('countries/view_countries',$data);
	}
	/*
	@ Countries setting  method
	*/
	public function countriesList(){
		$data['header']='Countries Setting';
	    $data['breadcromb']='Countries';
	    $data['title']='Countries Setting';
	    $data['countries_data']=$this->base_model->allrecords('apx_countries','*',NULL,'array');
		$this->index($data);
	}
	/*Add Country method*/
	public function addCountry($data=NULL){
		//general data
		$data['header']='Add Country';
	    $data['breadcromb']='Add Country';
	    $data['title']='Add Country';
		$this->base_model->load_metronic_theme('countries/view_add_country',$data);
	}
	/*Update Country method*/
	public function editCountry($cid=NILL){
		if($this->uri->segment(2)){
			$id=$this->uri->segment(2);
		}else{
			$id=$cid;
		}
		$result=$this->base_model->select_single_record('apx_countries','*',array('country_id'=>$id));
		if($result){
			$data['edit_view']=$result;
		}else{
	       $data['no_data']='<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access</div>';
		}
		//general data
		$data['header']='Update Country';
	    $data['breadcromb']='Update Country';
	    $data['title']='Update Country';
		$this->base_model->load_metronic_theme('countries/view_edit_country',$data);
	}
	/*
	@ Add and Update Country action
	*/
	public function addCountryAction(){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('country_name', 'country name', 'trim|required');
			if(isset($_POST['update'])){
				$countryData=$this->base_model->select_single_record('apx_countries','*',array('country_id'=>$this->input->post('cid')));
				if($countryData->countryCode!=$this->input->post('country_code')){
					$this->form_validation->set_rules('country_code', 'country code', 'trim|required|is_unique[apx_countries.countryCode]');
				}else{
					$this->form_validation->set_rules('country_code', 'country code', 'trim|required');
				}
			}else{
				$this->form_validation->set_rules('country_code', 'country code',
					'trim|required|is_unique[apx_countries.countryCode]');
			}
			if ($this->form_validation->run() == FALSE) {
				if(isset($_POST['add'])){
					$this->addCountry();
				}else if(isset($_POST['update'])){
					$this->editCountry($this->input->post('cid'));
				}
			}else{  
					$data['countryName']=$this->input->post('country_name'); 
					$data['countryCode']=$this->input->post('country_code');
					$data['continentName']=$this->input->post('continent_name');
			    if(isset($_POST['add'])){
					$result=$this->base_model->insert_record('apx_countries',$data);
					$status='added';
				}else if(isset($_POST['update'])){
					$result=$this->base_model->update_record('apx_countries',$data,array('country_id'=>$this->input->post('cid')));
					$status='updated';
				}
		    	if($result){
		    		$this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record '.$status.' successfully.</div>');
						redirect('list-countries');
		    		}else{
		    		$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot '.$status.'.</div>');
						redirect('list-countries');	
		    		}
	   		}
	}
	/*Delete Countries*/
	public function deleteCountry(){
		$delid=$this->uri->segment(2);
		$delData=$this->base_model->select_single_record('apx_countries','*',array('country_id'=>$delid));
		if(!empty($delData)){
			$result= $this->base_model->deleteRecord('apx_countries',array('country_id'=>$delid));
			if($result=true){
				$this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record Deleted successfully.</div>');
					redirect('list-countries');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot be Deleted.</div>');
					redirect('list-countries');
			}
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access.</div>');
					redirect('list-countries');
		}
	}
}
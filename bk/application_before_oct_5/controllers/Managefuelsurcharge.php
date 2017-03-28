<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Managefuelsurcharge extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('admin_users')){
			redirect(base_url('login'));
		}else{
			$this->load->model('base_model');
			$this->load->model('fuel_surcharge_model');
		}
	}
	/*
	@ Main page loading method
	*/
	public function index($data=NULL)
	{
		/*echo '<pre>';
		print_r($data);
		exit;*/
		/*echo '<pre>';
		print_r($this->session->all_userdata());
		exit;*/
		
		 $this->base_model->load_metronic_theme('fuel_surcharge/view_fuel_surcharge_setting',$data);
	}
	/*
	@ List fuel surcharge setting  method
	*/
	public function listFuelSurchargeValue(){
		$data['header']='Fuel Surcharge Setting';
	    $data['breadcromb']='Fuel Surcharge';
	    $data['title']='Fuel Surcharge Setting';
	    $data['fuel_surcharge_data']=$this->fuel_surcharge_model->getFuelSurchargeAllData($where='fs.status <> -1',$orderby='fs.fs_id',$orderType='DESC',$iDisplayStart=NULL,$end=NULL);
		$this->index($data);
	}
	/*Add Fuel Surcharge method*/
	public function addFuelSurchargeValue($data=NULL){
		//general data
		$data['header']='Add Fuel Surcharge';
	    $data['breadcromb']='Add Fuel Surcharge';
	    $data['title']='Add Fuel Surcharge';
		$this->base_model->load_metronic_theme('fuel_surcharge/view_add_fuel_surcharge',$data);
	}
	/*Update Fuel Surcharge method*/
	public function editFuelSurchargeValue(){
		if($this->uri->segment(2)){
			$id=$this->uri->segment(2);
			$result=$this->base_model->select_single_record('apx_fuel_surcharge','*',array('fs_id'=>$id));
		}else{
			$result=array('avoid_error'=>1);//just to avoid error in edit form no basic use any where
		}
		if($result){
			$data['edit_view']=$result;
		}else{
	       $data['no_data']='<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access</div>';
		}
		//general data
		$data['header']='Update Fuel Surcharge';
	    $data['breadcromb']='Update Fuel Surcharge';
	    $data['title']='Update Fuel Surcharge';
		$this->base_model->load_metronic_theme('fuel_surcharge/view_edit_fuel_surcharge',$data);
	}
	/*
	@ Add and Update Fuel Surcharge action
	*/
	public function addFuelSurchargeAction(){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('from', 'from date', 'trim|required');
			$this->form_validation->set_rules('to', 'to date', 'trim|required');
			$this->form_validation->set_rules('percentage', 'percentage', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				if(isset($_POST['add'])){
					$this->addFuelSurchargeValue();
				}else if(isset($_POST['update'])){
					$this->editFuelSurchargeValue();
				}
			}else{   
					$data['from_date']=date('Y-m-d',strtotime($this->input->post('from')));
					$data['to_date']=date('Y-m-d',strtotime($this->input->post('to')));
					$data['fs_percentage']=$this->input->post('percentage');
					$data[(isset($_POST['add'])?'created_by':'modified_by')]=$this->session->userdata('admin_users')['user_val'];
		    		$data[(isset($_POST['add'])?'created_date':'modified_date')]=date('Y-m-d H:i:s');
			    if(isset($_POST['add'])){
					$result=$this->base_model->insert_record('apx_fuel_surcharge',$data);
					$status='added';
				}else if(isset($_POST['update'])){
					$result=$this->base_model->update_record('apx_fuel_surcharge',$data,array('fs_id'=>$this->input->post('fsid')));
					$status='updated';
				}
		    	if($result){
		    		$this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record '.$status.' successfully.</div>');
						redirect('list-fuel-surcharge');
		    		}else{
		    		$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot '.$status.'.</div>');
						redirect('list-fuel-surcharge');	
		    		}
	   		}
	}
	/*Delete Fuel Surcharge*/
	public function deleteFuelSurcharge(){
		$delid=$this->uri->segment(2);
		$delData=$this->base_model->select_single_record('apx_fuel_surcharge','*',array('fs_id'=>$delid));
		if(!empty($delData)){
			$result= $this->base_model->deleteRecord('apx_fuel_surcharge',array('fs_id'=>$delid));
			if($result=true){
				$this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record Deleted successfully.</div>');
					redirect('list-fuel-surcharge');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot be Deleted.</div>');
					redirect('list-fuel-surcharge');
			}
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access.</div>');
					redirect('list-fuel-surcharge');
		}
	}
}

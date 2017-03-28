<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Managegst extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('admin_users')){
			redirect(base_url('login'));
		}else{
			$this->load->model('base_model');
			$this->load->model('gst_model');
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
		
		 $this->base_model->load_metronic_theme('gst/view_gst_setting',$data);
	}
	/*
	@ List GST setting  method
	*/
	public function listGstValue(){
		$data['header']='GST Setting';
	    $data['breadcromb']='GST';
	    $data['title']='GST Setting';
	    $data['gst_data']=$this->gst_model->getGstAllData($where='gst.status <> -1',$orderby='gst.gst_id',$orderType='DESC',$iDisplayStart=NULL,$end=NULL);
		$this->index($data);
	}
	/*Add GST method*/
	public function addGstValue($data=NULL){
		//general data
		$data['header']='Add GST';
	    $data['breadcromb']='Add GST';
	    $data['title']='Add GST';
		$this->base_model->load_metronic_theme('gst/view_add_gst',$data);
	}
	/*Update GST method*/
	public function editGstValue(){
		if($this->uri->segment(2)){
			$id=$this->uri->segment(2);
			$result=$this->base_model->select_single_record('apx_gst','*',array('gst_id'=>$id));
		}else{
			$result=array('avoid_error'=>1);//just to avoid error in edit form no basic use any where
		}
		if($result){
			$data['edit_view']=$result;
		}else{
	       $data['no_data']='<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access</div>';
		}
		//general data
		$data['header']='Update GST';
	    $data['breadcromb']='Update GST';
	    $data['title']='Update GST';
		$this->base_model->load_metronic_theme('gst/view_edit_gst',$data);
	}
	/*
	@ Add and Update GST action
	*/
	public function addGstAction(){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('from', 'from date', 'trim|required');
			$this->form_validation->set_rules('to', 'to date', 'trim|required');
			$this->form_validation->set_rules('percentage', 'percentage', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				if(isset($_POST['add'])){
					$this->addGstValue();
				}else if(isset($_POST['update'])){
					$this->editGstValue();
				}
			}else{   
					$data['from_date']=date('Y-m-d',strtotime($this->input->post('from')));
					$data['to_date']=date('Y-m-d',strtotime($this->input->post('to')));
					$data['gst_percentage']=$this->input->post('percentage');
					$data[(isset($_POST['add'])?'created_by':'modified_by')]=$this->session->userdata('admin_users')['user_val'];
		    		$data[(isset($_POST['add'])?'created_date':'modified_date')]=date('Y-m-d H:i:s');
			    if(isset($_POST['add'])){
					$result=$this->base_model->insert_record('apx_gst',$data);
					$status='added';
				}else if(isset($_POST['update'])){
					$result=$this->base_model->update_record('apx_gst',$data,array('gst_id'=>$this->input->post('gid')));
					$status='updated';
				}
		    	if($result){
		    		$this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record '.$status.' successfully.</div>');
						redirect('list-gst');
		    		}else{
		    		$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot '.$status.'.</div>');
						redirect('list-gst');	
		    		}
	   		}
	}
	/*Delete GST*/
	public function deleteGst(){
		$delid=$this->uri->segment(2);
		$delData=$this->base_model->select_single_record('apx_gst','*',array('gst_id'=>$delid));
		if(!empty($delData)){
			$result= $this->base_model->deleteRecord('apx_gst',array('gst_id'=>$delid));
			if($result=true){
				$this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record Deleted successfully.</div>');
					redirect('list-gst');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot be Deleted.</div>');
					redirect('list-gst');
			}
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access.</div>');
					redirect('list-gst');
		}
	}
}

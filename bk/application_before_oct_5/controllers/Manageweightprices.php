<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manageweightprices extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('admin_users')){
			redirect(base_url('login'));
		}else{
			$this->load->model('base_model');
			$this->load->model('weight_prices_model','wp');
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
		$this->base_model->load_metronic_theme('weight_prices/view_weight_prices',$data);
	}
	/*
	@ List  weight price setting  method
	*/
	public function listWeightPrices(){
		$zonid=$this->uri->segment(2);
		$weightPriceData=$this->base_model->select_single_record('apx_zone','*,(select listCode from apx_price_list where list_id=apx_zone.list_id) as listCode',array('zone_id'=>$zonid));
		if(!empty($weightPriceData)){
			$data['header']=$weightPriceData->zoneName.' ( '.$weightPriceData->listCode.' ) '.'Weight & Prices Setting';
	    	$data['breadcromb']='Weight & Prices';
	    	$data['title']='Weight & Prices Setting';
		    $data['zone_id']=$weightPriceData->zone_id;
		    $data['list_id']=$weightPriceData->list_id;
		    $data['wp_data']=$this->wp->getWpAllData($where='wp.zone_id='.$zonid.' AND wp.status <> -1',$orderby='wp.zone_id',$orderType='ASC',$iDisplayStart=NULL,$end=NULL);
			$this->index($data);
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access.</div>');
					redirect('list-pricelist');

		}

		
	}
	/*Add Weight & Prices method*/
	public function addWeightPrice($zonid=NULL){
		if($this->uri->segment(2)){
			$zonid=$this->uri->segment(2);
		}else{
			//Get from parms
		}
		$weightPriceData=$this->base_model->select_single_record('apx_zone','*,(select listCode from apx_price_list where list_id=apx_zone.list_id) as listCode',array('zone_id'=>$zonid));
		if(!empty($weightPriceData)){
		//general data
		$data['header']='Add '.$weightPriceData->zoneName.' ( '.$weightPriceData->listCode.' ) Weight & Price';
	    $data['breadcromb']='Add Weight & Prices';
	    $data['title']='Add  Weight & Prices';
	    $data['zone_id']=$weightPriceData->zone_id;
	    $data['list_id']=$weightPriceData->list_id;
		$this->base_model->load_metronic_theme('weight_prices/view_add_weight_prices',$data);
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access.</div>');
					redirect('list-pricelist');

		}
	}
	/*Update Weight & Prices method*/
	public function editWeightPrice($wpid=NULL){
		if($this->uri->segment(2)){
			$id=$this->uri->segment(2);
		}else{
			$id=$wpid;
		}
		$result=$this->base_model->select_single_record('apx_weight_prices','*,(select listCode from apx_price_list where list_id=apx_weight_prices.list_id) as listCode,(select zoneName from apx_zone where zone_id=apx_weight_prices.zone_id) as zoneName',array('wp_id'=>trim($id)));
		
		if(!empty($result)){
			$data['edit_view']=$result;
		}else{
	       $data['no_data']='<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access</div>';
		}
		//general data
		$data['header']='Update '.$result->zoneName.' ( '.$result->listCode.' ) Weight & Price';
	    $data['breadcromb']='Update Weight & Price';
	    $data['title']='Update Weight & Price';
		$this->base_model->load_metronic_theme('weight_prices/view_edit_weight_prices',$data);
	}
	/*
	@ Add and Update Weight & Prices action
	*/
	public function addWeightPriceAction(){
			$this->load->library('form_validation');
			$weightfrom=trim($this->input->post('weight_from'));
			$this->form_validation->set_rules('weight_from', 'weight from', 'trim|required');
			$this->form_validation->set_rules('weight_to', 'weight to', 'trim|greater_than['.$weightfrom.']|required');
			$this->form_validation->set_rules('price', 'price', 'trim|numeric|required');

			if ($this->form_validation->run() == FALSE) {
				if(isset($_POST['add'])){
					$this->addWeightPrice($this->input->post('znid'));
				}else if(isset($_POST['update'])){
					$this->editWeightPrice($this->input->post('wpid'));
				}
			}else{  
				  if(isset($_POST['add'])){
				  	$data['zone_id']=$this->input->post('znid'); 
				    $data['list_id']=$this->input->post('plid'); 
				 	}
					$data['weight_from']=$this->input->post('weight_from'); 
					$data['weight_to']=$this->input->post('weight_to');
					$data['wprice']=$this->input->post('price');
					$data[(isset($_POST['add'])?'created_by':'modified_by')]=$this->session->userdata('admin_users')['user_val'];
		    		$data[(isset($_POST['add'])?'created_date':'modified_date')]=date('Y-m-d H:i:s');
			    if(isset($_POST['add'])){
					$result=$this->base_model->insert_record('apx_weight_prices',$data);
					$status='added';
				}else if(isset($_POST['update'])){
					$result=$this->base_model->update_record('apx_weight_prices',$data,array('wp_id'=>$this->input->post('wpid')));
					$status='updated';
				}
		    	if($result){
		    		$this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record '.$status.' successfully.</div>');
						redirect('zone-weight-prices/'.$this->input->post('znid'));
		    		}else{
		    		$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot '.$status.'.</div>');
						redirect('zone-weight-prices/'.$this->input->post('znid'));	
		    		}
	   		}
	}
	/*Delete Weight & price*/
	public function deleteWeightPrice(){
		$delid=$this->uri->segment(2);
		$delData=$this->base_model->select_single_record('apx_weight_prices','*',array('wp_id'=>$delid));
		if(!empty($delData)){
			$result= $this->base_model->deleteRecord('apx_weight_prices',array('wp_id'=>$delid));
			if($result=true){
				$this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record Deleted successfully.</div>');
					redirect('zone-weight-prices/'.$delData->zone_id);
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot be Deleted.</div>');
					redirect('zone-weight-prices/'.$delData->zone_id);
			}
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access.</div>');
					redirect('list-pricelist');
		}
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Managepricelist extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('admin_users')){
			redirect(base_url('login'));
		}else{
			if(access_control_apx('general_setting','Full')!=true){
				redirect(base_url('dashboard'));
				exit;	
			}
			$this->load->model('base_model');
			$this->load->model('pricelist_model');
		}
	}
	/*
	@ Main page loading method
	*/
	public function index($data=NULL)
	{
		$this->base_model->load_metronic_theme('price_list/view_price_list',$data);
	}
	/*
	@ List price list setting  method
	*/
	public function listPriceList(){
		$data['header']='Price List Setting';
	    $data['breadcromb']='Price List';
	    $data['title']='Price List Setting';
	    $data['price_list_data']=$this->pricelist_model->getPriceListAllData($where='pl.status <> -1',$orderby='pl.list_id',$orderType='ASC',$iDisplayStart=NULL,$end=NULL);
		$this->index($data);
	}
	/*Add Price List method*/
	public function addPriceList($data=NULL){
		//general data
		$data['header']='Add Price List';
	    $data['breadcromb']='Add Price List';
	    $data['title']='Add Price List';
		$this->base_model->load_metronic_theme('price_list/view_add_price_list',$data);
	}
	/*Update Price List method*/
	public function editPriceList(){
		if($this->uri->segment(2)){
			$id=$this->uri->segment(2);
			$result=$this->base_model->select_single_record('apx_price_list','*',array('list_id'=>$id));
		}else{
			$result=array('avoid_error'=>1);//just to avoid error in edit form no basic use any where
		}
		if($result){
			$data['edit_view']=$result;
		}else{
	       $data['no_data']='<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access</div>';
		}
		//general data
		$data['header']='Update Price List';
	    $data['breadcromb']='Update Price List';
	    $data['title']='Update Price List';
		$this->base_model->load_metronic_theme('price_list/view_edit_price_list',$data);
	}
	/*
	@ Add and Update Price List action
	*/
	public function addPriceListAction(){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('list_name', 'price list name', 'trim|required');
			if(isset($_POST['update'])){
				$priceListData=$this->base_model->select_single_record('apx_price_list','*',array('list_id'=>$this->input->post('plid')));
				if($priceListData->listCode!=$this->input->post('list_code')){
					$this->form_validation->set_rules('list_code', 'price list code', 'trim|required|is_unique[apx_price_list.listCode]|callback_spaces_check');
				}else{
					$this->form_validation->set_rules('list_code', 'price list code', 'trim|required|callback_spaces_check');
				}
			}else{
				$this->form_validation->set_rules('list_code', 'price list code', 'trim|required|is_unique[apx_price_list.listCode]|callback_spaces_check');
			}
			if ($this->form_validation->run() == FALSE) {
				if(isset($_POST['add'])){
					$this->addPriceList();
				}else if(isset($_POST['update'])){
					$this->editPriceList();
				}
			}else{  
					$data['listName']=$this->input->post('list_name'); 
					$data['listCode']=$this->input->post('list_code');

					$data[(isset($_POST['add'])?'created_by':'modified_by')]=$this->session->userdata('admin_users')['user_val'];
		    		$data[(isset($_POST['add'])?'created_date':'modified_date')]=date('Y-m-d H:i:s');
			    if(isset($_POST['add'])){
					$result=$this->base_model->insert_record('apx_price_list',$data);
					$status='added';
				}else if(isset($_POST['update'])){
					$result=$this->base_model->update_record('apx_price_list',$data,array('list_id'=>$this->input->post('plid')));
					$status='updated';
				}
		    	if($result){
		    		$this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record '.$status.' successfully.</div>');
						redirect('list-pricelist');
		    		}else{
		    		$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot '.$status.'.</div>');
						redirect('list-pricelist');
		    		}
	   		}
	}
	// Spaces check callback function
	public function spaces_check($str)
        {
	        if (preg_match('/\s/',$str))
	        {
                $this->form_validation->set_message('spaces_check', 'Spaces are not allowed in code field');
                return FALSE;
	        }
	        else
	        {
	            return TRUE;
	        }
        }
    /*Status change*/
	public function changeStatus(){
		$statusid=$this->uri->segment(2);
		$statusData=$this->base_model->select_single_record('apx_price_list','*',array('list_id'=>$statusid));
		switch($statusData->status){
                    case -1:
                        $status='Restored';
                        $action='1';
                        $redirect='trashed-customer';
                        break;
                    case 0:
                        $status='Enabled';
                        $action='1';
                        $redirect='list-customer';
                        break;
                    case 1:
                        $status='Blocked';
                        $action='2';
                        $redirect='list-customer';
                        break;
                    case 2:
                        $status='Activated';
                        $action='1';
                        $redirect='list-customer';
                        break;
                    default:
                        $status='Trashed Again';
                        $action='-1';
                        $redirect='dashboard';
                        break;
                    }

		if(!empty($statusData)){
			$result= $this->base_model->update_record('apx_price_list',array('status'=>$action),array('list_id'=>$statusid));
			if($result=true){
				$this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record '.$status.' successfully.</div>');
					redirect('list-pricelist');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot be '.$status.'.</div>');
					redirect('list-pricelist');
			}
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access.</div>');
					redirect('list-pricelist');
		}
	}
	/*Delete Price List*/
	public function deletePriceList(){
		$delid=$this->uri->segment(2);
		$delData=$this->base_model->select_single_record('apx_price_list','*',array('list_id'=>$delid));
		if(!empty($delData)){
			$result= $this->base_model->deleteRecord('apx_price_list',array('list_id'=>$delid));
			if($result=true){
				$this->base_model->deleteRecord('apx_zone',array('list_id'=>$delid));
				$this->base_model->deleteRecord('apx_zone_countries',array('list_id'=>$delid));
				$this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record Deleted successfully.</div>');
					redirect('list-pricelist');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot be Deleted.</div>');
					redirect('list-pricelist');
			}
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access.</div>');
					redirect('list-pricelist');
		}
	}
}

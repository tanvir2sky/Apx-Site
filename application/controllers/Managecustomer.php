<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Managecustomer extends CI_Controller {

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
			$this->load->model('customer_model');
		}
	}
	/*
	@ Main page loading method
	*/
	public function index($data=NULL)
	{
		if(isset($data['trashed_customers_data'])){
			$this->base_model->load_metronic_theme('customer/view_trash_customers',$data);

		}else{
		   $this->base_model->load_metronic_theme('customer/view_customers',$data);
		}
	}
	/*
	@ List Customers  method
	*/
	public function listCustomers(){
		$data['header']='Customers';
	    $data['breadcromb']='List Customers';
	    $data['title']='Customers';
	    $data['customers_data']=$this->customer_model->getCustomersAllData($where='cst.status <> -1',$orderby='cst.customer_id',$orderType='DESC',$iDisplayStart=NULL,$end=NULL);
		$this->index($data);
	}
	/*
	@ view Customer detail
	*/
	public function viewCustomer(){
		$id=$this->uri->segment(2);
		$tabel	 = 'apx_customer cst';
		$select	 = 'cst.*,ct.countryName as country,brc.name as branch_name,adm1.user_name as created_name,adm2.user_name as modify_name';
		$where['where'] =	array(
		'cst.customer_id' 	=>$id
		);
		$jointabeles = array(
			array(
			'joined_name'	=>	'apx_countries as ct',
			'joined_id'		=>	'ct.countryCode',
			'tabel_id'		=>	'cst.countryCode',
			'type'			=>	''
			),
			array(
			'joined_name'	=>	'apx_branches as brc',
			'joined_id'		=>	'brc.branch_id',
			'tabel_id'		=>	'cst.branch_id',
			'type'			=>	''
			),
			array(
			'joined_name'	=>	'apx_admin as adm1',
			'joined_id'		=>	'adm1.id',
			'tabel_id'		=>	'cst.created_by',
			'type'			=>	''
			),
			array(
			'joined_name'	=>	'apx_admin as adm2',
			'joined_id'		=>	'adm2.id',
			'tabel_id'		=>	'cst.modified_by',
			'type'			=>	'LEFT'
			),
		);
		$result=$this->base_model->select_single_record_with_join($tabel,$jointabeles,$select,$where);
		$data['header']='Detail View';
	    $data['breadcromb']='detail view';
	    $data['title']='detail about '.($result!=""?$result->user_name:"Invalid");
		if($result){
			$data['detail_view']=$result;
		}else{
	       $data['no_data']='<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access</div>';
		}
		$this->base_model->load_metronic_theme('customer/view_customer',$data);

	}
	/*Add Customer method*/
	public function addCustomer($data=NULL){
		//general data
		$data['header']='Add Customer';
	    $data['breadcromb']='Add Customer';
	    $data['title']='Add Customer';
	    $data['branch']=$this->base_model->allrecords('apx_branches','branch_id,code,name',array('status'=>1));
	    $data['country']=$this->base_model->allrecords('apx_countries','country_id,countryCode,countryName');
		$this->base_model->load_metronic_theme('customer/view_add_customer',$data);
	}
	/*Update Customer method*/
	public function editCustomer(){
		if($this->uri->segment(2)){
			$id=$this->uri->segment(2);
			$result=$this->base_model->select_single_record('apx_customer','*',array('customer_id'=>$id));
		}else{
			$result=array('avoid_error'=>1);//just to avoid error in edit form no basic use any where
		}
		if($result){
			$data['edit_view']=$result;
		}else{
	       $data['no_data']='<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access</div>';
		}
		//general data
		$data['header']='Update Customer';
	    $data['breadcromb']='Update Customer';
	    $data['title']='Update Customer';
	    $data['branch']=$this->base_model->allrecords('apx_branches','branch_id,code,name',array('status'=>1));
	    $data['country']=$this->base_model->allrecords('apx_countries','country_id,countryCode,countryName');
		$this->base_model->load_metronic_theme('customer/view_edit_customer',$data);
	}
	/*
	@ Add and Update Customer action
	*/
	public function addCustomerAction(){
		    $password=false;
			$this->load->library('form_validation');
			//skip the unique condition in update on own value
			if(isset($_POST['update'])){
				$result=$this->base_model->select_single_record('apx_customer','*',array('customer_id'=>$this->input->post('cid')));
					if($result->accountNumber!=$this->input->post('acnumber')){
						$this->form_validation->set_rules('acnumber', 'customer account number', 'trim|required|numeric|is_unique[apx_customer.accountNumber]');
					}
				}else{
					$this->form_validation->set_rules('acnumber', 'customer account number', 'trim|required|numeric|is_unique[apx_customer.accountNumber]');
				}
				$this->form_validation->set_rules('company', 'company name', 'trim|required');
				$this->form_validation->set_rules('fname', 'first name', 'trim|required');
				$this->form_validation->set_rules('uname', 'user name', 'trim|required');
				if(isset($_POST['update']) && ($this->input->post('pass')=="") && ($this->input->post('repass')=="")){
				//do nothing
				}else{
				$this->form_validation->set_rules('pass', 'password', 'trim|required');
				$this->form_validation->set_rules('repass', 'Password Confirmation', 'required|matches[pass]');
				$password=true;
				}
			
			if ($this->form_validation->run() == FALSE) {
				if(isset($_POST['add'])){
					$this->addCustomer();
				}else if(isset($_POST['update'])){
					$this->editCustomer();
				}
			}else{   
					$data['accountNumber']=$this->input->post('acnumber');
					$data['accountType']=$this->input->post('actype');
					$data['companyName']=$this->input->post('company');
					$data['firstName']=$this->input->post('fname');
					$data['lastName']=$this->input->post('lname');
					$data['user_name']=$this->input->post('uname');
					$data['email']=$this->input->post('email1');
					$data['email2']=$this->input->post('email2');
					$data['phone']=$this->input->post('phone');
					if($password==true){
					$data['password']=md5(trim($this->input->post('pass')));
					}
					$data['mobileNumber1']=$this->input->post('mobile1');
					$data['mobileNumber2']=$this->input->post('mobile2');
					$data['contactPerson']=$this->input->post('cperson');
					$data['addressLine1']=$this->input->post('address1');
					$data['addressLine2']=$this->input->post('address2');
					$data['branch_id']=$this->input->post('bname');
					$data['countryCode']=$this->input->post('country');
					$data['state']=$this->input->post('state');
					$data['city']=$this->input->post('city');
					$data['zipCode']=$this->input->post('zipcode');
					$data[(isset($_POST['add'])?'created_by':'modified_by')]=$this->session->userdata('admin_users')['user_val'];
		    		$data[(isset($_POST['add'])?'created_date':'modified_date')]=date('Y-m-d H:i:s');
			    if(isset($_POST['add'])){
					$result=$this->base_model->insert_record('apx_customer',$data);
					$status='added';
				}else if(isset($_POST['update'])){
					$result=$this->base_model->update_record('apx_customer',$data,array('customer_id'=>$this->input->post('cid')));
					$status='updated';
				}
		    	if($result){
		    		$this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record '.$status.' successfully.</div>');
						redirect('list-customer');
		    		}else{
		    		$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot '.$status.'.</div>');
						redirect('list-customer');	
		    		}
	   		}
	}
	/*
	@ list trashed Customers
	*/
	public function trashedCustomers(){
		$data['header']='Trashed Customer';
	    $data['breadcromb']='List Trashed Customer';
	    $data['title']='Trashed Customer';
	    $data['trashed_customers_data']=$this->customer_model->getCustomersAllData($where=array('cst.status'=>-1),$orderby='cst.customer_id',$orderType='DESC',$iDisplayStart=NULL,$end=NULL);
		$this->index($data);
	}
	/*Trash Customer*/
	public function trashCustomer(){
		$trashId=$this->uri->segment(2);
		$trashData=$this->base_model->select_single_record('apx_customer','*',array('customer_id'=>$trashId));
		if(!empty($trashData)){
			$result= $this->base_model->update_record('apx_customer',array('status'=>'-1'),array('customer_id'=>$trashId));
			if($result=true){
				$this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record Trashed successfully.</div>');
					redirect('list-customer');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot be Trashed.</div>');
					redirect('list-customer');
			}
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access.</div>');
					redirect('list-customer');
		}
	}
	/*Status change*/
	public function changeStatus(){
		$statusid=$this->uri->segment(2);
		$statusData=$this->base_model->select_single_record('apx_customer','*',array('customer_id'=>$statusid));
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
			$result= $this->base_model->update_record('apx_customer',array('status'=>$action),array('customer_id'=>$statusid));
			if($result=true){
				$this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record '.$status.' successfully.</div>');
					redirect($redirect);
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot be '.$status.'.</div>');
					redirect(base_url($redirect));
			}
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access.</div>');
					redirect(base_url($redirect));
		}
	}
	/*Delete Customer*/
	public function deleteCustomer(){
		$delid=$this->uri->segment(2);
		$delData=$this->base_model->select_single_record('apx_customer','*',array('customer_id'=>$delid));
		if(!empty($delData)){
			$result= $this->base_model->deleteRecord('apx_customer',array('customer_id'=>$delid));
			if($result=true){
				$this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record Deleted successfully.</div>');
					redirect("trashed-customer");
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot be Deleted.</div>');
					redirect(base_url("trashed-customer"));
			}
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access.</div>');
					redirect(base_url("trashed-customer"));
		}
	}
}

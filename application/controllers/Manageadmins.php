<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manageadmins extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('admin_users')){
			redirect(base_url('login'));
		}else{
			if(access_control_apx('users_manage','Full')!=true){
				redirect(base_url('dashboard'));
				exit;	
			}
			$this->load->model('base_model');
			$this->load->model('admins_model');
		}
	}
	/*
	@ Main page loading method
	*/
	public function index($data=NULL)
	{
		if(isset($data['trashed_admins_data'])){
			$this->base_model->load_metronic_theme('admins/view_trash_admins',$data);

		}else{
		   $this->base_model->load_metronic_theme('admins/view_admins',$data);
		}
	}
	/*
	@ List supper admins  method
	*/
	public function listSuperAdmins(){
		$data['header']='Super admins';
	    $data['breadcromb']='List Super admins';
	    $data['title']='Super admins';
	    $data['admins_data']=$this->admins_model->getUserAllData($where='adm.role_id=1 AND adm.status <> -1',$orderby='adm.id',$orderType='DESC',$iDisplayStart=NULL,$end=NULL);
		$this->index($data);
	}
	/*
	@ List admins  method
	*/
	public function listAdmins(){
		$data['header']='admins';
	    $data['breadcromb']='List admins';
	    $data['title']='admins';
	    $data['admins_data']=$this->admins_model->getUserAllData($where='adm.role_id=2 AND adm.status <> -1',$orderby='adm.id',$orderType='DESC',$iDisplayStart=NULL,$end=NULL);
	
		$this->index($data);
	}
	/*
	@ List accounts  method
	*/
	public function listAccounts(){
		$data['header']='Accounts';
	    $data['breadcromb']='List Accounts';
	    $data['title']='Accounts';
	    $data['admins_data']=$this->admins_model->getUserAllData($where='adm.role_id=3 AND adm.status <> -1',$orderby='adm.id',$orderType='DESC',$iDisplayStart=NULL,$end=NULL);
		$this->index($data);
	}
	/*
	@ List List Oprations  method
	*/
    public function listOperations(){
		$data['header']='Operations';
	    $data['breadcromb']='List Operations';
	    $data['title']='Operations';
	    $data['admins_data']=$this->admins_model->getUserAllData($where='adm.role_id=4 AND adm.status <> -1',$orderby='adm.id',$orderType='DESC',$iDisplayStart=NULL,$end=NULL);
		$this->index($data);
	}
	/*
	@ List List customer service  method
	*/
	public function listCustomerServices(){
		$data['header']='Customer Services';
	    $data['breadcromb']='List Customer Services';
	    $data['title']='Customer Services';
	    $data['admins_data']=$this->admins_model->getUserAllData($where='adm.role_id=5 AND adm.status <> -1',$orderby='adm.id',$orderType='DESC',$iDisplayStart=NULL,$end=NULL);
		$this->index($data);
	}
	/*Add App Users method*/
	public function addAppUser($data=NULL){
		if(access_control_apx('users_manage','Add')!=true){
			redirect(base_url('dashboard'));
			exit;	
		}
		//general data
		$data['header']='Add App User';
	    $data['breadcromb']='App User';
	    $data['title']='Add App User';
	    $data['levels']=$this->base_model->allrecords('apx_role','*');
		$this->base_model->load_metronic_theme('admins/view_add_admins',$data);
	}
	/*Update App Users method*/
	public function editAppUser(){
		if(access_control_apx('users_manage','Edit')!=true){
			redirect(base_url('dashboard'));
			exit;	
		}
		if($this->uri->segment(2)){
			$id=$this->uri->segment(2);
			$result=$this->admins_model->select_single_record(array('id'=>$id));
		}else{
			$result=array('edit_user'=>1);//just to avoid error in edit form
		}
		if($result){
			$data['user_view']=$result;
		}else{
	       $data['no_data']='<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access</div>';
		}
		//general data
		$data['header']='Update App User';
	    $data['breadcromb']='Update User';
	    $data['title']='Update App User';
	    $data['levels']=$this->base_model->allrecords('apx_role','*');
		$this->base_model->load_metronic_theme('admins/view_edit_admins',$data);
	}
	/*
	@ view app user
	*/
	public function viewAppUser(){
		if(access_control_apx('users_manage','Read')!=true){
			redirect(base_url('dashboard'));
			exit;	
		}
		$id=$this->uri->segment(2);
		$result=$this->admins_model->select_single_record(array('id'=>$id));
		$data['header']='Detail View';
	    $data['breadcromb']='detail view';
	    $data['title']='detail about '.($result!=""?$result->user_name:"Invalid");
		if($result){
			$data['user_view']=$result;
		}else{
	       $data['no_data']='<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access</div>';
		}
		$this->base_model->load_metronic_theme('admins/view_app_user',$data);

	}
	/*
	@ Add and Update user action
	*/
	public function appUserAction(){
		    $password=false;
			$this->load->library('form_validation');
			//skip the unique condition in update on own value
			if(isset($_POST['update'])){
				$udata=$this->admins_model->select_single_record(array('id'=>$this->input->post('uid')));
				if($udata->user_name!=$this->input->post('uname')){
					$this->form_validation->set_rules('uname', 'user name', 'trim|required|is_unique[apx_admin.user_name]');	
				}
				if($udata->email!=$this->input->post('email')){
					$this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[apx_admin.email]');
				}
			}else{
				$this->form_validation->set_rules('uname', 'user name', 'trim|required|is_unique[apx_admin.user_name]');
				$this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[apx_admin.email]');
			}
			$this->form_validation->set_rules('phone', 'phone', 'trim|numeric');
			if(isset($_POST['update']) && ($this->input->post('pass')=="") && ($this->input->post('repass')=="")){
				//do nothing
			}else{
			$this->form_validation->set_rules('pass', 'password', 'trim|required');
			$this->form_validation->set_rules('repass', 'Password Confirmation', 'required|matches[pass]');
			$password=true;
			}
			$this->form_validation->set_rules('level', 'user level', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				if(isset($_POST['add'])){
					$this->addAppUser();
				}else if(isset($_POST['update'])){
					$this->editAppUser();
				}
			}else{
					$data['first_name']=$this->input->post('fname');
					$data['last_name']=$this->input->post('lname');
					$data['user_name']=$this->input->post('uname');
					if($password==true){
					$data['password']=md5(trim($this->input->post('pass')));
					}
					$data['email']=$this->input->post('email');
					$data['phone']=$this->input->post('phone');
					$data['detail']=$this->input->post('summery');
					$data['role_id']=$this->input->post('level');
					$data[(isset($_POST['add'])?'created_by':'modified_by')]=$this->session->userdata('admin_users')['user_val'];
		    		$data[(isset($_POST['add'])?'created_date':'modified_date')]=date('Y-m-d H:i:s');
			    if(isset($_POST['add'])){
					$result=$this->admins_model->insert_record($data);
					$status='added';
				}else if(isset($_POST['update'])){
					$result=$this->admins_model->update_record($data,array('id'=>$this->input->post('uid')));
					$status='updated';
				}
		    	if($result){
		    		switch($this->input->post('level')){
					/*Super admin check*/
	                    case 1:
	                        $redirect='list-super-admins';
	                        break;
	                /*admin check*/
	                    case 2:
	                        $redirect='list-admins';
	                        break;
	                /*admin account*/
	                    case 3:
	                        $redirect='list-accounts';
	                        break;
	                 /*admin oprations*/
	                    case 4:
	                        $redirect='list-operations';
	                        break;
	                 /*admin customer service*/
	                    case 5:
	                        $redirect='list-customer-service';
	                        break;
	                    default:
		                    $redirect='trashed-admins';
		                    break;
	                    }
		    		$this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record '.$status.' successfully.</div>');
						redirect($redirect);
		    		}else{
		    		$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot '.$status.'.</div>');
						redirect($redirect);	
		    		}
	   		}
	}
	/*
	@ list trashed App Users method
	*/
	public function trashAppUsers(){
		if(access_control_apx('users_manage','Trash')!=true){
			redirect(base_url('dashboard'));
			exit;	
		}
		$data['header']='Trashed users';
	    $data['breadcromb']='List Trashed App Users';
	    $data['title']='Trashed App Users';
	    $data['trashed_admins_data']=$this->admins_model->getUserAllData($where=array('adm.status'=>-1),$orderby='adm.id',$orderType='DESC',$iDisplayStart=NULL,$end=NULL);
		$this->index($data);
	}
	/*Trash App Users*/
	public function trashApUser(){
		if(access_control_apx('users_manage','Trash')!=true){
				redirect(base_url('dashboard'));
				exit;	
		}
		$delid=$this->uri->segment(2);
		$delData=$this->admins_model->select_single_record(array('id'=>$delid));
		if(!empty($delData)){
			switch($delData->role_id){
				/*Super admin check*/
                    case 1:
                        $redirect='list-super-admins';
                        break;
                /*admin check*/
                    case 2:
                        $redirect='list-admins';
                        break;
                /*admin account*/
                    case 3:
                        $redirect='list-accounts';
                        break;
                 /*admin oprations*/
                    case 4:
                        $redirect='list-operations';
                        break;
                 /*admin customer service*/
                    case 5:
                        $redirect='list-customer-service';
                        break;
                    default:
	                    $redirect='trashed-admins';
	                    break;

                    }
			$result= $this->admins_model->update_record(array('status'=>'-1'),array('id'=>$delid));
			if($result=true){
				$this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record Trashed successfully.</div>');
					redirect($redirect);
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot be Trashed.</div>');
					redirect($redirect);
			}
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access.</div>');
					redirect($redirect);
		}
	}
	/*Status change*/
	public function changeStatus(){
		if(access_control_apx('users_manage','Status')!=true){
				redirect(base_url('dashboard'));
				exit;	
		}
		$statusid=$this->uri->segment(2);
		$statusData=$this->admins_model->select_single_record(array('id'=>$statusid));
		 switch([$statusData->status,$statusData->role_id]){
                    case [-1,$statusData->role_id]:
                        $status='Restored';
                        $action='1';
                        $redirect='trashed-app-users';
                        break;
                    /*Super admin check*/
                    case [0,1]:
                        $status='Enabled';
                        $action='1';
                        $redirect='list-super-admins';
                        break;
                    case [1,1]:
                        $status='Blocked';
                        $action='2';
                        $redirect='list-super-admins';
                        break;
                    case [2,1]:
                        $status='Activated';
                        $action='1';
                        $redirect='list-super-admins';
                        break;
                    /*admin check*/
                    case [0,2]:
                        $status='Enabled';
                        $action='1';
                        $redirect='list-admins';
                        break;
                    case [1,2]:
                        $status='Blocked';
                        $action='2';
                        $redirect='list-admins';
                        break;
                    case [2,2]:
                        $status='Activated';
                        $action='1';
                        $redirect='list-admins';
                        break;
                     /*account check*/
                    case [0,3]:
                        $status='Enabled';
                        $action='1';
                        $redirect='list-accounts';
                        break;
                    case [1,3]:
                        $status='Blocked';
                        $action='2';
                        $redirect='list-accounts';
                        break;
                    case [2,3]:
                        $status='Activated';
                        $action='1';
                        $redirect='list-accounts';
                        break;
                    /*operations check*/
                    case [0,4]:
                        $status='Enabled';
                        $action='1';
                        $redirect='list-operations';
                        break;
                    case [1,4]:
                        $status='Blocked';
                        $action='2';
                        $redirect='list-operations';
                        break;
                    case [2,4]:
                        $status='Activated';
                        $action='1';
                        $redirect='list-operations';
                        break;
                     /*customer service check*/
                    case [0,5]:
                        $status='Enabled';
                        $action='1';
                        $redirect='list-customer-service';
                        break;
                    case [1,5]:
                        $status='Blocked';
                        $action='2';
                        $redirect='list-customer-service';
                        break;
                    case [2,5]:
                        $status='Activated';
                        $action='1';
                        $redirect='list-customer-service';
                        break;
                    default:
                        $status='Trashed Again';
                        $action='-1';
                        $redirect='dashboard';
                        break;
                    }

		if(!empty($statusData)){
			$result= $this->admins_model->update_record(array('status'=>$action),array('id'=>$statusid));
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
	/*Delete app user*/
	public function deleteAppUser(){
		if(access_control_apx('users_manage','Delete')!=true){
				redirect(base_url('dashboard'));
				exit;	
		}
		$delid=$this->uri->segment(2);
		$delData=$this->admins_model->select_single_record(array('id'=>$delid));
		if(!empty($delData)){
			$result= $this->admins_model->deleteRecord(array('id'=>$delid));
			if($result=true){
				$this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record Deleted successfully.</div>');
					redirect("trashed-app-users");
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot be Deleted.</div>');
					redirect(base_url("trashed-app-users"));
			}
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access.</div>');
					redirect(base_url("trashed-app-users"));
		}
	}
}

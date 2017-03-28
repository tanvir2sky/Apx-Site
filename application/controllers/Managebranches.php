<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Managebranches extends CI_Controller {

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
			$this->load->model('branches_model');
		}
	}
	/*
	@ Main page loading method
	*/
	public function index($data=NULL)
	{
		if(isset($data['trashed_branches_data'])){
			$this->base_model->load_metronic_theme('branches/view_trash_branches',$data);

		}else{
		   $this->base_model->load_metronic_theme('branches/view_branches',$data);
		}
	}
	/*
	@ List Branches  method
	*/
	public function listBranches(){
		$data['header']='Branches';
	    $data['breadcromb']='List Branches';
	    $data['title']='Branches';
	    $data['branches_data']=$this->branches_model->getBranchesAllData($where='brc.status <> -1',$orderby='brc.branch_id',$orderType='DESC',$iDisplayStart=NULL,$end=NULL);
		$this->index($data);
	}
	/*
	@ view Branch detail
	*/
	public function viewBranch(){
		$id=$this->uri->segment(2);
		$result=$this->base_model->select_single_record('apx_branches brc','*,(select countryName from apx_countries where countryCode=brc.countryCode) as country,(select user_name from apx_admin where id=brc.created_by) as created_name,(select user_name from apx_admin where id=brc.modified_by) as modify_name',array('branch_id'=>$id));
		$data['header']='Detail View';
	    $data['breadcromb']='detail view';
	    $data['title']='detail about '.($result!=""?$result->name:"Invalid");
		if($result){
			$data['detail_view']=$result;
		}else{
	       $data['no_data']='<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access</div>';
		}
		$this->base_model->load_metronic_theme('branches/view_branch',$data);

	}
	/*Add Branches method*/
	public function addBranch($data=NULL){
		//general data
		$data['header']='Add New Branch';
	    $data['breadcromb']='Add Branch';
	    $data['title']='Add Branch';
	    $data['country']=$this->base_model->allrecords('apx_countries','country_id,countryCode,countryName');
		$this->base_model->load_metronic_theme('branches/view_add_branches',$data);
	}
	/*Update Branch method*/
	public function editBranch(){
		if($this->uri->segment(2)){
			$id=$this->uri->segment(2);
			$result=$this->base_model->select_single_record('apx_branches','*',array('branch_id'=>$id));
		}else{
			$result=array('avoid_error'=>1);//just to avoid error in edit form no basic use any where
		}
		if($result){
			$data['edit_view']=$result;
		}else{
	       $data['no_data']='<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access</div>';
		}
		//general data
		$data['header']='Update Branch';
	    $data['breadcromb']='Update Branch';
	    $data['title']='Update Branch';
	    $data['country']=$this->base_model->allrecords('apx_countries','country_id,countryCode,countryName');
		$this->base_model->load_metronic_theme('branches/view_edit_branches',$data);
	}
	/*
	@ Add and Update Branch action
	*/
	public function addBranchAction(){
			$this->load->library('form_validation');
			//skip the unique condition in update on own value
			if(isset($_POST['update'])){
				$result=$this->base_model->select_single_record('apx_branches','*',array('branch_id'=>$this->input->post('bid')));
					if($result->code!=$this->input->post('code')){
						$this->form_validation->set_rules('code', 'branch code', 'trim|required|numeric|is_unique[apx_branches.code]');
					}
				}else{
					$this->form_validation->set_rules('code', 'branch code', 'trim|required|numeric|is_unique[apx_branches.code]');
				}
				$this->form_validation->set_rules('name', 'branch name', 'trim|required');
				$this->form_validation->set_rules('mname', 'manager name', 'trim|required');
				$this->form_validation->set_rules('bphone1', 'contact number 1', 'trim|required');
			
			if ($this->form_validation->run() == FALSE) {
				if(isset($_POST['add'])){
					$this->addBranch();
				}else if(isset($_POST['update'])){
					$this->editBranch();
				}
			}else{
					$data['code']=$this->input->post('code');
					$data['name']=$this->input->post('name');
					$data['manager']=$this->input->post('mname');
					$data['contactNu1']=$this->input->post('bphone1');
					$data['contactNu2']=$this->input->post('bphone2');
					$data['contactNu3']=$this->input->post('bphone3');
					$data['mangerContactNu']=$this->input->post('mphone');
					$data['addressLine1']=$this->input->post('address1');
					$data['addressLine2']=$this->input->post('address2');
					$data['countryCode']=$this->input->post('country');
					$data['state']=$this->input->post('state');
					$data['city']=$this->input->post('city');
					$data['zipCode']=$this->input->post('zipcode');
					$data[(isset($_POST['add'])?'created_by':'modified_by')]=$this->session->userdata('admin_users')['user_val'];
		    		$data[(isset($_POST['add'])?'created_date':'modified_date')]=date('Y-m-d H:i:s');

			    if(isset($_POST['add'])){
					$result=$this->base_model->insert_record('apx_branches',$data);
					$status='added';
				}else if(isset($_POST['update'])){
					$result=$this->base_model->update_record('apx_branches',$data,array('branch_id'=>$this->input->post('bid')));
					$status='updated';
				}
		    	if($result){
		    		$this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record '.$status.' successfully.</div>');
						redirect('list-branches');
		    		}else{
		    		$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot '.$status.'.</div>');
						redirect('list-branches');	
		    		}
	   		}
	}
	/*
	@ list trashed Branches
	*/
	public function trashedBranches(){
		$data['header']='Trashed Branches';
	    $data['breadcromb']='List Trashed Branches';
	    $data['title']='Trashed Branches';
	    $data['trashed_branches_data']=$this->branches_model->getBranchesAllData($where=array('brc.status'=>-1),$orderby='brc.branch_id',$orderType='DESC',$iDisplayStart=NULL,$end=NULL);
		$this->index($data);
	}
	/*Trash Branch*/
	public function trashBranch(){
		$trashId=$this->uri->segment(2);
		$trashData=$this->base_model->select_single_record('apx_branches','*',array('branch_id'=>$trashId));
		if(!empty($trashData)){
			$result= $this->base_model->update_record('apx_branches',array('status'=>'-1'),array('branch_id'=>$trashId));
			if($result=true){
				$this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record Trashed successfully.</div>');
					redirect('list-branches');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot be Trashed.</div>');
					redirect('list-branches');
			}
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access.</div>');
					redirect('list-branches');
		}
	}
	/*Status change*/
	public function changeStatus(){
		$statusid=$this->uri->segment(2);
		$statusData=$this->base_model->select_single_record('apx_branches','*',array('branch_id'=>$statusid));
		 switch($statusData->status){
                    case -1:
                        $status='Restored';
                        $action='1';
                        $redirect='trashed-branches';
                        break;
                    case 0:
                        $status='Enabled';
                        $action='1';
                        $redirect='list-branches';
                        break;
                    case 1:
                        $status='Blocked';
                        $action='2';
                        $redirect='list-branches';
                        break;
                    case 2:
                        $status='Activated';
                        $action='1';
                        $redirect='list-branches';
                        break;
                    default:
                        $status='Trashed Again';
                        $action='-1';
                        $redirect='dashboard';
                        break;
                    }

		if(!empty($statusData)){
			$result= $this->base_model->update_record('apx_branches',array('status'=>$action),array('branch_id'=>$statusid));
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
	/*Delete Branch*/
	public function deleteBranch(){
		$delid=$this->uri->segment(2);
		$delData=$this->base_model->select_single_record('apx_branches','*',array('branch_id'=>$delid));
		if(!empty($delData)){
			$result= $this->base_model->deleteRecord('apx_branches',array('branch_id'=>$delid));
			if($result=true){
				$this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record Deleted successfully.</div>');
					redirect("trashed-branches");
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot be Deleted.</div>');
					redirect(base_url("trashed-branches"));
			}
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access.</div>');
					redirect(base_url("trashed-branches"));
		}
	}
}

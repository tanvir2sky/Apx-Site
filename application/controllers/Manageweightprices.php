<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manageweightprices extends CI_Controller {

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
			$this->load->model('weight_prices_model','wp');
		}
	}
	/*
	@ Main page loading method
	*/
	public function index($data=NULL)
	{
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
	/*Upload csv*/
	public function uploadWpCsv($data=NULL){
		//general data
		$data['header']='Upload  Weight & Price';
	    $data['breadcromb']='Upload Weight & Prices';
	    $data['title']='Upload  Weight & Prices';
	    $data['price_list']=$this->base_model->allrecords('apx_price_list','list_id,listName,listCode',"","",$orderby='listName',$type='ASC');
	    /*echo '<pre>';
	    print_r($data);
	    exit;*/
		$this->base_model->load_metronic_theme('weight_prices/view_upload_weight_prices',$data);
	}
	/*Upload csv Action*/
	public function uploadWpCsvAction(){
		$colArray=array('weightFrom','weightTo','wPrice');
		if(isset($_FILES['userfile'])){
			$result=array();
			$error=array();
			$success=false;
			$priceList=$this->input->post('wp_price_list');
			$zoneList=$this->input->post('zone_listing');
			$name	= $this->session->userdata('admin_users')['username'];
			$config = array(
						'upload_path' => "./uploads/temp",
						'allowed_types' => "csv|xlsx",
						'overwrite' => FALSE,
						'file_name' => 'wp_'.$name."_".date('Y-m-d')
						);
		     $this->load->library('upload', $config);
		     if(($priceList=="" || $priceList=="Error")&& ($zoneList=="" || $zoneList=="Error")){
				$data['error']="Please select zone and price list.";
				$this->uploadWpCsv($data);
			  }else if(!$this->upload->do_upload()){
			 	$data['error'] = $this->upload->display_errors();
			 	$this->uploadWpCsv($data);
			  }
			 else{
			 	$data=array();
			 	$this->load->library('csvreader');
			 	$filearray = array('upload_data' => $this->upload->data());
				$filename = $filearray['upload_data']['file_name'];
                $result =   $this->csvreader->parse_file('./uploads/temp/'.$filename,$colArray);//path 
                //Add file data into db
                if(is_array($result) && !empty($result)){
                	foreach ($result as $key => $value) {
                    	if(!empty($priceList)  && !empty($zoneList)){
                    		$data['list_id']=$priceList;
                    		$data['zone_id']=$zoneList;
                    		$data['weight_from']=$value['weightFrom'];
                    		$data['weight_to']=$value['weightTo'];
                    		$data['wprice']=$value['wPrice'];
                    		if($this->checkDuplicate($priceList,$zoneList,$value['weightFrom'],$value['weightTo'])==true){
                    			$data['modified_by']=$this->session->userdata('admin_users')['user_val'];
								$data['modified_date']=date('Y-m-d H:i:s');
								$updation=$this->base_model->update_record('apx_weight_prices',
								$data,array('list_id'=>$priceList,'zone_id'=>$zoneList,
									'weight_from'=>$value['weightFrom'],'weight_to'=>$value['weightTo']));
									if($updation){
						    			$data=array();
						    			$success=true;
							    	}else{
							    		$error[]=$result[$key];
							    	}

                    		}else{
	                    		$data['created_by']=$this->session->userdata('admin_users')['user_val'];
							    $data['created_date']=date('Y-m-d H:i:s');
							    $insertion=$this->base_model->insert_record('apx_weight_prices',$data);
								if($insertion){
					    			$data=array();
					    			$success=true;
						    	}else{
						    		$error[]=$result[$key];
						    	}
						      }
							}else{
								$error[]=$result[$key];
						}
                	}
                }
               if($success==true && array_key_exists(0, $error)){
               	$columnName=array('Weight From','Weight To','Price');
               	$this->writeCsv($error,$columnName,$filename);
               	$str='Weight and prices added successfully with some error.<a href="'.base_url().'uploads/temp/'.$filename.'">View file</a>';
               	$message=array(
	                    	'from_id'=>0,
	                    	'to_id'=>$this->session->userdata('admin_users')['user_val'],
	                    	'message'=>$str,
	                    	'file'=>$filename,
	                    	'created_date'=>date('Y-m-d H:i:s')
	                    	);
	                    	 $this->base_model->insert_record('apx_messages',$message);
               	$this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$str.'</div>');
					redirect('list-pricelist');

               }else if($success==true && !array_key_exists(0, $error)){
               	$this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Weight and prices added successfully.</div>');
					redirect('list-pricelist');
               }else{
               	$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Weight and prices can not be added.Strong reason is not proper zone or price lists.please try again.</div>');
					redirect('list-pricelist');
               }
			 }
		}
	}
	/*get zone*/
	public function getWpZones(){
		if(isset($_POST['listId'])){
			$priceList=$this->input->post('listId');
			$data=$this->base_model->allrecords('apx_zone','zone_id,list_id,zoneName',array('list_id'=>$priceList),"array",$orderby='zoneName',$type='ASC');
			echo json_encode($data);
		}
	}
	/*get the duplicate weight & price list*/
	protected function checkDuplicate($listId,$zoneId,$weightFrom,$weightTo){
		$result=$this->base_model->select_single_record('apx_weight_prices','*',array('list_id'=>$listId,'zone_id'=>$zoneId,'weight_from'=>$weightFrom,'weight_to'=>$weightTo));
		if($result){
			return true;
		}else{
			return false;
		}	
	}
	/*csv generator*/
	protected  function writeCsv($row,$column,$filename){
		$output = fopen("./uploads/temp/".$filename,'w');
		fputcsv($output, $column);
		foreach($row as $value) {
		    fputcsv($output, $value);
		}
		fclose($output);
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

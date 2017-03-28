<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manageshipments extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('admin_users')){
			redirect(base_url('login'));
		}else{
			$this->load->model('base_model');
			$this->load->model('shipment_model');
			$defaultListData=$this->base_model->select_single_record('apx_price_list','list_id',array('status'=>1));
			$this->defaultList=$defaultListData->list_id;
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
		
		if(isset($data['trashed_shipment_data'])){
			$this->base_model->load_metronic_theme('shipment/view_trash_shipment',$data);
		}else{
			$this->base_model->load_metronic_theme('shipment/view_shipment',$data);
		}
	}
	/*
	@ List shipment list setting  method
	*/
	public function listShipment(){
		$data['header']='Shipment Listing';
	    $data['breadcromb']='Shipment';
	    $data['title']='Shipment List';
		$this->index($data);
	}
	/*
	@ List Shipment data
	*/
	public function listData(){
	  if(isset($_POST['sEcho'])){
	  	$where='shp.status <> -1';
	  	if($_REQUEST['sSearch']!=""){
	  		$where.=' AND air_way_number LIKE "'.$_REQUEST['sSearch'].'%"';
	  		$where.=' OR accountNumber   LIKE "'.$_REQUEST['sSearch'].'%"';
	  		$where.=' OR companyName     LIKE "'.$_REQUEST['sSearch'].'%"';
	  		$where.=' OR shipBalance     LIKE "'.$_REQUEST['sSearch'].'%"';

	  	}
		$sEcho = intval($_REQUEST['sEcho']);
		$records = array();
		$records["aaData"] = array(); 
		$iTotalRecords=$this->base_model->count_record('apx_shipment shp',$where);
		//For detail only
		if($_REQUEST['sSearch']!=""){
			$where.=' OR listName 		 LIKE "'.$_REQUEST['sSearch'].'%"';
		}
		$iDisplayLength = intval($_REQUEST['iDisplayLength']);
		$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
		$iDisplayStart = intval($_REQUEST['iDisplayStart']);
		$end =$iDisplayLength;
		$result=$this->shipment_model->getShipmentAllData($where,$orderby='shp.ship_id',$orderType='ASC',$iDisplayStart=NULL,$end=NULL);
		if(is_array($result) && !empty($result)){
			$count=1;
            foreach($result as $value) {
            	switch($value['status']){
                    case 'Intransit':
                        $status='In transit';
                        $statusclass='warning';
                        $action="Mark Delivered";
                        break;
                    case 'Delivered':
                        $status='Delivered';
                        $statusclass='success';
                        $action="Mark Billed";
                        break;
                    case 'Billed':
                        $status='Billed';
                        $statusclass='success';
                        $action="Mark Un Billed";
                        break;
                    case 'UnBilled':
                        $status='Un Billed';
                        $statusclass='warning';
                        $action="Mark Billed";
                        break;
                    case 'Partial':
                        $status='Partial';
                        $statusclass='info';
                        $action="Mark Intransit";
                        break;
                    default:
                        $status='Problem';
                        $statusclass='danger';
                        $action="Mark Intransit";
                        break;
                    }
				$records["aaData"][] = array(
					    'DT_RowId'=> "row_".$value['ship_id']."",
            			'DT_RowClass'=> "gradeA",
					    '<input type="checkbox" name="ship_ID" value="'.$value['ship_id'].'" />',
		                $count++,
		                $value['air_way_number'],
		                $value['accountNumber'],
		                $value['companyName'],
		                $value['receiverCompany'],
		                $value['listName'],
		                $value['shipBalance'],
		                '<span class="label label-sm label-'.$statusclass.'">'.$status.'</span>',
		                '<a title="Edit" href="'.base_url().'edit-shipment/'.$value['ship_id'].'"><i class="icon-edit"></i> Edit</a>&nbsp;&nbsp;<a title="Trash" href="javascript:confirmDelete('.base_url().'trash-shipment/'. 
                  $value['ship_id'].',"Trash")"><i class="icon-trash"></i> Trash</a>&nbsp;&nbsp;
                  <a href="'.base_url().'show-shipment/'.$value['ship_id'].'" title="Detail"><i class="icon-eye-open"></i> Detail</a>'
                  );
			}
		}
		//$records["limit"]=array('start'=>$iDisplayStart,'end'=>$end);
		$records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;
        echo json_encode($records);
	   }

	}
	/*Add New Shipment method*/
	public function addShipment($listId=NULL){
		//general data
		if($listId!=NULL){
			$defaultList=$listId;
		}else{
			$defaultList=$this->defaultList;
		}
		$data['header']='Add New Shipment';
	    $data['breadcromb']='Add Shipment';
	    $data['title']='Add Shipment';
	    $data['price_list']=$this->base_model->allrecords('apx_price_list','list_id,listName,listCode',"status=1");
	    $data['customer']=$this->base_model->allrecords('apx_customer','customer_id,accountNumber,companyName',array('status'=>1));
	    $data['country']=$this->base_model->allrecords('apx_countries','country_id,countryCode,countryName','countryCode IN (SELECT countryCode FROM apx_zone_countries WHERE list_id='.$defaultList.')');
	    /*echo '<pre>';
	    print_r($data);
	    exit;*/
		$this->base_model->load_metronic_theme('shipment/view_add_shipment',$data);
	}
	/*Get customer info*/
	public function getCustomerInfo(){
		if(isset($_POST['id'])){
			$customerId=$this->input->post('id');
			$select="companyName as company,firstName as fname,lastName as lname,addressLine1 as address1,addressLine2 as address2,(select countryName from apx_countries where countryCode=apx_customer.countryCode) as country,state,city,zipCode,phone";
			$result=$this->base_model->select_single_record('apx_customer',''.$select.'',array('accountNumber'=>$customerId,'status'=>1));
			if(!empty($result)){
				$result->ship_user=$this->session->userdata('admin_users')['username'];
				echo json_encode($result);
			}
		}
	}
	//Get Price list countries
	public function getZoneCountries(){
		if(isset($_POST['listId'])){
			$list_id=$this->input->post('listId');
			$countrydata=$this->base_model->allrecords('apx_countries','country_id,countryCode,countryName','countryCode IN (SELECT countryCode FROM apx_zone_countries WHERE list_id='.$list_id.')');
			echo json_encode($countrydata);
		}
	}
	/*Get Rate list for selected country*/
	public function getRateList(){
		$result=array();
		if(isset($_POST['country_code']) && isset($_POST['list_id'])){
			$listId = $this->input->post('list_id');
			$weightVal= $this->input->post('weight_val');
			$countryCode = $this->input->post('country_code');
			if($listId=="" || $listId=='Service'){
				$result = array('message' => 'Error','data'=>'Please select a valid service.');
				echo json_encode($result);
			}
			else if($countryCode=="" || $countryCode=="Country"){
				$result = array('message' => 'Error','data'=>'Please select a country to proceed.');
				echo json_encode($result);
			}
			else if($weightVal==""){
				$result = array('message' => 'Error','data'=>'Please fill weight field.');
				echo json_encode($result);
			}
			else {
				$data=$this->get_price_count($listId,$countryCode,$weightVal);
				$result = array('message' => 'Success','data'=>$data);
				echo json_encode($result);
			}
		}

	}
	//get th price calculation
	protected function get_price_count($listId,$countryCode,$weightVal){
		//get that rate list
				$tabel	 = 'apx_zone as zn';
				$select	 = 'awp.wprice';
				$where['where'] ='`zct`.`countryCode` = "'.$countryCode.'" AND `pl`.`status` = 1 AND `pl`.`list_id` = '.$listId.' AND '.$weightVal.' BETWEEN `awp`.`weight_from` AND `awp`.`weight_to`';

				$jointabeles = array(
					array(
					'joined_name'	=>	'apx_zone_countries as zct',
					'joined_id'		=>	'zct.zone_id',
					'tabel_id'		=>	'zn.zone_id',
					'type'			=>	''
					),
					array(
					'joined_name'	=>	'apx_weight_prices awp',
					'joined_id'		=>	'awp.zone_id',
					'tabel_id'		=>	'zn.zone_id',
					'type'			=>	''
					),
					array(
					'joined_name'	=>	'apx_price_list pl',
					'joined_id'		=>	'pl.list_id',
					'tabel_id'		=>	'zn.list_id',
					'type'			=>	''
					)
				);
				return $this->base_model->select_single_record_with_join($tabel,$jointabeles,$select,$where);

	}
	/*get price list ID by code*/
	protected function shipmentListId($code){
		$result=$this->base_model->select_single_record('apx_price_list','*',array('listCode'=>$code));
		if($result){
			return $result->list_id;
		}else{
			return false;
		}	
	}
	/*get the duplicate air way code*/
	protected function checkDuplicate($airWayNu){
		$result=$this->base_model->select_single_record('apx_shipment','*',array('air_way_number'=>$airWayNu));
		if($result){
			return true;
		}else{
			return false;
		}	
	}
	/*csv generator*/
	protected  function writeCsv($row,$column,$filename){
		$output = fopen("./uploads/temp/".$filename,'w');
		/*header("Content-Type:application/csv"); 
		header("Content-Disposition:attachment;filename=".$filename.""); 
		header("Pragma: no-cache");
        header("Expires: 0");*/
		fputcsv($output, $column);
		foreach($row as $value) {
		    fputcsv($output, $value);
		}
		fclose($output);
	}
	/*Update Shipment method*/
	public function editShipment($shipid=NULL){
		//general data
		$data['header']='Update Shipment';
	    $data['breadcromb']='Update Shipment';
	    $data['title']='Update Shipment';
		if($this->uri->segment(2)){
			$id=$this->uri->segment(2);
			$result=$this->base_model->select_single_record('apx_shipment','*',array('ship_id'=>$id));
		}else if($shipid!=NULL){
			$id=$shipid;
			$result=$this->base_model->select_single_record('apx_shipment','*',array('ship_id'=>$id));
		}else{
			$result=array('avoid_error'=>1);//just to avoid error in edit form no basic use any where
		}
		if($result){
			$data['edit_view']=$result;
			$data['price_list']=$this->base_model->allrecords('apx_price_list','list_id,listName,listCode',"status=1");
	    	$data['customer']=$this->base_model->allrecords('apx_customer','customer_id,accountNumber,companyName',array('status'=>1));
	    	$data['country']=$this->base_model->allrecords('apx_countries','country_id,countryCode,countryName','countryCode IN (SELECT countryCode FROM apx_zone_countries WHERE list_id='.$result->shipPriceList.')');
		}else{
	       $data['no_data']='<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access</div>';
		}
		$this->base_model->load_metronic_theme('shipment/view_edit_shipment',$data);
	}
	/*
	@ Add and Update Shipment action
	*/
	public function addShipmentAction(){
		 /* echo '<pre>';
		  print_r($_POST);
		  exit;*/
			$this->load->library('form_validation');
			if(isset($_POST['update'])){
				$shipmentData=$this->base_model->select_single_record('apx_shipment','*',array('ship_id'=>$this->input->post('shipid')));
				if($shipmentData->air_way_number!=$this->input->post('airway_bill_number')){
					$this->form_validation->set_rules('airway_bill_number', 'airway bill number', 'trim|required|is_unique[apx_shipment.air_way_number]');
				}else{
					$this->form_validation->set_rules('airway_bill_number', 'airway bill number', 'trim|required');
				}
			}else{
				$this->form_validation->set_rules('airway_bill_number', 'airway bill number', 'trim|required|is_unique[apx_shipment.air_way_number]');
			}
			if($this->input->post('shiper_code')=='ACN'){
			$this->form_validation->set_message('required', 'Please select the account number.');
			}
			$this->form_validation->set_rules('shiper_code', 'account number', 'trim|required');
			$this->form_validation->set_rules('shiper_company', 'account holder', 'trim|required');
			$this->form_validation->set_rules('shiper_name', 'shiper name', 'trim|required');
			$this->form_validation->set_rules('ship_user', 'user name', 'trim|required');
			$this->form_validation->set_rules('receiver_company', 'receiver company name', 'trim|required');
			$this->form_validation->set_rules('receiver_name', 'receiver name', 'trim|required');
			$this->form_validation->set_rules('receiver_address1', 'receiver address 1', 'trim|required');
			$this->form_validation->set_rules('ship_type', 'ship type', 'trim|required|in_list[Dox,N-Dox]');
			if($this->input->post('ship_service')=='Service'){
			$this->form_validation->set_message('required', 'Please  select the valid service code.');
			}
			if($this->input->post('receiver_country')=='Country'){
			$this->form_validation->set_message('required', 'Please select a valid service and than select country to proceed.');
			}
			$this->form_validation->set_rules('ship_weight', 'total weight', 'trim|required');
			$this->form_validation->set_rules('total_payed', 'total paid', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				if(isset($_POST['add'])){
					$this->addShipment(trim($this->input->post('ship_service')));
				}else if(isset($_POST['update'])){
					$this->editShipment($this->input->post('shipid'));
				}
			}else{  
					$data['air_way_number']=$this->input->post('airway_bill_number'); 
					$data['tracking_number']=$this->input->post('track_number');
					$data['accountNumber']=$this->input->post('shiper_code');
					$data['companyName']=$this->input->post('shiper_company');
					$data['shiperName']=$this->input->post('shiper_name');
					$data['address2']=$this->input->post('shiper_address1');
					$data['address2']=$this->input->post('shiper_address2');
					$data['city']=$this->input->post('shiper_city');
					$data['state']=$this->input->post('shiper_state');
					$data['country']=$this->input->post('shiper_country');
					$data['zipCode']=$this->input->post('shiper_zip');
					$data['phone']=$this->input->post('shiper_phone');
					$data['userName']=$this->input->post('ship_user');
					$data['date']=$this->input->post('ship_date');
					$data['time']=$this->input->post('ship_time');
					$data['shiper_ref']=$this->input->post('shiper_ref');
					$data['shiper_content']=$this->input->post('ship_des');
					$data['shiper_value']=$this->input->post('ship_val');
					$data['sample_invoice']=$this->input->post('ship_sample');
					$data['receiverCompany']=$this->input->post('receiver_company');
					$data['receiverName']=$this->input->post('receiver_name');
					$data['receiverAddress1']=$this->input->post('receiver_address1');
					$data['receiverAddress2']=$this->input->post('receiver_address2');
					$data['receiverCity']=$this->input->post('receiver_city');
					$data['receiverState']=$this->input->post('receiver_state');
					$data['receiverCountry']=$this->input->post('receiver_country');
					$data['receiverZipcode']=$this->input->post('receiver_zip');
					$data['receiverPhone']=$this->input->post('receiver_phone');
					$data['receiverMobile']=$this->input->post('receiver_mobile');
					$data['shipType']=$this->input->post('ship_type');
					$data['shipWeight']=$this->input->post('ship_weight');
					$data['shipPcs']=$this->input->post('ship_pcs');
					$data['shipPriceList']=trim($this->input->post('ship_service'));
					$data['shipPayment']=$this->input->post('total_payment');
					$data['shipPaid']=$this->input->post('total_payed');
					$data['shipBalance']=$this->input->post('total_balance');
					$data['shipInstruction']=$this->input->post('ship_instruction');
					$data[(isset($_POST['add'])?'created_by':'modified_by')]=$this->session->userdata('admin_users')['user_val'];
		    		$data[(isset($_POST['add'])?'created_date':'modified_date')]=date('Y-m-d H:i:s');
			    if(isset($_POST['add'])){
					$result=$this->base_model->insert_record('apx_shipment',$data);
					$status='added';
				}else if(isset($_POST['update'])){
					$result=$this->base_model->update_record('apx_shipment',$data,array('ship_id'=>$this->input->post('shipid')));
					$status='updated';
				}
		    	if($result){
		    		$this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record '.$status.' successfully.</div>');
						redirect('list-shipments');
		    		}else{
		    		$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot '.$status.'.</div>');
						redirect('list-shipments');	
		    		}
	   		}
	}
	/*upload shipment*/
	public function uploadShipment($data=NULL){
		//general data
		$data['header']='Shipment Upload';
	    $data['breadcromb']='Shipment Upload';
	    $data['title']='Shipment Upload';
		$id=$this->uri->segment(2);
		$this->base_model->load_metronic_theme('shipment/view_upload_shipment',$data);
	}
	/*upload shipment action*/
	public function uploadShipmentAction(){
		$dbvalues=array('air_way_number','tracking_number','accountNumber','companyName','shiperName','address1','address2','city','state','country','zipCode','phone','shiper_ref','shiper_content','shiper_value','receiverCompany','receiverName','receiverAddress1','receiverAddress2','receiverCity','receiverState','shipPriceList','receiverCountry','receiverZipcode','receiverPhone','receiverMobile','shipType','shipWeight','shipPcs','shipPaid','shipInstruction','status');
		/*echo '<pre>';
		print_r($dbvalues);
		exit;*/
		if(isset($_FILES['userfile'])){
			$result=array();
			$error=array();
			$success=false;
			$name	= $this->session->userdata('admin_users')['username'];
			$config = array(
							'upload_path' => "./uploads/temp",
							'allowed_types' => "csv|xlsx",
							'overwrite' => FALSE,
							'file_name' => 'shipment_'.$name."_".date('Y-m-d')
							);
		     $this->load->library('upload', $config);
		     if(!$this->upload->do_upload()){
			 	$data['error'] = $this->upload->display_errors();
			  	$this->uploadShipment($data);
			  }
			 else{
				 	$data=array();
				 	$this->load->library('csvreader');
				 	$filearray = array('upload_data' => $this->upload->data());
					$filename = $filearray['upload_data']['file_name'];
                    $result =   $this->csvreader->parse_file('./uploads/temp/'.$filename,$dbvalues);//path 
                    if(is_array($result) && !empty($result)){
                    	foreach ($result as $key => $value) {
                    	    //Get the price list id from price list code
                    		$listID = $this->shipmentListId($value['shipPriceList']);
                    		//Get the country code from csv
                    		//Get the the total price from weight and price list and country code
                    		$paymentPrice=$this->get_price_count($listID,$value['receiverCountry'],$value['shipWeight']);
                    		if($this->checkDuplicate($value['air_way_number'])==false && isset($paymentPrice->wprice) && $paymentPrice->wprice!=""){
		                    		$data=$result[$key];
		                    		$data['shipPriceList']=$listID;
		                    		$data['shipPayment'] = $paymentPrice->wprice;
		                    		//calculate the balance
		                    		$data['shipBalance']=(($paymentPrice->wprice)-($value['shipPaid']));
									$data['userName']=$this->session->userdata('admin_users')['username'];
									$data['date']=date('Y-m-d');
									$data['time']=date('H:i:s');
									$data['created_by']=$this->session->userdata('admin_users')['user_val'];
						    		$data['created_date']=date('Y-m-d H:i:s');
						    		$insertion=$this->base_model->insert_record('apx_shipment',$data);
						    		if($insertion){
						    			$data=array();
						    			$success=true;
						    		}else{
						    			$error[]=$result[$key];
						    		}
								}else{
									$error[]=$result[$key];

								}
                    	}
                    	if(array_key_exists(0, $error)){
	                    	$columnName=array('Air Way Bill Number','Tracking Number','Account Number','Account Holder Name','Shiper Name','Address Line 1','Address Line 2','City','State','Country','Zip','Phone','Shiper Reference','Shipment Content','Shipment Value','Reciever Company','Receiver Name','Receiver Address Line 1','Receiver Address Line 2','Receiver City','Receiver State','Price list Service','Zone Country','Reciever Zip','Reciever Phone','Reciever Mobile','Ship Type','Weight','PCS','Total paid','Shipment Instruction','Status');
	                    	$this->writeCsv($error,$columnName,$filename);
	                    	$str='The attached data cannot be uploaded due to some error or duplicat airway number or invalid data.Please click the below link to view the file.<br/><a href="'.base_url().'uploads/temp/'.$filename.'">View file</a>';
	                    	$message=array(
	                    		'from_id'=>0,
	                    		'to_id'=>$this->session->userdata('admin_users')['user_val'],
	                    		'message'=>$str,
	                    		'file'=>$filename,
	                    		'created_date'=>date('Y-m-d H:i:s')
	                    		);
	                    	 $this->base_model->insert_record('apx_messages',$message);
	                    	 if($success==false){
	                    	 	$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>No record uploaded please check inbox message. or <a href="'.base_url().'uploads/temp/'.$filename.'">View file</a></div>');
	                    	 }else{
	                    	 	$this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Records uploaded with error please check inbox message. or <a href="'.base_url().'uploads/temp/'.$filename.'">View file</a></div>');
	                    	 }
                    	}else{
                    		$this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Records Uploaded successfully.</div>');
                    	}
                    }
                    redirect('list-shipments');
				}
			}

	}
	/*View detail shipment*/
	public function showShipment(){
		//general data
		$data['header']='Shipment Detail';
	    $data['breadcromb']='Shipment Detail';
	    $data['title']='Shipment Detail';
		$id=$this->uri->segment(2);
		$data['ship_detail']=$this->base_model->select_single_record('apx_shipment','*',array('ship_id'=>$id));
		$this->base_model->load_metronic_theme('shipment/view_detail_shipment',$data);
	}
    /*Status change*/
	public function changeStatus(){
		$statusid=$this->uri->segment(2);
		$statusData=$this->base_model->select_single_record('apx_shipment','*',array('ship_id'=>$statusid));
		switch($statusData->status){
                    case 'Intransit':
                        $status='Marked Delivered';
                        $action='Delivered';
                        $redirect='list-shipments';
                        break;
                    case 'Delivered':
                        $status='Marked Billed';
                        $action='Billed';
                        $redirect='list-shipments';
                        break;
                    case 'Billed':
                        $status='Marked Un Billed';
                        $action='UnBilled';
                        $redirect='list-shipments';
                        break;
                    case 'UnBilled':
                        $status='Marked Billed';
                        $action='Billed';
                        $redirect='list-shipments';
                        break;
                    case 'Partial':
                        $status='Marked In transit';
                        $action='Intransit';
                        $redirect='list-shipments';
                        break;
                    default:
                        $status='Problem';
                        $action='Intransit';
                        $redirect='list-shipments';
                        break;
                    }

		if(!empty($statusData)){
			$result= $this->base_model->update_record('apx_shipment',array('status'=>$action),array('ship_id'=>$statusid));
			if($result=true){
				$this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record '.$status.' successfully.</div>');
					redirect(base_url($redirect));
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot be '.$status.'.</div>');
					redirect(base_url($redirect));
			}
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access.</div>');
					redirect('list-shipments');
		}
	}
	/*
	@ list trashed Shipment
	*/
	public function trashedShipment(){
		$data['header']='Trashed Shipment';
	    $data['breadcromb']='List Trashed Shipment';
	    $data['title']='Trashed Shipment';
	    $data['trashed_shipment_data']=$this->shipment_model->getShipmentAllData($where=array('shp.status'=>-1),$orderby='shp.ship_id',$orderType='ASC',$iDisplayStart=NULL,$end=NULL);
		$this->index($data);
	}
	/*Trash Shipment*/
	public function trashShipment(){
		$trashId=$this->uri->segment(2);
		$trashData=$this->base_model->select_single_record('apx_shipment','*',array('ship_id'=>$trashId));
		if(!empty($trashData)){
			$result= $this->base_model->update_record('apx_shipment',array('status'=>'-1'),array('ship_id'=>$trashId));
			if($result=true){
				$this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record Trashed successfully.</div>');
					redirect('list-shipments');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot be Trashed.</div>');
					redirect('list-shipments');
			}
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access.</div>');
					redirect('list-shipments');
		}
	}
	/*Delete Shipment*/
	public function deleteShipment(){
		$delid=$this->uri->segment(2);
		$delData=$this->base_model->select_single_record('apx_shipment','*',array('ship_id'=>$delid));
		if(!empty($delData)){
			$result= $this->base_model->deleteRecord('apx_shipment',array('ship_id'=>$delid));
			if($result=true){
				$this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record Deleted successfully.</div>');
					redirect('trashed-shipment');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot be Deleted.</div>');
					redirect('trashed-shipment');
			}
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access.</div>');
					redirect('trashed-shipment');
		}
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manageledger extends CI_Controller {

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
			//$this->shipmentPermission = $this->shipment_model->getshipStatusPermission($this->session->userdata('admin_users')['user_type']);
			$this->actionPermission = $this->shipment_model->actionPermission($this->session->userdata('admin_users')['user_type']);
		}
	}
	/*Ledger List*/
	public function listLedger(){
		$data['header']='Ledger Listing';
	    $data['breadcromb']='Ledger';
	    $data['title']='Ledger List';
	    $data['customer']=$this->base_model->allrecords('apx_customer','customer_id,accountNumber,companyName',array('status'=>1));
		$this->base_model->load_metronic_theme('ledger/view_ledger',$data);
	}
	/*
	@ List Shipment data
	*/
	public function listLedgerData(){
	  if(isset($_POST['sEcho'])){
	  	$filter = json_decode($_REQUEST['sSearch']);


	  	if(is_object($filter)){
	  	    if($filter->acnumber==111111111){
		  		if($this->session->userdata('acc_session')!=""){
		  			$accountNumber=$this->session->userdata('acc_session');
		  		}else{
		  			$accountNumber=0;
		  		}
		  	}else{
		  		$accountNumber=$filter->acnumber;
		  		$this->session->set_userdata('acc_session',$filter->acnumber);
		  	}

	  	}else{
         $accountNumber=0;
	  	}


          $where='WHERE accountNumber='.$accountNumber.'';
	  	if(isset($filter->datefrom) && isset($filter->dateto)){
	  		$where.=" AND (ledgerDate BETWEEN '".$filter->datefrom."' AND '".$filter->dateto."')";

	  	}else{

	  	}
		$sEcho = intval($_REQUEST['sEcho']);
		$records = array();
		$records["aaData"] = array(); 
		$totalRow=$this->shipment_model->getLedgerData($accountNumber,$where);
		$iTotalRecords=count($totalRow); 
		$iDisplayLength = intval($_REQUEST['iDisplayLength']);
		$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
		$iDisplayStart = intval($_REQUEST['iDisplayStart']);
		$end =$iDisplayLength;
		/*GET THE SHIPMENT DATA*/
		$result=$this->shipment_model->getLedgerData($accountNumber,$where,$limit=array($iDisplayStart,$end));
		/*echo "<pre>";
		print_r($result);
		exit;*/
		
		/*GET THE OPEN BALANCE*/
		$openblc=$this->base_model->select_single_record('apx_balance_tbl','*',array('balanceType'=>'Open','accountNumber'=>$accountNumber));
		if($openblc){
			$openBalance=$openblc->balanceAmount;	
		}else{
        	$openBalance=0;
		}
		/*GET THE FIRST ENTRY OF ACCOUNT*/
		$firstENTRY=$this->base_model->select_single_record('apx_shipment','MIN(ship_id) as firstEntry',array('trash'=>0,'accountNumber'=>$accountNumber));
		if($firstENTRY){
			$firstRow=$firstENTRY->firstEntry;

		}else{
            $firstRow="";
		}
		if(is_array($result) && !empty($result)){
			$count=$iDisplayStart+1;
			$blnc=0+$openBalance;
			$crd=0;
			$dbt=0;
            $openBalance=0;
            foreach($result as $value) {

            	    $crd=$crd+($value['id']==$firstRow?$openBalance+$value['creditBalance']:$value['creditBalance']);
            	    $dbt=$dbt+$value['shipBalance'];
            		$blnc=$blnc+$value['shipBalance']-$value['creditBalance'];
					$records["aaData"][] = array(
						    'DT_RowId'=> 'row_".$count++."',
						    'DT_RowClass'=> "gradeA",
						    $count++,
						    date('d-m-Y',strtotime($value['ledgerDate'])),
						    $value['awb'],
						    $value['accountNumber'],
						    ($value['payType']=='ship'?($value['id']==$firstRow?'Open':'---'):$value['payType']),
						    $value['payDescription'],
						    ($value['receiverCountry']!='---'?convert_val('country',$value['receiverCountry']):$value['receiverCountry']),
						    $value['listName'],
						    $value['shipType'],
						    $value['shipWeight'].($value['payType']=='ship'?' kg':''),
						    $value['shipPcs'],
						    $value['shipBalance'],
						    ($value['id']==$firstRow?$openBalance+$value['creditBalance']:$value['creditBalance']),
						    $blnc,
						    (access_control_apx('ship_manage','Read')==true?'<a href="'.($value['id']=='NULL'?'#':base_url().'show-shipment/'.trim($value['id'])).'" title="Detail"><i class="icon-eye-open"></i> Detail</a>':''));
			}
			$records["aaData"][($count-1)]=array(
				'DT_RowId'=> 'row_end',
	            'DT_RowClass'=> 'alert-info'
	            ,''
	            ,''
	            ,''
	            ,''
	            ,''
	            ,''
	            ,''
	            ,''
	            ,''
	            ,''
	            ,'Total Balance'
	            ,$dbt
	            ,$crd
	            ,$blnc
	            ,''
				);
		}
		$records["limit"]=array('start'=>$iDisplayStart,'end'=>$end);
		$records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;
        echo json_encode($records);
	   }

	}
	//pdf report of ledger
	public function pdfLedgerData(){
        if(isset($_POST['acnumber'])){
            $where='shp.status <> -1 AND shp.accountNumber="'.(isset($_POST['acnumber'])?$_POST['acnumber']:0).'"';
            if(isset($_POST['from']) && $_POST['from']!="" && isset($_POST['to']) && $_POST['to']!=""){
                $where.=" AND (date BETWEEN '".date('Y-m-d',strtotime($_POST['from']))."' AND '".date('Y-m-d',strtotime($_POST['to']))."')";

            }else{

            }
            $result['pdf_data']=$this->shipment_model->getShipmentAllData($where,$orderby='shp.ship_id',$orderType='ASC',$iDisplayStart=0,$end=-1);

		     if(count($result['pdf_data']) == 0){
		    	 echo json_encode(array('message'=>'No data found please make a New search to export pdf !'));
		    }else if(count($result['pdf_data']) > 25){
		    	 echo json_encode(array('message'=>'The data is too large please make a short search to export pdf !'));
		    }
		  	else{
		  	  //$this->load->view('ledger/pdf_ledger',$result);
		  	  $pdfName = "ledger_".$_POST['acnumber']."_".time().".pdf";
			  $this->load->library('pdf');
			  $this->pdf->load_view('ledger/pdf_ledger',$result);
			  $this->pdf->set_paper('A4', 'landscape');
			  $this->pdf->render();
			  $pdf =  $this->pdf->output();
			  $file_location = './uploads/temp/'.$pdfName;
			  file_put_contents($file_location,$pdf); 
			  echo json_encode(array('message'=>'Success','file'=>$pdfName));
		  	}
		}
	}

	/*
	 * exlcel ledger data
	 */

    public function excelLedgerData(){
        if(isset($_POST['acnumber'])){
            $where='shp.status <> -1 AND shp.accountNumber="'.(isset($_POST['acnumber'])?$_POST['acnumber']:0).'"';
            if(isset($_POST['from']) && $_POST['from']!="" && isset($_POST['to']) && $_POST['to']!=""){
                $where.=" AND (date BETWEEN '".date('Y-m-d',strtotime($_POST['from']))."' AND '".date('Y-m-d',strtotime($_POST['to']))."')";

            }else{

            }
            $result['pdf_data']=$this->shipment_model->getShipmentAllData($where,$orderby='shp.ship_id',$orderType='ASC',$iDisplayStart=0,$end=-1);


            $data = array();
            $row=array();
            $count = 1;
            $blnc  = 0;
            foreach ($result['pdf_data'] as $value){
                $blnc = +($blnc + 0 - $value['shipBalance']);
                $data["sr_no"] = $count;
                $data["sate"] = date('d-m-Y', strtotime($value['date']));
                $data["awb_number"] = $value['air_way_number'];
                $data["account_number"] = $value['accountNumber'];
                $data["payment_Type"] = '--';
                $data["description"] = '--';

                $data["country"] = convert_val('country', $value['receiverCountry']);
                $data["service"] = $value['listName'];
                $data["ship_type"] = $value['shipType'] . ' kg';
                $data["weight"] = $value['shipWeight'];
                $data["pcs"] =$value['shipPcs'];
                $data["debit"] =$value['shipWeight'];
                $data["credit"] =$value['shipWeight'];
                $data["balance"] =$blnc;
                $row[] = $data;
                $data = array();
                $count++;



            }






            if(count($result['pdf_data']) == 0){
                echo json_encode(array('message'=>'No data found please make a New search to export Excel !'));
            }else if(count($result['pdf_data']) > 25){
                echo json_encode(array('message'=>'The data is too large please make a short search to export Excel !'));
            }
            else{

                $fileName='ledger_list_'.date('Y-m-d').'_'.rand(200,2000).'.csv';
                $columnName=array('Sr no','Date','AWB number','Account number','Payment Type','Description','Country','Service','Ship type','Weight','PCs','Debit','Credit','Balance');
                $this->downloadCsv($row, $columnName,$fileName);
                $file_location = './uploads/temp/'.$fileName;

                echo json_encode(array('message'=>'Success','file'=>$fileName));
            }
        }
    }
    /*
     * exlcel ledger data
     */



	public function addOpenBalance(){
		$data['header']='Add Open Balance';
	    $data['breadcromb']='Open Balance';
	    $data['title']='Open Balance';
	    $data['customer']=$this->base_model->allrecords('apx_customer','customer_id,accountNumber,companyName',array('status'=>1));
		$this->base_model->load_metronic_theme('ledger/add_open_balance',$data);
	}
	public function addCreditBalance(){
		$data['header']='Add Credit Note';
	    $data['breadcromb']='Credit Note';
	    $data['title']='Add Credit Note';
	    $data['customer']=$this->base_model->allrecords('apx_customer','customer_id,accountNumber,companyName',array('status'=>1));
		$this->base_model->load_metronic_theme('ledger/add_credit_balance',$data);
	}
	public function addPaymentBalance(){
		$data['header']='Post Payment';
	    $data['breadcromb']='Payment';
	    $data['title']='Payment';
	    $data['customer']=$this->base_model->allrecords('apx_customer','customer_id,accountNumber,companyName',array('status'=>1));
		$this->base_model->load_metronic_theme('ledger/add_payment_balance',$data);
	}

	public function addBalanceAction(){
		if(isset($_POST['Balance'])){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('date', 'Date', 'trim|required');
			$this->form_validation->set_rules('acc_num', 'Account Number', 'trim|required');
			$this->form_validation->set_rules('amount', 'Amount', 'trim|required');
			$this->form_validation->set_rules('type','Open balance','trim|required|callback_check_open_balance');
			if ($this->form_validation->run() == FALSE) {
				if($this->input->post('type')=='Open'){
					$this->addOpenBalance();
				}else if($this->input->post('type')=='Credit'){
					$this->addCreditBalance();
				}else if($this->input->post('type')=='Payment'){
					$this->addPaymentBalance();
				}else{
					redirect('shipment-ledger');
				}	
			}else{
				$this->session->set_userdata('acc_session',$this->input->post('acc_num'));
			    if($this->input->post('type')=='Open'){
				  $blcName="Opening Balance";
				}else if($this->input->post('type')=='Credit'){
				  $blcName="Credit note";
				}else if($this->input->post('type')=='Payment'){
				   $blcName="Payment";
				} 
				$data['deposit_date']=date('Y-m-d',strtotime($this->input->post('date')));
				$data['accountNumber']=$this->input->post('acc_num'); 
				$data['balanceAmount']=$this->input->post('amount');
				$data['description']=$this->input->post('descript');
				$data['balanceType']=$this->input->post('type');
				if(isset($_POST['Balance'])){
					$result=$this->base_model->insert_record('apx_balance_tbl',$data);
					$status='added';
				}
				if($result){
		    		$this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$blcName.' '.$status.' successfully.</div>');
						redirect('shipment-ledger');
		    		}else{
		    		$this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$blcName.' cannot '.$status.'.</div>');
						redirect('shipment-ledger');
		    	}

			}
		}
	}
	public function check_open_balance(){
		$type = $this->input->post('type');
  		$account = $this->input->post('acc_num');
		$openblc=$this->base_model->select_single_record('apx_balance_tbl','*',array('balanceType'=>$type,'accountNumber'=>$account));
		if ($openblc)
	        {
	        if($openblc->balanceType=='Open'){
	        $this->form_validation->set_message('check_open_balance', 'Opening balance is already added Once.');
             return FALSE;
	        }else{
	         return TRUE;
	        }
	        }else{
	        return TRUE;
	    }
	}




    protected  function downloadCsv($row,$column,$filename){
        $output = fopen("./uploads/temp/".$filename,'w');

        fputcsv($output, $column);


        foreach( $row as $value) {
            fputcsv($output, $value);
        }
        fclose($output);
    }
}
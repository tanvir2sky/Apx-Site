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
            //$this->shipmentPermission = $this->shipment_model->getshipStatusPermission($this->session->userdata('admin_users')['user_type']);
            $this->actionPermission = $this->shipment_model->actionPermission($this->session->userdata('admin_users')['user_type']);
        }
    }
    /*
    @ Main page loading method
    */
    public function index($data=NULL)
    {

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
        $data['customer']=$this->base_model->allrecords('apx_customer','customer_id,accountNumber,companyName',array('status'=>1));
        $data['header']='Shipment Listing';
        $data['breadcromb']='Shipment';
        $data['title']='Shipment Search';
        $this->index($data);
    }

    public function listExportShipment(){
        $data['customer']=$this->base_model->allrecords('apx_customer','customer_id,accountNumber,companyName',array('status'=>1));
        $data['header']='Export Shipment Listing';
        $data['breadcromb']='Export Shipment';
        $data['title']=' Export Shipment List';
        $this->base_model->load_metronic_theme('shipment/export_shipment',$data);
    }
    /*
    @ List Shipment data
    */
    public function listData(){
        if(isset($_POST['sEcho'])){
            $filters = json_decode($_REQUEST['sSearch'],true);
            $filter = json_decode($_REQUEST['sSearch']);

            $where='shp.trash <> -1';
            if (!is_integer($filters) && !is_string($filter) && is_object($filter)) {

                $search = $filter->acnumber;
                $where='shp.trash <> -1';

                if($filter->acnumber){

                    $accountNumber=$filter->acnumber;
                    if($accountNumber == 111111111){

                    }
                    else{
                        $where.=' AND accountNumber='.$accountNumber.'';

                    }

                }else{
                    $accountNumber=0;
                }






                if(isset($filter->datefrom) && isset($filter->dateto)){
                    $where.=" AND (date BETWEEN '".$filter->datefrom."' AND '".$filter->dateto."')";

                }else{
                    $where.=" AND (date BETWEEN '".date('Y-m-d',strtotime(date('Y-m-d')." -12 month"))."' AND '".date('Y-m-d')."')";
                }
            }
            else{

                if($_REQUEST['sSearch']!=""){
                    $where.=' AND air_way_number LIKE "'.$_REQUEST['sSearch'].'%"';
                    $where.=' OR accountNumber   LIKE "'.$_REQUEST['sSearch'].'%"';
                    $where.=' OR companyName     LIKE "'.$_REQUEST['sSearch'].'%"';
                    $where.=' OR shipBalance     LIKE "'.$_REQUEST['sSearch'].'%"';

                }

            }


            $sEcho = intval($_REQUEST['sEcho']);
            $records = array();
            $records["aaData"] = array();
            $iTotalRecords=$this->base_model->count_record('apx_shipment shp',$where);
            //For detail only

            $iDisplayLength = intval($_REQUEST['iDisplayLength']);
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            $iDisplayStart = intval($_REQUEST['iDisplayStart']);
            $end =$iDisplayLength;
            $result=$this->shipment_model->getShipmentAllData($where,$orderby='shp.ship_id',$orderType='ASC',$iDisplayStart,$end);
            if(is_array($result) && !empty($result)){
                $count=$iDisplayStart+1;
                foreach($result as $value) {
                    switch($value['status']){
                        case 'Intransit':
                            $status='In transit';
                            $statusclass='primary';
                            $action="Mark Delivered";
                            break;
                        case 'Delivered':
                            $status='Delivered';
                            $statusclass='info';
                            $action="Mark Partial Delivered";
                            break;
                        case 'Partial':
                            $status='Partial';
                            $statusclass='warning';
                            $action="Mark Problem";
                            break;
                        case 'Problem':
                            $status='Problem';
                            $statusclass='important';
                            $action="Mark Lost";
                            break;
                        case 'Lost':
                            $status='Lost';
                            $statusclass='important';
                            $action="Mark Intransit";
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
                        case 'Unmanifest':
                            $status='Un Manifest';
                            $statusclass='important';
                            $action="Mark Manifest";
                            break;
                        case 'Manifested':
                            $status='Manifested';
                            $statusclass='success';
                            $action="Mark Un Manifested";
                            break;
                        case 'Checked':
                            $status='Checked';
                            $statusclass='success';
                            $action="Mark Un Checked";
                            break;
                        case 'Unchecked':
                            $status='Un Checked';
                            $statusclass='warning';
                            $action="Mark Checked";
                            break;
                        default:
                            $status='Error';
                            $statusclass='important';
                            $action="Mark Lost";
                    }
                    $records["aaData"][] = array(
                        'DT_RowId'=> "row_".$value['ship_id']."",
                        'DT_RowClass'=> "gradeA",
                        '<input type="checkbox" class="shipids" name="ship_id[]" value="'.$value['ship_id'].'" />',

                        $count++,
                        date('d-m-Y',strtotime($value['date'])),
                        $value['air_way_number'],
                        $value['accountNumber'],
                        $value['country'],
                        $value['receiverCompany'],
                        $value['listName'],
                        $value['shipBalance'],
                        //opration status
                        (in_array($this->session->userdata('admin_users')['user_type'],array(1,2,4))?'<a title="'.$action.'" href="javascript:confirmDelete(\''.base_url().'change-opration-status/'.$value['ship_id'].'\',\''.$action.'\')"><span class="label label-sm label-'.($value['oprStatus']=='Manifested'?'success':'warning').'">'.$value['oprStatus'].'</span></a>':'<span class="alert alert-'.($value['oprStatus']=='Manifested'?'success':'warning').'">'.$value['oprStatus'].'</span>'),
                        //csd status
                        (in_array($this->session->userdata('admin_users')['user_type'],array(1,2,5))?'<a title="'.$action.'" href="javascript:confirmDelete(\''.base_url().'change-csd-status/'.$value['ship_id'].'\',\''.$action.'\')"><span class="label label-sm label-'.($value['csdStatus']=='Delivered'?'success':'warning').'">'.$value['csdStatus'].'</span></a>':'<span class="alert alert-'.($value['csdStatus']=='Delivered'?'success':'warning').'">'.$value['csdStatus'].'</span>'),
                        //account status
                        (in_array($this->session->userdata('admin_users')['user_type'],array(1,2,3))?'<a title="'.$action.'" href="javascript:confirmDelete(\''.base_url().'change-acc-status/'.$value['ship_id'].'\',\''.$action.'\')"><span class="label label-sm label-'.($value['actStatus']=='Billed'?'success':'warning').'">'.$value['actStatus'].'</span></a>':'<span class="alert alert-'.($value['actStatus']=='Billed'?'success':'warning').'">'.$value['actStatus'].'</span>'),
                        //admin & super admin status
                        (in_array($this->session->userdata('admin_users')['user_type'],array(1,2))?'<a title="'.$action.'" href="javascript:confirmDelete(\''.base_url().'change-adm-status/'.$value['ship_id'].'\',\''.$action.'\')"><span class="label label-sm label-'.($value['admStatus']=='Checked'?'success':'warning').'">'.$value['admStatus'].'</span></a>':'<span class="alert alert-'.($value['admStatus']=='Checked'?'success':'warning').'">'.$value['admStatus'].'</span>'),
                        (access_control_apx('ship_manage','Edit')==true?
                            '<a title="Edit" href="'.base_url().'edit-shipment/'.$value['ship_id'].'"><i class="icon-edit"></i> Edit</a>&nbsp;&nbsp;':'').
                        (access_control_apx('ship_manage','Trash')==true?'<a title="Trash" href="javascript:confirmDelete(\''.base_url().'trash-shipment/'.
                            $value['ship_id'].'\',\'trash\')"><i class="icon-trash"></i> Trash</a>&nbsp;&nbsp;':
                            '').(access_control_apx('ship_manage','Read')==true?'<a href="'.base_url().'show-shipment/'.$value['ship_id'].'" title="Detail"><i class="icon-eye-open"></i> Detail</a>':'')
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


    /*
     * Problem shipment controller here
     *
     *
     *
     */


    public function problemShipment(){
        $data['customer']=$this->base_model->allrecords('apx_customer','customer_id,accountNumber,companyName',array('status'=>1));
        $data['header']='Problem Shipment Listing';
        $data['breadcromb']='Problem Shipment';
        $data['title']='Problem Shipment List';
        $this->base_model->load_metronic_theme('shipment/view_problem_shipment',$data);
    }
    /*
    @ List Shipment data
    */
    public function listProblemData(){

        if(isset($_POST['sEcho'])){
            $filters = json_decode($_REQUEST['sSearch'],true);
            $filter = json_decode($_REQUEST['sSearch']);

            $where="shp.trash <> -1 AND shp.status IN ('lost','problem','partial') ";
            if (!is_integer($filters) && !is_string($filter) && is_object($filter)) {

                $search = $filter->acnumber;


                if($filter->acnumber){

                    $accountNumber=$filter->acnumber;
                    if($accountNumber == 111111111){

                    }
                    else{
                        $where.=' AND accountNumber='.$accountNumber.'';

                    }

                }else{
                    $accountNumber=0;
                }






                if(isset($filter->datefrom) && isset($filter->dateto)){
                    $where.=" AND (date BETWEEN '".$filter->datefrom."' AND '".$filter->dateto."')";

                }else{
                    $where.=" AND (date BETWEEN '".date('Y-m-d',strtotime(date('Y-m-d')." -12 month"))."' AND '".date('Y-m-d')."')";
                }
            }
            else{

                if($_REQUEST['sSearch']!=""){
                    $where.=' AND air_way_number LIKE "'.$_REQUEST['sSearch'].'%"';
                    $where.=' OR accountNumber   LIKE "'.$_REQUEST['sSearch'].'%"';
                    $where.=' OR companyName     LIKE "'.$_REQUEST['sSearch'].'%"';
                    $where.=' OR shipBalance     LIKE "'.$_REQUEST['sSearch'].'%"';

                }

            }


            $sEcho = intval($_REQUEST['sEcho']);
            $records = array();
            $records["aaData"] = array();
            $iTotalRecords=$this->base_model->count_record('apx_shipment shp',$where);
            //For detail only

            $iDisplayLength = intval($_REQUEST['iDisplayLength']);
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            $iDisplayStart = intval($_REQUEST['iDisplayStart']);
            $end =$iDisplayLength;
            $result=$this->shipment_model->getShipmentAllData($where,$orderby='shp.ship_id',$orderType='ASC',$iDisplayStart,$end);
            if(is_array($result) && !empty($result)){
                $count=$iDisplayStart+1;
                foreach($result as $value) {
                    switch($value['status']){
                        case 'Intransit':
                            $status='In transit';
                            $statusclass='primary';
                            $action="Mark Delivered";
                            break;
                        case 'Delivered':
                            $status='Delivered';
                            $statusclass='info';
                            $action="Mark Partial Delivered";
                            break;
                        case 'Partial':
                            $status='Partial';
                            $statusclass='warning';
                            $action="Mark Problem";
                            break;
                        case 'Problem':
                            $status='Problem';
                            $statusclass='important';
                            $action="Mark Lost";
                            break;
                        case 'Lost':
                            $status='Lost';
                            $statusclass='important';
                            $action="Mark Intransit";
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
                        case 'Unmanifest':
                            $status='Un Manifest';
                            $statusclass='important';
                            $action="Mark Manifest";
                            break;
                        case 'Manifested':
                            $status='Manifested';
                            $statusclass='success';
                            $action="Mark Un Manifested";
                            break;
                        case 'Checked':
                            $status='Checked';
                            $statusclass='success';
                            $action="Mark Un Checked";
                            break;
                        case 'Unchecked':
                            $status='Un Checked';
                            $statusclass='warning';
                            $action="Mark Checked";
                            break;
                        default:
                            $status='Error';
                            $statusclass='important';
                            $action="Mark Lost";
                    }
                    $records["aaData"][] = array(
                        'DT_RowId'=> "row_".$value['ship_id']."",
                        'DT_RowClass'=> "gradeA",
                        '<input type="checkbox" class="shipids" name="ship_id[]" value="'.$value['ship_id'].'" />',

                        $count++,
                        date('d-m-Y',strtotime($value['date'])),
                        $value['air_way_number'],
                        $value['accountNumber'],
                        $value['country'],
                        $value['receiverCompany'],
                        $value['listName'],
                        $value['shipBalance'],
                        //opration status

                        //csd status
                        (in_array($this->session->userdata('admin_users')['user_type'],array(1,2,5))?'<a title="'.$action.'" href="javascript:confirmDelete(\''.base_url().'change-csd-status/'.$value['ship_id'].'\',\''.$action.'\')"><span class="label label-sm label-'.($value['csdStatus']=='Delivered'?'success':'warning').'">'.$value['csdStatus'].'</span></a>':'<span class="alert alert-'.($value['csdStatus']=='Delivered'?'success':'warning').'">'.$value['csdStatus'].'</span>'),
                        //account status

                        (access_control_apx('ship_manage','Edit')==true?
                            '<a title="Edit" href="'.base_url().'edit-shipment/'.$value['ship_id'].'"><i class="icon-edit"></i> Edit</a>&nbsp;&nbsp;':'').
                        (access_control_apx('ship_manage','Trash')==true?'<a title="Trash" href="javascript:confirmDelete(\''.base_url().'trash-shipment/'.
                            $value['ship_id'].'\',\'trash\')"><i class="icon-trash"></i> Trash</a>&nbsp;&nbsp;':
                            '').(access_control_apx('ship_manage','Read')==true?'<a href="'.base_url().'show-shipment/'.$value['ship_id'].'" title="Detail"><i class="icon-eye-open"></i> Detail</a>':'')
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


    /*
     * Problem shipment controller here
     *
     *
     *
     */


    /*
     * Solved issues controller starts here
     */


    public function solvedIssues(){
        $data['customer']=$this->base_model->allrecords('apx_customer','customer_id,accountNumber,companyName',array('status'=>1));
        $data['header']='Solved Shipment Listing';
        $data['breadcromb']='Solved Shipment';
        $data['title']='Solved Shipment List';
        $this->base_model->load_metronic_theme('shipment/solved_issues',$data);
    }
    /*
    @ List Shipment data
    */
    public function listSolvedIssues(){

        if(isset($_POST['sEcho'])){
            $filters = json_decode($_REQUEST['sSearch'],true);
            $filter = json_decode($_REQUEST['sSearch']);

            $where="shp.trash <> -1 AND shp.csdStatus='Delivered'";
            if (!is_integer($filters) && !is_string($filter) && is_object($filter)) {

                $search = $filter->acnumber;


                if($filter->acnumber){

                    $accountNumber=$filter->acnumber;
                    if($accountNumber == 111111111){

                    }
                    else{
                        $where.=' AND accountNumber='.$accountNumber.'';

                    }

                }else{
                    $accountNumber=0;
                }






                if(isset($filter->datefrom) && isset($filter->dateto)){
                    $where.=" AND (date BETWEEN '".$filter->datefrom."' AND '".$filter->dateto."')";

                }else{
                    $where.=" AND (date BETWEEN '".date('Y-m-d',strtotime(date('Y-m-d')." -12 month"))."' AND '".date('Y-m-d')."')";
                }
            }
            else{

                if($_REQUEST['sSearch']!=""){
                    $where.=' AND air_way_number LIKE "'.$_REQUEST['sSearch'].'%"';
                    $where.=' OR accountNumber   LIKE "'.$_REQUEST['sSearch'].'%"';
                    $where.=' OR companyName     LIKE "'.$_REQUEST['sSearch'].'%"';
                    $where.=' OR shipBalance     LIKE "'.$_REQUEST['sSearch'].'%"';

                }

            }


            $sEcho = intval($_REQUEST['sEcho']);
            $records = array();
            $records["aaData"] = array();
            $iTotalRecords=$this->base_model->count_record('apx_shipment shp',$where);
            //For detail only

            $iDisplayLength = intval($_REQUEST['iDisplayLength']);
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            $iDisplayStart = intval($_REQUEST['iDisplayStart']);
            $end =$iDisplayLength;
            $result=$this->shipment_model->getShipmentAllData($where,$orderby='shp.ship_id',$orderType='ASC',$iDisplayStart,$end);
            if(is_array($result) && !empty($result)){
                $count=$iDisplayStart+1;
                foreach($result as $value) {
                    switch($value['status']){
                        case 'Intransit':
                            $status='In transit';
                            $statusclass='primary';
                            $action="Mark Delivered";
                            break;
                        case 'Delivered':
                            $status='Delivered';
                            $statusclass='info';
                            $action="Mark Partial Delivered";
                            break;
                        case 'Partial':
                            $status='Partial';
                            $statusclass='warning';
                            $action="Mark Problem";
                            break;
                        case 'Problem':
                            $status='Problem';
                            $statusclass='important';
                            $action="Mark Lost";
                            break;
                        case 'Lost':
                            $status='Lost';
                            $statusclass='important';
                            $action="Mark Intransit";
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
                        case 'Unmanifest':
                            $status='Un Manifest';
                            $statusclass='important';
                            $action="Mark Manifest";
                            break;
                        case 'Manifested':
                            $status='Manifested';
                            $statusclass='success';
                            $action="Mark Un Manifested";
                            break;
                        case 'Checked':
                            $status='Checked';
                            $statusclass='success';
                            $action="Mark Un Checked";
                            break;
                        case 'Unchecked':
                            $status='Un Checked';
                            $statusclass='warning';
                            $action="Mark Checked";
                            break;
                        default:
                            $status='Error';
                            $statusclass='important';
                            $action="Mark Lost";
                    }
                    $records["aaData"][] = array(
                        'DT_RowId'=> "row_".$value['ship_id']."",
                        'DT_RowClass'=> "gradeA",
                        '<input type="checkbox" class="shipids" name="ship_id[]" value="'.$value['ship_id'].'" />',

                        $count++,
                        date('d-m-Y',strtotime($value['date'])),
                        $value['air_way_number'],
                        $value['accountNumber'],
                        $value['country'],
                        $value['receiverCompany'],
                        $value['listName'],
                        $value['shipBalance'],
                        //opration status

                        //csd status
                        (in_array($this->session->userdata('admin_users')['user_type'],array(1,2,5))?'<a title="'.$action.'" href="javascript:confirmDelete(\''.base_url().'change-csd-status/'.$value['ship_id'].'\',\''.$action.'\')"><span class="label label-sm label-'.($value['csdStatus']=='Delivered'?'success':'warning').'">'.$value['csdStatus'].'</span></a>':'<span class="alert alert-'.($value['csdStatus']=='Delivered'?'success':'warning').'">'.$value['csdStatus'].'</span>'),
                        //account status

                        (access_control_apx('ship_manage','Edit')==true?
                            '<a title="Edit" href="'.base_url().'edit-shipment/'.$value['ship_id'].'"><i class="icon-edit"></i> Edit</a>&nbsp;&nbsp;':'').
                        (access_control_apx('ship_manage','Trash')==true?'<a title="Trash" href="javascript:confirmDelete(\''.base_url().'trash-shipment/'.
                            $value['ship_id'].'\',\'trash\')"><i class="icon-trash"></i> Trash</a>&nbsp;&nbsp;':
                            '').(access_control_apx('ship_manage','Read')==true?'<a href="'.base_url().'show-shipment/'.$value['ship_id'].'" title="Detail"><i class="icon-eye-open"></i> Detail</a>':'')
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



    /*
     * Solved issues controller starts here
     */

    /*
     * account shipement controller starts here
     */

    public function accountShipment(){
        $data['customer']=$this->base_model->allrecords('apx_customer','customer_id,accountNumber,companyName',array('status'=>1));
        $data['header']='Account Shipment Listing';
        $data['breadcromb']='Account Shipment';
        $data['title']='Account Shipment List';
        $this->base_model->load_metronic_theme('shipment/view_account_shipment',$data);
    }
    /*
    @ List Shipment data
    */
    public function listAccountShipment(){

        if(isset($_POST['sEcho'])){
            $filters = json_decode($_REQUEST['sSearch'],true);
            $filter = json_decode($_REQUEST['sSearch']);

            $where="shp.trash <> -1 AND shp.actStatus IN ('Unbilled','Billed')";
            if (!is_integer($filters) && !is_string($filter) && is_object($filter)) {

                $search = $filter->acnumber;


                if($filter->acnumber){

                    $accountNumber=$filter->acnumber;
                    if($accountNumber == 111111111){

                    }
                    else{
                        $where.=' AND accountNumber='.$accountNumber.'';

                    }

                }else{
                    $accountNumber=0;
                }






                if(isset($filter->datefrom) && isset($filter->dateto)){
                    $where.=" AND (date BETWEEN '".$filter->datefrom."' AND '".$filter->dateto."')";

                }else{
                    $where.=" AND (date BETWEEN '".date('Y-m-d',strtotime(date('Y-m-d')." -12 month"))."' AND '".date('Y-m-d')."')";
                }
            }
            else{

                if($_REQUEST['sSearch']!=""){
                    $where.=' AND air_way_number LIKE "'.$_REQUEST['sSearch'].'%"';
                    $where.=' OR accountNumber   LIKE "'.$_REQUEST['sSearch'].'%"';
                    $where.=' OR companyName     LIKE "'.$_REQUEST['sSearch'].'%"';
                    $where.=' OR shipBalance     LIKE "'.$_REQUEST['sSearch'].'%"';

                }

            }


            $sEcho = intval($_REQUEST['sEcho']);
            $records = array();
            $records["aaData"] = array();
            $iTotalRecords=$this->base_model->count_record('apx_shipment shp',$where);
            //For detail only

            $iDisplayLength = intval($_REQUEST['iDisplayLength']);
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            $iDisplayStart = intval($_REQUEST['iDisplayStart']);
            $end =$iDisplayLength;
            $result=$this->shipment_model->getShipmentAllData($where,$orderby='shp.ship_id',$orderType='ASC',$iDisplayStart,$end);
            if(is_array($result) && !empty($result)){
                $count=$iDisplayStart+1;
                foreach($result as $value) {
                    switch($value['status']){
                        case 'Intransit':
                            $status='In transit';
                            $statusclass='primary';
                            $action="Mark Delivered";
                            break;
                        case 'Delivered':
                            $status='Delivered';
                            $statusclass='info';
                            $action="Mark Partial Delivered";
                            break;
                        case 'Partial':
                            $status='Partial';
                            $statusclass='warning';
                            $action="Mark Problem";
                            break;
                        case 'Problem':
                            $status='Problem';
                            $statusclass='important';
                            $action="Mark Lost";
                            break;
                        case 'Lost':
                            $status='Lost';
                            $statusclass='important';
                            $action="Mark Intransit";
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
                        case 'Unmanifest':
                            $status='Un Manifest';
                            $statusclass='important';
                            $action="Mark Manifest";
                            break;
                        case 'Manifested':
                            $status='Manifested';
                            $statusclass='success';
                            $action="Mark Un Manifested";
                            break;
                        case 'Checked':
                            $status='Checked';
                            $statusclass='success';
                            $action="Mark Un Checked";
                            break;
                        case 'Unchecked':
                            $status='Un Checked';
                            $statusclass='warning';
                            $action="Mark Checked";
                            break;
                        default:
                            $status='Error';
                            $statusclass='important';
                            $action="Mark Lost";
                    }
                    $records["aaData"][] = array(
                        'DT_RowId'=> "row_".$value['ship_id']."",
                        'DT_RowClass'=> "gradeA",
                        '<input type="checkbox" class="shipids" name="ship_id[]" value="'.$value['ship_id'].'" />',

                        $count++,
                        date('d-m-Y',strtotime($value['date'])),
                        $value['air_way_number'],
                        $value['accountNumber'],
                        $value['country'],
                        $value['receiverCompany'],
                        $value['listName'],
                        $value['shipBalance'],
                        //opration status

                        //csd status
                        (in_array($this->session->userdata('admin_users')['user_type'],array(1,2,3))?'<a title="'.$action.'" href="javascript:confirmDelete(\''.base_url().'change-acc-status/'.$value['ship_id'].'\',\''.$action.'\')"><span class="label label-sm label-'.($value['actStatus']=='Billed'?'success':'warning').'">'.$value['actStatus'].'</span></a>':'<span class="alert alert-'.($value['actStatus']=='Billed'?'success':'warning').'">'.$value['actStatus'].'</span>'),
                        //account status

                        (access_control_apx('ship_manage','Edit')==true?
                            '<a title="Edit" href="'.base_url().'edit-shipment/'.$value['ship_id'].'"><i class="icon-edit"></i> Edit</a>&nbsp;&nbsp;':'').
                        (access_control_apx('ship_manage','Trash')==true?'<a title="Trash" href="javascript:confirmDelete(\''.base_url().'trash-shipment/'.
                            $value['ship_id'].'\',\'trash\')"><i class="icon-trash"></i> Trash</a>&nbsp;&nbsp;':
                            '').(access_control_apx('ship_manage','Read')==true?'<a href="'.base_url().'show-shipment/'.$value['ship_id'].'" title="Detail"><i class="icon-eye-open"></i> Detail</a>':'')
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




    /*
     * account shipement controller ends here
     */

    /*
     * Operation shipment here starts
     *
     */
    public function operationShipment(){
        $data['customer']=$this->base_model->allrecords('apx_customer','customer_id,accountNumber,companyName',array('status'=>1));
        $data['header']='Operation Shipment Listing';
        $data['breadcromb']='Operation Shipment';
        $data['title']='Operation Shipment List';
        $this->base_model->load_metronic_theme('shipment/view_operation_shipment',$data);
    }
    /*
    @ List Shipment data
    */
    public function listOperationShipment(){

        if(isset($_POST['sEcho'])){
            $filters = json_decode($_REQUEST['sSearch'],true);
            $filter = json_decode($_REQUEST['sSearch']);

            $where="shp.trash <> -1 AND shp.status IN ('lost','problem','partial') ";
            if (!is_integer($filters) && !is_string($filter) && is_object($filter)) {

                $search = $filter->acnumber;


                if($filter->acnumber){

                    $accountNumber=$filter->acnumber;
                    if($accountNumber == 111111111){

                    }
                    else{
                        $where.=' AND accountNumber='.$accountNumber.'';

                    }

                }else{
                    $accountNumber=0;
                }






                if(isset($filter->datefrom) && isset($filter->dateto)){
                    $where.=" AND (date BETWEEN '".$filter->datefrom."' AND '".$filter->dateto."')";

                }else{
                    $where.=" AND (date BETWEEN '".date('Y-m-d',strtotime(date('Y-m-d')." -12 month"))."' AND '".date('Y-m-d')."')";
                }
            }
            else{

                if($_REQUEST['sSearch']!=""){
                    $where.=' AND air_way_number LIKE "'.$_REQUEST['sSearch'].'%"';
                    $where.=' OR accountNumber   LIKE "'.$_REQUEST['sSearch'].'%"';
                    $where.=' OR companyName     LIKE "'.$_REQUEST['sSearch'].'%"';
                    $where.=' OR shipBalance     LIKE "'.$_REQUEST['sSearch'].'%"';

                }

            }


            $sEcho = intval($_REQUEST['sEcho']);
            $records = array();
            $records["aaData"] = array();
            $iTotalRecords=$this->base_model->count_record('apx_shipment shp',$where);
            //For detail only

            $iDisplayLength = intval($_REQUEST['iDisplayLength']);
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            $iDisplayStart = intval($_REQUEST['iDisplayStart']);
            $end =$iDisplayLength;
            $result=$this->shipment_model->getShipmentAllData($where,$orderby='shp.ship_id',$orderType='ASC',$iDisplayStart,$end);
            if(is_array($result) && !empty($result)){
                $count=$iDisplayStart+1;
                foreach($result as $value) {
                    switch($value['status']){
                        case 'Intransit':
                            $status='In transit';
                            $statusclass='primary';
                            $action="Mark Delivered";
                            break;
                        case 'Delivered':
                            $status='Delivered';
                            $statusclass='info';
                            $action="Mark Partial Delivered";
                            break;
                        case 'Partial':
                            $status='Partial';
                            $statusclass='warning';
                            $action="Mark Problem";
                            break;
                        case 'Problem':
                            $status='Problem';
                            $statusclass='important';
                            $action="Mark Lost";
                            break;
                        case 'Lost':
                            $status='Lost';
                            $statusclass='important';
                            $action="Mark Intransit";
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
                        case 'Unmanifest':
                            $status='Un Manifest';
                            $statusclass='important';
                            $action="Mark Manifest";
                            break;
                        case 'Manifested':
                            $status='Manifested';
                            $statusclass='success';
                            $action="Mark Un Manifested";
                            break;
                        case 'Checked':
                            $status='Checked';
                            $statusclass='success';
                            $action="Mark Un Checked";
                            break;
                        case 'Unchecked':
                            $status='Un Checked';
                            $statusclass='warning';
                            $action="Mark Checked";
                            break;
                        default:
                            $status='Error';
                            $statusclass='important';
                            $action="Mark Lost";
                    }
                    $records["aaData"][] = array(
                        'DT_RowId'=> "row_".$value['ship_id']."",
                        'DT_RowClass'=> "gradeA",
                        '<input type="checkbox" class="shipids" name="ship_id[]" value="'.$value['ship_id'].'" />',

                        $count++,
                        date('d-m-Y',strtotime($value['date'])),
                        $value['air_way_number'],
                        $value['accountNumber'],
                        $value['country'],
                        $value['receiverCompany'],
                        $value['listName'],
                        $value['shipBalance'],
                        //opration status

                        //csd status
                        (in_array($this->session->userdata('admin_users')['user_type'],array(1,2,4))?'<a title="'.$action.'" href="javascript:confirmDelete(\''.base_url().'change-opration-status/'.$value['ship_id'].'\',\''.$action.'\')"><span class="label label-sm label-'.($value['oprStatus']=='Manifested'?'success':'warning').'">'.$value['oprStatus'].'</span></a>':'<span class="alert alert-'.($value['oprStatus']=='Manifested'?'success':'warning').'">'.$value['oprStatus'].'</span>'),
                        //account status

                        (access_control_apx('ship_manage','Edit')==true?
                            '<a title="Edit" href="'.base_url().'edit-shipment/'.$value['ship_id'].'"><i class="icon-edit"></i> Edit</a>&nbsp;&nbsp;':'').
                        (access_control_apx('ship_manage','Trash')==true?'<a title="Trash" href="javascript:confirmDelete(\''.base_url().'trash-shipment/'.
                            $value['ship_id'].'\',\'trash\')"><i class="icon-trash"></i> Trash</a>&nbsp;&nbsp;':
                            '').(access_control_apx('ship_manage','Read')==true?'<a href="'.base_url().'show-shipment/'.$value['ship_id'].'" title="Detail"><i class="icon-eye-open"></i> Detail</a>':'')
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



    /*
    * Operation shipment here ends
     *
    *
    */
    /*
     * Admin shipemtn starts here
     */


    public function adminShipment(){
        $data['customer']=$this->base_model->allrecords('apx_customer','customer_id,accountNumber,companyName',array('status'=>1));
        $data['header']='Admin Shipment Listing';
        $data['breadcromb']='Admin Shipment';
        $data['title']='Admin Shipment List';
        $this->base_model->load_metronic_theme('shipment/view_admin_shipment',$data);
    }
    /*
    @ List Shipment data
    */
    public function listAdminShipment(){

        if(isset($_POST['sEcho'])){
            $filters = json_decode($_REQUEST['sSearch'],true);
            $filter = json_decode($_REQUEST['sSearch']);

            $where="shp.trash <> -1 AND shp.admStatus IN ('Checked','Unchecked') ";
            if (!is_integer($filters) && !is_string($filter) && is_object($filter)) {

                $search = $filter->acnumber;


                if($filter->acnumber){

                    $accountNumber=$filter->acnumber;
                    if($accountNumber == 111111111){

                    }
                    else{
                        $where.=' AND accountNumber='.$accountNumber.'';

                    }

                }else{
                    $accountNumber=0;
                }






                if(isset($filter->datefrom) && isset($filter->dateto)){
                    $where.=" AND (date BETWEEN '".$filter->datefrom."' AND '".$filter->dateto."')";

                }else{
                    $where.=" AND (date BETWEEN '".date('Y-m-d',strtotime(date('Y-m-d')." -12 month"))."' AND '".date('Y-m-d')."')";
                }
            }
            else{

                if($_REQUEST['sSearch']!=""){
                    $where.=' AND air_way_number LIKE "'.$_REQUEST['sSearch'].'%"';
                    $where.=' OR accountNumber   LIKE "'.$_REQUEST['sSearch'].'%"';
                    $where.=' OR companyName     LIKE "'.$_REQUEST['sSearch'].'%"';
                    $where.=' OR shipBalance     LIKE "'.$_REQUEST['sSearch'].'%"';

                }

            }


            $sEcho = intval($_REQUEST['sEcho']);
            $records = array();
            $records["aaData"] = array();
            $iTotalRecords=$this->base_model->count_record('apx_shipment shp',$where);
            //For detail only

            $iDisplayLength = intval($_REQUEST['iDisplayLength']);
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            $iDisplayStart = intval($_REQUEST['iDisplayStart']);
            $end =$iDisplayLength;
            $result=$this->shipment_model->getShipmentAllData($where,$orderby='shp.ship_id',$orderType='ASC',$iDisplayStart,$end);
            if(is_array($result) && !empty($result)){
                $count=$iDisplayStart+1;
                foreach($result as $value) {
                    switch($value['status']){
                        case 'Intransit':
                            $status='In transit';
                            $statusclass='primary';
                            $action="Mark Delivered";
                            break;
                        case 'Delivered':
                            $status='Delivered';
                            $statusclass='info';
                            $action="Mark Partial Delivered";
                            break;
                        case 'Partial':
                            $status='Partial';
                            $statusclass='warning';
                            $action="Mark Problem";
                            break;
                        case 'Problem':
                            $status='Problem';
                            $statusclass='important';
                            $action="Mark Lost";
                            break;
                        case 'Lost':
                            $status='Lost';
                            $statusclass='important';
                            $action="Mark Intransit";
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
                        case 'Unmanifest':
                            $status='Un Manifest';
                            $statusclass='important';
                            $action="Mark Manifest";
                            break;
                        case 'Manifested':
                            $status='Manifested';
                            $statusclass='success';
                            $action="Mark Un Manifested";
                            break;
                        case 'Checked':
                            $status='Checked';
                            $statusclass='success';
                            $action="Mark Un Checked";
                            break;
                        case 'Unchecked':
                            $status='Un Checked';
                            $statusclass='warning';
                            $action="Mark Checked";
                            break;
                        default:
                            $status='Error';
                            $statusclass='important';
                            $action="Mark Lost";
                    }
                    $records["aaData"][] = array(
                        'DT_RowId'=> "row_".$value['ship_id']."",
                        'DT_RowClass'=> "gradeA",
                        '<input type="checkbox" class="shipids" name="ship_id[]" value="'.$value['ship_id'].'" />',

                        $count++,
                        date('d-m-Y',strtotime($value['date'])),
                        $value['air_way_number'],
                        $value['accountNumber'],
                        $value['country'],
                        $value['receiverCompany'],
                        $value['listName'],
                        $value['shipBalance'],
                        //opration status

                        //csd status
                        (in_array($this->session->userdata('admin_users')['user_type'],array(1,2))?'<a title="'.$action.'" href="javascript:confirmDelete(\''.base_url().'change-adm-status/'.$value['ship_id'].'\',\''.$action.'\')"><span class="label label-sm label-'.($value['admStatus']=='Checked'?'success':'warning').'">'.$value['admStatus'].'</span></a>':'<span class="alert alert-'.($value['admStatus']=='Checked'?'success':'warning').'">'.$value['admStatus'].'</span>'),
                        //account status

                        (access_control_apx('ship_manage','Edit')==true?
                            '<a title="Edit" href="'.base_url().'edit-shipment/'.$value['ship_id'].'"><i class="icon-edit"></i> Edit</a>&nbsp;&nbsp;':'').
                        (access_control_apx('ship_manage','Trash')==true?'<a title="Trash" href="javascript:confirmDelete(\''.base_url().'trash-shipment/'.
                            $value['ship_id'].'\',\'trash\')"><i class="icon-trash"></i> Trash</a>&nbsp;&nbsp;':
                            '').(access_control_apx('ship_manage','Read')==true?'<a href="'.base_url().'show-shipment/'.$value['ship_id'].'" title="Detail"><i class="icon-eye-open"></i> Detail</a>':'')
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



    /*
     * Admin shipemtn ends here
     */





    /*Add New Shipment method*/
    public function addShipment($listId=NULL){
        //general data
        if($listId!=NULL){
            $defaultList=$listId;
        }else{
            $defaultList=$this->defaultList;
        }
        echo $defaultList;
        $data['header']='Add New Shipment';
        $data['breadcromb']='Add Shipment';
        $data['title']='Add Shipment';
        //loading internal notes//


        //loading internal notes//
        $data['price_list']=$this->base_model->allrecords('apx_price_list','list_id,listName,listCode',"status=1");
        $data['customer']=$this->base_model->allrecords('apx_customer','customer_id,accountNumber,companyName',array('status'=>1));
        $data['country']=$this->base_model->allrecords('apx_countries','country_id,countryCode,countryName','countryCode IN (SELECT countryCode FROM apx_zone_countries WHERE list_id='.$defaultList.')');
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

                $this->addShipment();
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
    /*Shipment CSV*/
    public function csvShipment(){
        if(isset($_POST['ids'])){
            $ids=$this->input->post('ids');
            if(array_key_exists(0, $ids)){
                $tabel	 = 'apx_shipment shp';
                $select	 = 'shp.air_way_number,shp.tracking_number,shp.accountNumber,shp.companyName,shp.shiperName,shp.address1,shp.address2,shp.country,shp.state,shp.city,shp.zipCode,shp.phone,shp.userName,shp.date,shp.time,shp.shiper_ref,shp.shiper_content,shp.shiper_value,shp.receiverCompany,shp.receiverName,shp.receiverAddress1,shp.receiverAddress2,shp.receiverCity,shp.receiverState,pl.listCode as priceList,ct.countryName as recCountry,shp.receiverZipcode,shp.receiverPhone,shp.receiverMobile,shp.shipType,shp.shipWeight,shp.shipPcs,shp.shipPayment,shp.shipPaid,shp.shipBalance,shp.shipInstruction,adm1.user_name as created_name,shp.status';
                $jointabeles = array(
                    array(
                        'joined_name'	=>	'apx_countries as ct',
                        'joined_id'		=>	'ct.countryCode',
                        'tabel_id'		=>	'shp.receiverCountry',
                        'type'			=>	''
                    ),
                    array(
                        'joined_name'	=>	'apx_price_list as pl',
                        'joined_id'		=>	'pl.list_id',
                        'tabel_id'		=>	'shp.shipPriceList',
                        'type'			=>	''
                    ),
                    array(
                        'joined_name'	=>	'apx_admin as adm1',
                        'joined_id'		=>	'adm1.id',
                        'tabel_id'		=>	'shp.created_by',
                        'type'			=>	''
                    )
                );
                foreach ($ids as $key => $id) {
                    $where['where']=array('shp.ship_id'=>$id);
                    $result=$this->base_model->select_single_record_with_join($tabel,$jointabeles,$select,
                        $where,"array");
                    $row[]=$result;
                    $where['where']="";
                    $result=array();
                }
                if(is_array($row)){
                    $fileName='shipment_list_'.date('Y-m-d').'_'.rand(200,2000).'.csv';
                    $columnName=array('Air Way Bill Number','Tracking Number','Account Number','Account Holder Name','Shiper Name','Address Line 1','Address Line 2','City','State','Country','Zip','Phone','User Name','Date','Time','Shiper Reference','Shipment Content','Shipment Value','Reciever Company','Receiver Name','Receiver Address Line 1','Receiver Address Line 2','Receiver City','Receiver State','Price list Service','Zone Country','Reciever Zip','Reciever Phone','Reciever Mobile','Ship Type','Weight','PCS','Total Payment','Total paid','Balance','Shipment Instruction','Created By','Status');

                    $this->downloadCsv($row,$columnName,$fileName);
                    if(file_exists('./uploads/temp/'.$fileName)){
                        echo json_encode(array('message' =>'Success','file'=>$fileName));
                    }else{
                        echo json_encode(array('message' =>'Some error while exporting data !'));
                    }
                }else{
                    echo json_encode(array('message' =>'Some error while exporting data !'));
                }
            }else{
                echo json_encode(array('message' =>'Please select at least one record !'));
            }
        }
    }


    /*csv generator with download*/
    #
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




    ///shipment pdf////////////////

    ///shipment pdf////////////////
    ///shipment pdf////////////////
    ///shipment pdf////////////////



    public function pdfShipment(){
        if(isset($_POST['ids'])){
            $ids=$this->input->post('ids');
            if(array_key_exists(0, $ids)){
                $tabel	 = 'apx_shipment shp';
                $select	 = 'shp.air_way_number,shp.tracking_number,shp.accountNumber,shp.companyName,shp.shiperName,shp.address1,shp.address2,shp.country,shp.state,shp.city,shp.zipCode,shp.phone,shp.userName,shp.date,shp.time,shp.shiper_ref,shp.shiper_content,shp.shiper_value,shp.receiverCompany,shp.receiverName,shp.receiverAddress1,shp.receiverAddress2,shp.receiverCity,shp.receiverState,pl.listCode as priceList,ct.countryName as recCountry,shp.receiverZipcode,shp.receiverPhone,shp.receiverMobile,shp.shipType,shp.shipWeight,shp.shipPcs,shp.shipPayment,shp.shipPaid,shp.shipBalance,shp.shipInstruction,adm1.user_name as created_name,shp.status';
                $jointabeles = array(
                    array(
                        'joined_name'	=>	'apx_countries as ct',
                        'joined_id'		=>	'ct.countryCode',
                        'tabel_id'		=>	'shp.receiverCountry',
                        'type'			=>	''
                    ),
                    array(
                        'joined_name'	=>	'apx_price_list as pl',
                        'joined_id'		=>	'pl.list_id',
                        'tabel_id'		=>	'shp.shipPriceList',
                        'type'			=>	''
                    ),
                    array(
                        'joined_name'	=>	'apx_admin as adm1',
                        'joined_id'		=>	'adm1.id',
                        'tabel_id'		=>	'shp.created_by',
                        'type'			=>	''
                    )
                );
                foreach ($ids as $key => $id) {
                    $where['where']=array('shp.ship_id'=>$id);
                    $result=$this->base_model->select_single_record_with_join($tabel,$jointabeles,$select,
                        $where,"array");
                    $row[]=$result;
                    $where['where']="";
                    $result=array();
                }





                if(is_array($row)){
                    $data['pdf'] = $row;
                    $pdfName = "shipment_".time().".pdf";
                    $this->load->library('pdf');


                    $this->pdf->set_paper('A4', 'landscape');
                    $this->pdf->load_view('shipment/pdf_shipment',$data);
                    $this->pdf->render();
                    $pdf =  $this->pdf->output();
                    $file_location = './uploads/temp/'.$pdfName;
                    file_put_contents($file_location,$pdf);
                    if(file_exists('./uploads/temp/'.$pdfName)){
                        $this->load->helper('download');
                        force_download('/uploads/temp/'.$pdfName, NULL);
                        echo json_encode(array('message' =>'Success','file'=>$pdfName));
                    }else{
                        echo json_encode(array('message' =>'Some error while exporting data !'));
                    }
                }else{
                    echo json_encode(array('message' =>'Some error while exporting data !'));
                }
            }else{
                echo json_encode(array('message' =>'Please select at least one record !'));
            }
        }
    }







    ///shipment pdf////////////////
    ///shipment pdf////////////////





    /*View detail shipment*/
    public function showShipment(){
        //general data
        $data['header']='Shipment Detail';
        $data['breadcromb']='Shipment Detail';
        $data['title']='Shipment Detail';
        $data['internal_notes'] = $this->base_model->allrecords('apx_internal_notes','','','','id','');
        $id=$this->uri->segment(2);
        $data['ship_detail']=$this->base_model->select_single_record('apx_shipment','*',array('ship_id'=>$id));
        $this->base_model->load_metronic_theme('shipment/view_detail_shipment',$data);
    }
    /*Status opration change*/
    public function changeOpStatus(){
        $statusid=$this->uri->segment(2);
        $statusData=$this->base_model->select_single_record('apx_shipment','*',array('ship_id'=>$statusid));
        switch($statusData->oprStatus){
            case 'Unmanifest':
                $status='Marked Manifest';
                $action1='Manifested';
                $action2='Manifested';
                $redirect='list-shipments';
                break;
            case 'Manifested':
                $status='Marked Un Manifest';
                $action1='Unmanifest';
                $action2='Unmanifest';
                $redirect='list-shipments';
                break;
            default:
                $status='Marked Un Manifest';
                $action1='Unmanifest';
                $action2='Unmanifest';
                $redirect='list-shipments';
                break;
        }

        if(!empty($statusData)){
            $result= $this->base_model->update_record('apx_shipment',array('status'=>$action1,'oprStatus'=>$action2),array('ship_id'=>$statusid));
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
    /*Status csd change*/
    public function changecsdStatus(){
        $statusid=$this->uri->segment(2);
        $statusData=$this->base_model->select_single_record('apx_shipment','*',array('ship_id'=>$statusid));
        switch($statusData->csdStatus){
            case 'Intransit':
                $status='Marked Delivered';
                $action1='Delivered';
                $action2='Delivered';
                $redirect='list-shipments';
                break;
            case 'Delivered':
                $status='Marked Partial Delivered';
                $action1='Partial';
                $action2='Partial';
                $redirect='list-shipments';
                break;
            case 'Partial':
                $status='Marked Problem';
                $action1='Problem';
                $action2='Problem';
                $redirect='list-shipments';
                break;
            case 'Problem':
                $status='Marked Lost';
                $action1='Lost';
                $action2='Lost';
                $redirect='list-shipments';
                break;
            case 'Lost':
                $status='Marked In Transit';
                $action1='Intransit';
                $action2='Intransit';
                $redirect='list-shipments';
                break;
            default:
                $status='Marked Lost';
                $action1='Lost';
                $action2='Lost';
                $redirect='list-shipments';
                break;
        }

        if(!empty($statusData)){
            $result= $this->base_model->update_record('apx_shipment',array('status'=>$action1,'csdStatus'=>$action2),array('ship_id'=>$statusid));
            if($result=true){
                $this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record '.$status.' successfully.</div>');
                $referred_from = $this->session->userdata('referred_from');
                redirect($referred_from, 'refresh');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot be '.$status.'.</div>');
                $referred_from = $this->session->userdata('referred_from');
                redirect($referred_from, 'refresh');
            }
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access.</div>');
            $referred_from = $this->session->userdata('referred_from');
            redirect($referred_from, 'refresh');
        }
    }
    /*Status acc change*/
    public function changeAccStatus(){
        $statusid=$this->uri->segment(2);
        $statusData=$this->base_model->select_single_record('apx_shipment','*',array('ship_id'=>$statusid));
        switch($statusData->actStatus){
            case 'Billed':
                $status='Marked Un Billed';
                $action1='UnBilled';
                $action2='UnBilled';
                $redirect='list-shipments';
                break;
            case 'UnBilled':
                $status='Marked Billed';
                $action1='Billed';
                $action2='Billed';
                $redirect='list-shipments';
                break;
            default:
                $status='Marked Un Billed';
                $action1='UnBilled';
                $action2='UnBilled';
                $redirect='list-shipments';
                break;
        }

        if(!empty($statusData)){
            $result= $this->base_model->update_record('apx_shipment',array('status'=>$action1,'actStatus'=>$action2),array('ship_id'=>$statusid));
            if($result=true){
                $this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record '.$status.' successfully.</div>');
                $referred_from = $this->session->userdata('referred_from');
                redirect($referred_from, 'refresh');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot be '.$status.'.</div>');
                $referred_from = $this->session->userdata('referred_from');
                redirect($referred_from, 'refresh');
            }
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access.</div>');
            $referred_from = $this->session->userdata('referred_from');
            redirect($referred_from, 'refresh');
        }
    }
    /*Status admin change*/
    public function changeAdmStatus(){
        $statusid=$this->uri->segment(2);
        $statusData=$this->base_model->select_single_record('apx_shipment','*',array('ship_id'=>$statusid));
        switch($statusData->admStatus){
            case 'Checked':
                $status='Marked Un Checked';
                $action1='Unchecked';
                $action2='Unchecked';
                $redirect='list-shipments';
                break;
            case 'Unchecked':
                $status='Marked Checked';
                $action1='Checked';
                $action2='Checked';
                $redirect='list-shipments';
                break;
            default:
                $status='Marked Un Checked';
                $action1='Unchecked';
                $action2='Unchecked';
                $redirect='list-shipments';
                break;
        }

        if(!empty($statusData)){
            $result= $this->base_model->update_record('apx_shipment',array('status'=>$action1,'admStatus'=>$action2),array('ship_id'=>$statusid));
            if($result=true){
                $this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record '.$status.' successfully.</div>');
                $referred_from = $this->session->userdata('referred_from');
                redirect($referred_from, 'refresh');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot be '.$status.'.</div>');
                $referred_from = $this->session->userdata('referred_from');
                redirect($referred_from, 'refresh');
            }
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access.</div>');
            $referred_from = $this->session->userdata('referred_from');
            redirect($referred_from, 'refresh');
        }
    }
    /*Status on group value*/
    public function statusGroup(){
        if(isset($_POST['ids'])){
            $ids=$this->input->post('ids');
            $status=$this->input->post('status');
            $csd = "";
            if($status == "Billed" or $status=="Unbilled"){
                $csd = "actStatus";
            }
            elseif ($status == "Unmanifest" or $status=="Manifested"){
                $csd = "oprStatus";
            }
            elseif ($status == "Unchecked" or $status=="Checked"){
                $csd = "admStatus";
            }
            elseif ($status == "Intransit" or $status=="Delivered"){
                $csd = "csdStatus";
            }
            else{
                $csd = "csdStatus";
            }

            if(array_key_exists(0, $ids)){
                $count=0;

                foreach ($ids as $key => $id) {
                    $statusData=$this->base_model->select_single_record('apx_shipment','*',array('ship_id'=>$id));
                    if(!empty($statusData)){
                        $this->base_model->update_record('apx_shipment',array($csd=>$status),array('ship_id'=>$id));
                        $this->base_model->update_record('apx_shipment',array('status'=>$status),array('ship_id'=>$id));
                        //$statusData="";
                        $count++;

                    }
                }

                if($count!=0){
                    $this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$count.' Out of '.count($ids).' Record Marked as '.$status.' successfully.</div>');
                    echo json_encode(array('message' =>'Success'));
                }else{
                    $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot be Marked</div>');
                    echo json_encode(array('message' =>'Error'));
                }
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access.</div>');
                echo json_encode(array('message' =>'Error'));
            }
        }else{
            echo json_encode(array('message' =>'Please select at least one record with proper selection!'));
        }
    }
    /*
    @ list trashed Shipment
    */
    public function trashedShipment(){
        $data['header']='Trashed Shipment';
        $data['breadcromb']='List Trashed Shipment';
        $data['title']='Trashed Shipment';
        $data['trashed_shipment_data']=$this->shipment_model->getShipmentAllData($where=array('shp.trash'=>-1),$orderby='shp.ship_id',$orderType='ASC',$iDisplayStart=NULL,$end=NULL);
        $this->index($data);
    }
    /*Trash Shipment*/
    public function trashShipment(){
        $trashId=$this->uri->segment(2);
        $trashData=$this->base_model->select_single_record('apx_shipment','*',array('ship_id'=>$trashId));
        if(!empty($trashData)){
            $result= $this->base_model->update_record('apx_shipment',array('trash'=>'-1'),array('ship_id'=>$trashId));
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
    /*restore shipment*/
    public function restoreShipment(){
        $statusid=$this->uri->segment(2);
        $statusData=$this->base_model->select_single_record('apx_shipment','*',array('ship_id'=>$statusid,'trash'=>-1));

        if(!empty($statusData)){
            $result= $this->base_model->update_record('apx_shipment',array('trash'=>0),array('ship_id'=>$statusid));
            if($result=true){
                $this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record restored successfully.</div>');
                redirect(base_url('trashed-shipment'));
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot be restored .</div>');
                redirect(base_url('trashed-shipment'));
            }
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access.</div>');
            redirect('trashed-shipment');
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

    ///my new code tanvir hossain
    public  function addNewNote(){

        $a = $this->session->userdata('admin_users');
        $data['admin_id'] = $a['user_val'];
        $data['user_name'] = $a['username'];
        $data['note'] = $this->input->post('note');
        $this->base_model->insert_record('apx_internal_notes',$data,'');
        //$this->session->set_flashdata('note','Successfully added new internal notes');
        //$this->addShipment();

    }

    /*
     * codes for upload invoice starts
     */
    public function uploadInvoice(){

        $data['header']='Invoice Upload';
        $data['breadcromb']='Invoice Upload';
        $data['title']='Invoice Upload';
        $id=$this->uri->segment(2);
        $this->base_model->load_metronic_theme('shipment/view_upload_invoice',$data);

    }

    public function uploadInvoiceAction(){


        $dbvalues=array('date','invoice_no','dhl_no','pcs','weight','freight','sales_tax','gross_total','total_fright');
        if(isset($_FILES['userfile'])){
            $result=array();
            $error=array();
            $success=false;
            $name	= $this->session->userdata('admin_users')['username'];
            $config = array(
                'upload_path' => "./uploads/temp",
                'allowed_types' => "csv|xlsx",
                'overwrite' => FALSE,
                'file_name' => 'invoice_'.$name."_".date('Y-m-d')
            );
            $this->load->library('upload', $config);
            if(!$this->upload->do_upload()){
                $data['error'] = $this->upload->display_errors();
                $this->uploadInvoice($data);
            }
            else{
                $data=array();
                $this->load->library('csvreader');
                $filearray = array('upload_data' => $this->upload->data());
                $filename = $filearray['upload_data']['file_name'];
                $result =   $this->csvreader->parse_file('./uploads/temp/'.$filename,$dbvalues);
                //print_r($result);
                //return;
                //path
                if(is_array($result) && !empty($result)){
                    foreach ($result as $key => $value) {

                        if($this->checkDuplicateDhl($value['dhl_no'])==false && $this->checkDuplicateInv($value['invoice_no'])==false){
                            $data=$result[$key];
                            $date = $value["date"];
                            $res = explode("/", $date);
                            $changedDate = $res[2]."-".$res[0]."-".$res[1];
                            $data['date'] = $changedDate;
                            $data['invoice_no'] = $value['invoice_no'];
                            $data['dhl_no'] = $value['dhl_no'];
                            $data['pcs'] = $value['pcs'];
                            $data['weight'] = $value['weight'];
                            $data['freight'] = $value['freight'];
                            $data['sales_tax'] = $value['sales_tax'];
                            $data['gross_total'] = $value['gross_total'];
                            $data['total_fright'] = $value['total_fright'];

                            $insertion=$this->base_model->insert_record('apx_invoice',$data);
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
                        $columnName=array('date','invoice_no','dhl_no','pcs','weight','freight','sales_tax','gross_total','total_fright');
                        $this->writeCsv($error,$columnName,$filename);
                        $str='The attached data cannot be uploaded due to some error or duplicate DHL NO  or Invoice No.Please click the below link to view the file.<br/><a href="'.base_url().'uploads/temp/'.$filename.'">View file</a>';
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
                redirect('upload-invoice');
            }
        }


    }
    /*
     * Codes for upload invoice end
     */

    public function checkDuplicateDhl($dhl){
        $result=$this->base_model->select_single_record('apx_invoice','*',array('dhl_no'=>$dhl));
        if($result){
            return true;
        }else{
            return false;
        }

    }
    public function checkDuplicateInv($inv){
        $result=$this->base_model->select_single_record('apx_invoice','*',array('invoice_no'=>$inv));
        if($result){
            return true;
        }else{
            return false;
        }

    }

    public function differShipment(){

        $data['header']='Different data';
        $data['breadcromb']='Different data';
        $data['title']='Different data';
        $data['differ']=$this->shipment_model->getDifferentData()->result_array();

        $this->base_model->load_metronic_theme('shipment/view_differ_shipment',$data);

    }
    protected  function downloadCsv($row,$column,$filename){
        $output = fopen("./uploads/temp/".$filename,'w');

        fputcsv($output, $column);


        foreach( $row as $value) {
            fputcsv($output, $value);
        }
        fclose($output);
    }
//list data for cost and profit




}

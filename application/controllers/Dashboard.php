<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('admin_users')){
            redirect(base_url('login'));
        }else{
            $this->load->model('base_model');
            $this->load->model('dashboard_model');
            $this->load->model('admins_model');
            $this->load->model('shipment_model');

        }
    }
    public function index()
    {
        $data=array();
        $this->base_model->load_metronic_theme('view_dashboard',$data);
    }

    /*
     * listing all users
     */

    /*
     * Report generation starts tasks here
     *
     */

    public function reportUser(){

        $data=array();
        $data['header']='Report All Users';
        $data['breadcromb']='Report All Users';
        $data['title']='Report All Users';
        $data["users"] = $this->admins_model->getUserAllData($where=' adm.status <> -1',$orderby='adm.id',$orderType='DESC',$iDisplayStart=NULL,$end=NULL);
        $this->base_model->load_metronic_theme('report/report_users',$data);
    }
    public function reportUserPdf(){
        if (isset($_POST['ids'])) {
            $ids = $this->input->post('ids');
            foreach ($ids as $key => $id) {

                $result = $this->base_model->select_single_record('apx_admin', array('first_name', 'last_name', 'user_name', 'email'),
                    array("id" => $id), "abc");

                $row[] = $result;
                $where['where'] = "";
                $result = array();
            }


            $pdfName = "user__" . time() . ".pdf";
            $this->load->library('pdf');
            $result["pdf_data"]=$row;

            $this->pdf->load_view('report/pdf_user', $result);
            $this->pdf->set_paper('A4', 'landscape');
            $this->pdf->render();
            $pdf = $this->pdf->output();
            $file_location = './uploads/temp/' . $pdfName;
            file_put_contents($file_location, $pdf);
            echo json_encode(array('message' => 'Success', 'file' => $pdfName));
        }
    }

    public function reportUserCsv()
    {

        if (isset($_POST['ids'])) {
            $ids = $this->input->post('ids');
            foreach ($ids as $key => $id) {
                $where['where'] = array('id' => $id);
                $result = $this->base_model->select_single_record('apx_admin', array('first_name', 'last_name', 'user_name', 'email'),
                    array("id" => $id), "abc");
                $row[] = $result;
                $where['where'] = "";
                $result = array();
            }
            if (is_array($row)) {



                if (count($row) == 0) {
                    echo json_encode(array('message' => 'No data found please make a New search to export Excel !'));
                } else if (count($row) > 25) {
                    echo json_encode(array('message' => 'The data is too large please make a short search to export Excel !'));
                } else {

                    $fileName = 'user_list_' . date('Y-m-d') . '_' . rand(200, 2000) . '.csv';
                    $columnName = array('First name', 'Last_name', 'User name', 'Email');
                    $this->downloadCsv($row, $columnName, $fileName);
                    $file_location = './uploads/temp/' . $fileName;

                    echo json_encode(array('message' => 'Success', 'file' => $fileName));
                }
            }


        }
    }
    /*
     * Generating report for Branches
     *
     *
     *
     */


    public function reportBranches(){

        $data=array();
        $data['header']='Report All Branches';
        $data['breadcromb']='Report All Branches';
        $data['title']='Report All Branches';
        $data["users"] = $this->base_model->allrecords($table='apx_branches',$select='',$where=NULL,$type='array');
        $this->base_model->load_metronic_theme('report/report_branches',$data);
    }
    public function reportBranchesPdf(){
        if (isset($_POST['ids'])) {
            $ids = $this->input->post('ids');
            foreach ($ids as $key => $id) {

                $result = $this->base_model->select_single_record('apx_branches', '*',
                    array("branch_id" => $id), "abc");

                $row[] = $result;
                $where['where'] = "";
                $result = array();
            }


            $pdfName = "branches__" . time() . ".pdf";
            $this->load->library('pdf');
            $result["pdf_data"]=$row;

            $this->pdf->load_view('report/pdf_branches', $result);
            $this->pdf->set_paper('A4', 'landscape');
            $this->pdf->render();
            $pdf = $this->pdf->output();
            $file_location = './uploads/temp/' . $pdfName;
            file_put_contents($file_location, $pdf);
            echo json_encode(array('message' => 'Success', 'file' => $pdfName));
        }
    }

    public function reportBranchesCsv()
    {

        if (isset($_POST['ids'])) {
            $ids = $this->input->post('ids');
            foreach ($ids as $key => $id) {
                $where['where'] = array('id' => $id);
                $result = $this->base_model->select_single_record('apx_branches', '*',
                    array("branch_id" => $id), "abc");
                $row[] = $result;
                $where['where'] = "";
                $result = array();
            }
            if (is_array($row)) {



                if (count($row) == 0) {
                    echo json_encode(array('message' => 'No data found please make a New search to export Excel !'));
                } else if (count($row) > 25) {
                    echo json_encode(array('message' => 'The data is too large please make a short search to export Excel !'));
                } else {

                    $fileName = 'brach_list_' . date('Y-m-d') . '_' . rand(200, 2000) . '.csv';
                    $columnName = array( 'branch_id','code','name','manager','contactNu1','contactNu2','contactNu3','mangerContactNu','addressLine1','addressLine2','countryCode','state','city','zip code','created_date','modified_date','created by','modified_by','status');
                    $this->downloadCsv($row, $columnName, $fileName);
                    $file_location = './uploads/temp/' . $fileName;

                    echo json_encode(array('message' => 'Success', 'file' => $fileName));
                }
            }


        }
    }

    /*
     * customer
     */

    public function reportCustomer(){

        $data=array();
        $data['header']='Report All Branches';
        $data['breadcromb']='Report All Branches';
        $data['title']='Report All Branches';
        $data["users"] = $this->base_model->allrecords($table='apx_customer',$select='',$where=NULL,$type='array');
        $this->base_model->load_metronic_theme('report/report_customer',$data);
    }
    public function reportCustomerPdf(){
        if (isset($_POST['ids'])) {
            $ids = $this->input->post('ids');
            foreach ($ids as $key => $id) {

                $result = $this->base_model->select_single_record('apx_customer', '*',
                    array("customer_id" => $id), "abc");

                $row[] = $result;
                $where['where'] = "";
                $result = array();
            }


            $pdfName = "Customer__" . time() . ".pdf";
            $this->load->library('pdf');
            $result["pdf_data"]=$row;

            $this->pdf->load_view('report/pdf_customer', $result);
            $this->pdf->set_paper('A4', 'landscape');
            $this->pdf->render();
            $pdf = $this->pdf->output();
            $file_location = './uploads/temp/' . $pdfName;
            file_put_contents($file_location, $pdf);
            echo json_encode(array('message' => 'Success', 'file' => $pdfName));
        }
    }

    public function reportCustomerCsv()
    {

        if (isset($_POST['ids'])) {
            $ids = $this->input->post('ids');
            foreach ($ids as $key => $id) {
                $where['where'] = array('id' => $id);
                $result = $this->base_model->select_single_record('apx_customer', array('customer_id','accountNumber','accountType','companyName','firstName','lastName','user_name','email','email2','mobileNumber1','mobileNumber2','contactPerson','addressLine1','addressLine2','phone','city','state','countryCode','created_date','created_by','modified_date','modified_by','status'),
                    array("customer_id" => $id), "abc");
                $row[] = $result;
                $where['where'] = "";
                $result = array();
            }
            if (is_array($row)) {



                if (count($row) == 0) {
                    echo json_encode(array('message' => 'No data found please make a New search to export Excel !'));
                } else if (count($row) > 25) {
                    echo json_encode(array('message' => 'The data is too large please make a short search to export Excel !'));
                } else {

                    $fileName = 'brach_list_' . date('Y-m-d') . '_' . rand(200, 2000) . '.csv';
                    $columnName = array( 'customer id','account number','account type','company name','first name','last name','user name','email','email2','phone','mobile 1','mobile 2','contact person','addressline 1','addressline 2','city','state','country','created date','created by','modified date','modified by','status');
                    $this->downloadCsv($row, $columnName, $fileName);
                    $file_location = './uploads/temp/' . $fileName;

                    echo json_encode(array('message' => 'Success', 'file' => $fileName));
                }
            }


        }
    }

    /*
     * In transit shipment no: 28
     */
    public function reportTransit(){
        $data=array();
        $data['header']='Report All Intransit shipment';
        $data['breadcromb']='Report All Intransit shipment';
        $data['title']='Report All Intransit shipment';
        $where = "csdStatus='Intransit'";
        $data["users"] = $this->shipment_model->getShipmentAllData($where,$orderby='shp.ship_id',$orderType='ASC',$iDisplayStart=null,$end=null);
        $this->base_model->load_metronic_theme('report/report_transit',$data);

    }



    /*
     * In transit shipment no: 28
     */
    /*
     * In transit Delivered no: 28
     */
    public function reportDelivered(){
        $data=array();
        $data['header']='Report All Intransit shipment';
        $data['breadcromb']='Report All Intransit shipment';
        $data['title']='Report All Intransit shipment';
        $where = "csdStatus='Delivered'";
        $data["users"] = $this->shipment_model->getShipmentAllData($where,$orderby='shp.ship_id',$orderType='ASC',$iDisplayStart=null,$end=null);
        $this->base_model->load_metronic_theme('report/report_transit',$data);

    }

    /*
         * In transit Delivered no: 28
         */
    public function reportLost(){
        $data=array();
        $data['header']='Report All Lost shipment';
        $data['breadcromb']='Report All Lost shipment';
        $data['title']='Report All Lost shipment';
        $where = "csdStatus='Lost'";
        $data["users"] = $this->shipment_model->getShipmentAllData($where,$orderby='shp.ship_id',$orderType='ASC',$iDisplayStart=null,$end=null);
        $this->base_model->load_metronic_theme('report/report_transit',$data);

    }
    public function reportPartial(){
        $data=array();
        $data['header']='Report All Partial shipment';
        $data['breadcromb']='Report All Partial shipment';
        $data['title']='Report All Partial shipment';
        $where = "csdStatus='Partial'";
        $data["users"] = $this->shipment_model->getShipmentAllData($where,$orderby='shp.ship_id',$orderType='ASC',$iDisplayStart=null,$end=null);
        $this->base_model->load_metronic_theme('report/report_transit',$data);

    }
    public function reportProblem(){
        $data=array();
        $data['header']='Report All Problem shipment';
        $data['breadcromb']='Report All Problem shipment';
        $data['title']='Report All Problem shipment';
        $where = "csdStatus='Problem'";
        $data["users"] = $this->shipment_model->getShipmentAllData($where,$orderby='shp.ship_id',$orderType='ASC',$iDisplayStart=null,$end=null);
        $this->base_model->load_metronic_theme('report/report_transit',$data);

    }
    public function reportRefunded(){
        $data=array();
        $data['header']='Report All Refunded shipment';
        $data['breadcromb']='Report All Refunded shipment';
        $data['title']='Report All Refunded shipment';
        $where = "csdStatus='Refunded'";
        $data["users"] = $this->shipment_model->getShipmentAllData($where,$orderby='shp.ship_id',$orderType='ASC',$iDisplayStart=null,$end=null);
        $this->base_model->load_metronic_theme('report/report_transit',$data);

    }
    public function reportManifest(){
        $data=array();
        $data['header']='Report All Manifested shipment';
        $data['breadcromb']='Report All Manifested shipment';
        $data['title']='Report All Manifested shipment';
        $where = "oprStatus='Manifested'";
        $data["users"] = $this->shipment_model->getShipmentAllData($where,$orderby='shp.ship_id',$orderType='ASC',$iDisplayStart=null,$end=null);
        $this->base_model->load_metronic_theme('report/report_transit',$data);

    }
    public function reportUnManifest(){
        $data=array();
        $data['header']='Report All Un-manifest shipment';
        $data['breadcromb']='Report All Un-manifest shipment';
        $data['title']='Report All Un-manifest shipment';
        $where = "oprStatus='Unmanifest'";
        $data["users"] = $this->shipment_model->getShipmentAllData($where,$orderby='shp.ship_id',$orderType='ASC',$iDisplayStart=null,$end=null);
        $this->base_model->load_metronic_theme('report/report_transit',$data);

    }
    public function reportChecked(){
        $data=array();
        $data['header']='Report All Checked shipment';
        $data['breadcromb']='Report All Checked shipment';
        $data['title']='Report All Checked shipment';
        $where = "admStatus='Checked'";
        $data["users"] = $this->shipment_model->getShipmentAllData($where,$orderby='shp.ship_id',$orderType='ASC',$iDisplayStart=null,$end=null);
        $this->base_model->load_metronic_theme('report/report_transit',$data);

    }
    public function reportUnChecked(){
        $data=array();
        $data['header']='Report All Un-Checked shipment';
        $data['breadcromb']='Report All Un-Checked shipment';
        $data['title']='Report All Un-Checked shipment';
        $where = "admStatus='Unchecked'";
        $data["users"] = $this->shipment_model->getShipmentAllData($where,$orderby='shp.ship_id',$orderType='ASC',$iDisplayStart=null,$end=null);
        $this->base_model->load_metronic_theme('report/report_transit',$data);

    }
    public function reportBilled(){
        $data=array();
        $data['header']='Report All Billed shipment';
        $data['breadcromb']='Report All Billed shipment';
        $data['title']='Report All Billed shipment';
        $where = "actStatus='Billed'";
        $data["users"] = $this->shipment_model->getShipmentAllData($where,$orderby='shp.ship_id',$orderType='ASC',$iDisplayStart=null,$end=null);
        $this->base_model->load_metronic_theme('report/report_transit',$data);

    }
    public function reportUnBilled(){
        $data=array();
        $data['header']='Report All Unbilled shipment';
        $data['breadcromb']='Report All Unbilled shipment';
        $data['title']='Report All Unbilled shipment';
        $where = "actStatus='UnBilled'";
        $data["users"] = $this->shipment_model->getShipmentAllData($where,$orderby='shp.ship_id',$orderType='ASC',$iDisplayStart=null,$end=null);
        $this->base_model->load_metronic_theme('report/report_transit',$data);

    }
    public function reportWithOutDhl(){
        $data=array();
        $data['header']='Report All Without  Dhl';
        $data['breadcromb']='Report Without  Dhl';
        $data['title']='Report All Without  Dhl';
        $where = "tracking_number=''";
        $data["users"] = $this->shipment_model->getShipmentAllData($where,$orderby='shp.ship_id',$orderType='ASC',$iDisplayStart=null,$end=null);
        $this->base_model->load_metronic_theme('report/report_transit',$data);

    }

    public function reportCash(){
        $data=array();
        $data['header']='Report All Cash Customer';
        $data['breadcromb']='Report Cash Customer';
        $data['title']='Report All Cash Customer';
        $where = "cus.accountType='Cash'";
        $data["users"] = $this->shipment_model->getShipmentAllDataCustomer($where,$orderby='shp.ship_id',$orderType='ASC',$iDisplayStart=null,$end=null);
        $this->base_model->load_metronic_theme('report/report_transit',$data);

    }
    public function reportBooked(){
        $data=array();
        $data['header']='Report All Booked Shipment';
        $data['breadcromb']='Report Booked Shipment';
        $data['title']='Report All Booked Shipment';
        $where = null;
        $data["users"] = $this->shipment_model->getShipmentAllDataCustomer($where,$orderby='shp.ship_id',$orderType='ASC',$iDisplayStart=null,$end=null);
        $this->base_model->load_metronic_theme('report/report_transit',$data);

    }

    public function reportLedger(){
        $data['header']='Report Ledger';
        $data['breadcromb']='Report';
        $data['title']='Report Ledger';
        $data['customer']=$this->base_model->allrecords('apx_customer','customer_id,accountNumber,companyName',array('status'=>1));
        $this->base_model->load_metronic_theme('report/report_ledger',$data);
    }
    /*
     *
     * Report generation task ends here
     *
     */
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
                $this->pdf->load_view('report/ledger_pdf',$result);
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
     * csv genertator
     */
    protected  function writeCsv($row,$column,$filename){
        $output = fopen("./uploads/temp/".$filename,'w');
        fputcsv($output, $column);
        foreach($row as $value) {
            fputcsv($output, $value);
        }
        fclose($output);
    }
    protected  function downloadCsv($row,$column,$filename){
        $output = fopen("./uploads/temp/".$filename,'w');

        fputcsv($output, $column);


        foreach( $row as $value) {
            fputcsv($output, $value);
        }
        fclose($output);
    }


    public function listCostData(){
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

            $result=$this->shipment_model->getShipmentAllDataWithPrice($where,$orderby='shp.ship_id',$orderType='ASC',$iDisplayStart,$end);
            if(is_array($result) && !empty($result)){
                $count=$iDisplayStart+1;
                foreach($result as $value) {
                    $where = "type='".$value['shipType']."'";
                    $list_id = $this->base_model->select_single_record($table='apx_price_list_f',$fields='list_id',$where,$output=null);
                    $list_id = $list_id->list_id;


                    $where = "list_id=".$list_id." AND countryCode='".$value['receiverCountry']."'";
                    //echo $where;return;
                    $zone_id = $this->base_model->select_single_record($table='apx_zone_countries_f',$fields='zone_id',$where,$output=null);

                    $zone_id = $zone_id->zone_id;
                    //now gettin price

                    $where = "list_id=".$list_id." AND zone_id=".$zone_id." AND ".$value["shipWeight"]." BETWEEN weight_from AND weight_to";

                    $price = $this->base_model->select_single_record($table='apx_weight_prices_f',$fields='wprice',$where,$output=null);
                    if($price){
                        $base_price = $price->wprice;
                    }
                    else{
                        $base_price=0;
                    }





                    $where = "from_date <='".$value['date']."' AND to_date >='".$value['date']."'";
                    $gst = $this->base_model->select_single_record($table='apx_gst',$fields='gst_percentage',$where,$output=null);
                    $gst = $gst->gst_percentage;
                    $fuel = $this->base_model->select_single_record($table='apx_fuel_surcharge',$fields='fs_percentage',$where,$output=null);
                    $fuel = $fuel->fs_percentage;

                    $gst_percentage = ($base_price*$gst)/100;
                    $fuel_percentage = ($base_price*$fuel)/100;
                    $total = $base_price+$gst_percentage+$fuel_percentage;

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
                        $base_price,
                        $gst,
                        $fuel,
                        $total,
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
     *
     *
     *
     * List profit data
     *
     *
     *
     *
     *
     */
    public function listProfitData(){
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

            $result=$this->shipment_model->getShipmentAllDataWithPrice($where,$orderby='shp.ship_id',$orderType='ASC',$iDisplayStart,$end);
            if(is_array($result) && !empty($result)){
                $count=$iDisplayStart+1;
                foreach($result as $value) {
                    $where = "type='".$value['shipType']."'";
                    $list_id = $this->base_model->select_single_record($table='apx_price_list_f',$fields='list_id',$where,$output=null);
                    $list_id = $list_id->list_id;


                    $where = "list_id=".$list_id." AND countryCode='".$value['receiverCountry']."'";

                    $zone_id = $this->base_model->select_single_record($table='apx_zone_countries_f',$fields='zone_id',$where,$output=null);

                    $zone_id = $zone_id->zone_id;
                    //now gettin price

                    $where = "list_id=".$list_id." AND zone_id=".$zone_id." AND ".$value["shipWeight"]." BETWEEN weight_from AND weight_to";


                    $price = $this->base_model->select_single_record($table='apx_weight_prices_f',$fields='wprice',$where,$output=null);

                    if($price){
                        $base_price = $price->wprice;
                    }
                    else{
                        $base_price=0;
                    }






                    $where = "from_date <='".$value['date']."' AND to_date >='".$value['date']."'";
                    $gst = $this->base_model->select_single_record($table='apx_gst',$fields='gst_percentage',$where,$output=null);
                    $gst = $gst->gst_percentage;
                    $fuel = $this->base_model->select_single_record($table='apx_fuel_surcharge',$fields='fs_percentage',$where,$output=null);
                    $fuel = $fuel->fs_percentage;

                    $gst_percentage = ($base_price*$gst)/100;
                    $fuel_percentage = ($base_price*$fuel)/100;
                    $total = $base_price+$gst_percentage+$fuel_percentage;

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
                        $value['shipPayment'],
                        $total,
                        $value['shipPayment']-$total,
                    );
                    $gst=0;
                    $fuel=0;
                    $total=0;
                    $fuel_percentage=0;
                    $gst_percentage = 0;
                }
            }
            //$records["limit"]=array('start'=>$iDisplayStart,'end'=>$end);
            $records["sEcho"] = $sEcho;
            $records["iTotalRecords"] = $iTotalRecords;
            $records["iTotalDisplayRecords"] = $iTotalRecords;
            echo json_encode($records);
        }

    }
    //cost price and cost prfit code here full and final

    public function costPrice(){
        $data['customer']=$this->base_model->allrecords('apx_customer','customer_id,accountNumber,companyName',array('status'=>1));
        $data['header']='Shipment cost';
        $data['breadcromb']='Shipment profit';
        $data['title']='Shipment Cost';
        $this->base_model->load_metronic_theme('report/report_cost',$data);

    }
    public function costProfit(){
        $data['customer']=$this->base_model->allrecords('apx_customer','customer_id,accountNumber,companyName',array('status'=>1));
        $data['header']='Shipment Profit';
        $data['breadcromb']='Shipment profit';
        $data['title']='Shipment Profit';
        $this->base_model->load_metronic_theme('report/report_profit',$data);

    }



}

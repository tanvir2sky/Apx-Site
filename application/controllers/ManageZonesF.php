<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManagezonesF extends CI_Controller {

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
            $this->load->model('zone_model_f');
        }
    }
    /*
    @ Main page loading method
    */
    public function index($data=NULL)
    {
        if(isset($data['zone_countries_data'])){
            $this->base_model->load_metronic_theme('zones_f/view_zone_countries',$data);
        }else{
            $this->base_model->load_metronic_theme('zones_f/view_zone_setting',$data);
        }
    }
    /*
    @ List Zone setting  method
    */
    public function listZoneValue(){
        $priceList=$this->uri->segment(2);
        $priceListData=$this->base_model->select_single_record('apx_price_list_f','*',array('list_id'=>$priceList));
        if(!empty($priceListData)){
            $data['header']=$priceListData->listCode.' Zone Setting';
            $data['breadcromb']='Zone';
            $data['title']='Zone Setting';
            $data['list_id']=$priceListData->list_id;
            $data['zone_data']=$this->zone_model_f->getZoneAllData($where='zn.list_id='.$priceList.' AND zn.status <> -1',$orderby='zn.zoneLink',$orderType='ASC',$iDisplayStart=NULL,$end=NULL);
            $this->index($data);
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access.</div>');
            redirect('list-pricelist-f');

        }


    }
    /*Add Zone method*/
    public function addZoneValue($plid=NULL){
        if($this->uri->segment(2)){
            $priceList=$this->uri->segment(2);
        }else{
            $priceList=$plid;
        }

        $priceListData=$this->base_model->select_single_record('apx_price_list_f','*',array('list_id'=>$priceList));
        /*		echo '<pre>';
                print_r($priceListData);
                exit;*/
        if(!empty($priceListData)){
            //general data
            $data['header']='Add '.$priceListData->listCode.' Zone';
            $data['breadcromb']='Add Zone';
            $data['title']='Add  Zone';
            $data['list_id']=$priceListData->list_id;
            $data['price_list']=$this->base_model->allrecords('apx_price_list_f','list_id,listName,listCode', array('list_id'=>trim($priceList),'status <>'=>'-1'),"",$orderby='listName',$type='ASC');
            $this->base_model->load_metronic_theme('zones_f/view_add_zone',$data);
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access.</div>');
            redirect('list-zones-f/'.$priceList);

        }
    }
    /*Update Zone method*/
    public function editZoneValue($znid=NULL){
        if($this->uri->segment(2)){
            $id=$this->uri->segment(2);
        }else{
            $id=$znid;
        }
        $result=$this->base_model->select_single_record('apx_zone_f','*',array('zone_id'=>trim($id)));
        $priceListData=$this->base_model->select_single_record('apx_price_list_f','*',array('list_id'=>$result->list_id));
        if($result){
            $data['edit_view']=$result;
        }else{
            $data['no_data']='<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access</div>';
        }
        //general data
        $data['header']='Update '.$priceListData->listCode.' Zone';
        $data['breadcromb']='Update Zone';
        $data['title']='Update Zone';
        $data['price_list']=$this->base_model->allrecords('apx_price_list_f','list_id,listName,listCode', array('list_id'=>$priceListData->list_id,'status <>'=>'-1'),"",$orderby='listName',$type='ASC');
        $this->base_model->load_metronic_theme('zones_f/view_edit_zone',$data);
    }
    /*
    @ Add and Update Zone action
    */
    public function addZoneAction(){
        $this->load->library('form_validation');
        $link=trim($this->input->post('zone'))."_".trim($this->input->post('list_name'));
        $this->form_validation->set_rules('zone', 'zone', 'trim|required|callback_spaces_check');
        if(isset($_POST['update'])){
            $zoneData=$this->base_model->select_single_record('apx_zone_f','*',array('zone_id'=>$this->input->post('znid')));
            if($zoneData->zoneLink!=$link){
                $this->form_validation->set_rules('list_name', 'price list name', 'trim|required|callback_exists_check');
            }
        }else{
            $this->form_validation->set_rules('list_name', 'price list name', 'trim|required|callback_exists_check');
        }
        if ($this->form_validation->run() == FALSE) {
            if(isset($_POST['add'])){
                $this->addZoneValue($this->input->post('plid'));
            }else if(isset($_POST['update'])){
                $this->editZoneValue($this->input->post('znid'));
            }
        }else{
            $data['list_id']=$this->input->post('list_name');
            $data['zoneName']=$this->input->post('zone');
            $data['zoneLink']=trim($this->input->post('zone'))."_".trim($this->input->post('list_name'));
            $data[(isset($_POST['add'])?'created_by':'modified_by')]=$this->session->userdata('admin_users')['user_val'];
            $data[(isset($_POST['add'])?'created_date':'modified_date')]=date('Y-m-d H:i:s');
            if(isset($_POST['add'])){
                $result=$this->base_model->insert_record('apx_zone_f',$data);
                $status='added';
            }else if(isset($_POST['update'])){
                $result=$this->base_model->update_record('apx_zone_f',$data,array('zone_id'=>$this->input->post('znid')));
                //Delete countries if list is changed
                if($zoneData->list_id!=$this->input->post('list_name')){
                    $this->base_model->deleteRecord('apx_zone_countries_f',array('zone_id'=>$zoneData->zone_id));
                }
                $status='updated';
            }
            if($result){
                $this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record '.$status.' successfully.</div>');
                redirect('list-zones-f/'.$this->input->post('list_name'));
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot '.$status.'.</div>');
                redirect('list-zones-f/'.$this->input->post('list_name'));
            }
        }
    }
    // Spaces check callback function
    public function spaces_check($str)
    {
        if (preg_match('/\s/',$str))
        {
            $this->form_validation->set_message('spaces_check', 'Spaces are not allowed');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    // check already exists
    public function exists_check($str)
    {
        $link=trim($this->input->post('zone'))."_".trim($this->input->post('list_name'));
        $result=$this->base_model->select_single_record('apx_zone_f','*',array('zoneLink'=>trim($link)));
        if ($result)
        {
            $this->form_validation->set_message('exists_check', 'Zone already exists with the selected price list.');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    /*Delete Zone*/
    public function deleteZone(){
        $delid=$this->uri->segment(2);
        $delData=$this->base_model->select_single_record('apx_zone_f','*',array('zone_id'=>$delid));
        if(!empty($delData)){
            $result= $this->base_model->deleteRecord('apx_zone_f',array('zone_id'=>$delid));
            if($result=true){
                $this->base_model->deleteRecord('apx_zone_countries_f',array('zone_id'=>$delid));
                $this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record Deleted successfully.</div>');
                redirect('list-zones-f/'.$delData->list_id);
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot be Deleted.</div>');
                redirect('list-zones-f/'.$delData->list_id);
            }
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access.</div>');
            redirect('list-pricelist-f');
        }
    }
    /*
    @ZONE COUNTRIES SECTION
    */
    //list zone countries
    public function ZoneCountries($zonid=NULL){
        if($this->uri->segment(2)){
            $zonid=$this->uri->segment(2);
        }else{
            //get from $_GET
        }
        $zoneData=$this->base_model->select_single_record('apx_zone_f','*,(select listCode from apx_price_list_f where list_id=apx_zone_f.list_id) as listCode',array('zone_id'=>$zonid));
        if(!empty($zoneData)){
            $data['header']=$zoneData->zoneName."(".$zoneData->listCode.")".' Countries';
            $data['breadcromb']=$zoneData->zoneName.' Countries';
            $data['title']=$zoneData->zoneName.' Countries';
            $data['zone']=$zoneData->zone_id;
            $data['list_id']=$zoneData->list_id;
            $data['zone_countries_data']=$this->zone_model_f->getZoneCountriesData($where='zc.zone_id='.$zonid.' AND zc.status <> -1',$orderby='crt.countryName',$orderType='ASC',$iDisplayStart=NULL,$end=NULL);
            $this->index($data);
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access.</div>');
            redirect('list-pricelist-f');
        }
    }
    /*Add countries to zone*/
    public function addZoneCountriesValue($zonid=NULL){
        if($this->uri->segment(2)){
            $zonid=$this->uri->segment(2);
        }else{
            //get from $_GET
        }
        $zoneData=$this->base_model->select_single_record('apx_zone_f','*,(select listCode from apx_price_list_f where list_id=apx_zone_f.list_id) as listCode',array('zone_id'=>$zonid));
        if(!empty($zoneData)){
            //general data
            $data['header']='Add Countries to '.$zoneData->zoneName." (".$zoneData->listCode.")";
            $data['breadcromb']='Add countries to '.$zoneData->zoneName;
            $data['title']='Add countries to '.$zoneData->zoneName;
            $data['zone']=$zoneData->zone_id;
            $data['country']=$this->base_model->allrecords('apx_countries','country_id,countryCode,countryName','countryCode NOT IN (select countryCode from apx_zone_countries_f where countryCode=apx_countries.countryCode AND list_id='.$zoneData->list_id.')',$output='array');
            $this->base_model->load_metronic_theme('zones_f/view_add_zone_countries',$data);
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access.</div>');
            redirect('list-pricelist-f');
        }

    }
    /*Add zone countries action*/
    public function addZoneCountriesAction(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('countries[0]', 'Countries', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->addZoneCountriesValue($this->input->post('znid'));
        }else{
            $priceListData= $this->base_model->select_single_record('apx_zone_f','*',array('zone_id'=>$this->input->post('znid')));
            if(is_array($_POST['countries'])){
                foreach ($_POST['countries'] as $key => $value) {
                    $data['zone_id']=$this->input->post('znid');
                    $data['list_id']=$priceListData->list_id;
                    $data['countryCode']=$value;
                    $data['created_by']=$this->session->userdata('admin_users')['user_val'];
                    $data['created_date']=date('Y-m-d H:i:s');
                    $result=$this->base_model->insert_record('apx_zone_countries_f',$data);
                    $data=array();
                }
            }
            if($result){
                $this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record added successfully.</div>');
                redirect('zone-countries-f/'.$this->input->post('znid'));
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot added.</div>');
                redirect('zone-countries-f/'.$this->input->post('znid'));
            }
        }

    }
    /*Delete Zone single country*/
    public function deleteZoneCountry(){
        $delid=$this->uri->segment(2);
        $delData=$this->base_model->select_single_record('apx_zone_countries_f','*',array('zc_id'=>$delid));
        if(!empty($delData)){
            $result= $this->base_model->deleteRecord('apx_zone_countries_f',array('zc_id'=>$delid));
            if($result=true){
                $this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record Deleted successfully.</div>');
                redirect('zone-countries-f/'.$delData->zone_id);
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot be Deleted.</div>');
                redirect('zone-countries-f/'.$delData->zone_id);
            }
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid access.</div>');
            redirect('list-pricelist-f');
        }
    }
    /*Delete Zone multiple country*/
    public function deleteZoneCountries(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('zones[0]', 'one checkbox', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->ZoneCountries($this->input->post('znid'));
        }else{
            if(is_array($_POST['zones'])){
                foreach ($_POST['zones'] as $key => $value) {
                    $result= $this->base_model->deleteRecord('apx_zone_countries_f',array('zc_id'=>$value));
                }
            }
            if($result){
                $this->session->set_flashdata('message', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record deleted successfully.</div>');
                redirect('zone-countries-f/'.$this->input->post('znid'));
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Record cannot deleted.</div>');
                redirect('zone-countries-f/'.$this->input->post('znid'));
            }
        }

    }
}
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
Class Shipment_model extends CI_Model
{
/*
* GET ALL Price List RECORD QUERY 
*/
public function getShipmentAllData($where=NULL,$order=NULL,$type=NULL,$start=NULL,$end=NULL) {
    $this->db->select('shp.*,pl.listName,pl.listCode,adm1.user_name as created_name,adm2.user_name as modified_name');
    $this->db->from('apx_shipment shp');
        if($start >=0 && $end > 0){
           $this->db->limit($end, $start);
        }
        if($where!=NULL){
            $query = $this->db->where($where);
        }
        if($order!=NULL){
            if($type!=NULL){$type=$type;}else{$type='DESC';}
            $this->db->order_by($order,$type);
        }
    $this->db->join('apx_price_list pl', 'pl.list_id = shp.shipPriceList');
    $this->db->join('apx_admin adm1', 'adm1.id = shp.created_by');
    $this->db->join('apx_admin adm2', 'adm2.id = shp.modified_by','LEFT');
    $query = $this->db->get();

    return $query->result_array();
    }
    ///new for new

    public function getShipmentAllDataWithPrice($where=NULL,$order=NULL,$type=NULL,$start=NULL,$end=NULL) {
        $this->db->select('shp.*,pl.listName,pl.listCode,adm1.user_name as created_name,adm2.user_name as modified_name');
        $this->db->from('apx_shipment shp');
        if($start >=0 && $end > 0){
            $this->db->limit($end, $start);
        }
        if($where!=NULL){
            $query = $this->db->where($where);
        }
        if($order!=NULL){
            if($type!=NULL){$type=$type;}else{$type='DESC';}
            $this->db->order_by($order,$type);
        }
        $this->db->join('apx_price_list_f pl', 'pl.type = shp.shipType');

        $this->db->join('apx_admin adm1', 'adm1.id = shp.created_by');
        $this->db->join('apx_admin adm2', 'adm2.id = shp.modified_by','LEFT');
        $query = $this->db->get();

        return $query->result_array();
    }

    //new for new



    public function getShipmentAllDataCustomer($where=NULL,$order=NULL,$type=NULL,$start=NULL,$end=NULL) {
        $this->db->select('shp.*,pl.listName,pl.listCode,adm1.user_name as created_name,adm2.user_name as modified_name,cus.accountType as account');
        $this->db->from('apx_shipment shp');
        if($start >=0 && $end > 0){
            $this->db->limit($end, $start);
        }
        if($where!=NULL){
            $query = $this->db->where($where);
        }
        if($order!=NULL){
            if($type!=NULL){$type=$type;}else{$type='DESC';}
            $this->db->order_by($order,$type);
        }
        $this->db->join('apx_price_list pl', 'pl.list_id = shp.shipPriceList');
        $this->db->join('apx_admin adm1', 'adm1.id = shp.created_by');
        $this->db->join('apx_customer cus', 'cus.accountNumber = shp.accountNumber');
        $this->db->join('apx_admin adm2', 'adm2.id = shp.modified_by','LEFT');
        $query = $this->db->get();

        return $query->result_array();
    }


/*GET LEDGER DATA*/
public function getLedgerData($accountNumber,$where=NULL,$limit=NULL){
    $query = $this->db->query("SELECT * FROM (
        SELECT ship_id as id,`date` as ledgerDate,air_way_number as awb,accountNumber,'ship' as payType,'---' as payDescription,receiverCountry,(select listName from apx_price_list Where list_id=`shp`.`shipPriceList` LIMIT 1) as listName,shipType,shipWeight,shipPcs,'' as creditBalance,shipBalance FROM apx_shipment shp WHERE accountNumber=".$accountNumber." AND trash=0
        UNION
        SELECT 'NULL' as id,deposit_date as ledgerDate,'---' as awb,accountNumber,balanceType as payType,description as payDescription,'---' as receiverCountry,'---' as listName,'---' as shipType,'---' as shipWeight,'---' as shipPcs,balanceAmount as creditBalance ,'' as shipBalance FROM apx_balance_tbl WHERE accountNumber=".$accountNumber." AND balanceType<>'Open'
        ) as ledger ".$where." ORDER by ledgerDate ASC LIMIT ".(is_array($limit)?$limit[0].','.$limit[1]:500000)."");
   return  $query->result_array();
}

public function getDifferentData(){
    $query = $this->db->query('select apx_invoice.*,apx_shipment.* from apx_invoice INNER JOIN apx_shipment on apx_invoice.dhl_no=apx_shipment.tracking_number and apx_invoice.weight != apx_shipment.shipWeight and apx_invoice.pcs != apx_shipment.shipPcs');
    return  $query;



}

/*Permission of shipment*/
/*public function getshipStatusPermission($per=null){
    $permission= array(
        1   =>  array('Billed','Checked','Delivered','Intransit','Lost','Problem','Partial','UnBilled','Unchecked','Manifested','Unmanifest'),
        2   =>  array('Billed','Checked','Delivered','Intransit','Lost','Problem','Partial','UnBilled','Unchecked','Manifested','Unmanifest'),
        3   =>  array('Billed','UnBilled'),
        4   =>  array('Unmanifest','Manifested'),
        5   =>  array('Intransit','Partial','Delivered','Problem','Lost'),
        );
    if(array_key_exists($per,$permission)){
        return $permission[$per];
    }else{
        return false;
    }
  }*/
  /*group action permission*/
  public function actionPermission($per){
    $permission= array(
        1   =>  array('Billed','Checked','Delivered','Intransit','Lost','Problem','Partial','UnBilled','Unchecked','Manifested','Unmanifest'),
        2   =>  array('Billed','Checked','Delivered','Intransit','Lost','Problem','Partial','UnBilled','Unchecked','Manifested','Unmanifest'),
        3   =>  array('UnBilled','Billed'),
        4   =>  array('Unmanifest','Manifested'),
        5   =>  array('Intransit','Delivered','Partial','Problem','Lost'),
        );
    if(array_key_exists($per,$permission)){
        return $permission[$per];
    }else{
        return false;
    }
  }
}
?>
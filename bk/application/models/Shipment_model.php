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
}
?>
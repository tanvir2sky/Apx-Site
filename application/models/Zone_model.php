<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
Class Zone_model extends CI_Model
{
/*
* GET ALL Zone RECORD QUERY 
*/
public function getZoneAllData($where=NULL,$order=NULL,$type=NULL,$start=NULL,$end=NULL) {
    $this->db->select('zn.*,pl.listName,pl.listCode,(select count(zc_id) from apx_zone_countries where zone_id=zn.zone_id) as total_countries,(select count(wp_id) from apx_weight_prices where zone_id=zn.zone_id) as total_wp,adm1.user_name as created_name,adm2.user_name as modified_name');
    $this->db->from('apx_zone zn');
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
    $this->db->join('apx_price_list pl', 'pl.list_id = zn.list_id');
    $this->db->join('apx_admin adm1', 'adm1.id = zn.created_by');
    $this->db->join('apx_admin adm2', 'adm2.id = zn.modified_by','LEFT');
    $query = $this->db->get();
    return $query->result_array();
    }
/*
* GET Zone countries record
*/
public function getZoneCountriesData($where=NULL,$order=NULL,$type=NULL,$start=NULL,$end=NULL) {
    $this->db->select('crt.*,zc.created_date,zc.zc_id,zc.zone_id,adm.user_name as created_name');
    $this->db->from('apx_countries crt');
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
    $this->db->join('apx_zone_countries zc', 'crt.countryCode = zc.countryCode','LEFT');
    $this->db->join('apx_admin adm', 'adm.id = zc.created_by','LEFT');
    $query = $this->db->get();
    return $query->result_array();

    }
}
?>
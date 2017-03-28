<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
Class Weight_prices_model extends CI_Model
{
/*
* GET ALL Weight & Prices RECORD QUERY 
*/
public function getWpAllData($where=NULL,$order=NULL,$type=NULL,$start=NULL,$end=NULL) {
    $this->db->select('wp.*,(select listCode from apx_price_list where list_id=wp.list_id) as listCode,(select zoneName from apx_zone where zone_id=wp.zone_id) as zoneName,adm1.user_name as created_name,adm2.user_name as modified_name');
    $this->db->from('apx_weight_prices wp');
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
    $this->db->join('apx_admin adm1', 'adm1.id = wp.created_by');
    $this->db->join('apx_admin adm2', 'adm2.id = wp.modified_by','LEFT');
    $query = $this->db->get();
    return $query->result_array();
    }
}
?>
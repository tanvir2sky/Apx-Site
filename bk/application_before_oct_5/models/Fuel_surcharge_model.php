<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
Class Fuel_surcharge_model extends CI_Model
{
/*
* GET ALL Fuel Surcharge RECORD QUERY 
*/
public function getFuelSurchargeAllData($where=NULL,$order=NULL,$type=NULL,$start=NULL,$end=NULL) {
    $this->db->select('fs.*,adm1.user_name as created_name,adm2.user_name as modified_name');
    $this->db->from('apx_fuel_surcharge fs');
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
    $this->db->join('apx_admin adm1', 'adm1.id = fs.created_by');
    $this->db->join('apx_admin adm2', 'adm2.id = fs.modified_by','LEFT');
    $query = $this->db->get();
    return $query->result_array();
}}
?>
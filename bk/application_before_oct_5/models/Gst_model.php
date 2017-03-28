<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
Class Gst_model extends CI_Model
{
/*
* GET ALL GST RECORD QUERY 
*/
public function getGstAllData($where=NULL,$order=NULL,$type=NULL,$start=NULL,$end=NULL) {
    $this->db->select('gst.*,adm1.user_name as created_name,adm2.user_name as modified_name');
    $this->db->from('apx_gst gst');
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
    $this->db->join('apx_admin adm1', 'adm1.id = gst.created_by');
    $this->db->join('apx_admin adm2', 'adm2.id = gst.modified_by','LEFT');
    $query = $this->db->get();
    return $query->result_array();
}}
?>
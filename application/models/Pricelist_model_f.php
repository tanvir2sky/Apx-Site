<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Pricelist_model_f extends CI_Model
{
    /*
    * GET ALL Price List RECORD QUERY
    */
    public function getPriceListAllData($where=NULL,$order=NULL,$type=NULL,$start=NULL,$end=NULL) {
        $this->db->select('pl.*,(select count(zone_id) from apx_zone_f where list_id=pl.list_id) as total_zone,adm1.user_name as created_name,adm2.user_name as modified_name');
        $this->db->from('apx_price_list_f pl');
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
        $this->db->join('apx_admin adm1', 'adm1.id = pl.created_by');
        $this->db->join('apx_admin adm2', 'adm2.id = pl.modified_by','LEFT');
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
Class Secure_model extends CI_Model
{
 /*Create complex session*/
 public function generate_complex_session($array){
 	   if(!empty($array)){
 	   	$this->session->set_userdata('admin_users',$array);
 	   }
		
 	

 }
 /*Update complex session*/
 public function update_complex_session(){
 	
 	

 }
 /*Load complex session parts*/
 public function session_parts($item){

	$data=array();
 	if($this->session->userdata('admin_users')){
 		//reutrn $data[$item]=$this->session->userdata('admin_users')[$item];
 		print_r($this->session->userdata('admin_users')['username']);
 	}

 }
}
?>
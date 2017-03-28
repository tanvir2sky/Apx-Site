<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
			$this->load->model('admins_model');
	}
	public function index()
	{
		//print_r($this->session->all_userdata());
		if($this->session->userdata('admin_users')){
			redirect(base_url('dashboard'));
		}else{
		$this->load->view('view_login');
		}
	}
	public function signin(){

		$username = $this->input->post('username', TRUE);
		$pass =     $this->input->post('password', TRUE);
		$remember = $this->input->post('remember', TRUE);

		if(!empty($username) && !empty($pass)){
			$result = $this->admins_model->select_single_record(array('user_name'=>$username,'password'=>md5($pass)));
			if(!empty($result)){
				if($result->status == 0){
					$this->session->set_flashdata('message', '<h6 align="center">Your account is not varified</h6>');
					redirect(site_url('login'));
				}else{
				$sessionData = array(
					'username' => $result->user_name,
					'user_val' => $result->id,
					'user_type' => $result->role_id,
					'login_status' => 1
				);
				$this->sm->generate_complex_session($sessionData);
				if($remember){
					$this->session->sess_expiration = '14400000';
				}
				$this->admins_model->update_record(array("isActive"=>1),array("id"=>$sessionData["user_val"]));
				redirect(site_url('dashboard'));
			}
		}else{
			$this->session->set_flashdata('message', '<h6 align="center" style="color:red;">Invalid credentials.</h6>');
			redirect(site_url('login'));
		}
	}else{
		$this->session->set_flashdata('message', '<h6 align="center" style="color:red;">Please provide username and password.</h6>');
			redirect(site_url('login'));
		}

	}
	public function logout(){
		if($this->session->userdata('admin_users')){
            $this->admins_model->update_record(array("isActive"=>0),array("id"=>$this->session->userdata('admin_users')["user_val"]));
			$this->session->unset_userdata('admin_users');
			$this->session->sess_destroy();
			redirect(site_url('login'));
		}else{
			redirect(site_url('login'));
		}
	}
	public function lost_password(){
		if(isset($_SESSION['user_data']['username'])){
			redirect(site_url('editor'));
		}else{
			$this->load->view('new_frontend/forgotpassword');
		}   
	}
	public function lost_password_action(){
		$email = $this->input->post('email');
		$res = $this->Users_model->get_by_email($email);
		$code = md5(time());
		if ($email && $res){

			$this->Users_model->update($res->userId, ['userVerificationCode' => $code]);
			$this->load->helper('send_mail');
			$msg = "you reset link is <a href=" . base_url() . "/frontend/reset_password/?code={$code}&email={$email}>LINK</a>";
			_sendMail($email, "Password reset link", $msg);
			$this->session->set_flashdata('message', '<div class="alert alert-success">Check Email for reset link or reset again <a href="'.site_url('lostpass').'">Reset Again</a></div>');
			redirect(site_url('info'));
			die('');
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Invalid Email.</div>');
			redirect(site_url('lostpass'));
		}
	}
	public function reset_password(){
		if(isset($_GET['email']) && isset($_GET['code']) && !empty($_GET['email']) && !empty($_GET['code'])){
			$email = $_GET['email'];
			$code = $_GET['code'];
			$res  = $this->Users_model->get_by_email($email);
			if($res && $res->userVerificationCode == $code){
				$user_data['id'] = $res->userId;
				$user_data['code'] = $res->userVerificationCode;
				$user_data['email'] = $res->userEmail;

				$this->load->view('new_frontend/recoverpassword',$user_data);
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Invalid Code or link expired try a new one.</div>');
				redirect(site_url('lostpass'));
			}
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Invalid Attempt.</div>');
			redirect(site_url('lostpass'));
		}
	}
	public function reset_password_action(){
		$id = $this->input->post('useridentity');
		$code = $this->input->post('usercode');
		$email = $this->input->post('useremail');
		$password = $this->input->post('password');
		$repassword = $this->input->post('repassword');
		$res = $this->Users_model->get_by_email($email);
		if( $res->userVerificationCode == $code && $password && $password == $repassword){
			$this->Users_model->update($id, ['userPassword' => md5($password),'userVerificationCode'=>md5(time())]);

			$this->session->set_flashdata('message', '<div class="alert alert-success">Password changed Successfully click to &nbsp;&nbsp;<a href="'.base_url().'login" >Login</a></div>');
			redirect(site_url('info'));
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Invalid data provided.</div>');
			redirect(site_url("frontend/reset_password/?code={$code}&email={$email}"));
		}
	}
}

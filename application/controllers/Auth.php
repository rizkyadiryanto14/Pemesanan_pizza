<?php
/**
 * @property $form_validation
 * @property $session
 * @property $input
 * @property $Auth_model
 */

class Auth extends CI_Controller
{
	private $authModel;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model');
		$this->authModel = $this->Auth_model;
	}

	/**
	 * @return void
	 */
	public function index():void
	{
		$this->load->view('auth/login');
	}

	/**
	 * @return void
	 */
	public function login():void
	{
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if(!$this->form_validation->run()){
			$this->session->set_flashdata('error', strip_tags(validation_errors()));
		}else {
			$email 		= $this->input->post('email');
			$password	= $this->input->post('password');

			$data_users = $this->authModel->getUsername($email);
			if($data_users){
				if(password_verify($password, $data_users['password'])){
					$data_session = [
						'id_users'	=> $data_users['id_users'],
						'username'	=> $data_users['username'],
						'email'		=> $data_users['email'],
						'role'		=> $data_users['role'],
					];
					$this->session->set_userdata($data_session);
					redirect(base_url('dashboard'));
				}else{
					$this->session->set_flashdata('error', 'Username atau Password Salah');
				}
				redirect(base_url('Auth'));
			}else {
				$this->session->set_flashdata('error', 'Login Failed');
			}
			redirect(base_url('Auth'));
		}
		redirect(base_url('Auth'));
	}

	/**
	 * @return void
	 */
	public function register():void
	{
		$this->load->view('auth/register');
	}

	/**
	 * @return void
	 */
	public function store():void
	{
		$data = [
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'role'	=> '2'
		];
		$insert = $this->authModel->insert($data);

		if($insert){
			$this->session->set_flashdata('success', 'Register Sukses');
		}else {
			$this->session->set_flashdata('error', 'Register Failed');
		}
		redirect(base_url('Auth'));
	}

	/**
	 * @return void
	 */
	public function logout():void
	{
		$this->session->sess_destroy();
		redirect(base_url('Home'));
	}
}

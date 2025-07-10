<?php

use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
	private $CI;
	private $auth;
	private $authModel;

	protected function setUp(): void
	{
		// Setup Auth Model mock
		$this->authModel = $this->getMockBuilder('Auth_model')
			->disableOriginalConstructor()
			->getMock();

		// Setup CI Loader mock dengan addMethods
		$loader = $this->getMockBuilder('CI_Loader')
			->disableOriginalConstructor()
			->addMethods(['model', 'view', 'library'])
			->getMock();

		// Setup Form Validation mock
		$formValidation = $this->getMockBuilder('CI_Form_validation')
			->disableOriginalConstructor()
			->addMethods(['set_rules', 'run', 'error_string']) // Tambahkan method yang dibutuhkan
			->getMock();

		// Setup Session mock
		$session = $this->getMockBuilder('CI_Session')
			->disableOriginalConstructor()
			->addMethods(['set_flashdata', 'set_userdata', 'sess_destroy']) // Tambahkan method yang dibutuhkan
			->getMock();

		// Setup Input mock
		$input = $this->getMockBuilder('CI_Input')
			->disableOriginalConstructor()
			->addMethods(['post']) // Tambahkan method post
			->getMock();

		// Konfigurasi loader mock
		$loader->expects($this->any())
			->method('model')
			->with('Auth_model')
			->willReturn($this->authModel);

		$loader->expects($this->any())
			->method('view')
			->willReturn(null);

		$loader->expects($this->any())
			->method('library')
			->willReturn(null);

		// Initialize Auth controller
		require_once __DIR__ . '/application/controllers/Auth.php';
		$this->auth = new Auth();

		// Inject dependencies
		$this->auth->load = $loader;
		$this->auth->form_validation = $formValidation;
		$this->auth->session = $session;
		$this->auth->input = $input;
		$this->auth->Auth_model = $this->authModel;
	}

	public function testLoginWithValidCredentials()
	{
		// Test data
		$email = 'admin@gmail.com';
		$password = 'password123';
		$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

		$userData = [
			'id_users' => 1,
			'username' => 'admin',
			'email' => $email,
			'password' => $hashedPassword,
			'role' => 'admin'
		];

		// Setup form validation expectations
		$this->auth->form_validation->expects($this->once())
			->method('run')
			->willReturn(true);

		// Setup input expectations
		$this->auth->input->expects($this->exactly(2))
			->method('post')
			->willReturnMap([
				['email', $email],
				['password', $password]
			]);

		// Setup Auth_model expectations
		$this->auth->Auth_model->expects($this->once())
			->method('getUsername')
			->with($email)
			->willReturn($userData);

		// Setup session expectations
		$expectedSessionData = [
			'id_users' => $userData['id_users'],
			'username' => $userData['username'],
			'email' => $userData['email'],
			'role' => $userData['role']
		];

		$this->auth->session->expects($this->once())
			->method('set_userdata')
			->with($expectedSessionData);

		// Call the login method
		$this->auth->login();
	}

	public function testLoginWithInvalidCredentials()
	{
		$email = 'invalid@example.com';
		$password = 'wrongpassword';

		// Setup expectations
		$this->auth->form_validation->expects($this->once())
			->method('run')
			->willReturn(true);

		$this->auth->input->expects($this->exactly(2))
			->method('post')
			->willReturnMap([
				['email', $email],
				['password', $password]
			]);

		$this->auth->Auth_model->expects($this->once())
			->method('getUsername')
			->with($email)
			->willReturn(null);

		// Expect error flashdata to be set
		$this->auth->session->expects($this->once())
			->method('set_flashdata')
			->with('error', 'Login Failed');

		$this->auth->login();
	}

	public function testLoginWithInvalidFormValidation()
	{
		// Setup expectations for failed form validation
		$this->auth->form_validation->expects($this->once())
			->method('run')
			->willReturn(false);

		$this->auth->form_validation->expects($this->once())
			->method('error_string')
			->willReturn('Validation errors');

		// Expect error flashdata to be set
		$this->auth->session->expects($this->once())
			->method('set_flashdata')
			->with('error', 'Validation errors');

		$this->auth->login();
	}

	public function testLogout()
	{
		// Expect session to be destroyed
		$this->auth->session->expects($this->once())
			->method('sess_destroy');

		$this->auth->logout();
	}
}

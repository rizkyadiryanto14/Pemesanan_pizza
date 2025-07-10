<?php


use PHPUnit\Framework\TestCase;

class PesananTest extends TestCase
{
	protected function setUp(): void
	{
		$this->CI = $this->getMockBuilder('CI_Controller')
			->disableOriginalConstructor()
			->getMock();

		$this->auth = new Auth();

		// Load necessary libraries and helpers
		$this->CI->load = $this->getMockBuilder('CI_Loader')
			->disableOriginalConstructor()
			->getMock();

		$this->CI->load->method('library')
			->willReturn(null);

		$this->CI->load->method('model')
			->willReturn(null);

		$this->CI->form_validation = $this->getMockBuilder('CI_Form_validation')
			->disableOriginalConstructor()
			->getMock();

		$this->CI->session = $this->getMockBuilder('CI_Session')
			->disableOriginalConstructor()
			->getMock();

		$this->CI->input = $this->getMockBuilder('CI_Input')
			->disableOriginalConstructor()
			->getMock();

		$this->auth->load = $this->CI->load;
		$this->auth->form_validation = $this->CI->form_validation;
		$this->auth->session = $this->CI->session;
		$this->auth->input = $this->CI->input;
		$this->auth->Auth_model = $this->getMockBuilder('Auth_model')
			->disableOriginalConstructor()
			->getMock();
	}
}

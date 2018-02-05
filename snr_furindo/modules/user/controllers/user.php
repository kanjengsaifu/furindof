<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

	class User extends MY_Controller 
	{
	   	
	   	private $isLoginOK;
	   	private $namaUser;
	   	private $kataSandi;

	    public function __construct() 
	    {
	        parent::__construct();
	        $this->load->helper('func_helper');
	    }
	         
		public function index()
		{	
			$this->load->view('login_view');	
		}

public function cek()
{
	echo 'TES';
}

public function login()
{

		$this->checkIsAjaxRequest();
		
		if ( ! isCRSFVerify() )
	{
		$messageData = ConstructMessageResponse('token direct akses telah expired', 'danger');
		echo json_encode($messageData);	
		exit;									
	}

	$this->form_validation->set_rules('email', 'email', 'trim|required|xss_clean');
	$this->form_validation->set_rules('kataSandi', 'kata sandi', 'trim|required|xss_clean');
	
	if ( ! $this->form_validation->run() )
	{								
		
		$messageData = ConstructMessageResponse('Periksa kembali email dan kata sandi anda' , 'warning');	
		echo $messageData;

		exit;
	}	

	$this->email   = $this->input->post('email', true);
	$this->kataSandi  = $this->input->post('kataSandi', true);

	$this->load->model('credential_model', 'operatorLoginModel');

	$this->isLoginOK = $this->operatorLoginModel->isLoginOK($this->email, $this->kataSandi, true);	
			
	if ($this->isLoginOK)
	{
		echo "<script>window.location='".base_url()."main';</script>";
	}	
	else
	{
		$messageData = ConstructMessageResponse('Akses login tidak berhasil' , 'danger');
		echo $messageData."<script>$('#".config_item('csrf_token_name')."').val('".GenerateNewCRSFHash()."')</script>";	
	}			

}

		public function logout()
		{
				
			$this->load->model('credential_model', 'memberLogout');
			$this->memberLogout->sessionDestroy();	

			session_destroy();

			header('Location:'.base_url());
		}

	}

/* End of file user.php */
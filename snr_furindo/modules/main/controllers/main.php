<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

	class Main extends MY_Controller {

	    public function __construct() {
	        parent::__construct();
	    }
	         
		public function index()
		{	
			$this->checkCredentialAccess();
			
			$this->load->model('group_modul_model', 'ModelGroupModul');
			$this->load->model('main_model', 'ModelDataOperator');

			$dataGroupModul = array('daftarGroupModul' 		=> $this->ModelGroupModul->GetDaftarGroupModul(),
									'daftarProfilOperator' 	=> $this->ModelDataOperator->GetProfilOperator());

			$this->load->view('header', $dataGroupModul);

			$menu = $this->load->view('menu_main_view', true);
			$dataMenu = array('menu' => $menu);

			$this->load->view('left_sidebar', $dataMenu);
			$this->load->view('main_view');			
			$this->load->view('footer');
		}	

		public function SetUnitKerjaAktif()
		{

			$this->IDUPTD = $this->input->post('IDUPTDAktif', true);

			$this->load->model('main_model', 'ModelCheckUPTD');
			$this->isCheckValidUPTD = $this->ModelCheckUPTD->CheckValidUPTD($this->IDUPTD);

			if ($this->isCheckValidUPTD){
				$_SESSION['IDLokasiAktif'] = $this->IDUPTD;

				$this->load->model('main_model', 'ModelGetNamaUPTD');
				$this->arrDataBLUD 		= $this->ModelGetNamaUPTD->GetDataUPTDLaporanRBA($this->IDUPTD);
				$this->namaUPTD 		= $this->arrDataBLUD['NamaUPTD'];
				$this->NIPPimpinanBLUD  = $this->arrDataBLUD['NIPPimpinanBLUD'];
				$this->NamaPimpinanBLUD = $this->arrDataBLUD['NamaPimpinanBLUD'];

				echo "<script>
							$('.ajaxNamaUPTD').html('".$this->namaUPTD."');
							$('.ajaxNIPPimpinanBLUD').html('".$this->NIPPimpinanBLUD."');
							$('.ajaxNamaPimpinanBLUD').html('".$this->NamaPimpinanBLUD."');
					  </script>";
			}

		}

		public function setDatabaseAktif()
		{
			$this->tahunAnggaranAktif = $this->input->post('tahunAktif', true);
			$_SESSION['tahunAnggaranAktif'] = $this->tahunAnggaranAktif;
		}
}


/* End of file main.php */
<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

	class Akuntansi extends MY_Controller {
		
 	    public function __construct() 
	    {
			parent::__construct();
		}
	         
		public function index()
		{	
			$this->checkCredentialAccess();

			$this->checkIsAjaxRequest();

	        $this->load->model('akuntansi_model', 'ModelAkuntansi');
	        $dataMenu = array('dataMenu' => $this->ModelAkuntansi->GetMenuAkuntansi());

	        $menu 	  = $this->load->view('menu_akuntansi_view', $dataMenu, true);
	        $content  = $this->load->view('akuntansi_view', '', true);

	        $arrData = array('menu' 	=> $menu,
	        			   	 'content'  => $content);

	        echo json_encode($arrData);

		}

		public function Addpenyesuaian()

		{

			$cari = $this->db->query("SELECT nomor from trx_jurnal order by id_jurnal DESC");
			$num = $this->db->query("SELECT nobukti from trx_jurnal where nobukti like '%PS%' order by id_jurnal DESC");

			if ($cari->num_rows()==0) {
				$data['bkk'] = 'JU-0000';				
			}else{
				$data['bkk'] = $cari->row()->nomor;				
			}
			if ($num->num_rows()==0) {				
				$data['bukti'] = 'PS-0000';
			}else{				
				$data['bukti'] = $num->row()->nobukti;
			}

            $content = $this->load->view('penyesuaian_view', $data, true);
              
            echo $content;

		}
		
		public function GetDaftarAkun()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();

            

            $this->load->model("akuntansi_model", "ModelAkuntansi");

            

            echo $this->ModelAkuntansi->GetDaftarAkun(); 

		}
		
		function savepenyesuaian()
		{
					
			//echo "<pre>";print_r($_POST);"</pre>";exit();
			
			$tgl = date("Y-m-d", strtotime($this->input->post("tanggal")));
			$catatan = $this->input->post("catatan");
			$bukti = $this->input->post("nomor");				
						
			$c_kontak = count($this->input->post("nomor_jurnal"));
			
			for($i=0; $i<$c_kontak;$i++)
			{				
				$data2['nomor'] = $_POST['nomor_jurnal'][$i];
				$data2['tgl'] = $tgl;
				$data2['uraian'] = $_POST['uraian'][$i];
				$data2['memo'] = $catatan;
				$data2['akun'] = $_POST['kode'][$i];
				$data2['nobukti'] = $bukti;				
				$data2['id_kategori'] = 1;
				$data2['dateentry'] = date("Y-m-d");
				$data2['userentry'] = $_SESSION['IDUser'];
				$num = strToCurrDB($_POST['nominal2'][$i]);
				if($num==0){
				$data2['jenis'] = 'um';
				$data2['nominal'] = strToCurrDB($_POST['nominal'][$i]);
				}else{
				$data2['jenis'] = 'uk';
				$data2['nominal'] = '-'.strToCurrDB($_POST['nominal2'][$i]);
				}														
				$this->db->insert("trx_jurnal", $data2);
			}

		}

		public function Penyesuaian()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



            $content = $this->load->view('daftar_penyesuaian', '', true);

                          

            echo $content;

		}

		public function GetDaftarPenyesuaian()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();

            

            $this->load->model("akuntansi_model", "ModelAkuntansi");

            

            echo $this->ModelAkuntansi->GetDaftarAkuntansi(); 

		}

		public function printpenyesuaian($idx)
		{
			//$cari = $this->db->query("SELECT sum(nominal) as nominal from trx_jurnal where id_jurnal = '".$idx."'")->row();

			$data['jurnal'] = $idx;

			//$data['terbilang'] = $this->Terbilang($cari->nominal).' rupiah';

           	$this->load->view('printpenyesuaian', $data);                

           
		}

	}

/* End of file anggaran.php */

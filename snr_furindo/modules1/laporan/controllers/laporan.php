<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

	class Laporan extends MY_Controller {
		
 	    public function __construct() 
	    {
			parent::__construct();
		}
	         
		public function index()
		{	
			$this->checkCredentialAccess();

			$this->checkIsAjaxRequest();

	        $this->load->model('laporan_model', 'ModelLaporan');
	        $dataMenu = array('dataMenu' => $this->ModelLaporan->GetMenuLaporan());

	        $menu 	  = $this->load->view('menu_laporan_view', $dataMenu, true);
	        $content  = $this->load->view('laporan_view', '', true);

	        $arrData = array('menu' 	=> $menu,
	        			   	 'content'  => $content);

	        echo json_encode($arrData);

		}

		public function Rugilaba()

		{

			$data['kas'] = $this->db->query("SELECT kode, trx_kas_det.uraian, sum(nominal) as nominal, jenis from trx_kas_det inner join trx_kas 
				on trx_kas.id_kas = trx_kas_det.id_kas where kode in (select kode_pemasukan from mst_pemasukan) 
				or kode in (select kode_pengeluaran from mst_pengeluaran) group by kode");

            $content = $this->load->view('rugi_laba_view', $data, true);                          

            echo $content;

		}

		public function Neraca()

		{
			$data['debet'] = $this->db->query("SELECT sum(nominal) as nominal from trx_kas_det inner join trx_kas 
				on trx_kas.id_kas = trx_kas_det.id_kas where (kode in (select kode_pemasukan from mst_pemasukan) 
				or kode in (select kode_pengeluaran from mst_pengeluaran)) and jenis = 'um'")->row();

			$data['kredit'] = $this->db->query("SELECT sum(nominal) as nominal from trx_kas_det inner join trx_kas 
				on trx_kas.id_kas = trx_kas_det.id_kas where (kode in (select kode_pemasukan from mst_pemasukan) 
				or kode in (select kode_pengeluaran from mst_pengeluaran)) and jenis = 'uk'")->row();

			$data['aktiva'] = $this->db->query("SELECT kode_kasbank,nama_kasbank, sum(nominal) as total from mst_kasbank left join trx_jurnal on mst_kasbank.kode_kasbank =
				trx_jurnal.akun where status = 0 and level !=0 group by kode_kasbank");

			$data['pasiva'] = $this->db->query("SELECT kode_kasbank,nama_kasbank, sum(nominal) as total from mst_kasbank left join trx_jurnal on mst_kasbank.kode_kasbank =
				trx_jurnal.akun where status = 1 and level !=0 group by kode_kasbank");

			$data['neraca'] = $this->db->query("SELECT kode_kasbank,nama_kasbank, sum(nominal) as total from mst_kasbank left join trx_jurnal on mst_kasbank.kode_kasbank =
				trx_jurnal.akun where status = 1 and level !=0 ")->row();		

            $content = $this->load->view('neraca_view', $data, true);
            $this->Bukubesar();                          

            echo $content;

		}

		public function Bukubesar()

		{

		$kas = $this->db->query("SELECT trx_kas_det.*,trx_kas.*,trx_kas_det.uraian as keterangan from trx_kas inner join trx_kas_det on trx_kas.id_kas=trx_kas_det.id_kas 
			where trx_kas.nomor_kas not in (select nobukti from trx_jurnal) or kode 
			not in(select akun from trx_jurnal)");
		$bank = $this->db->query("SELECT trx_kas.*, sum(trx_kas_det.nominal) as nominal,mst_kasbank.*  from trx_kas inner join trx_kas_det 
			on trx_kas.id_kas=trx_kas_det.id_kas inner join mst_kasbank on trx_kas.id_kasbank = mst_kasbank.id_kasbank
			where trx_kas.nomor_kas not in (select nobukti from trx_jurnal) OR kode_kasbank
			not in(select akun from trx_jurnal) group by trx_kas.nomor_kas");
		
			foreach ($bank->result() as $key => $values) 
			{
				$cek1 = $this->db->query("SELECT * from trx_jurnal");				
				$jml1 = $cek1->num_rows();
				$jml_det1=0;
				if ($jml1 == 0) {
					$data1['nomor']= 'JU-0001';
				} else if($jml1 < 10){
					$jml_det1 = $jml1+1;
					$data1['nomor']= 'JU-000'.$jml_det1;
				} else if($jml1 < 100){
					$jml_det1 = $jml1+1;
					$data1['nomor']= 'JU-00'.$jml_det1;
				} else if($jml1 < 1000){
					$jml_det1 = $jml1+1;
					$data1['nomor']= 'JU-0'.$jml_det1;
				} else {
					$jml_det1 = $jml1+1;
					$data1['nomor']= 'JU-'.$jml_det1;
				}
				$data1['tgl']= date("Y-m-d", strtotime($values->tgl_kas));
				$data1['uraian']= $values->uraian;
				$data1['nobukti']= $values->nomor_kas;
				$data1['id_kategori']= $values->id_kategori;
				$data1['akun']= $values->kode_kasbank;				
				if ($values->jenis == 'um'){
					$data1['jenis']= 'um';
					$data1['nominal']= $values->nominal;
				} else {
					$data1['jenis']= 'uk';
					$data1['nominal']= '-'.$values->nominal;
				}
				$data1['dateentry']= date("Y-m-d");
				$data1['userentry']= $_SESSION['IDUser'];			
				$this->db->insert("trx_jurnal", $data1);
			}
		
			foreach ($kas->result() as $key => $value) 
			{
				$cek = $this->db->query("SELECT * from trx_jurnal");
				$jml = $cek->num_rows();
				$jml_det=0;
				if ($jml == 0) {
					$data['nomor']= 'JU-0001';
				} else if($jml < 10){
					$jml_det = $jml+1;
					$data['nomor']= 'JU-000'.$jml_det;
				} else if($jml < 100){
					$jml_det = $jml+1;
					$data['nomor']= 'JU-00'.$jml_det;
				} else if($jml < 1000){
					$jml_det = $jml+1;
					$data['nomor']= 'JU-0'.$jml_det;
				} else {
					$jml_det = $jml+1;
					$data['nomor']= 'JU-'.$jml_det;
				}
				$data['tgl']= date("Y-m-d", strtotime($value->tgl_kas));
				$data['uraian']= $value->keterangan;
				$data['nobukti']= $value->nomor_kas;
				$data['id_kategori']= $value->id_kategori;
				$data['akun']= $value->kode;				
				if ($value->jenis == 'um'){
					$data['jenis']= 'uk';
					$data['nominal']= '-'.$value->nominal;
				} else {
					$data['jenis']= 'um';
					$data['nominal']= $value->nominal;
				}
				$data['dateentry']= date("Y-m-d");
				$data['userentry']= $_SESSION['IDUser'];			
				$this->db->insert("trx_jurnal", $data);
				
			}
			//echo "selesai";

		}
		
		public function printlabarugi()
		{
			

           	$this->load->view('cetak_rugi_laba');                

           
		}
		
		public function printneraca()

		{
			$data['debet'] = $this->db->query("SELECT sum(nominal) as nominal from trx_kas_det inner join trx_kas 
				on trx_kas.id_kas = trx_kas_det.id_kas where (kode in (select kode_pemasukan from mst_pemasukan) 
				or kode in (select kode_pengeluaran from mst_pengeluaran)) and jenis = 'um'")->row();

			$data['kredit'] = $this->db->query("SELECT sum(nominal) as nominal from trx_kas_det inner join trx_kas 
				on trx_kas.id_kas = trx_kas_det.id_kas where (kode in (select kode_pemasukan from mst_pemasukan) 
				or kode in (select kode_pengeluaran from mst_pengeluaran)) and jenis = 'uk'")->row();

			$data['aktiva'] = $this->db->query("SELECT kode_kasbank,nama_kasbank, sum(nominal) as total from mst_kasbank left join trx_jurnal on mst_kasbank.kode_kasbank =
				trx_jurnal.akun where status = 0 and level !=0 group by kode_kasbank");

			$data['pasiva'] = $this->db->query("SELECT kode_kasbank,nama_kasbank, sum(nominal) as total from mst_kasbank left join trx_jurnal on mst_kasbank.kode_kasbank =
				trx_jurnal.akun where status = 1 and level !=0 group by kode_kasbank");

			$data['neraca'] = $this->db->query("SELECT kode_kasbank,nama_kasbank, sum(nominal) as total from mst_kasbank left join trx_jurnal on mst_kasbank.kode_kasbank =
				trx_jurnal.akun where status = 1 and level !=0 ")->row();		

            $this->load->view('cetak_neraca', $data);   

		}

	}

/* End of file anggaran.php */

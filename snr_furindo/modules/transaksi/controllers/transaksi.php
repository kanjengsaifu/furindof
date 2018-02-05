	<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

	class Transaksi extends MY_Controller {
		
 	    public function __construct() 
	    {
			parent::__construct();
		}
	         
		public function index()
		{	
			$this->checkCredentialAccess();

			$this->checkIsAjaxRequest();

	        $this->load->model('transaksi_model', 'ModelTransaksi');
	        $dataMenu = array('dataMenu' => $this->ModelTransaksi->GetMenuTransaksi());

	        $menu 	  = $this->load->view('menu_transaksi_view', $dataMenu, true);
	        $content  = $this->load->view('dashboard_view', '', true);

	        $arrData = array('menu' 	=> $menu,
	        			   	 'content'  => $content);

	        echo json_encode($arrData);

		}

		function CurrToString()
		{
			$x = $this->input->post("nominal");
			$string = $this->Terbilang($x);
			
			echo $string;
		}

		function Terbilang($x)
		{
		  $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		  if ($x < 12)
			return " " . $abil[$x];
		  elseif ($x < 20)
			return $this->Terbilang($x - 10) . " belas";
		  elseif ($x < 100)
			return $this->Terbilang($x / 10) . " puluh" . $this->Terbilang($x % 10);
		  elseif ($x < 200)
			return " seratus" . $this->Terbilang($x - 100);
		  elseif ($x < 1000)
			return $this->Terbilang($x / 100) . " ratus" . $this->Terbilang($x % 100);
		  elseif ($x < 2000)
			return " seribu" . $this->Terbilang($x - 1000);
		  elseif ($x < 1000000)
			return $this->Terbilang($x / 1000) . " ribu" . $this->Terbilang($x % 1000);
		  elseif ($x < 1000000000)
			return $this->Terbilang($x / 1000000) . " juta " . $this->Terbilang($x % 1000000);
		  elseif ($x < 10000000000000)
		  	$a = $x / 1000000000;
			return $this->Terbilang($x / 1000000000) . " milyar ";
		}

		function tambahpinjaman()
		{
			$cari = $this->db->query("SELECT * FROM trx_pinjaman ORDER BY kode_pinjaman DESC LIMIT 1");
			$datanomor = $this->db->query("SELECT * FROM trx_pinjaman ORDER BY kode_pinjaman DESC LIMIT 1")->row();

			$cek = $this->db->query("SELECT nomor_kas from trx_kas where nomor_kas like '%BKK%' order by nomor_kas DESC");

			if ($cek->num_rows()==0) {
				$data['bkk'] = 'BKK-0000';
			}else{
				$data['bkk'] = $cek->row()->nomor_kas;
			}
			
			if($cari->num_rows() != 0){
				$data['mohon'] = $datanomor->kode_pinjaman;
				$data['nomor'] = "";
			}else{				
				$data['nomor'] = "PJM0001";
				$data['mohon'] = "";
			}
   			$ops = $this->load->view('transaksi/add_pinjaman_view', $data, true);
			
   			echo $ops ;
		}

		function tambahsimpanan()
		{
			$cari = $this->db->query("SELECT * FROM trx_simpanan ORDER BY kode_simpanan DESC LIMIT 1");
			$datanomor = $this->db->query("SELECT * FROM trx_simpanan ORDER BY kode_simpanan DESC LIMIT 1")->row();
			
			if($cari->num_rows() != 0){
				$data['mohon'] = $datanomor->kode_simpanan;
				$data['nomor'] = "";
			}else{				
				$data['nomor'] = "SPM0001";
				$data['mohon'] = "";
			}
   			$ops = $this->load->view('transaksi/add_simpanan_view', $data, true);
			
   			echo $ops ;
		}

		function tambahangsuran()
		{
			$kode = $this->input->post("idx");
			$data['nasabah'] = $this->db->query("SELECT * from trx_pinjaman inner join trx_pinjaman_det on trx_pinjaman.id_pinjaman = trx_pinjaman_det.id_pinjaman
							inner join mst_nasabah on trx_pinjaman_det.id_nasabah = mst_nasabah.id_nasabah inner join mst_kontak 
							on mst_nasabah.id_kontak = mst_kontak.id left join mst_ksm on trx_pinjaman.id_ksm = mst_ksm.id_ksm where trx_pinjaman.id_pinjaman = '".$kode."'");
			$data['akun'] = $this->db->query("SELECT * from mst_pengeluaran where id_pengeluaran = 29 ")->row();
			$cari = $this->db->query("SELECT nomor_kas from trx_kas where nomor_kas like '%BKM%' order by nomor_kas DESC");
			$data['id_pinjaman'] = $kode;
			if ($cari->num_rows()==0) {
				$data['bkm'] = 'BKM-0000';
			}else{
				$data['bkm'] = $cari->row()->nomor_kas;
			}
   			$ops = $this->load->view('transaksi/add_angsuran_view', $data, true);
			
   			echo $ops ;
		}
		
		public function Pinjaman()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



            $content = $this->load->view('pinjaman_view', '', true);

                          

            echo $content;

		}
		

		public function Simpanan()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



            $content = $this->load->view('simpanan_view', '', true);

                          

            echo $content;

		}

		public function Angsuran()

		{
			$this->checkCredentialAccess();


            $this->checkIsAjaxRequest();
			

            $content = $this->load->view('angsuran_view', '', true);

                          

            echo $content;

		}

		public function Bkk()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



            $content = $this->load->view('bkk_view', '', true);

                          

            echo $content;

		}

		public function Bkm()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



            $content = $this->load->view('bkm_view', '', true);

                          

            echo $content;

		}

		public function InputBkk()

		{

			$cari = $this->db->query("SELECT nobukti from trx_jurnal where nobukti like '%BKK%' order by nobukti DESC");

			if ($cari->num_rows()==0) {
				$data['bkk'] = 'BKK-0000';
			}else{
				$data['bkk'] = $cari->row()->nobukti;
			}

            $content = $this->load->view('input_bkk_view', $data, true);
              
            echo $content;

		}

		public function InputBkm()

		{
			$cari = $this->db->query("SELECT nobukti from trx_jurnal where nobukti like '%BKM%' order by nobukti DESC");

			if ($cari->num_rows()==0) {
				$data['bkm'] = 'BKM-0000';
			}else{
				$data['bkm'] = $cari->row()->nobukti;
			}
			$content = $this->load->view('input_bkm_view', $data, true);
                          

            echo $content;

		}

		public function GetKontak($tipe = null)

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();

            

            $this->load->model("transaksi_model", "ModelTransaksi");


            echo $this->ModelTransaksi->ChangeDaftarKontak($tipe); 

		}

		public function GetKontak1($tipe = null)

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();

            

            $this->load->model("transaksi_model", "ModelTransaksi");


            echo $this->ModelTransaksi->ChangeDaftarKontak1($tipe); 

		}

		public function GetDaftarKasBank()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();

            

            $this->load->model("transaksi_model", "ModelTransaksi");

            

            echo $this->ModelTransaksi->GetDaftarKasBank(); 

		}

		public function GetDaftarBkk()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();

            

            $this->load->model("transaksi_model", "ModelTransaksi");

            

            echo $this->ModelTransaksi->GetDaftarBkk(); 

		}

		public function GetDaftarBkm()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();

            

            $this->load->model("transaksi_model", "ModelTransaksi");

            

            echo $this->ModelTransaksi->GetDaftarBkm(); 

		}

		public function edit_bkk()
		{
			$idx = $this->input->post("IDBidang");
			$data['bkk'] = $this->db->query("SELECT * from trx_jurnal left join mst_provider on mst_provider.provider_id = trx_jurnal.provider_id where id_jurnal ='".$idx."'")->row();
			$this->load->view('edit_bkk_view', $data); 
		}

		public function edit_bkm()
		{
			$idx = $this->input->post("IDBidang");
			$data['bkk'] = $this->db->query("SELECT * from trx_jurnal left join mst_provider on mst_provider.provider_id = trx_jurnal.provider_id where id_jurnal ='".$idx."'")->row();
			$this->load->view('edit_bkm_view', $data); 
		}

		public function printbkm($idx)
		{
			$cari = $this->db->query("SELECT sum(nominal) as nominal from trx_jurnal where id_jurnal = '".$idx."'")->row();

			$data['kas'] = $idx;

			$data['terbilang'] = $this->Terbilang($cari->nominal).' rupiah';

           	$this->load->view('cetak_bkm', $data);                

           
		}

		public function printbkk($idx)
		{
			$cari = $this->db->query("SELECT nominal from trx_jurnal where id_jurnal = '".$idx."'")->row();

			$data['kas'] = $idx;

			$data['terbilang'] = $this->Terbilang($cari->nominal*-1).' rupiah';

           	$this->load->view('cetak_bkk', $data);                

           
		}

		public function printbuktibank()
		{
			

           	$this->load->view('print_daftar_bank_masuk');                

           
		}

		public function printbuktikas()
		{
			

           	$this->load->view('print_daftar_kas_masuk');                

           
		}

		public function GetDaftarPemasukan()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();

            

            $this->load->model("transaksi_model", "ModelTransaksi");

            

            echo $this->ModelTransaksi->GetDaftarPemasukan(); 

		}

		public function GetDaftarPengeluaran()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();

            

            $this->load->model("transaksi_model", "ModelTransaksi");

            

            echo $this->ModelTransaksi->GetDaftarPengeluaran(); 

		}

		public function detailpinjaman()

		{

			$kode = $this->input->post("idx");
			$data['ksm'] = $this->db->query("SELECT * from trx_pinjaman inner join mst_ksm on trx_pinjaman.id_ksm = mst_ksm.id_ksm where id_pinjaman='".$kode."'")->row();
			$data['nasabah'] = $this->db->query("SELECT * from trx_pinjaman_det inner join mst_nasabah on trx_pinjaman_det.id_nasabah = mst_nasabah.id_nasabah 
				inner join mst_kontak on mst_nasabah.id_kontak = mst_kontak.id where id_pinjaman='".$kode."'");
            $content = $this->load->view('rincian_pinjaman_view', $data, true);

                          

            echo $content;

		}

		public function caridataksm()
		{

			//echo "<pre>";print_r($_POST);"</pre>";exit();
            $kode = $this->input->post("kode");
            //$namaB = $this->input->post("nama");
            $param = $this->db->query("SELECT * from mst_ksm
                                              where id_ksm NOT IN (SELECT id_ksm from trx_pinjaman where status = 0) and (nama_ksm like '%".$kode."%' OR kode_ksm like '%".$kode."%')
                                			  order by kode_ksm asc");
    		if ($param->num_rows()>0) {
    			$i=0;
           	foreach($param->result() as $row)
			{
				$i++;
				$data['NO'] = $i;
				$data['ID'] = $row->id_ksm;
				$data['Kode'] = $row->kode_ksm;
				$data['Nama'] = $row->nama_ksm;				
				//$data['Jumlah'] = $row->Jumlah;		
				
				$json['ksm'][] = $data;
				
			}
			$json['status'] = true;
			}else{
				$json['status'] = false;
			}
			//$json['status'] = true;
			
			$dataJson = json_encode($json);
			
			echo $dataJson;

		}

		public function caridataksm2()
		{

			//echo "<pre>";print_r($_POST);"</pre>";exit();
            $kode = $this->input->post("kode");
            //$namaB = $this->input->post("nama");
            $param = $this->db->query("SELECT * from mst_ksm
                                              where id_ksm NOT IN (SELECT id_ksm from trx_simpanan where status = 0) and (nama_ksm like '%".$kode."%' OR kode_ksm like '%".$kode."%')
                                			  order by kode_ksm asc");
    		if ($param->num_rows()>0) {
    			$i=0;
           	foreach($param->result() as $row)
			{
				$i++;
				$data['NO'] = $i;
				$data['ID'] = $row->id_ksm;
				$data['Kode'] = $row->kode_ksm;
				$data['Nama'] = $row->nama_ksm;				
				//$data['Jumlah'] = $row->Jumlah;		
				
				$json['ksm'][] = $data;
				
			}
			$json['status'] = true;
			}else{
				$json['status'] = false;
			}
			//$json['status'] = true;
			
			$dataJson = json_encode($json);
			
			echo $dataJson;

		}

		function saveangsuran()
		{
			
			$data['nomor_kas'] = $this->input->post("nomor");
			$data['id_ksm'] = $this->input->post("id_ksm");
			$data['tgl_kas'] = date("Y-m-d", strtotime($this->input->post("tanggal")));
			$data['uraian'] = $this->input->post("catatan");
			$data['id_kasbank'] = $this->input->post("id_kasbank");
			$data['id_kategori'] = 1;
			$data['acc'] = 0;
			$data['jenis'] = 'um';
			$data['dateentry'] = date("Y-m-d");
			$data['userentry'] = $_SESSION['IDUser'];
			
			$this->db->insert("trx_kas", $data);
			
			$idkas = $this->db->insert_id();
			
			// INSERT TO trx_reg_nasabah //
			//$pinjaman_id = $this->input->post("id_pinjaman");
			$c_kontak = count($this->input->post("kode"));
			
			for($i=0; $i<$c_kontak;$i++)
			{				
				$data2['id_kas'] = $idkas;
				$data2['kode'] = '1.1.3';
				$data2['uraian'] = 'Pinjaman KSM';
				$data2['memo'] = $_POST['uraian'][$i];
				$data2['nominal'] = strToCurrDB($_POST['nominal_pokok'][$i]);
				$data2['id_nasabah'] = $_POST['id-nas-'][$i];														
				$this->db->insert("trx_kas_det", $data2);

				// $data1['id_pinjaman_det'] =$_POST['id_pinjaman_det'][$i];
				// $data1['id_nasabah'] = $_POST['id-nas-'][$i];
				// $cek = $this->db->query("SELECT angsuran_ke from trx_angsuran where id_pinjaman_det ='".$data1['id_pinjaman_det']."' AND id_nasabah ='".$data1['id_nasabah']."' order by angsuran_ke DESC");				
				
				// $data1['nominal'] = strToCurrDB($_POST['nominal_pokok'][$i]);
				// if ($cek->num_rows() == 0) {
				// 	$data1['angsuran_ke'] = 1;
				// }else{					
				// 	$data1['angsuran_ke'] = $cek->row()->angsuran_ke+1;
				// }
				// $this->db->insert("trx_angsuran", $data1);
			}

			$c_jasa = count($this->input->post("kode-jasa"));
			
			for($a=0; $a<$c_jasa;$a++)
			{				
				$data3['id_kas'] = $idkas;
				$data3['kode'] = '4.1.1';
				$data3['uraian'] = 'Jasa/Bunga Pinjaman KSM';
				$data3['memo'] = $_POST['uraian-jasa'][$a];
				$data3['nominal'] = strToCurrDB($_POST['nominal_jasa'][$a]);
				$data3['id_nasabah'] = $_POST['id-nas-jasa-'][$a];														
				$this->db->insert("trx_kas_det", $data3);
			}

			$c_wajib = count($this->input->post("kode-wajib"));
			
			for($b=0; $b<$c_wajib;$b++)
			{				
				$data4['id_kas'] = $idkas;
				$data4['kode'] = '2.1.2';
				$data4['uraian'] = 'Simpanan Wajib';
				$data4['memo'] = $_POST['uraian-wajib'][$b];
				$data4['nominal'] = strToCurrDB($_POST['nominal_wajib'][$b]);
				$data4['id_nasabah'] = $_POST['id-nas-wajib-'][$b];														
				$this->db->insert("trx_kas_det", $data4);
			}

			$c_sr = count($this->input->post("kode-sr"));
			if ($c_sr==0) {
				
			}else{
				for($c=0; $c<$c_sr;$c++)
				{				
					$data5['id_kas'] = $idkas;
					$data5['kode'] = '2.1.2';
					$data5['uraian'] = 'Simpanan Sukarela';
					$data5['memo'] = $_POST['uraian-sr'][$c];
					$data5['nominal'] = strToCurrDB($_POST['nominal_sr'][$c]);
					$data5['id_nasabah'] = $_POST['id-sr-'][$c];														
					$this->db->insert("trx_kas_det", $data5);
				}
			
			}
			
		}

		function updatebkk()
		{
		  //echo "<pre>";print_r($_POST);"</pre>"; exit();
		  $idso = $this->input->post("id_jurnal");
		  $data6['tgl'] = date("Y-m-d", strtotime($this->input->post("tanggal")));
	      $data6['uraian'] = $this->input->post("kasbank");
	      $data6['memo'] = $this->input->post("catatan");
	      $data6['akun'] = $this->input->post("bank_code");
	      $data6['nobukti'] = $this->input->post("nomor");       
	      $data6['id_kategori'] = 1;
	      $data6['id_lpb_liquid'] = 0;
	      //$data6['provider_id'] = $cus;
	      //$data6['dateentry'] = date("Y-m-d");
	      $data6['userentry'] = $_SESSION['IDUser'];
	      $data6['jenis'] = 'uk';
	      $data6['nominal'] = '-'.strToCurrDB($this->input->post("total"));
	      $this->db->where('id_jurnal',$idso);
	      $this->db->update("trx_jurnal", $data6);

	      $c_kontak = count($this->input->post("kode"));
	      for($i=0; $i<$c_kontak;$i++)
			{
	      //$data7['id_induk'] = $idkas;
	          $data7['tgl'] = date("Y-m-d", strtotime($this->input->post("tanggal")));
	          $data7['uraian'] = $_POST['uraian'][$i];
	          $data7['memo'] = $_POST['memo'][$i];
	          $data7['akun'] = $_POST['kode'][$i];
	          $data7['nobukti'] = $this->input->post("nomor");
	          $data7['id_lpb_liquid'] = 0;
	          //$data7['provider_id'] = $cus;
	          //$data7['dateentry'] = date("Y-m-d");
	          $cek_kode = $_POST['kode'][$i];
	          $baru = substr($cek_kode, 0, 1);
	          if ($baru == 5 || $baru == 6 || $baru == 9) {
	          	$data7['jenis'] = 'uk';
	          	$data7['nominal'] = '-'.strToCurrDB($_POST['nominal'][$i]);
	          	$data7['id_kategori'] = 2;
	          }else if ($baru == 3 || $baru == 2) {
	          	$data7['jenis'] = 'uk';
	          	$data7['nominal'] = '-'.strToCurrDB($_POST['nominal'][$i]);
	          	$data7['id_kategori'] = 1;
	          }else{
	          	$data7['jenis'] = 'um';
	          	$data7['nominal'] = strToCurrDB($_POST['nominal'][$i]);
	          	$data7['id_kategori'] = 1;
	          }	
	          $data7['userentry'] = $_SESSION['IDUser'];
	          $this->db->where('id_jurnal',$_POST['jurnal_id'][$i]);
	          $this->db->update("trx_jurnal", $data7);
	          }
			$messageData =1;
			echo $messageData;

		}

		function savebkk()
		{
			//echo "<pre>";print_r($_POST);"</pre>"; exit();
			//$this->form_validation->set_rules('rekanan', 'Dibayar ke', 'trim|required|xss_clean');
    		$this->form_validation->set_rules('catatan', 'Catatan', 'trim|required|xss_clean');

    		
    		
			if ( ! $this->form_validation->run() )
			{				
				$errorMessage = form_error('rekanan').form_error('catatan');
				$messageData = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{
				//echo "<pre>";print_r($_POST);"</pre>";exit();
				  $cus = $this->input->post("id_rekanan");
		          $profit = $this->db->query("SELECT * from mst_provider where provider_id = '".$cus."'");
		          $ttl = strToCurrDB($this->input->post("total"));		          

		          $cek1 = $this->db->query("SELECT * from trx_jurnal order by id_jurnal DESC");       
		          $jml1 = $cek1->row()->id_jurnal;
		          $jml_det1=0;
		          if ($jml1 == 0) {
		            $data6['nomor']= 'JU-0001';
		          } else if($jml1 < 10){
		            $jml_det1 = $jml1+1;
		            $data6['nomor']= 'JU-000'.$jml_det1;
		          } else if($jml1 < 100){
		            $jml_det1 = $jml1+1;
		            $data6['nomor']= 'JU-00'.$jml_det1;
		          } else if($jml1 < 1000){
		            $jml_det1 = $jml1+1;
		            $data6['nomor']= 'JU-0'.$jml_det1;
		          } else {
		            $jml_det1 = $jml1+1;
		            $data6['nomor']= 'JU-'.$jml_det1;
		          }
		          $data6['tgl'] = date("Y-m-d", strtotime($this->input->post("tanggal")));
		          $data6['uraian'] = $this->input->post("kasbank");
		          $data6['memo'] = $this->input->post("catatan");
		          $data6['akun'] = $this->input->post("bank_code");
		          $data6['nobukti'] = $this->input->post("nomor");       
		          $data6['id_kategori'] = 1;
		          $data6['id_lpb_liquid'] = 0;
		          $data6['provider_id'] = $cus;
		          $data6['dateentry'] = date("Y-m-d");
		          $data6['userentry'] = $_SESSION['IDUser'];
		          $data6['jenis'] = 'uk';
		          $data6['nominal'] = '-'.$ttl;
		          $this->db->insert("trx_jurnal", $data6);
				
				$idkas = $this->db->insert_id();
				
				// INSERT TO trx_reg_nasabah //
				
				$c_kontak = count($this->input->post("kode"));
				
				for($i=0; $i<$c_kontak;$i++)
				{	
				  $jml2 = $jml1+1;
		          $jml_det2=0;
		          if ($jml2 == 0) {
		            $data7['nomor']= 'JU-0001';
		          } else if($jml2 < 10){
		            $jml_det2 = $jml2+1;
		            $data7['nomor']= 'JU-000'.$jml_det2;
		          } else if($jml2 < 100){
		            $jml_det2 = $jml2+1;
		            $data7['nomor']= 'JU-00'.$jml_det2;
		          } else if($jml2 < 1000){
		            $jml_det2 = $jml2+1;
		            $data7['nomor']= 'JU-0'.$jml_det2;
		          } else {
		            $jml_det2 = $jml2+1;
		            $data7['nomor']= 'JU-'.$jml_det2;
		          }
		          $data7['id_induk'] = $idkas;
		          $data7['tgl'] = date("Y-m-d", strtotime($this->input->post("tanggal")));
		          $data7['uraian'] = $_POST['uraian'][$i];
		          $data7['memo'] = $_POST['memo'][$i];
		          $data7['akun'] = $_POST['kode'][$i];
		          $data7['nobukti'] = $this->input->post("nomor");
		          $data7['pembayaran'] = $this->input->post("pembayaran");
		          $data7['id_lpb_liquid'] = 0;
		          $data7['provider_id'] = $cus;
		          $data7['dateentry'] = date("Y-m-d");
		          $cek_kode = $_POST['kode'][$i];
		          $baru = substr($cek_kode, 0, 1);
		          if ($baru == 5 || $baru == 6 || $baru == 9) {
		          	$data7['jenis'] = 'uk';
		          	$data7['nominal'] = '-'.strToCurrDB($_POST['nominal'][$i]);
		          	$data7['id_kategori'] = 2;
		          }else if ($baru == 3 || $baru == 2) {
		          	$data7['jenis'] = 'uk';
		          	$data7['nominal'] = '-'.strToCurrDB($_POST['nominal'][$i]);
		          	$data7['id_kategori'] = 1;
		          }else{
		          	$data7['jenis'] = 'um';
		          	$data7['nominal'] = strToCurrDB($_POST['nominal'][$i]);
		          	$data7['id_kategori'] = 1;
		          }	
		          $data7['userentry'] = $_SESSION['IDUser'];
		          $this->db->insert("trx_jurnal", $data7);
					
				}
				$messageData =1;
				echo $messageData;	            
			
        	}
        			
			
		}

		function updatebkm()
		{
		  //echo "<pre>";print_r($_POST);"</pre>"; exit();
		  $idso = $this->input->post("id_jurnal");
		  $data6['tgl'] = date("Y-m-d", strtotime($this->input->post("tanggal")));
	      $data6['uraian'] = $this->input->post("kasbank");
	      $data6['memo'] = $this->input->post("catatan");
	      $data6['akun'] = $this->input->post("bank_code");
	      $data6['nobukti'] = $this->input->post("nomor");       
	      $data6['id_kategori'] = 1;
	      $data6['id_lpb_liquid'] = 0;
	      //$data6['provider_id'] = $cus;
	      //$data6['dateentry'] = date("Y-m-d");
	      $data6['userentry'] = $_SESSION['IDUser'];
	      $data6['jenis'] = 'um';
		  $data6['nominal'] = strToCurrDB($this->input->post("total"));
	      $this->db->where('id_jurnal',$idso);
	      $this->db->update("trx_jurnal", $data6);

	      $c_kontak = count($this->input->post("kode"));
	      for($i=0; $i<$c_kontak;$i++)
			{
	      //$data7['id_induk'] = $idkas;
	          $data7['tgl'] = date("Y-m-d", strtotime($this->input->post("tanggal")));
	          $data7['uraian'] = $_POST['uraian'][$i];
	          $data7['memo'] = $_POST['memo'][$i];
	          $data7['akun'] = $_POST['kode'][$i];
	          $data7['nobukti'] = $this->input->post("nomor");
	          $data7['id_lpb_liquid'] = 0;
	          //$data7['provider_id'] = $cus;
	          //$data7['dateentry'] = date("Y-m-d");
	          $cek_kode = $_POST['kode'][$i];
	          $baru = substr($cek_kode, 0, 1);
	          if ($baru == 4 || $baru == 8) {
	          	$data7['jenis'] = 'um';
	          	$data7['nominal'] = strToCurrDB($_POST['nominal'][$i]);
	          	$data7['id_kategori'] = 3;
	          }else if ($baru == 3 || $baru == 2) {
	          	$data7['jenis'] = 'um';
	          	$data7['nominal'] = strToCurrDB($_POST['nominal'][$i]);
	          	$data7['id_kategori'] = 1;
	          }else{
	          	$data7['jenis'] = 'uk';
	          	$data7['nominal'] = '-'.strToCurrDB($_POST['nominal'][$i]);
	          	$data7['id_kategori'] = 1;
	          }
	          $data7['userentry'] = $_SESSION['IDUser'];
	          $this->db->where('id_jurnal',$_POST['jurnal_id'][$i]);
	          $this->db->update("trx_jurnal", $data7);
	          }
			$messageData =1;
			echo $messageData;

		}

		function savebkm()
		{
			//echo "<pre>";print_r($_POST);"</pre>"; exit();
			$this->form_validation->set_rules('rekanan', 'Dibayar ke', 'trim|required|xss_clean');
    		$this->form_validation->set_rules('catatan', 'Catatan', 'trim|required|xss_clean');

    		
    		
			if ( ! $this->form_validation->run() )
			{				
				$errorMessage = form_error('rekanan').form_error('catatan');
				$messageData = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{
				//echo "<pre>";print_r($_POST);"</pre>";exit();
				$cus = $this->input->post("id_rekanan");
		          $profit = $this->db->query("SELECT * from mst_provider where provider_id = '".$cus."'");
		          $ttl = strToCurrDB($this->input->post("total"));		          

		          $cek1 = $this->db->query("SELECT * from trx_jurnal order by id_jurnal DESC");       
		          $jml1 = $cek1->row()->id_jurnal;
		          $jml_det1=0;
		          if ($jml1 == 0) {
		            $data6['nomor']= 'JU-0001';
		          } else if($jml1 < 10){
		            $jml_det1 = $jml1+1;
		            $data6['nomor']= 'JU-000'.$jml_det1;
		          } else if($jml1 < 100){
		            $jml_det1 = $jml1+1;
		            $data6['nomor']= 'JU-00'.$jml_det1;
		          } else if($jml1 < 1000){
		            $jml_det1 = $jml1+1;
		            $data6['nomor']= 'JU-0'.$jml_det1;
		          } else {
		            $jml_det1 = $jml1+1;
		            $data6['nomor']= 'JU-'.$jml_det1;
		          }
		          $data6['tgl'] = date("Y-m-d", strtotime($this->input->post("tanggal")));
		          $data6['uraian'] = $this->input->post("kasbank");
		          $data6['memo'] = $this->input->post("catatan");
		          $data6['akun'] = $this->input->post("bank_code");
		          $data6['nobukti'] = $this->input->post("nomor");       
		          $data6['id_kategori'] = 1;
		          $data6['id_lpb_liquid'] = 0;
		          $data6['provider_id'] = $cus;
		          $data6['dateentry'] = date("Y-m-d");
		          $data6['userentry'] = $_SESSION['IDUser'];
		          $data6['jenis'] = 'um';
		          $data6['nominal'] = $ttl;
		          $this->db->insert("trx_jurnal", $data6);
				
				$idkas = $this->db->insert_id();
				
				// INSERT TO trx_reg_nasabah //
				
				$c_kontak = count($this->input->post("kode"));
				
				for($i=0; $i<$c_kontak;$i++)
				{	
				  $jml2 = $jml1+1;
		          $jml_det2=0;
		          if ($jml2 == 0) {
		            $data7['nomor']= 'JU-0001';
		          } else if($jml2 < 10){
		            $jml_det2 = $jml2+1;
		            $data7['nomor']= 'JU-000'.$jml_det2;
		          } else if($jml2 < 100){
		            $jml_det2 = $jml2+1;
		            $data7['nomor']= 'JU-00'.$jml_det2;
		          } else if($jml2 < 1000){
		            $jml_det2 = $jml2+1;
		            $data7['nomor']= 'JU-0'.$jml_det2;
		          } else {
		            $jml_det2 = $jml2+1;
		            $data7['nomor']= 'JU-'.$jml_det2;
		          }
		          $data7['id_induk'] = $idkas;
		          $data7['tgl'] = date("Y-m-d");
		          $data7['uraian'] = $_POST['uraian'][$i];
		          $data7['memo'] = $_POST['memo'][$i];
		          $data7['akun'] = $_POST['kode'][$i];
		          $data7['nobukti'] = $this->input->post("nomor");       
		          //$data7['id_kategori'] = 3;
		          $data7['id_lpb_liquid'] = 0;
		          $data7['provider_id'] = $cus;
		          $data7['dateentry'] = date("Y-m-d");
		          $data7['userentry'] = $_SESSION['IDUser'];
		          $cek_kode = $_POST['kode'][$i];
		          $baru = substr($cek_kode, 0, 1);
		          if ($baru == 4 || $baru == 8) {
		          	$data7['jenis'] = 'um';
		          	$data7['nominal'] = strToCurrDB($_POST['nominal'][$i]);
		          	$data7['id_kategori'] = 3;
		          }else if ($baru == 3 || $baru == 2) {
		          	$data7['jenis'] = 'um';
		          	$data7['nominal'] = strToCurrDB($_POST['nominal'][$i]);
		          	$data7['id_kategori'] = 1;
		          }else{
		          	$data7['jenis'] = 'uk';
		          	$data7['nominal'] = '-'.strToCurrDB($_POST['nominal'][$i]);
		          	$data7['id_kategori'] = 1;
		          }
		          $this->db->insert("trx_jurnal", $data7);
				}
				$messageData =1;
				echo $messageData;	            
			
        	}
			
			
		}

		public function changekontak()
		{

			//echo "<pre>";print_r($_POST);"</pre>";exit();
            $kode = $this->input->post("kode");            
            $param = $this->db->query("SELECT * from mst_nasabah inner join mst_kontak on mst_nasabah.id_kontak = mst_kontak.id
                                              where id_ksm = '".$kode."'
                                			  order by kode_nasabah asc");
    		if ($param->num_rows()>0) {
    			$i=0;
           	foreach($param->result() as $row)
			{
				$i++;
				$data['NO'] = $i;
				$data['ID'] = $row->id_nasabah;
				$data['Kode'] = $row->kode_nasabah;
				$data['Nama'] = $row->nama;				
				//$data['Jumlah'] = $row->Jumlah;		
				
				$json['nasabah'][] = $data;
				
			}
			$json['status'] = true;
			}else{
				$json['status'] = false;
			}
			//$json['status'] = true;
			
			$dataJson = json_encode($json);
			
			echo $dataJson;

		}

		public function changekontak2()
		{

			//echo "<pre>";print_r($_POST);"</pre>";exit();
            $kode = $this->input->post("kode");            
            $param = $this->db->query("SELECT * from mst_nasabah inner join mst_kontak on mst_nasabah.id_kontak = mst_kontak.id
                                              where id_nasabah = '".$kode."'
                                			  order by kode_nasabah asc")->row();
    		
				
				$data['ID'] = $param->id_nasabah;
				$data['Kode'] = $param->kode_nasabah;
				$data['Nama'] = $param->nama;				
				//$data['Jumlah'] = $row->Jumlah;		
				
				$json = $data;		
			
			
			$dataJson = json_encode($json);
			
			echo $dataJson;

		}

		public function GetDaftarPinjaman()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            
            $this->load->model("transaksi_model", "ModelTransaksi");
            
            echo $this->ModelTransaksi->GetDaftarPinjaman(); 
		}

		public function GetDaftarSimpanan()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            
            $this->load->model("transaksi_model", "ModelTransaksi");
            
            echo $this->ModelTransaksi->GetDaftarSimpanan(); 
		}

		public function GetDaftarAngsuran()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            
            $this->load->model("transaksi_model", "ModelTransaksi");
            
            echo $this->ModelTransaksi->GetDaftarAngsuran(); 
		}

		public function savepinjaman()
		{

			

           	$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

            $this->form_validation->set_rules('namaksm', 'Nama KSM', 'trim|required|xss_clean');
    		$this->form_validation->set_rules('lama', 'Lama', 'trim|required|xss_clean');

    		
    		
			if ( ! $this->form_validation->run() )
			{				
				$errorMessage = form_error('namaksm').form_error('lama');
				$messageData = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{
				//echo "<pre>";print_r($_POST);"</pre>";exit();
				$data['kode_pinjaman'] = $this->input->post("nomor");
				$data['id_ksm'] = $this->input->post("idksm");
				$data['bunga'] = $this->input->post("bunga");
				$data['lama'] = $this->input->post("lama");
				$data['tanggal'] = date("Y-m-d", strtotime($this->input->post("tglreg")));			
				
				$this->db->insert("trx_pinjaman", $data);
				
				$idpinjam = $this->db->insert_id();
				
				// INSERT TO trx_reg_nasabah //
				
				$c_nasabah = count($this->input->post("idnasabah"));
				
				for($i=0; $i<$c_nasabah;$i++)
				{				
					$data2['id_pinjaman'] = $idpinjam;
					$data2['id_nasabah'] = $_POST['idnasabah'][$i];
					$data2['nominal'] = $_POST['nominal'][$i];
					$data2['angsuran'] = $_POST['angsuran'][$i];														
					$this->db->insert("trx_pinjaman_det", $data2);
				}

				$data1['nomor_kas'] = $this->input->post("nomor_bkk");
				$data1['id_ksm'] = $this->input->post("id_ksm");
				$data1['tgl_kas'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
				$data1['uraian'] = "Pinjaman KSM ".$this->input->post("namaksm");
				$data1['id_kasbank'] = $this->input->post("id_kasbank");
				$data1['id_kategori'] = 1;
				$data1['acc'] = 0;
				$data1['jenis'] = 'uk';
				$data1['dateentry'] = date("Y-m-d");
				$data1['userentry'] = $_SESSION['IDUser'];
				
				$this->db->insert("trx_kas", $data1);
				
				$idkas = $this->db->insert_id();  

				$c_pinjam = count($this->input->post("idnasabah"));
			
				for($a=0; $a<$c_pinjam;$a++)
				{				
					$data3['id_kas'] = $idkas;
					$data3['kode'] = '1.1.3';
					$data3['uraian'] = 'Pinjaman KSM';
					$data3['memo'] = "Pinjaman ".$_POST['namanasabah'][$a];
					$data3['nominal'] = strToCurrDB($_POST['nominal'][$a]);
					$data3['id_nasabah'] = $_POST['idnasabah'][$a];														
					$this->db->insert("trx_kas_det", $data3);
				}          
			
        	}
		}
		
		

	}

/* End of file anggaran.php */

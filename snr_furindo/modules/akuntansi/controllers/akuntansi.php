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
	        //$content  = $this->load->view('akuntansi_view', '', true);
	        $content  = $this->load->view('dashboard_view', '', true);
	        $arrData = array('menu' 	=> $menu,
	        			   	 'content'  => $content);

	        echo json_encode($arrData);

		}

		public function Bukubantu()
		{
			$content = $this->load->view('buku_bantu_view', '', true);                          

            echo $content;
		}

		public function AjustmentAkun()
		{
			$data['jurnal'] = $this->db->query("SELECT * from ajs_jurnal");
			$content = $this->load->view('admin_ajust_akun', $data, true);                          

            echo $content;
		}

		public function AddAjustmentAkun()
		{
			$data['akun'] = $this->db->query("SELECT t1.akun,t1.uraian,sum(t1.nominal) as amount from trx_jurnal t1 where t1.akun !='' group by t1.akun");
			$content = $this->load->view('ajust_akun', $data, true);                          

            echo $content;
		}

		public function EditAjustmentAkun()
		{
			$id = $_POST['ids'];
			$data['ajs'] = $this->db->query("SELECT * from ajs_jurnal where id =".$id."")->row();
			$data['akun'] = $this->db->query("SELECT t1.akun,t1.uraian,sum(t1.nominal) as amount from trx_jurnal t1 where t1.akun !='' group by t1.akun");
			$content = $this->load->view('edit_ajust_akun', $data, true);                          

            echo $content;
		}

		public function SaveAjsAkun(){
			//echo "<pre>";print_r($_SESSION);"</pre>";exit();
			$data = $_POST['ajs'];
			$data['tgl']=date("Y-m-d", strtotime($data['tgl']));
			$data['user_created']=userName($_SESSION['IDUser']);
			
			if(isset($_POST['ajs']['id'])){
				$this->db->where("id",$_POST['ajs']['id']);
				$this->db->update("ajs_jurnal", $data);
				$idso = $_POST['ajs']['id'];
				$c_save = count($this->input->post("akun"));
				for($i=0; $i<$c_save;$i++){
					$akun = $_POST['akun'][$i];
					$beban = $this->db->query("SELECT * from mst_pengeluaran where kode_pengeluaran ='".$akun."'")->row();
		            	$minus=1;
		            	if(isset($beban->level)){
		            		$minus=-1;
		            	}
					$data1['id_ajs_jurnal']=$idso;
					$data1['tgl']=$data['tgl'];
					$data1['akun']=$_POST['akun'][$i];
					$data1['uraian']=$_POST['uraian'][$i];
					$data1['nominal']=strToCurrDB($_POST['nominal'][$i])*$minus;
					$data1['keterangan']=$_POST['keterangan'][$i];
					$this->db->where("id",$_POST['id'][$i]);
					$this->db->update("ajs_jurnal_detail", $data1);
	        	}
			}else{
				$this->db->insert("ajs_jurnal", $data);
				$idso = $this->db->insert_id();
				$c_save = count($this->input->post("akun"));
				for($i=0; $i<$c_save;$i++){
					$akun = $_POST['akun'][$i];
					$beban = $this->db->query("SELECT * from mst_pengeluaran where kode_pengeluaran ='".$akun."'")->row();
		            	$minus=1;
		            	if(isset($beban->level)){
		            		$minus=-1;
		            	}
					$data1['id_ajs_jurnal']=$idso;
					$data1['tgl']=$data['tgl'];
					$data1['akun']=$_POST['akun'][$i];
					$data1['uraian']=$_POST['uraian'][$i];
					$data1['nominal']=strToCurrDB($_POST['nominal'][$i])*$minus;
					$data1['keterangan']=$_POST['keterangan'][$i];
					$this->db->insert("ajs_jurnal_detail", $data1);
	        	}
			}
			
		}

		public function Balance_LPB()
		{
			$content = $this->load->view('balance_lpb', '', true);                          

            echo $content;
		}

		public function Balance_LPB_Raw()
		{
			$content = $this->load->view('balance_lpb_raw', '', true);                          

            echo $content;
		}

		public function BayarHutang()

		{
			$idx = $this->input->post("idx");
			$data['lpb'] = $this->db->query("SELECT trx_lpb.*, nominal, mst_provider.* from trx_lpb inner join mst_provider on mst_provider.provider_id = trx_lpb.provider_id 
				left join trx_jurnal on trx_lpb.lpb_id = trx_jurnal.id_lpb where akun = '22001' AND trx_lpb.lpb_id = '".$idx."'")->row();
			$cari = $this->db->query("SELECT nobukti from trx_jurnal where nobukti like '%BKK%' order by nobukti DESC");

			if ($cari->num_rows()==0) {
				$data['bkk'] = 'BKK-0000';
			}else{
				$data['bkk'] = $cari->row()->nobukti;
			}

            $content = $this->load->view('input_bayar_hutang', $data, true);
              
            echo $content;

		}

		public function BayarHutangSM()

		{
			$idx = $this->input->post("idx");
			$data['lpb'] = $this->db->query("SELECT trx_lpb_liquid.*, nominal, mst_provider.* from trx_lpb_liquid inner join mst_provider on mst_provider.provider_id = trx_lpb_liquid.provider_id 
				left join trx_jurnal on trx_lpb_liquid.lpb_liquid_id = trx_jurnal.id_lpb_liquid where akun = '22001' AND trx_lpb_liquid.lpb_liquid_id = '".$idx."'")->row();
			$cari = $this->db->query("SELECT nobukti from trx_jurnal where nobukti like '%BKK%' order by nobukti DESC");

			if ($cari->num_rows()==0) {
				$data['bkk'] = 'BKK-0000';
			}else{
				$data['bkk'] = $cari->row()->nobukti;
			}

            $content = $this->load->view('input_bayar_hutangSM', $data, true);
              
            echo $content;

		}
		public function BayarHutangJasa()

		{
			$idx = $this->input->post("idx");
			$data['lpb'] = $this->db->query("SELECT trx_lpb_jasa.*, nominal, mst_provider.* from trx_lpb_jasa inner join mst_provider on mst_provider.provider_id = trx_lpb_jasa.provider_id 
				left join trx_jurnal on trx_lpb_jasa.lpb_id = trx_jurnal.id_lpb_jasa where akun = '22001' AND trx_lpb_jasa.lpb_id = '".$idx."'")->row();
			$cari = $this->db->query("SELECT nobukti from trx_jurnal where nobukti like '%BKK%' order by nobukti DESC");

			if ($cari->num_rows()==0) {
				$data['bkk'] = 'BKK-0000';
			}else{
				$data['bkk'] = $cari->row()->nobukti;
			}

            $content = $this->load->view('input_bayar_hutangJasa', $data, true);
              
            echo $content;

		}

		public function DepositPembayaran()

		{
			$idx = $this->input->post("IDBidang");
			$data['lpb'] = $this->db->query("SELECT * from mst_provider where provider_id= '".$idx."'")->row();
			$cari = $this->db->query("SELECT nobukti from trx_jurnal where nobukti like '%BKK%' order by nobukti DESC");

			if ($cari->num_rows()==0) {
				$data['bkk'] = 'BKK-0000';
			}else{
				$data['bkk'] = $cari->row()->nobukti;
			}

            $content = $this->load->view('input_deposit', $data, true);
              
            echo $content;

		}

		function DetailPembayaran(){
	        $idx['so_id'] = $this->input->post("IDBidang");
	        $this->load->view('detail_pembayaran', $idx); 
	    }

	    function DetailPembayaranSM(){
	        $idx['so_id'] = $this->input->post("IDBidang");
	        $this->load->view('detail_pembayaranSM', $idx); 
	    }
	    function DetailPembayaranJasa(){
	        $idx['so_id'] = $this->input->post("IDBidang");
	        $this->load->view('detail_pembayaranjasa', $idx); 
	    }


		function GetDetailPembayaran(){
      	//echo "<pre>";print_r($_POST);"</pre>";exit();
        $idx = $this->input->post("idx");
        
        $arrContent = $this->db->query("SELECT trx_lpb.*, nominal, mst_provider.* from trx_lpb inner join mst_provider on mst_provider.provider_id = trx_lpb.provider_id 
			left join trx_jurnal on trx_lpb.lpb_id = trx_jurnal.id_lpb where akun = '22001' AND trx_lpb.provider_id = '".$idx."'");           
      
            $i=1; 
            $strContent = '';

            foreach($arrContent->result() as $row){               
                $nominal = $this->db->query("SELECT sum(nominal) as nominal from trx_jurnal where akun = '22001' AND (pembayaran = '".$row->lpb_code."' OR nobukti = '".$row->lpb_code."')")->row();
                $code = "'".$row->provider_code."'";
                $nama = "'".str_replace(" ","_",$row->provider_name)."'";
                if($nominal->nominal != 0){
                $strContent.='<tr class="record">   
                            <td>'.$i.'</td>      
                            		  <td>'.$row->lpb_date.'</td>                                                                   
                                      <td>'.$row->lpb_code.'</td>                                      
                                      <td>'.$row->provider_name.'</td>
                                      <td>'.$row->provider_address.'</td> 
                                      <td>'.rp($nominal->nominal).'</td>
                                      <td>
                                        <button type="button" class="btn btn-xs btn-success" onclick="bayar('.$row->lpb_id.')"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span> Bayar</button>
                                      </td>
                                </tr>';
              $i++; 
              }                     
            }     
            echo $strContent;
        }

        function GetDetailPembayaran1(){
      	//echo "<pre>";print_r($_POST);"</pre>";exit();
        $idx = $this->input->post("idx");
        
        $arrContent = $this->db->query("SELECT * from trx_lpb_umum left join trx_jurnal on trx_jurnal.id_lpb_umum = trx_lpb_umum.lpb_id
			where akun = '22001'");           
      
            $i=1; 
            $strContent = '';

            foreach($arrContent->result() as $row){               
                $nominal = $this->db->query("SELECT sum(nominal) as nominal from trx_jurnal where akun = '22001' AND (pembayaran = '".$row->lpb_code."' OR nobukti = '".$row->lpb_code."')")->row();
                if($nominal->nominal != 0){
                $strContent.='<tr class="record">   
                            <td>'.$i.'</td>      
                            		  <td>'.$row->lpb_date.'</td>                                                                   
                                      <td>'.$row->lpb_code.'</td>                                      
                                      <td> Dan Lain-lain </td>
                                      <td> SNR </td> 
                                      <td>'.rp($nominal->nominal).'</td>
                                      <td>
                                        <button type="button" class="btn btn-xs btn-success" onclick="bayar('.$row->lpb_id.')"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span> Bayar</button>
                                      </td>
                                </tr>';
              $i++; 
              }                     
            }     
            echo $strContent;
        }

        function GetDetailPembayaranSM(){
      	//echo "<pre>";print_r($_POST);"</pre>";exit();
        $idx = $this->input->post("idx");
        
        $arrContent = $this->db->query("SELECT trx_lpb_liquid.*, nominal, mst_provider.* from trx_lpb_liquid inner join mst_provider on mst_provider.provider_id = trx_lpb_liquid.provider_id 
			left join trx_jurnal on trx_lpb_liquid.lpb_liquid_id = trx_jurnal.id_lpb_liquid where akun = '22001' AND trx_lpb_liquid.provider_id = '".$idx."'");           
      
            $i=1; 
            $strContent = '';

            foreach($arrContent->result() as $row){               
                $nominal = $this->db->query("SELECT sum(nominal) as nominal from trx_jurnal where akun = '22001' AND (pembayaran = '".$row->lpb_liquid_code."' OR nobukti = '".$row->lpb_liquid_code."')")->row();
                $code = "'".$row->provider_code."'";
                $nama = "'".str_replace(" ","_",$row->provider_name)."'";
                if($nominal->nominal != 0){
                $strContent.='<tr class="record">   
                            <td>'.$i.'</td>      
                            		  <td>'.$row->lpb_liquid_date.'</td>                                                                   
                                      <td>'.$row->lpb_liquid_code.'</td>                                      
                                      <td>'.$row->provider_name.'</td>
                                      <td>'.$row->provider_address.'</td> 
                                      <td>'.rp($nominal->nominal).'</td>
                                      <td>
                                        <button type="button" class="btn btn-xs btn-success" onclick="bayar('.$row->lpb_liquid_id.')"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span> Bayar</button>
                                      </td>
                                </tr>';
              $i++; 
              }                     
            }     
            echo $strContent;
        }
         function GetDetailPembayaranJasa(){
      	//echo "<pre>";print_r($_POST);"</pre>";exit();
        $idx = $this->input->post("idx");
        
        $arrContent = $this->db->query("SELECT trx_lpb_jasa.*, nominal, mst_provider.*  from trx_lpb_jasa inner join mst_provider on mst_provider.provider_id = trx_lpb_jasa.provider_id 
			left join trx_jurnal on trx_lpb_jasa.lpb_id = trx_jurnal.id_lpb_jasa  where akun = '22001' AND trx_lpb_jasa.provider_id = '".$idx."'");           
      
            $i=1; 
            $strContent = '';

            foreach($arrContent->result() as $row){               
                $nominal = $this->db->query("SELECT sum(nominal) as nominal from trx_jurnal where akun = '22001' AND (pembayaran = '".$row->lpb_code."' OR nobukti = '".$row->lpb_code."')")->row();
                $code = "'".$row->provider_code."'";
                $nama = "'".str_replace(" ","_",$row->provider_name)."'";
                if($nominal->nominal != 0){
                $strContent.='<tr class="record">   
                            <td>'.$i.'</td>      
                            		  <td>'.$row->lpb_date.'</td>                                                                   
                                      <td>'.$row->lpb_nota.'</td>                                      
                                      <td>'.$row->provider_name.'</td>
                                      <td>'.$row->provider_address.'</td> 
                                      <td>'.rp($nominal->nominal).'</td>
                                      <td>
                                        <button type="button" class="btn btn-xs btn-success" onclick="bayar('.$row->lpb_id.')"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span> Bayar</button>
                                      </td>
                                </tr>';
              $i++; 
              }                     
            }     
            echo $strContent;
        }

		public function Hutang()

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

            $content = $this->load->view('hutang_usaha', $data, true);

            echo $content;

		}

		public function Piutang()

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

            $content = $this->load->view('piutang_usaha', $data, true);

                          

            echo $content;

		}

		function GetDataBukuBantu()
		{					
			
			
			$awal = date("Y-m-d",strtotime($this->input->post("awal")));
			$akhir = date("Y-m-d",strtotime($this->input->post("akhir")));
			$kas = $this->input->post("kas");
			$newdate = date("Y-m-d", strtotime('-1 days',strtotime($awal)));
			//echo "<pre>";print_r($awal);"</pre>";exit();	
			$saldoAwal = $this->db->query("SELECT * from ajs_jurnal_detail where DATE(tgl) < '".$newdate."' and akun='".$kas."' order by tgl DESC")->row();
			$enddate = isset($saldoAwal->id)?$saldoAwal->tgl:'2014-01-01';
			$param = $this->db->query("SELECT trx_jurnal.* from trx_jurnal where tgl between '".$awal."' and '".$akhir."'and(akun ='".$kas."'and id_kategori !=0) order by id_jurnal");
			$num = $this->db->query("SELECT sum(nominal) as nominal from trx_jurnal where tgl between '".$enddate."' and '".$newdate."'and(akun ='".$kas."')")->row();
			
			//echo "<pre>";print_r($awal->num_rows());"</pre>";exit();
			if ($param->num_rows()>=0) {
    			$i=0;
    			$saldo=isset($saldoAwal->nominal)?$num->nominal+$saldoAwal->nominal:$num->nominal;
    			$data1['tgl'] = date("d-m-Y",strtotime($awal));
				$data1['ket'] = 'Saldo Awal';
				$data1['nomor'] = '';
				$data1['debet'] = '';
				$data1['kredit'] = '';				
				$data1['saldo'] = rp($saldo);
				$json['bantu'][] = $data1;
				$ttl_debet = 0;
				$ttl_kredit = 0;
           	foreach($param->result() as $row)
			{
				$i++;
				$baru = substr($row->akun, 0, 1);
				if($row->jenis == 'um' && ($baru == 5 || $baru == 6 || $baru == 9 || $baru == 3 || $baru == 2)){
					$data['tgl'] = date("d-m-Y",strtotime($row->tgl));
					$data['ket'] = $row->memo;
					$data['nomor'] = $row->nobukti;
					$data['debet'] = rp(0);
					$data['kredit'] = rp($row->nominal);
					$saldo += $row->nominal*-1;
					$ttl_kredit+=$row->nominal*-1;
					$data['saldo'] = 'Rp '.number_format($saldo).'.00';
				 }else if($row->jenis == 'uk' && ($baru == 5 || $baru == 6 || $baru == 9 || $baru == 3 || $baru == 2)){
					$data['tgl'] = date("d-m-Y",strtotime($row->tgl));
					$data['ket'] = $row->memo;
					$data['nomor'] = $row->nobukti;
					$data['debet'] = rp($row->nominal*-1);
					$data['kredit'] = rp(0);
					$saldo += $row->nominal*-1;
					$data['saldo'] = 'Rp '.number_format($saldo).'.00';
					$ttl_debet+=$row->nominal;
				 }else if($row->jenis == 'um' && ($row->akun == '41001')){
					$data['tgl'] = date("d-m-Y",strtotime($row->tgl));
					$data['ket'] = $row->memo;
					$data['nomor'] = $row->nobukti;
					$data['debet'] = rp(0);
					$data['kredit'] = rp($row->nominal);
					$ttl_kredit+=$row->nominal*-1;
					$saldo += $row->nominal;
					$data['saldo'] = 'Rp '.number_format($saldo).'.00';
				 } else if ($row->jenis == 'um') {
					$data['tgl'] = date("d-m-Y",strtotime($row->tgl));
					$data['ket'] = $row->memo;
					$data['nomor'] = $row->nobukti;
					$data['debet'] = rp($row->nominal);
					$data['kredit'] = rp(0);
					$saldo += $row->nominal;
					$ttl_debet+=$row->nominal;
					$data['saldo'] = 'Rp '.number_format($saldo).'.00';
				} else {
					$data['tgl'] = date("d-m-Y",strtotime($row->tgl));
					$data['ket'] = $row->memo;
					$data['nomor'] = $row->nobukti;
					$data['debet'] = rp(0);
					$data['kredit'] = rp($row->nominal*-1);		
					$saldo += $row->nominal;
					$ttl_kredit+=$row->nominal*-1;
					$data['saldo'] = 'Rp '.number_format($saldo).'.00';
				}
				
								
				//$data['Jumlah'] = $row->Jumlah;
				$json['bantu'][] = $data;
				
			}
				$data2['tgl'] = '<b>'.date("d-m-Y",strtotime($akhir)).'</b>';
				$data2['ket'] = '<b>Saldo Akhir</b>';
				$data2['nomor'] = '';
				$data2['debet'] = rp($ttl_debet);
				$data2['kredit'] = rp($ttl_kredit);				
				$data2['saldo'] = '<b>Rp '.number_format($saldo).'.00</b>';
				$json['bantu'][] = $data2;
				$json['status'] = true;
			}else{
				$json['status'] = true;
			}
						
			$dataJson = json_encode($json);
			
			echo $dataJson;
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
				$cek = $this->db->query("SELECT id_induk from mst_kasbank where kode_kasbank = '".$_POST['kode'][$i]."'")->row();			
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
				if($num=='' && $cek->id_induk ==1){
				$data2['jenis'] = 'um';
				$data2['nominal'] = strToCurrDB($_POST['nominal'][$i]);
				}else if($num=='' && $cek->id_induk !=1){
				$data2['jenis'] = 'uk';
				$data2['nominal'] = '-'.strToCurrDB($_POST['nominal'][$i]);
				}else if($num!='' && $cek->id_induk ==1){
				$data2['jenis'] = 'uk';
				$data2['nominal'] = '-'.strToCurrDB($_POST['nominal2'][$i]);
				}else if($num!='' && $cek->id_induk !=1){
				$data2['jenis'] = 'um';
				$data2['nominal'] = strToCurrDB($_POST['nominal2'][$i]);
				}													
				$this->db->insert("trx_jurnal", $data2);
			}

		}


		function tambah_hutang()
		{
					
			//echo "<pre>";print_r($_POST);"</pre>"; exit();
			$cus = $this->input->post("name");
			$this->form_validation->set_rules('name', 'Nama Suplier', 'trim|required|xss_clean');
    		$this->form_validation->set_rules('akun', 'Dibayar Dari', 'trim|required|xss_clean');
    		$cek_saldo = $this->db->query("SELECT sum(nominal) as num from trx_jurnal where akun = '13001' AND provider_id = '".$cus."'")->row();
    		if ($cek_saldo->num < strToCurrDB($this->input->post("usd")) AND $this->input->post("akun") =='13001') {
    				
    			$messageData = ConstructMessageResponse('Saldo Deposit tidak mencukupi' , 'danger');

            	echo $messageData ;
            	exit();
            }
    		
			if ( ! $this->form_validation->run() )
			{				
				$errorMessage = form_error('name').form_error('akun');
				$messageData = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{
				//echo "<pre>";print_r($_POST);"</pre>";exit();
				  
				  $kode = $this->input->post("akun");
		          $profit = $this->db->query("SELECT * from mst_provider where provider_id = '".$cus."'");
		          $ttl = strToCurrDB($this->input->post("usd"));		          
		          $akun = $this->db->query("SELECT * from mst_kasbank where kode_kasbank = '".$kode."'")->row();
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
		          $data6['tgl'] = date("Y-m-d");
		          $data6['uraian'] = $akun->nama_kasbank; 
		          $data6['memo'] = 'Hutang Usaha '.$profit->row()->provider_name;
		          $data6['akun'] = $this->input->post("akun"); 
		          $data6['nobukti'] = 'HDK';       
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
		          $data7['tgl'] = date("Y-m-d");
		          $data7['uraian'] = 'HUTANG USAHA'; 
		          $data7['memo'] = 'Hutang Usaha '.$profit->row()->provider_name;
		          $data7['akun'] = '22001'; 
		          $data7['nobukti'] = 'HDK';       
		          $data7['id_kategori'] = 1;
		          $data7['id_lpb_liquid'] = 0;
		          $data7['provider_id'] = $cus;
		          $data7['dateentry'] = date("Y-m-d");
		          $data7['userentry'] = $_SESSION['IDUser'];
		          $data7['jenis'] = 'uk';
		          $data7['nominal'] = '-'.$ttl;
		          $this->db->insert("trx_jurnal", $data7);
					
				}
				$messageData =1;
				echo $messageData;	            
			
        	}
		}

		function tambah_deposit()
		{
					
			//echo "<pre>";print_r($_POST);"</pre>"; exit();
			$this->form_validation->set_rules('name', 'Nama Suplier', 'trim|required|xss_clean');
    		$this->form_validation->set_rules('akun', 'Dibayar Dari', 'trim|required|xss_clean');

    		
    		
			if ( ! $this->form_validation->run() )
			{				
				$errorMessage = form_error('name').form_error('akun');
				$messageData = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{
				//echo "<pre>";print_r($_POST);"</pre>";exit();
				  $cus = $this->input->post("name");
				  $kode = $this->input->post("akun");
		          $profit = $this->db->query("SELECT * from mst_provider where provider_id = '".$cus."'");
		          $ttl = strToCurrDB($this->input->post("usd"));		          
		          $akun = $this->db->query("SELECT * from mst_kasbank where kode_kasbank = '".$kode."'")->row();
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
		          $data6['tgl'] = date("Y-m-d");
		          $data6['uraian'] = $akun->nama_kasbank; 
		          $data6['memo'] = 'Deposit '.$profit->row()->provider_name;
		          $data6['akun'] = $this->input->post("akun"); 
		          $data6['nobukti'] = 'DEPOSIT';       
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
		          $data7['tgl'] = date("Y-m-d");
		          $data7['uraian'] = 'UANG MUKA KE SUPPLIER'; 
		          $data7['memo'] = 'Deposit '.$profit->row()->provider_name;
		          $data7['akun'] = '13001'; 
		          $data7['nobukti'] = 'DEPOSIT';       
		          $data7['id_kategori'] = 1;
		          $data7['id_lpb_liquid'] = 0;
		          $data7['provider_id'] = $cus;
		          $data7['dateentry'] = date("Y-m-d");
		          $data7['userentry'] = $_SESSION['IDUser'];
		          $data7['jenis'] = 'um';
		          $data7['nominal'] = $ttl;
		          $this->db->insert("trx_jurnal", $data7);
					
				}
				$messageData =1;
				echo $messageData;	            
			
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

		public function GetDaftarKasHutang()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();

            

            $this->load->model("akuntansi_model", "ModelAkuntansi");

            

            echo $this->ModelAkuntansi->GetDaftarKasHutang(); 

		}

		public function GetDaftarHutang()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();

            

            $this->load->model("akuntansi_model", "ModelAkuntansi");

            

            echo $this->ModelAkuntansi->GetDaftarHutang(); 

		}

		public function GetDaftarDetail()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();

            

            $this->load->model("akuntansi_model", "ModelAkuntansi");

            

            echo $this->ModelAkuntansi->GetDaftarDetail(); 

		}

		public function printpenyesuaian($idx)
		{
			//$cari = $this->db->query("SELECT sum(nominal) as nominal from trx_jurnal where id_jurnal = '".$idx."'")->row();

			$data['jurnal'] = $idx;

			//$data['terbilang'] = $this->Terbilang($cari->nominal).' rupiah';

           	$this->load->view('printpenyesuaian', $data);                

           
		}

		public function GetDaftarLpbSm()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();

            

            $this->load->model("akuntansi_model", "ModelAkuntansi");

            

            echo $this->ModelAkuntansi->GetDaftarLpbSm(); 

		}

		public function GetDaftarLpbRaw()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();

            

            $this->load->model("akuntansi_model", "ModelAkuntansi");

            

            echo $this->ModelAkuntansi->GetDaftarLpbRaw(); 

		}

	}

/* End of file anggaran.php */

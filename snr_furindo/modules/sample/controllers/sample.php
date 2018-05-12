<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

	class Sample extends MY_Controller {    
	  	

	     public function __construct() {
	        parent::__construct();
	    }
	         
		public function index()
		{	
			$this->checkCredentialAccess();

			$this->checkIsAjaxRequest();

			//$data = $this->db->query("SELECT * from ref_kecamatan");
			//$data1 = $this->db->query("SELECT * from ref_kelurahan");
			//$data2 = $this->db->query("SELECT * from ref_pedukuhan");
	        $this->load->model('production_model', 'ModelAdmin');
	        $dataMenu = array('dataMenu' => $this->ModelAdmin->GetMenuAdmin());

	        $menu 	  = $this->load->view('menu_production_view', $dataMenu, true);
	        $content = '';
	        $content  = $this->load->view('dashboard_view', '', true);

	        $arrData = array('menu' 	=> $menu,	        				 
	        			   	 'content'  => $content);

	        echo json_encode($arrData);
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
    }

// ---------------KELAMPOK-------------------------------------
    public function kelompok()
    {
      
            $this->load->view('master_sample_view');                

           
    }  
	   	
	 

    public function GetDaftarAnggota()
        {
          $this->checkCredentialAccess();

                $this->checkIsAjaxRequest();
                
                $this->load->model("sample_model", "ModelRaw");
                
                echo $this->ModelRaw->GetDaftarAnggota(); 
        }

    

    public function savekelompok()
    {
      //echo "<pre>";print_r($_POST);"</pre>";exit();
            
        $data['nama_kelompok'] = $this->input->post("nama");
        $data['simpanan_pokok'] = $this->input->post("pokok");
        $data['simpanan_wajib'] = $this->input->post("wajib");
        $data['bunga_pinjaman'] = $this->input->post("pinjam");
        $data['bunga_simpanan'] = $this->input->post("simpan");
        $data['denda_pinjaman'] = $this->input->post("denda");
        $data['keterangan'] = $this->input->post("keterangan");
        $this->db->insert("mst_kelompok", $data);       
       
    }

    public function updatekelompok()
    {
      //echo "<pre>";print_r($_POST);"</pre>";exit();
            
        $data['nama_kelompok'] = $this->input->post("nama");
        $data['simpanan_pokok'] = $this->input->post("pokok");
        $data['simpanan_wajib'] = $this->input->post("wajib");
        $data['bunga_pinjaman'] = $this->input->post("pinjam");
        $data['bunga_simpanan'] = $this->input->post("simpan");
        $data['denda_pinjaman'] = $this->input->post("denda");
        $data['keterangan'] = $this->input->post("keterangan");
        $this->db->where('id_kelompok',$this->input->post("idx"));
        $this->db->update("mst_kelompok", $data);       
       
    }

    public function HapusKelompok()
    {
      $idx = $this->input->post('ID');
      $this->db->delete('mst_kelompok', array('id_kelompok' => $idx));
    }

    
    public function HapusPacking()
    {
      $idx = $this->input->post('ID');
      $cek = $this->db->query("SELECT * from trx_packing_detail where packing_id = '".$idx."'");
      foreach ($cek->result() as $row) {
        $this->db->delete('trx_inventory', array('inventory_id' => $row->inventory_id));
      }
      $this->db->delete('trx_packing_detail', array('packing_id' => $idx));
      $this->db->delete('trx_packing', array('packing_id' => $idx));
      $this->db->delete('trx_jurnal', array('id_packing' => $idx));
      
    }

//---------------------END KELOMPOK-------------------------------------------------------------------
//---------------------NASABAH------------------------------------------------------------------------
    public function nasabah()
    {      
            $this->load->view('master_nasabah_view'); 
    }  

    function ajax_lookUpNasabah(){
        $code = $this->input->post('code');
        $this->db->where('no_nasabah', $code);
        $query = $this->db->get('mst_nasabah');
        if ($query->num_rows() > 0){
           echo 0;
        } else {
           echo 1;
        }
    }
      
   

    public function GetDaftarNasabah()
        {
          $this->checkCredentialAccess();

                $this->checkIsAjaxRequest();
                
                $this->load->model("sample_model", "ModelRaw");
                
                echo $this->ModelRaw->GetDaftarNasabah(); 
        }

    

    public function savenasabah()
    {
      echo "<pre>";print_r($_POST);"</pre>";exit();
            
        $data['no_nasabah'] = $this->input->post("nama");
        $data['nama_nasabah'] = $this->input->post("pokok");
        $data['jk'] = $this->input->post("wajib");
        $data['alamat'] = $this->input->post("pinjam");
        $data['telp'] = $this->input->post("simpan");
        $data['id_kelompok'] = $this->input->post("denda");
        $data['tgl_masuk'] = $this->input->post("keterangan");
        $this->db->insert("mst_kelompok", $data);       
       
    }

    public function updatenasabah()
    {
      //echo "<pre>";print_r($_POST);"</pre>";exit();
            
        $data['nama_kelompok'] = $this->input->post("nama");
        $data['simpanan_pokok'] = $this->input->post("pokok");
        $data['simpanan_wajib'] = $this->input->post("wajib");
        $data['bunga_pinjaman'] = $this->input->post("pinjam");
        $data['bunga_simpanan'] = $this->input->post("simpan");
        $data['denda_pinjaman'] = $this->input->post("denda");
        $data['keterangan'] = $this->input->post("keterangan");
        $this->db->where('id_kelompok',$this->input->post("idx"));
        $this->db->update("mst_kelompok", $data);       
       
    }

    public function HapusNasabah()
    {
      $idx = $this->input->post('ID');
      $this->db->delete('mst_nasabah', array('id_nasabah' => $idx));
    }    
    
//-------------------------END NASABAH----------------------------------------------------------------
//-------------------------LPB SAMPLE----------------------------------------------------------------
    public function lpb_sample()
        {
            
            $this->load->view('master_lpb_sample_view');                

           
        }

    public function detail_lpb_sample()
        {
            
            $this->load->view('detail_lpb_sample');                

           
        }

    public function edit_lpb_sample()
        {
            $idx = $this->input->post("IDBidang");
            $data['LPB'] = $this->db->query("SELECT * from trx_lpb_sample inner join trx_lpb_sample_detail on trx_lpb_sample.lpb_id = trx_lpb_sample_detail.lpb_id 
            inner join mst_provider on mst_provider.provider_id = trx_lpb_sample.provider_id where trx_lpb_sample.lpb_id = '".$idx."'")->row();
            $data['LPBDet'] = $this->db->query("SELECT * from trx_lpb_sample_detail inner join mst_material on mst_material.material_id = trx_lpb_sample_detail.material_id 
            where lpb_id = '".$idx."'");
            $this->load->view('edit_lpb_sample_view', $data); 
        }

    public function GetDaftarLpb()
        {
          $this->checkCredentialAccess();

                $this->checkIsAjaxRequest();
                
                $this->load->model("sample_model", "ModelRaw");
                
                echo $this->ModelRaw->GetDaftarLpb(); 
        }

    public function GetDaftarLpbSample()
        {
          $this->checkCredentialAccess();

                $this->checkIsAjaxRequest();
                
                $this->load->model("sample_model", "ModelRaw");
                
                echo $this->ModelRaw->GetDaftarLpbSample(); 
        }

    public function tambah_lpb_sample()
        {
                  $tgl2 = date('m');
            $tgl3 = date('Y');
            $cek = $this->db->query("SELECT lpb_code from trx_lpb_sample where MONTH(lpb_date) = '".$tgl2."' AND YEAR(lpb_date) = '".$tgl3."' order by lpb_id DESC");
            $tgl = date('Y');
            $tgl1 = date('M');
            if($cek->num_rows() == 0){
              $data['nomor'] = '000/SNR-'.$tgl1.'/'.$tgl;
            }else{
              $data['nomor'] = $cek->row()->lpb_code;
            }
            $this->load->view('tambah_lpb_sample_view', $data); 
        } 

    function addTablePOSample(){
            $this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            $idproduct = $this->input->post("idx");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT * from trx_purchase_order_sample inner join mst_provider on  trx_purchase_order_sample.provider_id = mst_provider.provider_id 
                where purchase_order_sample_code like '%".$idproduct."%' OR provider_name like '%".$idproduct."%' LIMIT 10");           
            
            $i=1; 
            $strContent = '';
            foreach($arrContent->result() as $row){ 
                          
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $code = "'".$row->purchase_order_sample_code."'";
                $nama = "'".str_replace(" ","_",$row->purchase_order_sample_code)."'";
                $strContent.='<tr class="record">   
                            <td>'.$row->purchase_order_id.'</td>                                                                         
                                      <td>'.$row->purchase_order_sample_code.'</td>                                      
                                      <td>'.$row->provider_name.'</td>                                       
                                      <td>
                                        <button type="button" class="btn btn-xs btn-success"  onclick="addSales('.$row->purchase_order_sample_id.','.$code.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
              $i++;                      
            }     
            echo $strContent;            
          }

    function addTableRekanan(){
            $this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            $idproduct = $this->input->post("idx");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT sum(trx_purchase_order_sample.qty) as jml, trx_purchase_order_sample.*, mst_provider.* from trx_purchase_order_sample inner join mst_provider on  trx_purchase_order_sample.provider_id = mst_provider.provider_id where provider_categories_id = 1 group by mst_provider.provider_id");           
            
            $i=1; 
            $strContent = '';

            foreach($arrContent->result() as $row){               
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $cek = $this->db->query("SELECT sum(lpb_detail_qty) as jml2 from trx_lpb_sample_detail where purchase_order_sample_code ='".$row->purchase_order_sample_code."'")->row();
                $tgl = date('Y');
                $code = "'".$row->purchase_order_sample_code."'";
                $nama = "'".str_replace(" ","_",$row->provider_name)."'";
                $phone = "'".str_replace(" ","_",$row->provider_phone)."'";
                $address = "'".str_replace(" ","_",$row->provider_city)."'";
                $cat ="'".$row->id_induk."'";
                if($row->jml > $cek->jml2){
                
                $strContent.='<tr class="record">   
                                <td>'.$row->provider_id.'</td>                                                                         
                                <td>'.$row->purchase_order_sample_code.'</td>                                      
                                <td>'.$row->provider_name.''.$cek->jml2.'</td>                                       
                                <td style="text-align:center;">
                                    <button type="button" class="btn btn-xs btn-success"  onclick="addRekanan('.$row->provider_id.','.$nama.','.$code.','.$phone.','.$address.','.$row->purchase_order_sample_id.','.$cat.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                </td>
                              </tr>';
              $i++;
              }                      
            }     
            echo $strContent;            
          }

    function addTablePO_det(){
            
            $idproduct = $this->input->post("idx");
            $idso = $this->input->post("ids");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT * from trx_purchase_order_sample inner join mst_material on mst_material.material_id = trx_purchase_order_sample.material_id 
                where trx_purchase_order_sample.provider_id = '".$idso."' OR trx_purchase_order_sample.id_induk = '".$idso."'");           
            
            $i=1; 
            $strContent = '';
            $order=0;
            $idx = 0;
            $status = '';
            foreach($arrContent->result_array() as $key => $row){               
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $idx = $row['product_id'];
                $idm = $row['purchase_order_sample_id'];
                $cek = $this->db->query("SELECT sum(lpb_detail_qty) as qty_lpb from trx_lpb_sample_detail inner join trx_lpb_sample on trx_lpb_sample.lpb_id = trx_lpb_sample_detail.lpb_id where product_id = '".$idx."' AND purchase_order_sample_id = '".$idm."'")->row();
                $order = $row['qty'] - $cek->qty_lpb;
                $code = "'".$row['material_code']."'";
                $nama = "'".str_replace(" ","_",$row['material_name'])."'";
                if($order == 0){
                  $status = 'hidden';
                } else{
                  $status = '';
                
                $strContent.='<tr class="record '.$status.'">   
                            <td>'.$row['material_id'].'</td>
                                      <td>'.$row['purchase_order_sample_code'].'</td>                                                                         
                                      <td>'.$row['material_code'].'</td>                                      
                                      <td>'.$row['material_name'].'</td> 
                                      <td>'.$order.'</td>
                                      <td class="hidden">'.$row['price'].'</td> 
                                      <td class="hidden">'.$row['product_id'].'</td>
                                      <td class="hidden">'.$row['purchase_order_sample_id'].'</td>
                                      <td class="hidden">'.$row['qty'].'</td>
                                      <td class="hidden">'.$cek->qty_lpb.'</td>
                                      <td class="hidden">s'.$i.'</td>                                      
                                      <td>
                                        <button id="hds'.$i.'" type="button" class="btn btn-xs btn-success"  onclick="addProduct(this,'.$order.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
              $i++;
              }                      
            }     
            echo $strContent;            
          }

    public function saveLPBSample()
            {
              //echo "<pre>";print_r($_POST);"</pre>";exit();
                $cek = $this->db->query("SELECT * from trx_lpb_sample where provider_id = '".$this->input->post("id_customer")."' AND lpb_code = '".$this->input->post("nomor")."'");
                if($cek->num_rows() != 0){
                    $idso = $cek->row()->lpb_id;
                    $data['lpb_code'] = $this->input->post("nomor");
                    $data['lpb_biaya'] = strToCurrDB($this->input->post("biaya"));
                    $data['lpb_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
                    $data['lpb_note'] = $this->input->post("note");
                    $this->db->where('lpb_id',$idso);
                    $this->db->update("trx_lpb_sample", $data);
                } else{
                    $data['provider_id'] = $this->input->post("id_customer");
                    //$data['purchase_order_id'] = $this->input->post("po_id");
                    $data['lpb_biaya'] = strToCurrDB($this->input->post("biaya"));
                    $data['lpb_code'] = $this->input->post("nomor");
                    $data['lpb_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
                    $data['lpb_status'] = 'draft';              
                    $data['lpb_date_created'] = date("Y-m-d", strtotime($this->input->post("tgllpb")));
                    $data['lpb_last_updated'] = date("Y-m-d");      
                    $data['lpb_log'] = "insert by dwi";                                   
                      
                    $this->db->insert("trx_lpb_sample", $data);

                    $idso = $this->db->insert_id();
                }
                $c_kontak = count($this->input->post("id_material"));
                    
                for($i=0; $i<$c_kontak;$i++)
                {
                    $idp = $_POST['id_material'][$i];
                    $coba = $this->db->query("SELECT * from trx_lpb_detail where lpb_id = '".$idso."' AND material_id = '".$idp."'");
                    $iddet = $_POST['iddetail'][$i];          
                    if($coba->num_rows() != 0 && $iddet != 0){
                        $data2['lpb_detail_datang'] = $_POST['datang'][$i];
                        $data2['lpb_detail_qty'] = $_POST['qty'][$i];
                        $data2['lpb_detail_price'] = strToCurrDB($_POST['nominal'][$i]);
                        $data2['lpb_detail_note'] = $_POST['desc'][$i];
                        $data2['lpb_detail_last_updated'] = date("Y-m-d");
                        $this->db->where('lpb_detail_id',$_POST['iddetail'][$i]);
                        $this->db->update("trx_lpb_sample_detail", $data2);

                        $data3['inventory_jumlah_nominal'] = strToCurrDB($_POST['nominal'][$i]);
                        $data3['inventory_stock_qty'] = $_POST['qty'][$i];
                        $data3['inventory_jenis'] = "in";            
                        $data3['inventory_description'] = $_POST['desc'][$i];
                        $data3['inventory_log'] = "update by dwi";
                        $this->db->where('inventory_id',$coba->row()->inventory_id);
                        $this->db->update("trx_inventory", $data3);
                    } else{
                        $data3['warehouse_id'] = 1;
                    if($this->input->post("kategories") == 'sales'){
                        $data3['inventory_categories'] = 'wip';
                    }else {
                        $data3['inventory_categories'] = 'sample';
                    }              
                    $data3['material_id'] = $_POST['id_material'][$i];
                    $data3['inventory_item_categories'] = 'product';
                    $data3['inventory_jumlah_nominal'] = strToCurrDB($_POST['nominal'][$i]);
                    $data3['inventory_stock_qty'] = $_POST['qty'][$i];
                    $data3['inventory_jenis'] = "in";
                    $data3['inventory_date_transaction'] = date("Y-m-d");
                    $data3['inventory_date_created'] = date("Y-m-d");
                    $data3['inventory_description'] = $_POST['desc'][$i];
                    $data3['inventory_log'] = "insert by dwi";
                    $this->db->insert("trx_inventory", $data3);

                    $idinv = $this->db->insert_id();

                    $data2['lpb_id'] = $idso;
                    $data2['inventory_id'] = $idinv;
                    $data2['material_id'] = $_POST['id_material'][$i];
                    $data2['purchase_order_sample_id'] = $_POST['id_PO'][$i];
                    $data2['purchase_order_sample_code'] = $this->input->post("sample");
                    $data2['product_id'] = $_POST['id_product'][$i];
                    $data2['lpb_detail_datang'] = $_POST['datang'][$i];
                    $data2['lpb_detail_qty'] = $_POST['qty'][$i];
                    $data2['lpb_detail_price'] = strToCurrDB($_POST['nominal'][$i]);
                    $data2['lpb_detail_note'] = $_POST['desc'][$i];
                    //$data2['purchase_order_detail_remax'] = $_POST['qty'][$i];
                    $data2['lpb_detail_date_created'] = date("Y-m-d");
                    $data2['lpb_detail_last_updated'] = date("Y-m-d");
                    $data2['lpb_detail_log'] = "insert by dwi";
                    $this->db->insert("trx_lpb_sample_detail", $data2);            

                }
            }
          $cus = $this->input->post("id_customer");
          $profit = $this->db->query("SELECT * from mst_provider where provider_id = '".$cus."'");
          $ttl = strToCurrDB($this->input->post("total"));
          $hutang = $profit->row()->provider_hutang+$ttl;
          $data4['provider_hutang'] = $hutang;
          $this->db->where('provider_id',$cus);
          $this->db->update("mst_provider", $data4);

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
          $data6['uraian'] = 'HUTANG USAHA';
          $data6['memo'] = 'LPB '.$profit->row()->provider_name;
          $data6['akun'] = '22001';
          $data6['nobukti'] = $this->input->post("nomor");       
          $data6['id_kategori'] = 1;
          $data6['id_lpb_sample'] = $idso;
          $data6['provider_id'] = $cus;
          $data6['dateentry'] = date("Y-m-d");
          $data6['userentry'] = $_SESSION['IDUser'];
          $data6['jenis'] = 'um';
          $data6['nominal'] = $ttl;
          $this->db->insert("trx_jurnal", $data6);

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
          $data7['uraian'] = 'BAHAN BAKU (RAW BODY)';
          $data7['memo'] = 'LPB '.$profit->row()->provider_name;
          $data7['akun'] = '14002';
          $data7['nobukti'] = $this->input->post("nomor");       
          $data7['id_kategori'] = 1;
          $data7['id_lpb_sample'] = $idso;
          $data7['provider_id'] = $cus;
          $data7['dateentry'] = date("Y-m-d");
          $data7['userentry'] = $_SESSION['IDUser'];
          $data7['jenis'] = 'um';
          $data7['nominal'] = $ttl;
          $this->db->insert("trx_jurnal", $data7);

           $jml3 = $jml1+2;
           $jml_det3=0;
           if ($jml3 == 0) {
           $data8['nomor']= 'JU-0001';
           } else if($jml3 < 10){
             $jml_det3 = $jml3+1;
             $data8['nomor']= 'JU-000'.$jml_det3;
           } else if($jml3 < 100){
             $jml_det3 = $jml3+1;
            $data8['nomor']= 'JU-00'.$jml_det3;
          } else if($jml3 < 1000){
            $jml_det3 = $jml3+1;
            $data8['nomor']= 'JU-0'.$jml_det3;
          } else {
            $jml_det3 = $jml3+1;
            $data8['nomor']= 'JU-'.$jml_det3;
          }
          $data8['tgl'] = date("Y-m-d");
          $data8['uraian'] = 'BAHAN BAKU (RAW BODY)';
          $data8['memo'] = 'LPB '.$profit->row()->provider_name;
          $data8['akun'] = '14002';
          $data8['nobukti'] = $this->input->post("nomor");       
          $data8['id_kategori'] = 1;
          $data8['id_lpb_sample'] = $idso;
          $data8['provider_id'] = $cus;
          $data8['dateentry'] = date("Y-m-d");
          $data8['userentry'] = $_SESSION['IDUser'];
          $data8['jenis'] = 'uk';
          $data8['nominal'] = '-'.$ttl;
          $this->db->insert("trx_jurnal", $data8);

          $jml4 = $jml1+3;
          $jml_det4=0;
          if ($jml4 == 0) {
            $data9['nomor']= 'JU-0001';
          } else if($jml4 < 10){
            $jml_det4 = $jml4+1;
            $data9['nomor']= 'JU-000'.$jml_det4;
          } else if($jml4 < 100){
            $jml_det4 = $jml4+1;
            $data9['nomor']= 'JU-00'.$jml_det4;
          } else if($jml4 < 1000){
            $jml_det4 = $jml4+1;
            $data9['nomor']= 'JU-0'.$jml_det4;
          } else {
            $jml_det4 = $jml4+1;
            $data9['nomor']= 'JU-'.$jml_det4;
          }
          $data9['tgl'] = date("Y-m-d");
          $data9['uraian'] = 'PEMAKAIAN BAHAN BAKU';
          $data9['memo'] = 'LPB '.$profit->row()->provider_name;
          $data9['akun'] = '52001';
          $data9['nobukti'] = $this->input->post("nomor");       
          $data9['id_kategori'] = 2;
          $data9['id_lpb_sample'] = $idso;
          $data9['provider_id'] = $cus;
          $data9['dateentry'] = date("Y-m-d");
          $data9['userentry'] = $_SESSION['IDUser'];
          $data9['jenis'] = 'uk';
          $data9['nominal'] = '-'.$ttl;
          $this->db->insert("trx_jurnal", $data9);
        }

        public function updateLPBSample()
          {
            //echo "<pre>";print_r($_POST);"</pre>";exit();
            $cek = $this->db->query("SELECT * from trx_lpb_sample where provider_id = '".$this->input->post("id_customer")."' AND lpb_code = '".$this->input->post("nomor")."'");
              if($cek->num_rows() != 0){
                $idso = $cek->row()->lpb_id;
                $data['lpb_code'] = $this->input->post("nomor");
                $data['lpb_biaya'] = strToCurrDB($this->input->post("biaya"));
                $data['lpb_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
                $data['lpb_note'] = $this->input->post("note");
                $this->db->where('lpb_id',$idso);
                $this->db->update("trx_lpb_sample", $data);
              } else{
                $data['provider_id'] = $this->input->post("id_customer");
                //$data['purchase_order_id'] = $this->input->post("po_id");
                $data['lpb_biaya'] = strToCurrDB($this->input->post("biaya"));
                $data['lpb_code'] = $this->input->post("nomor");
                $data['lpb_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
                $data['lpb_status'] = 'draft';            
                $data['lpb_date_created'] = date("Y-m-d", strtotime($this->input->post("tgllpb")));
                $data['lpb_last_updated'] = date("Y-m-d");      
                $data['lpb_log'] = "insert by ucik";                           
                  
                $this->db->insert("trx_lpb_sample", $data);

                $idso = $this->db->insert_id();
            }
              $c_kontak = count($this->input->post("id_material"));
            
          for($i=0; $i<$c_kontak;$i++)
          {
            $idp = $_POST['id_material'][$i];
            $coba = $this->db->query("SELECT * from trx_lpb_sample_detail where lpb_id = '".$idso."' AND material_id = '".$idp."'");
            $iddet = $_POST['iddetail'][$i];          
            if($coba->num_rows() != 0 && $iddet != 0){
              $data2['lpb_detail_datang'] = $_POST['datang'][$i];
              $data2['lpb_detail_qty'] = $_POST['qty'][$i];
              $data2['lpb_detail_price'] = strToCurrDB($_POST['nominal'][$i]);
              $data2['lpb_detail_note'] = $_POST['desc'][$i];
              $data2['lpb_detail_last_updated'] = date("Y-m-d");
              $this->db->where('lpb_detail_id',$_POST['iddetail'][$i]);
              $this->db->update("trx_lpb_sample_detail", $data2);

              $data3['inventory_jumlah_nominal'] = strToCurrDB($_POST['nominal'][$i]);
              $data3['inventory_stock_qty'] = $_POST['qty'][$i];
              $data3['inventory_jenis'] = "in";            
              $data3['inventory_description'] = $_POST['desc'][$i];
              $data3['inventory_log'] = "update by ucik";
              $this->db->where('inventory_id',$coba->row()->inventory_id);
              $this->db->update("trx_inventory", $data3);
            } else{
              $data3['warehouse_id'] = 1;
              if($this->input->post("kategories") == 'sales'){
                $data3['inventory_categories'] = 'wip';
              }else {
                $data3['inventory_categories'] = 'sample';
              }              
              $data3['material_id'] = $_POST['id_material'][$i];
              $data3['inventory_item_categories'] = 'product';
              $data3['inventory_jumlah_nominal'] = strToCurrDB($_POST['nominal'][$i]);
              $data3['inventory_stock_qty'] = $_POST['qty'][$i];
              $data3['inventory_jenis'] = "in";
              $data3['inventory_date_transaction'] = date("Y-m-d");
              $data3['inventory_date_created'] = date("Y-m-d");
              $data3['inventory_description'] = $_POST['desc'][$i];
              $data3['inventory_log'] = "insert by ucik";
              $this->db->insert("trx_inventory", $data3);

              $idinv = $this->db->insert_id();

              $data2['lpb_id'] = $idso;
              $data2['inventory_id'] = $idinv;
              $data2['material_id'] = $_POST['id_material'][$i];
              $data2['purchase_order_id'] = $_POST['id_PO'][$i];
              $data2['product_id'] = $_POST['id_product'][$i];
              $data2['lpb_detail_datang'] = $_POST['datang'][$i];
              $data2['lpb_detail_qty'] = $_POST['qty'][$i];
              $data2['lpb_detail_price'] = strToCurrDB($_POST['nominal'][$i]);
              $data2['lpb_detail_note'] = $_POST['desc'][$i];
              //$data2['purchase_order_detail_remax'] = $_POST['qty'][$i];
              $data2['lpb_detail_date_created'] = date("Y-m-d");
              $data2['lpb_detail_last_updated'] = date("Y-m-d");
              $data2['lpb_detail_log'] = "insert by dwi";
              $this->db->insert("trx_lpb_sample_detail", $data2);            

            }
          }
          $ttl = strToCurrDB($this->input->post("total"));                    
          $data6['nominal'] = $ttl;
          $this->db->where('id_lpb_sample',$idso);
          $this->db->where('jenis','um');
          $this->db->update("trx_jurnal", $data6);

          $data7['nominal'] = '-'.$ttl;
          $this->db->where('id_lpb_sample',$idso);
          $this->db->where('jenis','uk');
          $this->db->update("trx_jurnal", $data7);          
        }

        public function adddataSample()
        {
            $data3['warehouse_id'] = 1;
            $data3['inventory_categories'] = 'sample';
            $data3['material_id'] = $this->input->post("mat_id");
            $data3['inventory_item_categories'] = 'product';
            $data3['inventory_jumlah_nominal'] = strToCurrDB($this->input->post("price"));
            $data3['inventory_stock_qty'] = $this->input->post("qty");
            $data3['inventory_jenis'] = "in";
            $data3['inventory_date_transaction'] = date("Y-m-d");
            $data3['inventory_date_created'] = date("Y-m-d");
            $data3['inventory_description'] = '';
            $data3['inventory_log'] = "insert by dwi";
            $this->db->insert("trx_inventory", $data3);

            $idinv = $this->db->insert_id();

            $data2['lpb_id'] = $this->input->post("lpb_id");
            $data2['inventory_id'] = $idinv;
            $data2['material_id'] = $this->input->post("mat_id");
            $data2['product_id'] = $this->input->post("prod_id");
            $data2['lpb_detail_qty'] = $this->input->post("qty");
            $data2['lpb_detail_datang'] = $this->input->post("qty");
            $data2['purchase_order_sample_code'] = $this->input->post("sample");
            $data2['lpb_detail_price'] = strToCurrDB($this->input->post("price"));
            $data2['lpb_detail_note'] = '';
            $data2['purchase_order_sample_id'] = $this->input->post("PO");
            //$data2['purchase_order_detail_remax'] = $_POST['qty'][$i];
            $data2['lpb_detail_date_created'] = date("Y-m-d");
            $data2['lpb_detail_last_updated'] = date("Y-m-d");
            $data2['lpb_detail_log'] = "insert by dwi";
            $this->db->insert("trx_lpb_sample_detail", $data2);          
          
        }

        public function habusdataSample()
        {
          $this->checkCredentialAccess();

          $this->checkIsAjaxRequest();

          $idx =   $this->input->post('ID');
          $idv =   $this->input->post('IDV');
          $this->db->delete('trx_lpb_sample_detail', array('lpb_detail_id' => $idx));
          $this->db->delete('trx_inventory', array('inventory_id' => $idv));          
          
        }

        public function HapusLpbSample()
        {
          $this->checkCredentialAccess();

                $this->checkIsAjaxRequest();

          $idx = $this->input->post('ID');
          
          $idx =   $this->input->post('ID');
          $cek = $this->db->query("SELECT * from trx_lpb_sample_detail where lpb_id = '".$idx."'");
          $this->db->delete('trx_lpb_sample_detail', array('lpb_id' => $idx));
          $this->db->delete('trx_lpb_sample', array('lpb_id' => $idx));
          $this->db->delete('trx_jurnal', array('id_lpb_sample' => $idx));
          foreach ($cek->result() as $row) {
            $this->db->delete('trx_inventory', array('inventory_id' => $row->inventory_id));
          }
           
          
        }

        public function printLPBsample($idx)
        {
          $cari = $this->db->query("SELECT sum(lpb_detail_qty*lpb_detail_price) as nominal from trx_lpb_sample_detail where lpb_id = '".$idx."'")->row();
          $coba = $this->db->query("SELECT lpb_biaya from trx_lpb_sample where lpb_id = '".$idx."'")->row();

          $data['lpb'] = $idx;

          $data['terbilang'] = $this->Terbilang($cari->nominal+$coba->lpb_biaya).' rupiah';

          $this->load->view('cetak_lpb_sample', $data);                

               
        }
    
}

/* End of fiel Utility.php */
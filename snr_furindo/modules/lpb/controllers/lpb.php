<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

	class Lpb extends MY_Controller {    
	  	

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
	        $this->load->model('lpb_model', 'ModelAdmin');
	        $dataMenu = array('dataMenu' => $this->ModelAdmin->GetMenuAdmin());

	        $menu 	  = $this->load->view('menu_lpb_view', $dataMenu, true);
	        $content  = $this->load->view('dashboard_view', '', true);
	        //$content  = $this->load->view('admin_view', '', true);

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

    public function printLPB($idx)
    {
      $cari = $this->db->query("SELECT sum(lpb_detail_qty*lpb_detail_price) as nominal from trx_lpb_detail where lpb_id = '".$idx."'")->row();
      $coba = $this->db->query("SELECT lpb_biaya from trx_lpb where lpb_id = '".$idx."'")->row();

      $data['lpb'] = $idx;

      $data['terbilang'] = $this->Terbilang($cari->nominal+$coba->lpb_biaya).' rupiah';

      $this->load->view('cetak_lpb', $data);                

           
    }

    public function printLPBsample($idx)
    {
      $cari = $this->db->query("SELECT sum(lpb_detail_qty*lpb_detail_price) as nominal from trx_lpb_sample_detail where lpb_id = '".$idx."'")->row();
      $coba = $this->db->query("SELECT lpb_biaya from trx_lpb_sample where lpb_id = '".$idx."'")->row();

      $data['lpb'] = $idx;

      $data['terbilang'] = $this->Terbilang($cari->nominal+$coba->lpb_biaya).' rupiah';

      $this->load->view('cetak_lpb', $data);                

           
    }

    public function printLPBSm($idx)
    {
      $cari = $this->db->query("SELECT sum(lpb_liquid_detail_qty*lpb_liquid_detail_price) as nominal from trx_lpb_liquid_detail where lpb_liquid_id = '".$idx."'")->row();
      $coba = $this->db->query("SELECT lpb_liquid_biaya from trx_lpb_liquid where lpb_liquid_id = '".$idx."'")->row();

      $data['lpb'] = $idx;

      $data['terbilang'] = $this->Terbilang($cari->nominal+$coba->lpb_liquid_biaya).' rupiah';

      $this->load->view('cetak_lpb_sm', $data);                

           
    }

		public function lpb_raw()
		{
			
           	$this->load->view('master_lpb_raw_view');                

           
		}

    public function lpb_sm()
    {
      
            $this->load->view('master_lpb_sm_view');                

           
    }
    public function lpb_jasa()
    {
      
            $this->load->view('master_lpb_jasa_view');                

           
    }

    public function lpb_umum()
    {
      
            $this->load->view('master_lpb_umum_view');                

           
    }  

    public function Inventory_raw()
    {
      
            $this->load->view('master_inv_raw_view');                

           
    }  

    public function Inventory_sm()
    {
      
            $this->load->view('master_inv_sm_view');                

           
    } 

    public function Inventory_detail_sm()
    {
      
            $this->load->view('master_inv_detail_sm_view');                

           
    }

    public function Inventory_detail_raw()
    {
      
            $this->load->view('master_inv_detail_raw_view');                

           
    }  
	   	
	   	public function tambah_lpb_raw()
		{
			      $tgl2 = date('m');
            $tgl3 = date('Y');
            $cek = $this->db->query("SELECT lpb_code from trx_lpb where MONTH(lpb_date) = '".$tgl2."' AND YEAR(lpb_date) = '".$tgl3."' order by lpb_id DESC");
            $tgl = date('Y');
            $tgl1 = date('M');
            if($cek->num_rows() == 0){
              $data['nomor'] = '000/SNR-'.$tgl1.'/'.$tgl;
            }else{
              $data['nomor'] = $cek->row()->lpb_code;
            }
           	$this->load->view('tambah_lpb_raw_view', $data);                

           
		} 

    public function tambah_lpb_sm()
    {       
            $tgl2 = date('m');
            $tgl3 = date('Y');
            $cek = $this->db->query("SELECT lpb_liquid_code from trx_lpb_liquid where MONTH(lpb_liquid_date) = '".$tgl2."' AND YEAR(lpb_liquid_date) = '".$tgl3."' order by lpb_liquid_id DESC");
            $tgl = date('Y');
            $tgl1 = date('M');
            if($cek->num_rows() == 0){
              $data['nomor'] = '000/SNR SPM-'.$tgl1.'/'.$tgl;
            }else{
              $data['nomor'] = $cek->row()->lpb_liquid_code;
            }
            $this->load->view('tambah_lpb_sm_view', $data);                

           
    }
    public function tambah_lpb_jasa()
    {
            $tgl2 = date('m');
            $tgl3 = date('Y');
            $cek = $this->db->query("SELECT lpb_code from trx_lpb_jasa where MONTH(lpb_date) = '".$tgl2."' AND YEAR(lpb_date) = '".$tgl3."' order by lpb_id DESC");
            $tgl = date('Y');
            $tgl1 = date('M');
            if($cek->num_rows() == 0){
              $data['nomor'] = '000/SNR JASA-'.$tgl1.'/'.$tgl;
            }else{
              $data['nomor'] = $cek->row()->lpb_code;
            }
            $this->load->view('tambah_lpb_jasa_view', $data);                

           
    } 

    public function tambah_lpb_umum()
    {       
            $tgl2 = date('m');
            $tgl3 = date('Y');
            $cek = $this->db->query("SELECT lpb_code from trx_lpb_umum where MONTH(lpb_date) = '".$tgl2."' AND YEAR(lpb_date) = '".$tgl3."' order by lpb_id DESC");
            $tgl = date('Y');
            $tgl1 = date('M');
            if($cek->num_rows() == 0){
              $data['nomor'] = '000/SNR UMUM-'.$tgl1.'/'.$tgl;
            }else{
              $data['nomor'] = $cek->row()->lpb_code;
            }
            $this->load->view('tambah_lpb_umum_view', $data);                

           
    } 

    public function tambah_lpb_bebas()
    {       
            $tgl2 = date('m');
            $tgl3 = date('Y');
            $cek = $this->db->query("SELECT lpb_liquid_code from trx_lpb_liquid where MONTH(lpb_liquid_date) = '".$tgl2."' AND YEAR(lpb_liquid_date) = '".$tgl3."' order by lpb_liquid_id DESC");
            $tgl = date('Y');
            $tgl1 = date('M');
            if($cek->num_rows() == 0){
              $data['nomor'] = '000/SNR SPM-'.$tgl1.'/'.$tgl;
            }else{
              $data['nomor'] = $cek->row()->lpb_liquid_code;
            }
            $this->load->view('tambah_lpb_bebas_view', $data);                

           
    } 

		public function edit_lpb_raw()
		{
			$idx = $this->input->post("IDBidang");
			$data['LPB'] = $this->db->query("SELECT * from trx_lpb inner join trx_lpb_detail on trx_lpb.lpb_id = trx_lpb_detail.lpb_id 
        inner join mst_provider on mst_provider.provider_id = trx_lpb.provider_id where trx_lpb.lpb_id = '".$idx."'")->row();
			$data['LPBDet'] = $this->db->query("SELECT * from trx_lpb_detail inner join mst_material on mst_material.material_id = trx_lpb_detail.material_id 
            inner join mst_product on mst_product.product_id = trx_lpb_detail.product_id where lpb_id = '".$idx."'");
           	$this->load->view('edit_lpb_raw_view', $data);                

           
		}

    public function edit_lpb_umum()
    {
      $idx = $this->input->post("IDBidang");
      $data['LPB'] = $this->db->query("SELECT * from trx_lpb_umum where lpb_id = '".$idx."'")->row();
      $data['LPBDet'] = $this->db->query("SELECT * from trx_lpb_umum_detail where lpb_id = '".$idx."'");
            $this->load->view('edit_lpb_umum_view', $data);                

           
    }

    public function edit_lpb_sm()
    {
      $idx = $this->input->post("IDBidang");
      $data['LPB'] = $this->db->query("SELECT * from trx_lpb_liquid inner join trx_lpb_liquid_detail  on trx_lpb_liquid.lpb_liquid_id = trx_lpb_liquid_detail.lpb_liquid_id 
            inner join trx_purchase_order_liquid on trx_lpb_liquid_detail.purchase_order_liquid_id = trx_purchase_order_liquid.purchase_order_liquid_id
            inner join mst_provider on mst_provider.provider_id = trx_lpb_liquid.provider_id where trx_lpb_liquid.lpb_liquid_id = '".$idx."'")->row();
      $data['LPBDet'] = $this->db->query("SELECT * from trx_lpb_liquid_detail inner join mst_material on mst_material.material_id = trx_lpb_liquid_detail.material_id 
            where lpb_liquid_id = '".$idx."'");
            $this->load->view('edit_lpb_sm_view', $data);
    }

    public function edit_lpb_bebas()
    {
      $idx = $this->input->post("IDBidang");
      $data['LPB'] = $this->db->query("SELECT * from trx_lpb_liquid inner join trx_lpb_liquid_detail  on trx_lpb_liquid.lpb_liquid_id = trx_lpb_liquid_detail.lpb_liquid_id 
            left join trx_purchase_order_liquid on trx_lpb_liquid_detail.purchase_order_liquid_id = trx_purchase_order_liquid.purchase_order_liquid_id
            inner join mst_provider on mst_provider.provider_id = trx_lpb_liquid.provider_id where trx_lpb_liquid.lpb_liquid_id = '".$idx."'")->row();
      $data['LPBDet'] = $this->db->query("SELECT * from trx_lpb_liquid_detail inner join mst_material on mst_material.material_id = trx_lpb_liquid_detail.material_id 
            where lpb_liquid_id = '".$idx."'");
            $this->load->view('edit_lpb_bebas_view', $data);
    }  
    public function edit_lpb_jasa()
    {
      $idx = $this->input->post("IDBidang");
      $data['LPB'] = $this->db->query("SELECT * from trx_lpb_jasa inner join trx_shipment on trx_shipment.shipment_id = trx_lpb_jasa.shipment_id 
        inner join mst_provider on mst_provider.provider_id=trx_lpb_jasa.provider_id where trx_lpb_jasa.lpb_id = '".$idx."'")->row();
      $data['LPBDet'] = $this->db->query("SELECT * from trx_lpb_jasa_detail where lpb_id = '".$idx."'");
            $this->load->view('edit_lpb_jasa_view', $data);                

           
    }
		function addTableRekanan(){
            $this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            $idproduct = $this->input->post("idx");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT * from trx_purchase_order inner join mst_provider on  trx_purchase_order.provider_id = mst_provider.provider_id where provider_categories_id = 1 AND (purchase_order_code like '%".$idproduct."%' OR provider_name like '%".$idproduct."%') group by mst_provider.provider_id");           
            
            $i=1; 
            $strContent = '';

            foreach($arrContent->result() as $row){               
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $tgl = date('Y');
                $code = "'LPB".$row->purchase_order_code."'";
                $nama = "'".str_replace(" ","_",$row->provider_name)."'";
                $phone = "'".str_replace(" ","_",$row->provider_phone)."'";
                $address = "'".str_replace(" ","_",$row->provider_city)."'";
                $cat ="'".$row->purchase_order_categories."'";
                $strContent.='<tr class="record">   
                            <td>'.$row->provider_id.'</td>                                                                         
                                      <td>'.$row->purchase_order_code.'</td>                                      
                                      <td>'.$row->provider_name.'</td>                                       
                                      <td>
                                        <button type="button" class="btn btn-xs btn-success"  onclick="addRekanan('.$row->provider_id.','.$nama.','.$code.','.$phone.','.$address.','.$row->purchase_order_id.','.$cat.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
              $i++;                      
            }     
            echo $strContent;            
          }
           function addTableSales(){
            $this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            $idproduct = $this->input->post("idx");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT shipment_id, shipment_code,shipment_container_code from trx_shipment");           
            
           
            foreach($arrContent->result() as $row){ 

             
              if($arrContent == 0) 
              {
                $status = 'hidden';
                
              } else{
                $status = '';
                         
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $code = "'".$row->shipment_code."'";
                $nama = "'".str_replace(" ","_",$row->shipment_id)."'";
                $strContent.='<tr class="record '.$status.'">   
                            <td>'.$row->shipment_id.'</td>                                                                         
                                      <td>'.$row->shipment_code.'</td>                                      
                                      <td>'.$row->shipment_container_code.'</td>                                       
                                      <td>
                                        <button type="button" class="btn btn-xs btn-success"  onclick="addSales('.$row->shipment_id.','.$code.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
                }
              $i++;                      
            }     
            echo $strContent;            
          }

      function addTableSuplier(){
            $this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            $idproduct = $this->input->post("idx");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT * from trx_purchase_order_liquid inner join mst_provider on  trx_purchase_order_liquid.provider_id = mst_provider.provider_id where provider_categories_id = 2 AND (purchase_order_liquid_code like '%".$idproduct."%' OR provider_name like '%".$idproduct."%')");           
            
            $i=1; 
            $strContent = '';

            foreach($arrContent->result() as $row){               
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $tgl = date('mdY');
                $code = "'LPB".$row->purchase_order_liquid_code."'";
                $nama = "'".str_replace(" ","_",$row->provider_name)."'";
                $phone = "'".str_replace(" ","_",$row->provider_phone)."'";
                $address = "'".str_replace(" ","_",$row->provider_city)."'";
                $cek2 = $this->db->query("SELECT sum(purchase_order_liquid_detail_qty) as qty from trx_purchase_order_liquid_detail where trx_purchase_order_liquid_detail.purchase_order_liquid_id = ".$row->purchase_order_liquid_id."")->row();
                $cek3 = $this->db->query("SELECT sum(lpb_liquid_detail_qty) as qty from trx_lpb_liquid_detail where trx_lpb_liquid_detail.purchase_order_liquid_id = ".$row->purchase_order_liquid_id."")->row();
                if($cek2->qty == $cek3->qty){

                }else{
                $strContent.='<tr class="record">   
                            <td>'.$row->purchase_order_liquid_id.'</td>
                                      <td>'.$row->purchase_order_liquid_code.'</td>                                                                         
                                      <td>'.$row->provider_code.'</td>                                      
                                      <td>'.$row->provider_name.'</td>                                       
                                      <td>
                                        <button type="button" class="btn btn-xs btn-success"  onclick="addRekanan('.$row->provider_id.','.$nama.','.$code.','.$phone.','.$address.','.$row->purchase_order_liquid_id.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
              $i++; 
              }                     
            }     
            echo $strContent;            
          }

          function addTableRekanan1(){
            $this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            $idproduct = $this->input->post("idx");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT * from trx_purchase_order inner join mst_provider on  trx_purchase_order.provider_id = mst_provider.provider_id where provider_categories_id = 1 AND (purchase_order_code like '%".$idproduct."%' OR provider_name like '%".$idproduct."%') LIMIT 10");           
            
            $i=1; 
            $strContent = '';

            foreach($arrContent->result() as $row){               
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $tgl = date('mdY');
                $code = "'".$row->provider_code.''.$tgl."'";
                $nama = "'".str_replace(" ","_",$row->provider_name)."'";
                $strContent.='<tr class="record">   
                            <td>'.$row->provider_id.'</td>                                                                         
                                      <td>'.$row->purchase_order_code.'</td>                                      
                                      <td>'.$row->provider_name.'</td>                                       
                                      <td>
                                        <button type="button" class="btn btn-xs btn-success"  onclick="addRekanan('.$row->provider_id.','.$nama.','.$code.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
              $i++;                      
            }     
            echo $strContent;            
          }
          
           function addTableRekananJasa(){
            $this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            $idproduct = $this->input->post("idx");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT * from mst_provider where provider_categories_id = 5 AND (provider_code like '%".$idproduct."%' OR provider_name like '%".$idproduct."%')");           
            
            $i=1; 
            $strContent = '';

            foreach($arrContent->result() as $row){               
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $tgl = date('mdy');
                $code = "'".$row->provider_code.''.$tgl."'";
                $nama = "'".str_replace(" ","_",$row->provider_name)."'";
                $phone = "'".str_replace(" ","_",$row->provider_phone)."'";
                $address = "'".str_replace(" ","_",$row->provider_city)."'";
                $strContent.='<tr class="record">   
                            <td>'.$row->provider_id.'</td>                                                                         
                                      <td>'.$row->provider_code.'</td>                                      
                                      <td>'.$row->provider_name.'</td>                                       
                                      <td>
                                        <button type="button" class="btn btn-xs btn-success"  onclick="addRekanan('.$row->provider_id.','.$nama.','.$code.','.$phone.','.$address.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
              $i++;                      
            }     
            echo $strContent;            
          }


           function addTablePO(){
            $this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            $idproduct = $this->input->post("idx");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT * from trx_purchase_order inner join mst_provider on  trx_purchase_order.provider_id = mst_provider.provider_id 
                where purchase_order_code like '%".$idproduct."%' OR provider_name like '%".$idproduct."%' LIMIT 10");           
            
            $i=1; 
            $strContent = '';
            foreach($arrContent->result() as $row){ 
            	          
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $code = "'".$row->purchase_order_code."'";
                $nama = "'".str_replace(" ","_",$row->purchase_order_code)."'";
                $strContent.='<tr class="record">   
                            <td>'.$row->purchase_order_id.'</td>                                                                         
                                      <td>'.$row->purchase_order_code.'</td>                                      
                                      <td>'.$row->provider_name.'</td>                                       
                                      <td>
                                        <button type="button" class="btn btn-xs btn-success"  onclick="addSales('.$row->purchase_order_id.','.$code.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
              $i++;                      
            }     
            echo $strContent;            
          }


          function addTableLiquid_det(){
            
            $idproduct = $this->input->post("idx");
            $idso = $this->input->post("ids");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT purchase_order_liquid_detail_qty as qty, trx_purchase_order_liquid.*,trx_purchase_order_liquid_detail.*,mst_material.* from trx_purchase_order_liquid inner join trx_purchase_order_liquid_detail 
              on trx_purchase_order_liquid.purchase_order_liquid_id = trx_purchase_order_liquid_detail.purchase_order_liquid_id
              inner join mst_material on mst_material.material_id = trx_purchase_order_liquid_detail.material_id where trx_purchase_order_liquid.purchase_order_liquid_id = '".$idso."'
              ");           
            
            $i=1; 
            $strContent = '';
            $order=0;
            $idx = 0;
            $status = '';
            foreach($arrContent->result_array() as $key => $row){               
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $idx = $row['material_id'];
                $idm = $row['purchase_order_liquid_id'];
                $cek = $this->db->query("SELECT sum(lpb_liquid_detail_qty) as qty_lpb from trx_lpb_liquid_detail inner join trx_lpb_liquid on trx_lpb_liquid.lpb_liquid_id = trx_lpb_liquid_detail.lpb_liquid_id where material_id = '".$idx."' AND purchase_order_liquid_id = '".$idm."'")->row();
                $order = round($row['qty'],2) - round($cek->qty_lpb,2);
                $code = "'".$row['material_code']."'";
                $nama = "'".str_replace(" ","_",$row['material_name'])."'";
                if($order == 0){
                	$status = 'hidden';
                } else{
                	$status = '';
                
                $strContent.='<tr class="record '.$status.'">   
                            <td>'.$row['material_id'].'</td>
                                      <td>'.$row['purchase_order_liquid_code'].'</td>                                                                         
                                      <td>'.$row['material_code'].'</td>                                      
                                      <td>'.$row['material_name'].'</td> 
                                      <td>'.$order.'</td>
                                      <td class="hidden">'.$row['purchase_order_liquid_detail_price'].'</td> 
                                      <td class="hidden">'.$row['product_id'].'</td>
                                      <td class="hidden">'.$row['purchase_order_liquid_id'].'</td>
                                      <td class="hidden">'.$row['qty'].'</td>
                                      <td class="hidden">'.$cek->qty_lpb.'</td>
                                      <td class="hidden">s'.$i.'</td>                                      
                                      <td>
                                        <button id="hds'.$i.'" type="button" class="btn btn-xs btn-success"  onclick="addProduct(this,'.$order.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
                }
              $i++;                      
            }     
            echo $strContent;            
          }

          function addTableLiquid_bebas(){
            
            $arrContent = $this->db->query("SELECT * from mst_material where material_categories_id = 2");           
            
            $i=1; 
            $strContent = '';
            $order=0;
            $idx = 0;
            $status = '';
            foreach($arrContent->result_array() as $key => $row){
                $status = '';                
                $strContent.='<tr class="record '.$status.'">   
                                    <td>'.$row['material_id'].'</td>
                                    <td>'.$row['material_code'].'</td>                                      
                                    <td>'.$row['material_name'].'</td> 
                                    <td>'.$row['material_price'].'</td> 
                                    <td class="hidden">s'.$i.'</td>                                      
                                    <td>
                                      <button id="hds'.$i.'" type="button" class="btn btn-xs btn-success"  onclick="addProduct(this)"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                    </td>
                                </tr>';                
              $i++;                      
            }     
            echo $strContent;            
          }

          function addTablePO_det(){
            
            $idproduct = $this->input->post("idx");
            $idso = $this->input->post("ids");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT * from trx_purchase_order inner join trx_purchase_order_detail on trx_purchase_order.purchase_order_id = trx_purchase_order_detail.purchase_order_id
            inner join mst_material on mst_material.material_id = trx_purchase_order_detail.material_id where trx_purchase_order.provider_id = '".$idso."'");           
            
            $i=1; 
            $strContent = '';
            $order=0;
            $idx = 0;
            $status = '';
            foreach($arrContent->result_array() as $key => $row){               
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $idx = $row['product_id'];
                $idm = $row['purchase_order_id'];
                $cek = $this->db->query("SELECT sum(lpb_detail_qty) as qty_lpb from trx_lpb_detail inner join trx_lpb on trx_lpb.lpb_id = trx_lpb_detail.lpb_id where product_id = '".$idx."' AND purchase_order_id = '".$idm."'")->row();
                $order = $row['purchase_order_detail_qty'] - $cek->qty_lpb;
                $code = "'".$row['material_code']."'";
                $nama = "'".str_replace(" ","_",$row['material_name'])."'";
                if($order == 0){
                  $status = 'hidden';
                } else{
                  $status = '';
                
                $strContent.='<tr class="record '.$status.'">   
                            <td>'.$row['material_id'].'</td>
                                      <td>'.$row['purchase_order_code'].'</td>                                                                         
                                      <td>'.$row['material_code'].'</td>                                      
                                      <td>'.$row['material_name'].'</td> 
                                      <td>'.$order.'</td>
                                      <td class="hidden">'.$row['purchase_order_detail_price'].'</td> 
                                      <td class="hidden">'.$row['product_id'].'</td>
                                      <td class="hidden">'.$row['purchase_order_id'].'</td>
                                      <td class="hidden">'.$row['purchase_order_detail_qty'].'</td>
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

          function addTablePO_det1(){
            
            $idproduct = $this->input->post("idx");
            $idso = $this->input->post("ids");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT * from trx_purchase_order inner join trx_purchase_order_detail on trx_purchase_order.purchase_order_id = trx_purchase_order_detail.purchase_order_id
            inner join mst_material on mst_material.material_id = trx_purchase_order_detail.material_id where trx_purchase_order.purchase_order_id = '".$idso."' AND (material_name like '%".$idproduct."%' OR material_code like '%".$idproduct."%') LIMIT 100");           
            
            $i=1; 
            $strContent = '';
            $order=0;
            $idx = 0;
            $status = '';
            foreach($arrContent->result_array() as $key => $row){               
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $idx = $row['material_id'];
                $idm = $row['purchase_order_id'];
                $cek = $this->db->query("SELECT sum(lpb_detail_qty) as qty_lpb from trx_lpb_detail inner join trx_lpb on trx_lpb.lpb_id = trx_lpb_detail.lpb_id where material_id = '".$idx."' AND purchase_order_id = '".$idm."'");
                $order = $row['purchase_order_detail_qty'] - $cek->row()->qty_lpb;
                $code = "'".$row['material_code']."'";
                $nama = "'".str_replace(" ","_",$row['material_name'])."'";
                if($cek->row()->qty_lpb != ''){
                  $status = 'hidden';
                } else{
                  $status = '';
                }
                $strContent.='<tr class="record '.$status.'">   
                            <td>'.$row['material_id'].'</td>
                                      <td>'.$row['purchase_order_code'].'</td>                                                                         
                                      <td>'.$row['material_code'].'</td>                                      
                                      <td>'.$row['material_name'].'</td> 
                                      <td>'.$order.'</td>
                                      <td class="hidden">'.$row['purchase_order_detail_price'].'</td> 
                                      <td class="hidden">'.$row['product_id'].'</td>
                                      <td class="hidden">'.$row['purchase_order_id'].'</td>
                                      <td class="hidden">'.$row['purchase_order_detail_qty'].'</td>
                                      <td class="hidden">'.$cek->row()->qty_lpb.'</td>                                      
                                      <td>
                                        <button type="button" class="btn btn-xs btn-success"  onclick="addProduct(this,'.$order.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
              $i++;                      
            }     
            echo $strContent;            
          }

          public function saveLPB()
  		    {
  		      //echo "<pre>";print_r($_POST);"</pre>";exit();
  		    	$cek = $this->db->query("SELECT * from trx_lpb where provider_id = '".$this->input->post("id_customer")."' AND lpb_code = '".$this->input->post("nomor")."'");
  		        if($cek->num_rows() != 0){
  		        	$idso = $cek->row()->lpb_id;
  		        	$data['lpb_code'] = $this->input->post("nomor");
                $data['lpb_biaya'] = strToCurrDB($this->input->post("biaya"));
  		        	$data['lpb_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
                $data['lpb_note'] = $this->input->post("note");
  		        	$this->db->where('lpb_id',$idso);
            		$this->db->update("trx_lpb", $data);
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
  			          
  			        $this->db->insert("trx_lpb", $data);

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
            	$this->db->update("trx_lpb_detail", $data2);

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
                $data3['inventory_categories'] = 'stock';
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
  						$this->db->insert("trx_lpb_detail", $data2);            

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
          $data6['id_lpb'] = $idso;
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
          $data7['id_lpb'] = $idso;
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
          $data8['id_lpb'] = $idso;
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
          $data9['id_lpb'] = $idso;
          $data9['provider_id'] = $cus;
          $data9['dateentry'] = date("Y-m-d");
          $data9['userentry'] = $_SESSION['IDUser'];
          $data9['jenis'] = 'uk';
          $data9['nominal'] = '-'.$ttl;
          $this->db->insert("trx_jurnal", $data9);
		    }

        public function saveLPBSM()
          {
            //echo "<pre>";print_r($_POST);"</pre>";exit();
            $cek = $this->db->query("SELECT * from trx_lpb_liquid where provider_id = '".$this->input->post("id_customer")."' AND lpb_liquid_code = '".$this->input->post("nomor")."'");
              if($cek->num_rows() != 0){
                $idso = $cek->row()->lpb_liquid_id;
                $data['lpb_liquid_code'] = $this->input->post("nomor");
                $data['lpb_liquid_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
                $data['lpb_liquid_note'] = $this->input->post("note");
                $this->db->where('lpb_liquid_id',$idso);
                $this->db->update("trx_lpb_liquid", $data);
              } else{
                $data['provider_id'] = $this->input->post("id_customer");
                //$data['purchase_order_liquid_id'] = $this->input->post("po_id");
                $data['lpb_liquid_note'] = $this->input->post("note");
                $data['lpb_liquid_code'] = $this->input->post("nomor");
                $data['lpb_liquid_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
                $data['lpb_liquid_status'] = 'draft';            
                $data['lpb_liquid_date_created'] = date("Y-m-d");
                $data['lpb_liquid_last_updated'] = date("Y-m-d");      
                $data['lpb_liquid_log'] = "insert by dwi";
                $data['lpb_liquid_biaya'] = $this->input->post("biaya");;              
                  
                $this->db->insert("trx_lpb_liquid", $data);

                $idso = $this->db->insert_id();
            }
              $c_kontak = count($this->input->post("id_material"));
            
          for($i=0; $i<$c_kontak;$i++)
          {
            $idp = $_POST['id_material'][$i];
            $idm = $_POST['id_PO'][$i];
            $coba = $this->db->query("SELECT * from trx_lpb_liquid_detail where lpb_liquid_id = '".$idso."' AND material_id = '".$idp."' AND purchase_order_liquid_id = '".$idm."'");
            $iddet = $_POST['iddetail'][$i];          
            if($coba->num_rows() != 0 && $iddet != 0){

              $data2['lpb_liquid_detail_qty'] = $_POST['qty'][$i];
              $data2['lpb_liquid_detail_price'] = strToCurrDB($_POST['nominal'][$i]);
              $data2['lpb_liquid_detail_note'] = $_POST['desc'][$i];
              $data2['lpb_liquid_detail_last_updated'] = date("Y-m-d");
              $this->db->where('lpb_liquid_detail_id',$_POST['iddetail'][$i]);
              $this->db->update("trx_lpb_liquid_detail", $data2);

              $data3['inventory_jumlah_nominal'] = strToCurrDB($_POST['nominal'][$i]);
              $data3['inventory_stock_qty'] = $_POST['qty'][$i];
              $data3['inventory_jenis'] = "in";            
              $data3['inventory_description'] = $_POST['desc'][$i];
              $data3['inventory_log'] = "update by dwi";
              $this->db->where('inventory_id',$coba->row()->inventory_id);
              $this->db->update("trx_inventory", $data3);
            } else{
              $data3['warehouse_id'] = 1;
              $data3['inventory_categories'] = 'stock';
              $data3['material_id'] = $_POST['id_material'][$i];
              $data3['inventory_item_categories'] = 'material';
              $data3['inventory_jumlah_nominal'] = strToCurrDB($_POST['nominal'][$i]);
              $data3['inventory_stock_qty'] = $_POST['qty'][$i];
              $data3['inventory_jenis'] = "in";
              $data3['inventory_date_transaction'] = date("Y-m-d");
              $data3['inventory_date_created'] = date("Y-m-d");
              $data3['inventory_description'] = $_POST['desc'][$i];
              $data3['inventory_log'] = "insert by dwi";
              $this->db->insert("trx_inventory", $data3);

              $idinv = $this->db->insert_id();

              $data2['lpb_liquid_id'] = $idso;
              $data2['inventory_id'] = $idinv;
              $data2['material_id'] = $_POST['id_material'][$i];
              $data2['purchase_order_liquid_id'] = $_POST['id_PO'][$i];
              //$data2['product_id'] = $_POST['id_product'][$i];
              $data2['lpb_liquid_detail_qty'] = $_POST['qty'][$i];
              $data2['lpb_liquid_detail_price'] = strToCurrDB($_POST['nominal'][$i]);
              $data2['lpb_liquid_detail_note'] = $_POST['desc'][$i];
              //$data2['purchase_order_detail_remax'] = $_POST['qty'][$i];
              $data2['lpb_liquid_detail_date_created'] = date("Y-m-d");
              $data2['lpb_liquid_detail_last_updated'] = date("Y-m-d");
              $data2['lpb_liquid_detail_log'] = "insert by dwi";
              $this->db->insert("trx_lpb_liquid_detail", $data2);            

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
          $data6['memo'] = 'LPB Suport '.$profit->row()->provider_name;
          $data6['akun'] = '22001';
          $data6['nobukti'] = $this->input->post("nomor");       
          $data6['id_kategori'] = 1;
          $data6['id_lpb_liquid'] = $idso;
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
          $data7['uraian'] = 'BAHAN PENOLONG';
          $data7['memo'] = 'LPB Suport '.$profit->row()->provider_name;
          $data7['akun'] = '14003';
          $data7['nobukti'] = $this->input->post("nomor");       
          $data7['id_kategori'] = 1;
          $data7['id_lpb_liquid'] = $idso;
          $data6['provider_id'] = $cus;
          $data7['dateentry'] = date("Y-m-d");
          $data7['userentry'] = $_SESSION['IDUser'];
          $data7['jenis'] = 'um';
          $data7['nominal'] = $ttl;
          $this->db->insert("trx_jurnal", $data7);
        }
        public function saveLPBJasa()
          {
            //echo "<pre>";print_r($_POST);"</pre>";exit();            
           $cek = $this->db->query("SELECT * from trx_lpb_jasa where provider_id = '".$this->input->post("id_customer")."' AND lpb_code = '".$this->input->post("nomor")."'");
            if($cek->num_rows() !=0  ){   
            $idso = $cek->row()->lpb_id;
            $data['lpb_code'] = $this->input->post("nomor");
            $data['shipment_id'] = $this->input->post("id_sales");
            $this->db->where('lpb_id',$idso);
            $this->db->update("trx_lpb_jasa",$data);

            }else{

            $data['lpb_code'] = $this->input->post("nomor");
            $data['shipment_id'] = $this->input->post("id_sales");
            $data['provider_id'] = $this->input->post("id_customer");
            $data['lpb_nota'] = $this->input->post("note");
            $data['lpb_date'] = date("Y-m-d", strtotime($this->input->post("tgllpb")));
            $data['nota_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
            
            $this->db->insert("trx_lpb_jasa", $data);
            
            $idso = $this->db->insert_id();

          }
            $c_kontak = count($this->input->post("material"));
          for($i=0; $i<$c_kontak;$i++)
          {
            $data2['lpb_id'] = $idso;
            $data2['material_name'] = $_POST['material'][$i];
            $data2['lpb_detail_qty'] = $_POST['qty'][$i];
            $data2['lpb_detail_price'] = strToCurrDB($_POST['nominal'][$i]);
            $data2['lpb_detail_desc'] = $_POST['desc'][$i];
            $this->db->insert("trx_lpb_jasa_detail", $data2);
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
            $data16['nomor']= 'JU-0001';
          } else if($jml1 < 10){
            $jml_det1 = $jml1+1;
            $data16['nomor']= 'JU-000'.$jml_det1;
          } else if($jml1 < 100){
            $jml_det1 = $jml1+1;
            $data16['nomor']= 'JU-00'.$jml_det1;
          } else if($jml1 < 1000){
            $jml_det1 = $jml1+1;
            $data16['nomor']= 'JU-0'.$jml_det1;
          } else {
            $jml_det1 = $jml1+1;
            $data16['nomor']= 'JU-'.$jml_det1;
          }
          $data16['tgl'] = date("Y-m-d");
          $data16['uraian'] = 'BEBAN EXPORT';
          $data16['memo'] = 'LPB Jasa '.$profit->row()->provider_name;
          $data16['akun'] = '62002';
          $data16['nobukti'] = $this->input->post("nomor");       
          $data16['id_kategori'] = 2;
          $data16['id_lpb_jasa'] = $idso;
          $data16['provider_id'] = $cus;
          $data16['dateentry'] = date("Y-m-d");
          $data16['userentry'] = $_SESSION['IDUser'];
          $data16['jenis'] = 'uk';
          $data16['nominal'] = '-'.$ttl;
          $this->db->insert("trx_jurnal", $data16);

          $jml2 = $jml1+1;
          $jml_det2=0;
          if ($jml2 == 0) {
            $data17['nomor']= 'JU-0001';
          } else if($jml2 < 10){
            $jml_det2 = $jml2+1;
            $data17['nomor']= 'JU-000'.$jml_det2;
          } else if($jml2 < 100){
            $jml_det2 = $jml2+1;
            $data17['nomor']= 'JU-00'.$jml_det2;
          } else if($jml2 < 1000){
            $jml_det2 = $jml2+1;
            $data17['nomor']= 'JU-0'.$jml_det2;
          } else {
            $jml_det2 = $jml2+1;
            $data17['nomor']= 'JU-'.$jml_det2;
          }
          $data17['tgl'] = date("Y-m-d");
          $data17['uraian'] = 'HUTANG USAHA';
          $data17['memo'] = 'LPB Jasa '.$profit->row()->provider_name;
          $data17['akun'] = '22001';
          $data17['nobukti'] = $this->input->post("nomor");       
          $data17['id_kategori'] = 1;
          $data17['id_lpb_jasa'] = $idso;
          $data17['provider_id'] = $cus;
          $data17['dateentry'] = date("Y-m-d");
          $data17['userentry'] = $_SESSION['IDUser'];
          $data17['jenis'] = 'um';
          $data17['nominal'] = $ttl;
          $this->db->insert("trx_jurnal", $data17);          
        }


        public function saveLPBSMBebas()
          {
            //echo "<pre>";print_r($_POST);"</pre>";exit();
            $cek = $this->db->query("SELECT * from trx_lpb_liquid where provider_id = '".$this->input->post("id_customer")."' AND lpb_liquid_code = '".$this->input->post("nomor")."'");
              if($cek->num_rows() != 0){
                $idso = $cek->row()->lpb_liquid_id;
                $data['lpb_liquid_code'] = $this->input->post("nomor");
                $data['lpb_liquid_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
                $data['lpb_liquid_note'] = $this->input->post("note");
                $data['lpb_liquid_biaya'] = strToCurrDB($this->input->post("biaya"));
                $this->db->where('lpb_liquid_id',$idso);
                $this->db->update("trx_lpb_liquid", $data);
              } else{
                $data['provider_id'] = 200;
                //$data['purchase_order_liquid_id'] = $this->input->post("po_id");
                $data['lpb_liquid_code'] = $this->input->post("nomor");
                $data['lpb_liquid_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
                $data['lpb_liquid_status'] = 'draft'; 
                $data['lpb_liquid_note'] = $this->input->post("note");           
                $data['lpb_liquid_date_created'] = date("Y-m-d");
                $data['lpb_liquid_last_updated'] = date("Y-m-d");      
                $data['lpb_liquid_log'] = "insert by dwi";
                $data['lpb_liquid_biaya'] = strToCurrDB($this->input->post("biaya"));              
                  
                $this->db->insert("trx_lpb_liquid", $data);

                $idso = $this->db->insert_id();
            }
              $c_kontak = count($this->input->post("id_material"));
            
          for($i=0; $i<$c_kontak;$i++)
          {
            $idp = $_POST['id_material'][$i];
            $coba = $this->db->query("SELECT * from trx_lpb_liquid_detail where lpb_liquid_id = '".$idso."' AND material_id = '".$idp."'");
            $iddet = $_POST['iddetail'][$i];          
            if($coba->num_rows() != 0 && $iddet != 0){

              $data2['lpb_liquid_detail_qty'] = $_POST['qty'][$i];
              $data2['lpb_liquid_detail_price'] = strToCurrDB($_POST['nominal'][$i]);
              $data2['lpb_liquid_detail_note'] = $_POST['desc'][$i];
              $data2['lpb_liquid_detail_last_updated'] = date("Y-m-d");
              $this->db->where('lpb_liquid_detail_id',$_POST['iddetail'][$i]);
              $this->db->update("trx_lpb_liquid_detail", $data2);

              $data3['inventory_jumlah_nominal'] = strToCurrDB($_POST['nominal'][$i]);
              $data3['inventory_stock_qty'] = $_POST['qty'][$i];
              $data3['inventory_jenis'] = "in";            
              $data3['inventory_description'] = $_POST['desc'][$i];
              $data3['inventory_log'] = "update by dwi";
              $this->db->where('inventory_id',$coba->row()->inventory_id);
              $this->db->update("trx_inventory", $data3);
            } else{
              $data3['warehouse_id'] = 1;
              $data3['inventory_categories'] = 'stock';
              $data3['material_id'] = $_POST['id_material'][$i];
              $data3['inventory_item_categories'] = 'material';
              $data3['inventory_jumlah_nominal'] = strToCurrDB($_POST['nominal'][$i]);
              $data3['inventory_stock_qty'] = $_POST['qty'][$i];
              $data3['inventory_jenis'] = "in";
              $data3['inventory_date_transaction'] = date("Y-m-d");
              $data3['inventory_date_created'] = date("Y-m-d");
              $data3['inventory_description'] = $_POST['desc'][$i];
              $data3['inventory_log'] = "insert by dwi";
              $this->db->insert("trx_inventory", $data3);

              $idinv = $this->db->insert_id();

              $data2['lpb_liquid_id'] = $idso;
              $data2['inventory_id'] = $idinv;
              $data2['material_id'] = $_POST['id_material'][$i];
              $data2['purchase_order_liquid_id'] = 0;
              //$data2['product_id'] = $_POST['id_product'][$i];
              $data2['lpb_liquid_detail_qty'] = $_POST['qty'][$i];
              $data2['lpb_liquid_detail_price'] = strToCurrDB($_POST['nominal'][$i]);
              $data2['lpb_liquid_detail_note'] = $_POST['desc'][$i];
              //$data2['purchase_order_detail_remax'] = $_POST['qty'][$i];
              $data2['lpb_liquid_detail_date_created'] = date("Y-m-d");
              $data2['lpb_liquid_detail_last_updated'] = date("Y-m-d");
              $data2['lpb_liquid_detail_log'] = "insert by dwi";
              $this->db->insert("trx_lpb_liquid_detail", $data2);            

            }
          }
          $cus = 200;
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
          $data6['memo'] = 'LPB Suport '.$profit->row()->provider_name;
          $data6['akun'] = '22001';
          $data6['nobukti'] = $this->input->post("nomor");       
          $data6['id_kategori'] = 1;
          $data6['id_lpb_liquid'] = $idso;
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
          $data7['uraian'] = 'BAHAN PENOLONG';
          $data7['memo'] = 'LPB Suport '.$profit->row()->provider_name;
          $data7['akun'] = '14003';
          $data7['nobukti'] = $this->input->post("nomor");       
          $data7['id_kategori'] = 1;
          $data7['id_lpb_liquid'] = $idso;
          $data6['provider_id'] = $cus;
          $data7['dateentry'] = date("Y-m-d");
          $data7['userentry'] = $_SESSION['IDUser'];
          $data7['jenis'] = 'um';
          $data7['nominal'] = $ttl;
          $this->db->insert("trx_jurnal", $data7);
        }

        public function saveLPBUmum()
          {
            //echo "<pre>";print_r($_POST);"</pre>";exit();            
            $data['lpb_biaya'] = strToCurrDB($this->input->post("biaya"));
            $data['lpb_code'] = $this->input->post("nomor");
            $data['toko'] = $this->input->post("toko");
            $data['lpb_nota'] = $this->input->post("note");
            $data['lpb_date'] = date("Y-m-d", strtotime($this->input->post("tgllpb")));
            $data['nota_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
            $this->db->insert("trx_lpb_umum", $data);
            $idso = $this->db->insert_id();
            $c_kontak = count($this->input->post("material"));
          for($i=0; $i<$c_kontak;$i++)
          {
            $data2['lpb_id'] = $idso;
            $data2['material_name'] = $_POST['material'][$i];
            $data2['lpb_detail_qty'] = $_POST['qty'][$i];
            $data2['lpb_detail_price'] = strToCurrDB($_POST['nominal'][$i]);
            $data2['lpb_detail_desc'] = $_POST['desc'][$i];
            $this->db->insert("trx_lpb_umum_detail", $data2);
          }

          $cus = 200;
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
          $data6['tgl'] = date("Y-m-d");
          $data6['uraian'] = 'HUTANG USAHA';
          $data6['memo'] = 'LPB Suport '.$profit->row()->provider_name;
          $data6['akun'] = '22001';
          $data6['nobukti'] = $this->input->post("nomor");       
          $data6['id_kategori'] = 1;
          $data6['id_lpb_umum'] = $idso;
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
          $data7['uraian'] = 'DUMMY';
          $data7['memo'] = 'LPB Suport '.$profit->row()->provider_name;
          $data7['akun'] = '99998';
          $data7['nobukti'] = $this->input->post("nomor");       
          $data7['id_kategori'] = 2;
          $data7['id_lpb_umum'] = $idso;
          $data6['provider_id'] = $cus;
          $data7['dateentry'] = date("Y-m-d");
          $data7['userentry'] = $_SESSION['IDUser'];
          $data7['jenis'] = 'uk';
          $data7['nominal'] = '-'.$ttl;
          $this->db->insert("trx_jurnal", $data7);          
        }

        public function updateLPBUmum()
          {
            //echo "<pre>";print_r($_POST);"</pre>";exit(); 
            $idso = $this->input->post("lpb_id");    
            $data['lpb_biaya'] = strToCurrDB($this->input->post("biaya"));
            $data['lpb_code'] = $this->input->post("nomor");
            $data['toko'] = $this->input->post("toko");
            $data['lpb_nota'] = $this->input->post("note");
            $data['lpb_date'] = date("Y-m-d", strtotime($this->input->post("tgllpb")));
            $data['nota_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
            $this->db->where('lpb_id',$idso);
            $this->db->update("trx_lpb_umum", $data);
            $c_kontak = count($this->input->post("material"));
          for($i=0; $i<$c_kontak;$i++)
          {
            $idDet = $_POST['iddetail'][$i];
            if($idDet != 0){
              $data2['lpb_id'] = $idso;
              $data2['material_name'] = $_POST['material'][$i];
              $data2['lpb_detail_qty'] = $_POST['qty'][$i];
              $data2['lpb_detail_price'] = strToCurrDB($_POST['nominal'][$i]);
              $data2['lpb_detail_desc'] = $_POST['desc'][$i];
              $this->db->where('lpb_detail_id',$idDet);
              $this->db->update("trx_lpb_umum_detail", $data2);
            }else {
              $data2['lpb_id'] = $idso;
              $data2['material_name'] = $_POST['material'][$i];
              $data2['lpb_detail_qty'] = $_POST['qty'][$i];
              $data2['lpb_detail_price'] = strToCurrDB($_POST['nominal'][$i]);
              $data2['lpb_detail_desc'] = $_POST['desc'][$i];
              $this->db->insert("trx_lpb_umum_detail", $data2);
            }
          }
          $ttl = strToCurrDB($this->input->post("total"));
          $data7['nominal'] = $ttl;
          $this->db->where('id_lpb_umum',$idso);
          $this->db->where('akun','22001');
          $this->db->update("trx_jurnal", $data7);

          $data8['nominal'] = '-'.$ttl;
          $this->db->where('id_lpb_umum',$idso);
          $this->db->where('akun','99998');
          $this->db->update("trx_jurnal", $data8);
          
        }

        public function updateLPB()
          {
            //echo "<pre>";print_r($_POST);"</pre>";exit();
            $cek = $this->db->query("SELECT * from trx_lpb where provider_id = '".$this->input->post("id_customer")."' AND lpb_code = '".$this->input->post("nomor")."'");
              if($cek->num_rows() != 0){
                $idso = $cek->row()->lpb_id;
                $data['lpb_code'] = $this->input->post("nomor");
                $data['lpb_biaya'] = strToCurrDB($this->input->post("biaya"));
                $data['lpb_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
                $data['lpb_note'] = $this->input->post("note");
                $this->db->where('lpb_id',$idso);
                $this->db->update("trx_lpb", $data);
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
                  
                $this->db->insert("trx_lpb", $data);

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
              $this->db->update("trx_lpb_detail", $data2);

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
                $data3['inventory_categories'] = 'stock';
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
              $this->db->insert("trx_lpb_detail", $data2);            

            }
          }
          $ttl = strToCurrDB($this->input->post("total"));                    
          $data6['nominal'] = $ttl;
          $this->db->where('id_lpb',$idso);
          $this->db->where('jenis','um');
          $this->db->update("trx_jurnal", $data6);

          $data7['nominal'] = '-'.$ttl;
          $this->db->where('id_lpb',$idso);
          $this->db->where('jenis','uk');
          $this->db->update("trx_jurnal", $data7);          
        }

        public function updateLPBSM()
          {
            //echo "<pre>";print_r($_POST);"</pre>";exit();
            $cek = $this->db->query("SELECT * from trx_lpb_liquid where provider_id = '".$this->input->post("id_customer")."' AND lpb_liquid_code = '".$this->input->post("nomor")."'");
              if($cek->num_rows() != 0){
                $idso = $cek->row()->lpb_liquid_id;
                $data['lpb_liquid_code'] = $this->input->post("nomor");
                $data['lpb_liquid_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
                $data['lpb_liquid_note'] = $this->input->post("note");
                $this->db->where('lpb_liquid_id',$idso);
                $this->db->update("trx_lpb_liquid", $data);
              } else{
                $data['provider_id'] = $this->input->post("id_customer");
                //$data['purchase_order_liquid_id'] = $this->input->post("po_id");
                $data['lpb_liquid_code'] = $this->input->post("nomor");
                $data['lpb_liquid_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
                $data['lpb_liquid_status'] = 'draft';            
                $data['lpb_liquid_date_created'] = date("Y-m-d");
                $data['lpb_liquid_last_updated'] = date("Y-m-d");      
                $data['lpb_liquid_log'] = "insert by dwi";
                $data['lpb_liquid_biaya'] = $this->input->post("biaya");;              
                  
                $this->db->insert("trx_lpb_liquid", $data);

                $idso = $this->db->insert_id();
            }
              $c_kontak = count($this->input->post("id_material"));
            
          for($i=0; $i<$c_kontak;$i++)
          {
            $idp = $_POST['id_material'][$i];
            $idm = $_POST['id_PO'][$i];
            $coba = $this->db->query("SELECT * from trx_lpb_liquid_detail where lpb_liquid_id = '".$idso."' AND material_id = '".$idp."' AND purchase_order_liquid_id = '".$idm."'");
            $iddet = $_POST['iddetail'][$i];          
            if($coba->num_rows() != 0 && $iddet != 0){

              $data2['lpb_liquid_detail_qty'] = $_POST['qty'][$i];
              $data2['lpb_liquid_detail_price'] = strToCurrDB($_POST['nominal'][$i]);
              $data2['lpb_liquid_detail_note'] = $_POST['desc'][$i];
              $data2['lpb_liquid_detail_last_updated'] = date("Y-m-d");
              $this->db->where('lpb_liquid_detail_id',$_POST['iddetail'][$i]);
              $this->db->update("trx_lpb_liquid_detail", $data2);

              $data3['inventory_jumlah_nominal'] = strToCurrDB($_POST['nominal'][$i]);
              $data3['inventory_stock_qty'] = $_POST['qty'][$i];
              $data3['inventory_jenis'] = "in";            
              $data3['inventory_description'] = $_POST['desc'][$i];
              $data3['inventory_log'] = "update by dwi";
              $this->db->where('inventory_id',$coba->row()->inventory_id);
              $this->db->update("trx_inventory", $data3);
            } else{
              $data3['warehouse_id'] = 1;
              $data3['inventory_categories'] = 'stock';
              $data3['material_id'] = $_POST['id_material'][$i];
              $data3['inventory_item_categories'] = 'material';
              $data3['inventory_jumlah_nominal'] = strToCurrDB($_POST['nominal'][$i]);
              $data3['inventory_stock_qty'] = $_POST['qty'][$i];
              $data3['inventory_jenis'] = "in";
              $data3['inventory_date_transaction'] = date("Y-m-d");
              $data3['inventory_date_created'] = date("Y-m-d");
              $data3['inventory_description'] = $_POST['desc'][$i];
              $data3['inventory_log'] = "insert by dwi";
              $this->db->insert("trx_inventory", $data3);

              $idinv = $this->db->insert_id();

              $data2['lpb_liquid_id'] = $idso;
              $data2['inventory_id'] = $idinv;
              $data2['material_id'] = $_POST['id_material'][$i];
              $data2['purchase_order_liquid_id'] = $_POST['id_PO'][$i];
              //$data2['product_id'] = $_POST['id_product'][$i];
              $data2['lpb_liquid_detail_qty'] = $_POST['qty'][$i];
              $data2['lpb_liquid_detail_price'] = strToCurrDB($_POST['nominal'][$i]);
              $data2['lpb_liquid_detail_note'] = $_POST['desc'][$i];
              //$data2['purchase_order_detail_remax'] = $_POST['qty'][$i];
              $data2['lpb_liquid_detail_date_created'] = date("Y-m-d");
              $data2['lpb_liquid_detail_last_updated'] = date("Y-m-d");
              $data2['lpb_liquid_detail_log'] = "insert by dwi";
              $this->db->insert("trx_lpb_liquid_detail", $data2);            

            }
          }
          
          $ttl = strToCurrDB($this->input->post("total"));                    
          $data6['nominal'] = $ttl;
          $this->db->where('id_lpb_liquid',$idso);
          $this->db->update("trx_jurnal", $data6);
        }
        public function updateLPBJasa()
          {
            //echo "<pre>";print_r($_POST);"</pre>";exit(); 
             //echo "<pre>";print_r($_POST);"</pre>";exit(); 
           $cek = $this->db->query("SELECT * from trx_lpb_jasa where provider_id = '".$this->input->post("id_customer")."' AND lpb_code = '".$this->input->post("nomor")."'");
            if($cek->num_rows()  !=0 ){
            $idso = $cek->row()->lpb_id;
            $data['lpb_code'] = $this->input->post("nomor");
            $data['provider_id'] = $this->input->post("id_customer");
            //$data['provider_id'] = $this->input->post("id_customer");
            $data['shipment_id'] = $this->input->post("id_sales");

            $data['lpb_nota'] = $this->input->post("note");
            $data['lpb_date'] = date("Y-m-d", strtotime($this->input->post("tgllpb")));
            $data['nota_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
            $this->db->where('lpb_id',$idso);
            $this->db->update("trx_lpb_jasa", $data);

          } else {


            $data['lpb_code'] = $this->input->post("nomor");
            $data['shipment_id'] = $this->input->post("id_sales");
            $data['provider_id'] = $this->input->post("id_customer");
            $data['lpb_nota'] = $this->input->post("note");
            $data['lpb_date'] = date("Y-m-d", strtotime($this->input->post("tgllpb")));
            $data['nota_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
            
            $this->db->insert("trx_lpb_jasa", $data);
            $idso = $this->db->insert_id();

          }
            $c_kontak = count($this->input->post("material"));
          for($i=0; $i<$c_kontak;$i++)
          {
            $idDet = $_POST['iddetail'][$i];
            if($idDet != 0){
              $data2['lpb_id'] = $idso;
              $data2['material_name'] = $_POST['material'][$i];
              $data2['lpb_detail_qty'] = $_POST['qty'][$i];
              $data2['lpb_detail_price'] = strToCurrDB($_POST['nominal'][$i]);
              $data2['lpb_detail_desc'] = $_POST['desc'][$i];
              $this->db->where('lpb_detail_id',$idDet);
              $this->db->update("trx_lpb_jasa_detail", $data2);
            }else {
              $data2['lpb_id'] = $idso;
              $data2['material_name'] = $_POST['material'][$i];
              $data2['lpb_detail_qty'] = $_POST['qty'][$i];
              $data2['lpb_detail_price'] = strToCurrDB($_POST['nominal'][$i]);
              $data2['lpb_detail_desc'] = $_POST['desc'][$i];
              $this->db->insert("trx_lpb_jasa_detail", $data2);
            }
          }
          $ttl = strToCurrDB($this->input->post("total"));
          $data7['nominal'] = $ttl;
          $this->db->where('id_lpb_jasa',$idso);
          $this->db->where('akun','62002');
          $this->db->update("trx_jurnal", $data7);

          $data8['nominal'] = '-'.$ttl;
          $this->db->where('id_lpb_jasa',$idso);
          $this->db->where('akun','22001');
          $this->db->update("trx_jurnal", $data8);
          
        }

        public function updateLPBSMBebas()
          {
            //echo "<pre>";print_r($_POST);"</pre>";exit();
            $cek = $this->db->query("SELECT * from trx_lpb_liquid where provider_id = 200 AND lpb_liquid_code = '".$this->input->post("nomor")."'");
              if($cek->num_rows() != 0){
                $idso = $cek->row()->lpb_liquid_id;
                $data['lpb_liquid_code'] = $this->input->post("nomor");
                $data['lpb_liquid_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
                $data['lpb_liquid_note'] = $this->input->post("note");
                $this->db->where('lpb_liquid_id',$idso);
                $this->db->update("trx_lpb_liquid", $data);
              } else{
                $data['provider_id'] = $this->input->post("id_customer");
                //$data['purchase_order_liquid_id'] = $this->input->post("po_id");
                $data['lpb_liquid_code'] = $this->input->post("nomor");
                $data['lpb_liquid_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
                $data['lpb_liquid_status'] = 'draft';            
                $data['lpb_liquid_date_created'] = date("Y-m-d");
                $data['lpb_liquid_last_updated'] = date("Y-m-d");      
                $data['lpb_liquid_log'] = "insert by dwi";
                $data['lpb_liquid_biaya'] = $this->input->post("biaya");;              
                  
                $this->db->insert("trx_lpb_liquid", $data);

                $idso = $this->db->insert_id();
            }
              $c_kontak = count($this->input->post("id_material"));
            
          for($i=0; $i<$c_kontak;$i++)
          {
            $idp = $_POST['id_material'][$i];
            $idm = $_POST['id_PO'][$i];
            $coba = $this->db->query("SELECT * from trx_lpb_liquid_detail where lpb_liquid_id = '".$idso."' AND material_id = '".$idp."'");
            $iddet = $_POST['iddetail'][$i];          
            if($coba->num_rows() != 0 && $iddet != 0){

              $data2['lpb_liquid_detail_qty'] = $_POST['qty'][$i];
              $data2['lpb_liquid_detail_price'] = strToCurrDB($_POST['nominal'][$i]);
              $data2['lpb_liquid_detail_note'] = $_POST['desc'][$i];
              $data2['lpb_liquid_detail_last_updated'] = date("Y-m-d");
              $this->db->where('lpb_liquid_detail_id',$_POST['iddetail'][$i]);
              $this->db->update("trx_lpb_liquid_detail", $data2);

              $data3['inventory_jumlah_nominal'] = strToCurrDB($_POST['nominal'][$i]);
              $data3['inventory_stock_qty'] = $_POST['qty'][$i];
              $data3['inventory_jenis'] = "in";            
              $data3['inventory_description'] = $_POST['desc'][$i];
              $data3['inventory_log'] = "update by dwi";
              $this->db->where('inventory_id',$coba->row()->inventory_id);
              $this->db->update("trx_inventory", $data3);
            } else{
              $data3['warehouse_id'] = 1;
              $data3['inventory_categories'] = 'stock';
              $data3['material_id'] = $_POST['id_material'][$i];
              $data3['inventory_item_categories'] = 'material';
              $data3['inventory_jumlah_nominal'] = strToCurrDB($_POST['nominal'][$i]);
              $data3['inventory_stock_qty'] = $_POST['qty'][$i];
              $data3['inventory_jenis'] = "in";
              $data3['inventory_date_transaction'] = date("Y-m-d");
              $data3['inventory_date_created'] = date("Y-m-d");
              $data3['inventory_description'] = $_POST['desc'][$i];
              $data3['inventory_log'] = "insert by dwi";
              $this->db->insert("trx_inventory", $data3);

              $idinv = $this->db->insert_id();

              $data2['lpb_liquid_id'] = $idso;
              $data2['inventory_id'] = $idinv;
              $data2['material_id'] = $_POST['id_material'][$i];
              //$data2['purchase_order_liquid_id'] = $_POST['id_PO'][$i];
              //$data2['product_id'] = $_POST['id_product'][$i];
              $data2['lpb_liquid_detail_qty'] = $_POST['qty'][$i];
              $data2['lpb_liquid_detail_price'] = strToCurrDB($_POST['nominal'][$i]);
              $data2['lpb_liquid_detail_note'] = $_POST['desc'][$i];
              //$data2['purchase_order_detail_remax'] = $_POST['qty'][$i];
              $data2['lpb_liquid_detail_date_created'] = date("Y-m-d");
              $data2['lpb_liquid_detail_last_updated'] = date("Y-m-d");
              $data2['lpb_liquid_detail_log'] = "insert by dwi";
              $this->db->insert("trx_lpb_liquid_detail", $data2);            

            }
          }
          
          $ttl = strToCurrDB($this->input->post("total"));                    
          $data6['nominal'] = $ttl;
          $this->db->where('id_lpb_liquid',$idso);
          $this->db->update("trx_jurnal", $data6);
        }

		    public function GetDaftarLpb()
		    {
		      $this->checkCredentialAccess();

		            $this->checkIsAjaxRequest();
		            
		            $this->load->model("lpb_model", "ModelRaw");
		            
		            echo $this->ModelRaw->GetDaftarLpb(); 
		    }

        public function GetDaftarInv()
        {
          $this->checkCredentialAccess();

                $this->checkIsAjaxRequest();
                
                $this->load->model("lpb_model", "ModelRaw");
                
                echo $this->ModelRaw->GetDaftarInv(); 
        }

        public function GetDaftarInvGudang()
        {
          $this->checkCredentialAccess();

                $this->checkIsAjaxRequest();
                
                $this->load->model("lpb_model", "ModelRaw");
                
                echo $this->ModelRaw->GetDaftarInvGudang(); 
        }

        public function GetDaftarInvDet()
        {
          $this->checkCredentialAccess();

                $this->checkIsAjaxRequest();
                
                $this->load->model("lpb_model", "ModelRaw");
                
                echo $this->ModelRaw->GetDaftarInvDet(); 
        }

        public function GetDaftarInvSm()
        {
          $this->checkCredentialAccess();

                $this->checkIsAjaxRequest();
                
                $this->load->model("lpb_model", "ModelRaw");
                
                echo $this->ModelRaw->GetDaftarInvSm(); 
        }

        public function GetDaftarInvDetSm()
        {
          $this->checkCredentialAccess();

                $this->checkIsAjaxRequest();
                
                $this->load->model("lpb_model", "ModelRaw");
                
                echo $this->ModelRaw->GetDaftarInvDetSm(); 
        }

        
        public function GetDaftarLpbSm()
        {
          $this->checkCredentialAccess();

                $this->checkIsAjaxRequest();
                
                $this->load->model("lpb_model", "ModelRaw");
                
                echo $this->ModelRaw->GetDaftarLpbSm(); 
        }

        public function GetDaftarLpbJasa()
        {
          $this->checkCredentialAccess();

                $this->checkIsAjaxRequest();
                
                $this->load->model("lpb_model", "ModelRaw");
                
                echo $this->ModelRaw->GetDaftarLpbJasa(); 
        }



        public function GetDaftarLpbUmum()
        {
          $this->checkCredentialAccess();

                $this->checkIsAjaxRequest();
                
                $this->load->model("lpb_model", "ModelRaw");
                
                echo $this->ModelRaw->GetDaftarLpbUmum(); 
        }

		    public function HapusLpbRaw()
		    {
		      $this->checkCredentialAccess();

		            $this->checkIsAjaxRequest();

		      $idx = $this->input->post('ID');
		      
		      $idx =   $this->input->post('ID');
          $cek = $this->db->query("SELECT * from trx_lpb_detail where lpb_id = '".$idx."'");
		      $this->db->delete('trx_lpb_detail', array('lpb_id' => $idx));
		      $this->db->delete('trx_lpb', array('lpb_id' => $idx));
          $this->db->delete('trx_jurnal', array('id_lpb' => $idx));
          foreach ($cek->result() as $row) {
            $this->db->delete('trx_inventory', array('inventory_id' => $row->inventory_id));
          }
		       
		      
		    }

        public function HapusLpbSm()
        {
          $this->checkCredentialAccess();

                $this->checkIsAjaxRequest();

          //$idx = $this->input->post('ID');
          
          $idx =   $this->input->post('ID');
          $provit = $this->db->query("SELECT sum(lpb_liquid_detail_qty*lpb_liquid_detail_price) as jml from trx_lpb_liquid_detail where lpb_liquid_id ='".$idx."'")->row();
          $cek = $this->db->query("SELECT * from trx_lpb_liquid_detail where lpb_liquid_id = '".$idx."'");
          $provider = $this->db->query("SELECT mst_provider.* from trx_lpb_liquid inner join mst_provider on mst_provider.provider_id = trx_lpb_liquid.provider_id where lpb_liquid_id = '".$idx."'")->row();
          $this->db->delete('trx_lpb_liquid_detail', array('lpb_liquid_id' => $idx));
          $this->db->delete('trx_lpb_liquid', array('lpb_liquid_id' => $idx));
          $this->db->delete('trx_jurnal', array('id_lpb_liquid' => $idx));
          foreach ($cek->result() as $row) {
            $this->db->delete('trx_inventory', array('inventory_id' => $row->inventory_id));
          }
          $total = $provider->provider_hutang - $provit->jml;
          $data4['provider_hutang'] = $total;
          $this->db->where('provider_id',$provider->provider_id);
          $this->db->update("mst_provider", $data4);           
          
        }
        public function HapusLpbJasa()
          {
            $this->checkCredentialAccess();
            $this->checkIsAjaxRequest();

            $idx = $this->input->post('ID');
            

            $this->db->delete('trx_lpb_jasa', array('lpb_id' => $idx));
            $this->db->delete('trx_lpb_jasa_detail', array('lpb_id' => $idx));
            $this->db->delete('trx_jurnal', array('id_lpb_jasa' => $idx));

          }

        public function HapusLpbUmum()
        {
          $this->checkCredentialAccess();

                $this->checkIsAjaxRequest();

          $idx = $this->input->post('ID');         
         
          $this->db->delete('trx_lpb_umum', array('lpb_id' => $idx));
          $this->db->delete('trx_umum_detail', array('lpb_id' => $idx));
          $this->db->delete('trx_jurnal', array('id_lpb_umum' => $idx));
                     
          
        }

		    public function habusdataRaw()
		    {
		      $this->checkCredentialAccess();

		      $this->checkIsAjaxRequest();

		      $idx =   $this->input->post('ID');
          $idv =   $this->input->post('IDV');
		      $this->db->delete('trx_lpb_detail', array('lpb_detail_id' => $idx));
          $this->db->delete('trx_inventory', array('inventory_id' => $idv));		      
		      
		    }

        public function habusdataSm()
        {
          $this->checkCredentialAccess();

          $this->checkIsAjaxRequest();

          $idx =   $this->input->post('ID');
          $idv =   $this->input->post('IDV');
          $this->db->delete('trx_lpb_liquid_detail', array('lpb_liquid_detail_id' => $idx));
          $this->db->delete('trx_inventory', array('inventory_id' => $idv));          
          
        }

		    public function adddataSM()
		    {
            $data3['warehouse_id'] = 1;
            $data3['inventory_categories'] = 'stock';
            $data3['material_id'] = $this->input->post("mat_id");
            $data3['inventory_item_categories'] = 'material';
            $data3['inventory_jumlah_nominal'] = strToCurrDB($this->input->post("price"));
            $data3['inventory_stock_qty'] = $this->input->post("qty");
            $data3['inventory_jenis'] = "in";
            $data3['inventory_date_transaction'] = date("Y-m-d");
            $data3['inventory_date_created'] = date("Y-m-d");
            $data3['inventory_description'] = '';
            $data3['inventory_log'] = "insert by dwi";
            $this->db->insert("trx_inventory", $data3);

            $idinv = $this->db->insert_id();

		        $data2['lpb_liquid_id'] = $this->input->post("lpb_id");
            $data2['inventory_id'] = $idinv;
            $data2['material_id'] = $this->input->post("mat_id");
            $data2['purchase_order_liquid_id'] = $this->input->post("PO_ID");
            //$data2['product_id'] = $_POST['id_product'][$i];
            $data2['lpb_liquid_detail_qty'] = $this->input->post("qty");
            $data2['lpb_liquid_detail_price'] = strToCurrDB($this->input->post("price"));
            $data2['lpb_liquid_detail_note'] = '';
            //$data2['purchase_order_detail_remax'] = $_POST['qty'][$i];
            $data2['lpb_liquid_detail_date_created'] = date("Y-m-d");
            $data2['lpb_liquid_detail_last_updated'] = date("Y-m-d");
            $data2['lpb_liquid_detail_log'] = "insert by dwi";
            $this->db->insert("trx_lpb_liquid_detail", $data2);	      
		      
		    }

        public function adddataSMBebas()
        {
            $data3['warehouse_id'] = 1;
            $data3['inventory_categories'] = 'stock';
            $data3['material_id'] = $this->input->post("mat_id");
            $data3['inventory_item_categories'] = 'material';
            $data3['inventory_jumlah_nominal'] = strToCurrDB($this->input->post("price"));
            $data3['inventory_stock_qty'] = 0;
            $data3['inventory_jenis'] = "in";
            $data3['inventory_date_transaction'] = date("Y-m-d");
            $data3['inventory_date_created'] = date("Y-m-d");
            $data3['inventory_description'] = '';
            $data3['inventory_log'] = "insert by dwi";
            $this->db->insert("trx_inventory", $data3);

            $idinv = $this->db->insert_id();

            $data2['lpb_liquid_id'] = $this->input->post("lpb_id");
            $data2['inventory_id'] = $idinv;
            $data2['material_id'] = $this->input->post("mat_id");
            $data2['purchase_order_liquid_id'] = 0;
            //$data2['product_id'] = $_POST['id_product'][$i];
            $data2['lpb_liquid_detail_qty'] = 0;
            $data2['lpb_liquid_detail_price'] = strToCurrDB($this->input->post("price"));
            $data2['lpb_liquid_detail_note'] = '';
            //$data2['purchase_order_detail_remax'] = $_POST['qty'][$i];
            $data2['lpb_liquid_detail_date_created'] = date("Y-m-d");
            $data2['lpb_liquid_detail_last_updated'] = date("Y-m-d");
            $data2['lpb_liquid_detail_log'] = "insert by dwi";
            $this->db->insert("trx_lpb_liquid_detail", $data2);       
          
        }

        public function adddataRaw()
        {
            $data3['warehouse_id'] = 1;
            $data3['inventory_categories'] = 'wip';
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
            $data2['lpb_detail_price'] = strToCurrDB($this->input->post("price"));
            $data2['lpb_detail_note'] = '';
            $data2['purchase_order_id'] = $this->input->post("PO");
            //$data2['purchase_order_detail_remax'] = $_POST['qty'][$i];
            $data2['lpb_detail_date_created'] = date("Y-m-d");
            $data2['lpb_detail_last_updated'] = date("Y-m-d");
            $data2['lpb_detail_log'] = "insert by dwi";
            $this->db->insert("trx_lpb_detail", $data2);          
          
        }

        public function saveinventory()
        {
            //echo "<pre>";print_r($_POST);"</pre>";exit();
            $data3['warehouse_id'] = 1;
            $data3['inventory_categories'] = $this->input->post("categories");
            $data3['material_id'] = $this->input->post("idmaterial");
            $data3['inventory_item_categories'] = $this->input->post("item");
            $data3['inventory_jumlah_nominal'] = strToCurrDB($this->input->post("price"));
            $data3['inventory_stock_qty'] = $this->input->post("qty");
            $data3['inventory_jenis'] = $this->input->post("jenis");
            $data3['inventory_date_transaction'] = date("Y-m-d");
            $data3['inventory_date_created'] = date("Y-m-d");
            $data3['inventory_description'] = $this->input->post("note");
            $data3['inventory_mode'] = 'public';
            $data3['inventory_log'] = "insert by dwi";
            $this->db->insert("trx_inventory", $data3); 

            $idinv = $this->db->insert_id();

            $data2['inventory_id'] = $idinv;
            $data2['jenis'] = $this->input->post("group");
            $data2['return_code'] = $this->input->post("nomor");
            $data2['return_note'] = $this->input->post("note");
            $data2['material_id'] = $this->input->post("idmaterial");
            $data2['qty'] = $this->input->post("qty");
            $data2['date'] = date("Y-m-d");
            $this->db->insert("trx_issued_return", $data2); 
          
        }

        public function updateinventory()
        {
            //echo "<pre>";print_r($_POST);"</pre>";exit();
            $data3['warehouse_id'] = 1;
            $data3['inventory_categories'] = $this->input->post("categories");
            $data3['material_id'] = $this->input->post("idmaterial");
            $data3['inventory_item_categories'] = $this->input->post("item");
            $data3['inventory_jumlah_nominal'] = strToCurrDB($this->input->post("price"));
            $data3['inventory_stock_qty'] = $this->input->post("qty");
            $data3['inventory_jenis'] = $this->input->post("jenis");
            $data3['inventory_description'] = $this->input->post("note");
            $data3['inventory_mode'] = 'public';
            $data3['inventory_log'] = "update by dwi";
            $this->db->where('inventory_id',$this->input->post("idv"));
            $this->db->update("trx_inventory", $data3);

            $data2['jenis'] = $this->input->post("group");
            $data2['return_code'] = $this->input->post("nomor");
            $data2['return_note'] = $this->input->post("note");
            $data2['material_id'] = $this->input->post("idmaterial");
            $data2['qty'] = $this->input->post("qty"); 
            $this->db->where('inventory_id',$this->input->post("idv"));
            $this->db->update("trx_issued_return", $data2);                     
          
        }

}

/* End of fiel Utility.php */
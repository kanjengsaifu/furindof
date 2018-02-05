<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

	class Gudang extends MY_Controller {    
	  	

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
	        $this->load->model('gudang_model', 'ModelAdmin');
	        $dataMenu = array('dataMenu' => $this->ModelAdmin->GetMenuAdmin());

	        $menu 	  = $this->load->view('menu_gudang_view', $dataMenu, true);
	        $content  = $this->load->view('dashboard_view', '', true);
	        //$content  = $this->load->view('admin_view', '', true);

	        $arrData = array('menu' 	=> $menu,	        				 
	        			   	 'content'  => $content);

	        echo json_encode($arrData);
		}

    function ajax_lookUpIssued(){

        $code = $this->input->post('code');
        $this->db->where('issued_code', $code);
        $query = $this->db->get('trx_issued');
        if ($query->num_rows() > 0){
           echo 0;
        } else {
           echo 1;
        }
    }	

		public function issued()
		{
			
           	$this->load->view('master_issued_view');                

           
		} 

    public function Ajustment()
    {
      $cek = $this->db->query("SELECT return_code from trx_issued_return order by return_code DESC");

      if ($cek->num_rows()==0) {
        $data['ajs'] = 'AJS0000';
      }else{
        $data['ajs'] = $cek->row()->return_code;
      }
      
      $this->load->view('master_return_view',$data); 
           
    }  

    public function Inventory_gudang_sm()
    {
      
            $this->load->view('master_inv_gudang_view');                

           
    }
	   	
	   	public function tambah_issued()
		{
			
           	$this->load->view('tambah_issued_view');                

           
		} 

    public function Detail_lpb_sm()
    {
      $content = $this->load->view('detail_lpb_sm', '', true);                          

            echo $content;
    }

    public function Detail_bom()
    {
      $content = $this->load->view('detail_bom_view', '', true);                          

            echo $content;
    }

    public function Detail_Issued()
    {
      $content = $this->load->view('detail_issued', '', true);                          

            echo $content;
    }

    public function detailbom()
    {
      //echo "<pre>";print_r($_POST);"</pre>";exit();
      $idproduct = $this->input->post("idx");
      $data["product"] = $this->db->query("SELECT * from mst_product where product_id = '".$idproduct."'")->row();
        
        $data['order']=$this->db->query("SELECT mst_material.*, mst_bom.bom_qty as qty, mst_bom.bom_id from mst_bom 
          inner join mst_material on mst_bom.material_id = mst_material.material_id
          where mst_bom.product_id = '".$idproduct."'");              
      
        $data['order_liquid']=$this->db->query("SELECT mst_material.*, mst_bom_liquid.bom_liquid_qty as qty, mst_bom_liquid.bom_liquid_id 
          from mst_bom_liquid inner join mst_material on mst_bom_liquid.material_id= mst_material.material_id
          where mst_bom_liquid.product_id = '".$idproduct."'");               
      
      $content = $this->load->view('rincian_bom', $data, true);                

            echo  $content;
    }

		public function edit_issue()
		{
			$idx = $this->input->post("IDBidang");
			$data['ISS'] = $this->db->query("SELECT * from trx_issued inner join trx_issued_detail on trx_issued.issued_id = trx_issued_detail.issued_id inner join mst_material
        on mst_material.material_id = trx_issued_detail.material_id left join trx_sales_order on trx_sales_order.sales_order_id = 
        trx_issued_detail.sales_order_id where trx_issued.issued_id = '".$idx."'");			
      $this->load->view('edit_issue_view', $data);                

           
		}  

		function addTableRekanan(){
            $this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            $idproduct = $this->input->post("idx");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT * from mst_provider where provider_categories_id = 1 AND (provider_code like '%".$idproduct."%' OR provider_name like '%".$idproduct."%') LIMIT 50");           
            
            $i=1; 
            $strContent = '';

            foreach($arrContent->result() as $row){               
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $tgl = date('mdY');
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

          function addTableRekanan1(){
            $this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            $idproduct = $this->input->post("idx");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT * from mst_provider where provider_categories_id = 1 AND (provider_code like '%".$idproduct."%' OR provider_name like '%".$idproduct."%') LIMIT 10");           
            
            $i=1; 
            $strContent = '';

            foreach($arrContent->result() as $row){               
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $tgl = date('mdY');
                $code = "'".$row->provider_code.''.$tgl."'";
                $nama = "'".str_replace(" ","_",$row->provider_name)."'";
                $strContent.='<tr class="record">   
                            <td>'.$row->provider_id.'</td>                                                                         
                                      <td>'.$row->provider_code.'</td>                                      
                                      <td>'.$row->provider_name.'</td>                                       
                                      <td>
                                        <button type="button" class="btn btn-xs btn-success"  onclick="addRekanan('.$row->provider_id.','.$nama.','.$code.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
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
            $ids = $this->input->post("PO");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT * from trx_sales_order");           
            
            $i=1; 
            $strContent = '';
            $status = '';
            $ttl = 0;
            $setPO = 0;
            foreach($arrContent->result() as $row){             	
            	if($row->sales_order_status != 'close') 
            	{
            		$status = '';
            	} else{
            		$status = 'hidden';
            	}        
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $tgl = date('md');
                $code = "'".$row->sales_order_ref_no."'";
                $nama = "'".$row->sales_order_ref_no.''.$tgl."'";
                $strContent.='<tr class="record '.$status.'">   
                            <td>'.$row->sales_order_id.'</td>                                                                         
                                      <td>'.$row->sales_order_ref_no.'</td>                                      
                                      <td>'.$row->sales_order_categories.'</td>                                       
                                      <td>
                                        <button type="button" class="btn btn-xs btn-success"  onclick="addSales('.$row->sales_order_id.','.$code.','.$ids.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
              $i++;   
                                
            }     
            echo $strContent;            
          }


          function addTableSo_det(){
            
            $idproduct = $this->input->post("idx");
            $idso = $this->input->post("ids");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT sum(trx_sales_order_detail.sales_order_detail_qty) as qty_det,trx_sales_order_detail.*, mst_material.*, mst_product.*, sum(mst_bom.bom_qty) as qty 
              from trx_sales_order_detail inner join mst_bom on mst_bom.product_id = trx_sales_order_detail.product_id
              inner join mst_material on mst_bom.material_id = mst_material.material_id inner join mst_product on mst_product.product_id=trx_sales_order_detail.product_id
              where material_categories_id = 2 AND (sales_order_id = '".$idso."' AND (material_name like '%".$idproduct."%' OR material_code like '%".$idproduct."%')) group by mst_bom.material_id LIMIT 100");           
            
            $i=1; 
            $strContent = '';
            $order=0;
            $idx = 0;
            $status = '';
            foreach($arrContent->result_array() as $key => $row){               
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $idx = $row['sales_order_id'];
                $idm = $row['material_id'];
                $cek = $this->db->query("SELECT * from trx_issued inner join trx_issued_detail on trx_issued.issued_id = trx_issued_detail.issued_id where sales_order_id = '".$idx."' AND material_id = '".$idm."'")->row();
                $inv = $this->db->query("SELECT sum(inventory_stock_qty) as stok_qty from trx_inventory where material_id = '".$row['material_id']."' AND inventory_categories = 'stock'")->row();
                $order = $row['qty_det'] - $cek->issued_detail_qty;
                $stock = $inv->stock_qty+0;
                $code = "'".$row['material_code']."'";
                $nama = "'".str_replace(" ","_",$row['material_name'])."'";
                if($order == 0){
                	$status = 'hidden';
                } else{
                	$status = '';
                }
                $strContent.='<tr class="record">   
                            <td>'.$row['material_id'].'</td>                                                                         
                                      <td>'.$row['product_code'].'</td>                                      
                                      <td>'.$row['product_name'].'</td> 
                                      <td>'.$order.'</td>
                                      <td class="hidden">'.$row['material_price'].'</td> 
                                      <td class="hidden">'.$row['product_id'].'</td> 
                                      <td class="hidden">s'.$i.'</td>
                                      <td class="hidden">s'.$i.'</td>
                                      <td class="hidden">s'.$i.'</td>                                     
                                      <td>
                                        <button id="hds'.$i.'" type="button" class="btn btn-xs btn-success"  onclick="addProduct(this,'.$order.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
              $i++;                      
            }     
            echo $strContent;            
          }

          function addTableSo_Liquid(){
            
            $idproduct = $this->input->post("idx");
            $idso = $this->input->post("ids");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT * from mst_material where material_categories_id = 2 group by material_id");           
            
            $i=1; 
            $strContent = '';
            $order=0;
            $idx = 0;
            $status = '';
            $beli =0;
            $stock =0;
            foreach($arrContent->result_array() as $key => $row){               
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                //$idx = $row['sales_order_id'];
                $idm = $row['material_id'];
                $cek = $this->db->query("SELECT * from trx_issued inner join trx_issued_detail on trx_issued.issued_id = trx_issued_detail.issued_id where material_id = '".$idm."'")->row();
                $inv = $this->db->query("SELECT sum(inventory_stock_qty) as stok_qty from trx_inventory where material_id = '".$idm."' AND inventory_categories = 'stock'")->row();
                $order = 0;
                $stock = $inv->stok_qty+0;
                //$beli = $cek->issued_detail_qty+0;
                $code = "'".$row['material_code']."'";
                $nama = "'".str_replace(" ","_",$row['material_name'])."'";
                if($order == 0){
                  $status = 'hidden';
                } else{
                  $status = '';
                }
                $strContent.='<tr class="record">   
                                  <td class="hidden">'.$row['material_id'].'</td>                                                                         
                                      <td>'.$row['material_code'].'</td>                                      
                                      <td>'.$row['material_name'].'</td>
                                      <td>'.$stock.'</td> 
                                      <td class="hidden">'.$stock.'</td>
                                      <td>'.$beli.'</td>
                                      <td class="hidden">'.$row['material_price'].'</td> 
                                      <td class="hidden"></td>                                      
                                      <td class="hidden">d'.$i.'</td>                                       
                                      <td>
                                        <button id="hdd'.$i.'" type="button" class="btn btn-xs btn-success"  onclick="addProduct(this,'.$order.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
              $i++;                      
            }     
            echo $strContent;            
          }

        public function saveIssued()
		    {
		      //echo "<pre>";print_r($_POST);"</pre>";exit();
          $ttl_semua =0;
		    	$cek = $this->db->query("SELECT * from trx_issued where issued_code = '".$this->input->post("nomor")."'");
              if($cek->num_rows() != 0){
                $idso = $cek->row()->issued_id;
                //$data['lpb_liquid_code'] = $this->input->post("nomor");
                $data['issued_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
                $data['issued_note'] = $this->input->post("note");
                //$data['issued_divisi'] = $this->input->post("categories");
                $this->db->where('issued_id',$idso);
                $this->db->update("trx_issued", $data);
              } else{                
                //$data['sales_order_id'] = $this->input->post("id_sales");
                $data['issued_note'] = $this->input->post("note");
                $data['issued_code'] = $this->input->post("nomor");
                $data['issued_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
                //$data['divisi_id'] = $this->input->post("categories");           
                $data['issued_date_created'] = date("Y-m-d");
                $data['issued_last_updated'] = date("Y-m-d");      
                $data['issued_log'] = "insert by dwi";
                              
                  
                $this->db->insert("trx_issued", $data);

                $idso = $this->db->insert_id();
            }
              $c_kontak = count($this->input->post("id_material"));
            
          for($i=0; $i<$c_kontak;$i++)
          {
            $idp = $_POST['id_material'][$i];
            $idf = $_POST['reff'][$i];
            $coba = $this->db->query("SELECT * from trx_issued_detail where issued_id = '".$idso."' AND material_id = '".$idp."'");
            $iddet = $_POST['iddetail'][$i];          
            if($coba->num_rows() != 0 && $iddet != 0){

              $data2['issued_detail_qty'] = $_POST['qty'][$i];
              //$data2['lpb_liquid_detail_price'] = strToCurrDB($_POST['nominal'][$i]);
              $data2['divisi_id'] = $_POST['categories'][$i];
              $data2['issued_detail_note'] = $_POST['desc'][$i];
              $data2['issued_detail_last_updated'] = date("Y-m-d");
              $data2['sales_order_id'] = $_POST['reff'][$i];
              $this->db->where('issued_detail_id',$_POST['iddetail'][$i]);
              $this->db->update("trx_issued_detail", $data2);

              $ttl = strToCurrDB($_POST['nominal'][$i]) * $_POST['qty'][$i];
              $ttl_semua += $ttl;
              $data3['inventory_jumlah_nominal'] = strToCurrDB($_POST['nominal'][$i]);
              $data3['inventory_stock_qty'] = '-'.$_POST['qty'][$i];
              $data3['inventory_jenis'] = "out";            
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
              $data3['inventory_stock_qty'] = '-'.$_POST['qty'][$i];
              $data3['inventory_jenis'] = "out";
              $data3['inventory_date_transaction'] = date("Y-m-d");
              $data3['inventory_date_created'] = date("Y-m-d");
              $data3['inventory_description'] = $_POST['desc'][$i];
              $data3['inventory_log'] = "insert by dwi";
              $this->db->insert("trx_inventory", $data3);

              $idinv = $this->db->insert_id();
              $ttl = strToCurrDB($_POST['nominal'][$i]) * $_POST['qty'][$i];
              $ttl_semua += $ttl;
              $data2['issued_id'] = $idso;
              $data2['inventory_id'] = $idinv;
              $data2['material_id'] = $_POST['id_material'][$i];
              $data2['sales_order_id'] = $_POST['reff'][$i];
              $data2['issued_detail_qty'] = $_POST['qty'][$i];
              $data2['divisi_id'] = $_POST['categories'][$i];
              //$data2['lpb_liquid_detail_price'] = strToCurrDB($_POST['nominal'][$i]);
              $data2['issued_detail_note'] = $_POST['desc'][$i];
              //$data2['purchase_order_detail_remax'] = $_POST['qty'][$i];
              $data2['issued_detail_date_created'] = date("Y-m-d");
              $data2['issued_detail_last_updated'] = date("Y-m-d");
              $data2['issued_detail_log'] = "insert by dwi";
              $this->db->insert("trx_issued_detail", $data2);            

            }
          }
          $cus = $this->input->post("id_customer");
          $profit = $this->db->query("SELECT * from mst_provider where provider_id = '".$cus."'");
          
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
          $data6['uraian'] = 'PEMAKAIAN BAHAN PENOLONG';
          $data6['memo'] = $this->input->post("note");
          $data6['akun'] = '52002';
          $data6['nobukti'] = $this->input->post("nomor");       
          $data6['id_kategori'] = 2;
          $data6['id_issued'] = $idso;
          $data6['provider_id'] = $cus;
          $data6['dateentry'] = date("Y-m-d");
          $data6['userentry'] = $_SESSION['IDUser'];
          $data6['jenis'] = 'uk';
          $data6['nominal'] = '-'.$ttl_semua;
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
          $data7['memo'] = $this->input->post("note");
          $data7['akun'] = '14003';
          $data7['nobukti'] = $this->input->post("nomor");       
          $data7['id_kategori'] = 1;
          $data7['id_issued'] = $idso;
          $data7['provider_id'] = $cus;
          $data7['dateentry'] = date("Y-m-d");
          $data7['userentry'] = $_SESSION['IDUser'];
          $data7['jenis'] = 'uk';
          $data7['nominal'] = '-'.$ttl_semua;
          $this->db->insert("trx_jurnal", $data7);
		    }

        public function updateIssued()
        {
          //echo "<pre>";print_r($_POST);"</pre>";exit();
          $ttl_semua =0;
          $cek = $this->db->query("SELECT * from trx_issued where issued_code = '".$this->input->post("nomor")."'");
              if($cek->num_rows() != 0){
                $idso = $cek->row()->issued_id;
                //$data['lpb_liquid_code'] = $this->input->post("nomor");
                $data['issued_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
                $data['issued_note'] = $this->input->post("note");
                //$data['issued_divisi'] = $this->input->post("categories");
                $this->db->where('issued_id',$idso);
                $this->db->update("trx_issued", $data);
              } else{                
                //$data['sales_order_id'] = $this->input->post("id_sales");
                $data['issued_note'] = $this->input->post("note");
                $data['issued_code'] = $this->input->post("nomor");
                $data['issued_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
                //$data['divisi_id'] = $this->input->post("categories");           
                $data['issued_date_created'] = date("Y-m-d");
                $data['issued_last_updated'] = date("Y-m-d");      
                $data['issued_log'] = "insert by dwi";
                              
                  
                $this->db->insert("trx_issued", $data);

                $idso = $this->db->insert_id();
            }
              $c_kontak = count($this->input->post("id_material"));
            
          for($i=0; $i<$c_kontak;$i++)
          {
            $idp = $_POST['id_material'][$i];
            $idf = $_POST['reff'][$i];
            $coba = $this->db->query("SELECT * from trx_issued_detail where issued_id = '".$idso."' AND material_id = '".$idp."'");
            $iddet = $_POST['iddetail'][$i];          
            if($coba->num_rows() != 0 && $iddet != 0){

              $data2['issued_detail_qty'] = $_POST['qty'][$i];
              //$data2['lpb_liquid_detail_price'] = strToCurrDB($_POST['nominal'][$i]);
              $data2['divisi_id'] = $_POST['categories'][$i];
              $data2['issued_detail_note'] = $_POST['desc'][$i];
              $data2['issued_detail_last_updated'] = date("Y-m-d");
              $data2['sales_order_id'] = $_POST['reff'][$i];
              $this->db->where('issued_detail_id',$_POST['iddetail'][$i]);
              $this->db->update("trx_issued_detail", $data2);

              $ttl = strToCurrDB($_POST['nominal'][$i]) * $_POST['qty'][$i];
              $ttl_semua += $ttl;
              $data3['inventory_jumlah_nominal'] = strToCurrDB($_POST['nominal'][$i]);
              $data3['inventory_stock_qty'] = '-'.$_POST['qty'][$i];
              $data3['inventory_jenis'] = "out";            
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
              $data3['inventory_stock_qty'] = '-'.$_POST['qty'][$i];
              $data3['inventory_jenis'] = "out";
              $data3['inventory_date_transaction'] = date("Y-m-d");
              $data3['inventory_date_created'] = date("Y-m-d");
              $data3['inventory_description'] = $_POST['desc'][$i];
              $data3['inventory_log'] = "insert by dwi";
              $this->db->insert("trx_inventory", $data3);

              $idinv = $this->db->insert_id();
              $ttl = strToCurrDB($_POST['nominal'][$i]) * $_POST['qty'][$i];
              $ttl_semua += $ttl;
              $data2['issued_id'] = $idso;
              $data2['inventory_id'] = $idinv;
              $data2['material_id'] = $_POST['id_material'][$i];
              $data2['sales_order_id'] = $_POST['reff'][$i];
              $data2['issued_detail_qty'] = $_POST['qty'][$i];
              $data2['divisi_id'] = $_POST['categories'][$i];
              //$data2['lpb_liquid_detail_price'] = strToCurrDB($_POST['nominal'][$i]);
              $data2['issued_detail_note'] = $_POST['desc'][$i];
              //$data2['purchase_order_detail_remax'] = $_POST['qty'][$i];
              $data2['issued_detail_date_created'] = date("Y-m-d");
              $data2['issued_detail_last_updated'] = date("Y-m-d");
              $data2['issued_detail_log'] = "insert by dwi";
              $this->db->insert("trx_issued_detail", $data2);            

            }
          }
          $ttl = strToCurrDB($this->input->post("total"));
          $data6['memo'] = $this->input->post("note");                    
          $data6['nominal'] = '-'.$ttl_semua;
          $this->db->where('id_issued',$idso);
          $this->db->update("trx_jurnal", $data6);
        }

		    public function GetDaftarIssued()
		    {
		      $this->checkCredentialAccess();

		            $this->checkIsAjaxRequest();
		            
		            $this->load->model("gudang_model", "ModelRaw");
		            
		            echo $this->ModelRaw->GetDaftarIssued(); 
		    }

        public function GetDaftarAjustment()
        {
          $this->checkCredentialAccess();

                $this->checkIsAjaxRequest();
                
                $this->load->model("gudang_model", "ModelRaw");
                
                echo $this->ModelRaw->GetDaftarAjustment(); 
        }

        public function GetDetailIssued()
        {
          $this->checkCredentialAccess();

                $this->checkIsAjaxRequest();
                
                $this->load->model("gudang_model", "ModelRaw");
                
                echo $this->ModelRaw->GetDetailIssued(); 
        }

		    public function HapusIssued()
		    {
		      $this->checkCredentialAccess();

		            $this->checkIsAjaxRequest();

		      $idx =   $this->input->post('ID');
          $cek = $this->db->query("SELECT * from trx_issued_detail where issued_id = '".$idx."'");
          $this->db->delete('trx_issued_detail', array('issued_id' => $idx));
          $this->db->delete('trx_issued', array('issued_id' => $idx));
          $this->db->delete('trx_jurnal', array('id_issued' => $idx));
          foreach ($cek->result() as $row) {
            $this->db->delete('trx_inventory', array('inventory_id' => $row->inventory_id));
          }
		       
		      
		    }

		    public function habusdataissued()
		    {
		      $this->checkCredentialAccess();

		      $this->checkIsAjaxRequest();

		      $idx =   $this->input->post('ID');
          $idv =   $this->input->post('IDV');
		      $this->db->delete('trx_issued_detail', array('issued_detail_id' => $idx));
          $this->db->delete('trx_inventory', array('inventory_id' => $idv));		      
		      
		    }

		    public function adddataRaw()
		    {
		      	$data2['purchase_order_id'] = $this->input->post("po_id");
				$data2['material_id'] = $this->input->post("mat_id");
				$data2['product_id'] = $this->input->post("prod_id");
				$data2['purchase_order_detail_qty'] = $this->input->post("qty");
				$data2['purchase_order_detail_price'] = $this->input->post("price");
				$data2['purchase_order_detail_desc'] = '';
				//$data2['purchase_order_detail_remax'] = $_POST['qty'][$i];
				$data2['purchase_order_detail_date_created'] = date("Y-m-d");
				$data2['purchase_order_detail_last_updated'] = date("Y-m-d");
				$data2['purchase_order_detail_log'] = "insert by dwi";
				$this->db->insert("trx_purchase_order_detail", $data2);		      
		      
		    }

        public function HapusInv()
        {
          $this->checkCredentialAccess();

                $this->checkIsAjaxRequest();

          $idx = $this->input->post('ID');
          $this->db->delete('trx_inventory', array('inventory_id' => $idx));
          $this->db->delete('trx_issued_return', array('inventory_id' => $idx));
          
        }

}

/* End of fiel Utility.php */
<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

	class Admin extends MY_Controller {
		
 	    public function __construct() 
	    {
			parent::__construct();
		}
	         
		public function index()
		{	
			$this->checkCredentialAccess();

			$this->checkIsAjaxRequest();

			//$data = $this->db->query("SELECT * from ref_kecamatan");
			//$data1 = $this->db->query("SELECT * from ref_kelurahan");
			//$data2 = $this->db->query("SELECT * from ref_pedukuhan");
	        $this->load->model('admin_model', 'ModelAdmin');
	        $dataMenu = array('dataMenu' => $this->ModelAdmin->GetMenuAdmin());

	        $menu 	  = $this->load->view('menu_admin_view', $dataMenu, true);
	        $content = '';
	        //$content  = $this->load->view('admin_view', '', true);

	        $arrData = array('menu' 	=> $menu,	        				 
	        			   	 'content'  => $content);

	        echo json_encode($arrData);

		}
		
		public function Product()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

           	$content = $this->load->view('master_product_view', true);                

            echo  $content;
		}

		public function Material()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

           	$content = $this->load->view('master_material_view', true);                

            echo  $content;
		}

		public function Bom()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

           	$content = $this->load->view('master_bom_view', true);                

            echo  $content;
		}

		public function Vendor()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

           	$content = $this->load->view('master_vendor_view', true);                

            echo  $content;
		}

		public function Suplier()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

           	$content = $this->load->view('master_suplier_view', true);                

            echo  $content;
		}

		public function Karyawan()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

           	$content = $this->load->view('master_karyawan_view', true);                

            echo  $content;
		}

		public function ImportSales()
		{
			
           	$this->load->view('inport');                

           
		}

		public function Sales()
		{
			
           	$this->load->view('master_sales_order_view');                

           
		}

		public function buatbom()
		{
			//echo "<pre>";print_r($_POST);"</pre>";exit();
			$data['bomid'] = $this->input->post("idx");
           	$this->load->view('import_bom', $data);                

           
		}

		public function buatso()
		{
			//echo "<pre>";print_r($_POST);"</pre>";exit();			
			$c_kontak = count($this->input->post("noreg"));
			
			for($i=0; $i<$c_kontak;$i++)
			{	
				$data['order'][]=$this->db->query("SELECT * from tbl_product where product_code = '".$_POST['noreg'][$i]."'")->row();
				$data['qty_order'][]= $_POST['qty'][$i];				
			}
			$content = $this->load->view('sales_order', $data, true);                

            echo  $content;
		}

		public function bomcreate()
		{
			//echo "<pre>";print_r($_POST);"</pre>";exit();
			$idproduct = $this->input->post("idproduct");
			$c_kontak = count($this->input->post("noreg"));
			$data["product"] = $this->db->query("SELECT * from tbl_product where product_id = '".$idproduct."'")->row();
			for($i=0; $i<$c_kontak;$i++)
			{	
				$data['order'][]=$this->db->query("SELECT * from tbl_material where material_code = '".$_POST['noreg'][$i]."'")->row();
				$data['qty_order'][]= $_POST['qty'][$i];				
			}
			$c_liquid = count($this->input->post("noliquid"));			
			for($i=0; $i<$c_liquid;$i++)
			{	
				$data['order_liquid'][]=$this->db->query("SELECT * from tbl_material where material_code = '".$_POST['noliquid'][$i]."'")->row();
				$data['qty_order_liquid'][]= $_POST['qtyliquid'][$i];				
			}
			$content = $this->load->view('add_bom', $data, true);                

            echo  $content;
		}

		function getDataSales(){
            $this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            $idproduct = $this->input->post("idx");
            $limit = $this->input->post("limit");
            //echo $limit;exit();
            //$this->load->model('kasbank_model', 'ModelKasbank');
            if($limit == 1){
            	$arrContent = $this->db->query("SELECT * from tbl_sales_order where sales_order_ref_no like '%".$idproduct."%' OR sales_order_status like '%".$idproduct."%'");           
            } else {
            	$arrContent = $this->db->query("SELECT * from tbl_sales_order where sales_order_ref_no like '%".$idproduct."%' OR sales_order_status like '%".$idproduct."%' LIMIT 10"); 
            }
            $i=1; 
            $strContent = '';

            foreach($arrContent->result() as $row){               
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $code = "'".$row->sales_order_ref_no."'";
                $nama = "'".str_replace(" ","_",$row->sales_order_ref_no)."'";
                $strContent.='<tr class="record">   
                					  <td>'.$row->sales_order_id.'</td>                                                                         
                                      <td>'.$row->sales_order_ref_no.'</td>                                      
                                      <td>'.$row->sales_order_date.'</td>
                                      <td>NOIR</td> 
                                      <td>'.$row->sales_order_address.'</td>
                                      <td>'.$row->sales_order_status.'</td>  
                                      <td>
                                        <button type="button" class="btn btn-xs btn-success"  onclick="dialogFormEditShow('.$row->sales_order_id.','.$code.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
              $i++;                      
            }     
            echo $strContent;            
          }

		function getDataVendor(){
            $this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            $idproduct = $this->input->post("idx");
            $limit = $this->input->post("limit");
            //echo $limit;exit();
            //$this->load->model('kasbank_model', 'ModelKasbank');
            if($limit == 1){
            	$arrContent = $this->db->query("SELECT * from tbl_provider where provider_provider_categories_id = 1 AND (provider_code like '%".$idproduct."%' OR provider_name like '%".$idproduct."%')");           
            } else {
            	$arrContent = $this->db->query("SELECT * from tbl_provider where provider_provider_categories_id = 1 AND (provider_code like '%".$idproduct."%' OR provider_name like '%".$idproduct."%') LIMIT 10"); 
            }
            $i=1; 
            $strContent = '';

            foreach($arrContent->result() as $row){               
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $code = "'".$row->provider_code."'";
                $nama = "'".str_replace(" ","_",$row->provider_name)."'";
                $strContent.='<tr class="record">   
                					  <td>'.$row->provider_id.'</td>                                                                         
                                      <td>'.$row->provider_code.'</td>                                      
                                      <td>'.$row->provider_name.'</td>
                                      <td>'.$row->provider_address.'</td> 
                                      <td>'.$row->provider_phone.'</td>
                                      <td>'.$row->provider_email.'</td>  
                                      <td>
                                        <button type="button" class="btn btn-xs btn-success"  onclick="dialogFormEditShow('.$row->provider_id.','.$code.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
              $i++;                      
            }     
            echo $strContent;            
          }

          function getDataSuplier(){
            $this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            $idproduct = $this->input->post("idx");
            $limit = $this->input->post("limit");
            //echo $limit;exit();
            //$this->load->model('kasbank_model', 'ModelKasbank');
            if($limit == 1){
            	$arrContent = $this->db->query("SELECT * from tbl_provider where provider_provider_categories_id = 2 AND (provider_code like '%".$idproduct."%' OR provider_name like '%".$idproduct."%')");           
            } else {
            	$arrContent = $this->db->query("SELECT * from tbl_provider where provider_provider_categories_id = 2 AND (provider_code like '%".$idproduct."%' OR provider_name like '%".$idproduct."%') LIMIT 10"); 
            }
            $i=1; 
            $strContent = '';

            foreach($arrContent->result() as $row){               
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $code = "'".$row->provider_code."'";
                $nama = "'".str_replace(" ","_",$row->provider_name)."'";
                $strContent.='<tr class="record">   
                					  <td>'.$row->provider_id.'</td>                                                                         
                                      <td>'.$row->provider_code.'</td>                                      
                                      <td>'.$row->provider_name.'</td>
                                      <td>'.$row->provider_address.'</td> 
                                      <td>'.$row->provider_phone.'</td>
                                      <td>'.$row->provider_email.'</td>  
                                      <td>
                                        <button type="button" class="btn btn-xs btn-success"  onclick="dialogFormEditShow('.$row->provider_id.','.$code.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
              $i++;                      
            }     
            echo $strContent;            
          }

		function addTableProduct(){
            $this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            $idproduct = $this->input->post("idx");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT * from tbl_product where product_code like '%".$idproduct."%' OR product_name like '%".$idproduct."%' LIMIT 10");           
            
            $i=1; 
            $strContent = '';

            foreach($arrContent->result() as $row){               
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $code = "'".$row->product_code."'";
                $nama = "'".str_replace(" ","_",$row->product_name)."'";
                $strContent.='<tr class="record">   
                					  <td>'.$row->product_id.'</td>                                                                         
                                      <td>'.$row->product_code.'</td>                                      
                                      <td>'.$row->product_name.'</td>
                                      <td>'.$row->product_price_usd.'</td> 
                                      <td>
                                        <button type="button" class="btn btn-xs btn-success"  onclick="dialogFormEditShow('.$row->product_id.','.$code.','.$nama.','.$row->product_price_usd.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
              $i++;                      
            }     
            echo $strContent;            
          }

        function addTableMaterial(){
            $this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            $idproduct = $this->input->post("idx");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT * from tbl_material where material_code like '%".$idproduct."%' OR material_name like '%".$idproduct."%' LIMIT 10");           
            
            $i=1; 
            $strContent = '';

            foreach($arrContent->result() as $row){               
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $code = "'".$row->material_code."'";
                $nama = "'".str_replace(" ","_",$row->material_name)."'";
                $strContent.='<tr class="record">   
                					  <td>'.$row->material_id.'</td>                                                                         
                                      <td>'.$row->material_code.'</td>                                      
                                      <td>'.$row->material_name.'</td>                                       
                                      <td>
                                        <button type="button" class="btn btn-xs btn-success"  onclick="addCount('.$row->material_id.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
              $i++;                      
            }     
            echo $strContent;            
          }

          function addTableLiquid(){
            $this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            $idproduct = $this->input->post("idx");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT * from tbl_material where material_code like '%".$idproduct."%' OR material_name like '%".$idproduct."%' LIMIT 10");           
            
            $i=1; 
            $strContent = '';

            foreach($arrContent->result() as $row){               
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $code = "'".$row->material_code."'";
                $nama = "'".str_replace(" ","_",$row->material_name)."'";
                $strContent.='<tr class="record">   
                					  <td>'.$row->material_id.'</td>                                                                         
                                      <td>'.$row->material_code.'</td>                                      
                                      <td>'.$row->material_name.'</td>                                       
                                      <td>
                                        <button type="button" class="btn btn-xs btn-success"  onclick="addLiquid('.$row->material_id.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
              $i++;                      
            }     
            echo $strContent;            
          }

		public function detailbom()
		{
			//echo "<pre>";print_r($_POST);"</pre>";exit();
			$idproduct = $this->input->post("idx");
			$data["product"] = $this->db->query("SELECT * from tbl_product where product_id = '".$idproduct."'")->row();
				
				$data['order']=$this->db->query("SELECT tbl_material.*, tbl_bom.bom_material_qty as qty, tbl_bom.bom_id from tbl_bom 
					inner join tbl_material on tbl_bom.bom_material_id = tbl_material.material_id
					where tbl_bom.bom_product_id = '".$idproduct."'");							
			
				$data['order_liquid']=$this->db->query("SELECT tbl_material.*, tbl_bom_liquid.bom_liquid_material_qty as qty, tbl_bom_liquid.bom_liquid_id 
					from tbl_bom_liquid inner join tbl_material on tbl_bom_liquid.bom_liquid_material_id= tbl_material.material_id
					where tbl_bom_liquid.bom_liquid_product_id = '".$idproduct."'");								
			
			$content = $this->load->view('detail_bom', $data, true);                

            echo  $content;
		}

		public function saveso()
		{
			//echo "<pre>";print_r($_POST);"</pre>";exit();
			$cek = $this->db->query("SELECT sales_order_ref_no from tbl_sales_order where sales_order_ref_no = '".$this->input->post("nomor")."'");
			if($cek->num_rows() >0){
				echo $cek->num_rows();
				exit();
			} else{
				$data['sales_order_categories'] = $this->input->post("categories");
				$data['sales_order_costumer_id'] = $this->input->post("id_customer");
				$data['sales_order_ref_no'] = $this->input->post("nomor");
				$data['sales_order_status'] = "draft";
				$data['sales_order_address'] = "2nd vendor adress";
				$data['sales_order_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
				$data['sales_order_shipped_date'] = date("Y-m-d", strtotime($this->input->post("tglship")));
				$data['sales_order_date_created'] = date("Y-m-d");			
				$data['sales_order_log'] = "insert by dwi";			
					
				$this->db->insert("tbl_sales_order", $data);
				
				$idso = $this->db->insert_id();

				$c_kontak = count($this->input->post("idproduk"));
					
				for($i=0; $i<$c_kontak;$i++)
				{
					$data2['sales_order_detail_sales_order_id'] = $idso;
					$data2['sales_order_detail_product_id'] = $_POST['idproduk'][$i];
					$data2['sales_order_detail_price'] = $_POST['price'][$i];
					$data2['sales_order_detail_qty'] = $_POST['qty'][$i];
					$data2['sales_order_detail_date_created'] = date("Y-m-d");
					$data2['sales_order_detail_log'] = "insert by dwi";
					$data2['sales_order_detail_status'] = "reguler";
					$this->db->insert("tbl_sales_order_detail", $data2);
				}
			}
		}

		public function saveproduct()
		{
			//echo "<pre>";print_r($_POST);"</pre>";exit();
			$data['product_code'] = $this->input->post("code");
			$data['product_name'] = $this->input->post("name");
			$data['product_cost'] = $this->input->post("cost");
			//$data['product_price'] = $this->input->post("price");
			$data['product_price_usd'] = $this->input->post("price");
			//$data['product_currency'] = $this->input->post("code");
			//$data['product_photo'] = $this->input->post("photo");
			$data['product_cbm'] = $this->input->post("cbm");
			$data['product_weight'] = $this->input->post("weight");
			$data['product_bundle'] = $this->input->post("bundle");
			//$data['product_description'] = $this->input->post("description");
			$data['product_date_created'] = date("Y-m-d H:i:s");
			$data['product_last_updated'] = date("Y-m-d H:i:s");
			$data['product_log'] = 'insert by dwi';
			$data['product_labor'] = $this->input->post("labor");
			$data['product_overhead'] = $this->input->post("overhead");
			$this->db->insert("tbl_product", $data);
		}

		public function savebom()
		{
			//echo "<pre>";print_r($_POST);"</pre>";exit();
			$idproduk = $this->input->post("idproduk");

			$c_kontak = count($this->input->post("idmaterial"));
				
			for($i=0; $i<$c_kontak;$i++)
			{
				$cek = $this->db->query("SELECT * from tbl_bom where bom_product_id='".$idproduk."' AND bom_material_id = '".$_POST['idmaterial'][$i]."'");
				if($cek->num_rows() > 0){
					$data2['bom_material_qty'] = $_POST['qty'][$i];
					$this->db->where('bom_id',$cek->row()->bom_id);
					$this->db->update("tbl_bom", $data2);
				}else {
					$data2['bom_product_id'] = $idproduk;
					$data2['bom_material_id'] = $_POST['idmaterial'][$i];
					$data2['bom_parent_id'] = 0;
					$data2['bom_level'] = 1;
					$data2['bom_material_qty'] = $_POST['qty'][$i];
					$data2['bom_attach_required'] = 'yes';
					$data2['bom_log'] = 'insert by dwi';
					$this->db->insert("tbl_bom", $data2);
				}
      }
        $c_liquid = count($this->input->post("idmaterial_ld"));
      for($a=0; $a<$c_liquid;$a++)
      {
        $cek2 = $this->db->query("SELECT * from tbl_bom_liquid where bom_liquid_product_id='".$idproduk."' AND bom_liquid_material_id = '".$_POST['idmaterial_ld'][$a]."'");
        if($cek2->num_rows() > 0){          
          $data['bom_liquid_material_qty'] = $_POST['qty_ld'][$a];
          $this->db->where('bom_liquid_id',$cek2->row()->bom_liquid_id);
          $this->db->update("tbl_bom_liquid", $data);
        }else {
          $data['bom_liquid_product_id'] = $idproduk;
          $data['bom_liquid_material_id'] = $_POST['idmaterial_ld'][$a];
          $data['bom_liquid_material_qty'] = 0;
          $data['bom_log'] = 'insert by dwi';
          $this->db->insert("tbl_bom_liquid", $data);
        }
			}
		}

		public function tambahCount()
		{
			//echo "<pre>";print_r($_POST);"</pre>";exit();
			
			$data2['bom_product_id'] = $this->input->post("IDproduct");
			$data2['bom_material_id'] = $this->input->post("IDmaterial");
			$data2['bom_parent_id'] = 0;
			$data2['bom_level'] = 1;
			$data2['bom_material_qty'] = 0;
			$data2['bom_attach_required'] = 'yes';
			$data2['bom_log'] = 'insert by dwi';
			$this->db->insert("tbl_bom", $data2);
				
			
		}

		public function tambahLiquid()
		{
			//echo "<pre>";print_r($_POST);"</pre>";exit();
			
			$data2['bom_liquid_product_id'] = $this->input->post("IDproduct");
			$data2['bom_liquid_material_id'] = $this->input->post("IDmaterial");
			$data2['bom_liquid_material_qty'] = 0;
			$data2['bom_log'] = 'insert by dwi';
			$this->db->insert("tbl_bom_liquid", $data2);
				
			
		}

		function ajax_lookUpUsername(){
		    $code = $this->input->post('code');
		    $this->db->where('product_code', $code);
		    $query = $this->db->get('tbl_product');
		    if ($query->num_rows() > 0){
		       echo 0;
		    } else {
		       echo 1;
		    }
		}

		public function CetakKaryawan()
		{
			
           	$this->load->view('cetak_karyawan');                

           
		}

		public function GetDaftarMaterial()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            
            $this->load->model("master_material_model", "ModelMasterMaterial");
            
            echo $this->ModelMasterMaterial->GetDaftarMaterial(); 
		}

		public function GetDaftarProduct()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            
            $this->load->model("master_product_model", "ModelMasterProduct");
            
            echo $this->ModelMasterProduct->GetDaftarProduct(); 
		}

		public function GetDaftarBom()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            
            $this->load->model("master_bom_model", "ModelMasterBom");
            
            echo $this->ModelMasterBom->GetDaftarBom(); 
		}

		public function GetDaftarKaryawan()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            
            $this->load->model("master_karyawan_model", "ModelMasterKaryawan");
            
            echo $this->ModelMasterKaryawan->GetDaftarKaryawan(); 
		}

		public function TambahKaryawan()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

            $this->form_validation->set_rules('kodeKaryawan', 'Kode Karyawan', 'trim|required|is_unique[mst_karyawan.kode_karyawan]|min_length[1]|xss_clean');
    		$this->form_validation->set_rules('namaKaryawan', 'Nama Karyawan', 'trim|required|xss_clean');
    		//$this->form_validation->set_rules('divisi', 'Divisi', 'trim|required|min_length[1]|xss_clean');
			$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required|min_length[1]|xss_clean');
			$this->form_validation->set_rules('group', 'Group Pengguna', 'trim|required|min_length[1]|xss_clean');
			$this->form_validation->set_rules('emailKaryawan', 'Email', 'trim|required|valid_email|is_unique[mst_karyawan.email]|xss_clean');
			$this->form_validation->set_rules('kataSandiKaryawan', 'Kata Sandi', 'trim|required|xss_clean');

			if ( ! $this->form_validation->run() )
			{				
				$errorMessage = form_error('kodeKaryawan').form_error('namaKaryawan').form_error('divisi').form_error('group').
								form_error('jabatan').form_error('emailKaryawan').form_error('kataSandiKaryawan');
				$messageData = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{

				$this->kode 	= $this->input->post('kodeKaryawan', true); 
				$this->nama		= $this->input->post('namaKaryawan', true); 	
				//$this->divisi 	= $this->input->post('divisi', true);
				$this->jabatan 	= $this->input->post('jabatan', true);
				$this->group 	= $this->input->post('group', true);
				$this->alamat 	= $this->input->post('alamatKaryawan', true);
				$this->telp 	= $this->input->post('telpKaryawan', true);
				$this->email 	= $this->input->post('emailKaryawan', true);
				$this->kataSandi = $this->input->post('kataSandiKaryawan', true);
				$this->deskripsi = $this->input->post('deskripsi', true);
				
				$arrData = array('kode' 	=> $this->kode,
								 'nama' 	=> $this->nama,
								 //'divisi' 	=> $this->divisi,
								 'jabatan' 	=> $this->jabatan,
								 'group' 	=> $this->group,
								 'alamat'	=> $this->alamat,
								 'telp'		=> $this->telp,
								 'email'	=> $this->email,
								 'kataSandi'=> $this->kataSandi,
								 'deskripsi' => $this->deskripsi);

	            $messageData = $this->load->model('master_karyawan_model', 'ModelTambahKaryawan');
	            $messageData = $this->ModelTambahKaryawan->TambahKaryawan($arrData);
	            echo $messageData;
        	}
		}

		public function UbahKaryawan()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

          	$this->form_validation->set_rules('IDKaryawan', 'Karyawan', 'trim|required|min_length[1]|xss_clean');
            $this->form_validation->set_rules('kodeKaryawanUbah', 'Kode Karyawan', 'trim|required|min_length[1]|xss_clean');
    		$this->form_validation->set_rules('namaKaryawanUbah', 'Nama Karyawan', 'trim|required|xss_clean');
    		//$this->form_validation->set_rules('divisiUbah', 'Divisi', 'trim|required|min_length[1]|xss_clean');
			$this->form_validation->set_rules('jabatanUbah', 'Jabatan', 'trim|required|min_length[1]|xss_clean');
			$this->form_validation->set_rules('groupUbah', 'Group Pengguna', 'trim|required|min_length[1]|xss_clean');
			$this->form_validation->set_rules('emailKaryawanUbah', 'Email', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules('kataSandiKaryawanUbah', 'Kata Sandi', 'trim|xss_clean');

			if ( ! $this->form_validation->run() )
			{				
				$errorMessage = form_error('kodeKaryawanUbah').form_error('namaKaryawanUbah').form_error('divisiUbah').form_error('groupUbah').
								form_error('jabatanUbah').form_error('emailKaryawanUbah').form_error('kataSandiKaryawanUbah');
				$messageData = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{

				$this->IDKaryawan 	= $this->input->post('IDKaryawan', true);
				$this->kode 	= $this->input->post('kodeKaryawanUbah', true); 
				$this->nama		= $this->input->post('namaKaryawanUbah', true); 	
				//$this->divisi 	= $this->input->post('divisiUbah', true);
				$this->jabatan 	= $this->input->post('jabatanUbah', true);
				$this->group 	= $this->input->post('groupUbah', true);
				$this->alamat 	= $this->input->post('alamatKaryawanUbah', true);
				$this->telp 	= $this->input->post('telpKaryawanUbah', true);
				$this->email 	= $this->input->post('emailKaryawanUbah', true);
				$this->kataSandi = $this->input->post('kataSandiKaryawanUbah', true);
				$this->deskripsi = $this->input->post('deskripsiUbah', true);
				
				$arrData = array('IDKaryawan'=> $this->IDKaryawan,								 
								 'IDJabatan' => $this->jabatan,
								 'IDGroup' 	=> $this->group,
								 'kode' 	=> $this->kode,
								 'nama' 	=> $this->nama,
								 'alamat'	=> $this->alamat,
								 'telp'		=> $this->telp,
								 'email'	=> $this->email,
								 'kataSandi'=> $this->kataSandi,
								 'deskripsi' => $this->deskripsi);

	            $messageData = $this->load->model('master_karyawan_model', 'ModelUbahKaryawan');
	            $messageData = $this->ModelUbahKaryawan->UbahKaryawan($arrData);
	            echo $messageData;
        	}
		}

		public function HapusKaryawan()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

			$this->IDKaryawan = $this->input->post('IDKaryawan', true);
			
            $messageData = $this->load->model('master_karyawan_model', 'ModelHapusKaryawan');
            $messageData = $this->ModelHapusKaryawan->HapusKaryawan($this->IDKaryawan);
            echo $messageData;
			
		}

		public function habusdatabom()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

			$id_bom =   $this->input->post('IDbom');
            $this->db->delete('tbl_bom', array('bom_id' => $id_bom)); 
            //echo $messageData;
			
		}

		public function habusdatabomliquid()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

			$id_bom =   $this->input->post('IDbom');
            $this->db->delete('tbl_bom_liquid', array('bom_liquid_id' => $id_bom)); 
            //echo $messageData;
			
		}

		public function habusallbomliquid()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

			$id_bom =   $this->input->post('IDbom');
            $this->db->delete('tbl_bom_liquid', array('bom_liquid_product_id' => $id_bom)); 
            //echo $messageData;
			
		}

		public function Jabatan()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

           	$content = $this->load->view('master_jabatan_view', true);                

            echo  $content;
		}

		public function GetDaftarJabatan()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            
            $this->load->model("master_jabatan_model", "ModelMasterJabatan");
            
            echo $this->ModelMasterJabatan->GetDaftarJabatan(); 
		}

		public function TambahJabatan()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

            $this->form_validation->set_rules('kodeJabatan', 'Kode Jabatan', 'trim|required|is_unique[ref_jabatan.kode_jabatan]|min_length[1]|xss_clean');
    		$this->form_validation->set_rules('namaJabatan', 'Nama Jabatan', 'trim|required|xss_clean');
    		
			if ( ! $this->form_validation->run() )
			{				
				$errorMessage = form_error('kodeJabatan').form_error('namaJabatan');
				$messageData = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{

				$this->kode 	= $this->input->post('kodeJabatan', true); 
				$this->nama		= $this->input->post('namaJabatan', true); 	
				$this->deskripsi = $this->input->post('deskripsi', true);
				
				$arrData = array('kode' 	=> $this->kode,
								 'nama' 	=> $this->nama,
								 'deskripsi' => $this->deskripsi);

	            $messageData = $this->load->model('master_jabatan_model', 'ModelTambahJabatan');
	            $messageData = $this->ModelTambahJabatan->TambahJabatan($arrData);
	            echo $messageData;
        	}
		}

		public function UbahJabatan()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

          	$this->form_validation->set_rules('IDJabatan', 'Jabatan', 'trim|required|min_length[1]|xss_clean');
            $this->form_validation->set_rules('kodeJabatanUbah', 'Kode Jabatan', 'trim|required|min_length[1]|xss_clean');
    		$this->form_validation->set_rules('namaJabatanUbah', 'Nama Jabatan', 'trim|required|xss_clean');

			if ( ! $this->form_validation->run() )
			{				
				$errorMessage = form_error('IDJabatan').form_error('kodeJabatanUbah').form_error('namaJabatanUbah');
				$messageData = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{

				$this->IDJabatan 	= $this->input->post('IDJabatan', true);
				$this->kode 	= $this->input->post('kodeJabatanUbah', true); 
				$this->nama		= $this->input->post('namaJabatanUbah', true); 	
				$this->deskripsi = $this->input->post('deskripsiUbah', true);
				
				$arrData = array('IDJabatan'=> $this->IDJabatan,
								 'kode' 	=> $this->kode,
								 'nama' 	=> $this->nama,
								 'deskripsi' => $this->deskripsi);

	            $messageData = $this->load->model('master_jabatan_model', 'ModelUbahJabatan');
	            $messageData = $this->ModelUbahJabatan->UbahJabatan($arrData);
	            echo $messageData;
        	}
		}

		public function HapusJabatan()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

			$this->IDJabatan = $this->input->post('IDJabatan', true);
			
            $messageData = $this->load->model('master_jabatan_model', 'ModelHapusJabatan');
            $messageData = $this->ModelHapusJabatan->HapusJabatan($this->IDJabatan);
            echo $messageData;
			
		}

		public function GetClientAutoCode()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            
            $this->bidang 	= $this->input->post('IDBidang', true);

            $messageData = $this->load->model('master_client_model', 'ModelClient');
            $messageData = $this->ModelClient->GetClientAutoCode($this->bidang);
            echo $messageData;
		}

// ---------------------------- KSM ------------------------------------------------------------------------------------------------------------

		public function Ksm()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

           	$content = $this->load->view('master_ksm_view', true);                

            echo  $content;
		}

		public function CetakKsm()
		{
			
           	$this->load->view('cetak_ksm');                

           
		}

		public function GetDaftarKsm()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            
            $this->load->model("master_ksm_model", "ModelMasterKsm");
            
            echo $this->ModelMasterKsm->GetDaftarKsm(); 
		}

		public function tambahKsm()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            $cari2 = $this->db->query("SELECT * FROM mst_kontak where idtipe= 3 ORDER BY kode DESC LIMIT 1");
			$datanomor2 = $this->db->query("SELECT * FROM mst_kontak where idtipe= 3 ORDER BY kode DESC LIMIT 1")->row();			
				
			$data['mohon2'] = $datanomor2->kode;
            $data['nasabah'] = $this->db->query("SELECT * from mst_nasabah order by kode_nasabah desc")->row();
            $data['ksm'] = $this->db->query("SELECT * from mst_ksm order by kode_ksm desc")->row();

           	$content = $this->load->view('tambah_ksm_view',$data ,true);                

            echo  $content;
		}

		public function editdataKsm()
		{

			$ksm = $this->input->post("idx");
            $cari2 = $this->db->query("SELECT * FROM mst_kontak where idtipe= 3 ORDER BY kode DESC LIMIT 1");
			$datanomor2 = $this->db->query("SELECT * FROM mst_kontak where idtipe= 3 ORDER BY kode DESC LIMIT 1")->row();			
				
			$data['mohon2'] = $datanomor2->kode;
            $data['nasabah'] = $this->db->query("SELECT * from mst_nasabah order by kode_nasabah desc")->row();
            $data['ksm'] = $this->db->query("SELECT * from mst_ksm order by kode_ksm desc")->row();
            $data['dataksm'] = $this->db->query("SELECT * FROM mst_ksm where mst_ksm.id_ksm = '".$ksm."'")->row();
            $data['datanasabah'] = $this->db->query("SELECT * FROM mst_nasabah left join mst_kontak on mst_nasabah.id_kontak = mst_kontak.id where id_ksm = '".$ksm."'");
            //echo "<pre>";print_r($data);"</pre>";exit();
           	$content = $this->load->view('edit_ksm_view',$data ,true);                

            echo  $content;
		}

		public function changenasabah()
		{

			//echo "<pre>";print_r($_POST);"</pre>";exit();
            $kode = $this->input->post("kode");            
            $param = $this->db->query("SELECT * from mst_kontak where id = '".$kode."'")->row();
    					
			$data['ID'] = $param->id;
			$data['Kode'] = $param->kode;
			$data['Nama'] = $param->nama;
			$data['Alamat'] = $param->alamat;
			$data['Kodepos'] = $param->kodepos;
			$data['Notelp'] = $param->notelp;
			$data['Email'] = $param->email;				
			
			//$json['nasabah'][] = $data;			
			
			//$json['status'] = true;
			
			$dataJson = json_encode($data);
			
			echo $dataJson;

		}

		public function caridatakontak()
		{

			//echo "<pre>";print_r($_POST);"</pre>";exit();
            $kode = $this->input->post("kode");            
            $param = $this->db->query("SELECT * from mst_kontak
                                              where idtipe = 3 AND (nama like '%".$kode."%' OR kode like '%".$kode."%')
                                              AND id NOT IN (SELECT id_kontak from mst_nasabah)
                                			  order by kode asc");
    		if ($param->num_rows()>0) {
    			$i=0;
           	foreach($param->result() as $row)
			{
				$i++;
				$data['NO'] = $i;
				$data['ID'] = $row->id;
				$data['Kode'] = $row->kode;
				$data['Nama'] = $row->nama;				
				//$data['Jumlah'] = $row->Jumlah;		
				
				$json['kontak'][] = $data;
				
			}
			$json['status'] = true;
			}else{
				$json['status'] = false;
			}
						
			$dataJson = json_encode($json);
			
			echo $dataJson;

		}

		public function saveksm()
		{

			

           	$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

            $this->form_validation->set_rules('namaksm', 'Nama KSM', 'trim|required|xss_clean');
    		$this->form_validation->set_rules('bidangusaha', 'Bidang Usaha', 'trim|required|xss_clean');

    		
    		
			if ( ! $this->form_validation->run() )
			{				
				$errorMessage = form_error('namaksm').form_error('bidangusaha');
				$messageData = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{
				//echo "<pre>";print_r($_POST);"</pre>";exit();
				$data['kode_ksm'] = $this->input->post("noreg");
				$data['nama_ksm'] = $this->input->post("namaksm");
				$data['tgl_daftar'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
				$data['status_diterima'] = 1;
				$data['jenis_usaha'] = $this->input->post("bidangusaha");
				$data['proposal'] = $this->input->post("proposal2");
				$data['susunan_pengurus'] = $this->input->post("pengurus");
				$data['ktp'] = $this->input->post("keanggotaan");
				$data['modal_usaha'] = $this->input->post("modalusaha");
				$data['rab'] = $this->input->post("rab");
				$data['penggunaan_dana'] = $this->input->post("tujuan");
				$data['pengesahan'] = $this->input->post("pengesahan");
				
				$this->db->insert("mst_ksm", $data);
				
				$idksm = $this->db->insert_id();
				
				// INSERT TO trx_reg_nasabah //
				
				$c_kontak = count($this->input->post("noanggota"));
				
				for($i=0; $i<$c_kontak;$i++)
				{				
					$data2['id_ksm'] = $idksm;
					$data2['kode_nasabah'] = $_POST['noanggota'][$i];
					$data2['id_kontak'] = $_POST['idkontak'][$i];
					$data2['no_ktp'] = $_POST['noktp'][$i];
					$data2['jk'] = $_POST['jeniskelamin'][$i];
					$data2['deskripsi_nasabah'] = $_POST['diskripsi'][$i];									
					$this->db->insert("mst_nasabah", $data2);
				}	            
			
        	}
		}

		public function updatesaveksm()
		{

			

           	$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

            $this->form_validation->set_rules('namaksm', 'Nama KSM', 'trim|required|xss_clean');
    		$this->form_validation->set_rules('bidangusaha', 'Bidang Usaha', 'trim|required|xss_clean');

    		
    		
			if ( ! $this->form_validation->run() )
			{				
				$errorMessage = form_error('namaksm').form_error('bidangusaha');
				$messageData = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{
				//echo "<pre>";print_r($_POST);"</pre>";exit();
				$id = $this->input->post("idksm");
				$data['kode_ksm'] = $this->input->post("noreg");
				$data['nama_ksm'] = $this->input->post("namaksm");
				$data['tgl_daftar'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
				$data['status_diterima'] = 1;
				$data['jenis_usaha'] = $this->input->post("bidangusaha");
				$data['deskripsi'] = $this->input->post("diskripsi_ksm");
				$data['proposal'] = $this->input->post("proposal2");
				$data['susunan_pengurus'] = $this->input->post("pengurus");
				$data['ktp'] = $this->input->post("keanggotaan");
				$data['modal_usaha'] = $this->input->post("modalusaha");
				$data['rab'] = $this->input->post("rab");
				$data['penggunaan_dana'] = $this->input->post("tujuan");
				$data['pengesahan'] = $this->input->post("pengesahan");
				
				$this->db->where('id_ksm',$id);
				$this->db->update("mst_ksm", $data);

				$jml_uji = $this->db->query("SELECT * from mst_nasabah where id_ksm ='".$id."'");
				$d_uji = $jml_uji->num_rows();
				$f_uji = $d_uji - 1;
				
				$idksm = $this->input->post("idksm");
				
				// INSERT TO trx_reg_nasabah //
				
				$c_kontak = count($this->input->post("noanggota"));
				
				for($i=0; $i<$d_uji;$i++)
				{	
					$idnasabah = $_POST['idnasabah'][$i];			
					$data2['id_ksm'] = $idksm;
					$data2['kode_nasabah'] = $_POST['noanggota'][$i];
					$data2['id_kontak'] = $_POST['idkontak'][$i];
					$data2['no_ktp'] = $_POST['noktp'][$i];
					$data2['jk'] = $_POST['jeniskelamin'][$i];
					$data2['deskripsi_nasabah'] = $_POST['diskripsi'][$i];									
					$this->db->where('id_nasabah',$idnasabah);
					$this->db->update("mst_nasabah", $data2);
				}
				for($i=$d_uji; $i<$c_kontak; $i++)
				{
					$data2['id_ksm'] = $idksm;
					$data2['kode_nasabah'] = $_POST['noanggota'][$i];
					$data2['id_kontak'] = $_POST['idkontak'][$i];
					$data2['no_ktp'] = $_POST['noktp'][$i];
					$data2['jk'] = $_POST['jeniskelamin'][$i];
					$data2['deskripsi_nasabah'] = $_POST['diskripsi'][$i];									
					$this->db->insert("mst_nasabah", $data2);
				}	            
			
        	}
		}

		public function hapussavereg()
        {
            $this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

            $id_nasabah =   $this->input->post('IDDel');
            $this->db->delete('mst_nasabah', array('id_nasabah' => $id_nasabah));            

      
        }


//----------------------------- END KSM --------------------------------------------------------------------------------------------------------

// ---------------------------- NASABAH --------------------------------------------------------------------------------------------------------

		public function Nasabah()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

           	$content = $this->load->view('master_nasabah_view', true);                

            echo  $content;
		}

		public function GetDaftarNasabah()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            
            $this->load->model("master_nasabah_model", "ModelMasterNasabah");
            
            echo $this->ModelMasterNasabah->GetDaftarNasabah(); 
		}

//----------------------------- END NASABAH ---------------------------------------------------------------------------------------------------

//----------------------------- DEPARTEMEN -----------------------------------------------------------------------------------------------------
		public function Departemen()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

           	$content = $this->load->view('master_departemen_view', true);                

            echo  $content;
		}

		public function GetDaftarDepartemen()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            
            $this->load->model("master_departemen_model", "ModelMasterDepartemen");
            
            echo $this->ModelMasterDepartemen->GetDaftarDepartemen(); 
		}

		public function TambahDepartemen()
		{
			//echo $this->input->post() ; die();
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

            $this->form_validation->set_rules('kodeJabatan', 'Kode Jabatan', 'trim|required|is_unique[ref_jabatan.kode_jabatan]|min_length[1]|xss_clean');
    		$this->form_validation->set_rules('namaJabatan', 'Nama Jabatan', 'trim|required|xss_clean');
    		
			if ( ! $this->form_validation->run() )
			{				
				$errorMessage = form_error('kodeJabatan').form_error('namaJabatan');
				$messageData = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{

				$this->kode 	= $this->input->post('kodeJabatan', true); 
				$this->nama		= $this->input->post('namaJabatan', true); 	
				$this->deskripsi = $this->input->post('deskripsi', true);
				
				$arrData = array('kode' 	=> $this->kode,
								 'nama' 	=> $this->nama,
								 'deskripsi' => $this->deskripsi);

	            $messageData = $this->load->model('master_departemen_model', 'ModelTambahDepartemen');
	            $messageData = $this->ModelTambahDepartemen->TambahDepartemen($arrData);
	            echo $messageData;
        	}
		}

		public function UbahDepartemen()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

          	$this->form_validation->set_rules('IDJabatan', 'Jabatan', 'trim|required|min_length[1]|xss_clean');
            $this->form_validation->set_rules('kodeJabatanUbah', 'Kode Jabatan', 'trim|required|min_length[1]|xss_clean');
    		$this->form_validation->set_rules('namaJabatanUbah', 'Nama Jabatan', 'trim|required|xss_clean');

			if ( ! $this->form_validation->run() )
			{				
				$errorMessage = form_error('IDJabatan').form_error('kodeJabatanUbah').form_error('namaJabatanUbah');
				$messageData = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{

				$this->IDJabatan 	= $this->input->post('IDJabatan', true);
				$this->kode 	= $this->input->post('kodeJabatanUbah', true); 
				$this->nama		= $this->input->post('namaJabatanUbah', true); 	
				$this->deskripsi = $this->input->post('deskripsiUbah', true);
				
				$arrData = array('IDJabatan'=> $this->IDJabatan,
								 'kode' 	=> $this->kode,
								 'nama' 	=> $this->nama,
								 'deskripsi' => $this->deskripsi);

	            $messageData = $this->load->model('master_departemen_model', 'ModelUbahJabatan');
	            $messageData = $this->ModelUbahJabatan->UbahDepartemen($arrData);
	            echo $messageData;
        	}
		}

		public function HapusDepartemen()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

			$this->IDJabatan = $this->input->post('IDJabatan', true);
			
            $messageData = $this->load->model('master_jabatan_model', 'ModelHapusJabatan');
            $messageData = $this->ModelHapusJabatan->HapusJabatan($this->IDJabatan);
            echo $messageData;
			
		}

//----------------------------- END DEPARTEMEN -----------------------------------------------------------------------------------------------------------------
//----------------------------- KEGIATAN----------------------------------------------------------------------------------------------
		public function Kegiatan()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

           	$content = $this->load->view('master_kegiatan_view', true);                

            echo  $content;
		}

		public function GetDaftarKegiatan()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            
            $this->load->model("master_kegiatan_model", "ModelMasterKegiatan");
            
            echo $this->ModelMasterKegiatan->GetDaftarKegiatan(); 
		}

		public function TambahKegiatan()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

            $this->form_validation->set_rules('kodeJabatan', 'Kode Jabatan', 'trim|required|is_unique[ref_jabatan.kode_jabatan]|min_length[1]|xss_clean');
    		$this->form_validation->set_rules('namaJabatan', 'Nama Jabatan', 'trim|required|xss_clean');
    		
			if ( ! $this->form_validation->run() )
			{				
				$errorMessage = form_error('kodeJabatan').form_error('namaJabatan');
				$messageData = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{

				$this->kode 	= $this->input->post('kodeJabatan', true); 
				$this->nama		= $this->input->post('namaJabatan', true); 	
				$this->deskripsi = $this->input->post('deskripsi', true);
				
				$arrData = array('kode' 	=> $this->kode,
								 'nama' 	=> $this->nama,
								 'deskripsi' => $this->deskripsi);

	            $messageData = $this->load->model('master_kegiatan_model', 'ModelTambahKegiatan');
	            $messageData = $this->ModelTambahKegiatan->TambahKegiatan($arrData);
	            echo $messageData;
        	}
		}

		public function UbahKegiatan()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

          	$this->form_validation->set_rules('IDJabatan', 'Jabatan', 'trim|required|min_length[1]|xss_clean');
            $this->form_validation->set_rules('kodeJabatanUbah', 'Kode Jabatan', 'trim|required|min_length[1]|xss_clean');
    		$this->form_validation->set_rules('namaJabatanUbah', 'Nama Jabatan', 'trim|required|xss_clean');

			if ( ! $this->form_validation->run() )
			{				
				$errorMessage = form_error('IDJabatan').form_error('kodeJabatanUbah').form_error('namaJabatanUbah');
				$messageData = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{

				$this->IDJabatan 	= $this->input->post('IDJabatan', true);
				$this->kode 	= $this->input->post('kodeJabatanUbah', true); 
				$this->nama		= $this->input->post('namaJabatanUbah', true); 	
				$this->deskripsi = $this->input->post('deskripsiUbah', true);
				
				$arrData = array('IDJabatan'=> $this->IDJabatan,
								 'kode' 	=> $this->kode,
								 'nama' 	=> $this->nama,
								 'deskripsi' => $this->deskripsi);

	            $messageData = $this->load->model('master_kegiatan_model', 'ModelUbahKegiatan');
	            $messageData = $this->ModelUbahKegiatan->UbahKegiatan($arrData);
	            echo $messageData;
        	}
		}

		public function HapusKegiatan()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

			$this->ID = $this->input->post('IDJabatan', true);
			
            $messageData = $this->load->model('master_kegiatan_model', 'ModelHapusKegiatan');
            $messageData = $this->ModelHapusKegiatan->HapusKegiatan($this->ID);
            echo $messageData;
			
		}

//---------------------- END KEGIATAN -----------------------------------------------------------------------------------------------------------------

		public function GetDaftarSumberdana()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();

            

            $this->load->model("master_sumberdana_model", "ModelMasterSumberdana");

            

            echo $this->ModelMasterSumberdana->GetDaftarSumberdana(); 

		}



		public function TambahSumberdana()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



    		$this->form_validation->set_rules('kode', 'Kode Sumberdana', 'trim|is_unique[mst_sumberdana.kode]|required|min_length[1]|xss_clean');

    		$this->form_validation->set_rules('nama', 'Nama Sumberdana', 'trim|required|xss_clean');

			$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|xss_clean');

	

			if ( ! $this->form_validation->run() )

			{				

				$errorMessage = form_error('kode').form_error('nama');

				$messageData = ConstructMessageResponse($errorMessage , 'warning');

				echo $messageData;

			}

			else

			{

				$this->kode 		= $this->input->post('kode', true); 	

				$this->nama 		= $this->input->post('nama', true);

				$this->deskripsi 	= $this->input->post('deskripsi', true);

				

				$arrData = array('kode' => $this->kode,

								 'nama'	=> $this->nama,

								 'deskripsi' => $this->deskripsi);



	            $messageData = $this->load->model('master_sumberdana_model', 'ModelTambahSumberdana');

	            $messageData = $this->ModelTambahSumberdana->TambahSumberdana($arrData);

	            echo $messageData;

        	}

		}



		public function UbahSumberdana()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



            $this->form_validation->set_rules('ID', 'ID Sumberdana', 'trim|required|xss_clean');

    		$this->form_validation->set_rules('kodeUbah', 'Kode Sumberdana', 'trim|required|min_length[1]|xss_clean');

    		$this->form_validation->set_rules('namaUbah', 'Nama Sumberdana', 'trim|required|xss_clean');

			$this->form_validation->set_rules('deskripsiUbah', 'Deskripsi', 'trim|xss_clean');

	

			if ( ! $this->form_validation->run() )

			{				

				$errorMessage = form_error('ID').form_error('kodeUbah').form_error('namaUbah');

				$messageData = ConstructMessageResponse($errorMessage , 'warning');

				echo $messageData;

			}

			else

			{

				$this->ID 			= $this->input->post('ID', true); 	

				$this->kode 		= $this->input->post('kodeUbah', true); 	

				$this->nama 		= $this->input->post('namaUbah', true);

				$this->deskripsi 	= $this->input->post('deskripsiUbah', true);

				

				$arrData = array('Idx'	=> $this->ID,

								 'kode' => $this->kode,

								 'nama'	=> $this->nama,

								 'deskripsi' => $this->deskripsi);

	

	            $messageData = $this->load->model('master_sumberdana_model', 'ModelUbahSumberdana');

	            $messageData = $this->ModelUbahSumberdana->UbahSumberdana($arrData);

	            echo $messageData;

        	}

		}



		public function HapusSumberdana()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



			$this->ID = $this->input->post('ID', true);

			

            $messageData = $this->load->model('master_sumberdana_model', 'ModelHapusSumberdana');

            $messageData = $this->ModelHapusSumberdana->HapusSumberdana($this->ID);

            echo $messageData;

			

		} 



		public function MataUang()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();





            $content = $this->load->view('master_matauang_view', '', true);

                          

            echo $content;

		}



		public function GetDaftarMataUang()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();

            

            $this->load->model("master_matauang_model", "ModelMasterMataUang");

            

            echo $this->ModelMasterMataUang->GetDaftarMataUang(); 

		}



		public function TambahMataUang()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



    		$this->form_validation->set_rules('kode', 'Kode MataUang', 'trim|is_unique[mst_matauang.kode]|required|min_length[1]|xss_clean');

    		$this->form_validation->set_rules('nama', 'Nama MataUang', 'trim|required|xss_clean');

    		$this->form_validation->set_rules('nilaiTukar', 'Nilai Tukar', 'trim|required|xss_clean');

			$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|xss_clean');

	

			if ( ! $this->form_validation->run() )

			{				

				$errorMessage = form_error('kode').form_error('nama').form_error('nilaiTukar');

				$messageData = ConstructMessageResponse($errorMessage , 'warning');

				echo $messageData;

			}

			else

			{

				$this->kode 		= $this->input->post('kode', true); 	

				$this->nama 		= $this->input->post('nama', true);

				$this->nilaiTukar 	= $this->input->post('nilaiTukar', true);

				$this->deskripsi 	= $this->input->post('deskripsi', true);

				

				$arrData = array('kode' 		=> $this->kode,

								 'nama'			=> $this->nama,

								 'nilaiTukar'	=> $this->nilaiTukar,

								 'deskripsi' 	=> $this->deskripsi);



	            $messageData = $this->load->model('master_matauang_model', 'ModelTambahMataUang');

	            $messageData = $this->ModelTambahMataUang->TambahMataUang($arrData);

	            echo $messageData;

        	}

		}



		public function UbahMataUang()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



            $this->form_validation->set_rules('ID', 'ID MataUang', 'trim|required|xss_clean');

    		$this->form_validation->set_rules('kodeUbah', 'Kode MataUang', 'trim|required|min_length[1]|xss_clean');

    		$this->form_validation->set_rules('namaUbah', 'Nama MataUang', 'trim|required|xss_clean');

    		$this->form_validation->set_rules('nilaiTukarUbah', 'Nilai tukar', 'trim|required|xss_clean');

			$this->form_validation->set_rules('deskripsiUbah', 'Deskripsi', 'trim|xss_clean');

	

			if ( ! $this->form_validation->run() )

			{				

				$errorMessage = form_error('ID').form_error('kodeUbah').form_error('nilaiTukarUbah').form_error('namaUbah');

				$messageData = ConstructMessageResponse($errorMessage , 'warning');

				echo $messageData;

			}

			else

			{

				$this->ID 			= $this->input->post('ID', true); 	

				$this->kode 		= $this->input->post('kodeUbah', true); 	

				$this->nama 		= $this->input->post('namaUbah', true);

				$this->nilaiTukar 	= $this->input->post('nilaiTukarUbah', true);

				$this->deskripsi 	= $this->input->post('deskripsiUbah', true);

				

				$arrData = array('Idx'			=> $this->ID,

								 'kode' 		=> $this->kode,

								 'nama'			=> $this->nama,

								 'nilaiTukar'	=> $this->nilaiTukar,

								 'deskripsi' 	=> $this->deskripsi);

	

	            $messageData = $this->load->model('master_matauang_model', 'ModelUbahMataUang');

	            $messageData = $this->ModelUbahMataUang->UbahMataUang($arrData);

	            echo $messageData;

        	}

		}



		public function HapusMataUang()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



			$this->ID = $this->input->post('ID', true);

			

            $messageData = $this->load->model('master_matauang_model', 'ModelHapusMataUang');

            $messageData = $this->ModelHapusMataUang->HapusMataUang($this->ID);

            echo $messageData;

			

		}  



		public function JenisKontak()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();





            $content = $this->load->view('master_jeniskontak_view', '', true);

                          

            echo $content;

		}



		public function GetDaftarJenisKontak()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();

            

            $this->load->model("master_jeniskontak_model", "ModelMasterJenisKontak");

            

            echo $this->ModelMasterJenisKontak->GetDaftarJenisKontak(); 

		}



		public function TambahJenisKontak()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



    		$this->form_validation->set_rules('kode', 'Kode jenis kontak', 'trim|is_unique[mst_kontakjenis.kode]|required|min_length[1]|xss_clean');

    		$this->form_validation->set_rules('nama', 'Nama jenis kontak', 'trim|required|xss_clean');

			$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|xss_clean');

	

			if ( ! $this->form_validation->run() )

			{				

				$errorMessage = form_error('kode').form_error('nama');

				$messageData = ConstructMessageResponse($errorMessage , 'warning');

				echo $messageData;

			}

			else

			{

				$this->kode 		= $this->input->post('kode', true); 	

				$this->nama 		= $this->input->post('nama', true);

				$this->deskripsi 	= $this->input->post('deskripsi', true);

				

				$arrData = array('kode' => $this->kode,

								 'nama'	=> $this->nama,

								 'deskripsi' => $this->deskripsi);



	            $messageData = $this->load->model('master_jeniskontak_model', 'ModelTambahJenisKontak');

	            $messageData = $this->ModelTambahJenisKontak->TambahJenisKontak($arrData);

	            echo $messageData;

        	}

		}



		public function UbahJenisKontak()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



            $this->form_validation->set_rules('ID', 'ID JenisKontak', 'trim|required|xss_clean');

    		$this->form_validation->set_rules('kodeUbah', 'Kode jenis kontak', 'trim|required|min_length[1]|xss_clean');

    		$this->form_validation->set_rules('namaUbah', 'Nama jenis kontak', 'trim|required|xss_clean');

			$this->form_validation->set_rules('deskripsiUbah', 'Deskripsi', 'trim|xss_clean');

	

			if ( ! $this->form_validation->run() )

			{				

				$errorMessage = form_error('ID').form_error('kodeUbah').form_error('namaUbah');

				$messageData = ConstructMessageResponse($errorMessage , 'warning');

				echo $messageData;

			}

			else

			{

				$this->ID 			= $this->input->post('ID', true); 	

				$this->kode 		= $this->input->post('kodeUbah', true); 	

				$this->nama 		= $this->input->post('namaUbah', true);

				$this->deskripsi 	= $this->input->post('deskripsiUbah', true);

				

				$arrData = array('Idx'	=> $this->ID,

								 'kode' => $this->kode,

								 'nama'	=> $this->nama,

								 'deskripsi' => $this->deskripsi);

	

	            $messageData = $this->load->model('master_jeniskontak_model', 'ModelUbahJenisKontak');

	            $messageData = $this->ModelUbahJenisKontak->UbahJenisKontak($arrData);

	            echo $messageData;

        	}

		}



		public function HapusJenisKontak()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



			$this->ID = $this->input->post('ID', true);

			

            $messageData = $this->load->model('master_jeniskontak_model', 'ModelHapusJenisKontak');

            $messageData = $this->ModelHapusJenisKontak->HapusJenisKontak($this->ID);

            echo $messageData;

			

		}  



		public function Kontak()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();

            $cari = $this->db->query("SELECT * FROM mst_kontak where idtipe= 1 ORDER BY kode DESC LIMIT 1");
			$datanomor = $this->db->query("SELECT * FROM mst_kontak where idtipe= 1 ORDER BY kode DESC LIMIT 1")->row();

			$cari1 = $this->db->query("SELECT * FROM mst_kontak where idtipe= 2 ORDER BY kode DESC LIMIT 1");
			$datanomor1 = $this->db->query("SELECT * FROM mst_kontak where idtipe= 2 ORDER BY kode DESC LIMIT 1")->row();

			$cari2 = $this->db->query("SELECT * FROM mst_kontak where idtipe= 3 ORDER BY kode DESC LIMIT 1");
			$datanomor2 = $this->db->query("SELECT * FROM mst_kontak where idtipe= 3 ORDER BY kode DESC LIMIT 1")->row();
			
				$data['mohon'] = $datanomor->kode;			 	
			 	$data['mohon1'] = $datanomor1->kode;
			 	$data['mohon2'] = $datanomor2->kode;
			 	
			

            $content = $this->load->view('master_kontak_view', $data, true);

                          

            echo $content;

		}



		public function GetKontak($tipe = null)

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();

            

            $this->load->model("master_kontak_model", "ModelMasterKontak");


            echo $this->ModelMasterKontak->GetDaftarKontak($tipe); 

		}



		public function TambahKontak()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



            $this->form_validation->set_rules('tipe', 'Tipe Kontak', 'trim|required|min_length[1]|xss_clean');

            $this->form_validation->set_rules('jenis', 'Jenis Kontak', 'trim|required|min_length[1]|xss_clean');

    		$this->form_validation->set_rules('kode', 'Kode Kontak', 'trim|is_unique[mst_kontak.kode]|required|min_length[1]|xss_clean');

    		$this->form_validation->set_rules('nama', 'Nama Kontak', 'trim|required|xss_clean');

	

			if ( ! $this->form_validation->run() )

			{				

				$errorMessage = form_error('tipe').form_error('jenis').form_error('kode').form_error('nama');

				$messageData = ConstructMessageResponse($errorMessage , 'warning');

				echo $messageData;

			}

			else

			{

				$this->tipe 		= $this->input->post('tipe', true); 	

				$this->jenis 		= $this->input->post('jenis', true);

				$this->kode 		= $this->input->post('kode', true); 	

				$this->nama 		= $this->input->post('nama', true);

				$this->alamat 		= $this->input->post('alamat', true);

				$this->kodepos 		= $this->input->post('kodepos', true);

				$this->notelp 		= $this->input->post('notelp', true);

				//$this->nofax 		= $this->input->post('nofax', true);

				$this->email 		= $this->input->post('email', true);

				//$this->website 		= $this->input->post('website', true);

				$this->pic 			= $this->input->post('pic', true);

				$this->deskripsi 	= $this->input->post('deskripsi', true);

				

				$arrData = array('tipe' 	 => $this->tipe,

								 'jenis' 	 => $this->jenis,

								 'kode' 	 => $this->kode,

								 'nama' 	 => $this->nama,

								 'alamat'	 => $this->alamat,

								 'kodepos'	 => $this->kodepos,

								 'notelp'	 => $this->notelp,

								 //'nofax'	 => $this->nofax,

								 'email'	 => $this->email,

								 //'website'	 => $this->website,

								 'pic'		 => $this->pic,

								 'deskripsi' => $this->deskripsi);



	            $messageData = $this->load->model('master_kontak_model', 'ModelTambahKontak');

	            $messageData = $this->ModelTambahKontak->TambahKontak($arrData);

	            echo $messageData;

        	}

		}



		public function UbahKontak()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



            $this->form_validation->set_rules('ID', 'ID Kontak', 'trim|required|xss_clean');

            $this->form_validation->set_rules('jenisUbah', 'Jenis Kontak', 'trim|required|min_length[1]|xss_clean');

    		$this->form_validation->set_rules('tipeUbah', 'Tipe Kontak', 'trim|required|min_length[1]|xss_clean');

    		$this->form_validation->set_rules('kodeUbah', 'Kode Kontak', 'trim|required|min_length[1]|xss_clean');

    		$this->form_validation->set_rules('namaUbah', 'Nama Kontak', 'trim|required|xss_clean');

	

			if ( ! $this->form_validation->run() )

			{				

				$errorMessage = form_error('ID').form_error('jenisUbah').form_error('tipeUbah').form_error('kodeUbah').form_error('namaUbah');

				$messageData = ConstructMessageResponse($errorMessage , 'warning');

				echo $messageData;

			}

			else

			{

				$this->ID 			= $this->input->post('ID', true); 	

				$this->tipe 		= $this->input->post('tipeUbah', true); 	

				$this->jenis 		= $this->input->post('jenisUbah', true);

				$this->kode 		= $this->input->post('kodeUbah', true); 	

				$this->nama 		= $this->input->post('namaUbah', true);

				$this->alamat 		= $this->input->post('alamatUbah', true);

				$this->kodepos 		= $this->input->post('kodeposUbah', true);

				$this->notelp 		= $this->input->post('notelpUbah', true);

				$this->nofax 		= $this->input->post('nofaxUbah', true);

				$this->email 		= $this->input->post('emailUbah', true);

				$this->website 		= $this->input->post('websiteUbah', true);

				$this->pic 			= $this->input->post('picUbah', true);

				$this->deskripsi 	= $this->input->post('deskripsiUbah', true);

				

				

				$arrData = array('idx' 	     => $this->ID,

								 'tipe' 	 => $this->tipe,

								 'jenis' 	 => $this->jenis,

								 'kode' 	 => $this->kode,

								 'nama' 	 => $this->nama,

								 'alamat'	 => $this->alamat,

								 'kodepos'	 => $this->kodepos,

								 'notelp'	 => $this->notelp,

								 'nofax'	 => $this->nofax,

								 'email'	 => $this->email,

								 'website'	 => $this->website,

								 'pic'		 => $this->pic,

								 'deskripsi' => $this->deskripsi);

	

	            $messageData = $this->load->model('master_kontak_model', 'ModelUbahKontak');

	            $messageData = $this->ModelUbahKontak->UbahKontak($arrData);

	            echo $messageData;

        	}

		}



		public function HapusKontak()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



			$this->ID = $this->input->post('ID', true);

			

            $messageData = $this->load->model('master_kontak_model', 'ModelHapusKontak');

            $messageData = $this->ModelHapusKontak->HapusKontak($this->ID);

            echo $messageData;

			

		}



		public function KasBank()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();


            $content = $this->load->view('master_kasbank_view', '', true);

                          

            echo $content;

		}



		public function GetDaftarKasBank()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();

            

            $this->load->model("master_kasbank_model", "ModelMasterKasBank");

            

            echo $this->ModelMasterKasBank->GetDaftarKasBank(); 

		}



		public function TambahKasBank()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



            //$this->form_validation->set_rules('matauang', 'Mata uang', 'trim|required|min_length[1]|xss_clean');

    		$this->form_validation->set_rules('kodebaru', 'Kode Kas Bank', 'trim|is_unique[mst_kasbank.kode_kasbank]|required|min_length[1]|xss_clean');

    		$this->form_validation->set_rules('namabaru', 'Nama Kas Bank', 'trim|required|xss_clean');

    		$this->form_validation->set_rules('norekbankbaru', 'No rekening Bank', 'trim|required|xss_clean');

    		$this->form_validation->set_rules('namabankbaru', 'Nama rekening Bank', 'trim|required|xss_clean');

	

			if ( ! $this->form_validation->run() )

			{				

				$errorMessage = form_error('kodebaru').form_error('namabaru').form_error('norekbankbaru').form_error('namabankbaru');

				$messageData = ConstructMessageResponse($errorMessage , 'warning');

				echo $messageData;

			}

			else

			{

				
				$this->kode 		= $this->input->post('kodebaru', true); 	

				$this->nama 		= $this->input->post('namabaru', true);

				$this->norekbank 	= $this->input->post('norekbankbaru', true);

				$this->namabank 	= $this->input->post('namabankbaru', true);

				//$this->notaktif 	= $this->input->post('notaktif', true);

				$this->deskripsi 	= $this->input->post('deskripsibaru', true);



				$arrData = array('kode_kasbank' 	 => $this->kode,

								 'nama_kasbank' 	 => $this->nama,

								 'norek_bank' => $this->norekbank,

								 'nama_bank'	 => $this->namabank,

								 //'status'	 => $this->notaktif,

								 'deskripsi_kasbank' => $this->deskripsi);



	            $messageData = $this->load->model('master_kasbank_model', 'ModelTambahKasBank');

	            $messageData = $this->ModelTambahKasBank->TambahKasBank($arrData);

	            echo $messageData;

        	}

		}



		public function UbahKasBank()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



            //$this->form_validation->set_rules('ID', 'ID KasBank', 'trim|required|xss_clean');            

    		$this->form_validation->set_rules('kodeUbah', 'Kode KasBank', 'trim|required|xss_clean');

    		$this->form_validation->set_rules('namaUbah', 'Nama KasBank', 'trim|required|xss_clean');

	

			if ( ! $this->form_validation->run() )

			{				

				$errorMessage = form_error('ID').form_error('mataUangUbah').form_error('kodeUbah').form_error('namaUbah');

				$messageData = ConstructMessageResponse($errorMessage , 'warning');

				echo $messageData;

			}

			else

			{

				$this->ID 			= $this->input->post('ID', true); 					

				$this->kode 		= $this->input->post('kodeUbah', true); 	

				$this->nama 		= $this->input->post('namaUbah', true);

				$this->norekbank 	= $this->input->post('norekbankUbah', true);

				$this->namabank 	= $this->input->post('namabankUbah', true);

				$this->notAktif 	= $this->input->post('notAktifUbah', true);

				$this->deskripsi 	= $this->input->post('deskripsiUbah', true);

				

				$arrData = array('idx' 	     => $this->ID,

								 'kode' 	 => $this->kode,

								 'nama' 	 => $this->nama,

								 'norekbank' => $this->norekbank,

								 'namabank'	 => $this->namabank,

								 'notAktif'	 => $this->notAktif,

								 'deskripsi' => $this->deskripsi);

			

	            $messageData = $this->load->model('master_kasbank_model', 'ModelUbahKasBank');

	            $messageData = $this->ModelUbahKasBank->UbahKasBank($arrData);

	            echo $messageData;

        	}

		}



		public function HapusKasBank()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



			$this->ID = $this->input->post('ID', true);

			

            $messageData = $this->load->model('master_kasbank_model', 'ModelHapusKasBank');

            $messageData = $this->ModelHapusKasBank->HapusKasBank($this->ID);

            echo $messageData;

			

		}



		public function Perusahaan()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();

         

            $this->load->model("master_perusahaan_model", "ModelPerusahaan");

            $data = array("data" => $this->ModelPerusahaan->GetDaftarPerusahaan());



            $content = $this->load->view('master_perusahaan_view', $data, true);

                          

            echo $content;

		}



		public function UbahPerusahaan()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



            $this->form_validation->set_rules('periodeUbah', 'Periode', 'trim|required|min_length[1]|xss_clean');

    		$this->form_validation->set_rules('kodeUbah', 'Kode Perusahaan', 'trim|required|min_length[1]|xss_clean');

    		$this->form_validation->set_rules('namaUbah', 'Nama Perusahaan', 'trim|required|xss_clean');

	

			if ( ! $this->form_validation->run() )

			{				

				$errorMessage 	= form_error('periodeUbah').form_error('kodeUbah').form_error('namaUbah');

				$messageData 	= ConstructMessageResponse($errorMessage , 'warning');

				echo $messageData;

			}

			else

			{

				$this->periode	= $this->input->post('periodeUbah', true); 	

				$this->kode 	= $this->input->post('kodeUbah', true); 	

				$this->nama 	= $this->input->post('namaUbah', true);

				$this->alamat 	= $this->input->post('alamatUbah', true);

				$this->kodepos 	= $this->input->post('kodeposUbah', true);

				$this->notelp 	= $this->input->post('notelpUbah', true);

				$this->nofax 	= $this->input->post('nofaxUbah', true);

				$this->noPajak 	= $this->input->post('nofakturpajakUbah', true);

				$this->npwp 	= $this->input->post('npwpUbah', true);

				$this->email 	= $this->input->post('emailUbah', true);

				$this->website 	= $this->input->post('websiteUbah', true);

				$this->pic 		= $this->input->post('picUbah', true);

				$this->tglAwal 	= $this->input->post('tanggalAwalUbah', true);

				$this->tglAkhir = $this->input->post('tanggalAkhirUbah', true);

				

				$arrData = array('periode'  => $this->periode,

								 'kode' 	=> $this->kode,

								 'nama' 	=> $this->nama,

								 'alamat' 	=> $this->alamat,

								 'kodepos'	=> $this->kodepos,

								 'notelp' 	=> $this->notelp,

								 'nofax' 	=> $this->nofax,

								 'npwp'	 	=> $this->npwp,

								 'noPajak' 	=> $this->noPajak,

								 'email'	=> $this->email,

								 'website'	=> $this->website,

								 'pic'	 	=> $this->pic,

								 'tglAwal' 	=> $this->tglAwal,

								 'tglAkhir'	=> $this->tglAkhir);

			

	            $messageData = $this->load->model('master_perusahaan_model', 'ModelUbahPerusahaan');

	            $messageData = $this->ModelUbahPerusahaan->UbahPerusahaan($arrData);

	            echo $messageData;

        	}

		}



       	public function showSubMenu()

       	{

       		$modul = $this->input->post('modul', true);



       		$this->load->model('modul_model', 'ModelModul');

	        $menu = $this->ModelModul->GetMenu($modul);

	    	

	    	if ($menu <> '')

	    	{		

	       		echo '<header class="main-header noZIndex" role="subMenu" tipe="subMenu">

	       				<nav role="navigation" class="navbar navbar-static-top noZIndex">

		                	<div style="padding-left:10px;padding-top:5px;">

		                   		'.$menu.'

		                	</div>

		            	</nav>

		            </header>

		         	<script type="text/javascript">



			           	$(document).ready(function()

			           	{

			              

				            $(\'a[role="linkMenu"]\').click(function(e)

			              	{   

				                e.preventDefault();

				                $(\'header[tipe="subMenuChild"]\').remove();

				                $(\'a[role="linkMenu"]\').attr("class","btn btn-sm btn-default");

				                $(\'a[role="linkMenuChild"]\').attr("class","btn btn-sm btn-default");

				                $(this).attr("class","btn btn-sm btn-warning");

				                ajaxLinkURL($(this).attr("href"), "content-wrapper");       

					        }); 



	 						$(\'a[role="linkMenuChild"]\').click(function(e)

			              	{   

					            e.preventDefault();

					            $(\'header[tipe="subMenuChild"]\').remove();

				                $(\'a[role="linkMenu"]\').attr("class","btn btn-sm btn-default");

				                $(\'a[role="linkMenuChild"]\').attr("class","btn btn-sm btn-default");

				                $(this).attr("class","btn btn-sm btn-warning");



				                var subMenuChild = ajaxFillGridJSON("setup/showSubMenuChild", {Idx : $(this).attr("Idx")});



				                if (subMenuChild !== "")

				                {

					              	var isActive	= $(this).attr("isActive") == "true";

					                var strStatus 	= isActive ? "false" : "true";

					                var strColor 	= isActive ? "default" : "warning";

					                

					                $(\'[role="linkMenu"][isActive="true"]\').attr("isActive", "false");

					                $(\'[role="linkMenuChild"][isActive="true"]\').attr("isActive", "false");



					                $(this).attr("isActive", strStatus);

					                $(this).attr("class", "btn btn-"+strColor +" btn-sm"); 



									if (!isActive)

										$(\'<header class="main-header noZIndex" role="subMenu" tipe="subMenuChild">\'+subMenuChild+\'</div>\').insertAfter( ".main-header:last");

									else

									 	$(\'.main-header[role="subMenuChild"]:last\').remove();			

				            	}



					        }); 

						            

						});



					</script>';

			}	



       	}



       	public function showSubMenuChild()

       	{

       		$Idx = $this->input->post('Idx', true);



       		$this->load->model('modul_model', 'ModelModul');

	        $menu = $this->ModelModul->GetChildMenu($Idx);

	  

	  		if ($menu <> '')

	  		{

       			echo '<header class="main-header noZIndex" role="subMenu" tipe="subMenuChild">

		       			<nav role="navigation" class="navbar navbar-static-top noZIndex">

			            	<div style="padding-left:10px;">

			                  '.$menu.'

			                </div>

			            </nav>

			          </header>  	



	            	<script type="text/javascript">

						$(\'a[role="linkSubMenu"]\').click(function(e)

		              	{   

			                e.preventDefault();

			                $(\'a[role="linkSubMenu"]\').attr("class","btn btn-sm btn-default");

			                $(this).attr("class","btn btn-sm btn-warning");

			                ajaxLinkURL($(this).attr("href"), "content-wrapper");   

				        });

					</script>';

	        }



       	}



       	public function GetPeriodeLaporanAjax()

       	{

       		$periode = $this->input->post('periode', true);



       		$messageData = $this->load->model('master_perusahaan_model', 'ModelPerusahaan');

	        $messageData = $this->ModelPerusahaan->GetPeriodeLaporanAjax($periode);

	         

	        echo $messageData;

       	}



		public function Pemasukan()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



            $content = $this->load->view('master_pemasukan_view', '', true);

                          

            echo $content;

		}



		public function GetDaftarPemasukan()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();

            

            $this->load->model("master_pemasukan_model", "ModelMasterPemasukan");

            

            echo $this->ModelMasterPemasukan->GetDaftarPemasukan(); 

		}



		public function TambahPemasukan()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



    		$this->form_validation->set_rules('kodebaru', 'Kode Pemasukan', 'trim|is_unique[mst_pemasukan.kode_pemasukan]|required|min_length[1]|xss_clean');

    		$this->form_validation->set_rules('namabaru', 'Nama Pemasukan', 'trim|required|xss_clean');

	

			if ( ! $this->form_validation->run() )

			{				

				$errorMessage = form_error('kodebaru').form_error('namabaru');

				$messageData = ConstructMessageResponse($errorMessage , 'warning');

				echo $messageData;

			}

			else

			{

				$this->kode 	= $this->input->post('kodebaru', true); 	

				$this->nama 	= $this->input->post('namabaru', true);

				

				$arrData = array('kode' => $this->kode,

								 'nama'	=> $this->nama);



	            $messageData = $this->load->model('master_pemasukan_model', 'ModelTambahPemasukan');

	            $messageData = $this->ModelTambahPemasukan->TambahPemasukan($arrData);

	            echo $messageData;

        	}

		}



		public function UbahPemasukan()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



            $this->form_validation->set_rules('ID', 'ID Pemasukan', 'trim|required|xss_clean');

    		$this->form_validation->set_rules('kodeUbah', 'Kode Pemasukan', 'trim|required|xss_clean');

    		$this->form_validation->set_rules('namaUbah', 'Nama Pemasukan', 'trim|required|xss_clean');

	

			if ( ! $this->form_validation->run() )

			{				

				$errorMessage = form_error('ID').form_error('kodeUbah').form_error('namaUbah');

				$messageData = ConstructMessageResponse($errorMessage , 'warning');

				echo $messageData;

			}

			else

			{

				$this->ID 		= $this->input->post('ID', true); 	

				$this->kode 	= $this->input->post('kodeUbah', true); 	

				$this->nama 	= $this->input->post('namaUbah', true);

				

				$arrData = array('Idx'	=> $this->ID,

								 'kode' => $this->kode,

								 'nama'	=> $this->nama);

	

	            $messageData = $this->load->model('master_pemasukan_model', 'ModelUbahPemasukan');

	            $messageData = $this->ModelUbahPemasukan->UbahPemasukan($arrData);

	            echo $messageData;

        	}

		}



		public function HapusPemasukan()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



			$this->Kode = $this->input->post('Kode', true);

			

            $messageData = $this->load->model('master_pemasukan_model', 'ModelHapusPemasukan');

            $messageData = $this->ModelHapusPemasukan->HapusPemasukan($this->Kode);

            echo $messageData;

			

		} 



		public function Pengeluaran()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



            $content = $this->load->view('master_pengeluaran_view', '', true);

                          

            echo $content;

		}



		public function GetDaftarPengeluaran()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();

            

            $this->load->model("master_pengeluaran_model", "ModelMasterPengeluaran");

            

            echo $this->ModelMasterPengeluaran->GetDaftarPengeluaran(); 

		}



		public function TambahPengeluaran()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



    		$this->form_validation->set_rules('kode', 'Kode Pengeluaran', 'trim|is_unique[mst_pengeluaran.kode]|required|min_length[1]|xss_clean');

    		$this->form_validation->set_rules('nama', 'Nama Pengeluaran', 'trim|required|xss_clean');

	

			if ( ! $this->form_validation->run() )

			{				

				$errorMessage = form_error('kode').form_error('nama');

				$messageData = ConstructMessageResponse($errorMessage , 'warning');

				echo $messageData;

			}

			else

			{

				$this->kode 	= $this->input->post('kode', true); 	

				$this->nama 	= $this->input->post('nama', true);

				

				$arrData = array('kode' => $this->kode,

								 'nama'	=> $this->nama);



	            $messageData = $this->load->model('master_pengeluaran_model', 'ModelTambahPengeluaran');

	            $messageData = $this->ModelTambahPengeluaran->TambahPengeluaran($arrData);

	            echo $messageData;

        	}

		}



		public function UbahPengeluaran()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



            $this->form_validation->set_rules('ID', 'ID Pengeluaran', 'trim|required|xss_clean');

    		$this->form_validation->set_rules('kodeUbah', 'Kode Pengeluaran', 'trim|required|min_length[1]|xss_clean');

    		$this->form_validation->set_rules('namaUbah', 'Nama Pengeluaran', 'trim|required|xss_clean');

	

			if ( ! $this->form_validation->run() )

			{				

				$errorMessage = form_error('ID').form_error('kodeUbah').form_error('namaUbah');

				$messageData = ConstructMessageResponse($errorMessage , 'warning');

				echo $messageData;

			}

			else

			{

				$this->ID 		= $this->input->post('ID', true); 	

				$this->kode 	= $this->input->post('kodeUbah', true); 	

				$this->nama 	= $this->input->post('namaUbah', true);

				

				$arrData = array('Idx'	=> $this->ID,

								 'kode' => $this->kode,

								 'nama'	=> $this->nama);

	

	            $messageData = $this->load->model('master_pengeluaran_model', 'ModelUbahPengeluaran');

	            $messageData = $this->ModelUbahPengeluaran->UbahPengeluaran($arrData);

	            echo $messageData;

        	}

		}



		public function HapusPengeluaran()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



			$this->Kode = $this->input->post('Kode', true);

			

            $messageData = $this->load->model('master_pengeluaran_model', 'ModelHapusPengeluaran');

            $messageData = $this->ModelHapusPengeluaran->HapusPengeluaran($this->Kode);

            echo $messageData;

			

		} 

		function getalamat()
		{
			//echo "<pre>";print_r($_POST);"</pre>";
			//exit();
			$kecamatan = $this->input->post("kecamatan");
			$kelurahan = $this->input->post("kelurahan");
			$pedukuhan = $this->input->post("pedukuhan");
			$rtrw = $this->db->query("SELECT ref_rt.* from ref_rt inner join ref_pedukuhan on ref_rt.id_pedukuhan = ref_pedukuhan.id_pedukuhan
			inner join ref_kelurahan on ref_pedukuhan.id_kelurahan = ref_kelurahan.id_kelurahan
			inner join ref_kecamatan on ref_kecamatan.id_kecamatan = ref_kelurahan.id_kecamatan
			WHERE ref_kecamatan.id_kecamatan = '".$kecamatan."' AND ref_kelurahan.id_kelurahan = '".$kelurahan."' AND ref_pedukuhan.id_pedukuhan = '".$pedukuhan."'");
			
			if($rtrw->num_rows() > 0)
			{
				foreach($rtrw->result() as $row)
				{
					$data['id_rt'] = $row->id_rt;
					$data['kode_rt'] = $row->kode_rt;
					$data['nama_rt'] = $row->nama_rt;
					
					$json['alamat'][] = $data;
				}
				$json['status'] = true;
			}
			else
			{
				$json['status'] = false;
			}
			
			echo json_encode($json);
		}

		function get_refrt()
		{
			
			
			$idkel = $this->input->post("idrt");
			
			$desa = $this->db->query("SELECT ref_rt.nama_rt as nama_rt, ref_pedukuhan.nama_pedukuhan as nama_pedukuhan, ref_rt.id_rt as id_rt,
			ref_kelurahan.nama_kelurahan nama_kelurahan, ref_kecamatan.nama_kecamatan as nama_kecamatan, ref_kelurahan.kode_pos as kode_pos
			from ref_rt inner join ref_pedukuhan on ref_rt.id_pedukuhan = ref_pedukuhan.id_pedukuhan
			inner join ref_kelurahan on ref_pedukuhan.id_kelurahan = ref_kelurahan.id_kelurahan
			inner join ref_kecamatan on ref_kecamatan.id_kecamatan = ref_kelurahan.id_kecamatan WHERE ref_rt.id_rt = '".$idkel."'")->row();
			
			$data['id_rt'] = $desa->id_rt;
			$data['nama_rt'] = $desa->nama_rt;
			$data['kode_pos'] = $desa->kode_pos;
			$data['nama_pedukuhan'] = $desa->nama_pedukuhan;
			$data['nama_kelurahan'] = $desa->nama_kelurahan;
			$data['nama_kecamatan'] = $desa->nama_kecamatan;
			
			$json = json_encode($data);
			//echo "<pre>";print_r($json);"</pre>";
			echo $json;
		}
	}

/* End of file admin.php */

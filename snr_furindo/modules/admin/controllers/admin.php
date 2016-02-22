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

    public function editso()
    {
      //echo "<pre>";print_r($_POST);"</pre>";exit();     
      $idx = $this->input->post("IDBidang");
      
      
      $data['order']=$this->db->query("SELECT * from tbl_sales_order where sales_order_id = '".$idx."'")->row();
      $data['detail']=$this->db->query("SELECT * from tbl_sales_order_detail inner join tbl_product on tbl_product.product_id = tbl_sales_order_detail.sales_order_detail_product_id
      where sales_order_detail_sales_order_id = '".$idx."'");
      
      $content = $this->load->view('edit_sales_order', $data, true);                

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

    function DetailSO(){
        $idx['so_id'] = $this->input->post("IDBidang");
        $this->load->view('detail_so_view', $idx); 
    }

    function GetDetailSO(){
      //echo "<pre>";print_r($_POST);"</pre>";exit();
        $idx = $this->input->post("idx");
        
        $arrContent = $this->db->query("SELECT * from tbl_product inner join tbl_sales_order_detail on tbl_product.product_id = tbl_sales_order_detail.sales_order_detail_product_id
          where sales_order_detail_sales_order_id ='".$idx."'");           
      
            $i=1; 
            $strContent = '';

            foreach($arrContent->result() as $row){               
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $code = "'".$row->product_code."'";
                $nama = "'".str_replace(" ","_",$row->product_name)."'";
                $strContent.='<tr class="record">   
                            <td>'.$i.'</td>                                                                         
                                      <td>'.$row->product_code.'</td>                                      
                                      <td>'.$row->product_name.'</td>
                                      <td>'.$row->sales_order_detail_status.'</td> 
                                      <td>'.rp($row->sales_order_detail_price).'</td>
                                      <td>'.$row->sales_order_detail_qty.'</td>  
                                      <td>
                                        <button type="button" class="btn btn-xs btn-primary"  onclick="detailShow('.$row->product_id.','.$idx.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
              $i++;                      
            }     
            echo $strContent;
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
                $strContent.='<tr class="record" data-sr'.$row->sales_order_id.'="'.$row->sales_order_status.'">   
                					  <td>'.$row->sales_order_id.'</td>                                                                         
                                      <td>'.$row->sales_order_ref_no.'</td>                                      
                                      <td>'.$row->sales_order_date.'</td>
                                      <td>NOIR</td> 
                                      <td>'.$row->sales_order_address.'</td>
                                      <td>'.$row->sales_order_status.'</td>  
                                      <td>
                                        <button type="button" class="btn btn-xs  btn-info" onclick="dialogFormEditShow('.$row->sales_order_id.','.$code.')"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Detail</button>
                                        <button type="button" class="btn btn-xs btn-warning"  onclick="dialogFormEditShow('.$row->sales_order_id.','.$code.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</button>
                                        <button type="button" class="btn btn-xs btn-danger"  onclick="dialogFormEditShow('.$row->sales_order_id.','.$code.')"><span class="glyphicon glyphicon-trush" aria-hidden="true"></span> Hapus</button>
                                      </td>
                                </tr>';
              $i++;                      
            }     
            echo $strContent;            
          }

    public function GetDaftarSales()
    {
      $this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            
            $this->load->model("master_sales_model", "ModelMasterSales");
            
            echo $this->ModelMasterSales->GetDaftarSales(); 
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
                                        <button type="button" class="btn btn-xs btn-success"  onclick="dialogFormEditShow('.$row->provider_id.','.$code.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>&nbsp;
                                        <button type="button" class="btn btn-xs btn-danger"  onclick="deleteConfirmShow('.$row->provider_id.')"><span class="glyphicon glyphicon-trush" aria-hidden="true"></span> Hapus</button>
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
                                        <button type="button" class="btn btn-xs btn-success"  onclick="dialogFormEditShow('.$row->provider_id.','.$code.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>&nbsp;
                                        <button type="button" class="btn btn-xs btn-danger"  onclick="deleteConfirmShow('.$row->provider_id.')"><span class="glyphicon glyphicon-trush" aria-hidden="true"></span> Hapus</button>
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

      function addTableProduct2(){
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
                                        <button type="button" class="btn btn-xs btn-success"  onclick="addProduct('.$row->product_id.','.$row->product_price_usd.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
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


    public function saveprovider()
    {
      //echo "<pre>";print_r($_POST);"</pre>";exit();
        $data['provider_provider_categories_id'] = $this->input->post("tipe");
        $data['provider_code'] = $this->input->post("kode");
        $data['provider_name'] = $this->input->post("nama");
        $data['provider_description'] = $this->input->post("deskripsi");
        $data['provider_contact_person'] = $this->input->post("pic");
        $data['provider_phone'] = $this->input->post("notelp1");
        $data['provider_phone2'] = $this->input->post("notelp2");
        $data['provider_fax'] = $this->input->post("fax");      
        $data['provider_email'] = $this->input->post("email");
        $data['provider_city'] = $this->input->post("city");
        $data['provider_postal_code'] = $this->input->post("pos");
        $data['provider_address'] = $this->input->post("alamat");
        $data['provider_log'] = "insert by dwi";         
        $data['provider_date_created'] = date("Y-m-d");    
          
        $this->db->insert("tbl_provider", $data);
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

    public function detailbomso()
    {
      //echo "<pre>";print_r($_POST);"</pre>";exit();
      $idproduct = $this->input->post("idx");
      $idso = $this->input->post("so");
      $data['idso'] = $idso;
      $data["product"] = $this->db->query("SELECT * from tbl_product where product_id = '".$idproduct."'")->row();
        
        $data['order']=$this->db->query("SELECT tbl_material.*, tbl_bom.bom_material_qty as qty, tbl_bom.bom_id from tbl_bom 
          inner join tbl_material on tbl_bom.bom_material_id = tbl_material.material_id
          where tbl_bom.bom_product_id = '".$idproduct."'");              
      
        $data['order_liquid']=$this->db->query("SELECT tbl_material.*, tbl_bom_liquid.bom_liquid_material_qty as qty, tbl_bom_liquid.bom_liquid_id 
          from tbl_bom_liquid inner join tbl_material on tbl_bom_liquid.bom_liquid_material_id= tbl_material.material_id
          where tbl_bom_liquid.bom_liquid_product_id = '".$idproduct."'");                
      
      $content = $this->load->view('detail_bom_so', $data, true);                

            echo  $content;
    }

    public function updateso()
    {
      //echo "<pre>";print_r($_POST);"</pre>";exit();
      $c_kontak = count($this->input->post("idproduk"));
      $idso = $this->input->post("so_id");
      ////$iddet = $this->input->post("iddetail");
          
        for($i=0; $i<$c_kontak;$i++)
        {
          $data2['sales_order_detail_sales_order_id'] = $idso;
          $data2['sales_order_detail_product_id'] = $_POST['idproduk'][$i];
          $data2['sales_order_detail_price'] = $_POST['price'][$i];
          $data2['sales_order_detail_qty'] = $_POST['qty'][$i];
          $data2['sales_order_detail_last_updated'] = date("Y-m-d");
          $data2['sales_order_detail_log'] = "update by dwi";
          $data2['sales_order_detail_status'] = "reguler";
          //$this->db->insert("tbl_sales_order_detail", $data2);
          $this->db->where('sales_order_detail_id',$_POST['iddetail'][$i]);
          $this->db->update("tbl_sales_order_detail", $data2);
        }
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

    public function insertDetailSo()
    {
          $data2['sales_order_detail_sales_order_id'] = $this->input->post("IDSo");
          $data2['sales_order_detail_product_id'] = $this->input->post("IDproduct");
          $data2['sales_order_detail_price'] =$this->input->post("price");
          $data2['sales_order_detail_qty'] = 0;
          $data2['sales_order_detail_date_created'] = date("Y-m-d");
          $data2['sales_order_detail_log'] = "insert by dwi";
          $data2['sales_order_detail_status'] = "reguler";
          $this->db->insert("tbl_sales_order_detail", $data2);
    }    

    public function savematerial()
    {
      //echo "<pre>";print_r($_POST);"</pre>";exit();
      $data['material_code'] = $this->input->post("code");
      $data['material_name'] = $this->input->post("name");
      $data['material_unit_id'] = $this->input->post("Satuan");
      $data['material_price'] = $this->input->post("price");
      $data['material_price_usd'] = $this->input->post("usd");
      $data['material_material_categories_id'] = $this->input->post("categories");
      $data['material_material_categories_group_id'] = $this->input->post("Group");
      $data['material_cbm'] = $this->input->post("cbm");
      $data['material_provider_id'] = 0;
      $data['material_currency'] = '';
      $data['material_date_created'] = date("Y-m-d H:i:s");
      $data['material_last_updated'] = date("Y-m-d H:i:s");
      $data['material_log'] = 'insert by dwi';
      $data['material_minimal_stock'] = $this->input->post("stock");
      $this->db->insert("tbl_material", $data);
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

    public function updateproduct()
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
      //$data['product_date_created'] = date("Y-m-d H:i:s");
      $data['product_last_updated'] = date("Y-m-d H:i:s");
      $data['product_log'] = 'update by dwi';
      $data['product_labor'] = $this->input->post("labor");
      $data['product_overhead'] = $this->input->post("overhead");
      $this->db->where('product_id',$this->input->post("idx"));
      $this->db->update("tbl_product", $data);
     // $this->db->insert("tbl_product", $data);
    }

    public function updatematerial()
    {
      //echo "<pre>";print_r($_POST);"</pre>";exit();
      $data['material_code'] = $this->input->post("code");
      $data['material_name'] = $this->input->post("name");
      $data['material_unit_id'] = $this->input->post("Satuan");
      $data['material_price'] = $this->input->post("price");
      $data['material_price_usd'] = $this->input->post("usd");
      $data['material_material_categories_id'] = $this->input->post("categories");
      $data['material_material_categories_group_id'] = $this->input->post("Group");
      $data['material_cbm'] = $this->input->post("cbm");
      $data['material_provider_id'] = 0;
      $data['material_currency'] = '';
      //$data['material_date_created'] = date("Y-m-d H:i:s");
      $data['material_last_updated'] = date("Y-m-d H:i:s");
      $data['material_log'] = 'insert by dwi';
      $data['material_minimal_stock'] = $this->input->post("stock");
      $this->db->where('material_id',$this->input->post("idx"));
      $this->db->update("tbl_material", $data);
     // $this->db->insert("tbl_product", $data);
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
          $data['bom_liquid_material_qty'] = $_POST['qty_ld'][$a];
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

    function ajax_lookUpMaterial(){

        $code = $this->input->post('code');
        $this->db->where('material_code', $code);
        $query = $this->db->get('tbl_material');
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

    public function HapusSales()
    {
      $this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

      $idx = $this->input->post('ID');
      
      $idx =   $this->input->post('ID');
      $this->db->delete('tbl_sales_order', array('sales_order_id' => $idx));
      $this->db->delete('tbl_sales_order_detail', array('sales_order_detail_sales_order_id' => $idx)); 
      
    }

    public function HapusProduct()
    {
      $this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

      $idx =   $this->input->post('ID');
            $this->db->delete('tbl_product', array('product_id' => $idx)); 
            //echo $messageData;
      
    }

    public function HapusMaterial()
    {
      $this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

      $idx =   $this->input->post('ID');
            $this->db->delete('tbl_material', array('material_id' => $idx)); 
            //echo $messageData;
      
    }

    public function HapusProvider()
    {
      $this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

      $idx =   $this->input->post('ID');
            $this->db->delete('tbl_provider', array('provider_id' => $idx)); 
            //echo $messageData;
      
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

    public function habusdataSo()
    {
      $this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

      $id_bom =   $this->input->post('ID');
            $this->db->delete('tbl_sales_order_detail', array('sales_order_detail_id' => $id_bom)); 
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
		
	}

/* End of file admin.php */

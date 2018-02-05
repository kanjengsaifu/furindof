<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

	class Raw extends MY_Controller {    
	  	

	  public function __construct() {
	        parent::__construct();
	    }
	         
		public function index()
		{	
			$this->checkCredentialAccess();

			$this->checkIsAjaxRequest();

			    $this->load->model('raw_model', 'ModelAdmin');
	        $dataMenu = array('dataMenu' => $this->ModelAdmin->GetMenuAdmin());

	        $menu 	 = $this->load->view('menu_raw_view', $dataMenu, true);
	        //$content = '';
	        //$content = $this->load->view('balance_raw_view', '', true);
          $content  = $this->load->view('dashboard_view', '', true);
	        $arrData = array('menu' 	=> $menu,	        				 
	        			   	 'content'  => $content);

	        echo json_encode($arrData);
		}	

		public function po_raw()
		{
			
           	$this->load->view('master_raw_view');                

           
		}

    public function po_sample()
    {
      
            $this->load->view('master_raw_sample_view');                

           
    } 

    public function detail_po_raw()
    {
      
            $this->load->view('detail_raw_view');                

           
    } 

    public function detailPoRaw()
    {
            $idx['so_id'] = $this->input->post("IDBidang");
            $this->load->view('detail_po_raw_view', $idx);                

           
    } 

    public function balance_po_raw()
    {
      
            $this->load->view('balance_raw_view');                

           
    }  

    public function ImportPoRaw()
    {
      
            $this->load->view('import_purchase_raw');                

           
    }

    public function importpo()
    {
      echo "<pre>";print_r($_POST);"</pre>";exit();   
    }
	   	
	   	public function tambah_po_raw()
		{
			
           	$this->load->view('tambah_po_raw_view');                

           
		} 

    public function tambah_po_sample()
    {
      
            $this->load->view('tambah_po_sample_view');                

           
    } 

    public function edit_po_sample()
    {
      $idx = $this->input->post("IDBidang");
      $data['PO'] = $this->db->query("SELECT trx_purchase_order_sample.*,mst_provider.*,mst_material.material_id,mst_material.material_code,mst_material.material_name 
      from trx_purchase_order_sample inner join mst_provider on mst_provider.provider_id=trx_purchase_order_sample.provider_id  
        inner join mst_material on mst_material.material_id = trx_purchase_order_sample.material_id where purchase_order_sample_id = '".$idx."' or id_induk = '".$idx."'");
      $this->load->view('edit_po_sample_view', $data);                

           
    } 

    public function tambah_buffer_raw()
    {
      
            $this->load->view('tambah_buffer_raw_view');                

           
    } 

		public function edit_po_raw()
		{
			$idx = $this->input->post("IDBidang");
			$data['PO'] = $this->db->query("SELECT * from trx_purchase_order inner join trx_sales_order on trx_sales_order.sales_order_id = trx_purchase_order.sales_order_id
				inner join mst_provider on mst_provider.provider_id = trx_purchase_order.provider_id where purchase_order_id = '".$idx."'")->row();
			$data['PODet'] = $this->db->query("SELECT * from trx_purchase_order_detail inner join mst_product on mst_product.product_id = trx_purchase_order_detail.product_id where purchase_order_id = '".$idx."'");
           	$this->load->view('edit_po_raw_view', $data);                

           
		}  

		function addTableRekanan(){
            $this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            $idproduct = $this->input->post("idx");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT * from mst_provider where provider_categories_id = 1 AND (provider_code like '%".$idproduct."%' OR provider_name like '%".$idproduct."%')");           
            
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
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT * from trx_sales_order where sales_order_ref_no like '%".$idproduct."%' OR sales_order_status like '%".$idproduct."%'");           
            
            $i=1; 
            $strContent = '';
            $status = '';
            $ttl = 0;
            $setPO = 0;
            foreach($arrContent->result() as $row){ 
            	$so = $this->db->query("SELECT sum(sales_order_detail_qty) as jmlso from trx_sales_order_detail where sales_order_id = '".$row->sales_order_id."'")->row();
            	$po = $this->db->query("SELECT sum(purchase_order_detail_qty) as jmlpo from trx_purchase_order inner join trx_purchase_order_detail
            		on trx_purchase_order_detail.purchase_order_id = trx_purchase_order.purchase_order_id where sales_order_id = '".$row->sales_order_id."'")->row(); 
            	$setPO = $po->jmlpo+0;
            	$ttl = $so->jmlso - $setPO;
            	if($ttl == 0) 
            	{
                $status = 'hidden';
            		
            	} else{
            		$status = '';
            	           
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $code = "'".$row->sales_order_ref_no."'";
                $nama = "'".str_replace(" ","_",$row->sales_order_ref_no)."'";
                $strContent.='<tr class="record '.$status.'">   
                            <td>'.$row->sales_order_id.'</td>                                                                         
                                      <td>'.$row->sales_order_ref_no.'</td>                                      
                                      <td>'.$row->sales_order_categories.'</td>                                       
                                      <td>
                                        <button type="button" class="btn btn-xs btn-success"  onclick="addSales('.$row->sales_order_id.','.$code.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
                }
              $i++;                      
            }     
            echo $strContent;            
          }

          function addTableSalesBuffer(){
            $this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            $idproduct = $this->input->post("idx");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT * from trx_sales_order where sales_order_categories = 'sales'");           
            
            $i=1; 
            $strContent = '';
            $status = '';
            $ttl = 0;
            $setPO = 0;
            foreach($arrContent->result() as $row){ 
              $so = $this->db->query("SELECT sum(sales_order_detail_qty) as jmlso from trx_sales_order_detail where sales_order_id = '".$row->sales_order_id."'")->row();
              $po = $this->db->query("SELECT sum(purchase_order_detail_qty) as jmlpo from trx_purchase_order inner join trx_purchase_order_detail
                on trx_purchase_order_detail.purchase_order_id = trx_purchase_order.purchase_order_id where sales_order_id = '".$row->sales_order_id."'")->row(); 
              $setPO = $po->jmlpo+0;
              $ttl = $so->jmlso - $setPO;
              if($ttl == 0) 
              {
                $status = 'hidden';
                
              } else{
                $status = '';
                         
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $code = "'".$row->sales_order_ref_no."'";
                $nama = "'".str_replace(" ","_",$row->sales_order_ref_no)."'";
                $strContent.='<tr class="record '.$status.'">   
                            <td>'.$row->sales_order_id.'</td>                                                                         
                                      <td>'.$row->sales_order_ref_no.'</td>                                      
                                      <td>'.$row->sales_order_status.'</td>                                       
                                      <td>
                                        <button type="button" class="btn btn-xs btn-success"  onclick="addSales('.$row->sales_order_id.','.$code.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
                }
              $i++;                      
            }     
            echo $strContent;            
          }


          function addTableSo_det(){
            
            $idproduct = $this->input->post("idx");
            $idso = $this->input->post("ids");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT trx_sales_order_detail.*, mst_material.*, mst_product.* from trx_sales_order_detail inner join mst_bom on mst_bom.product_id = trx_sales_order_detail.product_id
            	inner join mst_material on mst_bom.material_id = mst_material.material_id inner join mst_product on mst_product.product_id=trx_sales_order_detail.product_id
            	where material_categories_id = 1 AND sales_order_id = '".$idso."'");           
            
            $i=0; 
            $strContent = '';
            $order=0;
            $idx = 0;
            $status = '';
            foreach($arrContent->result_array() as $key => $row){               
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $idx = $row['sales_order_id'];
                $idm = $row['product_id'];
                $order = $row['sales_order_detail_qty'];
                $cek = $this->db->query("SELECT * from trx_purchase_order_detail inner join trx_purchase_order on trx_purchase_order_detail.purchase_order_id = trx_purchase_order.purchase_order_id  where sales_order_id = '".$idx."' AND product_id = '".$idm."'");
                if($cek->num_rows() > 0){
                  $order = $row['sales_order_detail_qty'] - $cek->row()->purchase_order_detail_qty;
                }
                
                $code = "'".$row['material_code']."'";
                $nama = "'".str_replace(" ","_",$row['material_name'])."'";
                if($order == 0){
                	$status = 'hidden';
                } else{
                	$status = '';                
                  $strContent.='<tr class="record '.$status.'"> 
                                      <td>'.$row['material_id'].'</td> 
                                      <td>'.$row['product_code'].'</td>                                      
                                      <td>'.$row['product_name'].'</td> 
                                      <td>'.$order.'</td>
                                      <td class="hidden">'.$row['material_price'].'</td> 
                                      <td class="hidden">'.$row['product_id'].'</td>
                                      <td class="hidden">d'.$i.'</td>                                       
                                      <td>
                                        <button id="hdd'.$i.'" type="button" class="btn btn-xs btn-success"  onclick="addProduct(this,'.$order.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
                }
              $i++;                      
            }     
            echo $strContent;            
          }

          function addTableSo_sample(){
            
            $idproduct = $this->input->post("idx");
            $idso = $this->input->post("ids");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT * from mst_material where material_categories_id = 1 order by material_id desc");           
            
            $i=0; 
            $strContent = '';
            $order=0;
            $idx = 0;
            $status = '';
            foreach($arrContent->result_array() as $key => $row){               
                $order =1;
                $nama = "'".str_replace(" ","_",$row['material_name'])."'";
                if($order == 0){
                  $status = 'hidden';
                } else{
                  $status = '';                
                  $strContent.='<tr class="record '.$status.'"> 
                                      <td>'.$row['material_id'].'</td> 
                                      <td>'.$row['material_code'].'</td>                                      
                                      <td>'.$row['material_name'].'</td> 
                                      <td>0</td>
                                      <td class="hidden">'.$row['material_price'].'</td> 
                                      <td class="hidden">'.$row['material_id'].'</td>
                                      <td class="hidden">d'.$i.'</td>                                       
                                      <td>
                                        <button id="hdd'.$i.'" type="button" class="btn btn-xs btn-success"  onclick="addProduct(this,0)"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
                }
              $i++;                      
            }     
            echo $strContent;            
          }

          function addTableSo_det_buffer(){
            
            $idproduct = $this->input->post("idx");
            $idso = $this->input->post("ids");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT trx_sales_order_detail.*, mst_material.*, mst_product.* from trx_sales_order_detail inner join mst_bom on mst_bom.product_id = trx_sales_order_detail.product_id
              inner join mst_material on mst_bom.material_id = mst_material.material_id inner join mst_product on mst_product.product_id=trx_sales_order_detail.product_id
              where material_categories_id = 1 AND (sales_order_id = '".$idso."' AND (material_name like '%".$idproduct."%' OR material_code like '%".$idproduct."%')) LIMIT 100");           
            
            $i=0; 
            $strContent = '';
            $order=0;
            $idx = 0;
            $status = '';
            $stock = 0;
            foreach($arrContent->result_array() as $key => $row){               
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $idx = $row['sales_order_id'];
                $idm = $row['product_id'];
                $idp = $row['material_id'];
                $cek = $this->db->query("SELECT * from trx_purchase_order_detail inner join trx_purchase_order on trx_purchase_order_detail.purchase_order_id = trx_purchase_order.purchase_order_id  where sales_order_id = '".$idx."' AND product_id = '".$idm."'")->row();
                $inv = $this->db->query("SELECT inventory_jumlah_nominal, sum(inventory_stock_qty) as stok_qty from trx_inventory where material_id = '".$idp."' AND inventory_categories = 'stock'")->row();
                $stock = $inv->stok_qty+0;
                $order = $row['sales_order_detail_qty'] - $cek->purchase_order_detail_qty;
                $code = "'".$row['material_code']."'";
                $nama = "'".str_replace(" ","_",$row['material_name'])."'";
                if($order == 0){
                  $status = 'hidden';
                } else{
                  $status = '';                
                  $strContent.='<tr class="record '.$status.'">
                                      <td>'.$row['material_id'].'</td> 
                                      <td>'.$row['product_code'].'</td>                                      
                                      <td>'.$row['product_name'].'</td> 
                                      <td>'.$stock.'</td>
                                      <td>'.$order.'</td>                                       
                                      <td class="hidden">'.$row['product_id'].'</td>
                                      <td class="hidden">'.$inv->inventory_jumlah_nominal.'</td>                                      
                                      <td>
                                        <button type="button" class="btn btn-xs btn-success"  onclick="addProduct(this,'.$stock.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
                }
              $i++;                      
            }     
            echo $strContent;            
          }

          function addTableSo_det1(){
            
            $idproduct = $this->input->post("idx");
            $idso = $this->input->post("ids");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT trx_sales_order_detail.*, mst_material.*, mst_product.* from trx_sales_order_detail inner join mst_bom on mst_bom.product_id = trx_sales_order_detail.product_id
            	inner join mst_material on mst_bom.material_id = mst_material.material_id inner join mst_product on mst_product.product_id=trx_sales_order_detail.product_id
            	where material_categories_id = 1 AND sales_order_id = '".$idso."' LIMIT 10");           
            
            $i=1; 
            $strContent = '';
            $order=0;
            $idx = 0;
            foreach($arrContent->result_array() as $key => $row){               
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $idx = $row['sales_order_id'];
                $idm = $row['product_id'];
                $cek = $this->db->query("SELECT * from trx_purchase_order_detail inner join trx_purchase_order on trx_purchase_order_detail.purchase_order_id = trx_purchase_order.purchase_order_id  where sales_order_id = '".$idx."' AND product_id = '".$idm."'")->row();
                $order = $row['sales_order_detail_qty'] - $cek->purchase_order_detail_qty;
                $code = "'".$row['material_code']."'";
                $nama = "'".str_replace(" ","_",$row['material_name'])."'";
                $strContent.='<tr class="record">   
                            <td>'.$row['material_id'].'</td>                                                                         
                                      <td>'.$row['product_code'].'</td>                                      
                                      <td>'.$row['product_name'].'</td> 
                                      <td>'.$order.'</td>
                                      <td class="hidden">'.$row['material_price'].'</td>
                                      <td class="hidden">'.$row['product_id'].'</td>                                      
                                      <td>
                                        <button type="button" class="btn btn-xs btn-success"  onclick="addProduct(this,'.$order.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
              $i++;                      
            }     
            echo $strContent;            
          }

        function GetDetailRawBody(){
      //echo "<pre>";print_r($_POST);"</pre>";exit();
        $idx = $this->input->post("idx");
        
        $arrContent = $this->db->query("SELECT * from trx_purchase_order_detail inner join trx_purchase_order on trx_purchase_order.purchase_order_id
          = trx_purchase_order_detail.purchase_order_id inner join trx_sales_order on trx_sales_order.sales_order_id =
          trx_purchase_order.sales_order_id inner join mst_product on mst_product.product_id = trx_purchase_order_detail.product_id where trx_purchase_order.purchase_order_id ='".$idx."'");           
      
            $i=1; 
            $strContent = '';

            foreach($arrContent->result() as $row){               
                $strContent.='<tr class="record">   
                            <td>'.$i.'</td>                                                                         
                                      <td>'.$row->sales_order_ref_no.'</td>
                                      <td>'.$row->purchase_order_code.'</td>
                                      <td>'.$row->product_code.'</td>                                      
                                      <td>'.$row->product_name.'</td>
                                      <td>'.$row->purchase_order_detail_qty.'</td> 
                                      <td>'.rp($row->purchase_order_detail_price).'</td>
                                      
                                </tr>';
              $i++;                      
            }     
            echo $strContent;
        }

        public function saveProductPo()
		    {
		      //echo "<pre>";print_r($_POST);"</pre>";exit();
		    	$cek = $this->db->query("SELECT * from trx_purchase_order where purchase_order_code = '".$this->input->post("nomor")."' AND sales_order_id = '".$this->input->post("id_sales")."'");
		        if($cek->num_rows() != 0){
		        	$idso = $cek->row()->purchase_order_id;
		        	$data['purchase_order_code'] = $this->input->post("nomor");
		        	$data['purchase_order_note'] = $this->input->post("note");
              $data['purchase_order_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
              $data['purchase_order_delivery_date'] = date("Y-m-d", strtotime($this->input->post("tgldel")));
		        	$this->db->where('purchase_order_id',$idso);
          			$this->db->update("trx_purchase_order", $data);
		        } else{
			        $data['provider_id'] = $this->input->post("id_customer");
			        $data['sales_order_id'] = $this->input->post("id_sales");
					    $data['purchase_order_categories'] = $this->input->post("kategories");
			        $data['purchase_order_code'] = $this->input->post("nomor");
			        $data['purchase_order_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
			        $data['purchase_order_delivery_date'] = date("Y-m-d", strtotime($this->input->post("tgldel")));
			        $data['purchase_order_note'] = $this->input->post("note");
			        $data['purchase_order_date_created'] = date("Y-m-d");
			        $data['purchase_order_last_updated'] = date("Y-m-d");      
			        $data['purchase_order_log'] = "insert by dwi";
			        $data['purchase_order_deposit'] = 0;		          
			          
			        $this->db->insert("trx_purchase_order", $data);

			        $idso = $this->db->insert_id();
		    	}
		        $c_kontak = count($this->input->post("id_material"));
					
				for($i=0; $i<$c_kontak;$i++)
				{
					$idp = $_POST['id_product'][$i];
					$coba = $this->db->query("SELECT * from trx_purchase_order_detail where purchase_order_id = '".$idso."' AND product_id = '".$idp."'");
					if($coba->num_rows() != 0){
						$data2['purchase_order_detail_qty'] = $_POST['qty'][$i];
						$data2['purchase_order_detail_price'] = strToCurrDB($_POST['nominal'][$i]);
						$data2['purchase_order_detail_desc'] = $_POST['desc'][$i];
            $data2['purchase_order_detail_remax'] = $_POST['remax'][$i];
						$data2['purchase_order_detail_last_updated'] = date("Y-m-d");
						$this->db->where('purchase_order_detail_id',$_POST['iddetail'][$i]);
          				$this->db->update("trx_purchase_order_detail", $data2);
					} else{
						$data2['purchase_order_id'] = $idso;
						$data2['material_id'] = $_POST['id_material'][$i];
						$data2['product_id'] = $_POST['id_product'][$i];
						$data2['purchase_order_detail_qty'] = $_POST['qty'][$i];
						$data2['purchase_order_detail_price'] = strToCurrDB($_POST['nominal'][$i]);
						$data2['purchase_order_detail_desc'] = $_POST['desc'][$i];
            $data2['purchase_order_detail_remax'] = $_POST['remax'][$i];
						//$data2['purchase_order_detail_remax'] = $_POST['qty'][$i];
						$data2['purchase_order_detail_date_created'] = date("Y-m-d");
						$data2['purchase_order_detail_last_updated'] = date("Y-m-d");
						$data2['purchase_order_detail_log'] = "insert by dwi";
						$this->db->insert("trx_purchase_order_detail", $data2);
					}
				}
		    }

        public function saveProductSample()
        {
          //echo "<pre>";print_r($_POST);"</pre>";exit();
          $c_kontak = count($this->input->post("id_material"));
          $data2['id_induk'] = 0;       
          for($i=0; $i<$c_kontak;$i++)
          {
            $data2['purchase_order_sample_code'] = $this->input->post("nomor");
            $data2['provider_id'] = $this->input->post("id_customer");
            $data2['product_id'] = $_POST['id_product'][$i];
            $data2['material_id'] = $_POST['id_material'][$i];
            $data2['qty'] = $_POST['qty'][$i];
            $data2['price'] = strToCurrDB($_POST['nominal'][$i]);
            $data2['desc'] = $this->input->post("note");
            $data2['remax'] = $_POST['desc'][$i];
            $data2['delivery_date'] = date("Y-m-d", strtotime($this->input->post("tgldel")));
            $data2['date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
            $this->db->insert("trx_purchase_order_sample", $data2);
            if($i == 0){
              $data2['id_induk'] = $this->db->insert_id();
            }
          }
        }

        public function updateProductSample()
        {
          //echo "<pre>";print_r($_POST);"</pre>";exit();
          $c_kontak = count($this->input->post("id_material"));
          for($i=0; $i<$c_kontak;$i++)
          {
            if($_POST['iddetail'][$i] != 0){
              $data2['purchase_order_sample_code'] = $this->input->post("nomor");
              $data2['provider_id'] = $this->input->post("id_customer");
              $data2['product_id'] = $_POST['id_product'][$i];
              $data2['material_id'] = $_POST['id_material'][$i];
              $data2['qty'] = $_POST['qty'][$i];
              $data2['price'] = strToCurrDB($_POST['nominal'][$i]);
              $data2['desc'] = $this->input->post("note");
              $data2['remax'] = $_POST['desc'][$i];
              $data2['delivery_date'] = date("Y-m-d", strtotime($this->input->post("tgldel")));
              $data2['date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
              $this->db->where('purchase_order_sample_id',$_POST['iddetail'][$i]);
              $this->db->update("trx_purchase_order_sample", $data2);
            }else {
              $data2['purchase_order_sample_code'] = $this->input->post("nomor");
              $data2['provider_id'] = $this->input->post("id_customer");
              $data2['product_id'] = $_POST['id_product'][$i];
              $data2['material_id'] = $_POST['id_material'][$i];
              $data2['qty'] = $_POST['qty'][$i];
              $data2['price'] = strToCurrDB($_POST['nominal'][$i]);
              $data2['desc'] = $this->input->post("note");
              $data2['remax'] = $_POST['desc'][$i];
              $data2['delivery_date'] = date("Y-m-d", strtotime($this->input->post("tgldel")));
              $data2['date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
              $data2['id_induk'] = $_POST['iddetail'][0];
              $this->db->insert("trx_purchase_order_sample", $data2);
            }            
          }
        }

		    public function GetDaftarPORaw()
		    {
		      $this->checkCredentialAccess();

		            $this->checkIsAjaxRequest();
		            
		            $this->load->model("raw_model", "ModelRaw");
		            
		            echo $this->ModelRaw->GetDaftarSales(); 
		    }

        public function GetDaftarSample()
        {
          $this->checkCredentialAccess();

                $this->checkIsAjaxRequest();
                
                $this->load->model("raw_model", "ModelRaw");
                
                echo $this->ModelRaw->GetDaftarSample(); 
        }

        public function GetDetailPORaw()
        {
          
          $this->checkCredentialAccess();

                $this->checkIsAjaxRequest();
                
                $this->load->model("raw_model", "ModelRaw");
                
                echo $this->ModelRaw->GetDetailRaw(); 
        }

        public function GetBalancePORaw()
        {
          
          $this->checkCredentialAccess();

                $this->checkIsAjaxRequest();
                
                $this->load->model("raw_model", "ModelRaw");
                
                echo $this->ModelRaw->GetBalanceRaw(); 
        }

		    public function HapusRaw()
		    {
		      $this->checkCredentialAccess();

		            $this->checkIsAjaxRequest();

		      $idx = $this->input->post('ID');
		      
		      $idx =   $this->input->post('ID');
		      $this->db->delete('trx_purchase_order_detail', array('purchase_order_id' => $idx));
		      $this->db->delete('trx_purchase_order', array('purchase_order_id' => $idx));
		       
		      
		    }

        public function HapusSample()
        {
          $this->checkCredentialAccess();

                $this->checkIsAjaxRequest();

          $idx = $this->input->post('ID');
          
          $idx =   $this->input->post('ID');
          $this->db->delete('trx_purchase_order_sample', array('purchase_order_sample_id' => $idx));
          $this->db->delete('trx_purchase_order_sample', array('id_induk' => $idx));
           
          
        }

		    public function habusdataRaw()
		    {
		      $this->checkCredentialAccess();

		      $this->checkIsAjaxRequest();

		      $idx =   $this->input->post('ID');
		      $this->db->delete('trx_purchase_order_detail', array('purchase_order_detail_id' => $idx));		      
		      
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

        public function printporaw($idx)
        {
          
          $data['list_history'] = $this->db->query("SELECT * from trx_purchase_order_detail inner join trx_purchase_order on trx_purchase_order.purchase_order_id = trx_purchase_order_detail.purchase_order_id
            inner join mst_provider on mst_provider.provider_id = trx_purchase_order.provider_id inner join mst_material on mst_material.material_id = 
            trx_purchase_order_detail.material_id inner join trx_sales_order on trx_sales_order.sales_order_id = trx_purchase_order.sales_order_id 
            inner join mst_product on mst_product.product_id = trx_purchase_order_detail.product_id inner join ref_unit on ref_unit.unit_id = mst_material.unit_id
            where trx_purchase_order.purchase_order_id = '".$idx."'");

          $this->load->view('export_invoice', $data);                

               
        }

        public function printposample($idx)
        {
          
          $data['list_history'] = $this->db->query("SELECT * from trx_purchase_order_sample inner join mst_provider on mst_provider.provider_id = trx_purchase_order_sample.provider_id
            inner join mst_material on mst_material.material_id = trx_purchase_order_sample.material_id where purchase_order_sample_id = '".$idx."'
            OR id_induk = '".$idx."'");

          $this->load->view('export_sample', $data);                

               
        }

        public function saveBuffer()
        {
            //echo "<pre>";print_r($_POST);"</pre>";exit();
            $c_kontak = count($this->input->post("id_material"));            
            for($i=0; $i<$c_kontak;$i++)
            {
              $data2['warehouse_id'] = 1;
              $data2['inventory_categories'] = 'wip';
              $data2['material_id'] = $_POST['id_material'][$i];
              $data2['inventory_item_categories'] = 'product';
              $data2['inventory_jumlah_nominal'] = strToCurrDB($_POST['price'][$i]);
              $data2['inventory_stock_qty'] = $_POST['qty'][$i];
              $data2['inventory_jenis'] = "in";
              $data2['inventory_date_transaction'] = date("Y-m-d");
              $data2['inventory_date_created'] = date("Y-m-d");
              $data2['inventory_description'] = $_POST['desc'][$i];
              $data2['inventory_log'] = "insert by dwi";
              $this->db->insert("trx_inventory", $data2);
              $idinv2 = $this->db->insert_id();
              
              $data3['warehouse_id'] = 1;
              $data3['inventory_categories'] = 'stock';
              $data3['material_id'] = $_POST['id_material'][$i];
              $data3['inventory_item_categories'] = 'product';
              $data3['inventory_jumlah_nominal'] = strToCurrDB($_POST['price'][$i]);
              $data3['inventory_stock_qty'] = '-'.$_POST['qty'][$i];
              $data3['inventory_jenis'] = "out";
              $data3['inventory_date_transaction'] = date("Y-m-d");
              $data3['inventory_date_created'] = date("Y-m-d");
              $data3['inventory_description'] = $_POST['desc'][$i];
              $data3['inventory_log'] = "insert by dwi";
              $this->db->insert("trx_inventory", $data3);
              $idinv = $this->db->insert_id();              

              $data1['sales_order_id'] = $this->input->post("id_sales");
              $data1['product_id'] = $_POST['id_product'][$i];
              $data1['inv_id'] = $idinv;
              $data1['inv_id2'] = $idinv2;
              $data1['material_id'] = $_POST['id_material'][$i];
              $data1['buffer_qty'] = $_POST['qty'][$i];
              $data1['buffer_note'] = $_POST['desc'][$i];
              $this->db->insert("trx_buffer", $data1);

            }                   
          
        }

}

/* End of fiel Utility.php */
<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

	class Production extends MY_Controller {    
	  	

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
	        $content  = $this->load->view('dashboard_view', '', true);
	        //$content  = $this->load->view('admin_view', '', true);

	        $arrData = array('menu' 	=> $menu,	        				 
	        			   	 'content'  => $content);

	        echo json_encode($arrData);
		}

    public function Mutasi_raw()
    {
      
      $this->load->view('master_mutasi1_view');                

           
    }	

    public function Balance_packing()
    { 
      $this->load->view('balance_packing_view'); 
    } 

    function DetailBalancePacking(){
      //echo "<pre>";print_r($_POST);"</pre>";exit();
      $idx['so_id'] = $this->input->post("IDBidang");
      $idx['po_id'] = $this->input->post("IDX");
      $this->load->view('detail_balance_packing_view', $idx); 
    }

    function editStockRaw(){
      //echo "<pre>";print_r($_POST);"</pre>";exit();
      $data['inventory_stock_qty'] = $this->input->post("imp_ng");
      $idx = $this->input->post("imp_mat");
      $this->db->where('material_id',$idx);
      $this->db->where('inventory_categories','not_good');
      $this->db->update("trx_inventory", $data);

      $data2['inventory_stock_qty'] = $this->input->post("imp_stock");
      //$idx = $this->input->post("imp_mat");
      $this->db->where('material_id',$idx);
      $this->db->where('inventory_categories','stock');
      $this->db->where('inventory_mode','public');
      $this->db->update("trx_inventory", $data2);
    }

    function editStockRaw1(){
      //echo "<pre>";print_r($_POST);"</pre>";exit();
      $data['inventory_stock_qty'] = $this->input->post("imp_stock");
      $idx = $this->input->post("imp_mat");
      $this->db->where('material_id',$idx);
      $this->db->where('inventory_categories','wip');
      $this->db->where('inventory_mode','public');
      $this->db->update("trx_inventory", $data);
    }

    function GetDetailSO(){
      //echo "<pre>";print_r($_POST);"</pre>";exit();
        
        $arrContent = $this->db->query("SELECT sum(inventory_stock_qty) as stock_qty, mst_material.*, trx_inventory.* from trx_inventory inner join mst_material on trx_inventory.material_id = mst_material.material_id 
            where inventory_item_categories = 'product' and inventory_categories = 'wip' group by mst_material.material_id order by mst_material.material_id desc");        
      
            $i=1; 
            $strContent = '';
            foreach($arrContent->result() as $row){
            $buffer = $this->db->query("SELECT sum(inventory_stock_qty) as stock_qty, mst_material.*, trx_inventory.* from trx_inventory inner join mst_material on trx_inventory.material_id = mst_material.material_id 
                where trx_inventory.material_id = '".$row->material_id."' AND (inventory_item_categories = 'product' and inventory_categories = 'not_good') group by mst_material.material_id order by mst_material.material_id desc")->row();
            $sample = $this->db->query("SELECT sum(inventory_stock_qty) as stock_qty, mst_material.*, trx_inventory.* from trx_inventory inner join mst_material on trx_inventory.material_id = mst_material.material_id 
                where trx_inventory.material_id = '".$row->material_id."' AND (inventory_item_categories = 'product' and inventory_categories = 'sample') group by mst_material.material_id order by mst_material.material_id desc")->row();               
            $stk = $this->db->query("SELECT sum(inventory_stock_qty) as inventory_stock_qty from trx_inventory where material_id = '".$row->material_id."' AND inventory_item_categories = 'product' 
                AND inventory_mode = 'private' AND inventory_categories = 'wip'")->row();
                if($buffer->stock_qty != 0){
                  $qty_ng = $buffer->stock_qty;
                }else{
                  $qty_ng = 0;
                }
                if($sample->stock_qty != 0){
                  $qty_sample = $sample->stock_qty;
                }else{
                  $qty_sample = 0;
                }
                $ttl = $row->stock_qty + $qty_ng + $qty_sample;
                $code = "'".$row->material_code."'";
                $nama = "'".str_replace(" ","_",$row->material_name)."'";
                $strContent.='<tr class="record">   
                            <td>'.$i.'</td>                                                                         
                                      <td>'.$row->material_code.'</td>                                      
                                      <td>'.$row->material_name.'</td>
                                      <td>
                                        <input type="number" value="'.round($row->stock_qty,0).'" class="form-control autocomplate" id="stock-'.$i.'" onblur="getnumeric1(this,'.round($stk->inventory_stock_qty,0).')" atm="nominal-'.$i.'" style="background:#605CAC; color:white;"/>
                                      </td> 
                                      <td>
                                        <input type="number" value="'.round($qty_ng).'" name="qty[]" class="form-control autocomplate" id="ng-'.$i.'" onblur="getnumeric(this,'.round($stk->inventory_stock_qty,0).')" atm="nominal-'.$i.'" style="background:#605CAC; color:white;"/>
                                        <input type="hidden" id="sample-'.$i.'" value="'.$qty_sample.'" />
                                        <input type="hidden" id="mat-'.$i.'" value="'.$row->material_id.'" />
                                      </td>
                                      <td>'.$qty_sample.'</td>  
                                      <td>
                                        <input type="number" readonly value="'.$ttl.'" name="qty[]" class="form-control autocomplate" id="ttl-'.$i.'" atm="nominal-'.$i.'" style="background:#605CAC; color:white;"/>
                                      </td>
                                </tr>';
              $i++;                      
            }     
            echo $strContent;
        }

    function addTableProduct(){
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT * from mst_material where material_id not in (select material_id from trx_inventory 
              where inventory_categories = 'stock' and inventory_item_categories = 'product'
              AND inventory_mode = 'public') AND material_categories_id = 1");           
            
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
                                      <td>'.$row->material_price.'</td> 
                                      <td>
                                        <button type="button" class="btn btn-xs btn-success"  onclick="tambah_material('.$row->material_id.','.$code.','.$nama.','.$row->material_price.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
              $i++;                      
            }     
            echo $strContent;            
          }

    public function GetDaftarInv()
        {
          $this->checkCredentialAccess();

                $this->checkIsAjaxRequest();
                
                $this->load->model("production_model", "ModelRaw");
                
                echo $this->ModelRaw->GetDaftarInv(); 
        }

		public function packing()
		{
			
           	$this->load->view('master_packing_view');                

           
		}

    public function shipment()
    {
      
            $this->load->view('master_shipment_view');                

           
    }  
	   	
	 public function tambah_shipment()
    {
      
            $this->load->view('tambah_shipment_view');                

           
    }

    public function import_shipment()
    {
      
            $this->load->view('import_shipment_view');                

           
    } 

    public function tambah_packing()
    {
        $cek = $this->db->query("SELECT packing_code from trx_packing order by packing_code DESC");

          if ($cek->num_rows()==0) {
            $data['bkm'] = 'PCK-0000';
          }else{
            $data['bkm'] = $cek->row()->packing_code;
          }
      
        $this->load->view('tambah_packing_view', $data);                

           
    } 

    public function printship($idx)
        {
          
          $data['sales_order'] = $this->db->query("SELECT * from trx_shipment where shipment_id = '".$idx."'")->row();
          $data['sales_order_detail'] = $this->db->query("SELECT * from trx_shipment inner join trx_shipment_detail on trx_shipment.shipment_id = trx_shipment_detail.shipment_id
            inner join trx_sales_order on trx_sales_order.sales_order_id = trx_shipment_detail.sales_order_id inner join mst_product
            on mst_product.product_id = trx_shipment_detail.product_id where trx_shipment.shipment_id = '".$idx."'");

          //$this->load->view('print_ship', $data);
          $this->load->view('print_packing_list', $data);                

               
        }

    public function printInv($idx,$ids)
        {
          //echo $ids;exit();
          $data['sales_order'] = $this->db->query("SELECT * from trx_shipment where shipment_id = '".$idx."'")->row();
          $data['sales_order_detail'] = $this->db->query("SELECT * from trx_shipment inner join trx_shipment_detail on trx_shipment.shipment_id = trx_shipment_detail.shipment_id
            inner join trx_sales_order on trx_sales_order.sales_order_id = trx_shipment_detail.sales_order_id inner join mst_product
            on mst_product.product_id = trx_shipment_detail.product_id where trx_shipment.shipment_id = '".$idx."'");
          $data['curency']=$ids;

          $this->load->view('print_ship', $data);
          //$this->load->view('print_packing_list', $data);                

               
        }

    public function edit_packing()
    {
          $idx = $this->input->post("IDBidang");
          $data['pack'] = $this->db->query("SELECT * from trx_packing inner join trx_packing_detail on trx_packing.packing_id = trx_packing_detail.packing_id
            inner join trx_sales_order on trx_sales_order.sales_order_id = trx_packing.sales_order_id where trx_packing.packing_id = '".$idx."'")->row();
      
          $this->load->view('edit_packing_view', $data);                

           
    } 

    public function edit_shipment()
    {
          $idx = $this->input->post("IDBidang");
          $data['ship'] = $this->db->query("SELECT * from trx_shipment where shipment_id = '".$idx."'")->row();
      
          $this->load->view('edit_shipment_view', $data);                

           
    } 

    function addpacking(){
            
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
                $idp = $row['material_id'];
                $cek = $this->db->query("SELECT sum(packing_detail_qty) as packing_detail_qty from trx_packing_detail inner join trx_packing on trx_packing_detail.packing_id =  trx_packing.packing_id where sales_order_id = '".$idx."' AND product_id = '".$idm."' group by product_id")->row();
                $inv = $this->db->query("SELECT SUM(inventory_jumlah_nominal*inventory_stock_qty) as rata, sum(inventory_stock_qty) as stok_qty from trx_inventory where material_id = '".$idp."' AND inventory_categories = 'wip' AND inventory_item_categories = 'product'")->row();
                $order = $row['sales_order_detail_qty']-$cek->packing_detail_qty;
                $datang = $cek->packing_detail_qty+0;
                $code = "'".$row['material_code']."'";
                $stock = $inv->stok_qty+0;
                $rata2 = $inv->rata/$inv->stok_qty;
                $nama = "'".str_replace(" ","_",$row['material_name'])."'";
                if($order == 0){
                	$status = 'hidden';
                } else{
                	$status = '';                
                  $strContent.='<tr class="record '.$status.'"> 
                                      <td>'.$row['material_id'].'</td> 
                                      <td>'.$row['product_code'].'</td>
                                      <td>'.$row['material_code'].'</td>                                      
                                      <td>'.$row['product_name'].'</td> 
                                      <td>'.$stock.'</td>
                                      <td>'.$order.'</td>
                                      <td>'.$datang.'</td>
                                      <td class="hidden">'.$rata2.'</td> 
                                      <td class="hidden">'.$row['product_id'].'</td>
                                      <td class="hidden">d'.$i.'</td>                                       
                                      <td>
                                        <button id="hdd'.$i.'" type="button" class="btn btn-xs btn-success"  onclick="addProduct(this,'.$stock.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
                }
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
            $arrContent = $this->db->query("SELECT * from trx_sales_order where sales_order_categories = 'sales'");           
            
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
                $tgl = date('mdy');
                $code = "'".$row->sales_order_ref_no."'";
                $nama = "'".$row->sales_order_ref_no.''.$tgl."'";
                $strContent.='<tr class="record '.$status.'">   
                            <td>'.$row->sales_order_id.'</td>                                                                         
                                      <td>'.$row->sales_order_ref_no.'</td>                                      
                                      <td>'.$row->sales_order_categories.'</td>                                       
                                      <td>
                                        <button type="button" class="btn btn-xs btn-success"  onclick="addSales('.$row->sales_order_id.','.$code.','.$tgl.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
              $i++;                      
            }     
            echo $strContent;            
          }

    function addTablematerial(){
                        
            $arrContent = $this->db->query("SELECT sum(packing_detail_qty) as qty, trx_packing.*,trx_packing_detail.*,mst_product.*,trx_sales_order.*
              from trx_packing inner join trx_packing_detail on trx_packing_detail.packing_id = trx_packing.packing_id inner join
              mst_product on mst_product.product_id = trx_packing_detail.product_id inner join trx_sales_order on
              trx_sales_order.sales_order_id = trx_packing.sales_order_id group by mst_product.product_code, trx_sales_order.sales_order_id");           
            
            $i=0; 
            $strContent = '';
            $order=0;
            $idx = 0;
            $status = '';
            foreach($arrContent->result_array() as $key => $row){               
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $idx = $row['sales_order_id'];
                $idm = $row['product_id'];
                $idp = $row['material_id'];
                $cek = $this->db->query("SELECT sum(shipment_detail_qty) as qty_pack from trx_shipment inner join trx_shipment_detail on trx_shipment_detail.shipment_id =  trx_shipment.shipment_id where sales_order_id = '".$idx."' AND product_id = '".$idm."'")->row();
                $so = $this->db->query("SELECT sum(sales_order_detail_qty) as qty_so from trx_sales_order inner join trx_sales_order_detail on trx_sales_order_detail.sales_order_id =  trx_sales_order.sales_order_id where trx_sales_order.sales_order_id = '".$idx."' AND product_id = '".$idm."'")->row();
                $order = $so->qty_so-$cek->qty_pack;
                $tersedia = $row['qty'] - $cek->qty_pack;
                if($order == 0){
                  $status = 'hidden';
                } else{
                  $status = '';                
                  $strContent.='<tr class="record '.$status.'"> 
                                      <td class="hidden">'.$row['sales_order_id'].'</td>
                                      <td>'.$row['sales_order_ref_no'].'</td> 
                                      <td>'.$row['product_code'].'</td>                                      
                                      <td>'.$row['product_name'].'</td> 
                                      <td>'.$order.'</td>
                                      <td>'.$tersedia.'</td>
                                      <td>'.$cek->qty_pack.'</td>
                                      <td class="hidden">'.$row['product_price_usd'].'</td> 
                                      <td class="hidden">'.$row['product_id'].'</td>
                                      <td class="hidden">'.$row['product_cbm'].'</td>
                                      <td class="hidden">'.$row['product_weight'].'</td>
                                      <td class="hidden">'.$row['product_bundle'].'</td>
                                      <td class="hidden">'.$row['packing_id'].'</td>
                                      <td class="hidden">d'.$i.'</td>                                       
                                      <td>
                                        <button id="hdd'.$i.'" type="button" class="btn btn-xs btn-success"  onclick="addProduct(this,'.$tersedia.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
                }
              $i++;                      
            }     
            echo $strContent;            
          }

    public function tambah_material()
    {
      //echo "<pre>";print_r($_POST);"</pre>";exit();
      $data3['warehouse_id'] = 1;
      $data3['inventory_categories'] = 'wip';
      $data3['material_id'] = $this->input->post("mat_id");
      $data3['inventory_item_categories'] = 'product';
      $data3['inventory_jumlah_nominal'] = $this->input->post("mat_price");
      $data3['inventory_stock_qty'] = 1;
      $data3['inventory_jenis'] = "in";
      $data3['inventory_date_transaction'] = date("Y-m-d");
      $data3['inventory_date_created'] = date("Y-m-d");
      $data3['inventory_description'] = '';
      $data3['inventory_mode'] = 'public';
      $data3['inventory_log'] = "insert by ucik";
      $this->db->insert("trx_inventory", $data3);

      $data2['warehouse_id'] = 1;
      $data2['inventory_categories'] = 'not_good';
      $data2['material_id'] = $this->input->post("mat_id");
      $data2['inventory_item_categories'] = 'product';
      $data2['inventory_jumlah_nominal'] = $this->input->post("mat_price");
      $data2['inventory_stock_qty'] = 0;
      $data2['inventory_jenis'] = "in";
      $data2['inventory_date_transaction'] = date("Y-m-d");
      $data2['inventory_date_created'] = date("Y-m-d");
      $data2['inventory_description'] = '';
      $data2['inventory_mode'] = 'public';
      $data2['inventory_log'] = "insert by ucik";
      $this->db->insert("trx_inventory", $data2);
    }  

    public function savepacking()
    {
      //echo "<pre>";print_r($_POST);"</pre>";exit();
      $cek = $this->db->query("SELECT packing_code from trx_packing where packing_code = '".$this->input->post("nomor")."'");
      if($cek->num_rows() >0){
        echo $cek->num_rows();
        exit();
      } else{        
        $data['sales_order_id'] = $this->input->post("id_sales");
        $data['packing_code'] = $this->input->post("nomor");
        $data['packing_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
        $data['packing_status'] = "packing";     
        $data['packing_note'] = "note";
        $this->db->insert("trx_packing", $data);
        
        $idso = $this->db->insert_id();

        $c_kontak = count($this->input->post("id_product"));
          
        for($i=0; $i<$c_kontak;$i++)
        {
          $prd = $_POST['id_product'][$i];
          $bom = $this->db->query("SELECT (bom_qty*material_price) as nominal FROM mst_bom inner join mst_material on mst_material.material_id = mst_bom.material_id 
            where mst_bom.product_id = '".$prd."' and mst_material.material_categories_id = 2")->row();
          $liquid = $this->db->query("SELECT sum(bom_liquid_qty*material_price) as nominal FROM mst_bom_liquid inner join mst_material on mst_material.material_id = mst_bom_liquid.material_id 
            where mst_bom_liquid.product_id = '".$prd."' and mst_material.material_categories_id = 2")->row();
          $data3['warehouse_id'] = 1;
          $data3['inventory_categories'] = 'wip';
          $data3['material_id'] = $_POST['id_material'][$i];
          $data3['inventory_item_categories'] = 'product';
          $data3['inventory_jumlah_nominal'] = $_POST['nominal'][$i];
          $data3['inventory_stock_qty'] = '-'.$_POST['qty'][$i];
          $data3['inventory_jenis'] = "out";
          $data3['inventory_date_transaction'] = date("Y-m-d");
          $data3['inventory_date_created'] = date("Y-m-d");
          $data3['inventory_description'] = $_POST['desc'][$i];
          $data3['inventory_log'] = "insert by dwi";
          $this->db->insert("trx_inventory", $data3);

          $idinv = $this->db->insert_id();

          $ttl_semua += $_POST['nominal'][$i]*$_POST['qty'][$i];
          $ttl_bom += $bom->nominal;
          $ttl_liquid += $liquid->nominal;
          $data2['packing_id'] = $idso;
          $data2['inventory_id'] = $idinv;
          $data2['packing_nominal'] = $_POST['nominal'][$i];
          $data2['product_id'] = $_POST['id_product'][$i];
          $data2['material_id'] = $_POST['id_material'][$i];
          $data2['packing_detail_qty'] = $_POST['qty'][$i];
          $data2['packing_detail_date_create'] = date("Y-m-d");
          $data2['packing_detail_note'] = $_POST['desc'][$i];
          $this->db->insert("trx_packing_detail", $data2);
        }

        $cek1 = $this->db->query("SELECT * from trx_jurnal order by id_jurnal DESC");       
          $jml1 = $cek1->row()->id_jurnal-1;
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
          $data6['uraian'] = 'PEMAKAIAN BAHAN BAKU';
          $data6['memo'] = $this->input->post("note");
          $data6['akun'] = '52001';
          $data6['nobukti'] = $this->input->post("nomor");       
          $data6['id_kategori'] = 2;
          $data6['id_packing'] = $idso;
          //$data6['provider_id'] = $cus;
          $data6['dateentry'] = date("Y-m-d");
          $data6['userentry'] = $_SESSION['IDUser'];
          $data6['jenis'] = 'um';
          $data6['nominal'] = $ttl_semua;
          //$this->db->insert("trx_jurnal", $data6);

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
          $data7['uraian'] = 'FG OFFSET - RAW MATERIAL';
          $data7['memo'] = $this->input->post("note");
          $data7['akun'] = '56001';
          $data7['nobukti'] = $this->input->post("nomor");       
          $data7['id_kategori'] = 2;
          $data7['id_packing'] = $idso;
          //$data7['provider_id'] = $cus;
          $data7['dateentry'] = date("Y-m-d");
          $data7['userentry'] = $_SESSION['IDUser'];
          $data7['jenis'] = 'uk';
          $data7['nominal'] = $ttl_bom+$ttl_liquid*-1;
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
          $data8['uraian'] = 'BARANG JADI';
          $data8['memo'] = $this->input->post("note");
          $data8['akun'] = '14005';
          $data8['nobukti'] = $this->input->post("nomor");       
          $data8['id_kategori'] = 1;
          $data8['id_packing'] = $idso;
          //$data7['provider_id'] = $cus;
          $data8['dateentry'] = date("Y-m-d");
          $data8['userentry'] = $_SESSION['IDUser'];
          $data8['jenis'] = 'um';
          $data8['nominal'] = $ttl_semua+$ttl_bom+$ttl_liquid;
          $this->db->insert("trx_jurnal", $data8);
      }
    }

    public function updatepacking()
    {
      //echo "<pre>";print_r($_POST);"</pre>";exit(); 
        $idso = $this->input->post("so_id");             
        $data['sales_order_id'] = $this->input->post("id_sales");
        $data['packing_code'] = $this->input->post("nomor");
        $data['packing_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
        $data['packing_status'] = "packing";     
        $data['packing_note'] = $this->input->post("note");       
        $this->db->where('packing_id',$idso);
        $this->db->update("trx_packing", $data);
        
        //$idso = $this->db->insert_id();

        $c_kontak = count($this->input->post("id_product"));
          
        for($i=0; $i<$c_kontak;$i++)
        {
          $prd = $_POST['id_product'][$i];
          $bom = $this->db->query("SELECT (bom_qty*material_price) as nominal FROM mst_bom inner join mst_material on mst_material.material_id = mst_bom.material_id 
            where mst_bom.product_id = '".$prd."' and mst_material.material_categories_id = 2")->row();
          $liquid = $this->db->query("SELECT sum(bom_liquid_qty*material_price) as nominal FROM mst_bom_liquid inner join mst_material on mst_material.material_id = mst_bom_liquid.material_id 
            where mst_bom_liquid.product_id = '".$prd."' and mst_material.material_categories_id = 2")->row();
          $idp = $_POST['id_material'][$i];
          $coba = $this->db->query("SELECT * from trx_packing_detail where packing_id = '".$idso."' AND material_id = '".$idp."'");
          $detid = $_POST['id_det'][$i];
          $data2['packing_id'] = $idso;
          $data2['product_id'] = $_POST['id_product'][$i];
          $data2['material_id'] = $_POST['id_material'][$i];
          $data2['packing_detail_qty'] = $_POST['qty'][$i];
          $data2['packing_detail_date_create'] = date("Y-m-d");
          $data2['packing_detail_note'] = $_POST['desc'][$i];
          $this->db->where('packing_detail_id',$detid);
          $this->db->update("trx_packing_detail", $data2);

          $ttl_semua += $_POST['nominal'][$i]*$_POST['qty'][$i];
          $ttl_bom += $bom->nominal;
          $ttl_liquid += $liquid->nominal;
          $data3['inventory_categories'] = 'wip';
          $data3['inventory_stock_qty'] = '-'.$_POST['qty'][$i];
          $data3['inventory_jenis'] = "out";            
          $data3['inventory_description'] = $_POST['desc'][$i];
          $data3['inventory_log'] = "update by dwi";
          $this->db->where('inventory_id',$coba->row()->inventory_id);
          $this->db->update("trx_inventory", $data3);
        }

        // $data6['nominal'] = $ttl_semua;
        // $this->db->where('id_packing',$idso);
        // $this->db->where('akun','52001');
        // $this->db->update("trx_jurnal", $data6);

        $data7['nominal'] = $ttl_bom+$ttl_liquid;
        $this->db->where('id_packing',$idso);
        $this->db->where('akun','52002');
        $this->db->update("trx_jurnal", $data7);

        $data8['nominal'] = $ttl_semua+$ttl_bom+$ttl_liquid;
        $this->db->where('id_packing',$idso);
        $this->db->where('akun','14005');
        $this->db->update("trx_jurnal", $data8);
      
    }

    public function GetDaftarPacking()
        {
          $this->checkCredentialAccess();

                $this->checkIsAjaxRequest();
                
                $this->load->model("production_model", "ModelRaw");
                
                echo $this->ModelRaw->GetDaftarPacking(); 
        }

    public function GetDaftarShipment()
        {
          $this->checkCredentialAccess();

                $this->checkIsAjaxRequest();
                
                $this->load->model("production_model", "ModelRaw");
                
                echo $this->ModelRaw->GetDaftarShipment(); 
        }

    public function saveShipment()
    {
      //echo "<pre>";print_r($_POST);"</pre>";exit();
      $cek = $this->db->query("SELECT shipment_code from trx_shipment where shipment_code = '".$this->input->post("nomor")."'");
      if($cek->num_rows() >0){
        echo $cek->num_rows();
        exit();
      } else{        
        $data['shipment_code'] = $this->input->post("nomor");
        $data['shipment_container_code'] = $this->input->post("Container");
        $data['shipment_truck_code'] = $this->input->post("Truck");
        $data['shipment_driver'] = $this->input->post("Driver");
        $data['shipment_seal_code'] = $this->input->post("Seal");
        $data['shipment_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
        $data['shipment_loading_date'] = date("Y-m-d", strtotime($this->input->post("loading")));
        $data['shipment_status'] = "close";     
        $data['shipment_log'] = "insert by dwi";
        $data['shipment_date_created'] = date("Y-m-d");
        $data['shipment_last_updated'] = date("Y-m-d");
        $data['shipment_rate_currency'] = $this->input->post("Currency");
        $this->db->insert("trx_shipment", $data);
        $idso = $this->db->insert_id();

        $nilai_tukar = $this->input->post("Currency");        
        $c_kontak = count($this->input->post("id_product"));
        $barang_jadi =0; 
        for($i=0; $i<$c_kontak;$i++)
        {
          $idp = $_POST['id_product'][$i];
          $bom = $this->db->query("SELECT mst_bom.material_id, avg(inventory_jumlah_nominal*bom_qty) as nominal from mst_bom inner join trx_inventory on trx_inventory.material_id = mst_bom.material_id
            where product_id = '".$idp."' group by mst_bom.material_id");
          $nominal = 0;
          foreach ($bom->result() as $row) {
            $nominal +=+ (int)$row->nominal;
          }
          $barang_jadi +=+ $nominal*$_POST['qty'][$i];
          $ttl_usd +=+ $_POST['usd'][$i];
          $data2['shipment_id'] = $idso;
          $data2['product_id'] = $_POST['id_product'][$i];
          //$data2['packing_id'] = $_POST['pack'][$i];
          $data2['sales_order_id'] = $_POST['id_material'][$i];
          $data2['shipment_detail_qty'] = $_POST['qty'][$i];
          $data2['shipment_detail_kg'] = $_POST['kg'][$i];
          $data2['shipment_detail_cmb'] = $_POST['cmb'][$i];
          $data2['shipment_detail_bdl'] = $_POST['bdl'][$i];
          $data2['shipment_detail_price'] = $_POST['price'][$i];
          $this->db->insert("trx_shipment_detail", $data2);
        }
        $penjualan = $nilai_tukar*$ttl_usd;
        //echo ' Rp '.$barang_jadi;exit();
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
          $data6['uraian'] = 'BARANG JADI';
          $data6['memo'] = $this->input->post("note");
          $data6['akun'] = '14005';
          $data6['nobukti'] = $this->input->post("nomor");       
          $data6['id_kategori'] = 1;
          $data6['id_shipment'] = $idso;
          //$data6['provider_id'] = $cus;
          $data6['dateentry'] = date("Y-m-d");
          $data6['userentry'] = $_SESSION['IDUser'];
          $data6['jenis'] = 'uk';
          $data6['nominal'] = '-'.$barang_jadi;
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
          $data7['uraian'] = 'HARGA POKOK PENJUALAN';
          $data7['memo'] = $this->input->post("note");
          $data7['akun'] = '51001';
          $data7['nobukti'] = $this->input->post("nomor");       
          $data7['id_kategori'] = 2;
          $data7['id_shipment'] = $idso;
          //$data7['provider_id'] = $cus;
          $data7['dateentry'] = date("Y-m-d");
          $data7['userentry'] = $_SESSION['IDUser'];
          $data7['jenis'] = 'uk';
          $data7['nominal'] = '-'.$barang_jadi;
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
          $data8['uraian'] = 'PIUTANG USAHA';
          $data8['memo'] = $this->input->post("note");
          $data8['akun'] = '12002';
          $data8['nobukti'] = $this->input->post("nomor");       
          $data8['id_kategori'] = 1;
          $data8['id_shipment'] = $idso;
          //$data7['provider_id'] = $cus;
          $data8['dateentry'] = date("Y-m-d");
          $data8['userentry'] = $_SESSION['IDUser'];
          $data8['jenis'] = 'um';
          $data8['nominal'] = $penjualan;
          $this->db->insert("trx_jurnal", $data8);

          $jml4 = $jml1+3;
          $jml_det4=0;
          if ($jml4 == 0) {
            $data8['nomor']= 'JU-0001';
          } else if($jml4 < 10){
            $jml_det4 = $jml4+1;
            $data8['nomor']= 'JU-000'.$jml_det4;
          } else if($jml4 < 100){
            $jml_det4 = $jml4+1;
            $data8['nomor']= 'JU-00'.$jml_det4;
          } else if($jml4 < 1000){
            $jml_det4 = $jml4+1;
            $data8['nomor']= 'JU-0'.$jml_det4;
          } else {
            $jml_det4 = $jml4+1;
            $data8['nomor']= 'JU-'.$jml_det4;
          }
          $data9['tgl'] = date("Y-m-d");
          $data9['uraian'] = 'PENJUALAN';
          $data9['memo'] = $this->input->post("note");
          $data9['akun'] = '41001';
          $data9['nobukti'] = $this->input->post("nomor");       
          $data9['id_kategori'] = 2;
          $data9['id_shipment'] = $idso;
          //$data7['provider_id'] = $cus;
          $data9['dateentry'] = date("Y-m-d");
          $data9['userentry'] = $_SESSION['IDUser'];
          $data9['jenis'] = 'um';
          $data9['nominal'] = $penjualan;
          $this->db->insert("trx_jurnal", $data9);      
      }
    }

    public function updateShipment()
    {
      //echo "<pre>";print_r($_POST);"</pre>";exit();
             
      $data['shipment_code'] = $this->input->post("nomor");
      $data['shipment_container_code'] = $this->input->post("Container");
      $data['shipment_truck_code'] = $this->input->post("Truck");
      $data['shipment_driver'] = $this->input->post("Driver");
      $data['shipment_seal_code'] = $this->input->post("Seal");
      $data['shipment_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
      $data['shipment_loading_date'] = date("Y-m-d", strtotime($this->input->post("loading")));
      $data['shipment_status'] = "close";     
      $data['shipment_log'] = "insert by dwi";
      //$data['shipment_date_created'] = date("Y-m-d");
      $data['shipment_last_updated'] = date("Y-m-d");
      $data['shipment_rate_currency'] = $this->input->post("Currency");
      $this->db->where('shipment_id',$this->input->post("so_id"));
      $this->db->update("trx_shipment", $data);
      
      $idso = $this->input->post("so_id");     
      $nilai_tukar = $this->input->post("Currency");
      $c_kontak = count($this->input->post("id_product"));
      $barang_jadi =0; 
      for($i=0; $i<$c_kontak;$i++)
      {
        $idms = $_POST['id_material'][$i];
        $idp = $_POST['id_product'][$i];
        $coba = $this->db->query("SELECT * from trx_shipment_detail where shipment_id = '".$idso."' AND product_id = '".$idp."' AND sales_order_id = '".$idms."'");
        $bom = $this->db->query("SELECT mst_bom.material_id, avg(inventory_jumlah_nominal*bom_qty) as nominal from mst_bom inner join trx_inventory on trx_inventory.material_id = mst_bom.material_id
          where product_id = '".$idp."' group by mst_bom.material_id");
        $nominal = 0;
        foreach ($bom->result() as $row) {
          $nominal +=+ (int)$row->nominal;
        }
        $barang_jadi +=+ $nominal*$_POST['qty'][$i];
        $ttl_usd +=+ $_POST['usd'][$i];
        if($coba->num_rows() != 0){
          $data2['shipment_id'] = $idso;
          $data2['product_id'] = $_POST['id_product'][$i];
          $data2['sales_order_id'] = $_POST['id_material'][$i];
          $data2['shipment_detail_qty'] = $_POST['qty'][$i];
          $data2['shipment_detail_kg'] = $_POST['kg'][$i];
          $data2['shipment_detail_cmb'] = $_POST['cmb'][$i];
          $data2['shipment_detail_bdl'] = $_POST['bdl'][$i];
          $data2['shipment_detail_price'] = $_POST['price'][$i];
          $this->db->where('shipment_detail_id',$_POST['idx'][$i]);
          $this->db->update("trx_shipment_detail", $data2);         
          
        }else{
          $data2['shipment_id'] = $idso;
          $data2['product_id'] = $_POST['id_product'][$i];
          //$data2['packing_id'] = $_POST['pack'][$i];
          $data2['sales_order_id'] = $_POST['id_material'][$i];
          $data2['shipment_detail_qty'] = $_POST['qty'][$i];
          $data2['shipment_detail_kg'] = $_POST['kg'][$i];
          $data2['shipment_detail_cmb'] = $_POST['cmb'][$i];
          $data2['shipment_detail_bdl'] = $_POST['bdl'][$i];
          $data2['shipment_detail_price'] = $_POST['price'][$i];
          $this->db->insert("trx_shipment_detail", $data2);
        } 
      }
        $penjualan = $nilai_tukar*$ttl_usd;
        $data6['nominal'] = $penjualan;
        $this->db->where('id_shipment',$idso);
        $this->db->where('akun','41001');
        $this->db->update("trx_jurnal", $data6);

        $penjualan = $nilai_tukar*$ttl_usd;
        $data7['nominal'] = $penjualan;
        $this->db->where('id_shipment',$idso);
        $this->db->where('akun','12002');
        $this->db->update("trx_jurnal", $data7);

        $data8['nominal'] = '-'.$barang_jadi;
        $this->db->where('id_shipment',$idso);
        $this->db->where('akun','14005');
        $this->db->update("trx_jurnal", $data8);

        $data9['nominal'] = '-'.$barang_jadi;
        $this->db->where('id_shipment',$idso);
        $this->db->where('akun','51001');
        $this->db->update("trx_jurnal", $data9);
    }

    public function HapusShipment()
        {
          $idx = $this->input->post('ID');
          //$cek = $this->db->query("SELECT * from trx_shipment_detail where shipment_id = '".$idx."'");
          $this->db->delete('trx_shipment_detail', array('shipment_id' => $idx));
          $this->db->delete('trx_shipment', array('shipment_id' => $idx));
          $this->db->delete('trx_jurnal', array('id_shipment' => $idx));
          
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

    public function habusdataship()
        {
          $this->checkCredentialAccess();

          $this->checkIsAjaxRequest();

          $idx =   $this->input->post('ID');
          $this->db->delete('trx_shipment_detail', array('shipment_detail_id' => $idx));
          
        }
    public function GetBalancePacking()
        {
          
          $this->checkCredentialAccess();

                $this->checkIsAjaxRequest();
                
                $this->load->model("production_model", "ModelRaw");
                
                echo $this->ModelRaw->GetBalancePacking(); 
        }

    function GetDetailBalancePacking(){
      //echo "<pre>";print_r($_POST);"</pre>";exit();
        $idx = $this->input->post("IDBidang");
        $ids = $this->input->post("IDX");
        
        $arrContent = $this->db->query("SELECT * from trx_packing inner join trx_packing_detail on 
          trx_packing.packing_id = trx_packing_detail.packing_id inner join trx_sales_order on 
          trx_sales_order.sales_order_id = trx_packing.sales_order_id inner join mst_product on 
          mst_product.product_id = trx_packing_detail.product_id where trx_packing.sales_order_id = '".$idx."' 
          and trx_packing_detail.product_id = '".$ids."'");           
      
          $i=1; 
          foreach($arrContent->result() as $row){               
              $strContent.='<tr class="record">   
                          <td>'.$i.'</td>                                                                         
                                    <td>'.$row->sales_order_ref_no.'</td>
                                    <td>'.$row->packing_code.'</td>
                                    <td>'.$row->product_code.'</td>                                      
                                    <td>'.$row->product_name.'</td>
                                    <td>'.$row->packing_detail_qty.'</td> 
                                    <td>'.rp($row->packing_nominal).'</td>                                    
                              </tr>';
            $i++;                      
          }     
          echo $strContent;
        }
}

/* End of fiel Utility.php */
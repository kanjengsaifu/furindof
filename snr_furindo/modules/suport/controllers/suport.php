<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

	class Suport extends MY_Controller {    
	  	

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
	        $this->load->model('suport_model', 'ModelAdmin');
	        $dataMenu = array('dataMenu' => $this->ModelAdmin->GetMenuAdmin());

	        $menu 	  = $this->load->view('menu_suport_view', $dataMenu, true);
	        $content = '';
	        $content  = $this->load->view('dashboard_view', '', true);

	        $arrData = array('menu' 	=> $menu,	        				 
	        			   	 'content'  => $content);

	        echo json_encode($arrData);
		}

    function ajax_lookUpSm(){

        $code = $this->input->post('code');
        $this->db->where('purchase_order_liquid_code', $code);
        $query = $this->db->get('trx_purchase_order_liquid');
        if ($query->num_rows() > 0){
           echo 0;
        } else {
           echo 1;
        }
    }	

		public function po_sm()
		{
			
           	$this->load->view('master_suport_view');                

           
		}  

    public function detail_po_sm()
    {
      
            $this->load->view('detail_po_sm_view');                

           
    }  

    public function surat_jalan()
    {
      
            $this->load->view('master_sj_view');                

           
    }  

		public function tambah_po_raw()
		{
			
           	$this->load->view('tambah_po_sm_view');                

           
		}

    public function tambah_po_liquid()
    {
      
            $this->load->view('tambah_po_liquid');                

           
    } 

    public function import_po_liquid()
    {
      
            $this->load->view('import_po_sm_view');                

           
    } 

    public function tambah_sj()
    {
      
            $this->load->view('tambah_sj_view');                

           
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

    public function printSJ($idx)
    {      
      $data['lpb'] = $idx;

      $this->load->view('cetak_surat_jalan', $data);                

           
    }

    public function edit_sj()
    {
        $idx = $this->input->post("IDBidang");
        $data['pjr'] = $this->db->query("SELECT * from trx_surat_jalan inner join mst_provider on mst_provider.provider_id = trx_surat_jalan.provider_id where surat_jalan_id = '".$idx."'")->row();
        $data['detail'] = $this->db->query("SELECT * from trx_surat_jalan_detail inner join mst_material on mst_material.material_id = trx_surat_jalan_detail.material_id where surat_jalan_id = '".$idx."'");
        $this->load->view('edit_sj_view', $data);                

           
    } 

    public function kebutuhan_po_sm()
    {
      
            $this->load->view('detail_kebutuhan_suport');                

           
    }

    public function kebutuhan_po_vendor()
    {
      
            $this->load->view('detail_kebutuhan_vendor');                

           
    } 

    public function printposm($idx)
        {
          
          $data['list_history'] = $this->db->query("SELECT * from trx_purchase_order_liquid_detail inner join trx_purchase_order_liquid on trx_purchase_order_liquid.purchase_order_liquid_id = trx_purchase_order_liquid_detail.purchase_order_liquid_id
            inner join mst_provider on mst_provider.provider_id = trx_purchase_order_liquid.provider_id inner join mst_material on mst_material.material_id = 
            trx_purchase_order_liquid_detail.material_id left join trx_sales_order on trx_sales_order.sales_order_id = trx_purchase_order_liquid.sales_order_id 
            inner join ref_unit on ref_unit.unit_id = mst_material.unit_id where trx_purchase_order_liquid.purchase_order_liquid_id = '".$idx."'");

          $this->load->view('export_po_sm', $data);                

               
        }

		public function edit_po_sm()
		{
			$idx = $this->input->post("IDBidang");
      $so = $this->input->post("SO");
			$data['PO'] = $this->db->query("SELECT * from trx_purchase_order_liquid left join trx_sales_order on trx_sales_order.sales_order_id = trx_purchase_order_liquid.sales_order_id
				inner join mst_provider on mst_provider.provider_id = trx_purchase_order_liquid.provider_id where purchase_order_liquid_id = '".$idx."'")->row();
			$data['PODet'] = $this->db->query("SELECT * from trx_purchase_order_liquid_detail inner join mst_material on mst_material.material_id = trx_purchase_order_liquid_detail.material_id where purchase_order_liquid_id = '".$idx."'");
      if($so == 0){
        $this->load->view('edit_po_liquid', $data);
      } else{
        $this->load->view('edit_po_sm_view', $data);                
      }

           
		}  

		function addTableRekanan(){
            $this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            $idproduct = $this->input->post("idx");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT * from mst_provider where provider_categories_id = 2 AND (provider_code like '%".$idproduct."%' OR provider_name like '%".$idproduct."%')");           
            
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
            $arrContent = $this->db->query("SELECT * from mst_provider where provider_categories_id = 2 AND (provider_code like '%".$idproduct."%' OR provider_name like '%".$idproduct."%') LIMIT 10");           
            
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

          function addTableRekanan2(){
            $this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            $idproduct = $this->input->post("idx");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT mst_provider.*, trx_purchase_order.*, trx_sales_order.sales_order_ref_no from trx_purchase_order inner join mst_provider on trx_purchase_order.provider_id = mst_provider.provider_id inner join trx_sales_order
              on trx_sales_order.sales_order_id = trx_purchase_order.sales_order_id where provider_categories_id = 1");           
            
            $i=1; 
            $strContent = '';

            foreach($arrContent->result() as $row){               
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $tgl = date('mdY');
                $code = "'".$row->provider_code.''.$tgl."'";
                $nama = "'".str_replace(" ","_",$row->provider_name)."'";
                $strContent.='<tr class="record">   
                            <td>'.$row->provider_id.'</td>
                                      <td>'.$row->sales_order_ref_no.'</td>
                                      <td>'.$row->purchase_order_code.'</td>                                                                         
                                      <td>'.$row->provider_code.'</td>                                      
                                      <td>'.$row->provider_name.'</td>                                       
                                      <td>
                                        <button type="button" class="btn btn-xs btn-success"  onclick="addRekanan('.$row->purchase_order_id.','.$nama.','.$code.','.$row->provider_id.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
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
            $arrContent = $this->db->query("SELECT * from trx_sales_order where sales_order_categories = 'sales' AND (sales_order_ref_no like '%".$idproduct."%' OR sales_order_status like '%".$idproduct."%')");           
            
            $i=1; 
            $strContent = '';
            $status = '';
            $ttl = 0;
            $setPO = 0;
            foreach($arrContent->result() as $row){ 
            	         
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $code = "'".$row->sales_order_ref_no."'";
                $nama = "'".str_replace(" ","_",$row->sales_order_ref_no)."'";
                $strContent.='<tr class="record">   
                            <td>'.$row->sales_order_id.'</td>                                                                         
                                      <td>'.$row->sales_order_ref_no.'</td>                                      
                                      <td>'.$row->sales_order_categories.'</td>                                       
                                      <td>
                                        <button type="button" class="btn btn-xs btn-success"  onclick="addSales('.$row->sales_order_id.','.$code.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
              $i++;                      
            }     
            echo $strContent;            
          }


          function addTableSo_det(){
            
            $idproduct = $this->input->post("idx");
            $idso = $this->input->post("ids");
            $idpo = $this->input->post("idp");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT sum(trx_sales_order_detail.sales_order_detail_qty * bom_qty) as qty_det,trx_sales_order_detail.*, mst_material.*, mst_product.*, sum(mst_bom.bom_qty) as qty 
				      from trx_sales_order_detail inner join mst_bom on mst_bom.product_id = trx_sales_order_detail.product_id
            	inner join mst_material on mst_bom.material_id = mst_material.material_id inner join mst_product on mst_product.product_id=trx_sales_order_detail.product_id
            	where material_categories_id = 2 AND (sales_order_id = '".$idso."') group by mst_bom.material_id");           
            
            $i=1; 
            $strContent = '';
            $order=0;
            $idx = 0;
            $status = '';
            $beli =0;
            $stock =0;
            foreach($arrContent->result_array() as $key => $row){               
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $idx = $row['sales_order_id'];
                $idm = $row['material_id'];
                $cek = $this->db->query("SELECT sum(purchase_order_liquid_detail_qty) as purchase_order_liquid_detail_qty from trx_purchase_order_liquid_detail inner join trx_purchase_order_liquid on trx_purchase_order_liquid_detail.purchase_order_liquid_id = trx_purchase_order_liquid.purchase_order_liquid_id  where purchase_order_liquid_status = 'draft' AND (sales_order_id = '".$idx."' AND material_id = '".$idm."')")->row();
                $cek2 = $this->db->query("SELECT * from trx_purchase_order_liquid_detail inner join trx_purchase_order_liquid on trx_purchase_order_liquid_detail.purchase_order_liquid_id = trx_purchase_order_liquid.purchase_order_liquid_id  where trx_purchase_order_liquid_detail.purchase_order_liquid_id = '".$idpo."' AND material_id = '".$idm."'")->row();
                $inv = $this->db->query("SELECT sum(inventory_stock_qty) as stok_qty from trx_inventory where material_id = '".$row['material_id']."' AND inventory_categories = 'stock'")->row();
                $order = ($row['qty_det']);
                $stock = $inv->stock_qty+0;
                $beli = $cek->purchase_order_liquid_detail_qty+0;
                $code = "'".$row['material_code']."'";
                $nama = "'".str_replace(" ","_",$row['material_name'])."'";
                if($row['material_id'] == $cek2->material_id && $idpo == $cek2->purchase_order_liquid_id){
                	$status = 'disabled';
                } else{
                	$status = '';
                
                $strContent.='<tr class="record '.$status.'">   
                            <td class="hidden">'.$row['material_id'].'</td>                                                                         
                                      <td>'.$row['material_code'].'</td>                                      
                                      <td>'.$row['material_name'].'</td>
                                      <td>'.$stock.'</td>
                                      <td>'.$order.'</td> 
                                      <td>'.$beli.'</td>                                      
                                      <td class="hidden">'.$row['material_price'].'</td> 
                                      <td class="hidden">'.$row['product_id'].'</td>                                      
                                      <td class="hidden">s'.$i.'</td>                                      
                                      <td>
                                        <button '.$status.' type="button" id="hds'.$i.'" class="btn btn-xs btn-success"  onclick="addProduct(this,'.$order.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
              }
              $i++;                      
            }     
            echo $strContent;            
          }

          function addTableSo_lc(){
            
            $idproduct = $this->input->post("idx");
            $idso = $this->input->post("ids");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            // $arrContent = $this->db->query("SELECT mst_material.*, mst_product.*, sum(mst_bom_liquid.bom_liquid_qty) as qty 
            // from mst_bom_liquid inner join mst_material on mst_bom_liquid.material_id = mst_material.material_id inner join mst_product on mst_product.product_id=mst_bom_liquid.product_id
            //   where material_categories_id = 2 AND mst_material.material_categories_group_id = 2 group by mst_bom_liquid.material_id");           
            $arrContent = $this->db->query("SELECT * from mst_material where material_categories_id = 2 AND mst_material.material_categories_group_id != 10");
            $i=1; 
            $strContent = '';
            $order=0;
            $idx = 0;
            $status = '';
            $beli =0;
            $stock =0;
            foreach($arrContent->result_array() as $key => $row){               
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
               // $idx = $row['sales_order_id'];
                $idm = $row['material_id'];
                $cek = $this->db->query("SELECT * from trx_purchase_order_liquid_detail inner join trx_purchase_order_liquid on trx_purchase_order_liquid_detail.purchase_order_liquid_id = trx_purchase_order_liquid.purchase_order_liquid_id  where material_id = '".$idm."'")->row();
                $lpb = $this->db->query("SELECT sum(lpb_liquid_detail_qty) as lpb_qty from trx_lpb_liquid_detail where material_id = '".$idm."'")->row();
                $inv = $this->db->query("SELECT sum(inventory_stock_qty) as stok_qty from trx_inventory where material_id = '".$row['material_id']."' AND inventory_categories = 'stock'")->row();
                $bom = $this->db->query("SELECT sum(mst_bom_liquid.bom_liquid_qty*sales_order_detail_qty) as qty, sales_order_detail_qty from mst_bom_liquid inner join trx_sales_order_detail on trx_sales_order_detail.product_id = mst_bom_liquid.product_id
                  inner join mst_material on mst_bom_liquid.material_id = mst_material.material_id inner join mst_product on mst_product.product_id=mst_bom_liquid.product_id
                  where material_categories_id = 2 AND mst_bom_liquid.material_id = '".$row['material_id']."'")->row();
                $order = $bom->qty;
                $stock = $inv->stok_qty+0;
                $beli = $cek->purchase_order_liquid_detail_qty-$lpb->lpb_qty;
                $code = "'".$row['material_code']."'";
                $nama = "'".str_replace(" ","_",$row['material_name'])."'";
                if($stock < $row['material_minimal_stock']){
                  $status = 'red';
                } else{
                  $status = '';
                }
                $strContent.='<tr class="record">   
                                  <td class="hidden">'.$row['material_id'].'</td>                                                                         
                                      <td>'.$row['material_code'].'</td>                                      
                                      <td>'.$row['material_name'].'</td>
                                      <td>'.$stock.'</td>
                                      <td class="hidden">'.round($order,2).'</td> 
                                      <td>'.$beli.'</td>                                      
                                      <td class="hidden">'.$row['material_price'].'</td> 
                                      <td class="hidden">'.$row['product_id'].'</td>                                      
                                      <td class="hidden">d'.$i.'</td>                                       
                                      <td>
                                        <button id="hdd'.$i.'" type="button" class="btn btn-xs btn-success '.$status.'"  onclick="addProduct(this)"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
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
            $arrContent = $this->db->query("SELECT mst_material.*, mst_product.*, sum(mst_bom_liquid.bom_liquid_qty) as qty 
				    from mst_bom_liquid inner join mst_material on mst_bom_liquid.material_id = mst_material.material_id inner join mst_product on mst_product.product_id=mst_bom_liquid.product_id
            	where material_categories_id = 2 AND (material_name like '%".$idproduct."%' OR material_code like '%".$idproduct."%') group by mst_bom_liquid.material_id");           
            
            $i=1; 
            $strContent = '';
            $order=0;
            $idx = 0;
            $status = '';
            $beli =0;
            $stock =0;
            foreach($arrContent->result_array() as $key => $row){               
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
               // $idx = $row['sales_order_id'];
                $idm = $row['material_id'];
                $cek = $this->db->query("SELECT * from trx_purchase_order_liquid_detail inner join trx_purchase_order_liquid on trx_purchase_order_liquid_detail.purchase_order_liquid_id = trx_purchase_order_liquid.purchase_order_liquid_id  where material_id = '".$idm."'")->row();
                $lpb = $this->db->query("SELECT sum(lpb_liquid_detail_qty) as lpb_qty from trx_lpb_liquid_detail where material_id = '".$idm."'")->row();
                $inv = $this->db->query("SELECT sum(inventory_stock_qty) as stok_qty from trx_inventory where material_id = '".$row['material_id']."' AND inventory_categories = 'stock'")->row();
                $bom = $this->db->query("SELECT sum(mst_bom_liquid.bom_liquid_qty*sales_order_detail_qty) as qty, sales_order_detail_qty from mst_bom_liquid inner join trx_sales_order_detail on trx_sales_order_detail.product_id = mst_bom_liquid.product_id
                  inner join mst_material on mst_bom_liquid.material_id = mst_material.material_id inner join mst_product on mst_product.product_id=mst_bom_liquid.product_id
                  where material_categories_group_id = 6 AND trx_sales_order_detail.sales_order_id = '".$idso."' AND mst_bom_liquid.material_id = '".$row['material_id']."'")->row();
                $order = $bom->qty;
                $stock = $inv->stok_qty+0;
                $beli = $cek->purchase_order_liquid_detail_qty-$lpb->lpb_qty;
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
                                      <td>'.round($order,2).'</td> 
                                      <td>'.$beli.'</td>                                      
                                      <td class="hidden">'.$row['material_price'].'</td> 
                                      <td class="hidden">'.$row['product_id'].'</td>                                      
                                      <td class="hidden">d'.$i.'</td>                                       
                                      <td>
                                        <button id="hdd'.$i.'" type="button" class="btn btn-xs btn-success"  onclick="addProduct(this,'.$order.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
              $i++;                      
            }     
            echo $strContent;            
          }

          function addTableSo_Liquid_byso(){
            
            $idproduct = $this->input->post("idx");
            $idso = $this->input->post("ids");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT mst_material.*, mst_product.*, sum(mst_bom_liquid.bom_liquid_qty) as qty 
            from mst_bom_liquid inner join mst_material on mst_bom_liquid.material_id = mst_material.material_id inner join mst_product on mst_product.product_id=mst_bom_liquid.product_id
              where material_categories_group_id != 10 group by mst_bom_liquid.material_id");           
            
            $i=1; 
            $strContent = '';
            $order=0;
            $idx = 0;
            $status = '';
            $beli =0;
            $stock =0;
            foreach($arrContent->result_array() as $key => $row){               
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
               // $idx = $row['sales_order_id'];
                $idm = $row['material_id'];
                $cek = $this->db->query("SELECT * from trx_purchase_order_liquid_detail inner join trx_purchase_order_liquid on trx_purchase_order_liquid_detail.purchase_order_liquid_id = trx_purchase_order_liquid.purchase_order_liquid_id  where material_id = '".$idm."' AND sales_order_id = '".$idso."'")->row();
                $lpb = $this->db->query("SELECT sum(lpb_liquid_detail_qty) as lpb_qty from trx_lpb_liquid_detail where material_id = '".$idm."'")->row();
                $inv = $this->db->query("SELECT sum(inventory_stock_qty) as stok_qty from trx_inventory where material_id = '".$row['material_id']."' AND inventory_categories = 'stock'")->row();
                $bom = $this->db->query("SELECT sum(mst_bom_liquid.bom_liquid_qty*sales_order_detail_qty) as qty, sales_order_detail_qty from mst_bom_liquid inner join trx_sales_order_detail on trx_sales_order_detail.product_id = mst_bom_liquid.product_id
                  inner join mst_material on mst_bom_liquid.material_id = mst_material.material_id inner join mst_product on mst_product.product_id=mst_bom_liquid.product_id
                  where material_categories_group_id != 10 AND trx_sales_order_detail.sales_order_id = '".$idso."' AND mst_bom_liquid.material_id = '".$row['material_id']."'")->row();
                $order = $bom->qty+0;
                $stock = $inv->stok_qty+0;
                $beli = $cek->purchase_order_liquid_detail_qty;
                $code = "'".$row['material_code']."'";
                $nama = "'".str_replace(" ","_",$row['material_name'])."'";
                if($order == ''){
                  $status = 'hidden';
                } else{
                  $status = '';
                }
                $strContent.='<tr class="record">   
                                  <td class="hidden">'.$row['material_id'].'</td>                                                                         
                                      <td>'.$row['material_code'].'</td>                                      
                                      <td>'.$row['material_name'].'</td>
                                      <td>'.$stock.'</td>
                                      <td>'.round($order,2).'</td> 
                                      <td>'.$beli.'</td>                                      
                                      <td class="hidden">'.$row['material_price'].'</td> 
                                      <td class="hidden">'.$row['product_id'].'</td>                                      
                                      <td class="hidden">d'.$i.'</td>                                       
                                      <td>
                                        <button id="hdd'.$i.'" type="button" class="btn btn-xs btn-success"  onclick="addProduct(this,'.$order.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
              $i++;                      
            }     
            echo $strContent;            
          }

          function addTableSo_material(){
            
            $idproduct = $this->input->post("idx");
            $idso = $this->input->post("ids");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT * from mst_material where material_categories_id = 2 ");           
            
            $i=1; 
            
            foreach($arrContent->result_array() as $key => $row){               
                $inv = $this->db->query("SELECT sum(inventory_stock_qty) as stok_qty from trx_inventory where material_id = '".$row['material_id']."' AND inventory_categories = 'stock'")->row();
                $stock = $inv->stock_qty+0;
                $strContent.='<tr class="record">   
                                  <td class="hidden">'.$row['material_id'].'</td>                                                                         
                                      <td>'.$row['material_code'].'</td>                                      
                                      <td>'.$row['material_name'].'</td> 
                                      <td>'.$stock.'</td>                                     
                                      <td class="hidden">'.$row['material_price'].'</td> 
                                      <td class="hidden">d'.$i.'</td>                                       
                                      <td style="text-align:center">
                                        <button id="hdd'.$i.'" type="button" class="btn btn-xs btn-success"  onclick="addProduct(this,'.$stock.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
              $i++;                      
            }     
            echo $strContent;            
          }

          function addTableProduct(){
            
            $idproduct = $this->input->post("idx");
            $arrContent = $this->db->query("SELECT trx_purchase_order_detail.purchase_order_id, mst_bom.*, trx_purchase_order_detail.purchase_order_detail_qty, trx_purchase_order_detail.product_id, 
                mst_material.*,sum(mst_bom.bom_qty*purchase_order_detail_qty) as qty
                from trx_purchase_order_detail left join mst_bom on mst_bom.product_id = trx_purchase_order_detail.product_id inner join mst_material on
                mst_material.material_id = mst_bom.material_id
                where purchase_order_id ='".$idproduct."' group by mst_bom.material_id");           
            
            $i =1;
      
            foreach($arrContent->result_array() as $key => $row){
            $cek = $this->db->query("SELECT sum(surat_jalan_detail_qty) as jml from trx_surat_jalan inner join trx_surat_jalan_detail on trx_surat_jalan.surat_jalan_id = 
              trx_surat_jalan_detail.surat_jalan_id where purchase_order_id = '".$row['purchase_order_id']."' AND material_id = '".$row['material_id']."'")->row();
             if ($row['qty'] <= $cek->jml ) {
                  
                } else{ 
                $jml = $cek->jml+0;
                $strContent.='<tr class="record">   
                                  <td class="hidden">'.$row['material_id'].'</td>                                                                         
                                      <td>'.$row['material_code'].'</td>                                      
                                      <td>'.$row['material_name'].'</td>
                                      <td>'.$row['qty'].'</td>
                                      <td>'.$jml.'</td>                           
                                      <td class="hidden">'.$row['product_id'].'</td>
                                      <td class="hidden">'.$row['material_price'].'</td>
                                      <td class="hidden">'.$row['purchase_order_id'].'</td>
                                      <td class="hidden">d'.$i.'</td>                                       
                                      <td>
                                        <button id="hdd'.$i.'" type="button" class="btn btn-xs btn-success"  onclick="addProduct(this)"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Pilih</button>
                                      </td>
                                </tr>';
              $i++;  
              }                    
            }     
            echo $strContent;            
          }

          function addTableSo_det1(){
            
            $idproduct = $this->input->post("idx");
            $idso = $this->input->post("ids");
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT sum(trx_sales_order_detail.sales_order_detail_qty) as qty_det,trx_sales_order_detail.*, mst_material.*, mst_product.*, sum(mst_bom.bom_qty) as qty 
				from trx_sales_order_detail inner join mst_bom on mst_bom.product_id = trx_sales_order_detail.product_id
            	inner join mst_material on mst_bom.material_id = mst_material.material_id inner join mst_product on mst_product.product_id=trx_sales_order_detail.product_id
            	where material_categories_id = 2 AND (sales_order_id = '".$idso."' AND (material_name like '%".$idproduct."%' OR material_code like '%".$idproduct."%')) group by mst_bom.material_id LIMIT 10");           
            
            $i=1; 
            $strContent = '';
            $order=0;
            $idx = 0;
            $status = '';
            foreach($arrContent->result_array() as $key => $row){               
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $idx = $row['sales_order_id'];
                $idm = $row['product_id'];
                $cek = $this->db->query("SELECT * from trx_purchase_order_liquid_detail inner join trx_purchase_order_liquid on trx_purchase_order_liquid_detail.purchase_order_liquid_id = trx_purchase_order_liquid.purchase_order_liquid_id  where sales_order_id = '".$idx."' AND product_id = '".$idm."'")->row();
                $order = ($row['qty_det']*$row['qty']) - $cek->purchase_order_liquid_detail_qty;
                $code = "'".$row['material_code']."'";
                $nama = "'".str_replace(" ","_",$row['material_name'])."'";
                if($order == 1){
                	$status = 'hidden';
                } else{
                	$status = '';
                }
                $strContent.='<tr class="record '.$status.'">   
                            <td>'.$row['material_id'].'</td>                                                                         
                                      <td>'.$row['material_code'].'</td>                                      
                                      <td>'.$row['material_name'].'</td> 
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


          public function saveProductPo()
		    {
		      //echo "<pre>";print_r($_POST);"</pre>";exit();
		    	$cek = $this->db->query("SELECT * from trx_purchase_order_liquid where purchase_order_liquid_code = '".$this->input->post("nomor")."'");
		        if($cek->num_rows() != 0){
		        	$idso = $cek->row()->purchase_order_liquid_id;
		        	$data['purchase_order_liquid_code'] = $this->input->post("nomor");
		        	$data['purchase_order_liquid_note'] = $this->input->post("note");
              $data['purchase_order_liquid_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
              $data['purchase_order_liquid_delivery_date'] = date("Y-m-d", strtotime($this->input->post("tgldel")));
		        	$this->db->where('purchase_order_liquid_id',$idso);
          			$this->db->update("trx_purchase_order_liquid", $data);
		        } else{
			        $data['provider_id'] = $this->input->post("id_customer");
			        $data['sales_order_id'] = $this->input->post("id_sales");
			        $data['purchase_order_liquid_code'] = $this->input->post("nomor");
			        $data['purchase_order_liquid_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
			        $data['purchase_order_liquid_delivery_date'] = date("Y-m-d", strtotime($this->input->post("tgldel")));
			        $data['purchase_order_liquid_note'] = $this->input->post("note");
			        $data['purchase_order_liquid_date_created'] = date("Y-m-d");
			        $data['purchase_order_liquid_last_updated'] = date("Y-m-d");      
			        $data['purchase_order_liquid_log'] = "insert by dwi";
			        //$data['purchase_order_deposit'] = 0;		          
			          
			        $this->db->insert("trx_purchase_order_liquid", $data);

			        $idso = $this->db->insert_id();
		    	}
		        $c_kontak = count($this->input->post("id_material"));
					
				for($i=0; $i<$c_kontak;$i++)
				{
					$idp = $_POST['id_material'][$i];
					$coba = $this->db->query("SELECT * from trx_purchase_order_liquid_detail where purchase_order_liquid_id = '".$idso."' AND material_id = '".$idp."'");
					if($coba->num_rows() != 0){
						$data2['purchase_order_liquid_detail_qty'] = $_POST['qty'][$i];
						$data2['purchase_order_liquid_detail_price'] = strToCurrDB($_POST['nominal'][$i]);
						$data2['purchase_order_liquid_detail_desc'] = $_POST['desc'][$i];
						$data2['purchase_order_liquid_detail_last_updated'] = date("Y-m-d");
						$this->db->where('purchase_order_liquid_detail_id',$_POST['iddetail'][$i]);
          				$this->db->update("trx_purchase_order_liquid_detail", $data2);
					} else{
						$data2['purchase_order_liquid_id'] = $idso;
						$data2['material_id'] = $_POST['id_material'][$i];
						//$data2['product_id'] = $_POST['id_product'][$i];
						$data2['purchase_order_liquid_detail_qty'] = $_POST['qty'][$i];
						$data2['purchase_order_liquid_detail_price'] = strToCurrDB($_POST['nominal'][$i]);
						$data2['purchase_order_liquid_detail_desc'] = $_POST['desc'][$i];
						//$data2['purchase_order_detail_remax'] = $_POST['qty'][$i];
						$data2['purchase_order_liquid_detail_date_created'] = date("Y-m-d");
						$data2['purchase_order_liquid_detail_last_updated'] = date("Y-m-d");
						$data2['purchase_order_liquid_detail_log'] = "insert by dwi";
						$this->db->insert("trx_purchase_order_liquid_detail", $data2);
					}
				}
		    }


        public function saveSuratJalan()
        {
          //echo "<pre>";print_r($_POST);"</pre>";exit();
          $cek = $this->db->query("SELECT * from trx_surat_jalan where provider_id = '".$this->input->post("id_rekanan")."' AND surat_jalan_code = '".$this->input->post("nomor")."'");
              if($cek->num_rows() != 0){
                $idso = $cek->row()->surat_jalan_id;
                //$data['lpb_liquid_code'] = $this->input->post("nomor");
                $data['surat_jalan_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
                $data['surat_jalan_dikirim_dari'] = $this->input->post("kirim");
                $data['surat_jalan_diangkut_melalui'] = $this->input->post("kendaraan");
                $data['surat_jalan_nomor_kendaraan'] = $this->input->post("napol");
                $data['surat_jalan_last_updated'] = date("Y-m-d");
                $this->db->where('surat_jalan_id',$idso);
                $this->db->update("trx_surat_jalan", $data);
              } else{                
                $data['provider_id'] = $this->input->post("id_rekanan");
                $data['surat_jalan_code'] = $this->input->post("nomor");
                $data['surat_jalan_date'] = date("Y-m-d", strtotime($this->input->post("tglreg")));
                $data['surat_jalan_dikirim_dari'] = $this->input->post("kirim");
                $data['surat_jalan_diangkut_melalui'] = $this->input->post("kendaraan");
                $data['surat_jalan_nomor_kendaraan'] = $this->input->post("napol");
                $data['surat_jalan_last_updated'] = date("Y-m-d");           
                $data['surat_jalan_date_created'] = date("Y-m-d");
                $data['surat_jalan_log'] = "insert by dwi";
                              
                  
                $this->db->insert("trx_surat_jalan", $data);

                $idso = $this->db->insert_id();
            }
              $c_kontak = count($this->input->post("id_material"));
            
          for($i=0; $i<$c_kontak;$i++)
          {
            $idp = $_POST['id_material'][$i];
            $coba = $this->db->query("SELECT * from trx_surat_jalan_detail where surat_jalan_id = '".$idso."' AND material_id = '".$idp."'");
            $iddet = $_POST['iddetail'][$i];          
            if($coba->num_rows() != 0 && $iddet != 0){

              $data2['surat_jalan_detail_qty'] = $_POST['qty'][$i];
              //$data2['lpb_liquid_detail_price'] = strToCurrDB($_POST['nominal'][$i]);
              $data2['surat_jalan_detail_note'] = $_POST['desc'][$i];
              $data2['surat_jalan_detail_last_updated'] = date("Y-m-d");
              $this->db->where('surat_jalan_detail_id',$_POST['iddetail'][$i]);
              $this->db->update("trx_surat_jalan_detail", $data2);

              // $data3['inventory_jumlah_nominal'] = strToCurrDB($_POST['nominal'][$i]);
              // $data3['inventory_stock_qty'] = '-'.$_POST['qty'][$i];
              // $data3['inventory_jenis'] = "out";            
              // $data3['inventory_description'] = $_POST['desc'][$i];
              // $data3['inventory_log'] = "update by Lusi";
              // $this->db->where('inventory_id',$coba->row()->inventory_id);
              // $this->db->update("trx_inventory", $data3);
            } else{
              // $data3['warehouse_id'] = 1;
              // $data3['inventory_categories'] = 'stock';
              // $data3['material_id'] = $_POST['id_material'][$i];
              // $data3['inventory_item_categories'] = 'material';
              // $data3['inventory_jumlah_nominal'] = strToCurrDB($_POST['nominal'][$i]);
              // $data3['inventory_stock_qty'] = '-'.$_POST['qty'][$i];
              // $data3['inventory_jenis'] = "out";
              // $data3['inventory_date_transaction'] = date("Y-m-d");
              // $data3['inventory_date_created'] = date("Y-m-d");
              // $data3['inventory_description'] = $_POST['desc'][$i];
              // $data3['inventory_log'] = "insert by Lusi";
              // $this->db->insert("trx_inventory", $data3);

              // $idinv = $this->db->insert_id();

              $data2['surat_jalan_id'] = $idso;
              //$data2['inventory_id'] = $idinv;
              $data2['material_id'] = $_POST['id_material'][$i];
              $data2['purchase_order_id'] = $_POST['purchase'][$i];
              $data2['surat_jalan_detail_qty'] = $_POST['qty'][$i];
              //$data2['lpb_liquid_detail_price'] = strToCurrDB($_POST['nominal'][$i]);
              $data2['surat_jalan_detail_note'] = $_POST['desc'][$i];
              //$data2['purchase_order_detail_remax'] = $_POST['qty'][$i];
              $data2['surat_jalan_detail_date_created'] = date("Y-m-d");
              $data2['surat_jalan_detail_last_updated'] = date("Y-m-d");
              $data2['surat_jalan_detail_log'] = "insert by Lusi";
              $this->db->insert("trx_surat_jalan_detail", $data2);            

            }
          }
        }

		    public function GetDaftarPORaw()
		    {
		      $this->checkCredentialAccess();

		            $this->checkIsAjaxRequest();
		            
		            $this->load->model("suport_model", "ModelRaw");
		            
		            echo $this->ModelRaw->GetDaftarSales(); 
		    }

        public function GetDaftarDetailSuport()
        {
          $this->checkCredentialAccess();

                $this->checkIsAjaxRequest();
                
                $this->load->model("suport_model", "ModelRaw");
                
                echo $this->ModelRaw->GetDaftarDetailSuport(); 
        }

        public function GetDaftarDetailKebutuhan()
        {
          $this->checkCredentialAccess();

                $this->checkIsAjaxRequest();
                
                $this->load->model("suport_model", "ModelRaw");
                
                echo $this->ModelRaw->GetDaftarDetailKebutuhan(); 
        }

        public function GetDaftarKebutuhanVendor()
        {
          $this->checkCredentialAccess();

                $this->checkIsAjaxRequest();
                
                $this->load->model("suport_model", "ModelRaw");
                
                echo $this->ModelRaw->GetDaftarKebutuhanVendor(); 
        }

        public function GetDaftarSj()
        {
          $this->checkCredentialAccess();

                $this->checkIsAjaxRequest();
                
                $this->load->model("suport_model", "ModelRaw");
                
                echo $this->ModelRaw->GetDaftarSj(); 
        }

		    public function HapusSm()
		    {
		      $this->checkCredentialAccess();

		            $this->checkIsAjaxRequest();

		      $idx = $this->input->post('ID');
		      
		      $idx =   $this->input->post('ID');
		      $this->db->delete('trx_purchase_order_liquid_detail', array('purchase_order_liquid_id' => $idx));
		      $this->db->delete('trx_purchase_order_liquid', array('purchase_order_liquid_id' => $idx));
		       
		      
		    }

        public function HapusSuratJalan()
        {
          $this->checkCredentialAccess();

                $this->checkIsAjaxRequest();

          $idx = $this->input->post('ID');
          
          $idx =   $this->input->post('ID');
          $this->db->delete('trx_surat_jalan_detail', array('surat_jalan_id' => $idx));
          $this->db->delete('trx_surat_jalan', array('surat_jalan_id' => $idx));
        }

		    public function habusdataSm()
		    {
		      $this->checkCredentialAccess();

		      $this->checkIsAjaxRequest();

		      $idx =   $this->input->post('ID');
		      $this->db->delete('trx_purchase_order_liquid_detail', array('purchase_order_liquid_detail_id' => $idx));		      
		      
		    }

        public function habusdataSJ()
        {
          $this->checkCredentialAccess();

          $this->checkIsAjaxRequest();

          $idx =   $this->input->post('ID');
          $this->db->delete('trx_surat_jalan_detail', array('surat_jalan_detail_id' => $idx));          
          
        }

		    public function adddataSm()
		    {
		      	$data2['purchase_order_liquid_id'] = $this->input->post("po_id");
    				$data2['material_id'] = $this->input->post("mat_id");
    				//$data2['product_id'] = $this->input->post("prod_id");
    				$data2['purchase_order_liquid_detail_qty'] = $this->input->post("qty");
    				$data2['purchase_order_liquid_detail_price'] = $this->input->post("price");
    				$data2['purchase_order_liquid_detail_desc'] = '';
    				//$data2['purchase_order_detail_remax'] = $_POST['qty'][$i];
    				$data2['purchase_order_liquid_detail_date_created'] = date("Y-m-d");
    				$data2['purchase_order_liquid_detail_last_updated'] = date("Y-m-d");
    				$data2['purchase_order_liquid_detail_log'] = "insert by dwi";
    				$this->db->insert("trx_purchase_order_liquid_detail", $data2);		      
		      
		    } 	
	   	

}

/* End of fiel Utility.php */
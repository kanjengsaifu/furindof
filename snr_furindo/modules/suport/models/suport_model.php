<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

    class Suport_model extends CI_Model{
    	
		  private $selectQuery;
      private $arrMenuData;

      public function __construct() {
          parent::__construct();
      }

      public function GetMenuAdmin()
      {
        
          $this->selectQuery = $this->db->query("SELECT id_modul as IDModul FROM sys_modul WHERE nama_modul='PO-SM'");

          $this->arrMenuData = $this->selectQuery->row_array();
          
          $this->IDModulInduk =$this->arrMenuData['IDModul'];

          return getTreeMenuData($this->IDModulInduk, 'sys_modul', 'id_modul', 'id_modul', 'nama_modul');           
      	
      }

      function GetDaftarSales()
        {
          $this->selectQuery = $this->db->query("SELECT * from trx_purchase_order_liquid left join trx_sales_order on trx_sales_order.sales_order_id = trx_purchase_order_liquid.sales_order_id inner join mst_provider on trx_purchase_order_liquid.provider_id = mst_provider.provider_id  order by purchase_order_liquid_id desc");
       
          $arrSelectQuery = array();
          
          foreach ($this->selectQuery->result_array() as $row) {
          $cek = $this->db->query("SELECT * from trx_lpb_liquid inner join trx_lpb_liquid_detail on trx_lpb_liquid.lpb_liquid_id = trx_lpb_liquid_detail.lpb_liquid_id 
            where purchase_order_liquid_id = '".$row['purchase_order_liquid_id']."'");
          $idsales = $row['purchase_order_liquid_id'];
          if($row['sales_order_id'] != '')
          {
            $idx = $row['sales_order_id'];
          } else{
            $idx=0;
          }
          
          $fr = $row['purchase_order_liquid_code']; 
          if($cek->num_rows() == 0){
            $strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales, $idx)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Hapus</button>&nbsp;<button type='button' class='btn btn-xs btn-success' onclick='printShow($idsales)'><span class='glyphicon glyphicon-print' aria-hidden='true'></span> Print</button>";
          } else{        
            // $strDataAction = "<button type='button' disabled class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>&nbsp;<button type='button' disabled class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
            $strDataAction = "<button type='button' class='btn btn-xs btn-success' onclick='printShow($idsales)'><span class='glyphicon glyphicon-print' aria-hidden='true'></span> Print</button>";
          }
            $arrSelectQuery[] = array('idx'    => $row['purchase_order_liquid_id'],
                                      'kode'   => $row['purchase_order_liquid_code'],                                      
                                      'nama'   => $row['provider_name'],
                                      'date'    => date("d-m-Y", strtotime($row['purchase_order_liquid_date'])),
                                      'address'  => $row['provider_address'], 
                                      'phone'    => $row['provider_phone'],
                                      'ref_no'    => $row['sales_order_ref_no'],
                                      'action' => $strDataAction);
          }

          return json_encode($arrSelectQuery);

        }

        function GetDaftarSj()
        {
          $this->selectQuery = $this->db->query("SELECT * from trx_surat_jalan inner join mst_provider on trx_surat_jalan.provider_id = mst_provider.provider_id order by surat_jalan_id desc");
       
          $arrSelectQuerySj = array();

          foreach ($this->selectQuery->result_array() as $row) {
          //$cek = $this->db->query("SELECT * from trx_lpb_liquid where purchase_order_liquid_id = '".$row['purchase_order_liquid_id']."'");
          $idsales = $row['surat_jalan_id'];
          //$fr = $row['purchase_order_liquid_code']; 
          if($row['surat_jalan_id'] != 0){
            $strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Hapus</button>&nbsp;<button type='button' class='btn btn-xs btn-success' onclick='printShow($idsales)'><span class='glyphicon glyphicon-print' aria-hidden='true'></span> Print</button>";
          } else{        
            // $strDataAction = "<button type='button' disabled class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>&nbsp;<button type='button' disabled class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
            $strDataAction = "<button type='button' class='btn btn-xs btn-info' onclick='detailShow($idsales)'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Detail</button>";
          }
            $arrSelectQuerySj[] = array('idx'    => $row['surat_jalan_id'],
                                      'kode'   => $row['surat_jalan_code'],                                      
                                      'nama'   => $row['provider_name'],
                                      'date'    => date("d-m-Y", strtotime($row['surat_jalan_date'])),
                                      'address'  => $row['provider_address'], 
                                      'phone'    => $row['provider_phone'],
                                      'ref_no'    => $row['provider_code'],
                                      'action' => $strDataAction);
          }

          return json_encode($arrSelectQuerySj);

        }

        function GetDaftarDetailSuport()
        {
          $this->selectQuery = $this->db->query("SELECT (purchase_order_liquid_detail_qty*purchase_order_liquid_detail_price) as harga, trx_purchase_order_liquid_detail.*, 
            trx_purchase_order_liquid.*, mst_material.*, mst_provider.* from trx_purchase_order_liquid_detail inner join trx_purchase_order_liquid on 
            trx_purchase_order_liquid_detail.purchase_order_liquid_id = trx_purchase_order_liquid.purchase_order_liquid_id
            inner join mst_material on mst_material.material_id = trx_purchase_order_liquid_detail.material_id
            inner join mst_provider on mst_provider.provider_id = trx_purchase_order_liquid.provider_id");
       
          $arrSelectQuerySj = array();
          $no=1;
          foreach ($this->selectQuery->result_array() as $row) {
          //$cek = $this->db->query("SELECT * from trx_lpb_liquid where purchase_order_liquid_id = '".$row['purchase_order_liquid_id']."'");
          $idsales = $row['purchase_order_liquid_detail_id'];
          
          //$fr = $row['purchase_order_liquid_code']; 
          if($row['purchase_order_liquid_detail_qty'] != 0){
            $strDataAction = 'OK';
            //$strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Hapus</button>&nbsp;<button type='button' class='btn btn-xs btn-info' onclick='detailShow($idsales)'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Detail</button>";
          } else{  
            $strDataAction = 'OK';      
            // $strDataAction = "<button type='button' disabled class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>&nbsp;<button type='button' disabled class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
            //$strDataAction = "<button type='button' class='btn btn-xs btn-info' onclick='detailShow($idsales)'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Detail</button>";
          }
            $arrSelectQuerySj[] = array('idx'    => $row['purchase_order_liquid_detail_id'],
                                      'po'    => $row['purchase_order_liquid_code'],
                                      'kode'   => $row['material_code'],                                      
                                      'nama'   => $row['material_name'],
                                      'provider'   => $row['provider_name'],
                                      'date'    => date("d-m-Y", strtotime($row['purchase_order_liquid_date'])),
                                      'qty'  => round($row['purchase_order_liquid_detail_qty'],2), 
                                      'price'    => round($row['harga'],2),
                                      'no'    => $no,
                                      'action' => $strDataAction);
            $no++;
          }

          return json_encode($arrSelectQuerySj);

        }


        function GetDaftarDetailKebutuhan()
        {
          //$this->selectQuery = $this->db->query("SELECT * from trx_sales_order inner join trx_sales_order_detail on trx_sales_order.sales_order_id = trx_sales_order_detail.sales_order_id
           // inner join mst_product on mst_product.product_id = trx_sales_order_detail.product_id");
          $this->selectQuery = $this->db->query("SELECT trx_sales_order.*, sum(trx_sales_order_detail.sales_order_detail_qty * bom_liquid_qty) as qty_det,trx_sales_order_detail.*, mst_material.*, mst_product.*, sum(mst_bom_liquid.bom_liquid_qty) as qty 
              from trx_sales_order_detail inner join mst_bom_liquid on mst_bom_liquid.product_id = trx_sales_order_detail.product_id
              inner join trx_sales_order on trx_sales_order.sales_order_id = trx_sales_order_detail.sales_order_id
              inner join mst_material on mst_bom_liquid.material_id = mst_material.material_id inner join mst_product on mst_product.product_id=trx_sales_order_detail.product_id
              where material_categories_id = 2 AND sales_order_categories = 'sales' group by mst_bom_liquid.bom_liquid_id");
          $arrSelectQueryKAB = array();
          $no=1;
          foreach ($this->selectQuery->result_array() as $row) {
          
          //$cek = $this->db->query("SELECT * from trx_sales_order inner join trx_sales_order_detail on trx_sales_order.sales_order_id = trx_sales_order_detail.sales_order_id
           // inner join mst_product on mst_product.product_id = trx_sales_order_detail.product_id");          
           // foreach ($cek->result() as $valeu) {
           
              $arrSelectQueryKAB[] = array('idx'    => $no,
                                        'so'    => $row['sales_order_ref_no'],
                                        'kode'   => $row['product_code'],                                      
                                        'nama'   => $row['product_name'],
                                        'mat_code'   => $row['material_code'],
                                        'date'    => date("d-m-Y", strtotime($row['sales_order_date'])),
                                        'mat_name'  => $row['material_name'], 
                                        'price'    => $row['material_price'],
                                        'action' => round($row['qty_det'],2));
              $no++;
            }
          

          return json_encode($arrSelectQueryKAB);

        }

        function GetDaftarKebutuhanVendor()
        {
          $this->selectQuery = $this->db->query("SELECT trx_sales_order.*, (trx_sales_order_detail.sales_order_detail_qty * bom_qty) as qty_det,trx_sales_order_detail.*, mst_material.*, mst_product.*, (mst_bom.bom_qty) as qty 
              from trx_sales_order_detail inner join mst_bom on mst_bom.product_id = trx_sales_order_detail.product_id
              inner join trx_sales_order on trx_sales_order.sales_order_id = trx_sales_order_detail.sales_order_id
              inner join mst_material on mst_bom.material_id = mst_material.material_id inner join mst_product on mst_product.product_id=trx_sales_order_detail.product_id
              where material_categories_id = 2");
          $arrSelectQueryKAB = array();
          $no=1;
          foreach ($this->selectQuery->result_array() as $row) {
          
              $arrSelectQueryKAB[] = array('idx'    => $no,
                                        'so'    => $row['sales_order_ref_no'],
                                        'kode'   => $row['product_code'],                                      
                                        'nama'   => $row['product_name'],
                                        'mat_code'   => $row['material_code'],
                                        'date'    => date("d-m-Y", strtotime($row['sales_order_date'])),
                                        'mat_name'  => $row['material_name'], 
                                        'price'    => $row['material_price'],
                                        'action' => round($row['qty_det'],2));
              $no++;
            }
          

          return json_encode($arrSelectQueryKAB);

        }

      
    }


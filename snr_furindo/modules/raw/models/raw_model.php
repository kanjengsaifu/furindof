<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

    class Raw_model extends CI_Model{
    	
		  private $selectQuery;
      private $arrMenuData;

      public function __construct() {
          parent::__construct();
      }

      public function GetMenuAdmin()
      {
        
          $this->selectQuery = $this->db->query("SELECT id_modul as IDModul FROM sys_modul WHERE nama_modul='PO-RAW'");

          $this->arrMenuData = $this->selectQuery->row_array();
          
          $this->IDModulInduk =$this->arrMenuData['IDModul'];

          return getTreeMenuData($this->IDModulInduk, 'sys_modul', 'id_modul', 'id_modul', 'nama_modul');           
      	
      }

      function GetDaftarSales()
        {
          $this->selectQuery = $this->db->query("SELECT * from trx_purchase_order inner join mst_provider on trx_purchase_order.provider_id = mst_provider.provider_id  
            inner join trx_sales_order on trx_sales_order.sales_order_id = trx_purchase_order.sales_order_id order by purchase_order_id desc");
       
          $arrSelectQuery = array();
          $no =$this->selectQuery->num_rows();
          foreach ($this->selectQuery->result_array() as $row) {
          $cek = $this->db->query("SELECT * from trx_lpb inner join trx_lpb_detail on trx_lpb.lpb_id = trx_lpb_detail.lpb_id where purchase_order_id = '".$row['purchase_order_id']."'");
          $idsales = $row['purchase_order_id'];
          $fr = $row['purchase_order_code']; 
          if($cek->num_rows() == 0){
            $strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Hapus</button>&nbsp;<button type='button' class='btn btn-xs btn-success' onclick='printShow($idsales)'><span class='glyphicon glyphicon-print' aria-hidden='true'></span> Print</button>";
          } else{        
            // $strDataAction = "<button type='button' disabled class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>&nbsp;<button type='button' disabled class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
            $strDataAction = "<button type='button' class='btn btn-xs btn-info' onclick='detailShow($idsales)'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Detail</button>&nbsp;<button type='button' class='btn btn-xs btn-success' onclick='printShow($idsales)'><span class='glyphicon glyphicon-print' aria-hidden='true'></span> Print</button>";
          }
            $arrSelectQuery[] = array('idx'    => $row['purchase_order_id'],
                                      'kode'   => $row['sales_order_ref_no'],
                                      'ref'   => $row['purchase_order_code'],                                      
                                      'nama'   => $row['provider_name'],
                                      'date'    => $row['purchase_order_date'],
                                      'address'  => $row['provider_address'], 
                                      'phone'    => $row['provider_phone'],
                                      'no'    => $no,
                                      'action' => $strDataAction);
            $no--;
          }

          return json_encode($arrSelectQuery);

        }

      function GetDaftarSample()
        {
          $this->selectQuery = $this->db->query("SELECT * from trx_purchase_order_sample inner join mst_provider on trx_purchase_order_sample.provider_id = mst_provider.provider_id group by purchase_order_sample_code order by purchase_order_sample_id desc");
       
          $arrSelectQuery = array();
          $no =$this->selectQuery->num_rows();
          foreach ($this->selectQuery->result_array() as $row) {
          $cek = $this->db->query("SELECT * from trx_lpb_sample inner join trx_lpb_sample_detail on trx_lpb_sample.lpb_id = trx_lpb_sample_detail.lpb_id where purchase_order_sample_id = '".$row['purchase_order_sample_id']."'");
          $idsales = $row['purchase_order_sample_id'];
          $fr = $row['purchase_order_sample_code']; 
          if($cek->num_rows() == 0){
            $strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Hapus</button>&nbsp;<button type='button' class='btn btn-xs btn-success' onclick='printShow($idsales)'><span class='glyphicon glyphicon-print' aria-hidden='true'></span> Print</button>";
          } else{        
            $strDataAction = "<button type='button' class='btn btn-xs btn-success' onclick='printShow($idsales)'><span class='glyphicon glyphicon-print' aria-hidden='true'></span> Print</button>";
          }
            $arrSelectQuery[] = array('idx'    => $row['purchase_order_sample_id'],
                                      'kode'   => $row['purchase_order_sample_code'],
                                      'nama'   => $row['provider_name'],
                                      'date'    => $row['date'],
                                      'address'  => $row['provider_address'], 
                                      'phone'    => $row['provider_phone'],
                                      'no'    => $no,
                                      'action' => $strDataAction);
            $no--;
          }

          return json_encode($arrSelectQuery);

        }

      function GetDetailRaw()
        {
          $this->selectQuery = $this->db->query("SELECT * from trx_purchase_order_detail inner join trx_purchase_order on trx_purchase_order.purchase_order_id = trx_purchase_order_detail.purchase_order_id
            inner join trx_sales_order on trx_sales_order.sales_order_id = trx_purchase_order.sales_order_id inner join mst_provider on mst_provider.provider_id =
            trx_purchase_order.provider_id inner join mst_product on mst_product.product_id = trx_purchase_order_detail.product_id order by trx_purchase_order.purchase_order_id desc");
       
          $arrSelectQuery = array();
          $datang = 0;
          $sisa = 0;
          $no =$this->selectQuery->num_rows();
          foreach ($this->selectQuery->result_array() as $row) {
            $po = $row['purchase_order_id'];
            $prd = $row['product_id'];
            $cek = $this->db->query("SELECT sum(lpb_detail_qty) as qty from trx_lpb inner join trx_lpb_detail on trx_lpb.lpb_id = trx_lpb_detail.lpb_id where 
              purchase_order_id = '".$po."' AND product_id = '".$prd."'")->row();   
            $datang = $cek->qty+0;
            $sisa = $row['purchase_order_detail_qty']-$datang;
            // $strDataAction = "<button type='button' disabled class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>&nbsp;<button type='button' disabled class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
            if(date('Y-m-d', strtotime('2016-01-21')) > $row['purchase_order_delivery_date'] && $sisa != 0 ){
              $red = 'red';
            } else {
              $red = 'blue';
            }
            $strDataAction = "<button id='$red' type='button' class='btn btn-xs btn-info' onclick='detailShow()'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Detail</button>";
          
            $arrSelectQuery[] = array('idx'    => $row['purchase_order_detail_id'],
                                      'kode'   => $row['purchase_order_code'], 
                                      'ref'   =>  $row['sales_order_ref_no'],
                                      'prd'   =>  $row['product_code'],                                    
                                      'nama'   => $row['provider_name'],
                                      'product'   => $row['product_name'],
                                      'date'    => $row['purchase_order_date'],
                                      'delivery'    => $row['purchase_order_delivery_date'],
                                      'qty'  => $row['purchase_order_detail_qty'], 
                                      'datang'    => $datang,
                                      'sisa'    => $sisa,
                                      'no'    => $no,
                                      'action' => $strDataAction);
            $no--;
          }

          return json_encode($arrSelectQuery);

        }

        function GetBalanceRaw()
        {
          $this->selectQuery = $this->db->query("SELECT * from trx_sales_order inner join trx_sales_order_detail on trx_sales_order.sales_order_id = trx_sales_order_detail.sales_order_id
              inner join mst_product on mst_product.product_id = trx_sales_order_detail.product_id order by trx_sales_order_detail.sales_order_detail_id DESC");
       
          $arrSelectQueryBC = array();
          $datang = 0;
          $sisa = 0;
          $no =$this->selectQuery->num_rows();
          foreach ($this->selectQuery->result_array() as $row) {
            
            $so = $row['sales_order_id'];
            $po = $row['product_id'];
            $cek = $this->db->query("SELECT sum(purchase_order_detail_qty) as qty, mst_provider.* from trx_purchase_order inner join trx_purchase_order_detail on trx_purchase_order.purchase_order_id = trx_purchase_order_detail.purchase_order_id
                inner join mst_provider on mst_provider.provider_id = trx_purchase_order.provider_id where trx_purchase_order.sales_order_id = '".$so."' AND trx_purchase_order_detail.product_id = '".$po."'");
            // $strDataAction = "<button type='button' disabled class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>&nbsp;<button type='button' disabled class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
            $datang = $cek->row()->qty+0;
            $sisa = $row['sales_order_detail_qty'] - $datang;            
            if($sisa != 0){
              $red = 'red';
            } else {
              $red = 'blue';
            }
            $strDataAction = "<button id='$red' type='button' class='btn btn-xs btn-info' onclick='detailShow()'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Detail</button>";
          
            $arrSelectQueryBC[] = array('idx'    => $row['sales_order_detail_id'],
                                      'ref'   =>  $row['sales_order_ref_no'],
                                      'prd'   =>  $row['product_code'],                                    
                                      'product'   => $row['product_name'],
                                      'date'    => $row['sales_order_date'],
                                      'qty'  => $row['sales_order_detail_qty'], 
                                      'datang'    => $datang,
                                      'sisa'    => $sisa,
                                      'no'    => $no,
                                      'action' => $strDataAction);
            $no--;
          }

          return json_encode($arrSelectQueryBC);

        }

      
    }


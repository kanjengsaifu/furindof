<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

    class Production_model extends CI_Model{
    	
		  private $selectQuery;
      private $arrMenuData;

      public function __construct() {
          parent::__construct();
      }

      public function GetMenuAdmin()
      {
        
          $this->selectQuery = $this->db->query("SELECT id_modul as IDModul FROM sys_modul WHERE nama_modul='Production'");

          $this->arrMenuData = $this->selectQuery->row_array();
          
          $this->IDModulInduk =$this->arrMenuData['IDModul'];

          return getTreeMenuData($this->IDModulInduk, 'sys_modul', 'id_modul', 'id_modul', 'nama_modul');           
      	
      }

      function GetDaftarPacking()
        {
          $this->selectQuery = $this->db->query("SELECT * from trx_packing inner join trx_sales_order on trx_packing.sales_order_id = trx_sales_order.sales_order_id  order by packing_id desc");
       
          $arrSelectQuery = array();
          $no=0;
          foreach ($this->selectQuery->result_array() as $row) {
          $no++;
          $pack = $row['packing_id'];
          $cek = $this->db->query("SELECT * from trx_shipment_detail where packing_id = '".$pack."'");
          $idsales = $row['packing_id'];
          if($cek->num_rows() != 0){
            $status = 'disabled';
          }else{
            $status = '';
          }
           $strDataAction = "<button type='button' ".$status." class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</button>&nbsp;<button type='button' ".$status." class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Delete</button>";
            //$strDataAction = "<button type='button' class='btn btn-xs btn-info' onclick='detailShow($idsales)'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Detail</button>";
          
            $arrSelectQuery[] = array('idx'    => $row['packing_id'],
                                      'so'   => $row['sales_order_ref_no'],                                      
                                      'kode'   => $row['packing_code'],
                                      'date'    => $row['packing_date'],
                                      'status'  => $row['packing_status'], 
                                      'note'    => $row['packing_note'],
                                      'no'   => $no,
                                      'action' => $strDataAction);
          }

          return json_encode($arrSelectQuery);

        }

    function GetDaftarShipment()
        {
          $this->selectQuery = $this->db->query("SELECT * from trx_shipment order by shipment_id desc");
       
          $arrSelectQuerysh = array();
          $no=0;
          foreach ($this->selectQuery->result_array() as $row) {
          $no++;
          $idsales = $row['shipment_id'];
           $strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</button>&nbsp;
           <button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Delete</button>
           <button type='button' class='btn btn-xs btn-success'  onclick='printInv($idsales)'><span class='glyphicon glyphicon-print' aria-hidden='true'></span> INV</button>
           <button type='button' class='btn btn-xs btn-primary'  onclick='printShow($idsales)'><span class='glyphicon glyphicon-print' aria-hidden='true'></span> List</button>";
            //$strDataAction = "<button type='button' class='btn btn-xs btn-info' onclick='detailShow($idsales)'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Detail</button>";
          
            $arrSelectQuerysh[] = array('idx'    => $row['shipment_id'],
                                      'kode'   => $row['shipment_code'],
                                      'date'    => $row['shipment_date'],
                                      'container'  => $row['shipment_container_code'], 
                                      'driver'    => $row['shipment_driver'],
                                      'truck'    => $row['shipment_truck_code'],
                                      'no'   => $no,
                                      'action' => $strDataAction);
          }

          return json_encode($arrSelectQuerysh);

        }

    function GetDaftarInv()
        {
          $this->selectQuery = $this->db->query("SELECT sum(inventory_stock_qty) as stock_qty, mst_material.*, trx_inventory.* from trx_inventory inner join mst_material on trx_inventory.material_id = mst_material.material_id 
            where inventory_item_categories = 'product' and inventory_categories = 'stock' group by mst_material.material_id order by mst_material.material_id desc");
       
          $arrSelectQuery = array();
          $no =0;
          foreach ($this->selectQuery->result_array() as $row) {
          $idsales = $row['inventory_id'];
          $stock = $row['stock_qty'];
          //$fr = $row['inventory_code']; 
          if($row['inventory_mode'] == 'public1'){
            $strDataAction = "<input type='number' min='1' step='0.01' value='$stock' name='qty[]' id='qty-$no' onkeyup='getnumeric(this)' atm='nominal-$no' class='form-control autocomplate'/>";
            $strDataAction = "<input type='number' min='1' step='0.01' value='$stock' name='qty[]' onkeyup='getnumeric(this)' atm='nominal-$no' class='form-control autocomplate'/>";
          } else{        
            // $strDataAction = "<button type='button' disabled class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>&nbsp;<button type='button' disabled class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
            $strDataAction = "<input type='number' min='1' step='0.01' value='$stock' name='qty[]' id='qty-$no' onkeyup='getnumeric(this)' atm='nominal-$no' class='form-control autocomplate'/>";
            $strDataAction = "<input type='number' min='1' step='0.01' value='$stock' name='qty[]' onkeyup='getnumeric(this)' atm='nominal-$no' class='form-control autocomplate'/>";
          }
            $arrSelectQueryRaw[] = array('idx'    => $row['inventory_id'],
                                      'kode'   => $row['material_code'],                                      
                                      'nama'   => $row['material_name'],
                                      'ok'    => $row['stock_qty'],
                                      'qty'  => $strDataAction, 
                                      'sample'    => 0,
                                      'no'    => $no,
                                      'action' => $strDataAction);
            $no++;
          }

          return json_encode($arrSelectQueryRaw);

        }

        function GetBalancePacking()
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
            $cek = $this->db->query("SELECT sum(packing_detail_qty) as qty from trx_packing_detail inner join trx_packing on trx_packing_detail.packing_id =  trx_packing.packing_id where sales_order_id = '".$so."' AND product_id = '".$po."' group by product_id");
            // $strDataAction = "<button type='button' disabled class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>&nbsp;<button type='button' disabled class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
            if($cek->num_rows() > 0){
              $datang = $cek->row()->qty+0;
            }else{
              $datang =0;
            }
            
            $sisa = $row['sales_order_detail_qty'] - $datang;            
            if($sisa == 0){
              $red = 'blue';
              $info = 'success';
            } else if($sisa == $row['sales_order_detail_qty']) {
              $red = 'red';
              $info = 'success';
            } else{
              $red = 'blue';
              $info = 'info';
            }
            $strDataAction = "<button id='$red' type='button' class='btn btn-xs btn-".$info."' onclick='detailShow(".$so.",".$po.")'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Detail</button>";
          
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


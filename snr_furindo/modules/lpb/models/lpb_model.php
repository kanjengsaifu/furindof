<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

    class Lpb_model extends CI_Model{
    	
		  private $selectQuery;
      private $arrMenuData;

      public function __construct() {
          parent::__construct();
      }

      public function GetMenuAdmin()
      {
        
          $this->selectQuery = $this->db->query("SELECT id_modul as IDModul FROM sys_modul WHERE nama_modul='lpb'");

          $this->arrMenuData = $this->selectQuery->row_array();
          
          $this->IDModulInduk =$this->arrMenuData['IDModul'];

          return getTreeMenuData($this->IDModulInduk, 'sys_modul', 'id_modul', 'id_modul', 'nama_modul');           
      	
      }

      function GetDaftarLpb()
        {
          $this->selectQuery = $this->db->query("SELECT * from trx_lpb inner join mst_provider on trx_lpb.provider_id = mst_provider.provider_id  order by lpb_date DESC, lpb_code DESC");
       
          $arrSelectQuery = array();

          foreach ($this->selectQuery->result_array() as $row) {
          $idsales = $row['lpb_id'];
          $fr = $row['lpb_code']; 
          if($row['lpb_status'] == 'draft'){
            $strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Hapus</button>&nbsp;<button type='button' class='btn btn-xs btn-success' onclick='printLPB($idsales)'><span class='glyphicon glyphicon-print' aria-hidden='true'></span> Print</button>";
          } else{        
            // $strDataAction = "<button type='button' disabled class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>&nbsp;<button type='button' disabled class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
            $strDataAction = "<button type='button' class='btn btn-xs btn-success' onclick='printLPB($idsales)'><span class='glyphicon glyphicon-print' aria-hidden='true'></span> Print</button>";
          }
            $arrSelectQuery[] = array('idx'    => $row['lpb_id'],
                                      'kode'   => $row['lpb_code'],                                      
                                      'nama'   => $row['provider_name'],
                                      'date'    => $row['lpb_date'],
                                      'address'  => $row['provider_address'], 
                                      'phone'    => $row['provider_phone'],
                                      'action' => $strDataAction);
          }

          return json_encode($arrSelectQuery);

        }

        function GetDaftarLpbSm()
        {
          $this->selectQuery = $this->db->query("SELECT * from trx_lpb_liquid inner join mst_provider on trx_lpb_liquid.provider_id = mst_provider.provider_id 
              inner join trx_lpb_liquid_detail  on trx_lpb_liquid.lpb_liquid_id = trx_lpb_liquid_detail.lpb_liquid_id
              left join trx_purchase_order_liquid on trx_lpb_liquid_detail.purchase_order_liquid_id = trx_purchase_order_liquid.purchase_order_liquid_id 
          group by trx_lpb_liquid.lpb_liquid_id order by trx_lpb_liquid.lpb_liquid_id desc");
       
          $arrSelectQuery = array();
          $no = 1;
          foreach ($this->selectQuery->result_array() as $row) {
          $idsales = $row['lpb_liquid_id'];
          $fr = $row['lpb_liquid_code']; 
          if($row['provider_id'] == ''){
            $strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow2($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Hapus</button>&nbsp;<button type='button' class='btn btn-xs btn-success' onclick='printLPB($idsales)'><span class='glyphicon glyphicon-print' aria-hidden='true'></span> Print</button>";
          } else if($row['lpb_liquid_status'] == 'draft' ) {
            $strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Hapus</button>&nbsp;<button type='button' class='btn btn-xs btn-success' onclick='printLPB($idsales)'><span class='glyphicon glyphicon-print' aria-hidden='true'></span> Print</button>";
          }else{        
            $strDataAction = "<button type='button' class='btn btn-xs btn-success' onclick='printLPB($idsales)'><span class='glyphicon glyphicon-print' aria-hidden='true'></span> Print</button>";
          }

          if($row['purchase_order_liquid_code'] == ''){
            $cast   = 'CAST'.$no;
            $no+=1;
          }else{
            $cast   = $row['purchase_order_liquid_code'];
          }
            $arrSelectQuerySM[] = array('idx'    => $row['lpb_liquid_id'],
                                      'kode'   => $row['lpb_liquid_code'],
                                      'po'   => $cast,
                                      'nama'   => $row['provider_name'],
                                      'date'    => $row['lpb_liquid_date'],
                                      'address'  => $row['lpb_liquid_note'], 
                                      'phone'    => $row['provider_phone'],
                                      'action' => $strDataAction);
          }

          return json_encode($arrSelectQuerySM);

        }
         function GetDaftarLpbJasa()
        {
        $this->selectQuery = $this->db->query("SELECT * from trx_lpb_jasa inner join mst_provider on trx_lpb_jasa.provider_id = mst_provider.provider_id order by lpb_id desc");
       
       
          $arrSelectQuery = array();
          $no = 1;
          foreach ($this->selectQuery->result_array() as $row) {
          $idsales = $row['lpb_id'];
          $fr = $row['lpb_code'];
          $strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Hapus</button>&nbsp;<button type='button' class='btn btn-xs btn-success' onclick='printLPB($idsales)'><span class='glyphicon glyphicon-print' aria-hidden='true'></span> Print</button>"; 
          
          $arrSelectQuerySM[] = array('idx'    => $row['lpb_id'],
                                      'kode'   => $row['lpb_code'],
                                      'nama'   => $row['provider_name'],
                                      'date'    => $row['lpb_date'],
                                      'note'  => $row['lpb_nota'], 
                                      'action' => $strDataAction);
          }

          return json_encode($arrSelectQuerySM);

        }



        function GetDaftarLpbUmum()
        {
          $this->selectQuery = $this->db->query("SELECT * from trx_lpb_umum order by lpb_id desc");
       
          $arrSelectQuery = array();
          $no = 1;
          foreach ($this->selectQuery->result_array() as $row) {
          $idsales = $row['lpb_id'];
          $fr = $row['lpb_code'];
          $strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Hapus</button>&nbsp;<button type='button' class='btn btn-xs btn-success' onclick='printLPB($idsales)'><span class='glyphicon glyphicon-print' aria-hidden='true'></span> Print</button>"; 
          
          $arrSelectQuerySM[] = array('idx'    => $row['lpb_id'],
                                      'kode'   => $row['lpb_code'],
                                      'nama'   => $row['toko'],
                                      'date'    => $row['lpb_date'],
                                      'note'  => $row['lpb_nota'], 
                                      'action' => $strDataAction);
          }

          return json_encode($arrSelectQuerySM);

        }


        function GetDaftarInv()
        {
          $this->selectQuery = $this->db->query("SELECT sum(inventory_stock_qty) as stock_qty, mst_material.*, trx_inventory.* from trx_inventory inner join mst_material on trx_inventory.material_id = mst_material.material_id 
            where inventory_item_categories = 'product' and inventory_categories = 'stock' group by mst_material.material_id order by mst_material.material_id desc");
       
          $arrSelectQuery = array();

          foreach ($this->selectQuery->result_array() as $row) {
          $idsales = $row['inventory_id'];
          //$fr = $row['inventory_code']; 
          if($row['inventory_mode'] == 'public1'){
            $strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow(this)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Hapus</button>&nbsp;<button type='button' class='btn btn-xs btn-info' onclick='detailShow($idsales)'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Detail</button>";
          } else{        
            // $strDataAction = "<button type='button' disabled class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>&nbsp;<button type='button' disabled class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
            $strDataAction = "<button type='button' class='btn btn-xs btn-info' onclick='detailShow($idsales)'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Detail</button>";
          }
            $arrSelectQueryRaw[] = array('idx'    => $row['inventory_id'],
                                      'kode'   => $row['material_code'],                                      
                                      'nama'   => $row['material_name'],
                                      'date'    => $row['inventory_date_transaction'],
                                      'qty'  => $row['stock_qty'], 
                                      'status'    => $row['inventory_categories'],
                                      'action' => $strDataAction);
          }

          return json_encode($arrSelectQueryRaw);

        }

        function GetDaftarInvGudang()
        {
          $this->selectQuery = $this->db->query("SELECT * from trx_inventory inner join mst_material on trx_inventory.material_id = mst_material.material_id 
            where inventory_item_categories = 'material' group by mst_material.material_id order by inventory_id ASC");
       
          $arrSelectQuery = array();
          $ttl_qty = 0;
          $awal = 0;
          $no=0;
          foreach ($this->selectQuery->result_array() as $row) {
          $no++;
          $idsales = $row['inventory_id'];
          $idmaterial = $row['material_id'];
          $jml = $this->db->query("SELECT sum(inventory_stock_qty) as stock_qty, mst_material.*, trx_inventory.* from trx_inventory inner join mst_material on trx_inventory.material_id = mst_material.material_id 
            where trx_inventory.material_id = '".$idmaterial."' and inventory_item_categories = 'material' and inventory_categories = 'stock' and inventory_id <= '".$idsales."'")->row();
          $tgl = date("m/d/Y", strtotime($row['inventory_date_transaction']));
          $ttl_qty = $jml->stock_qty;
          $awal = $ttl_qty - $row['inventory_stock_qty'];
          //$idsales = $row['inventory_id'];
          //$ttl_qty += $row['stock_qty'];
          //$awal = $ttl_qty - $row['stock_qty'];
          if($row['material_minimal_stock'] <= $ttl_qty){
            $strDataAction = 'CUKUP';
            //$strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Hapus</button>&nbsp;<button type='button' class='btn btn-xs btn-info' onclick='detailShow($idsales)'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Detail</button>";
          } else{
            $strDataAction = 'KURANG';        
            // $strDataAction = "<button type='button' disabled class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>&nbsp;<button type='button' disabled class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
            //$strDataAction = "<button type='button' class='btn btn-xs btn-info' onclick='detailShow($idsales)'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Detail</button>";
          }
            $arrSelectQueryDetGd[] = array('idx'    => $row['inventory_id'],
                                      'kode'      => $row['material_code'],                                      
                                      'nama'      => $row['material_name'],
                                      'date'      => $tgl,
                                      'qty'       => $row['inventory_stock_qty'],
                                      'ttl_qty'   => $ttl_qty,
                                      'awal'      => $awal,
                                      'no'      => $no, 
                                      'status'    => $row['inventory_jenis'],
                                      'wh'        => $row['warehouse_id'],
                                      'categories'=> $row['inventory_categories'],
                                      'idm'       => $row['material_id'],
                                      'item'      => $row['inventory_item_categories'],
                                      'nominal'   => $row['inventory_jumlah_nominal'],
                                      'note'      => $row['inventory_description'],
                                      'action' => $strDataAction);
          }

          return json_encode($arrSelectQueryDetGd);

        }

        function GetDaftarInvDet()
        {
          $this->selectQuery = $this->db->query("SELECT inventory_stock_qty as stock_qty, mst_material.*, trx_inventory.* from trx_inventory inner join mst_material on trx_inventory.material_id = mst_material.material_id 
            where inventory_item_categories = 'product' order by inventory_id desc");
       
          $arrSelectQuery = array();
          $ttl_qty = 0;
          $awal = 0;
          foreach ($this->selectQuery->result_array() as $row) {
          $idsales = $row['inventory_id'];
          $idmaterial = $row['material_id'];
          $jml = $this->db->query("SELECT sum(inventory_stock_qty) as stock_qty, mst_material.*, trx_inventory.* from trx_inventory inner join mst_material on trx_inventory.material_id = mst_material.material_id 
            where trx_inventory.material_id = '".$idmaterial."' and inventory_item_categories = 'product' and inventory_categories = 'stock' and inventory_id <= '".$idsales."'")->row();
          
          $ttl_qty = $jml->stock_qty;
          $awal = $ttl_qty - $row['stock_qty'];
          //$fr = $row['inventory_code']; 
          if($row['inventory_mode'] == 'public'){
            $strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Hapus</button>&nbsp;<button type='button' class='btn btn-xs btn-info' onclick='detailShow($idsales)'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Detail</button>";
          } else{        
            // $strDataAction = "<button type='button' disabled class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>&nbsp;<button type='button' disabled class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
            $strDataAction = "<button type='button' class='btn btn-xs btn-info' onclick='detailShow($idsales)'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Detail</button>";
          }
            $arrSelectQueryDet[] = array('idx'    => $row['inventory_id'],
                                      'kode'      => $row['material_code'],                                      
                                      'nama'      => $row['material_name'],
                                      'date'      => $row['inventory_date_transaction'],
                                      'qty'       => $row['stock_qty'],
                                      'ttl_qty'   => $ttl_qty, 
                                      'awal'   => $awal, 
                                      'status'    => $row['inventory_jenis'],
                                      'action'    => $strDataAction);
          }

          return json_encode($arrSelectQueryDet);

        }

        function GetDaftarInvSm()
        {
          $this->selectQuery = $this->db->query("SELECT sum(inventory_stock_qty) as stock_qty, mst_material.*, trx_inventory.* from trx_inventory inner join mst_material on trx_inventory.material_id = mst_material.material_id 
            where inventory_item_categories = 'material' group by mst_material.material_id order by mst_material.material_id desc");
       
          $arrSelectQuery = array();

          foreach ($this->selectQuery->result_array() as $row) {
          $idsales = $row['inventory_id'];
          //$fr = $row['inventory_code']; 
          if($row['material_minimal_stock'] <= $row['stock_qty']){
            $strDataAction = 'CUKUP';
            //$strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Hapus</button>&nbsp;<button type='button' class='btn btn-xs btn-info' onclick='detailShow($idsales)'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Detail</button>";
          } else{        
            // $strDataAction = "<button type='button' disabled class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>&nbsp;<button type='button' disabled class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
            $strDataAction = 'KURANG';
            //$strDataAction = "<button type='button' class='btn btn-xs btn-info' onclick='detailShow($idsales)'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Detail</button>";
          }
            $arrSelectQuerySM[] = array('idx'    => $row['inventory_id'],
                                      'kode'   => $row['material_code'],                                      
                                      'nama'   => $row['material_name'],
                                      'date'    => $row['inventory_date_transaction'],
                                      'qty'  => $row['stock_qty'], 
                                      'status'    => $row['inventory_categories'],
                                      'action' => $strDataAction);
          }

          return json_encode($arrSelectQuerySM);

        }

        function GetDaftarInvDetSm()
        {
          $this->selectQuery = $this->db->query("SELECT inventory_stock_qty as stock_qty, mst_material.*, trx_inventory.* from trx_inventory inner join mst_material on trx_inventory.material_id = mst_material.material_id 
            where inventory_item_categories = 'material' order by inventory_id desc");
       
          $arrSelectQuery = array();
          $ttl_qty = 0;
          $awal = 0;
          foreach ($this->selectQuery->result_array() as $row) {
          $idsales = $row['inventory_id'];
          $idmaterial = $row['material_id'];
          $jml = $this->db->query("SELECT sum(inventory_stock_qty) as stock_qty, mst_material.*, trx_inventory.* from trx_inventory inner join mst_material on trx_inventory.material_id = mst_material.material_id 
            where trx_inventory.material_id = '".$idmaterial."' and inventory_item_categories = 'material' and inventory_categories = 'stock' and inventory_id <= '".$idsales."'")->row();
          
          $ttl_qty = $jml->stock_qty;
          $awal = $ttl_qty - $row['stock_qty'];
          //$fr = $row['inventory_code']; 
          if($row['inventory_mode'] == 'private'){
            $strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Hapus</button>&nbsp;<button type='button' class='btn btn-xs btn-info' onclick='detailShow($idsales)'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Detail</button>";
          } else{        
            // $strDataAction = "<button type='button' disabled class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>&nbsp;<button type='button' disabled class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
            $strDataAction = "<button type='button' class='btn btn-xs btn-info' onclick='detailShow($idsales)'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Detail</button>";
          }
            $arrSelectQueryDetSM[] = array('idx'    => $row['inventory_id'],
                                      'kode'      => $row['material_code'],                                      
                                      'nama'      => $row['material_name'],
                                      'date'      => $row['inventory_date_transaction'],
                                      'qty'       => $row['stock_qty'],
                                      'ttl_qty'   => $ttl_qty, 
                                      'awal'   => $awal, 
                                      'status'    => $row['inventory_jenis'],
                                      'action'    => $strDataAction);
          }

          return json_encode($arrSelectQueryDetSM);

        }

      
    }


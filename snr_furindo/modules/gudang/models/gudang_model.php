<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

    class gudang_model extends CI_Model{
    	
		  private $selectQuery;
      private $arrMenuData;

      public function __construct() {
          parent::__construct();
      }

      public function GetMenuAdmin()
      {
        
          $this->selectQuery = $this->db->query("SELECT id_modul as IDModul FROM sys_modul WHERE nama_modul='Gudang'");

          $this->arrMenuData = $this->selectQuery->row_array();
          
          $this->IDModulInduk =$this->arrMenuData['IDModul'];

          return getTreeMenuData($this->IDModulInduk, 'sys_modul', 'id_modul', 'id_modul', 'nama_modul');           
      	
      }

      function GetDaftarIssued()
        {
          $this->selectQuery = $this->db->query("SELECT * from trx_issued order by issued_id desc");
       
          $arrSelectQuery = array();

          foreach ($this->selectQuery->result_array() as $row) {
          $idsales = $row['issued_id'];
          $fr = $row['issued_code']; 
          if($row['issued_id'] != '0'){
            $strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Hapus</button>&nbsp;<button type='button' class='btn btn-xs btn-info' onclick='detailShow($idsales)'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Detail</button>";
          } else{        
            // $strDataAction = "<button type='button' disabled class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>&nbsp;<button type='button' disabled class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
            $strDataAction = "<button type='button' class='btn btn-xs btn-info' onclick='detailShow($idsales)'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Detail</button>";
          }
            $arrSelectQuery[] = array('idx'    => $row['issued_id'],
                                      'kode'   => $row['issued_code'],                                      
                                      'nama'   => $row['issued_note'],
                                      'date'    => $row['issued_date'],
                                      //'address'  => $row['provider_address'], 
                                      //'phone'    => $row['provider_phone'],
                                      'action' => $strDataAction);
          }

          return json_encode($arrSelectQuery);

        }

        function GetDaftarAjustment()
        {
          $this->selectQuery = $this->db->query("SELECT * from trx_issued_return inner join trx_inventory on trx_inventory.inventory_id = trx_issued_return.inventory_id
            inner join mst_material on mst_material.material_id = trx_issued_return.material_id order by return_id desc");
       
          $arrSelectQuery = array();
          $no=$this->selectQuery->num_rows();
          foreach ($this->selectQuery->result_array() as $row) {
          $idsales = $row['return_id'];
          $fr = $row['return_code']; 
          if($row['return_id'] != '0'){
            $strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Hapus</button>&nbsp;<button type='button' class='btn btn-xs btn-info' onclick='detailShow($idsales)'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Detail</button>";
          } else{        
            // $strDataAction = "<button type='button' disabled class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>&nbsp;<button type='button' disabled class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
            $strDataAction = "<button type='button' class='btn btn-xs btn-info' onclick='detailShow($idsales)'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Detail</button>";
          }
            $arrSelectQuery[] = array('idx'    => $row['inventory_id'],
                                      'no'   => $no,
                                      'kode'   => $row['return_code'],                                      
                                      'nama'   => $row['material_name'],
                                      'date'    => $row['date'],
                                      'qty'    => $row['qty'],
                                      'group'    => $row['jenis'],
                                      'material'    => $row['material_name'],
                                      'mat_id'    => $row['material_id'],
                                      'jenis'    => $row['inventory_jenis'],
                                      'item'    => $row['inventory_item_categories'],
                                      'categories'    => $row['inventory_categories'],
                                      'note'    => $row['return_note'],
                                      'wh'    => $row['warehouse_id'],
                                      'price'    => $row['inventory_jumlah_nominal'],
                                      //'address'  => $row['provider_address'], 
                                      //'phone'    => $row['provider_phone'],
                                      'action' => $strDataAction);
            $no--;
          }

          return json_encode($arrSelectQuery);

        }


        function GetDetailIssued()
        {
          $this->selectQuery = $this->db->query("SELECT * from trx_issued_detail inner join trx_issued on trx_issued.issued_id = trx_issued_detail.issued_id inner join 
                mst_material on mst_material.material_id = trx_issued_detail.material_id inner join mst_divisi on mst_divisi.divisi_id = trx_issued_detail.divisi_id 
                order by issued_detail_id desc limit 10000");
       
          $arrSelectQuery = array();

          foreach ($this->selectQuery->result_array() as $row) {
            $cek = $this->db->query("SELECT * from trx_sales_order where sales_order_id = '".$row['sales_order_id']."'")->row();
          if ($row['sales_order_id'] != 0) {
            $sales = $cek->sales_order_ref_no;            
          }else {
            $sales = '';
          }
            $arrSelectQuery[] = array('idx'    => $row['issued_detail_id'],
                                      'kode'   => $row['issued_code'],                                      
                                      'nama'   => $row['material_name'],
                                      'date'    => date("m-d-Y", strtotime($row['issued_date'])),
                                      'divisi'  => $row['divisi_code'],
                                      'note'  => $row['issued_detail_note'], 
                                      'sales'  => $sales, 
                                      'qty'    => $row['issued_detail_qty']);
                                      //'action' => $strDataAction);
          }
          

          return json_encode($arrSelectQuery);

        }

      
    }


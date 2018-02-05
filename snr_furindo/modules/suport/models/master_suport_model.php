<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

    class Master_suport_model extends CI_Model{

        public function __construct() {
            parent::__construct();
        }

        function GetDaftarSuport()
        {
          $this->selectQuery = $this->db->query("SELECT * from trx_sales_order  order by sales_order_id desc");
       
          $arrSelectQuery = array();

          foreach ($this->selectQuery->result_array() as $row) {
          $idsales = $row['sales_order_id'];
          $fr = $row['sales_order_ref_no']; 
          if($row['sales_order_status'] == 'draft'){
            $strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Hapus</button>&nbsp;<button type='button' class='btn btn-xs btn-info' onclick='detailShow($idsales)'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Detail</button>";
          } else{        
            // $strDataAction = "<button type='button' disabled class='btn btn-xs btn-warning' onclick='dialogFormEditShow($idsales)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>&nbsp;<button type='button' disabled class='btn btn-xs btn-danger'  onclick='deleteConfirmShow($idsales)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
            $strDataAction = "<button type='button' class='btn btn-xs btn-info' onclick='detailShow($idsales)'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Detail</button>";
          }
            $arrSelectQuery[] = array('idx'    => $row['sales_order_id'],
                                      'kode'   => $row['sales_order_ref_no'],                                      
                                      'nama'   => 'NOIR',
                                      'date'    => $row['sales_order_date'],
                                      'address'  => $row['sales_order_address'], 
                                      'status'    => $row['sales_order_status'],
                                      'action' => $strDataAction);
          }

          return json_encode($arrSelectQuery);

        }

    }

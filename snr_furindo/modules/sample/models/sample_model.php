<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

    class Sample_model extends CI_Model{
    	
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

    function GetDaftarAnggota()
        {
          $this->selectQuery = $this->db->query("SELECT * from mst_kelompok");
       
          $arrSelectQuerysh = array();
          $no=0;
          foreach ($this->selectQuery->result_array() as $row) {
          $no++;          
            //$strDataAction = "<button type='button' class='btn btn-xs btn-info' onclick='detailShow($idsales)'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Detail</button>";
            $strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow()'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow()'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Delete</button>";
            $arrSelectQuerysh[] = array('idx'    => $row['id_kelompok'],
                                        'nama'   => $row['nama_kelompok'],
                                        'pokok'    => $row['simpanan_pokok'],
                                        'wajib'  => $row['simpanan_wajib'], 
                                        'bunga'    => $row['bunga_pinjaman'],
                                        'bunga2'    => $row['bunga_simpanan'],
                                        'denda'    => $row['denda_pinjaman'],
                                        'ket'   => $row['keterangan'],
                                        'action' => $strDataAction);
          }

          return json_encode($arrSelectQuerysh);

        }

    function GetDaftarNasabah()
        {
          $this->selectQuery = $this->db->query("SELECT * from mst_nasabah");
       
          $arrSelectQuerysh = array();
          $no=0;
          foreach ($this->selectQuery->result_array() as $row) {
          $no++;          
            //$strDataAction = "<button type='button' class='btn btn-xs btn-info' onclick='detailShow($idsales)'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Detail</button>";
            $strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow()'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow()'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Delete</button>";
            $arrSelectQuerysh[] = array('idx'    => $row['id_nasabah'],
                                        'kode'   => $row['no_nasabah'],
                                        'nama'   => $row['nama_nasabah'],
                                        'jk'    => $row['jk'],
                                        'alamat'  => $row['alamat'],
                                        'telp'  => $row['telp'], 
                                        'id_kelompok'    => $row['id_kelompok'],
                                        'tgl_masuk'    => $row['tgl_masuk'],
                                        'action' => $strDataAction);
          }

          return json_encode($arrSelectQuerysh);

        }

    function GetDaftarLpb()
        {
          $this->selectQuery = $this->db->query("SELECT * from trx_lpb_sample inner join mst_provider on trx_lpb_sample.provider_id = mst_provider.provider_id  order by lpb_id desc");
       
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

    public function GetDaftarLpbSample()
        {
                     
            $this->selectQuery = $this->db->query("SELECT purchase_order_sample_id, trx_lpb_sample.*, (lpb_detail_price*lpb_detail_qty) as biaya, trx_lpb_sample_detail.*,
              mst_material.*, mst_provider.* from trx_lpb_sample_detail inner join trx_lpb_sample on trx_lpb_sample.lpb_id = trx_lpb_sample_detail.lpb_id
              inner join mst_provider on mst_provider.provider_id = trx_lpb_sample.provider_id inner join mst_material on mst_material.material_id
              = trx_lpb_sample_detail.material_id ");
         
            $arrSelectQuerySK = array();
            
            foreach ($this->selectQuery->result_array() as $row) {
              //$ids = $row['provider_id'];
              $idm = $row['material_id'];
              $idl = $row['purchase_order_sample_id'];
              
              $cek = $this->db->query("SELECT * from trx_purchase_order_sample where purchase_order_sample_id ='".$idl."' AND material_id = '".$idm."'");
              $idpinjam = $row['lpb_id'];              
              $strDataAction = "<button type='button' class='btn btn-xs btn-primary'  onclick='dialogFormPrint($idpinjam)'><span class='glyphicon glyphicon-print' aria-hidden='true'></span> Print</button>&nbsp;<button type='button' class='btn btn-xs btn-success'  onclick='dialogFormDetailShow($idpinjam)'><span class='glyphicon glyphicon-book' aria-hidden='true'></span> Detail</button>";
              if($cek->num_rows() != 0){
                $qty = $cek->row()->qty;
                $code = $cek->row()->purchase_order_sample_code;
                $weight = $row['material_cbm']*$qty;
              }else{
                $qty = '';
                $code = '';
                $weight = '';
              }              
              
              $arrSelectQuerySK[] = array('idx'    => $row['lpb_detail_id'],
                                          'tgl'   => date("m-d-Y", strtotime($row['lpb_date'])),                                   
                                          'nama'   => $row['provider_name'],
                                          'code'   => $row['material_code'],
                                          'mt_name'   => $row['material_name'],
                                          'price'   => rp($row['lpb_detail_price']),
                                          'order'   => $qty,
                                          'po'   => $code,
                                          'qty'   => $row['lpb_detail_qty'],
                                          'nominal' => round($row['biaya'],2),
                                          'lpb' => $row['lpb_code'],
                                          'nota' => $row['lpb_note'],
                                          'cbm' => $row['material_cbm'],
                                          'weight' => $weight,                                      
                                          'action'  => $strDataAction);
            }


          return json_encode($arrSelectQuerySK);

        }

      
    }


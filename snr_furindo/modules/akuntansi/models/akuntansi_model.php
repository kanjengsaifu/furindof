<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

    class Akuntansi_model extends CI_Model{
    	
		  private $selectQuery;
      private $arrMenuData;

      public function __construct() {
          parent::__construct();
      }

      public function GetMenuAkuntansi()
      {
        
          $this->selectQuery = $this->db->query("SELECT id_modul as IDModul FROM sys_modul WHERE nama_modul='Akuntansi'");
          
          $this->arrMenuData = $this->selectQuery->row_array();
          
          $this->IDModulInduk =$this->arrMenuData['IDModul'];

          return getTreeMenuData($this->IDModulInduk, 'sys_modul', 'id_modul', 'id_modul', 'nama_modul');           
      	
      }

      public function GetKodeProgram($IDProgram)
      {

        $this->IDProgram  = $this->security->xss_clean($IDProgram);

        $this->selectQuery = $this->db->query("SELECT kode_program as KodeProgram from mst_program where id_program='".$this->IDProgram."' ");
          
        $this->arrData =  ($this->selectQuery->num_rows() > 0)  ? $this->selectQuery->row_array() : array('KodeProgram' => '');
          
        return $this->arrData['KodeProgram'];
      }

      public function GetDaftarAkun()

        {



          $this->selectQuery = $this->db->query("SELECT * FROM mst_kasbank order by kode_kasbank asc");



          $arrSelectQuery = array();



          foreach ($this->selectQuery->result_array() as $row) {

             $cek = $this->db->query("SELECT id_kasbank from mst_kasbank where id_induk = '".$row['id_kasbank']."'");

            //$strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow()'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow()'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
             $name = $row['nama_kasbank'];
             $nama = str_replace(" ","_",$name);
             $kd = $row['kode_kasbank'];
             $kode = str_replace(" ","_",$kd);
             $id = $row['id_kasbank'];
            if ($row['level'] == 0) {             
              $kode = "<span class='glyphicon glyphicon-home' aria-hidden='true'></span> ".$row['kode_kasbank'];
              $strDataAction ='';
            } else if ($row['level'] == 1) {              
              $kode = "&nbsp;&nbsp;<span class='glyphicon glyphicon-share' aria-hidden='true'></span> ".$row['kode_kasbank'];
              $strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick=PilihPemasukan('$kd','$nama',$id)><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Pilih</button>";
            } else if ($row['level'] == 2) {              
              $kode = "&nbsp;&nbsp;&nbsp;&nbsp;<span class='glyphicon glyphicon-share-alt' aria-hidden='true'></span> ".$row['kode_kasbank'];
            }
            

            $arrSelectQuery[] = array('idx'         => $row['id_kasbank'],
                                      
                                      'kode'        => $kode,

                                      'nama'        => $row['nama_kasbank'],

                                      'norekbank'   => $row['norek_bank'],

                                      'namabank'    => $row['nama_bank'],

                                      'notaktif'    => $row['status'],

                                      'deskripsi'   => $row['deskripsi_kasbank'],

                                      'action'      => $strDataAction

                                      );

          }



          return json_encode($arrSelectQuery);



        }

        public function GetDaftarAkuntansi()
        {
                     
            $this->selectQuery = $this->db->query("SELECT * from trx_jurnal where nobukti like '%PS%' group by nobukti");
         
            $arrSelectQuery = array();

            foreach ($this->selectQuery->result_array() as $row) {
              $idpinjam = $row['id_jurnal'];              
              $strDataAction = "<button type='button' class='btn btn-xs btn-primary'  onclick='dialogFormPrint($idpinjam)'><span class='glyphicon glyphicon-print' aria-hidden='true'></span> Print</button>&nbsp;<button type='button' class='btn btn-xs btn-success'  onclick='dialogFormDetailShow($idpinjam)'><span class='glyphicon glyphicon-book' aria-hidden='true'></span> Detail</button>";

              $arrSelectQuery[] = array('idx'    => $row['id_jurnal'],
                                        'tgl'   => date("d-m-Y", strtotime($row['tgl'])),                                   
                                        'nomor'   => $row['nobukti'],
                                        'uraian'   => $row['memo'],
                                        'nominal' => rp($row['nominal']),                                      
                                        'action'  => $strDataAction);
            }


          return json_encode($arrSelectQuery);

        }
      
      public function GetDaftarLpbSm()
        {
                     
            $this->selectQuery = $this->db->query("SELECT purchase_order_liquid_id, trx_lpb_liquid.*, (lpb_liquid_detail_price*lpb_liquid_detail_qty) as biaya, trx_lpb_liquid_detail.*,
              mst_material.*, mst_provider.* from trx_lpb_liquid_detail inner join trx_lpb_liquid on trx_lpb_liquid.lpb_liquid_id = trx_lpb_liquid_detail.lpb_liquid_id
              inner join mst_provider on mst_provider.provider_id = trx_lpb_liquid.provider_id inner join mst_material on mst_material.material_id
              = trx_lpb_liquid_detail.material_id order by lpb_liquid_detail_id desc ");
         
            $arrSelectQuerySK = array();
            
            foreach ($this->selectQuery->result_array() as $row) {
              //$ids = $row['provider_id'];
              $idm = $row['material_id'];
              $idl = $row['purchase_order_liquid_id'];
              
              $cek = $this->db->query("SELECT * from trx_purchase_order_liquid inner join trx_purchase_order_liquid_detail on trx_purchase_order_liquid.purchase_order_liquid_id =
                trx_purchase_order_liquid_detail.purchase_order_liquid_id where trx_purchase_order_liquid.purchase_order_liquid_id ='".$idl."' AND material_id = '".$idm."'");
              $idpinjam = $row['lpb_liquid_id'];              
              $strDataAction = "<button type='button' class='btn btn-xs btn-primary'  onclick='dialogFormPrint($idpinjam)'><span class='glyphicon glyphicon-print' aria-hidden='true'></span> Print</button>&nbsp;<button type='button' class='btn btn-xs btn-success'  onclick='dialogFormDetailShow($idpinjam)'><span class='glyphicon glyphicon-book' aria-hidden='true'></span> Detail</button>";
              if($cek->num_rows() != 0){
                $qty = $cek->row()->purchase_order_liquid_detail_qty;
                $code = $cek->row()->purchase_order_liquid_code;
              }else{
                $qty = '';
                $code = '';
              }              
              
              $arrSelectQuerySK[] = array('idx'    => $row['lpb_liquid_detail_id'],
                                          'tgl'   => date("m-d-Y", strtotime($row['lpb_liquid_date'])),                                   
                                          'nama'   => $row['provider_name'],
                                          'code'   => $row['material_code'],
                                          'mt_name'   => $row['material_name'],
                                          'price'   => rp($row['lpb_liquid_detail_price']),
                                          'order'   => $qty,
                                          'po'   => $code,
                                          'qty'   => $row['lpb_liquid_detail_qty'],
                                          'nominal' => round($row['biaya'],2),
                                          'lpb' => $row['lpb_liquid_code'],
                                          'nota' => $row['lpb_liquid_note'],                                      
                                          'action'  => $strDataAction);
            }


          return json_encode($arrSelectQuerySK);

        }

        public function GetDaftarLpbRaw()
        {
                     
            $this->selectQuery = $this->db->query("SELECT purchase_order_id, trx_lpb.*, (lpb_detail_price*lpb_detail_qty) as biaya, trx_lpb_detail.*,
              mst_material.*, mst_provider.* from trx_lpb_detail inner join trx_lpb on trx_lpb.lpb_id = trx_lpb_detail.lpb_id
              inner join mst_provider on mst_provider.provider_id = trx_lpb.provider_id inner join mst_material on mst_material.material_id
              = trx_lpb_detail.material_id ");
         
            $arrSelectQuerySK = array();
            
            foreach ($this->selectQuery->result_array() as $row) {
              //$ids = $row['provider_id'];
              $idm = $row['material_id'];
              $idl = $row['purchase_order_id'];
              
              $cek = $this->db->query("SELECT * from trx_purchase_order inner join trx_purchase_order_detail on trx_purchase_order.purchase_order_id =
                trx_purchase_order_detail.purchase_order_id where trx_purchase_order.purchase_order_id ='".$idl."' AND material_id = '".$idm."'");
              $idpinjam = $row['lpb_id'];              
              $strDataAction = "<button type='button' class='btn btn-xs btn-primary'  onclick='dialogFormPrint($idpinjam)'><span class='glyphicon glyphicon-print' aria-hidden='true'></span> Print</button>&nbsp;<button type='button' class='btn btn-xs btn-success'  onclick='dialogFormDetailShow($idpinjam)'><span class='glyphicon glyphicon-book' aria-hidden='true'></span> Detail</button>";
              if($cek->num_rows() != 0){
                $qty = $cek->row()->purchase_order_detail_qty;
                $code = $cek->row()->purchase_order_code;
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

        public function GetDaftarKasHutang()

        {



          $this->selectQuery = $this->db->query("SELECT * FROM mst_kasbank where deskripsi_kasbank = 'HUTANG'  order by kode_kasbank asc");



          $arrSelectQuery = array();



          foreach ($this->selectQuery->result_array() as $row) {

             $cek = $this->db->query("SELECT id_kasbank from mst_kasbank where id_induk = '".$row['id_kasbank']."'");

             //$strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow()'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow()'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
             $name = $row['nama_kasbank'];
             $nama = str_replace(" ","_",$name);
             $kd = $row['kode_kasbank'];
             $kode = str_replace(" ","_",$kd);
             $id = $row['id_kasbank'];
            if ($row['level'] == 0) {             
              $kode = "<span class='glyphicon glyphicon-home' aria-hidden='true'></span> ".$row['kode_kasbank'];
              $strDataAction ='';
            } else if ($row['level'] == 1) {              
              $kode = "&nbsp;&nbsp;<span class='glyphicon glyphicon-share' aria-hidden='true'></span> ".$row['kode_kasbank'];
              $strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick=PilihPemasukan('$kd','$nama',$id)><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Pilih</button>";
            } else if ($row['level'] == 2) {              
              $kode = "&nbsp;&nbsp;&nbsp;&nbsp;<span class='glyphicon glyphicon-share-alt' aria-hidden='true'></span> ".$row['kode_kasbank'];
            }

            $arrSelectQuery[] = array('idx'         => $row['id_kasbank'],
                                      
                                      'kode'        => $kode,

                                      'nama'        => $row['nama_kasbank'],

                                      'norekbank'   => $row['norek_bank'],

                                      'namabank'    => $row['nama_bank'],

                                      'notaktif'    => $row['status'],

                                      'deskripsi'   => $row['deskripsi_kasbank'],

                                      'action'      => $strDataAction

                                      );

          }
          return json_encode($arrSelectQuery);
        }

         public function GetDaftarHutang()
        {
                     
            $this->selectQuery = $this->db->query("SELECT sum(nominal) as nominal3, trx_jurnal.*, mst_provider.* from trx_jurnal left join mst_provider on mst_provider.provider_id = trx_jurnal.provider_id where id_kategori = 1 and akun = '22001' group by trx_jurnal.provider_id ");
         
            $arrSelectQuery = array();

            foreach ($this->selectQuery->result_array() as $row) {
              $cek = $this->db->query("SELECT sum(nominal) as nominal2 from trx_jurnal where id_kategori = 1 and akun = '13001' and  provider_id = '".$row['provider_id']."'")->row();
              $idpinjam = $row['provider_id'];
              if($row['provider_categories_id'] == 1){              
                $strDataAction = "<button type='button' class='btn btn-xs btn-info'  onclick='Detail($idpinjam)'><span class='glyphicon glyphicon-usd' aria-hidden='true'>Details</span></button>&nbsp;<button type='button' class='btn btn-xs btn-success'  onclick='Deposit($idpinjam)'><span class='glyphicon glyphicon-book' aria-hidden='true'></span> Deposit</button>";
              }elseif ($row['provider_categories_id'] == 5){
                $strDataAction = "<button type='button' class='btn btn-xs btn-info'  onclick='DetailJasa($idpinjam)'><span class='glyphicon glyphicon-usd' aria-hidden='true'>Details</span></button>&nbsp;<button type='button' class='btn btn-xs btn-success'  onclick='Deposit($idpinjam)'><span class='glyphicon glyphicon-book' aria-hidden='true'></span> Deposit</button>";
              }else{
                $strDataAction = "<button type='button' class='btn btn-xs btn-info'  onclick='DetailSM($idpinjam)'><span class='glyphicon glyphicon-usd' aria-hidden='true'>Details</span></button>&nbsp;<button type='button' class='btn btn-xs btn-success'  onclick='Deposit($idpinjam)'><span class='glyphicon glyphicon-book' aria-hidden='true'></span> Deposit</button>";
              }
              $arrSelectQuery[] = array('idx'    => $row['id_jurnal'],
                                        'tgl'   => date("d-m-Y", strtotime($row['tgl'])),                                   
                                        'nomor'   => $row['nobukti'],
                                        'uraian'   => $row['provider_name'],
                                        'nominal' => number_format($row['nominal3']),
                                        'nominal2' => number_format($cek->nominal2),                                      
                                        'action'  => $strDataAction);
            }
          return json_encode($arrSelectQuery);
        }

        public function GetDaftarDetail()
        {
                     
            $this->selectQuery = $this->db->query("SELECT trx_jurnal.*, mst_provider.* from trx_jurnal left join mst_provider on mst_provider.provider_id = trx_jurnal.provider_id where id_kategori = 1 and (akun = '22001' OR akun = '13001')");
         
            $arrSelectQuery = array();

            foreach ($this->selectQuery->result_array() as $row) {
              $cek = $this->db->query("SELECT sum(nominal) as nominal2 from trx_jurnal where akun = '13001' and  id_jurnal = '".$row['id_jurnal']."'")->row();
              $idpinjam = $row['provider_id'];              
              $strDataAction = "<button type='button' class='btn btn-xs btn-primary'  onclick='tambahBaru($idpinjam)'><span class='glyphicon glyphicon-usd' aria-hidden='true'>BY</span></button>&nbsp;<button type='button' class='btn btn-xs btn-success'  onclick='vendor($idpinjam)'><span class='glyphicon glyphicon-book' aria-hidden='true'></span> DP</button>";
              if ($row['akun'] == '13001') {                
                $nominal = 0;
                $nominal1 = $cek->nominal2;
              } else{
                $nominal = $row['nominal'];
                $nominal1 = 0;
              }
              $arrSelectQuery[] = array('idx'    => $row['id_jurnal'],
                                        'tgl'   => date("m-d-Y", strtotime($row['tgl'])),                                   
                                        'nomor'   => $row['nobukti'],
                                        'uraian'   => $row['provider_name'],
                                        'nominal' => $nominal,
                                        'nominal2' => $nominal1,                                      
                                        'action'  => $strDataAction);
            }
          return json_encode($arrSelectQuery);
        }

    }


<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

    class Transaksi_model extends CI_Model{
    	
		  private $selectQuery;
      private $arrMenuData;

      public function __construct() {
          parent::__construct();
      }

      public function GetMenuTransaksi()
      {
        
          $this->selectQuery = $this->db->query("SELECT id_modul as IDModul FROM sys_modul WHERE nama_modul='Transaksi'");
          
          $this->arrMenuData = $this->selectQuery->row_array();
          
          $this->IDModulInduk =$this->arrMenuData['IDModul'];

          return getTreeMenuData($this->IDModulInduk, 'sys_modul', 'id_modul', 'id_modul', 'nama_modul');           
      	
      }

      public function GetDaftarPinjaman()
        {
          $this->selectQuery = $this->db->query("SELECT mst_ksm.*, trx_pinjaman.* from trx_pinjaman
          inner join mst_ksm on trx_pinjaman.id_ksm = mst_ksm.id_ksm
          inner join trx_pinjaman_det on trx_pinjaman.id_pinjaman = trx_pinjaman_det.id_pinjaman order by kode_ksm desc ");
       
          $arrSelectQuery = array();

          foreach ($this->selectQuery->result_array() as $row) {
            $idpinjam = $row['id_pinjaman'];
            $num = $this->db->query("SELECT sum(nominal) as nominal from trx_pinjaman_det where id_pinjaman = '".$row['id_pinjaman']."'")->row();
            $strDataAction = "<button type='button' class='btn btn-xs btn-success'  onclick='dialogFormDetailShow($idpinjam)'><span class='glyphicon glyphicon-book' aria-hidden='true'></span> Detail</button>";

            $arrSelectQuery[] = array('idx'    => $row['id_pinjaman'],
                                      'kode'   => $row['kode_pinjaman'],                                      
                                      'nama'   => $row['nama_ksm'],
                                      'lama'   => $row['lama'],
                                      'bunga' => $row['bunga'],
                                      'nominal' => rp($num->nominal),                                        
                                      'action'  => $strDataAction);
          }

          return json_encode($arrSelectQuery);

        }

        public function GetDaftarSimpanan()
        {
          $this->selectQuery = $this->db->query("SELECT mst_ksm.*, trx_simpanan.* from trx_simpanan
          inner join mst_ksm on trx_simpanan.id_ksm = mst_ksm.id_ksm
          inner join trx_simpanan_det on trx_simpanan.id_simpanan = trx_simpanan_det.id_simpanan order by kode_ksm desc ");
       
          $arrSelectQuery = array();

          foreach ($this->selectQuery->result_array() as $row) {
            $idsimpanan = $row['id_simpanan'];
            $num = $this->db->query("SELECT sum(nominal) as nominal from trx_simpanan_det where id_simpanan = '".$row['id_simpanan']."'")->row();
            //$cek = $this->db->query("SELECT * from trx_simpanan_det where id_simpanan '".$idsimpanan."'");
            $cek=1;
            if ($cek==0) {
              $strDataAction = "<button type='button' class='btn btn-xs btn-primary'  onclick='dialogFormBayarShow($idsimpanan)'><span class='glyphicon glyphicon-book' aria-hidden='true'></span> Saimpanan Pokok</button>"; 
            }else {
              $strDataAction = "<button type='button' class='btn btn-xs btn-success'  onclick='dialogFormDetailShow($idsimpanan)'><span class='glyphicon glyphicon-book' aria-hidden='true'></span> Detail</button>";
            }
            $arrSelectQuery[] = array('idx'    => $row['id_simpanan'],
                                      'kode'   => $row['kode_simpanan'],                                      
                                      'nama'   => $row['nama_ksm'],                                      
                                      'nominal' => rp($num->nominal),                                        
                                      'action'  => $strDataAction);
          }

          return json_encode($arrSelectQuery);

        }


        public function GetDaftarAngsuran()
        {
                     
            $this->selectQuery = $this->db->query("SELECT mst_ksm.*, trx_pinjaman.* from trx_pinjaman
            inner join mst_ksm on trx_pinjaman.id_ksm = mst_ksm.id_ksm
            inner join trx_pinjaman_det on trx_pinjaman.id_pinjaman = trx_pinjaman_det.id_pinjaman order by kode_ksm desc ");
         
            $arrSelectQuery = array();

            foreach ($this->selectQuery->result_array() as $row) {
              $idpinjam = $row['id_pinjaman'];
              $num = $this->db->query("SELECT sum(nominal) as nominal from trx_pinjaman_det where id_pinjaman = '".$row['id_pinjaman']."'")->row();
              $strDataAction = "<button type='button' class='btn btn-xs btn-primary'  onclick='dialogFormBayar($idpinjam)'><span class='glyphicon glyphicon-book' aria-hidden='true'></span> Bayar</button>&nbsp;<button type='button' class='btn btn-xs btn-success'  onclick='dialogFormDetailShow($idpinjam)'><span class='glyphicon glyphicon-book' aria-hidden='true'></span> Detail</button>";

              $arrSelectQuery[] = array('idx'    => $row['id_pinjaman'],
                                        'kode'   => $row['kode_pinjaman'],                                      
                                        'nama'   => $row['nama_ksm'],
                                        'lama'   => $row['lama'],
                                        'bunga'  => $row['bunga'],
                                        'nominal' => rp($num->nominal),                                      
                                        'action'  => $strDataAction);
            }


          return json_encode($arrSelectQuery);

        }

        public function ChangeDaftarKontak($tipe= null)

        {
          //echo "<pre>";print_r($tipe);"</pre>";
          
          if ($tipe != null) {
            $this->selectQuery = $this->db->query("SELECT * from mst_provider where provider_categories_id = 4 ORDER BY provider_id asc");
          }else{
            $this->selectQuery = $this->db->query("SELECT * from mst_provider where provider_categories_id != 4 ORDER BY provider_id asc");
          }

          $arrSelectQuery = array();

          foreach ($this->selectQuery->result_array() as $row) {
            $id = $row['provider_id'];
            $name = $row['provider_name'];
            $nama = str_replace(" ","_",$name);
            $strDataAction = "<button type='button' class='btn btn-xs btn-success' onclick=dialogFormPilih('$nama',$id)><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Pilih</button>";


            $arrSelectQuery[] = array('idx'   => $row['provider_id'],
                                      'kode'  => $row['provider_code'],
                                      'nama'  => $row['provider_name'],
                                      'alamat'=> $row['provider_address'],  
                                      'notelp'=> $row['provider_phone'], 
                                      'pic'   => $row['provider_contact_person'],
                                      'action'=> $strDataAction

                                      );

          }


          //echo "<pre>";print_r($this->selectQuery);"</pre>";
          return json_encode($arrSelectQuery);



        }

        public function ChangeDaftarKontak1($tipe= null)

        {
          //echo "<pre>";print_r($tipe);"</pre>";
          
          if ($tipe != null) {
            $this->selectQuery = $this->db->query("SELECT * from mst_provider where provider_categories_id = 4 ORDER BY provider_id asc");
          }else{
            $this->selectQuery = $this->db->query("SELECT * from mst_provider where provider_categories_id = 4 ORDER BY provider_id asc");
          }

          $arrSelectQuery = array();

          foreach ($this->selectQuery->result_array() as $row) {
            $id = $row['provider_id'];
            $name = $row['provider_name'];
            $nama = str_replace(" ","_",$name);
            $strDataAction = "<button type='button' class='btn btn-xs btn-success' onclick=dialogFormPilih('$nama',$id)><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Pilih</button>";


            $arrSelectQuery[] = array('idx'   => $row['provider_id'],
                                      'kode'  => $row['provider_code'],
                                      'nama'  => $row['provider_name'],
                                      'alamat'=> $row['provider_address'],  
                                      'notelp'=> $row['provider_phone'], 
                                      'pic'   => $row['provider_contact_person'],
                                      'action'=> $strDataAction

                                      );

          }


          //echo "<pre>";print_r($this->selectQuery);"</pre>";
          return json_encode($arrSelectQuery);



        }

        public function GetDaftarKasBank()

        {



          $this->selectQuery = $this->db->query("SELECT * FROM mst_kasbank order by kode_kasbank asc");



          $arrSelectQuery = array();



          foreach ($this->selectQuery->result_array() as $row) {

             $cek = $this->db->query("SELECT id_kasbank from mst_kasbank where id_induk = '".$row['id_kasbank']."'");

            //$strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow()'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow()'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
             $name = $row['nama_kasbank'];
             $nama = str_replace(" ","_",$name);
             $id = $row['id_kasbank'];
             $bank = $row['kode_kasbank'];
            if ($row['level'] == 0) {             
              $kode = "<span class='glyphicon glyphicon-home' aria-hidden='true'></span> ".$row['kode_kasbank'];
              $strDataAction ='';
            } else if ($row['level'] == 1) {              
              $kode = "&nbsp;&nbsp;<span class='glyphicon glyphicon-share' aria-hidden='true'></span> ".$row['kode_kasbank'];
              $strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick=pilihKasbank('$nama',$id,'$bank')><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Pilih</button>";
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

        public function GetDaftarPemasukan()

        {

          $this->selectQuery = $this->db->query("SELECT id_kasbank as ID, kode_kasbank as kode, nama_kasbank as nama, level as level   

                                                 FROM mst_kasbank                                                     

                                                 ORDER BY kode_kasbank asc");



          $arrSelectQuery = array();



          foreach ($this->selectQuery->result_array() as $row) {

            $cek = $this->db->query("SELECT id_pemasukan from mst_pemasukan where id_induk = '".$row['ID']."'");

            //$strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow()'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow()'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
             $name = $row['nama'];
             $nama = str_replace(" ","_",$name);
             $kd = $row['kode'];
             $kode = str_replace(" ","_",$kd);
             $id = $row['ID'];
            if ($row['level'] == 0) {               
              $kode = "<span class='glyphicon glyphicon-home' aria-hidden='true'></span> ".$row['kode'];
              $strDataAction = "";
            } else if ($row['level'] == 1) {
              $kode = "&nbsp;&nbsp;<span class='glyphicon glyphicon-share' aria-hidden='true'></span> ".$row['kode'];              
              if ($cek->num_rows() != 0) {
                $strDataAction = "";
              }else{
                $strDataAction = "<button type='button' class='btn btn-xs btn-success' onclick=PilihPemasukan('$kd',$id,'$nama')><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Pilih</button>";
              }
            } else if ($row['level'] == 2) {
              $kode = "&nbsp;&nbsp;&nbsp;&nbsp;<span class='glyphicon glyphicon-share-alt' aria-hidden='true'></span> ".$row['kode'];
              if ($cek->num_rows() != 0) {
                $strDataAction = "";
              }else{
                $strDataAction = "<button type='button' class='btn btn-xs btn-success' onclick=PilihPemasukan('$kd','$nama',$id)><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Pilih</button>";
              }
            }
            

            $arrSelectQuery[] = array('idx'        =>  $row['ID'],

                                       'kode'      =>  $kode,

                                       'nama'      =>  $row['nama'], 

                                       'action'    =>  $strDataAction

                                      );

          }



          return json_encode($arrSelectQuery);



        }

        public function GetDaftarPengeluaran()

        {

          $this->selectQuery = $this->db->query("SELECT id_kasbank as ID, kode_kasbank as kode, nama_kasbank as nama, level as level   

                                                 FROM mst_kasbank                                                    

                                                 ORDER BY kode_kasbank asc");



          $arrSelectQuery = array();



          foreach ($this->selectQuery->result_array() as $row) {

            $cek = $this->db->query("SELECT id_pengeluaran from mst_pengeluaran where id_induk = '".$row['ID']."'");

            //$strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow()'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow()'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
             $name = $row['nama'];
             $nama = str_replace(" ","_",$name);
             $kd = $row['kode'];
             $kode = str_replace(" ","_",$kd);
             $id = $row['ID'];
            if ($row['level'] == 0) {             
              $kode = "<span class='glyphicon glyphicon-home' aria-hidden='true'></span> ".$row['kode'];
              $strDataAction = "";
            } else if ($row['level'] == 1) {
              $kode = "&nbsp;&nbsp;<span class='glyphicon glyphicon-share' aria-hidden='true'></span> ".$row['kode'];
              if ($cek->num_rows() != 0) {
                $strDataAction = "";
              }else{
                $strDataAction = "<button type='button' class='btn btn-xs btn-success' onclick=PilihPemasukan('$kd','$nama',$id)><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Pilih</button>";
              }
            } else if ($row['level'] == 2) {
              $kode = "&nbsp;&nbsp;&nbsp;&nbsp;<span class='glyphicon glyphicon-share-alt' aria-hidden='true'></span> ".$row['kode'];
              if ($cek->num_rows() != 0) {
                $strDataAction = "";
              }else{
                $strDataAction = "<button type='button' class='btn btn-xs btn-success' onclick=PilihPemasukan('$kd','$nama',$id)><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Pilih</button>";
              }
            }
            

            $arrSelectQuery[] = array('idx'        =>  $row['ID'],

                                       'kode'      =>  $kode,

                                       'nama'      =>  $row['nama'], 

                                       'action'    =>  $strDataAction

                                      );

          }



          return json_encode($arrSelectQuery);

        }

        public function GetDaftarBkk()
        {
                     
            $this->selectQuery = $this->db->query("SELECT * from trx_jurnal where id_kategori = 1 AND nobukti like '%BKK%' group by nobukti desc ");
         
            $arrSelectQuery = array();

            foreach ($this->selectQuery->result_array() as $row) {
              $idpinjam = $row['id_jurnal'];              
              $strDataAction = "<button type='button' class='btn btn-xs btn-primary'  onclick='dialogFormPrint($idpinjam)'><span class='glyphicon glyphicon-print' aria-hidden='true'></span> Print</button>&nbsp;<button type='button' class='btn btn-xs btn-warning'  onclick='EditData($idpinjam)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</button>";

              $arrSelectQuery[] = array('idx'    => $row['id_jurnal'],
                                        'tgl'   => date("d-m-Y", strtotime($row['tgl'])),                                   
                                        'nomor'   => $row['nobukti'],
                                        'uraian'   => $row['memo'],
                                        'akun'   => $row['akun'],
                                        'nominal' => rp($row['nominal']*-1),                                      
                                        'action'  => $strDataAction);
            }


          return json_encode($arrSelectQuery);

        }

        public function GetDaftarBkm()
        {
                     
            $this->selectQuery = $this->db->query("SELECT * from trx_jurnal where id_kategori = 1 AND nobukti like '%BKM%' group by nobukti desc ");
         
            $arrSelectQuery = array();

            foreach ($this->selectQuery->result_array() as $row) {
              $idpinjam = $row['id_jurnal'];              
              $strDataAction = "<button type='button' class='btn btn-xs btn-primary'  onclick='dialogFormPrint($idpinjam)'><span class='glyphicon glyphicon-print' aria-hidden='true'></span> Print</button>&nbsp;<button type='button' class='btn btn-xs btn-warning'  onclick='EditData($idpinjam)'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</button>";

              $arrSelectQuery[] = array('idx'    => $row['id_jurnal'],
                                        'tgl'   => date("d-m-Y", strtotime($row['tgl'])),                                   
                                        'nomor'   => $row['nobukti'],
                                        'uraian'   => $row['memo'],
                                        'akun'   => $row['akun'],
                                        'nominal' => rp($row['nominal']),                                      
                                        'action'  => $strDataAction);
            }


          return json_encode($arrSelectQuery);

        }

      
    }
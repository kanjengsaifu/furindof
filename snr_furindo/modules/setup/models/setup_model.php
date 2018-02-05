<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

    class Setup_model extends CI_Model{

    	private $IDUser;
		private $qryGetMenuSetup;
		private $arrMenuData;
        private $IDModulInduk;

        public function __construct() {
            parent::__construct();
        } 

        public function GetMenuSetup()
        {
            
            $this->qryGetMenuSetup = $this->db->query("SELECT id_modul as IDModul FROM sys_modul WHERE nama_modul='Setup'");

            $this->arrMenuData = $this->qryGetMenuSetup->row_array();
            
            $this->IDModulInduk =$this->arrMenuData['IDModul'];

            return getTreeMenuData($this->IDModulInduk, 'sys_modul', 'id_modul', 'id_modul', 'nama_modul');
        	
        }

        public function GetPemdaDanPejabat()
        {
            $this->selectQuery = $this->db->query("select jenis_wilayah_daerah as JenisWilayahDaerah, 
                                                   jenis_kepala_daerah JenisKepalaDaerah,
                                                   wilayah_daerah as WilayahDaerah, nama_kepala_daerah as NamaKepalaDaerah,
                                                   nip_kepala_daerah as NIPKepalaDaerah, nama_sekertaris_Daerah as NamaSekertarisDaerah,
                                                   nip_sekertaris_daerah as NIPSekertarisDaerah, nama_pejabat_pengelola_keuangan_daerah as NamaPejabatPPKD,
                                                   nip_pejabat_pengelola_keuangan_daerah as NIPPPKD, nama_kepala_dinas as NamaKepalaDinas, 
                                                   nip_kepala_dinas as NIPKepalaDinas 
                                                   from ref_pemerintahan_daerah");
            return $this->selectQuery->row_array(); 
        }   

        public function GetUnitKerja()
        {
            $this->selectQuery = $this->db->query("select kode_unit_kerja as KodeUnitKerja, nama_unit_kerja as NamaUnitKerja,
                                                    telepon as Telepon, fax as Fax, email as Email, website as WebSite, 
                                                    alamat as Alamat, kodepos as KodePos, npwp as NPWP,
                                                    nama_pimpinan as NamaPimpinan, nip as NIP   
                                                    from mst_unit_kerja");
            return $this->selectQuery->row_array();
        }

        // pemerintahan daerah
        function addPemda($data)
        {
            $this->db->insert('ref_pemerintahan_daerah',$data);
        }
        
        function updatePemda($data,$noId)
        {
            $this->db->where('id_pemerintahan_daerah', $noId);
            $this->db->update('ref_pemerintahan_daerah', $data); 
        }
            
        // pemerintahan daerah
        function adduntikerja($data)
        {
            $this->db->insert('mst_unit_kerja',$data);
        }
        
        function updateUnitkerja($data,$noId)
        {
            $this->db->where('id_unit_kerja', $noId);
            $this->db->update('mst_unit_kerja', $data); 
        }

        public function GetDaftarKasBank()

        {



          $this->selectQuery = $this->db->query("SELECT * FROM mst_kasbank order by kode_kasbank asc ");



          $arrSelectQuery = array();



          foreach ($this->selectQuery->result_array() as $row) {

             $cek = $this->db->query("SELECT id_kasbank from mst_kasbank where id_induk = '".$row['id_kasbank']."'");

            //$strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow()'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow()'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";

            if ($row['level'] == 0) { 
              if ($cek->num_rows() == 0) {
                $strDataAction = "<button type='button' class='btn btn-xs btn-success' onclick='dialogFormTambahShow()'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span></button>&nbsp;<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow()'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow()'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
              } else{
                $strDataAction = "<button type='button' class='btn btn-xs btn-success' onclick='dialogFormTambahShow()'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span></button>&nbsp;<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow()'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>";            
              }
              $kode = "<span class='glyphicon glyphicon-home' aria-hidden='true'></span> ".$row['kode_kasbank'];
            } else if ($row['level'] == 1) {
              if ($cek->num_rows() == 0) {
                $strDataAction = "</button>&nbsp;<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow()'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow()'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
              } else{
                $strDataAction = "<button type='button' class='btn btn-xs btn-success' onclick='dialogFormTambahShow()'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span></button>&nbsp;<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow()'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>";            
              }
              $kode = "&nbsp;&nbsp;<span class='glyphicon glyphicon-share' aria-hidden='true'></span> ".$row['kode_kasbank'];
            } else if ($row['level'] == 2) {
              if ($cek->num_rows() == 0) {
                $strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow()'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow()'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
              } else{
                $strDataAction = "<button type='button' class='btn btn-xs btn-success' onclick='dialogFormTambahShow()'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span></button>&nbsp;<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow()'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>";            
              }
              $kode = "&nbsp;&nbsp;&nbsp;&nbsp;<span class='glyphicon glyphicon-share-alt' aria-hidden='true'></span> ".$row['kode_kasbank'];
            }

            $arrSelectQuery[] = array('idx'         => $row['id_kasbank'],
                                      
                                      'kode'        => $kode,

                                      'kode2'        => $row['kode_kasbank'],

                                      'nama'        => $row['nama_kasbank'],

                                      'notaktif'    => $row['status'],

                                      'deskripsi'   => $row['deskripsi_kasbank'],

                                      'action'      => $strDataAction

                                      );

          }



          return json_encode($arrSelectQuery);



        }

        public function TambahKasBank($dataKasBank)

        {

          //echo "<pre>".$dataKasBank."</pre>";exit();
          $this->kode = $this->security->xss_clean($dataKasBank['kode_kasbank']);         
       
          $data['kode_kasbank'] = $this->security->xss_clean($dataKasBank['kode_kasbank']);
          $data['nama_kasbank'] = $this->security->xss_clean($dataKasBank['nama_kasbank']);
          $data['nama_bank'] = $this->security->xss_clean($dataKasBank['nama_kasbank']);
          $data['deskripsi_kasbank'] = $dataKasBank['deskripsi_kasbank'];
          $data['id_induk'] = $dataKasBank['induk'];
          $data['status'] = $dataKasBank['status'];
          $data['level'] = 1;
          //cek kode yang sama

          $this->selectQuery = $this->db->query("select id_kasbank from mst_kasbank where kode_kasbank = '".$this->kode."'");

          if ($this->selectQuery->num_rows() > 0)

          {

              $strMessage  = 'Kode kas bank sudah tercatat, silahkan gunakan kode KasBank yang lain';

              $messageData = ConstructMessageResponse($strMessage , 'danger');



              echo $messageData;



              exit;

          }

          $this->db->insert("mst_kasbank", $data);

          
          $strMessage  = 'Tambah kas bank telah berhasil';

          $messageData = ConstructMessageResponse($strMessage , 'info');



          echo $messageData."<script>alert('".$strMessage."');window.resetForm();dialogFormBaruClose();</script>";

        }





        public function UbahKasBank($dataKasBank)

        {
          $id = $this->security->xss_clean($dataKasBank['idx']);
          $data['kode_kasbank'] = $this->security->xss_clean($dataKasBank['kode']);
          $data['nama_kasbank'] = $this->security->xss_clean($dataKasBank['nama']);
          $data['deskripsi_kasbank'] = $dataKasBank['deskripsi'];
          $data['status'] = $dataKasBank['notAktif'];

          $this->db->where('id_kasbank',$id);
          $this->db->update("mst_kasbank", $data);   

          $strMessage  = 'Ubah kas bank telah berhasil';

          $messageData = ConstructMessageResponse($strMessage , 'info');



          echo $messageData."<script>alert('".$strMessage."');loadGridData();window.dialogFormUbahClose()</script>";

        

        }

  

        public function HapusKasBank($ID)

        {
          
            //$this->ID = $this->security->xss_clean($ID);
            $this->ID = $ID;



            //cek di tabeL2 tertentu yang berhubungan dengan proses ini

            $this->arrData = array();

            $this->arrData[] = array("tableName" => "trx_kas", "SQLWhere" => "id_kasbank = '".$this->ID."'"

                                     //"tableName" => "trx_spm", "SQLWhere" => "idKasBank = '".$this->ID."'",

                                     //"tableName" => "trx_spp", "SQLWhere" => "idKasBank = '".$this->ID."'"
                                    );



            if (!isCheckTransactionOK($this->arrData))

            {

              $strMessage  = 'Hapus KasBank tidak berhasil, terdapat beberapa transaksi dengan referensi yang sama';

              $messageData = ConstructMessageResponse($strMessage , 'danger');

              echo $messageData;

              exit;

            }

            //hapus 

            $this->selectQuery = $this->db->query("delete from mst_kasbank where id_kasbank = '".$this->ID."'");

            $strMessage  = 'Hapus kas bank telah berhasil ';

            $messageData = ConstructMessageResponse($strMessage , 'info');
            echo $messageData."<script>loadGridData();</script>";

            exit;                

        }

    }
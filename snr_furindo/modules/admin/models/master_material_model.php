<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

    class Master_material_model extends CI_Model{

        public function __construct() {
            parent::__construct();
        }

        public function TambahKaryawan($dataKaryawan)
        {

          $this->IDUser     = $_SESSION['IDUser'];

          $this->kode      = $this->security->xss_clean($dataKaryawan['kode']);
          $this->nama      = $this->security->xss_clean($dataKaryawan['nama']);
          //$this->IDDivisi  = $this->security->xss_clean($dataKaryawan['divisi']);
          $this->IDJabatan = $this->security->xss_clean($dataKaryawan['jabatan']);
          $this->IDGroup   = $this->security->xss_clean($dataKaryawan['group']);
          $this->alamat    = $this->security->xss_clean($dataKaryawan['alamat']);
          $this->telp      = $this->security->xss_clean($dataKaryawan['telp']);
          $this->email     = $this->security->xss_clean($dataKaryawan['email']);
          $this->kataSandi = $this->security->xss_clean($dataKaryawan['kataSandi']);
          $this->deskripsi = $this->security->xss_clean($dataKaryawan['deskripsi']);
         
          $this->userEntry  = $this->IDUser;
          $this->dateEntry  = RealDateTime();

          $this->kataSandi = md5($this->kataSandi);

          $this->db->query("insert into mst_karyawan (id_group, id_jabatan, kode_karyawan, nama_karyawan, alamat, telp, email, kata_sandi, 
                                                      deskripsi, date_entry, user_entry, last_update, user_update) 
                            values('".$this->IDGroup."','".$this->IDJabatan."','".$this->kode."','".$this->nama."','".$this->alamat."',
                                '".$this->telp."','".$this->email."', '".$this->kataSandi."','".$this->deskripsi."',
                                  '".$this->dateEntry."','".$this->userEntry."','','0')");

          $strMessage  = 'Tambah Karyawan telah berhasil';
          $messageData = ConstructMessageResponse($strMessage , 'success');

          echo $messageData."<script>alert('".$strMessage."');window.resetForm();dialogFormBaruClose();</script>";
        }


        public function UbahKaryawan($dataKaryawan)
        {

          $this->IDUser     = $_SESSION['IDUser'];

          $this->IDKaryawan = $this->security->xss_clean($dataKaryawan['IDKaryawan']);
          //$this->IDDivisi   = $this->security->xss_clean($dataKaryawan['IDDivisi']);
          $this->IDJabatan  = $this->security->xss_clean($dataKaryawan['IDJabatan']);
          $this->IDGroup    = $this->security->xss_clean($dataKaryawan['IDGroup']);
          $this->kode       = $this->security->xss_clean($dataKaryawan['kode']);
          $this->nama       = $this->security->xss_clean($dataKaryawan['nama']);
          $this->alamat     = $this->security->xss_clean($dataKaryawan['alamat']);
          $this->telp       = $this->security->xss_clean($dataKaryawan['telp']);
          $this->email      = $this->security->xss_clean($dataKaryawan['email']);
          $this->kataSandi  = $this->security->xss_clean($dataKaryawan['kataSandi']);
          $this->deskripsi  = $this->security->xss_clean($dataKaryawan['deskripsi']);

          $this->userUpdate = $this->IDUser; 
          $this->lastUpdate = RealDateTime();

          //cek kode yang sama
          $this->selectQuery = $this->db->query("select id_karyawan from mst_karyawan where kode_karyawan ='".$this->kode."' 
                                                  and id_karyawan <>'".$this->IDKaryawan."' limit 1");
      
          if ($this->selectQuery->num_rows() > 0)
          {
              $strMessage  = 'Kode Karyawan sudah tercatat, silahkan gunakan kode Karyawan yang lain';
              $messageData = ConstructMessageResponse($strMessage , 'danger');

              echo $messageData."<script>alert('".$strMessage."');</script>";

              exit;
          }
        
          $strKataSandi = trim($this->kataSandi) <> '' ? "kata_sandi = '".md5($this->kataSandi)."', " : '';

          $this->db->query("update mst_karyawan set kode_karyawan = '".$this->kode."',                             
                            id_jabatan= '".$this->IDJabatan."',
                            id_group= '".$this->IDGroup."',
                            nama_karyawan = '".$this->nama."',
                            alamat = '".$this->alamat."',
                            telp = '".$this->telp."',
                            email = '".$this->email."',".$strKataSandi."
                            deskripsi ='".$this->deskripsi."', 
                            last_update ='".$this->lastUpdate."', 
                            user_update ='".$this->userUpdate."'
                            where id_karyawan = '".$this->IDKaryawan."'");
    
          $strMessage  = 'Ubah Karyawan telah berhasil';
          $messageData = ConstructMessageResponse($strMessage , 'success');

          echo $messageData."<script>alert('".$strMessage."');loadGridData();window.dialogFormUbahClose()</script>";
        
        }
  
        public function HapusKaryawan($IDKaryawan)
        {
            
            $this->IDKaryawan = $this->security->xss_clean($IDKaryawan);
            $this->IDUser   = $_SESSION['IDUser']; 

            //cek di tabeL2 tertentu yang berhubungan dengan proses ini
            $this->arrData = array();
            $this->arrData[] = array("tableName" => "trx_output", "SQLWhere" => "id_karyawan = '".$this->IDKaryawan."'",
                                     "tableName" => "trx_proyek_member", "SQLWhere" => "id_karyawan = '".$this->IDKaryawan."'",
                                     "tableName" => "trx_timesheet", "SQLWhere" => "id_karyawan = '".$this->IDKaryawan."'");

            if (!isCheckTransactionOK($this->arrData))
            {
              $strMessage  = 'Hapus karyawan tidak berhasil, terdapat beberapa transaksi dengan referensi yang sama';
              $messageData = ConstructMessageResponse($strMessage , 'danger');
              echo $messageData;
              exit;
            }

            //hapus 
            $this->selectQuery = $this->db->query("delete from mst_karyawan where id_karyawan = '".$this->IDKaryawan."'");
            
            $strMessage  = 'Hapus Karyawan telah berhasil ';
            $messageData = ConstructMessageResponse($strMessage , 'success');

            echo $messageData."<script>loadGridData();</script>";
            exit;
                
        }

  
        public function GetDaftarMaterial()
        {
          $this->selectQuery = $this->db->query("SELECT * from mst_material LEFT join mst_provider on mst_material.provider_id =mst_provider.provider_id
            inner join ref_unit on ref_unit.unit_id = mst_material.unit_id order by material_id desc");
       
          $arrSelectQuery = array();

          foreach ($this->selectQuery->result_array() as $row) {
            if($row['material_categories_id'] == 1){
              $cat = 'Raw';
            }else{
              $cat = 'Suport';
            }
            $strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow()'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow()'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Delete</button>";

            $arrSelectQuery[] = array('idx'    => $row['material_id'],
                                      'kode'   => $row['material_code'],                                      
                                      'nama'   => $row['material_name'],
                                      'cbm'    => $row['material_cbm'],
                                      'harga'  => $row['material_price'], 
                                      'usd'    => $row['material_price_usd'],                                      
                                      'provider'   => $row['provider_name'],
                                      'unit'   => $row['unit_name'],
                                      'stock'   => $row['material_minimal_stock'],
                                      'categories' => $cat, 
                                      'cat' => $row['material_categories_id'], 
                                      'group'   => $row['material_categories_group_id'],                                      
                                      'action' => $strDataAction);
          }

          return json_encode($arrSelectQuery);

        }

        public function GetKodekaryawanAJax($IDkaryawan)
        {
          $IDkaryawan = $this->security->xss_clean($IDkaryawan);

          $selectquery =  $this->db->query("select kode_karyawan as Kodekaryawan 
                                            from mst_karyawan  where id_karyawan = '".$IDkaryawan."' ");
          $data = $selectquery->row_array();
          return $data['Kodekaryawan'];
        }

    }

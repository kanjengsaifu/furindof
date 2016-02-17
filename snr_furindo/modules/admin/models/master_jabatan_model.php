<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

    class Master_jabatan_model extends CI_Model{

        public function __construct() {
            parent::__construct();
        }
        public function TambahJabatan($dataJabatan)
        {

          $this->IDUser       = $_SESSION['IDUser'];
          $this->kodeJabatan   = $this->security->xss_clean($dataJabatan['kode']);
          $this->namaJabatan   = $this->security->xss_clean($dataJabatan['nama']);
          $this->deskripsi    = $this->security->xss_clean($dataJabatan['deskripsi']);
         
          $this->userEntry    = $this->IDUser;
          $this->dateEntry    = RealDateTime();
         
          $this->db->query("insert into ref_jabatan (kode_jabatan, nama_jabatan, deskripsi, date_entry, user_entry, last_update, user_update) 
                            values('".$this->kodeJabatan."','".$this->namaJabatan."',  '".$this->deskripsi."',
                                  '".$this->dateEntry."','".$this->userEntry."','','0')");

          $strMessage  = 'Tambah Jabatan telah berhasil';
          $messageData = ConstructMessageResponse($strMessage , 'success');

          echo $messageData."<script>alert('".$strMessage."');window.resetForm();dialogFormBaruClose();</script>";
        }


        public function UbahJabatan($dataJabatan)
        {

          $this->IDUser           = $_SESSION['IDUser']; 
          $this->IDJabatan        = $this->security->xss_clean($dataJabatan['IDJabatan']);
          $this->kodeJabatan      = $this->security->xss_clean($dataJabatan['kode']);
          $this->namaJabatan      = $this->security->xss_clean($dataJabatan['nama']);
          $this->deskripsi        = $this->security->xss_clean($dataJabatan['deskripsi']);
          $this->userUpdate       = $this->IDUser; 
          $this->lastUpdate       = RealDateTime();

          //cek kode yang sama
          $this->selectQuery = $this->db->query("select id_jabatan from ref_jabatan where kode_jabatan ='".$this->kodeJabatan."' 
                                                 and id_jabatan <>'".$this->IDJabatan."' limit 1");
          if ($this->selectQuery->num_rows() > 0)
          {
              $strMessage  = 'Kode Jabatan sudah tercatat, silahkan gunakan kode Jabatan yang lain';
              $messageData = ConstructMessageResponse($strMessage , 'danger');

              echo $messageData."<script>alert('".$strMessage."');</script>";

              exit;
          }
  
          //cek nama yang sama
          $this->selectQuery = $this->db->query("select id_jabatan from ref_jabatan where nama_jabatan ='".$this->namaJabatan."' 
                                                 and id_jabatan <>'".$this->IDJabatan."' limit 1");
          if ($this->selectQuery->num_rows() > 0)
          {
              $strMessage  = 'Nama Jabatan sudah tercatat, silahkan gunakan nama Jabatan yang lain';
              $messageData = ConstructMessageResponse($strMessage , 'danger');

              echo $messageData."<script>alert('".$strMessage."');</script>";

              exit;
          }

          $this->db->query("update ref_jabatan set kode_jabatan = '".$this->kodeJabatan."', 
                            nama_jabatan = '".$this->namaJabatan."',
                            deskripsi ='".$this->deskripsi."', 
                            last_update ='".$this->lastUpdate."', 
                            user_update ='".$this->userUpdate."'
                            where id_jabatan = '".$this->IDJabatan."'");
    
          $strMessage  = 'Ubah Jabatan telah berhasil';
          $messageData = ConstructMessageResponse($strMessage , 'success');

          echo $messageData."<script>alert('".$strMessage."');loadGridData();window.dialogFormUbahClose()</script>";
        
        }
  
        public function HapusJabatan($IDJabatan)
        {
            
            $this->IDJabatan = $this->security->xss_clean($IDJabatan);
            $this->IDUser   = $_SESSION['IDUser']; 

            //check user lain yang menggunakan Jabatan ini  
            $this->selectQuery = $this->db->query("SELECT id_karyawan FROM mst_karyawan    
                                                  WHERE id_jabatan ='".$this->IDJabatan."'   
                                                  AND id_karyawan <> '".$this->IDUser ."'  
                                                  LIMIT 1");

            if ($this->selectQuery->num_rows() > 0)
            {
              $strMessage  = 'Jabatan tidak dapat dihapus, terdapat beberapa karyawan dengan Jabatan yang sama ';
              $messageData = ConstructMessageResponse($strMessage , 'danger');

              echo $messageData."<script>alert('".$strMessage."');</script>";
              exit;        
            }

            //hapus 
            $this->selectQuery = $this->db->query("delete from ref_jabatan where id_jabatan = '".$this->IDJabatan."'");
            
            $strMessage  = 'Hapus Jabatan telah berhasil ';
            $messageData = ConstructMessageResponse($strMessage , 'success');

            echo $messageData."<script>loadGridData();</script>";
            exit;
                
        }

  
        public function GetDaftarJabatan()
        {
          $this->selectQuery = $this->db->query("SELECT id_jabatan as IDJabatan, kode_jabatan as KodeJabatan, nama_jabatan as NamaJabatan,
                                                 deskripsi as Deskripsi    
                                                 FROM ref_jabatan    
                                                 ORDER BY id_jabatan asc");

          $arrSelectQuery = array();

          foreach ($this->selectQuery->result_array() as $row) {

            $strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow()'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow()'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";

            $arrSelectQuery[] = array('idx'        =>  $row['IDJabatan'],
                                       'kode'      =>  $row['KodeJabatan'],
                                       'nama'      =>  $row['NamaJabatan'],
                                       'deskripsi' =>  $row['Deskripsi'],
                                       'action'    =>  $strDataAction
                                      );
          }

          return json_encode($arrSelectQuery);

        }

    }

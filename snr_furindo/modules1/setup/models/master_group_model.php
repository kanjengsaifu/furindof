<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

    class Master_group_model extends CI_Model{
        
        private $namaGroup;
        private $deskripsi;
        private $dateEntry;
        private $userEntry;
        private $selectQuery;
        private $arrSelectQuery;
        private $IDGroup;
    
        public function __construct() {
            parent::__construct();
        }

        public function TambahGroup($namaGroup, $deskripsi)
        {
             
            $this->namaGroup = $this->security->xss_clean($namaGroup);  
            $this->deskripsi = $this->security->xss_clean($deskripsi);   
            $this->dateEntry = RealDateTime();
            $this->userEntry = $_SESSION['IDUser'];

            $this->db->query("insert into sys_group (nama_group, deskripsi, date_entry, user_entry, last_update, user_update) 
                             values('".$this->namaGroup."','".$this->deskripsi."','".$this->dateEntry."','".$this->userEntry."','',0)");

            $strMessage   = 'Tambah data group user telah berhasil';
			      $messageData  = ConstructMessageResponse($strMessage , 'success');

        	  echo $messageData."<script>alert('".$strMessage."');window.resetForm();</script>";
        }

        public function GetDaftarGroupUser()
        {
          $this->selectQuery = $this->db->query("select id_group as IDGroup, nama_group as NamaGroup, deskripsi as Deskripsi 
                                                 from sys_group order by nama_group asc");
          return  $this->selectQuery->result_array();

        }

        public function UbahGroup($IDGroup, $namaGroup, $deskripsi)
        {
            $this->IDGroup    = $this->security->xss_clean($IDGroup);
            $this->namaGroup  = $this->security->xss_clean($namaGroup);  
            $this->deskripsi  = $this->security->xss_clean($deskripsi);   
            $this->dateUpdate = RealDateTime();
            $this->userUpdate = $_SESSION['IDUser'];

            //check dulu apakah ada group lain  yang memakai nama group ini
            $this->selectQuery = $this->db->query("select id_group  
                                                   from sys_group where
                                                   nama_group = '".$this->namaGroup."'  
                                                   and id_group <> '".$this->IDGroup."'");
            if ( $this->selectQuery->num_rows() > 0)
            {
                 $strMessage  = 'Nama group '.$this->namaGroup. ' sudah tersedia, silahkan gunakan nama yang lain';
                 $messageData = ConstructMessageResponse($strMessage, 'warning');

                 echo $messageData."<script>alert('".$strMessage."');</script>";
                 exit;
            }   

            $this->db->query("update sys_group set nama_group = '".$this->namaGroup."', 
                             deskripsi = '".$this->deskripsi."', last_update = '".$this->dateUpdate."',
                             user_update = '".$this->userUpdate."'    
                             where id_group = '".$this->IDGroup."'");

            $strMessage   = 'Ubah data group telah berhasil';
            $messageData  = ConstructMessageResponse($strMessage , 'success');

            echo $messageData."<script>loadGridData(); $('#dialogFormUbah').attr('class', 'modal hide');</script>";
        }

        public function HapusGroup($IDGroup)
        {
            
            $this->IDGroup = $IDGroup;

            //check dulu apakah ada user yang masih memakai group ini
            $this->selectQuery = $this->db->query("select count(id_karyawan) as jmlUser 
                                                   from mst_karyawan where id_group = '".$this->IDGroup."'");
        
            $arrSelectQuery =  $this->selectQuery->row_array();
            $this->jmlUser = $arrSelectQuery['jmlUser'];
            
            if ($this->jmlUser > 0)
            {
                echo "<script>alert('Group tidak dapat dihapus, terdapat ".$this->jmlUser. " user lain di group yang sama ');</script>";
                exit;
            }

            //hapus 
            $this->selectQuery = $this->db->query("delete from sys_group where id_group = '".$this->IDGroup."'");
        
            echo "<script>loadGridData();alert('Hapus group user telah berhasil');</script>";
            exit;
          
        }

        public function GetCariGroup($kategori, $pencarian)
        {
            $this->kategori   = ($kategori == 'namaGroup') ? 'nama_group' : 'deskripsi'; 
            $this->pencarian  = $pencarian;

            $this->selectQuery = $this->db->query("select  id_group as IDGroup, nama_group as NamaGroup, deskripsi as Deskripsi  
                                                  from sys_group where ".$this->kategori." like '%".$this->pencarian."%' 
                                                  order by nama_group asc");
       
            return  $this->selectQuery->result_array();
        }
       
    }
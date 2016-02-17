<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

    class Master_user_model extends CI_Model{
    	
      	private $namaLengkap;
      	private $namaUser;
      	private $kataSandi;
      	private $userGroup;
      	private $email;
      	private $dateEntry;
        private $userEntry;
        private $IDUserEntry;
        private $dataTreeView;
        private $arrTreeView;
        private $selectQuery;

        public function __construct() {
            parent::__construct();
        }
       	
       	public function TambahUser($dataTambahUser)
        {
             
            $this->namaLengkap = $this->security->xss_clean($dataTambahUser['namaLengkap']);  
            $this->namaUser	   = $this->security->xss_clean($dataTambahUser['namaUser']);   
            $this->kataSandi   = $this->security->xss_clean($dataTambahUser['kataSandi']); 
            $this->userGroup   = $this->security->xss_clean($dataTambahUser['userGroup']);
            $this->IDUPTD      = $this->security->xss_clean($dataTambahUser['uptd']);  
            $this->email   	   = $this->security->xss_clean($dataTambahUser['email']);

            $this->IDUnitKerja = $_SESSION['IDUnitKerja'];
            $this->userEntry   = $_SESSION['IDUser']; 
            $this->dateEntry   = RealDateTime();

      
            $this->selectQuery = $this->db->query("SELECT (SELECT id_kecamatan FROM mst_kecamatan WHERE kode_kecamatan = (SELECT kode_kecamatan
                            FROM mst_uptd WHERE id_uptd = '".$this->IDUPTD."' )) AS IDKecamatan,

                            (SELECT id_kabupaten FROM mst_kabupaten WHERE kode_kabupaten = (SELECT kode_kabupaten
                            FROM mst_kecamatan WHERE kode_kecamatan = (SELECT kode_kecamatan
                            FROM mst_uptd WHERE id_uptd = '".$this->IDUPTD."' ) )) AS IDKabupaten,


                            (SELECT id_propinsi FROM mst_propinsi WHERE kode_propinsi = (SELECT kode_propinsi
                            FROM mst_kabupaten WHERE kode_kabupaten = (SELECT kode_kabupaten
                            FROM mst_kecamatan WHERE kode_kecamatan = (SELECT kode_kecamatan
                            FROM mst_uptd WHERE id_uptd = '".$this->IDUPTD."' ) ) ) ) AS IDPropinsi ");
           
            $this->arrSelectQuery = $this->selectQuery->row_array();

            $this->IDKecamatan = $this->arrSelectQuery['IDKecamatan'];
            $this->IDKabupaten = $this->arrSelectQuery['IDKabupaten'];
            $this->IDPropinsi  = $this->arrSelectQuery['IDPropinsi'];

            $this->db->query("insert into sys_user (id_group, id_unit_kerja, id_uptd, id_provinsi, 
                              id_kabupaten, id_kecamatan, nama_lengkap, nama_user, kata_sandi, email, 
                              aktif, date_entry, user_entry, last_update, user_update) 
                              values('".$this->userGroup."','".$this->IDUnitKerja."','".$this->IDUPTD."',
                              '".$this->IDPropinsi."','".$this->IDKabupaten."','".$this->IDKecamatan."',
                              '".$this->namaLengkap."','".$this->namaUser."','".$this->kataSandi."',
                              '".$this->email."', true,'".$this->dateEntry."','".$this->userEntry."','',0)");

            $strMessage  = 'Tambah data user telah berhasil';
			      $messageData = ConstructMessageResponse($strMessage , 'success');

        	  echo $messageData."<script>alert('".$strMessage."');window.resetForm()</script>";
        }

        public function GetDaftarUser()
        {
          $this->selectQuery = $this->db->query("select id_user as IDUser, nama_user as NamaUser, 
                                                 nama_lengkap as NamaLengkap, email as Email,
                                                 aktif as Aktif,
                                                 id_uptd AS IDUPTD,
                                                 id_group AS IDGroup,
                                                 (select nama_group from sys_group where sys_group.id_group=sys_user.id_group) as NamaGroup,
                                                 CASE WHEN (id_unit_kerja > 0) AND (id_uptd = 0) THEN 'dinas' ELSE 'uptd' END as LevelKerja   
                                                 from sys_user order by nama_user asc");
          return  $this->selectQuery->result_array();

        }

        public function UbahUser($dataUbahUser) 
        {

            $this->IDUser      = $this->security->xss_clean($dataUbahUser['IDUser']);
            $this->namaLengkap = $this->security->xss_clean($dataUbahUser['namaLengkap']);  
            $this->namaUser    = $this->security->xss_clean($dataUbahUser['namaUser']);   
            $this->kataSandi   = $this->security->xss_clean($dataUbahUser['kataSandi']); 
            $this->userGroup   = $this->security->xss_clean($dataUbahUser['userGroup']);
            $this->IDUPTD      = $this->security->xss_clean($dataUbahUser['uptd']);  
            $this->email       = $this->security->xss_clean($dataUbahUser['email']);
            $this->aktif       = $this->security->xss_clean($dataUbahUser['aktif']);
            $this->IDUnitKerja = $_SESSION['IDUnitKerja'];

            $this->dateUpdate   = RealDateTime();
            $this->userUpdate   = $_SESSION['IDUser'];

            //check dulu apakah ada user lain  yang memakai nama user ini
            $this->selectQuery = $this->db->query("select id_user   
                                                   from sys_user where
                                                   nama_user = '".$this->namaUser."'  
                                                   and id_user <> '".$this->IDUser."'");
            if ( $this->selectQuery->num_rows() > 0)
            {
                 $strMessage  = 'Nama user '.$this->namaUser;

                 $messageData = ConstructMessageResponse($strMessage , 'warning');

                 echo $messageData."<script>alert('".$strMessage." sudah tersedia, silahkan gunakan nama yang lain');</script>";
                 exit;
            }   

            $this->selectQuery = $this->db->query("SELECT (SELECT id_kecamatan FROM mst_kecamatan WHERE kode_kecamatan = (SELECT kode_kecamatan
                            FROM mst_uptd WHERE id_uptd = '".$this->IDUPTD."' )) AS IDKecamatan,

                            (SELECT id_kabupaten FROM mst_kabupaten WHERE kode_kabupaten = (SELECT kode_kabupaten
                            FROM mst_kecamatan WHERE kode_kecamatan = (SELECT kode_kecamatan
                            FROM mst_uptd WHERE id_uptd = '".$this->IDUPTD."' ) )) AS IDKabupaten,


                            (SELECT id_propinsi FROM mst_propinsi WHERE kode_propinsi = (SELECT kode_propinsi
                            FROM mst_kabupaten WHERE kode_kabupaten = (SELECT kode_kabupaten
                            FROM mst_kecamatan WHERE kode_kecamatan = (SELECT kode_kecamatan
                            FROM mst_uptd WHERE id_uptd = '".$this->IDUPTD."' ) ) ) ) AS IDPropinsi ");
           
            $this->arrSelectQuery = $this->selectQuery->row_array();

            $this->IDKecamatan = $this->arrSelectQuery['IDKecamatan'];
            $this->IDKabupaten = $this->arrSelectQuery['IDKabupaten'];
            $this->IDPropinsi  = $this->arrSelectQuery['IDPropinsi'];

            $this->selectQuery = "update sys_user 
                              set nama_lengkap = '".$this->namaLengkap."', 
                              id_group  = '".$this->userGroup."', 
                              id_unit_kerja = '".$this->IDUnitKerja."',
                              id_uptd = '".$this->IDUPTD."',
                              id_provinsi = '".$this->IDPropinsi."',
                              id_kabupaten = '".$this->IDKabupaten."',
                              id_kecamatan = '".$this->IDKecamatan."',
                              nama_user = '".$this->namaUser."',
                              email  = '".$this->email."', 
                              aktif  = '".$this->aktif."', 
                              last_update = '".$this->dateUpdate."',
                              user_update = '".$this->userUpdate."'  ";
                           
            if ($this->kataSandi <> '')
                $this->selectQuery.= ",kata_sandi = '".$this->kataSandi."'  ";

             $this->selectQuery.= "where id_user = '".$this->IDUser."' ";

            $this->db->query($this->selectQuery);  

            $strMessage  = 'Ubah data group user telah berhasil';
            $messageData = ConstructMessageResponse($strMessage, 'success');
            echo $messageData."<script>loadGridData();alert('".$strMessage."');dialogFormUbahClose();</script>";
        }

        public function HapusUser($IDUser)
        {
            
            $this->IDUser = $IDUser;

            $this->selectQuery = $this->db->query("delete from sys_user where id_user = '".$this->IDUser."' and nama_user <> 'superadmin' ");

            echo "<script>loadGridData();alert('Hapus data User telah berhasil');</script>";
           
            //TODO check juga di transaksi
          
        }

        public function GetCariUser($kategori, $pencarian)
        {
            $this->kategori   = ($kategori == 'namaUser') ? 'nama_user' : 'nama_lengkap'; 
            $this->pencarian  = $pencarian;

            $this->selectQuery = $this->db->query("select id_user as IDUser, nama_user as NamaUser, 
                                                   nama_lengkap as NamaLengkap, email as Email,
                                                   aktif as Aktif,
                                                   (select nama_group from sys_group where sys_group.id_group=sys_user.id_group) as NamaGroup,   
                                                   (select id_group from sys_group where sys_group.id_group=sys_user.id_group) as IDGroup  
                                                   from sys_user where ".$this->kategori." like '%".$this->pencarian."%' 
                                                   order by nama_user asc");
       
            return  $this->selectQuery->result_array();
        }

        public function GetDataPuskesmas()
        {
            $this->selectQuery = $this->db->query("select id_uptd as IDUPTD, kode_uptd as KodeUPTD, nama_uptd as NamaUPTD
                                                   from mst_uptd order by kode_uptd asc");
            return $this->selectQuery->result_array();          
        }

    }

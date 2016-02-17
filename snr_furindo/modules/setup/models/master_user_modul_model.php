<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

    class Master_user_modul_model extends CI_Model{
    	 
        private $selectQuery;
        private $arrSelectQuery;

        public function __construct() {
            parent::__construct();
        }
       
       	public function GetDaftarUserModul($IDGroup)
       	{
       		$this->selectQuery    = $this->db->query("SELECT id_karyawan as IDUser, id_group as IDGroup, nama_karyawan as NamaUser 
                                                      FROM mst_karyawan  where id_group = '".$IDGroup."'");

            $this->arrSelectQuery =  ($this->selectQuery->num_rows() > 0) ?  $this->selectQuery->result_array() : array();

            return $this->arrSelectQuery;
       	}

        public function GetDaftarAksesUserUnitKerja($IDUser)
        {
            $this->selectQuery = $this->db->query("SELECT id_unit_kerja as IDUnitKerja FROM mst_karyawan _unit_kerja WHERE id_karyawan='".$IDUser."'");

            $this->arrSelectQuery =  ($this->selectQuery->num_rows() > 0) ?  $this->selectQuery->result_array() : array();
            
            return $this->arrSelectQuery;
        }

        public function GetDaftarAksesUserModul($IDGroup)
        {
            $this->selectQuery = $this->db->query("SELECT id_modul as IDModul FROM sys_group_modul WHERE id_group='".$IDGroup."'");
           
            $this->arrSelectQuery =  ($this->selectQuery->num_rows() > 0) ?  $this->selectQuery->result_array() : array();
            
            return $this->arrSelectQuery;            
        }

        public function GetJmlDaftarGroupUser($IDGroup=1)
        {
            $this->IDGroup = $IDGroup;

            $this->selectQuery = $this->db->query("select count(id_group) as jmlDaftarGroupUser from mst_karyawan 
                                                   where id_group = ".$this->IDGroup); 
            $this->JmlData = 0;

            if ($this->selectQuery->num_rows() > 0 ) {
                $this->arrDataQuery = $this->selectQuery->row_array();
                $this->JmlData = $this->arrDataQuery['jmlDaftarGroupUser'];
            }
            return $this->JmlData;
        }

        public function SetUserModul($dataTreeView, $userGroup)
        {
            
            $this->dataTreeView = $this->security->xss_clean($dataTreeView);  
            $this->IDGroup      = $this->security->xss_clean($userGroup); 
            $this->userEntry    = $_SESSION['IDUser']; 
            $this->dateEntry    = RealDateTime();
            $this->dataTreeView = substr($this->dataTreeView, 0 , strlen($this->dataTreeView) - 1);        

            $this->arrTreeView  = explode(",", $this->dataTreeView);
            
            $this->db->query("delete from sys_group_modul where id_group='".$this->IDGroup."'");

            foreach ($this->arrTreeView as $value) {

                $this->IDModul = $value;
                                     
                $this->db->query("insert into sys_group_modul (id_group, id_modul,
                                  date_entry, user_entry, last_update, user_update) 
                                  values('".$this->IDGroup."','".$this->IDModul."',
                                         '".$this->dateEntry."','".$this->userEntry."', '', '0') ");
                
            } //foreach ($this->arrTreeView as $key => $value) {

            $messageData = ConstructMessageResponse('Set user modul telah berhasil' , 'success');

            return $messageData ;   
        }

        public function CariUserModul($kategori, $pencarian)
        {
            $this->kategori   = 'nama_group'; //$kategori 
            $this->pencarian  = $pencarian;

            $this->selectQuery = $this->db->query("SELECT nama_group AS NamaGroup, (SELECT COUNT(id_group) FROM mst_karyawan 
                                                  WHERE id_group = sys_group.id_group) AS JmlUser,
                                                  id_group AS IDGroup
                                                  FROM sys_group 
                                                  WHERE ".$this->kategori." like '%".$this->pencarian."%' ");
       
            return  $this->selectQuery->result_array();
        }

    }

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Group_modul_model extends CI_Model{
    	
    	private $qryDaftarGroupModul;
        private $arrDaftarGroupModul;        
    	
        public function __construct() {
            parent::__construct();
        }
        
        public function GetDaftarGroupModul()
        {                       

            $this->qryDaftarGroupModul = $this->db->query("SELECT * FROM sys_modul WHERE 
                                                            aktif = TRUE AND level_id = 0
                                                            AND id_modul IN (SELECT id_modul
                                                            FROM sys_group_modul WHERE id_group  = (SELECT id_group
                                                            FROM mst_karyawan WHERE id_karyawan='".$_SESSION['IDUser']."')) 
                                                          ");


            $this->arrDaftarGroupModul = array();

            if ( $this->qryDaftarGroupModul->num_rows() > 0 )
            {
                 $this->arrDaftarGroupModul = $this->qryDaftarGroupModul->result_array();
            }

            return $this->arrDaftarGroupModul;
        }
    }

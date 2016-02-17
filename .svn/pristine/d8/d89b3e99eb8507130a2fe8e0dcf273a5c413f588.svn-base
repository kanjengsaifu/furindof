<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Modul_model extends CI_Model{
    	
    	private $qryDaftarModul;
        private $arrDaftarModul;
    	
        public function __construct() {
            parent::__construct();
        }
        
        public function GetDaftarModul()
        {
            $this->qryDaftarModul = $this->db->query('select * from sys_modul where aktif = true');

            $this->arrDaftarModul = array();

            if ( $this->qryDaftarModul->num_rows() > 0 )
            {
                 $this->arrDaftarModul = $this->qryDaftarModul->result_array();
            }

            return $this->arrDaftarModul;
        }
    }
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Group_user_model extends CI_Model{
    	
    	private $selectQuery;
        private $arrDataQuery;
    	private $IDGroup;

        public function __construct()
        {
            parent::__construct();
        }
        
        public function GetDaftarGroupUser()
        {
            $this->selectQuery = $this->db->query('select id_group as IDUserGroup, nama_group as NamaUserGroup, deskripsi 
                                                  from sys_group');

            $this->arrDataQuery = array();

            if ( $this->selectQuery->num_rows() > 0 )
            {
                 $this->arrDataQuery = $this->selectQuery->result_array();
            }

            return $this->arrDataQuery;
        }

        public function GetJmlDaftarGroupUser($IDGroup=1)
        {
            $this->IDGroup = $IDGroup;

            $this->selectQuery = $this->db->query("select count(id_group) as jmlDaftarGroupUser from sys_user
                                                   where id_group = ".$this->IDGroup); 

            $this->JmlData = 0;

            if ($this->selectQuery->num_rows() > 0 ) {
                $this->arrDataQuery = $this->selectQuery->row_array();
                $this->JmlData = $this->arrDataQuery['jmlDaftarGroupUser'];
            }
            return $this->JmlData;
        }
    }
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

    }
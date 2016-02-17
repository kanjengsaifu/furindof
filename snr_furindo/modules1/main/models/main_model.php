<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');
	
	class Main_model extends CI_Model{

		private $arrIDUPTD;
		private $arrDaftarProfileOperator;
		private $DaftarIdUPTD;
		private $selectQuery;
		private $IDUser;
		private $IDUnitKerja;

	    public function __construct() {
	        parent::__construct();
	    }
	    
	  	public function GetProfilOperator()
	  	{
	  		$this->IDUser = $_SESSION['IDUser'];

	  		$selectQuery = $this->db->query("select nama_karyawan as NamaLengkap, 
	  										(select nama_jabatan from ref_jabatan where id_jabatan=mst_karyawan.id_jabatan) as Jabatan, 
	  										month(date_entry) as Bulan, year(date_entry) as Tahun       
	  										 from mst_karyawan where id_karyawan=".$this->IDUser);

	  		$this->arrDaftarProfileOperator = ($selectQuery->num_rows() > 0) ? $selectQuery->result_array() :  array();

	  		return $this->arrDaftarProfileOperator;
	  	}

	  	public function CheckValidUPTD($IDUPTD)
	  	{
	  		$this->IDUPTD 		= $this->security->xss_clean($IDUPTD);
	  		$this->IDUser 		= $_SESSION['IDUser'];
	  		$this->TipeLogin 	= $_SESSION['TipeLogin'];

	  		$this->strSelectQuery = "select id_user from sys_user where id_user='".$this->IDUser."' ";

	  		if ($this->TipeLogin == 'UPTD') $this->strSelectQuery.= " and id_uptd = '".$this->IDUPTD."'";

	  		$this->selectQuery = $this->db->query($this->strSelectQuery);

	  		return $this->selectQuery->num_rows() > 0;
	  	}

	  	public function GetDataUPTDLaporanRBA($IDUPTD)
	  	{
			$this->IDUPTD = $IDUPTD;

	  		$this->selectQuery = $this->db->query("select nama_uptd as NamaUPTD, nip as NIPPimpinanBLUD, nama_pimpinan as NamaPimpinanBLUD   
	  											   from mst_uptd where id_uptd = '".$this->IDUPTD."' ");
	  		$this->arrSelectQuery = $this->selectQuery->row_array();

	  		return $this->arrSelectQuery;
	  	}

	  	public function GetDaftarTahunAnggaran()
        {
            $this->selectQuery  = $this->db->query('SHOW DATABASES');
            $this->arrDatabase  = array();

            foreach ($this->selectQuery->result_array() as $row) 
            {
               
               $databaseName    = $row['Database'];
               $isBludDatabase  =  substr($row['Database'], 0, 12) == 'blud_syncore';

               if ($isBludDatabase)
               {
                    $this->arrDatabase[] = substr($databaseName, 13, strlen($databaseName));
               } 
            }

           return $this->arrDatabase;
        }    

	    
	}
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Debug extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
	function create_jurnal()
	{	
		//$data = $this->db->get('trx_jurnal');
		//$cek1 = $this->db->query("SELECT * from trx_jurnal");
		$kas = $this->db->query("SELECT * from trx_kas inner join trx_kas_det on trx_kas.id_kas=trx_kas_det.id_kas 
			where trx_kas.nomor_kas not in (select nobukti from trx_jurnal) and kode 
			not in(select akun from trx_jurnal)");
		
		foreach ($kas->result() as $key => $value) 
		{
			$cek = $this->db->query("SELECT * from trx_jurnal");
			$jml = $cek->num_rows();
			if ($jml == 0) {
				$data['nomor']= 'JU-0001';
			} else if($jml < 10){
				$data['nomor']= 'JU-000'.$jml;
			} else if($jml < 100){
				$data['nomor']= 'JU-00'.$jml;
			} else if($jml < 1000){
				$data['nomor']= 'JU-0'.$jml;
			} else {
				$data['nomor']= 'JU-'.$jml;
			}
			$data['tgl']= date("Y-m-d", strtotime($value->tgl_kas));
			$data['uraian']= $value->uraian;
			$data['nobukti']= $value->nomor_kas;
			$data['id_kategori']= $value->id_kategori;
			$data['akun']= $value->kode;
			$data['nominal']= $value->nominal;
			if ($value->jenis == 'um'){
				$data['jenis']= 'uk';
			} else {
				$data['jenis']= 'um';
			}
			$data['dateentry']= date("Y-m-d");
			$data['userentry']= $_SESSION['IDUser'];			
			$this->db->insert("trx_jurnal", $data);
			
		}
		echo "selesai";
	}

	function create_raw()
	{
		$this->db->group_by('raw_code');
		$data = $this->db->get('raw2');

		foreach ($data->result() as $key => $value)
		{
			$this->db->insert('raw', array("code"=>$value->raw_code, "name"=>$value->raw_name));
		}
	}

	function create_material()
	{
		$this->db->group_by('material_code');
		$data = $this->db->get('tbl_material');

		foreach ($data->result() as $key => $value)
		{
			$this->db->insert('material', array("nama"=>$value->material_name, "code"=>$value->material_code));
		}
	}

	

}

?>
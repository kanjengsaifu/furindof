<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

	class Arsip extends MY_Controller {    
	  	

	     public function __construct() {
	        parent::__construct();
	    }
	         
		public function index()
		{	
			$this->checkCredentialAccess();

			$this->checkIsAjaxRequest();

			//$data = $this->db->query("SELECT * from ref_kecamatan");
			//$data1 = $this->db->query("SELECT * from ref_kelurahan");
			//$data2 = $this->db->query("SELECT * from ref_pedukuhan");
	        $this->load->model('arsip_model', 'ModelAdmin');
	        $dataMenu = array('dataMenu' => $this->ModelAdmin->GetMenuAdmin());

	        $menu 	  = $this->load->view('menu_arsip_view', $dataMenu, true);
	        $content  = $this->load->view('dashboard_view', '', true);
	        //$content  = $this->load->view('admin_view', '', true);

	        $arrData = array('menu' 	=> $menu,	        				 
	        			   	 'content'  => $content);

	        echo json_encode($arrData);
		}	

		 public function savefile()
	    {
	    	//echo "<pre>";print_r($_POST);"</pre>";exit();
	    	$data['nomor_arsip'] = $this->input->post("nomor");
	    	$data['nama_file'] = $this->input->post("file")[0];
			$data['deskripsi'] = $this->input->post("diskripsi");
			$this->db->insert("trx_arsip", $data);
			//$datacheck = $this->db->query("SELECT kode_barang from barang 
			//			where kode_barang ='".$this->input->post("kode")."'");
			
	    }
	   	
	   	function uploadFileMulti()
		{
			//echo "<pre>";print_r($_FILES);"</pre>";exit();
			if(isset($_FILES[0]['error']))
			{
				$fileUpload = $_FILES[0]['name'];
				$tmpFile = $_FILES[0]['tmp_name'];
				$uploadDir = "upload/";
				
				move_uploaded_file($tmpFile, $uploadDir.$fileUpload);
				
				$flag = true;
			}
			else
			{
				$flag = false;
			}
			
			echo $flag;
		}

		function unlink()
		{
			//echo "<pre>";print_r($_POST);"</pre>";exit();
			$name_only = $this->input->post("file");
			//$pathimages .= "/uploads/files/";
			$pathimages = $_SERVER['DOCUMENT_ROOT'];
			unlink($pathimages . "/snr/upload/" . $name_only);

			$flag = true;

			echo $flag;
		}

		function addTableArsip(){
            $this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            //$this->load->model('kasbank_model', 'ModelKasbank');
            $arrContent = $this->db->query("SELECT * from trx_arsip");           
            
            $i=1; 
            $strContent = '';

            foreach($arrContent->result() as $row){               
                //$hh ='<td> <img width="20" src="upload/'.$row->nama_file.'"/></td> ';
                $strContent.='<tr class="record">
                                      <td>'.$i.'</td>                                      
                                      <td>'.$row->nomor_arsip.'</td>                                      
                                      <td><a href="'.site_url().'upload/'.$row->nama_file.'">'.$row->nama_file.'</td>                           
                                      <td>'.$row->deskripsi.'</td>        
                                      <td>
                                        <button type="button" class="btn btn-xs btn-warning" onclick="dialogFormEditShow(this)"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</button>
                                        <button type="button" class="btn btn-xs btn-danger"  onclick="deletedata('.$row->id_arsip.')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete</button>
                                      </td>
                                </tr>';
              $i++;                      
            }     
            echo $strContent;            
          }

	    public function suratmasuk()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();            
    
            $content = $this->load->view('suratmasuk');
                          
            echo $content;

		}

		public function suratkeluar()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            $data ['barang'] = $this->db->query("SELECT id_jenis_barang as ID, kode_jenis_barang as Kode, nama_jenis_barang as Nama 
                                				from jenis_barang order by Kode asc");
    
            $content = $this->load->view('suratkeluar');
                          
            echo $content;

		}

		public function surattugas()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            $data ['barang'] = $this->db->query("SELECT id_jenis_barang as ID, kode_jenis_barang as Kode, nama_jenis_barang as Nama 
                                				from jenis_barang order by Kode asc");
    
            $content = $this->load->view('surattugas');
                          
            echo $content;

		}

		public function suratkeputusan()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            $data ['barang'] = $this->db->query("SELECT id_jenis_barang as ID, kode_jenis_barang as Kode, nama_jenis_barang as Nama 
                                				from jenis_barang order by Kode asc");
    
            $content = $this->load->view('suratkeputusan');
                          
            echo $content;

		}

		public function pengadaan()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            $data ['barang'] = $this->db->query("SELECT id_jenis_barang as ID, kode_jenis_barang as Kode, nama_jenis_barang as Nama 
                                				from jenis_barang order by Kode asc");
    
            $content = $this->load->view('pengadaan');
                          
            echo $content;

		}

		public function monitoring()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            $data ['barang'] = $this->db->query("SELECT id_jenis_barang as ID, kode_jenis_barang as Kode, nama_jenis_barang as Nama 
                                				from jenis_barang order by Kode asc");
    
            $content = $this->load->view('monitoring');
                          
            echo $content;

		}

		public function ubahjenisbarang($obj)
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            $data ['barang'] = $this->db->query("SELECT id_jenis_barang as ID, kode_jenis_barang as Kode, nama_jenis_barang as Nama 
                                				from jenis_barang where id_jenis_barang = '".$obj."' order by Kode asc")->row();
    
            $content = $this->load->view('updatejenisbarang',$data);
                          
            echo $content;

		}

		public function caridatajenisbarang()
		{
			//echo "<pre>";print_r($_POST);"</pre>";exit();
            $kode = $this->input->post("kode");
            $namaB = $this->input->post("nama");
            $param = $this->db->query("SELECT id_jenis_barang as ID, kode_jenis_barang as Kode, nama_jenis_barang as Nama 
                                			  from jenis_barang
                                              where nama_jenis_barang like '%".$namaB."%' and kode_jenis_barang like '%".$kode."%'
                                			  order by Kode asc");
    
           	foreach($param->result() as $row)
			{
				$data['ID'] = $row->ID;
				$data['Kode'] = $row->Kode;
				$data['Nama'] = $row->Nama;
				//$data['TglMasuk'] = $row->TglMasuk;
				//$data['Jumlah'] = $row->Jumlah;
				//$data['Satuan'] = $row->Satuan;
				//$data['NamaJenis'] = $row->NamaJenis;
				
				$json['barang'][] = $data;
				
			}
			//$json['status'] = true;
			
			$dataJson = json_encode($json);
			
			echo $dataJson;

		}

		/*public function cariJenisBarang()
	    {
	        $thisinput = $this->input->post();
	        
	        if ($thisinput == null) {
	            redirect(base_url('distribusi/jenisbarang'));
	        }
	        
	        $this->load->view('main/header', $this->_content);
	        $this->load->view('distribusi/jenisbarang', array("keyword"=> $thisinput['keyword'])) ;
	        $this->load->view('main/footer', $this->_content);
	    }*/

	    public function addJenisBarang()
	    {
	        $data['barang'] = $this->db->query("SELECT * FROM jenis_barang ORDER BY kode_jenis_barang DESC LIMIT 1")->row();
            $content = $this->load->view('addjenisbarang',$data,true);
                          
            echo $content;
	    }

	    public function savejenisbarang()
	    {

	    	$data['kode_jenis_barang'] = $this->input->post("kode_jenis_barang");
			$data['nama_jenis_barang'] = $this->input->post("nama_jenis_barang");			
			$datacheck = $this->db->query("SELECT kode_jenis_barang from jenis_barang 
						where kode_jenis_barang ='".$this->input->post("kode_jenis_barang")."'");
			if ($datacheck->num_rows()==1) {				  
	              echo '1';	             
			}else{
			$this->db->insert("jenis_barang", $data);
				echo '2';
			}
	    }

	    public function updatejenisbarang()
	    {
	    	$id = $this->input->post("id_jenis");
	    	$data['kode_jenis_barang'] = $this->input->post("kode_jenis_barang");
			$data['nama_jenis_barang'] = $this->input->post("nama_jenis_barang");			
			$this->db->where('id_jenis_barang',$id);
			$this->db->update("jenis_barang", $data);
	    }

	    public function Hapusjenisbarang()
        {
            $this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            $name_only = $this->db->query("SELECT * from trx_arsip where id_arsip = '".$this->input->post('IDDel')."'")->row();
			//$pathimages .= "/uploads/files/";
			$pathimages = $_SERVER['DOCUMENT_ROOT'];
			unlink($pathimages . "/snr/upload/" . $name_only->nama_file);

            $id_jenis_barang =   $this->input->post('IDDel');
            $this->db->delete('trx_arsip', array('id_arsip' => $id_jenis_barang)); 
		
		}

		public function cetakjenisbarang()
		{
	         
            $this->load->view('cetakjenisbarang','');                          
            
	    }

}

/* End of fiel Utility.php */